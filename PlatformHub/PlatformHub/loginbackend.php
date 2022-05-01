<?php
require_once 'Classes/BackendLogin.class.php';

$db = new BackendLogin();
$db->DBConnect();

$username = $_POST['username'];
$password = $_POST['password'];

$db->Login($username, $password);
?>