<?php

include_once 'lib/Database.php';
include_once 'lib/entities/GameEntity.php';
include_once 'lib/enums/EGameMode.php';
include_once 'lib/enums/EMap.php';

use Library\Database;
use Library\Entities\GameEntity;
use Library\Enums\EGameMode;
use Library\Enums\EMap;

$database = new Database(file_get_contents('configs/mysql.json'));
$game = new GameEntity($database, 1);

if($game->exists()){
    echo "Game found <br>";

    echo "GameMode: " . $game->getGameMode()->getAttribute(EGameMode::$NAME) . "<br>";
    echo "Map: " . $game->getMap()->getAttribute(EMap::$NAME);
}else{
    echo "Game does not exists";
}
