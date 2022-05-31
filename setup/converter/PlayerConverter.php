<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class PlayerConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $player)
        {
            $this->insertPlayer($player[0], $player[1], $player[2]);
        }

    }

    private function insertPlayer(string $nickname, int $level, int $prestige) : bool
    {
        return $this->database->update("INSERT INTO players (nickname, level, prestige) VALUES ('$nickname', $level, $prestige);");
    }

}