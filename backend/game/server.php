<?php

require 'config.php';
require 'player.php';
require 'room.php';

class Server {

    private $rooms = [];
    private $players = [];
    private $room_index = 0;
    private $server_socket = false;

    private static $_server = false;

    
    public static function getInstance() {
        if(Server::$_server == false)
            Server::$_server = new Server();

        return Server::$_server;
    }

    private function handshake($client) {
        $read = [''];
        $line = false;

        while(true) {
            if(($length = socket_recv($client, $line, 1024, 0)) === 0 ) {
                socket_shutdown($client);
                socket_close($client);
                return false;
            }
            if($line == null || strlen($line) == 0)
                continue;

            break;
        }

        do {
            $read[] = $line;

            if(($length = socket_recv($client, $line, 1024, 0)) === 0 ) {
                socket_shutdown($client);
                socket_close($client);
                return false;
            }

            if(($line == null || strlen($line) == 0) && count($read) > 0) {
                break;
            }
        }
        while(true);

        $read = implode($read);

        preg_match('#Sec-WebSocket-Key: (.*)\r\n#', $read, $matches);

        $key = base64_encode(pack(
            'H*',
            sha1($matches[1] . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11')
        ));

        $headers = "HTTP/1.1 101 Switching Protocols\r\n";
        $headers .= "Upgrade: websocket\r\n";
        $headers .= "Connection: Upgrade\r\n";
        $headers .= "Sec-WebSocket-Version: 13\r\n";
        $headers .= "Sec-WebSocket-Accept: $key\r\n\r\n";
        socket_write($client, $headers, strlen($headers));
        return true;
    }

    
    //Unmask incoming framed message
    private function decode($text) {
        $length = ord($text[1]) & 127;
        if($length == 126) {
            $masks = substr($text, 4, 4);
            $data = substr($text, 8);
        }
        elseif($length == 127) {
            $masks = substr($text, 10, 4);
            $data = substr($text, 14);
        }
        else {
            $masks = substr($text, 2, 4);
            $data = substr($text, 6);
        }
        $text = "";
        for ($i = 0; $i < strlen($data); ++$i) {
            $text .= $data[$i] ^ $masks[$i%4];
        }
        return $text;
    }

    private function encode($text)
    {
        $b1 = 0x80 | (0x1 & 0x0f);
        $length = strlen($text);
        
        if($length <= 125)
            $header = pack('CC', $b1, $length);
        elseif($length > 125 && $length < 65536)
            $header = pack('CCn', $b1, 126, $length);
        elseif($length >= 65536)
            $header = pack('CCNN', $b1, 127, $length);
        return $header.$text;
    }



    public function run() {
        echo "\n[" . date('H:i:s') . "][SERVER][INFO]: START\n";

        $result = true;
        $this->server_socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        echo "\n[" . date('H:i:s') . '][SERVER][INFO]: ' . SOCKET_HOST . ':' . SOCKET_PORT . "\n";

        $result &= socket_bind($this->server_socket, SOCKET_HOST, SOCKET_PORT);
        $result &= socket_listen($this->server_socket);
        $result &= socket_set_nonblock($this->server_socket);

        if(!$result) {
            die("[" . date('H:i:s') . '][SERVER][ERROR]: On init server socket' . "\n");
        }

        echo "[" . date('H:i:s') . "][SERVER][INFO]: Waiting players\n";

        while(true) {
            // с каких сокетов прослушивать запросы
            $recieved = $this->getPlayersSockets();
            $errors = $this->getPlayersSockets();
            $recieved[] = $this->server_socket;
            $errors[] = $this->server_socket;
            $NULL = NULL;

            $count_changed = socket_select($recieved, $NULL, $errors, null);

            if($count_changed === false) {
                echo "[" . date('H:i:s') . "][SERVER][ERROR]: On socker select\n" ;
                echo "[" . date('H:i:s') . "][SERVER][ERROR]: " . socket_strerror(socket_last_error()) . "\n";
            }

            if($count_changed == 0)
                continue;

            // если обновился серверный сокет
            if(in_array($this->server_socket, $recieved)) {
                $client_socket = socket_accept($this->server_socket);
                socket_set_nonblock($client_socket);
                if($this->handshake($client_socket)) {
                    // уникальный id для игрока
                    $socket_id = spl_object_id($client_socket);
                    $player = Player::getInstance($client_socket);
                    $this->players[$socket_id] = $player;

                    echo "[" . date('H:i:s') . "][SERVER][INFO]: New connect\n";
                }

                $found_socket = array_search($this->server_socket, $recieved);
                unset($recieved[$found_socket]);
            }

            // перебрать все сокеты с ошибками и избавиться от них
            foreach($errors as $socket) {
                $this->onSocketError($socket);
            }

            foreach($recieved as $socket) {
                $read = [''];
                $error = false;

                while(true) {
                    $line = '';
                    $length = 0;

                    if(($length = socket_recv($socket, $line, 1024, 0)) === 0) {
                        $error = true;
                        echo "[" . date('H:i:s') . "][SERVER][ERROR]: Client read error. Maybe closed.\n";
                        echo "[" . date('H:i:s') . "][SERVER][ERROR]: " . socket_strerror(socket_last_error()). "\n";
                        // при ошибке выкинуть пользователя
                        $error = true;
                        $this->onSocketError($socket);
                        break;
                    }

                    if($line == null || strlen($line) == 0)
                        break;

                    if($line != null)
                        $read[] = $line;
                }

                if($error)
                    continue;

                $read = $this->decode(implode($read));

                if(strlen($read) == 0) {
                    continue;
                }

                $msg = json_decode($read, true);

                if($msg == null) {
                    echo "[" . date('H:i:s') . "][SERVER][ERROR]: Broken JSON data in message\n";
                    $this->onSocketError($socket);
                    continue;
                }

                if(!isset($msg['nonce'])) {
                    echo "[" . date('H:i:s') . "][SERVER][ERROR]: Not send nonce\n";
                    $msg = json_encode([
                        'result'        => 'error',
                        'msg'           => 'Не указан параметр nonce',
                    ]);
                    $this->sendMsg($socket, $msg);
                    
                    continue;
                }

                // проверить каждого пользователя и если его, то отдать ему запрос
                // $player->onMsg($msg);
                $this->players[spl_object_id($socket)]->onMsg($msg);
            }
        }

    }

    public function roomsList() {
        $rooms = [];
        foreach($this->rooms as $id => $room) {
            $rooms[] = [
                'id'        => $id,
                'name'      => $room->getName(),
            ];
        }

        return $rooms;
    }

    public function enterRoom($id, $player) {
        if(!isset($this->rooms[$id]))
            return false;

        $this->rooms[$id]->enter($player);

        return $this->rooms[$id];
    }

    public function createRoom($player) {
        $id = $this->room_index;
        
        $room = Room::getInstance($id, $player);
        $this->rooms[$id] = $room;

        $this->room_index++;

        return $room;
    }

    public function sendMsg($socket, $msg) {
        $msg = json_encode($msg);
        $msg = $this->encode($msg);

        if(socket_write($socket, $msg, strlen($msg)) === false) {
            $this->onSocketError($socket);
        }
    }

    private function onSocketError($socket) {
        $id = spl_object_id($socket);
        if(isset($this->players[$id])) {
            $this->players[$id]->onError();
            unset($this->players[$id]);
        }
    }

    private function getPlayersSockets() {

        // echo "[" . date('H:i:s') . "][SERVER][LOG] Count players " . count($this->players) . "\n";

        $clients = array();
        foreach($this->players as $player) {
            $clients[] = $player->getSocket();
        }

        return $clients;
    }

    public function removeRoom($room) {
        unset($this->rooms[$room->getID()]);
    }

}



?>