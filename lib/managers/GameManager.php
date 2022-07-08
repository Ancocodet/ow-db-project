<?php

use Library\Database;
use Library\Entities\GameModeEntity;
use Library\Enums\EGameMode;

class GameManager
{
    private Database $database;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getAll() : array
    {
        return $this->database->query('SELECT games.id, games.started, games.finished, games.winner, maps.name, gamemodes.name FROM games, maps, gamemodes WHERE games.map_id = maps.id AND games.gamemode_id = gamemodes.id ORDER BY id');
    }

    public function createGame(int $map, int $mode) : int
    {
        $gameMode = new GameModeEntity($this->database, $mode);

        $start = round(microtime(true));
        $end = $start + mt_rand(300, 1500);

        $started = date('Y-m-d H:i:s', $start);
        $finished = date('Y-m-d H:i:s', $end);

        $winner = mt_rand(1, (10 / $gameMode->getAttribute(EGameMode::$TEAM_SIZE)));

        $this->database->update("INSERT INTO games (started, finished, winner, gamemode_id, map_id) VALUES ('$started', '$finished', $winner, $mode, $map);");
        $id = $this->database->query("SELECT games.id FROM games ORDER BY id DESC LIMIT 1")[0][0];

        $skins = $this->database->query("SELECT skins.id FROM skins ORDER BY id DESC");
        $players = $this->database->query("SELECT players.id FROM players ORDER BY id DESC");

        $team_number = 1;
        foreach(range(0, 9) as $playerNumber)
        {
            $randomPlayer = mt_rand(0, count($players) - 1);
            $player = $players[$randomPlayer];
            unset($players[$randomPlayer]);

            $this->insertGamePlayer($team_number, $player[0], $id, $skins[mt_rand(0, count($skins) - 1)][0]);

            if($gameMode->getAttribute(EGameMode::$TEAM_SIZE) == 5){
                if($team_number == 1){
                    $team_number = 2;
                }else{
                    $team_number = 1;
                }
            }else{
                $team_number++;
            }
        }
        return $id;
    }

    private function insertGamePlayer(int $team, int $player, int $game, int $skin) : bool
    {
        return $this->database->update("INSERT INTO game_player (team, player_id, game_id, skin_id) VALUES ($team, $player, $game, $skin);");
    }
}