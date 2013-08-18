<?php

include ('core/init.inc.php');

if (isset($_POST['email'], $_POST['location'], $_POST['about'])){
	$errors = array();

	if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false){
		$errors[] = 'The email address you entered is not valid.';
	}

	if (preg_match('#^[a-z0-9 ]+$#i', $_POST['location']) === 0){ 
		$errors[] = 'Your location must only contain a-z, 0-9 and spaces.';
	}

	// if new user, update profile, otherwise add the new profile to the databse.
	if (empty($errors)){

			if ($_POST['new_user'] == 1){ 
				$new = 'Profile Added.';
				add_profile($_POST['email'], $_POST['about'], $_POST['location']);
			} else {
				$new = 'Updated User.';
				set_profile_info($_POST['email'], $_POST['about'], $_POST['location']);
			}

	}

	$user_info = array(
		'email' 	=> htmlentities($_POST['email']),
		'about' 	=> htmlentities($_POST['about']),
		'location' 	=> htmlentities($_POST['location']),
	);
} else {
	$user_info = fetch_user_info($_SESSION['uid']);
}

include ('core/nav.inc.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<style type="text/css">
			form { margin: 10px 0px 0px; }
			form div { float:left; clear:both; margin:0px 0px 4px; }
			label { float:left; width:100px; }
			input[type='text'], textarea { float:left; width:400px; }
			input[type="submit"] { margin:10px 0px 0px 100px; }
		</style>
		<title>Edit Your Profile</title>
	</head>
	<body>
		<div>
			<?php 
			if (isset($errors) === false){
				echo 'Click update to confirm changes';
			} else if (empty($errors)) {
				echo 'Your profile has been updated';
			} else {
				echo '<ul><li>', implode('</li><li>', $errors), '</li></ul>';
			}

			if ($user_info === false){
				?>
				<p>Edit Profile<br /><br/></p>
				</div>
				<form action="" method="post">
					<div>
						<label for="username">Username:</label>
						<input type="text" name="email" id="email" value="<?php echo $_SESSION['username']; ?>" />
					</div>
					<div>
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" value="<?php echo $user_info['email']; ?>" />
					</div>
					<div>
						<label for="location">Location:</label>
						<input type="text" name="location" id="location" value="<?php echo $user_info['location']; ?>" />
					</div>
					<div>
						<label for="about">About Me:</label>
						<textarea name="about" id="about" rows="14" cols="50"><?php echo strip_tags($user_info['about']); ?></textarea>
					</div>
					<div>
						<input type="hidden" name="new_user" id="new_user" value="1" />
					</div>
					<div>
						<input type="submit" value="Update" />
					</div>
				</form>
				<div>
					<a href="http://crowddit.com/feemur/hoarding/t/one_eye/core/pocket/connect.php" class="btn btn-primary btn-large">Connect to Pocket</a>
				</div>

				<?php
			} else {
				?>

				</div>
				<form action="" method="post">
					<div>
						<label for="email">Email:</label>
						<input type="text" name="email" id="email" value="<?php echo $user_info['email']; ?>" />
					</div>
					<div>
						<label for="location">Location:</label>
						<input type="text" name="location" id="location" value="<?php echo $user_info['location']; ?>" />
					</div>
					<div>
						<label for="about">About Me:</label>
						<textarea name="about" id="about" rows="14" cols="50"><?php echo strip_tags($user_info['about']); ?></textarea>
					</div>
					<div>
						<input type="hidden" name="new_user" id="new_user" value="0" />
					</div>
					<div>
						<input type="submit" value="Update" />
					</div>
				</form>

				<div>
					<a href="http://crowddit.com/feemur/hoarding/t/one_eye/core/pocket/connect.php" class="btn btn-primary btn-large">Connect to Pocket</a>
				</div>
<?php
}
include ('core/footer.inc.php');
?>