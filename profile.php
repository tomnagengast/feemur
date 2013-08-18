<?

include ('core/init.inc.php');

// $user_info = fetch_user_info($_GET['uid']);
$user_info = fetch_user_info($_SESSION['uid']);

include ('core/nav.inc.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $user_info['firstname']; ?>'s Profile</title>
	</head>
	<body>
		<div>
			<?php

			if ($user_info === false){
				echo 'That user does not exist.';
				?>
				<p>Profile must be <a href="edit_profile.php">updated</a></p>
				<?php
			} else {
				?>
				<h1><?php echo $user_info['firstname']; ?> <?php echo $user_info['lastname']; ?></h1>
				<p>Username: <?php echo $user_info['username']; ?></p>
				<p>Gender: <?php echo ($user_info['gender'] == 1) ? 'Male' : 'Female'; ?></p>
				<p>Email: <?php echo $user_info['email']; ?></p>
				<p>Location: <?php echo $user_info['location']; ?></p>
				<p><?php echo $user_info['about']; ?></p>
				<p><a href="edit_profile.php">Update Profile</a></p>
				<?php
			}

			?>
		</div>
<?php
include ('core/footer.inc.php');
?>