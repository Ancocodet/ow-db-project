<?php

namespace Library\Entities;

use Library\Database;

class MapEntity
{

    private Database $database;
    private int $id;
    private bool $exists = false;

    private array $data;

    public function __construct(Database $database, int $id)
    {
        $this->database = $database;
        $this->id = $id;
        $this->initializeEntity();
    }

    private function initializeEntity()
    {
        $result = $this->database->query("SELECT * FROM maps WHERE id = $this->id LIMIT 1");

        if(count($result) <= 0){
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