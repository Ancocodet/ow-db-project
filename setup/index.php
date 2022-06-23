<?php

include_once('autoload.php');

use Setup\Steps\ConfigFillStep;
use Setup\Steps\CreateTablesStep;
use Setup\Steps\EntryCreationStep;
use Setup\Steps\FinishedStep;

if( ! file_exists("../.SETUP") )
{
    header("HTTP/1.1 307 Temporary Redirect");
    header("Location: /");
    exit();
}

session_start();
if(!isset($_SESSION['step']))
{
    $_SESSION['step'] = 0;
    $_SESSION['progress'] = 0;
}

$steps = array(new ConfigFillStep(), new CreateTablesStep(),
    new EntryCreationStep(), new FinishedStep());

if(isset($_GET['reset'])){
    $_SESSION['step'] = 0;
    $_SESSION['creation'] = 0;
    $_SESSION['progress'] = 0;
}

if(array_key_exists($_SESSION ['step'] ?? 0, $steps)){
    $step = $steps[$_SESSION ['step'] ?? 0];
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $step->handleRequest($_POST);
    }
}

function getRunAmount($steps){
    $amount = 0;
    foreach ($steps as $step){
        $amount += $step->runs();
    }
    return $amount;
}

?>

<html lang="en">
    <head>
        <title>Setup</title>
        <?php
        if(array_key_exists($_SESSION ['step'] ?? 0, $steps)){
            if($steps[$_SESSION ['step'] ?? 0]->showProgress())
            {
                echo '<meta http-equiv="refresh" content="5; URL='.$_SERVER['PHP_SELF'].'">';
            }
        }
        ?>
        <link type="text/css" rel="stylesheet" href="../dist/css/bootstrap.min.css">
        <script src="../dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="bg-light w-100 h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-lg-8">
                    <div class="card my-5">
                        <div class="card-header">
                            Setup <?php echo ($_SESSION['step'] ?? 0) + 1; ?>/<?php echo count($steps); ?>
                        </div>
                        <div class="card-body">
                            <?php
                            if(array_key_exists($_SESSION ['step'] ?? 0, $steps)){
                                echo $steps[$_SESSION ['step'] ?? 0]->getTemplate($_GET);
                                if($steps[$_SESSION ['step'] ?? 0]->showProgress())
                                {
                                    echo '<div class="progress">';
                                    echo '<div class="progress-bar" role="progressbar" style="width:'.(($_SESSION['progress'] / getRunAmount($steps)) * 100). '%" aria-valuenow="'.(($_SESSION['progress'] / getRunAmount($steps)) * 100).'" aria-valuemin="0" aria-valuemax="100"></div>';
                                    echo '</div>';
                                }
                                $steps[$_SESSION ['step'] ?? 0]->run();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
