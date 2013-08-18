<?php

session_start();

$_SESSION = array();

session_destroy();

if (isset($_COOKIE['username'], $_COOKIE['password'])){
	setcookie('username', '', time());
	setcookie('password', '', time());
}

header('Location: index.php');

?>