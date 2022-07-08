<?php

namespace Library\Entities;

use Library\Database;
use Library\Enums\ESkin;

class HeroEntity
{

    private Database $database;
    private int $id;
    private bool $exists = false;

    private array $data;
    private array $skins;

    public function __construct(Database $database, int $id)
    {
        $this->database = $database;
        $this->id = $id;

        $this->initializeEntity();
    }

    private function initializeEntity()
    {
        $result = $this->database->query("SELECT * FROM heroes WHERE id = $this->id LIMIT 1");

        if(count($result) <= 0){
            return;
        }

        $this->exists = true;
        $this->data = $result[0];

        $this->searchSkins();
    }

    public function searchSkins()
    {
        $result = $this->database->query("SELECT id FROM skins WHERE hero_id = $this->id");

        if(count($result) <= 0){
            return;
        }

        $this->skins = array();

        foreach ($result as $skin)
        {
            $this->skins[] = new SkinEntity($this->database, $skin[0], false);
        }

    }

    public function exists() : bool
    {
        return $this->exists;
    }

    public function getSkins(): array
    {
        return $this->skins;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }
}