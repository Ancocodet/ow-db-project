<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class HeroConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $hero)
        {
            $this->insertHero($hero[0], $hero[1], $hero[2]);
        }

    }

    private function insertHero(string $name, string $description, string $class) : bool
    {
        return $this->database->update("INSERT INTO heroes (name, description, class) VALUES ('$name', '$description', '$class');");
    }

}