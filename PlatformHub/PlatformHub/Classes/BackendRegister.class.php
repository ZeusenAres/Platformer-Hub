<?php
require_once 'Database.class.php';

class BackendRegister extends Database
{
    private string $table = 'users';

    public function CreateUser(string $user, string $password, string $repeatedPassword)
    {
        $this->ValidateUser($user);
        $this->ValidatePassword($password);
        $this->ValidateRepeatedPassword($password, $repeatedPassword);
        $this->CheckIfUserExists($user);

        $statement = $this->connection->prepare("INSERT INTO $this->table (username, password) values (:username, :password)");
        $statement->execute([
            ":username" => trim($user),
            ":password" => password_hash(trim($password), PASSWORD_DEFAULT)
        ]);
    }

    private function ValidateUser(string $user)
    {
        if (strlen(trim($user)) == 0)
        {
            echo '[Geef een usernaam op]' . PHP_EOL;
        }
    }

    private function ValidatePassword(string $password)
    {
        if (strlen(trim($password)) == 0)
        {
            echo '[Geef een wachtwoord op]' . PHP_EOL;
        }
    }

    private function ValidateRepeatedPassword(string $password, string $repeatedPassword)
    {
        if (trim($password) != trim($repeatedPassword))
        {
            echo '[Wachtwoorden moeten hetzelfde zijn]' . PHP_EOL;
        }
    }

    private function CheckIfUserExists(string $user)
    {
        $statement = $this->connection->prepare("select username from $this->table where username = :username");
        $statement->execute([":username" => $user]);
        if ($statement->fetch() == 1)
        {
            echo "User $user already exists!" . PHP_EOL;
        }
    }
}