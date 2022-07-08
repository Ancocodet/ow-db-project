<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class GameConverter
{

    private Database $database;

    public function __construct(Database $database, $amount = 100)
    {
        $this->database = $database;

        $maps = $database->query("SELECT maps.id FROM maps ORDER BY id DESC");
        $gameModes = $database->query("SELECT gamemodes.id, gamemodes.team_size FROM gamemodes ORDER BY id DESC");

        for($i = 0; $i < $amount; $i++)
        {
            $gameMode = $gameModes[mt_rand(0, count($gameModes) - 1)];
            $map = $maps[mt_rand(0, count($maps) - 1)];

            $this->insertGame(rand(1, (10 / $gameMode[1])), $gameMode[0], $map[0]);
        }
    }

    private function insertGame(int $winner, int $gameMode, int $map) : bool
    {
        $startRandom = mt_rand(1640991600, 1657317599);
        $endRandom = mt_rand($startRandom + 300, $startRandom + 1500);

        $started = date('Y-m-d H:i:s', $startRandom);
        $finished = date('Y-m-d H:i:s', $endRandom);

        return $this->database->update("INSERT INTO games (started, finished, winner, gamemode_id, map_id) VALUES ('$started', '$finished', $winner, $gameMode, $map);");
    }

}