<?php

use Library\Database;

class GameManager
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll() : array
    {
        return $this->database->query('SELECT games.id, games.started, games.finished, games.winner, maps.name, gamemodes.name FROM games, maps, gamemodes WHERE games.map_id = maps.id AND games.gamemode_id = gamemodes.id ORDER BY id ASC');
    }

}