<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class MapConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $map)
        {
            $this->insertMap($map[0], $map[1]);
        }

    }

    private function insertMap(string $name, string $location) : bool
    {
        return $this->database->update("INSERT INTO maps (name, location) VALUES ('$name', '$location');");
    }

}