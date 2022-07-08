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

    public function __construct(Database $database, int $id)
    {
        $this->database = $database;
        $this->id = $id;

        $this->initializeEntity();
    }

    private function initializeEntity()
    {
        $result = $this->database->query("SELECT game_player.team, players.nickname, skins.name, heroes.name FROM game_player, players, skins, heroes WHERE game_player.id = $this->id 
                                                    AND game_player.player_id = players.id AND game_player.skin_id = skins.id AND skins.hero_id = heroes.id 
                                                    LIMIT 1");

        if(count($result) <= 0){
            return;
        }

        $this->exists = true;
        $this->data = $result[0];
    }

    public function exists() : bool
    {
        return $this->exists;
    }

    public function getAttribute($name)
    {
        return $this->data[$name];
    }

}