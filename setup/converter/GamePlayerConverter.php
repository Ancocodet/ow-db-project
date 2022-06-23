<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class GamePlayerConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $gamePlayer)
        {
            $this->insertGamePlayer($gamePlayer[0], $gamePlayer[1], $gamePlayer[2], $gamePlayer[3]);
        }

    }

    private function insertGamePlayer(int $team, int $player, int $game, int $skin) : bool
    {
        return $this->database->update("INSERT INTO game_player (team, player_id, game_id, skin_id) VALUES ($team, $player, $game, $skin);");
    }

}