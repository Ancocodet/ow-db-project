<?php

namespace Library;

class Database
{

    private $config;
    private $connection;

    public function __construct($json)
    {
        $this->config = json_decode($json, true);;
    }

    /**
     * @return bool
     */
    public function connect(): bool
    {
        $this->connection = mysqli_connect($this->config['hostname'], $this->config['username'],
            $this->config['password'], $this->config['database'], $this->config['port']);

        if(!$this->connection){
            return false;
        }
        return true;
    }

    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @return bool
     */
    public function is_connected()
    {
        return $this->connection != null;
    }

    public function update($statement) : bool
    {
        if(!$this->is_connected()){
            $this->connect();
        }

        return mysqli_query($this->connection, $statement);
    }

    public function query($statement) : array
    {
        if(!$this->is_connected()){
            $this->connect();
        }

        return mysqli_query($this->connection, $statement)->fetch_all();
    }

    public function multi_query($filename)
    {
        $commands = file_get_contents($filename);

        $lines = explode(";",$commands);
        foreach ($lines as $line)
        {
            $this->update($line);
        }
    }
}