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

        $database = new Database(file_get_contents('../configs/mysql.json'));
        $currentCreation = $_SESSION['creation'] ?? 0;

        switch ($currentCreation){
            case 0:
                new PlayerConverter($database, new FileReader('data/players.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 1:
                new HeroConverter($database, new FileReader('data/heroes.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 2:
                new SkinConverter($database, new FileReader('data/skins.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 3:
                new MapConverter($database, new FileReader('data/maps.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 4:
                new GameModeConverter($database, new FileReader('data/gamemodes.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 5:
                new GameConverter($database, new FileReader('data/games.csv'));
                $_SESSION['creation'] += 1;
                $_SESSION['progress'] += 1;
                break;
            case 6:
                new GamePlayerConverter($database, new FileReader('data/game_players.csv'));
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
                return '<span>Spielereinträge werden erstellt</span>';
            case 1:
                return '<span>Heldeneinträge werden erstellt</span>';
            case 2:
                return '<span>Skineinträge werden erstellt</span>';
            case 3:
                return '<span>Mapeinträge werden erstellt</span>';
            case 4:
                return '<span>Spiemodieinträge werden erstellt</span>';
            case 5:
                return '<span>Gameeinträge werden erstellt</span>';
            case 6:
                return '<span>Relationen werden erstellt</span>';
            default:
                return '<span>Entitäten werden erstellt</span>';
        }
    }

    function handleRequest(?array $values): void
    {
    }
}