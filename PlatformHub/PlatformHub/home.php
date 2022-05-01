<?php
require_once 'Classes/BackendLogin.class.php';
$server = new BackendLogin();
$server->DBConnect();
echo $server->getUsername();
?>