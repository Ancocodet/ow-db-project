<?php

use Library\Entities\PlayerEntity;
use Library\Enums\EGame;
use Library\Enums\EPlayer;

$params = $_GET['params'] ?? [];
$pageName = 'Players';

$manager = new PlayerManager($database);
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
        <?php
        if(isset($_GET['params']) && count($_GET['params']) > 0)
        {
            $name = $_GET['params'][0];
            $player = new PlayerEntity($database, $name);
            if(!$player->exists()){
                echo "<h2>Player not found</h2>";
                echo "<p>The Player <b>$player</b> does not exists in our database</p>";
            }else{
                $prestige = "";
                for($i = 0; $i < $player->getAttribute(EPlayer::$PRESTIGE); $i++)
                {
                    $prestige .= '<svg xmlns="http://www.w3.org/2000/svg" width="2rem" height="2rem" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                   </svg>';
                }
                ?>
                <div class="row justify-content-around border-bottom">
                    <div class="col">
                        <?php
                        if($player->getAttribute(EPlayer::$PRESTIGE) > 0){
                            ?>
                            <h2><?php echo "$name ( ".$player->getAttribute(EPlayer::$LEVEL)." <span>".$prestige."</span> )"; ?></h2>
                        <?php
                        }else{
                            ?>
                            <h2><?php echo "$name ( ".$player->getAttribute(EPlayer::$LEVEL)." )"; ?></h2>
                        <?php
                        }
                        ?>
                    </div>
                </div><br>
                <?php
                echo "<div class='row'>";
                include_once __DIR__ . '/elements/table_builder.php';

                $table_head = ['#', 'Start', 'End', 'Winner', 'Map', 'GameMode'];
                $games = $manager->getGamesByPlayer($player->getAttribute(EPlayer::$NICKNAME));

                for($i = 0; $i < count($games); $i++)
                {
                    $game_id = $games[$i][EGame::$ID];
                    $games[$i][EGame::$ID] = "<a href='/games/$game_id'>$game_id</a>";
                }

                $builder = new TableBuilder($table_head, $games);
                echo $builder->build();

                echo "</div>";
            }
        }
        else
        {
            ?>
            <div class="row justify-content-around border-bottom">
                <div class="col">
                    <h2>Players</h2>
                </div>
                <div class="col">
                    <a class="btn btn-primary" href="/create/player">Create</a>
                </div>
            </div><br>
            <?php
            $table_head = ['#', 'NickName', 'Level', 'Prestige'];
            $result = $manager->getAll();
            for ($i = 0; $i < count($result); $i++) {
                $nickname = $result[$i][EPlayer::$NICKNAME];
                $result[$i][EPlayer::$NICKNAME] = "<a href='/players/$nickname'>$nickname</a>";
            }
            $table_elements = $result;
            include_once __DIR__ . '/elements/table.html.php';
        }
        ?>
    </div>
</main>
</body>
</html>