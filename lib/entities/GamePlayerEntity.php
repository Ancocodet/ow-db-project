<?php

namespace Library\Entities;

use Library\Database;
use Library\Enums\EGamePlayer;

class GamePlayerEntity
{

    private Database $database;
    private int $id;
    private bool $exists = false;

    private array $data;
    private SkinEntity $skinEntity;
    private PlayerEntity $playerEntity;

    public function __construct(Database $database, int $id)
    {
        $this->database = $database;
        $this->id = $id;

        $this->initializeEntity();
    }

    private function initializeEntity()
    {
        $result = $this->database->query("SELECT * FROM game_player WHERE id = $this->id LIMIT 1");

        if(count($result) <= 0){
            return;
        }

        $this->exists = true;
        $this->data = $result[0];

        $this->skinEntity = new SkinEntity($this->database, $this->data[EGamePlayer::$SKIN_ID]);
        $this->playerEntity = new PlayerEntity($this->database, $this->data[EGamePlayer::$PLAYER_ID]);
    }

    public function exists() : bool
    {
        return $this->exists;
    }

    public function getSkin() : SkinEntity
    {
        return $this->skinEntity;
    }

    public function getPlayer() : PlayerEntity
    {
        return $this->playerEntity;
    }

}