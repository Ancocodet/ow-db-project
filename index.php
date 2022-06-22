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

