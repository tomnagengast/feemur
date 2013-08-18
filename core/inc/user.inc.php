<?php

// checks if the given username exists in the database.
function user_exists($user){
	$user = mysql_real_escape_string($user);

	$total = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_name` = '{$user}'");

	return (mysql_result($total, 0) == '1') ? true : false;
}


// checks if the given username and password combiniation is valid.
function valid_credentials($user, $pass){
	$user = mysql_real_escape_string($user);
	$pass = mysql_real_escape_string($pass);

	$total = mysql_query("SELECT COUNT(`user_id`) FROM `users` WHERE `user_name` = '{$user}' AND `user_password` = '{$pass}'");

	return (mysql_result($total, 0) == '1') ? true : false;
}

// adds a user to the database.
// add_user($_POST['username'], $_POST['password']);
function add_user($user, $pass){
	$user = mysql_real_escape_string(htmlentities($user)); // no htmlentities on his script
	$pass = sha1($pass);

	mysql_query("INSERT INTO `users` (`user_name`, `user_password`) VALUES ('{$user}', '{$pass}')");
}

// set the time of the most recent view of the Dashboard.
function last_update($time, $user){
	mysql_query("UPDATE  `feemur`.`users` SET  `last_update` =  '{$time}' WHERE  `users`.`user_name` = '{$user}' LIMIT 1 ;");
}

function update_links($row, $user){

	$item_id = $row['item_id'];
	$resolved_id = $row['resolved_id'];
	$given_url  = $row['given_url'];
	$given_title = $row['given_title'];
	$favorite = $row['favorite'];
	$status = $row['status'];
	$time_added = $row['time_added'];
	$time_updated = $row['time_updated'];
	$time_read = $row['time_read'];
	$time_favorited = $row['time_favorited'];
	$sort_id = $row['sort_id'];
	$resolved_title = $row['resolved_title'];
	$resolved_url = $row['resolved_url'];
	$excerpt = $row['excerpt'];
	$is_article = $row['is_article'];
	$is_index = $row['is_index'];
	$has_video = $row['has_video'];
	$has_image = $row['has_image'];
	$word_count = $row['word_count'];
	$user_id = $_SESSION['uid'];

	// $saved = 1;


	$result = mysql_query("SELECT `last_update` FROM `users` WHERE `user_name` = '{$user}' LIMIT 1");
	$last_update = mysql_fetch_row($result);

	// detectes all links that have been added since the last import and adds them to the database
	// change to get links base on the current time
	$works = 'no update';

	// if the link exists and is owned by another user : UPDATE ++ saved;
	// if the link exists and is owned by the same user : do nothing;
	// if the link doesnt exist : INSERT

	if ($last_update[0] < $time_added){ 

		$link_result = mysql_query("SELECT `count` FROM `links` WHERE `resolved_url` = '{$resolved_url}' LIMIT 1");
		$update = mysql_fetch_row($link_result);

		if ($update[0] != '') {
			$saved = ++$update[0];

			$sql = 	"UPDATE `links` SET 
							`count` = '{$saved}'
					WHERE 	`resolved_url` = '{$resolved_url}'";
		} else {
			$sql = 	"INSERT INTO `feemur`.`links` (
							`item_id` ,
							`resolved_id` ,
							`given_url` ,
							`resolved_title` ,
							`resolved_url` ,
							`given_title` ,
							`favorite` ,
							`status` ,
							`time_added` ,
							`time_updated` ,
							`time_read` ,
							`time_favorited` ,
							`sort_id` ,
							`excerpt` ,
							`is_article` ,
							`is_index` ,
							`has_video` ,
							`has_image` ,
							`word_count` ,
							`user_id` ,
							`count`
						)
						VALUES (
							'{$item_id}' ,
							'{$resolved_id}' ,
							'{$given_url}' ,
							'{$resolved_title}' ,
							'{$resolved_url}' ,
							'{$given_title}' ,
							'{$favorite}' ,
							'{$status}' ,
							'{$time_added}' ,
							'{$time_updated}' ,
							'{$time_read}' ,
							'{$time_favorited}' ,
							'{$sort_id}' ,
							'{$excerpt}' ,
							'{$is_article}' ,
							'{$is_index}' ,
							'{$has_video}' ,
							'{$has_image}' ,
							'{$word_count}' ,
							'{$user_id}' ,
							'1'
						);";
		
		}

		mysql_query($sql);

		$works = 'updated';
	}
	return $update[0];
}

// displays all the links that have been saved more than once.
function show_links(){
	$result = mysql_query('SELECT * FROM `links` WHERE `count` > 1');

	$links = array();

	while(($row = mysql_fetch_assoc($result)) !== false){
		$links[] = $row;
	}

	return $links;
}


//	fetches the $uid
function fetch_user_id($username){
    $sql = "SELECT * FROM `users` WHERE `user_name` = '$username'";

    $row = mysql_fetch_array(mysql_query($sql));

    $uid = $row['user_id'];
    return $uid;
}
		 
// fetches all of the users from the table.
function fetch_users(){
	$result = mysql_query('SELECT `user_id` AS `id`, `user_name` AS `username` FROM `users`');

	$users = array();

	while(($row = mysql_fetch_assoc($result)) !== false){
		$users[] = $row;
	}

	return $users;
}

// fetches profile information for the given user.
function fetch_user_info($uid){
	$uid = (int)$uid;

	$sql = "SELECT
				`user_username` AS `username`,
				`user_firstname` AS `firstname`,
				`user_lastname` AS `lastname`,
				`user_email` AS `email`,
				`user_about` AS `about`,
				`user_location` AS `location`,
				`user_gender` AS `gender`
			FROM `profiles`
			WHERE `user_id` = {$uid}";

	$result = mysql_query($sql);

	return mysql_fetch_assoc($result);
}

// updates the current users profile info.
function set_profile_info($email, $about, $location){
	$email 		= mysql_real_escape_string(htmlentities($email));
	$about 		= mysql_real_escape_string(nl2br(htmlentities($about)));
	$location 	= mysql_real_escape_string($location);

	$sql = "UPDATE 	`profiles` SET 
				`user_email` = '{$email}',
				`user_about` = '{$about}',
				`user_location` = '{$location}'
			WHERE `user_id` = {$_SESSION['uid']}";

	mysql_query($sql);
}

// create a new profile for a user
function add_profile($email, $about, $location){
	$sess_id = 'zip';

	$sql = "UPDATE 	`profiles` SET 
				`user_email` = '{$email}',
				`user_about` = '{$about}',
				`user_location` = '{$location}'
			WHERE `user_id` = {$_SESSION['uid']}";

	$sql = "INSERT INTO `feemur`.`profiles` (
				`user_id`, 
				`user_username`, 
				`user_firstname`, 
				`user_lastname`, 
				`user_email`, 
				`user_about`, 
				`user_location`, 
				`user_gender`
				) 
			VALUES ('{$_SESSION['uid']}', 
				'{$_SESSION['username']}', 
				'', 
				'', 
				'{$email}', 
				'{$about}', 
				'{$location}', 
				'1'
				)";


	mysql_query($sql);
}

// add a users pocket account to their profile and download all articles in the past month
function add_pocket($access_pocket){
	$sql = "INSERT INTO  `feemur`.`social` (
					`user_id` ,
					`user_pocket` ,
					`user_facebook` ,
					`user_twitter` ,
					`user_google`
					)
					VALUES (
					'{$_SESSION['uid']}',  '$access_pocket',  '',  '',  ''
					)";

	mysql_query($sql);
}

function strstr_after($haystack, $needle, $case_insensitive = false) {
    $strpos = ($case_insensitive) ? 'stripos' : 'strpos';
    $pos = $strpos($haystack, $needle);
    if (is_int($pos)) {
        return substr($haystack, $pos + strlen($needle));
    }
    // Most likely false or null
    return $pos;
}

//	fetches the $uid
function access_pocket($uid){
    $sql = "SELECT * FROM `social` WHERE `user_id` = '$uid'";

    $row = mysql_fetch_array(mysql_query($sql));

    $pocket = $row['user_pocket'];
    return $pocket;
}

?>