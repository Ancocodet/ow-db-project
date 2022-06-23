<?php

include_once 'autoload.php';

if( file_exists(".SETUP") )
{
    header("HTTP/1.1 307 Temporary Redirect");
    header("Location: /setup");
    exit();
}

use Library\Database;

$database = new Database(file_get_contents('configs/mysql.json'));
if(isset($_GET['path'])){
    $params = explode('/', $_GET['path']);
    $page = array_shift($params);

    if(count($params) > 0){
        $_GET['params'] = $params;
    }

    $_GET['path'] = $page;
    include_once 'pages/'.$page.'.php';
} else {
    include_once 'pages/welcome.php';
}

