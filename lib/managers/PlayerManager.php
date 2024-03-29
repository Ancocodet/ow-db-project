<?php

use Library\Database;

class PlayerManager
{

    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll() : array
    {
        return $this->database->query('SELECT * FROM players ORDER BY id ASC');
    }

    public function createPlayer(string $nickname, int $level, int $prestige) : bool{
        return $this->database->update("INSERT INTO players (nickname, level, prestige) VALUES ('$nickname', $level, $prestige)");
    }

    public function getGamesByPlayer(string $nickname) : array
    {
        return $this->database->query("SELECT games.id, games.started, games.finished, games.winner, maps.name, gamemodes.name FROM players, game_player, games, gamemodes, maps WHERE players.nickname = '$nickname' 
                                            AND players.id = game_player.player_id 
                                            AND game_player.game_id = games.id AND games.gamemode_id = gamemodes.id AND games.map_id = maps.id ORDER BY id");
    }
}