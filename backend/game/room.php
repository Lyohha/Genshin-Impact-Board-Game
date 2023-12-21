<?php

require 'game.php';


$markers = [
    "1" => ["x" => 2680, "type" => 'default', "y" => 1604],
    "2" => ["x" => 2565, "type" => 'default', "y" => 1625],
    "3" => ["x" => 2446, "type" => 'default', "y" => 1633],
    "4" => ["x" => 2368, "type" => 'default', "y" => 1536],
    "5" => ["x" => 2396, "type" => 'default', "y" => 1395],
    "6" => ["x" => 2340, "type" => 'default', "y" => 1314],
    "7" => ["x" => 2222, "type" => 'forward', "y" => 1370],
    "8" => ["x" => 2088, "type" => 'default', "y" => 1357],
    "9" => ["x" => 1962, "type" => 'default', "y" => 1400],
    "10" => ["x" => 2051, "type" => 'cryo', "y" => 1507],
    "11" => ["x" => 2158, "type" => 'cryo', "y" => 1583],
    "12" => ["x" => 2278, "type" => 'cryo', "y" => 1640],
    "13" => ["x" => 2230, "type" => 'cryo', "y" => 1764],
    "14" => ["x" => 2100, "type" => 'cryo', "y" => 1813],
    "15" => ["x" => 1982, "type" => 'cryo', "y" => 1765],
    "16" => ["x" => 1910, "type" => 'default', "y" => 1666],
    "17" => ["x" => 1791, "type" => 'default', "y" => 1655],
    "18" => ["x" => 1719, "type" => 'geo', "y" => 1747],
    "19" => ["x" => 1673, "type" => 'geo', "y" => 1852],
    "20" => ["x" => 1759, "type" => 'geo', "y" => 1937],
    "21" => ["x" => 1868, "type" => 'geo', "y" => 1993],
    "22" => ["x" => 1992, "type" => 'geo', "y" => 2025],
    "23" => ["x" => 2152, "type" => 'geo', "y" => 2058],
    "24" => ["x" => 2321, "type" => 'forward', "y" => 2102],
    "25" => ["x" => 2502, "type" => 'default', "y" => 2162],
    "26" => ["x" => 2668, "type" => 'default', "y" => 2235],
    "27" => ["x" => 2828, "type" => 'default', "y" => 2311],
    "28" => ["x" => 3004, "type" => 'backward', "y" => 2401],
    "29" => ["x" => 3110, "type" => 'default', "y" => 2537],
    "30" => ["x" => 3102, "type" => 'electro', "y" => 2675],
    "31" => ["x" => 3144, "type" => 'electro', "y" => 2826],
    "32" => ["x" => 3116, "type" => 'electro', "y" => 2959],
    "33" => ["x" => 3074, "type" => 'electro', "y" => 3102],
    "34" => ["x" => 3065, "type" => 'electro', "y" => 3230],
    "35" => ["x" => 2941, "type" => 'electro', "y" => 3298],
    "36" => ["x" => 2840, "type" => 'default', "y" => 3373],
    "37" => ["x" => 2786, "type" => 'default', "y" => 3463],
    "38" => ["x" => 2660, "type" => 'backward', "y" => 3554],
    "39" => ["x" => 2599, "type" => 'default', "y" => 3444],
    "40" => ["x" => 2613, "type" => 'default', "y" => 3277],
    "41" => ["x" => 2620, "type" => 'default', "y" => 3130],
    "42" => ["x" => 2718, "type" => 'default', "y" => 3010],
    "43" => ["x" => 2564, "type" => 'default', "y" => 2911],
    "44" => ["x" => 2350, "type" => 'forward', "y" => 2904],
    "45" => ["x" => 2220, "type" => 'default', "y" => 2741],
    "46" => ["x" => 2197, "type" => 'default', "y" => 2554],
    "47" => ["x" => 2144, "type" => 'default', "y" => 2411],
    "48" => ["x" => 2091, "type" => 'default', "y" => 2266],
    "49" => ["x" => 1944, "type" => 'anemo', "y" => 2209],
    "50" => ["x" => 1762, "type" => 'anemo', "y" => 2185],
    "51" => ["x" => 1588, "type" => 'anemo', "y" => 2171],
    "52" => ["x" => 1502, "type" => 'anemo', "y" => 2071],
    "53" => ["x" => 1367, "type" => 'anemo', "y" => 2024],
    "54" => ["x" => 1292, "type" => 'anemo', "y" => 2143],
    "55" => ["x" => 1316, "type" => 'forward', "y" => 2269],
    "56" => ["x" => 1322, "type" => 'dendro', "y" => 2374],
    "57" => ["x" => 1226, "type" => 'dendro', "y" => 2431],
    "58" => ["x" => 1106, "type" => 'dendro', "y" => 2345],
    "59" => ["x" => 1089, "type" => 'dendro', "y" => 2213],
    "60" => ["x" => 1041, "type" => 'dendro', "y" => 2089],
    "61" => ["x" => 876, "type" => 'dendro', "y" => 2092],
    "62" => ["x" => 868, "type" => 'default', "y" => 2220],
    "63" => ["x" => 874, "type" => 'default', "y" => 2327],
    "64" => ["x" => 932, "type" => 'default', "y" => 2452],
    "65" => ["x" => 980, "type" => 'default', "y" => 2571],
    "66" => ["x" => 966, "type" => 'default', "y" => 2684],
    "67" => ["x" => 869, "type" => 'backward', "y" => 2769],
    "68" => ["x" => 779, "type" => 'pyro', "y" => 2697],
    "69" => ["x" => 677, "type" => 'pyro', "y" => 2646],
    "70" => ["x" => 545, "type" => 'pyro', "y" => 2538],
    "71" => ["x" => 681, "type" => 'pyro', "y" => 2411],
    "72" => ["x" => 694, "type" => 'pyro', "y" => 2233],
    "73" => ["x" => 580, "type" => 'pyro', "y" => 2132],
    "74" => ["x" => 484, "type" => 'default', "y" => 2035],
    "75" => ["x" => 363, "type" => 'default', "y" => 1898],
    "76" => ["x" => 579, "type" => 'forward', "y" => 1864],
    "77" => ["x" => 519, "type" => 'default', "y" => 1745],
    "78" => ["x" => 631, "type" => 'default', "y" => 1667],
    "79" => ["x" => 774, "type" => 'default', "y" => 1587],
    "80" => ["x" => 859, "type" => 'hydro', "y" => 1493],
    "81" => ["x" => 824, "type" => 'hydro', "y" => 1377],
    "82" => ["x" => 752, "type" => 'hydro', "y" => 1236],
    "83" => ["x" => 797, "type" => 'hydro', "y" => 1110],
    "84" => ["x" => 816, "type" => 'hydro', "y" => 990],
    "85" => ["x" => 826, "type" => 'hydro', "y" => 867],
    "86" => ["x" => 934, "type" => 'default', "y" => 795],
    "87" => ["x" => 1056, "type" => 'backward', "y" => 835],
    "88" => ["x" => 1108, "type" => 'default', "y" => 925],
    "89" => ["x" => 1139, "type" => 'default', "y" => 1045],
    "90" => ["x" => 1122, "type" => 'default', "y" => 1165],
    "91" => ["x" => 1050, "type" => 'default', "y" => 1293],
];

class Room {
    private $players = [];
    private $status = 'wait'; // wait || play
    private $owner;
    private $id;
    private $winner = false;
    private $game = false;

    public function __construct($id, $player) {
        $this->owner = $player;
        $this->id = $id;
        $this->enter($player);
        $player->setRoom($this);
        $this->sendPlayersList();
    }

    public static function getInstance($id, $player) {
        return new Room($id, $player);
    }

    public function getID() {
        return $this->id;
    }

    public function onMsg($player, $msg) {
        if($msg['request'] == 'room/move' && $this->status == 'wait') {
            if(count($this->players) < 2) {
                $player->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'Not enougth players for start',
                ]);
                return;
            }

            if($this->owner->getID() != $player->getID()) {
                $player->sendMsg([
                    'nonce'     => $msg['nonce'],
                    'result'    => 'error',
                    'msg'       => 'You not owner of room',
                ]);
                return;
            }

            $player->sendMsg([
                'nonce'     => $msg['nonce'],
                'result'    => 'ok',
            ]);

            $players = [];

            foreach($this->players as $pl) {
                $players[] = $pl;
            }
            
            $this->status = 'play';
            $this->game = Game::getInstance($this, $players);
        }

        if($this->game != false) {
            $this->game->onMsg($player, $msg);
        }
    }

    public function onError($player) {
        unset($this->players[$player->getSocketID()]);
        if(count($this->players) == 0) {
            Server::getInstance()->removeRoom($this);
            return;
        }

        if($this->game != false) {
            $this->game->onError($player);
        }

        if($this->status == 'wait') {
            if($this->owner->getID() == $player->getID()) {
                foreach($this->players as $pl) {
                    $this->owner = $pl;
                    break;
                }

                $this->sendActive();
            }
        }

        // if($this->status == 'wait') {
        //     if($this->owner->getID() == $player->getID()) {
        //         foreach($this->players as $pl) {
        //             $this->owner = $pl;
        //             break;
        //         }
        //     }
        //     $this->sendPlayersList();
        //     return;
        // }

        // $need_change_active_players = false;
        // $player_key = false;

        // foreach($this->activePlayers as $key => $pl) {
        //     if($pl->getID() == $player->getID()) {
        //         $this->exitedPlayers[] = $player;
        //         unset($this->activePlayers[$key]);
        //         $need_change_active_players = true;
        //         $player_key = $key;
        //         break;
        //     }
        // }

        // if(!$need_change_active_players) 
        //     return;

        // $new_active_players = [];
        // foreach($this->activePlayers as $player) {
        //     $new_active_players[] = $player;
        // }

        // $this->activePlayers = $new_active_players;

        // if(count($this->activePlayers) == 0) {
        //     //TODO: рубим игру
        //     $this->status = 'wait';
        //     return;
        // }

        // if($player_key == $this->now_player_move) {
        //     if($this->now_player_move >= count($this->activePlayers)) {
        //         $this->now_player_move = 0;
        //     }
        // }

        // if($player_key < $this->now_player_move) {
        //     $this->now_player_move--;
        //     if($this->now_player_move < 0) 
        //         $this->now_player_move = count($this->activePlayers) - 1;
        // }

        // $this->sendPlayersList();
        // $this->sendPlayerMove();

        $this->sendPlayersList();
    }

    public function enter($player) {
        $this->players[$player->getSocketID()] = $player;

        $this->sendMarkers($player);

        if($this->game != false)
            $this->game->enter($player);

        // если игра активна отправить только активных игроков
        // иначе отправить всех в комнате
        $this->sendPlayersList();

        if($this->game == false) {
            $pos = [];
            foreach($this->players as $pl) {
                $pos[] = [
                    'id'        => $pl->getID(),
                    'position'  => 1,
                ];
            }
            foreach($this->players as $player) {
                $player->sendMsg([
                    'request'       => 'room/positions',
                    'positions'     => $pos,
                ]);
            }

            $this->sendActive();
        }
    }

    public function getName() {
        $names = [];
        foreach($this->players as $player) {
            $names[] = $player->getName();
        }

        return implode(', ', $names);
    }

    private function sendPlayersList() {
        // если игра активна отправить только активных игроков
        // иначе отправить всех в комнате
        $players = false;

        if($this->status != 'wait') {
            if($this->game != false) 
                $players = $this->game->getActivePlayers();
        }

        if($players == false)
            $players = $this->players;

        $players_list = [];

        foreach($players as $player) {
            $players_list[] = [
                'id'        => $player->getID(),
                'name'      => $player->getName(),
                'character' => $player->getCharacter(),
            ];
        }

        foreach($this->players as $player) {
            $player->sendMsg([
                'request'   => 'room/players',
                'players'   => $players_list,
            ]);
        }
    }

    private function sendActive() {
        foreach($this->players as $player) {
            $player->sendMsg([
                'request'   => 'room/active',
                'id'        => $this->owner->getID(),
            ]);
        }
    }

    public function onGameEnd($winner = false) {
        $this->status = 'wait';
        $this->game = false;
        $this->sendPlayersList();

        if($this->winner != false)
            $this->setWinnerAsOwner($winner);
        $this->sendActive();
    }

    private function setWinnerAsOwner($winner) {
        $in_list = false;

        foreach($this->players as $player) {
            if($player->getID() == $winner->getID()) {
                $in_list = true;
                break;
            }
        }

        if($in_list) {
            $this->owner = $winner;
            return;
        }

        $this->owner = $this->players[0];
    }

    private function sendMarkers($player) {
        global $markers;
        $player->sendMsg([
            'request'   => 'room/markers',
            'markers'   => $markers,
        ]);
    }

    public function getPlayers() {
        return $this->players;
    }

    public function getMarkers() {
        global $markers;

        return $markers;
    }
}


?>