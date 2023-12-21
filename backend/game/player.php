<?php
require_once 'server.php';

class Player {
    private $socket = false;
    private $room = false;
    private $name = false;
    private $id = false;
    private $character = false;

    public function __construct($socket) {
        $this->socket = $socket;
    }

    public static function getInstance($socket) {
        return new Player($socket);
    }

    public function getSocket() {
        return $this->socket;
    }

    public function getSocketID() {
        return spl_object_id($this->socket);
    }

    public function isPlayerSocket($socket) {
        return $this->socket == $socket;
    }

    public function getName() {
        return $this->name;
    }

    public function onError() {
        if($this->room != false)
            $this->room->onError($this);
        $this->room = false;
        socket_shutdown($this->socket);
        socket_close($this->socket);
        $this->socket = false;
    }

    public function onMsg($msg) {
        if($msg['request'] == 'set_name') {
            // если не указано имя
            if(!isset($msg['name'])) {
                $this->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'Need name parameter',
                ]);
                return;
            }
            $this->name = $msg['name'];

            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
            ]);
            return;
        }
        if($msg['request'] == 'get_id') {
            // токен выдавать только после имени
            if($this->name === false) {
                $this->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'First need set name',
                ]);
                return;
            }
            $this->generateID();
            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
                'id'        => $this->id,
            ]);
            return;
        }
        if($msg['request'] == 'set_id') {
            // если не указано id
            if(!isset($msg['id'])) {
                $this->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'Need id parameter',
                ]);
                return;
            }
            $this->id = $msg['id'];

            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
            ]);
            return;
        }
        if($msg['request'] == 'set_character') {
            // если не указано id
            if(!isset($msg['character'])) {
                $this->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'Need character parameter',
                ]);
                return;
            }
            $this->character = $msg['character'];

            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
            ]);
            return;
        }

        // обраывать запросы, если пользователь не прошел базовую авторизацию
        if($this->name === false) {
            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'error',
                'msg'       => 'Need set name',
            ]);
            return;
        }
        if($this->id === false) {
            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'error',
                'msg'       => 'Need set id',
            ]);
            return;
        }
        if($this->character === false) {
            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'error',
                'msg'       => 'Need set character',
            ]);
            return;
        }

        // комнаты
        if($msg['request'] == 'rooms') {
            // если не указано id

            $rooms = Server::getInstance()->roomsList();

            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
                'list'      => $rooms,
            ]);
            return;
        }
        // создать комнату
        if($msg['request'] == 'rooms/create') {

            $this->room = Server::getInstance()->createRoom($this);

            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
                'id'        => $this->room->getID(),
            ]);

            return;
        }
        // создать комнату
        if($msg['request'] == 'rooms/enter') {
            // если не указано id
            if(!isset($msg['id'])) {
                $this->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'Need id parameter',
                ]);
                return;
            }

            $result = Server::getInstance()->enterRoom($msg['id'], $this);

            if($result == false) {
                $this->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'ok',
                    'msg'       => 'Room not found',
                ]);
                return;
            }

            $this->room = $result;

            $this->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
            ]);
            return;
        }

        if($this->room != false) {
            $this->room->onMsg($this, $msg);
        }
    }

    public function sendMsg($msg) {
        Server::getInstance()->sendMsg($this->socket, $msg);
    }

    private function generateID() {
        $this->id = time() . md5($this->name);
    }

    public function getID() {
        return $this->id;
    }
    public function getCharacter() {
        return $this->character;
    }

    public function setRoom($room) {
        $this->room = $room;
    }
}

?>