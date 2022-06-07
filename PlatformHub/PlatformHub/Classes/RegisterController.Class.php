<?php
require_once('Classes/Database.Class.php');

class RegisterController extends Database
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
    }

    private function isUsernameEmpty(string $username)
    {
        if(strlen(trim($username)) == 0 && strlen(trim($username)) == null)
        {
            throw new Exception('Please give up a username');
        }
    }

    private function isPasswordEmpty(string $password)
    {
        if(strlen(trim($password)) == 0 && strlen(trim($password)) == null)
        {
            throw new Exception('Please give up a password');
        }
    }

    private function isPasswordRepeated(string $password, string $repeatedPassword)
    {
        if($password != $repeatedPassword)
        {
            throw new Exception('Passwords must match');
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
            throw new Exception("User $username already exists");
        }
    }
}