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

        if(file_exists('pages/'.$page) && is_dir('pages/'.$page)){
            $page .= '/'.array_shift($params);
        }
    }

    $_GET['path'] = $page;
    if(file_exists('pages/'.$page.'.html.php')){
        include_once 'pages/'.$page.'.html.php';
    } else if(file_exists('pages/'.$page.'.php')){
        include_once 'pages/'.$page.'.php';
    }
} else {
    include_once 'pages/welcome.html.php';
}

