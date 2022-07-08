<?php

use Library\Database;

class GameModeManager
{

    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll() : array{
        return $this->database->query('SELECT * FROM gamemodes ORDER BY id');
    }

}