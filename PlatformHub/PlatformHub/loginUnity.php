<?php
require_once('Classes/UnityLoginController.Class.php');
$login = new UnityLoginController('users');

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

if($login->loginUser($username, $password))
{
    $_SESSION['user'] = $username;
}
?>