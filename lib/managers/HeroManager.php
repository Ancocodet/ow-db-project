<?php

use Library\Database;
use Library\Enums\EHero;

class HeroManager
{

    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll() : array{
        return $this->database->query('SELECT * FROM heroes ORDER BY id ASC');
    }

    public function getHeroId(string $name) : ?int {
        $result = $this->database->query("SELECT id FROM heroes WHERE name LIKE '$name' LIMIT 1");
        if(count($result) > 0){
            return $this->database->query("SELECT id FROM heroes WHERE name LIKE '$name' LIMIT 1")[0][EHero::$ID];
        }
        return null;
    }

}