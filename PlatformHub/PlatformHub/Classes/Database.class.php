<?php
class Database
{
    private string $host = 'localhost';
    private string $dbname = 'basic_platformer_unity';
    private string $username = 'root';
    private string $password = '';

    protected PDO $connection;

    protected string $table;

    public function __construct()
    {
        $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
    }
}