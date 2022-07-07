<?php
namespace Setup\Steps;

use Library\Database;
use Setup\Converter\GameConverter;
use Setup\Converter\GameModeConverter;
use Setup\Converter\GamePlayerConverter;
use Setup\Converter\HeroConverter;
use Setup\Converter\MapConverter;
use Setup\Converter\PlayerConverter;
use Setup\Converter\SkinConverter;
use Setup\FileReader;
use Setup\IStep;

class EntryCreationStep implements IStep
{

    public function runs(): int
    {
        return 7;
    }

    function run(): void
    {
        if(!isset($_SESSION['creation'])){
            $_SESSION['creation'] = 0;
        }

        $database = new Database(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/configs/mysql.json'));
        $currentCreation = $_SESSION['creation'] ?? 0;

        switch ($currentCreation){
            case 0:
                new PlayerConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/players.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 1:
                new HeroConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/heroes.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 2:
                new SkinConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/skins.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 3:
                new MapConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/maps.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 4:
                new GameModeConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/gamemodes.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 5:
                new GameConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/games.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 6:
                new GamePlayerConverter($database, new FileReader($_SERVER['DOCUMENT_ROOT'].'/setup/data/game_players.csv'));
                $_SESSION['step'] += 1;
                $_SESSION['progress'] += 1;
                break;
        }
    }

    function showProgress(): bool
    {
        return true;
    }

    function getTemplate(?array $values): string
    {
        $currentCreation = $_SESSION['creation'] ?? 0;
        switch ($currentCreation){
            case 0:
                return '<span>Player-entities are created</span>';
            case 1:
                return '<span>Hero-entities are created</span>';
            case 2:
                return '<span>Skin-entities are created</span>';
            case 3:
                return '<span>Map-entities are created</span>';
            case 4:
                return '<span>GameMode-entities are created</span>';
            case 5:
                return '<span>Game-entities are created</span>';
            case 6:
                return '<span>Relations are created</span>';
            default:
                return '<span>Entities are created</span>';
        }
    }

    function handleRequest(?array $values): void
    {
    }
}