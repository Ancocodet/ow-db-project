<?php

namespace Library\Entities;

include_once 'lib/enums/EGame.php';
include_once 'lib/entities/GameModeEntity.php';
include_once 'lib/entities/MapEntity.php';

use Library\Database;
use Library\Enums\EGame;
use Library\Enums\EGamePlayer;

class GameEntity
{

    private Database $database;
    private int $id;
    private bool $exists = false;

    private array $data;

    private GameModeEntity $gameMode;
    private MapEntity $map;
    private array $players;

    public function __construct(Database $database, int $id)
    {
        $this->database = $database;
        $this->id = $id;

        $this->initializeEntity();
    }

    private function initializeEntity()
    {
        $result = $this->database->query("SELECT games.id, games.started, games.finished, games.winner, maps.name, gamemodes.name FROM games,maps,gamemodes WHERE games.id = $this->id AND maps.id = games.id AND games.gamemode_id = gamemodes.id LIMIT 1");

        if(count($result) <= 0){
            return;
        }

        $this->exists = true;
        $this->data = $result[0];

        $this->searchPlayers();
    }

    public function searchPlayers()
    {
        $result = $this->database->query("SELECT * FROM game_player WHERE game_id = $this->id");

        if(count($result) <= 0){
            return;
        }

        $this->players = array();

        foreach ($result as $player)
        {
            $this->players[] = new PlayerEntity($this->database, $player[EGamePlayer::$ID]);
        }

    }

    public function exists() : bool
    {
        return $this->exists;
    }

    public function getPlayers() : array
    {
        return $this->players;
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }

}