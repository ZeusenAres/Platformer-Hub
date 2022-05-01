<?php
require_once 'Classes/BackendRegister.class.php';

$db = new BackendRegister();
$db->DBConnect();

$username = $_POST['username'];
$password = $_POST['password'];
$repeatedPassword = $_POST['repeatedpassword'];

//$username = 'abse';
//$password = 'd';
//$repeatedPassword = 'd';

if($username == null)
{
    echo "Username is required" . PHP_EOL;
}

if($password == null)
{
    echo "Password is required" . PHP_EOL;
}

if($password != $repeatedPassword)
{
    echo "Passwords must match" . PHP_EOL;
}

if($username != null && $password && $repeatedPassword != null)
{
    $db->CreateUser($username, $password, $repeatedPassword);
}
else
{
    echo 'Please fill in the required fields' . PHP_EOL;
}
?>