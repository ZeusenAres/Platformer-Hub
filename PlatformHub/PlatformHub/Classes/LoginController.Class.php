<?php
require_once('Classes/Database.Class.php');

class LoginController extends Database
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
    }

    private function isUsernameEmpty(string $username)
    {
        if(strlen(trim($username)) == 0 || strlen(trim($username)) == null)
        {
            throw new Exception('Please give up a username');
        }
    }

    private function isPasswordEmpty(string $password)
    {
        if(strlen(trim($password)) == 0 || strlen(trim($password)) == null)
        {
            throw new Exception('Please give up a password');
        }
    }

    private function checkPassword(string $username, string $password) : bool
    {
        $statement = $this->connection->Prepare
                ("select password from $this->table where username like :username");
        $statement->execute([
              ":username" => $username
            ]);
        $result = $statement->fetch();
        return $result != null && password_verify($password,$result['password']);
    }
}