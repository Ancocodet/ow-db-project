<?php

namespace Setup;

interface IStep
{

    function runs() : int;

    function run() : void;

    function showProgress() : bool;

    function getTemplate(?array $values) : string;

    function handleRequest(?array $values) : void;

}