<?php

include_once '../autoload.php';

if( ! file_exists("../.SETUP") )
{
    header("HTTP/1.1 307 Temporary Redirect");
    header("Location: /");
    exit();
}

session_start();
if(!isset($_SESSION['step'])) $_SESSION['step'] = 1;

?>

<html lang="en">
    <head>
        <title>Setup</title>
        <meta http-equiv="refresh" content="5;URL='<?php echo $_SERVER['PHP_SELF']; ?>'">
        <link type="text/css" rel="stylesheet" href="../dist/css/bootstrap.min.css">
        <script src="../dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body class="bg-light w-100 h-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col col-lg-8">
                    <div class="card my-5">
                        <div class="card-header">
                            Setup <?php echo $_SESSION['step'] ?? 1; ?>/X
                        </div>
                        <div class="card-body">
                            <span class="pb-3">Creating SQL-Databases</span>
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo ($_SESSION['progress'] ?? 0); ?>%" aria-valuenow="<?php echo ($_SESSION['progress'] ?? 0); ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
