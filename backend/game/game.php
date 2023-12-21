<?php
$elements = [
    "furina" => "hydro",
    "charlotte" => "cryo",
    "wriothesley" => "cryo",
    "neuvillet" => "hydro",
    "kamisato-ayato" => "hydro",
    "sin-cyu" => "hydro",
    "bennet" => "pyro",
    "linney" => "pyro",
    "lynette" => "anemo",
    "fremine" => "cryo",
    "syan-lin" => "pyro",
    "nahida" => "dendro",
    "kamisato-ayaka" => "cryo",
    "keja" => "cryo",
    "hu-tao" => "pyro",
    "keh-cin" => "electro",
    "dilyuk" => "pyro",
    "rozariya" => "cryo",
    "kazuha" => "anemo",
    "toma" => "pyro",
    "saharoza" => "anemo",
    "baizhu" => "dendro",
    "kirara" => "dendro",
    "yaoyao" => "dendro",
    "kaveh" => "dendro",
    "barbara" => "hydro",
    "noehll" => "geo",
    "diona" => "cryo",
    "yanfehj" => "pyro",
    "liza" => "electro",
    "yelan" => "hydro",
    "kli" => "pyro",
    "dehya" => "pyro",
    "faruzan" => "anemo",
    "nilu" => "hydro",
    "dori" => "electro",
    "sayu" => "anemo",
    "kuki-sinobu" => "electro",
    "kandakia" => "hydro",
    "kokomi" => "hydro",
    "amber" => "pyro",
    "chun-yun" => "cryo",
    "shenh-he" => "cryo",
    "sin-yan" => "pyro",
    "venti" => "anemo",
    "nin-guan" => "geo",
    "gan-yuj" => "cryo",
    "albedo" => "geo",
    "mona" => "hydro",
    "chzhun-li" => "geo",
    "kollei" => "dendro",
    "tartalya" => "hydro",
    "tignari" => "dendro",
    "cyno" => "electro",
    "yae-miko" => "electro",
    "ci-ci" => "cryo",
    "mika" => "cryo",
    "syao" => "anemo",
    "dzhinn" => "anemo",
    "strannik" => "anemo",
    "behj-dou" => "electro",
    "rehjzor" => "electro",
    "fishl" => "electro",
    "syogun-rajdehn" => "electro",
    "yoimiya" => "pyro",
    "ehola" => "cryo",
    "sara-kudzyo" => "electro",
    "sikanoin-hehjdzo" => "anemo",
    "al-haitam" => "dendro",
    "layla" => "cryo",
    "arataki-itto" => "geo",
    "goro" => "geo",
    "yun-czin" => "geo",
];

class Game {
    private $room;
    private $players;
    private $exitedPLayers = [];
    private $nowPLayerMove = 0;
    private $winner = false;
    private $positions = [];
    private $skipping = [];
    private $endedPlayers = [];
    private $countMarkers = 0;
    
    public function __construct($room, $players) {
        $this->room = $room;
        $this->players = $players;
        $this->countMarkers = count($room->getMarkers());
        foreach($players as $player) {
            $this->positions[$player->getID()] = 1; 
            $this->skipping[$player->getID()] = 0; 
        }
        foreach($players as $player) {
            $this->sendPlayersPosition($player);
        }
    }

    public static function getInstance($room, $players) {
        return new Game($room, $players);
    }

    public function onMsg($player, $msg) {
        if($msg['request'] == 'room/move') {
            if($player->getID() != $this->players[$this->nowPLayerMove]->getID()) {
                return;
            }

            $this->movePlayer($player);

            $this->checkSkipping($player);
            $this->checkForwardMoves($player);
            $this->checkBackwardMoves($player);

            $this->checkPlayerEnd($player);
            if($this->checkEndGame()) {
                $this->players = false;
                $this->exitedPLayers = false;
                $this->positions = false;
                $this->skipping = false;
                $this->endedPlayers = false;
                $this->room->onGameEnd($this->winner);
                $this->room = false;
                return;
            }

            $this->calculateNextMovePlayer();

            $this->sendActive();
        }
    }

    private function checkPlayerEnd($player) {
        $id = $player->getID();

        if($this->positions[$id] < $this->countMarkers) {
            return;
        }

        $count = count($this->endedPlayers);

        $this->endedPlayers[$id] = $count;

        $players = $this->room->getPlayers();

        $text = $count == 0 ? $player->getName() . ' выиграл игру' : $player->getName() . ' закончил игру';

        foreach($players as $pl) {
            $pl->sendMsg([
                'request'   => 'msg/delayed',
                'text'      => $text,
                'type'      => 'green',
            ]);
        }

        if($count == 0) {
            $this->winner = $player;
        }
    }

    private function checkEndGame() {
        $count_ended = count($this->endedPlayers);
        $count_total = count($this->players);

        if($count_ended < ($count_total - 1))
            return false;

        $players = $this->room->getPlayers();
        $text = 'Игра окончена. Победитель ' . $this->winner->getName();

        foreach($players as $pl) {
            $pl->sendMsg([
                'request'   => 'msg/delayed',
                'text'      => $text,
                'type'      => 'green',
            ]);
        }

        return true;
    }
    
    private function checkForwardMoves($player) {
        $id = $player->getID();
        $need_move = false;
        $text = false;


        if($this->positions[$id] == 7) {
            $text = $player->getName() . ' получил благословение ветров - 2 шага вперед';
            $need_move = true;
        }
        if($this->positions[$id] == 24) {
            $text = $player->getName() . ' получил благословение Бей Доу - 2 шага вперед';
            $need_move = true;
        }
        if($this->positions[$id] == 44) {
            $text = $player->getName() . ' получил благословение Кокоми - 2 шага вперед';
            $need_move = true;
        }
        if($this->positions[$id] == 55) {
            $text = $player->getName() . ' получил благословение природы - 2 шага вперед';
            $need_move = true;
        }
        if($this->positions[$id] == 76) {
            $text = $player->getName() . ' получил благословение Ворукаши - 2 шага вперед';
            $need_move = true;
        }

        if(!$need_move)
            return;

        $this->positions[$id] += 2;

        $players = $this->room->getPlayers();

        foreach($players as $pl) {
            $pl->sendMsg([
                'request'   => 'msg/delayed',
                'text'      => $text,
                'type'      => 'green',
            ]);
            $pl->sendMsg([
                'request'       => 'room/move',
                'position'      => $this->positions[$id],
                'id'            => $id
            ]);
        }
    }

    private function checkBackwardMoves($player) {
        $id = $player->getID();
        $need_move = false;
        $text = false;


        if($this->positions[$id] == 28) {
            $text = $player->getName() . ' попал в бурю - 2 шага назад';
            $need_move = true;
        }
        if($this->positions[$id] == 38) {
            $text = $player->getName() . ' потерялся в тумане - 2 шага назад';
            $need_move = true;
        }
        if($this->positions[$id] == 67) {
            $text = $player->getName() . ' застрял в песке - 2 шага назад';
            $need_move = true;
        }
        if($this->positions[$id] == 87) {
            $text = $player->getName() . ' упал с куба - 2 шага назад';
            $need_move = true;
        }

        if(!$need_move)
            return;

        $this->positions[$id] -= 2;

        $players = $this->room->getPlayers();

        foreach($players as $pl) {
            $pl->sendMsg([
                'request'   => 'msg/delayed',
                'text'      => $text,
                'type'      => 'red',
            ]);
            $pl->sendMsg([
                'request'       => 'room/move',
                'position'      => $this->positions[$id],
                'id'            => $id
            ]);
        }
    }

    private function movePlayer($player) {
        $move = rand(1, 6);
        $id = $player->getID();

        $this->positions[$id] += $move;

        if($this->positions[$id] > 91)
            $this->positions[$id] = 91;

        $players = $this->room->getPlayers();

        $name = $player->getName();
        $text = 'Игрок ' . $name . ' выкинул кубик на ' . $move;
        

        foreach($players as $pl) {
            $pl->sendMsg([
                'request'   => 'msg',
                'text'      => $text,
                'type'      => 'blue',
            ]);
            $pl->sendMsg([
                'request'       => 'room/move',
                'position'      => $this->positions[$id],
                'id'            => $id
            ]);
        }
    }

    private function checkSkipping($player) {
        global $elements;
        $markers = $this->room->getMarkers();
        $pos = $this->positions[$player->getID()];
        
        if($markers[$pos]['type'] != $elements[$player->getCharacter()]) {
            return;
        }

        $this->skipping[$player->getID()]++;

        $players = $this->room->getPlayers();

        // $text1 = $player->getName() . ' наткнулся на ';
        $text1 = $player->getName() . ' наткнулся на ';

        switch($markers[$pos]['type']) {
            case 'geo':
                $text1 .= 'гео ' . $this->getRandomEnemy(['слайма', 'механизм','фатуи',]);
                break;
            case 'cryo':
                $text1 .= 'крио ' . $this->getRandomEnemy(['слайма','попрыгунью','мага бездны','весника','фатуи',]);
                break;
            case 'electro':
                $text1 .= 'электро ' . $this->getRandomEnemy(['слайм','мага бездны','фатуи',]);
                break;
            case 'anemo':
                $text1 .= 'анемо ' . $this->getRandomEnemy(['слайма','фатуи','глаз бури',]);
                break;
            case 'dendro':
                $text1 .= 'дендро ' . $this->getRandomEnemy(['слайма','плесенника',]);
                break;
            case 'pyro':
                $text1 .= 'пиро ' . $this->getRandomEnemy(['слайма','попрыгунью','мага бездны','весника','фатуи',]);
                break;
            case 'hydro':
                $text1 .= 'гидро ' . $this->getRandomEnemy(['слайма','мага бездны','весника','мимика',]);
                break;
        }

        $text1 .= ' и пропускает ход';

        foreach($players as $pl) {
            $pl->sendMsg([
                'request'   => 'msg/delayed',
                'text'      => $text1,
                'type'      => 'red',
            ]);
        }
    }

    private function getRandomEnemy($items) {
        $rand =  rand(0, count($items) - 1);

        return $items[$rand];
    }

    private function sendActive() {
        $id = $this->players[$this->nowPLayerMove]->getID();

        foreach($this->players as $player) {
            $player->sendMsg([
                'request'   => 'room/active',
                'id'        => $id,
            ]);
        }
    }

    private function calculateNextMovePlayer() {
        $this->nowPLayerMove++;
        if($this->nowPLayerMove >= count($this->players)) {
            $this->nowPLayerMove = 0;
        }

        if($this->skipping[$this->players[$this->nowPLayerMove]->getID()] > 0) {
            $this->skipping[$this->players[$this->nowPLayerMove]->getID()]--;
            $this->calculateNextMovePlayer();
            return;
        }

        if(isset($this->endedPlayers[$this->players[$this->nowPLayerMove]->getID()])) {
            $this->calculateNextMovePlayer();
        }
    }

    public function onError($player) {
        $need_change_active_players = false;
        $player_key = false;

        foreach($this->players as $key => $pl) {
            if($pl->getID() == $player->getID()) {
                $this->exitedPLayers[$player->getID()] = $player;
                unset($this->players[$key]);
                $need_change_active_players = true;
                $player_key = $key;
                break;
            }
        }

        if(count($this->players) < 2) {
            $this->room->onGameEnd();
            return;
        }

        if(!$need_change_active_players) 
            return;

        $new_active_players = [];
        foreach($this->players as $player) {
            $new_active_players[] = $player;
        }

        $this->players = $new_active_players;

        if($player_key == $this->nowPLayerMove) {
            if($this->nowPLayerMove >= count($this->players)) {
                $this->nowPLayerMove = 0;
            }
        }

        if($player_key < $this->nowPLayerMove) {
            $this->nowPLayerMove--;
            if($this->nowPLayerMove < 0) 
                $this->nowPLayerMove = count($this->players) - 1;
        }
    }

    public function enter($player) {
        if(isset($exitedPLayers[$player->getID()])) {
            unset($exitedPLayers[$player->getID()]);
            $this->players[] = $player;
        }

        $this->sendPlayersPosition($player);
    }

    public function getActivePlayers() {
        return $this->players;
    }

    public function sendPlayersPosition($player) {
        $pos = [];
        foreach($this->positions as $key => $position) {
            $pos[] = [
                'id'        => $key,
                'position'  => $position,
            ];
        }

        $player->sendMsg([
            'request'       => 'room/positions',
            'positions'     => $pos,
        ]);
    }
}

?>