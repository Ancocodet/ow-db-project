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
        return '<h3>Setup completed</h3>'.
            '<span>You will be redirected back to the main page shortly</span>';
    }

    function handleRequest(?array $values): void
    {
    }
}