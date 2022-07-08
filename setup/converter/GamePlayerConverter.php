<?php

namespace Setup\Converter;

use Library\Database;
use Setup\FileReader;

class GamePlayerConverter
{

    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;

        $games = $database->query("SELECT games.id, gamemodes.team_size FROM games, gamemodes WHERE games.gamemode_id = gamemodes.id ORDER BY id DESC");

        foreach ($games as $game)
        {
            $skins = $database->query("SELECT skins.id FROM skins ORDER BY id DESC");
            $players = $database->query("SELECT players.id FROM players ORDER BY id DESC");
            $team_number = 1;
            foreach(range(0, 9) as $playerNumber)
            {
                $randomPlayer = mt_rand(0, count($players) - 1);
                $player = $players[$randomPlayer];

                $this->insertGamePlayer($team_number, $player[0], $game[0], $skins[mt_rand(0, count($skins) - 1)][0]);

                if($game[1] == 5){
                    if($team_number == 1){
                        $team_number = 2;
                    }else{
                        $team_number = 1;
                    }
                }else{
                    $team_number++;
                }

                unset($players[$randomPlayer]);
            }
        }
    }

    private function insertGamePlayer(int $team, int $player, int $game, int $skin) : bool
    {
        return $this->database->update("INSERT INTO game_player (team, player_id, game_id, skin_id) VALUES ($team, $player, $game, $skin);");
    }

}