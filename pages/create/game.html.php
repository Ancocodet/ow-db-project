<?php

use Library\Enums\EGameMode;
use Library\Enums\EMap;

$params = $_GET['params'] ?? [];
$pageName = 'Create Game';

$manager = new GameManager($database);
$mapManager = new MapManager($database);
$modeManager = new GameModeManager($database);

if(isset($_POST['map']) && isset($_POST['mode']))
{
    if($_POST['map'] > 0 && $_POST['mode'] > 0)
    {
        $id = $manager->createGame($_POST['map'], $_POST['mode']);
        header("HTTP/1.1 307 Temporary Redirect");
        header("Location: /games/".$id);
        exit();
    }
}
?>
<html lang="en">
<head>
    <title>OW-DB | <?php echo $pageName; ?></title>
    <link type="text/css" rel="stylesheet" href="../dist/css/bootstrap.min.css">
    <script src="../dist/js/bootstrap.bundle.min.js"></script>

    <link rel="icon" href="../dist/images/favicon.ico">
</head>
<body class="bg-light w-100 h-100">
    <header class="p-3 bg-dark text-white">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="/welcome" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="/heroes" class="nav-link px-2 text-white">Heroes</a></li>
                    <li><a href="/games" class="nav-link px-2 text-white">Games</a></li>
                    <li><a href="/players" class="nav-link px-2 text-secondary">Players</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link px-2 text-white" href="#" id="others_dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Others
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="others_dropdown">
                            <li><a class="dropdown-item" href="/others/maps">Maps</a></li>
                            <li><a class="dropdown-item" href="/others/gamemodes">GameModes</a></li>
                        </ul>
                    </li>
                    <li><a href="https://github.com/Ancocodet/ow-db-project" class="nav-link px-2 text-white">Repository</a></li>
                </ul>
            </div>
        </div>
    </header>
    <main>
        <div class="container mt-5 mx-auto">
            <h2>Create Player</h2>
            <form action="/create/game" method="POST">
                <div class="mb-3">
                    <select name="map" class="form-select">
                        <option value="-1" selected disabled>Select a map</option>
                        <?php
                        foreach ($mapManager->getAll() as $map){
                            $mapId = $map[EMap::$ID];
                            $mapName = $map[EMap::$NAME];
                            echo "<option value='$mapId'>$mapName</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <select name="mode" class="form-select">
                        <option value="-1" selected disabled>Select a GameMode</option>
                        <?php
                        foreach ($modeManager->getAll() as $mode){
                            $modeId = $mode[EGameMode::$ID];
                            $modeName = $mode[EGameMode::$NAME];
                            echo "<option value='$modeId'>$modeName</option>";
                        }
                        ?>
                    </select>
                </div>
                <p>The players and result of the game will be randomized.</p>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </main>
</body>
</html>