<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class GameConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $game)
        {
            $this->insertGame($game[0], $game[1], $game[2], $game[3], $game[4]);
        }

    }

    private function insertGame(string $started, string $finished, int $winner, int $gameMode, int $map) : bool
    {
        return $this->database->update("INSERT INTO games (started, finished, winner, gamemode_id, map_id) VALUES ('$started', '$finished', $winner, $gameMode, $map);");
    }

}