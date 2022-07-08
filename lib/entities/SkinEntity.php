<?php

namespace Library\Entities;

use Library\Database;
use Library\Enums\EHero;
use Library\Enums\ESkin;

class SkinEntity
{

    private Database $database;
    private int $id;
    private bool $exists = false;

    private array $data;
    private HeroEntity $heroEntity;

    public function __construct(Database $database, int $id, bool $recursive = true)
    {
        $this->database = $database;
        $this->id = $id;

        $this->initializeEntity($recursive);
    }

    private function initializeEntity(bool $recursive = true)
    {
        $result = $this->database->query("SELECT * FROM skins WHERE id = $this->id LIMIT 1");

        if(count($result) <= 0){
            return;
        }

        $this->exists = true;
        $this->data = $result[0];

        if($recursive)
            $this->heroEntity = new HeroEntity($this->database, ESkin::$HERO_ID);
    }

    public function exists() : bool
    {
        return $this->exists;
    }

    public function getHero() : ?HeroEntity
    {
        return $this->heroEntity;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }

}