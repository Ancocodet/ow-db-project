<?php

namespace Setup\Steps;

use Setup\IStep;

class FinishedStep implements IStep
{

    function runs(): int
    {
        return 0;
    }

    function run(): void
    {
        unlink('../.SETUP');
        session_destroy();
    }

    function showProgress(): bool
    {
        return true;
    }

    function getTemplate(?array $values): string
    {
        return '<h3>Die Einrichtung war erfolgreich</h3>'.
            '<span>Du wirst in Kürze wieder auf die Haupseite geleitet</span>';
    }

    function handleRequest(?array $values): void
    {
    }
}