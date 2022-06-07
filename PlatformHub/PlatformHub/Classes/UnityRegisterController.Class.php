<?php
require_once('Classes/Database.Class.php');

class UnityRegisterController extends Database
{
    public function __construct(string $table = '')
    {
        parent::__construct();
        $this->table = $table;
    }

    public function registerUser(string $username, string $password, string $repeatedPassword)
    {
        $this->isUsernameEmpty($username);
        $this->isPasswordEmpty($password);
        $this->isPasswordRepeated($password, $repeatedPassword);
        $this->userExists($username);

        $statement = $this->connection->prepare("insert into $this->table(username, password) values(:username, :password)");
        $statement->execute([
            ':username' => $username,
            ':password' => password_hash(trim($password), PASSWORD_DEFAULT)
            ]);

        if(!$statement->fetch)
        {
            die('created');
        }
    }

    private function isUsernameEmpty(string $username)
    {
        if(strlen(trim($username)) == null)
        {
            die('Please give up a username') . PHP_EOL;
        }
    }

    private function isPasswordEmpty(string $password)
    {
        if(strlen(trim($password)) == null)
        {
            die('Please give up a password') . PHP_EOL;
        }
    }

    private function isPasswordRepeated(string $password, string $repeatedPassword)
    {
        if($password != $repeatedPassword)
        {
            die('Passwords must match') . PHP_EOL;
        }
    }

    private function userExists(string $username)
    {
        $statement = $this->connection->prepare("select username from $this->table where username = :username");
        $statement->execute([
            ':username' => $username
            ]);

        if($statement->fetch())
        {
            die("User $username already exists") . PHP_EOL;
        }
    }
}