<?php

namespace Setup;

class FileReader
{
    private array $data;

    public function __construct(string $filename)
    {
        $this->data = array_map('str_getcsv', file($filename));
    }

    public function getData() : array
    {
        return $this->data;
    }
}