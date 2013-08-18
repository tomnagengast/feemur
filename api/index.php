<?
session_start();
require("lib.php");
require("api.php");
require("../core/inc/user.inc.php");

header("Content-Type: application/json");

switch ($_POST['command']) {

	case "submitlinks":
		// submitlinks($_SESSION['username'], $_POST['list']);
		submitlinks($_POST['list']);break;

	case "retrievelinks":
		retrievelinks();break;

	case "login": 
		login($_POST['username'], $_POST['password']); break;

	// case "currentUser":
	// 	currentUser();break;
 
	case "register":
		register($_POST['username'], $_POST['password']); break;

	// case "upload":
	// 	upload($_SESSION['IdUser'], $_FILES['file'], $_POST['title']);break;

	// case "logout":
	// 	logout();break;

	// case "stream":
	// 	stream((int)$_POST['IdPhoto']);break;

	// case "postcomment":
	// 	postcomment($_SESSION['IdUser'], (int)$_POST['IdPhoto'], $_POST['comment']);break;	

	// case "retrievecomments":
	// 	retrievecomments((int)$_POST['IdPhoto']);break;

	case "test":
		test();break;
	 
}
exit();
?>
