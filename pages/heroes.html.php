<?php

use Library\Entities\HeroEntity;
use Library\Enums\EHero;
use Library\Enums\ESkin;

$params = $_GET['params'] ?? [];
$pageName = 'Heroes';

$manager = new HeroManager($database);

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
                    <li><a href="/heroes" class="nav-link px-2 text-secondary">Heroes</a></li>
                    <li><a href="/games" class="nav-link px-2 text-white">Games</a></li>
                    <li><a href="/players" class="nav-link px-2 text-white">Players</a></li>
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
                $heroName = $_GET['params'][0];
                $heroId = $manager->getHeroId($heroName);
                if(!$heroId){
                    echo "<h2>Hero not found</h2>";
                    echo "<p>The Hero '<b>$heroName</b>' does not exists in our database</p>";
                }else{
                    $hero = new HeroEntity($database, $heroId);
                    echo sprintf("<h2>%s (%s)</h2>", $hero->getAttribute(EHero::$NAME), $hero->getAttribute(EHero::$CLASS));
                    echo sprintf("<p>%s</p><br>", $hero->getAttribute(EHero::$DESCRIPTION));

                    echo "<h4>Skins</h4>";
                    $table_head = ['#', 'Name', 'Rarity'];
                    $result = array();
                    $counter = 0;
                    foreach ($hero->getSkins() as $skin) {
                        if(!$skin->exists())
                            continue;

                        $counter++;
                        $skinValues = [
                                $counter,
                                $skin->getAttribute(ESkin::$NAME)
                        ];

                        if($skin->getAttribute(ESkin::$RARITY) == 0){
                            $skinValues[] = "Common";
                        }else if($skin->getAttribute(ESkin::$RARITY) == 1){
                            $skinValues[] = "Rare";
                        }else if($skin->getAttribute(ESkin::$RARITY) == 2){
                            $skinValues[] = "Epic";
                        }else if($skin->getAttribute(ESkin::$RARITY) == 3){
                            $skinValues[] = "Legendary";
                        }

                        $result[] = $skinValues;
                    }
                    $table_elements = $result;
                    include_once __DIR__ . '/elements/table.html.php';
                }
            }
            else
            {
                $table_head = ['#', 'Name', 'Description', 'Class'];
                $result = $manager->getAll();
                for ($i = 0; $i < count($result); $i++) {
                    $name = $result[$i][1];
                    $result[$i][1] = "<a href='/heroes/$name'>$name</a>";
                }
                $table_elements = $result;
                include_once __DIR__ . '/elements/table.html.php';
            }
            ?>
        </div>
    </main>
</body>
</html>