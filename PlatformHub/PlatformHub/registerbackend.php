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

$db->CreateUser($username, $password, $repeatedPassword);
?>