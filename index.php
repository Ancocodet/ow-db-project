<?php

include_once 'autoload.php';

use Library\Database;

$database = new Database(file_get_contents('configs/mysql.json'));

