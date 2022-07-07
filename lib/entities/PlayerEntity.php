<?php

namespace Library\Entities;

use Library\Database;
use Library\Enums\ESkin;

class PlayerEntity
{

    private Database $database;
    private string $name;
    private bool $exists = false;

    private array $data;

    public function __construct(Database $database, string $name)
    {
        $this->database = $database;
        $this->name = $name;

        $this->initializeEntity();
    }

    private function initializeEntity()
    {
        $result = $this->database->query("SELECT * FROM players WHERE nickname LIKE '$this->name' LIMIT 1");

        if(!$result || count($result) <= 0){
            return;
        }

        $this->exists = true;
        $this->data = $result[0];
    }

    public function exists() : bool
    {
        return $this->exists;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }

}