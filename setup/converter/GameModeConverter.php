<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class GameModeConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $gameMode)
        {
            $this->insertGameMode($gameMode[0], $gameMode[1]);
        }

    }

    private function insertGameMode(string $name, int $teamSize) : bool
    {
        return $this->database->update("INSERT INTO gamemodes (name, team_size) VALUES ('$name', $teamSize);");
    }

}