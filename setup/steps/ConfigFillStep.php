<?php
namespace Setup\Steps;

use Setup\IStep;

class ConfigFillStep implements IStep
{

    public function runs(): int
    {
        return 1;
    }

    function run(): void
    {
        // TODO: Implement run() method.
    }

    function showProgress(): bool
    {
        return false;
    }

    function getTemplate(?array $values): string
    {
        return '<form method="post">'.
                    '<div class="input-group mb-3">'.
                        '<input type="text" class="form-control" id="hostname" name="hostname" value="localhost">'.
                        '<span class="input-group-text">:</span>'.
                        '<input type="number" class="form-control" id="port" name="port" maxlength="4" value="3306">'.
                    '</div>'.
                    '<div class="mb-3">'.
                        '<input type="text" class="form-control" id="database" name="database" placeholder="database">'.
                    '</div>'.
                    '<div class="row mb-3">'.
                        '<div class="col">'.
                            '<input type="text" class="form-control" id="username" name="username" placeholder="username">'.
                        '</div>'.
                        '<div class="col">'.
                            '<input type="password" class="form-control" id="password" name="password" placeholder="password">'.
                        '</div>'.
                    '</div>'.
                    '<button type="submit" class="btn btn-primary">Save and connect</button>'.
                '</form>';
    }

    function handleRequest(?array $values): void
    {
        if(isset($values['hostname']) && isset($values['port']) && isset($values['database']) && isset($values['username']) && isset($values['password'])){
            $json_array = [
                'hostname' => $values['hostname'],
                'port' => $values['port'],
                'database' => $values['database'],
                'username' => $values['username'],
                'password' => $values['password']
            ];
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/configs/mysql.json', json_encode($json_array, JSON_PRETTY_PRINT));

            $_SESSION['step'] += 1;
            $_SESSION['progress'] += 1;
        }
    }

}