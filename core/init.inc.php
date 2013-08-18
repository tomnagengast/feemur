<?php 

session_start();

$exceptions = array('register', 'login');

$page = substr(end(explode('/' ,$_SERVER['SCRIPT_NAME'])), 0, -4);

// mysql connect and select_db

$path = dirname(__FILE__);

include("{$path}/inc/user.inc.php");


// If there is already a cooking on their machine, set the session variable to log them in
// and reset the cookies for another week
if (isset($_COOKIE['username'], $_COOKIE['password'])){
	if (valid_credentials($_COOKIE['username'], $_COOKIE['password'])){
		$_SESSION['username'] = htmlentities($_COOKIE['username']);

        setcookie('username', $_COOKIE['username'], time() + 604800);
        setcookie('password', $_COOKIE['password'], time() + 604800);
	}
}

// Redirects to the login page if the user is no logged in
// if (in_array($page, $exceptions) === false){
// 	if (isset($_SESSION['username']) === false){
// 		header('Location: login.php');
// 		die();
// 	}
// }
?>
