<?php

use Library\Entities\PlayerEntity;
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
                echo "<h2>$name (".$player->getAttribute(EPlayer::$LEVEL)."*".$player->getAttribute(EPlayer::$PRESTIGE).")</h2>";
                echo "<div class='row'>";
                $table = include_once 'pages/elements/table_builder.php';
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
                    <a class="btn btn-primary">Create</a>
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
            include_once 'pages/elements/table.html.php';
        }
        ?>
    </div>
</main>
</body>
</html>