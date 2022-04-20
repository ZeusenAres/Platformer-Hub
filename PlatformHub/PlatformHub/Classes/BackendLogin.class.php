<?php
require_once 'Database.class.php';

class BackendLogin extends Database
{
    private string $table = 'users';

    public function Login(string $user, string $password)
    {
        $this->ValidateUser($user);
        $this->ValidatePassword($password);
        return $this->CheckPassword($user, $password);
    }

    private function ValidateUser(string $user)
    {
        if (strlen(trim($user)) == 0)
        {
            echo 'Geef een usernaam op';
        }
    }

    private function ValidatePassword(string $password)
    {
        if (strlen(trim($password)) == 0)
        {
            echo 'Geef een wachtwoord op';
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
}