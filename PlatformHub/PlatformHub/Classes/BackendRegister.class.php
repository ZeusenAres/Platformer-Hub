<?php
require_once 'Database.class.php';

class BackendRegister extends Database
{
    private string $table = 'users';

    public function CreateUser(string $user, string $password, string $repeatedPassword)
    {
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
}