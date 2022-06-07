<?php
abstract class Database
{
    private string $host = 'localhost';
    private string $dbname = 'basic_platformer_unity';
    private string $user = 'root';
    private string $pass = '';

    protected PDO $connection;

    public function DBConnect()
    {
        try
        {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            session_start();
        } catch(PDOException $pdoEx)
        {
            echo 'Connection failed: ' . $pdoEx->getMessage();
            die();
        }
    }
}