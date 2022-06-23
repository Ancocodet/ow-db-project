<?php
namespace Setup\Steps;

use Library\Database;
use Setup\IStep;

class CreateTablesStep implements IStep
{

    public function runs(): int
    {
        return 1;
    }

    function run(): void
    {
        $database = new Database(file_get_contents('../configs/mysql.json'));
        if(!$database->is_connected()){
            $database->connect();
        }
        $result = mysqli_multi_query($database->getConnection(), file_get_contents('data/setup.sql'));

        if($result)
        {
            $_SESSION['step'] += 1;
            $_SESSION['progress'] += 1;
        }
    }

    function showProgress(): bool
    {
        return true;
    }

    function getTemplate(?array $values): string
    {
        return '<span>Tabellen werden erstellt</span>';
    }

    function handleRequest(?array $values): void
    {

    }

}