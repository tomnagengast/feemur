<?php
include ('../init.inc.php');

	$consumer_key = '';

	// path.to should be the URL where your web app is hosted.
	// eg. http://jshawl.com/callback.php
		// $path = dirname(__FILE__);
		// $redirect_uri = "{$path}/callback.php";
	$redirect_uri = 'http://feemur.com/core/pocket/callback.php';

	//don't edit this until you've authenticated with pocket. 
	 // access_token=22520d01-ae6f-2993-0ca5-564e0d
	$pocket_token = access_pocket($_SESSION['uid']);
	$access_token = $pocket_token;
?>
