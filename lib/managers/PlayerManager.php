<?php

use Library\Database;

class PlayerManager
{

    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll() : array {
        return $this->database->query('SELECT * FROM players ORDER BY id ASC');
    }

}