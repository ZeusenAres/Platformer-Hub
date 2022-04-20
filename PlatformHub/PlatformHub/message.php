<?php
require_once 'Classes/Register.class.php';

$db = new Register();
$db->DBConnect();
$db->getUsers();
?>