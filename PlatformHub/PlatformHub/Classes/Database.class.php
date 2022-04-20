<?php
abstract class Database
{
    private string $host = 'localhost';
    private string $dbname = 'basic_platformer_unity';
    private string $user = 'root';
    private string $pass = '';
    private string $dsn;

    protected PDO $connection;

    public function DBConnect()
    {
        try
        {
            $this->connection = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->user, $this->pass);
            echo "<title>$this->dbname</title>";
            session_start();
        } catch(PDOException $pdoEx)
        {
            echo '<h1>Connection failed: ' . $pdoEx->getMessage() . '</h1>';
            die();
        }
    }
}