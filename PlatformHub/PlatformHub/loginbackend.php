<?php
require_once 'Classes/BackendLogin.class.php';

$db = new BackendLogin();
$db->DBConnect();

$username = $_POST['username'];
$password = $_POST['password'];

if($db->Login($username, $password))
{
    $_SESSION['user'] = $username;
}
?>