<?php
require_once('Classes/UnityRegisterController.Class.php');
$register = new UnityRegisterController('users');

$username = $_POST['username'];
$password = $_POST['password'];
$repeatPassword = $_POST['repeatPassword'];

$register->registerUser($username, $password, $repeatPassword);
?>