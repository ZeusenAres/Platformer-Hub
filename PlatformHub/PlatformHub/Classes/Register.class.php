<?php
require_once 'Database.class.php';

class Register extends Database
{
    private string $table = 'users';

    public function CreateUser(string $user, string $password, string $repeatedPassword)
    {
        $this->ValidateUser($user);
        $this->ValidatePassword($password);
        $this->ValidateRepeatedPassword($password, $repeatedPassword);
        $this->CheckIfUserExists($user);

        $statement = $this->connection->prepare(
        "INSERT INTO $this->table (username, password) values (:username, :password)");
        $statement->execute([
            ":username" => trim($user),
             ":password" => password_hash(trim($password), PASSWORD_DEFAULT)
             ]);
    }

    private function CheckIfUserExists(string $user)
    {
        $statement = $this->connection->prepare("select username from $this->table where username=:username");
        $statement->execute([":username" => $user]);
        if ($statement->fetch() == 1)
        {
            throw new Exception("User $user bestaat al!");
        }
    }

    private function ValidateUser(string $user)
    {
        if (strlen(trim($user)) == 0)
        {
            throw new Exception('Geef een usernaam op');
        }
    }

    private function ValidatePassword(string $password)
    {
        if (strlen(trim($password)) == 0)
        {
            throw new Exception('Geef een wachtwoord op');
        }
    }

    private function CheckPassword(string $user, string $password) : bool
    {
        $statement = $this->connection->prepare
                ("select password from $this->table where username like :username");
        $statement->execute([
              ":username" => $user
            ]);
        $result = $statement->fetch();
        return $result != null && password_verify($password,$result['password']);
    }

    private function ValidateRepeatedPassword(string $password, string $repeatedPassword)
    {
        if (trim($password) != trim($repeatedPassword))
        {
            throw new Exception('Wachtwoorden moeten hetzelfde zijn');
        }
    }

    public function getUsers()
    {
        $statement = $this->connection->prepare("select * from $this->table where 1");
        $statement->execute();
        while($row = $statement->fetch())
        {
            echo ' Player ' . $row['username'] . ' has earned ' . $row['coins'] . ' coins |--|';
        }
    }
}