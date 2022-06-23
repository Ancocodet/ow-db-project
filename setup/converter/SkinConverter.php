<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class SkinConverter
{

    private Database $database;

    public function __construct(Database $database, FileReader $reader)
    {
        $this->database = $database;

        foreach ($reader->getData() as $skin)
        {
            $this->insertSkin($skin[0], $skin[1], $skin[2]);
        }

    }

    private function insertSkin(string $name, int $rarity, int $hero) : bool
    {
        return $this->database->update("INSERT INTO skins (name, rarity, hero_id) VALUES ('$name', $rarity, $hero);");
    }

}