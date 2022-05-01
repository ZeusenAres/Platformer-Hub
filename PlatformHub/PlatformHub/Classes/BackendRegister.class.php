<?php
require_once 'Database.class.php';

class BackendRegister extends Database
{
    private string $table = 'users';

    public function CreateUser(string $user, string $password, string $repeatedPassword)
    {
        $this->ValidateFields($user, $password, $repeatedPassword);
        $this->ValidateUsername($user);
        $this->ValidatePassword($password);
        $this->ValidateRepeatedPassword($password, $repeatedPassword);
        $this->CheckIfUserExists($user);

        $statement = $this->connection->prepare("INSERT INTO $this->table (username, password) values (:username, :password)");
        $statement->execute([
            ":username" => trim($user),
            ":password" => password_hash(trim($password), PASSWORD_DEFAULT)
        ]);
    }

    private function CheckIfUserExists(string $user)
    {
        $statement = $this->connection->prepare("select username from $this->table where username = :username");
        $statement->execute([":username" => $user]);
        if ($statement->fetch())
        {
            echo "User already exists" . PHP_EOL;
        }
        else
        {
            echo 'created';
        }
    }

    private function ValidateUsername($username)
    {
        if($username == null)
        {
            echo "Username is required" . PHP_EOL;
        }
    }

    private function ValidatePassword($password)
    {
        if($password == null)
        {
            echo "Password is required" . PHP_EOL;
        }
    }

    private function ValidateRepeatedPassword($password, $repeatedPassword)
    {
        if($password != $repeatedPassword)
        {
            echo "Passwords must match" . PHP_EOL;
        }
    }

    private function ValidateFields($username, $password, $repeatedPassword)
    {
        if($username == null && $password == null && $repeatedPassword == null)
        {
            echo 'Please fill in the required fields' . PHP_EOL;
        }
    }
}