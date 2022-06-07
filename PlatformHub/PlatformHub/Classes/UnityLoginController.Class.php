<?php
require_once('Database.Class.php');

class UnityLoginController extends Database
{
    public function __construct(string $table = '')
    {
        parent::__construct();
        $this->table = $table;
    }

    public function loginUser(string $username, string $password)
    {
        $this->isUsernameEmpty($username);
        $this->isPasswordEmpty($password);
        $this->checkPassword($username, $password);

        die('welcome') . PHP_EOL;
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

    private function checkPassword(string $username, string $password)
    {
        $statement = $this->connection->Prepare("select password from $this->table where username like :username");
        $statement->execute([
              ":username" => $username
            ]);

        $result = $statement->fetch();
        password_verify($password, $result['password']) ? true : die('Invalid username or password');
    }
}