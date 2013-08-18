<?

include ('core/init.inc.php');

?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Registered Users</title>
	</head>
	<body>
		<div><a href="index.php">Home</a>
			<?php

			foreach (fetch_users() as $user) {
				?>
				<p>
					<a href="profile.php?uid=<?php echo $user['id'];?>"><?php echo $user['id'] . ' ' . $user['username']; ?></a>
				</p>
				<?php
			}

			?>
		</div>
<?php
include ('core/footer.inc.php');
?>