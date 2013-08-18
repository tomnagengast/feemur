<?
function errorJson($msg){
	print json_encode(array('error'=>$msg));
	exit();
}

// function upload($id, $photoData, $title) {
// 	//check if a user ID is passed
// 	if (!$id) errorJson('Authorization required');
 
// 	//check if there was no error during the file upload
// 	if ($photoData['error']==0) {
// 		$result = query("INSERT INTO photos(IdUser,title) VALUES('%d','%s')", $id, $title);
// 		if (!$result['error']) {
 
// 			//inserted in the database, go on with file storage
// 			//database link
// 				global $link;
			 
// 				//get the last automatically generated ID
// 				$IdPhoto = mysqli_insert_id($link);
			 
// 				//move the temporarily stored file to a convenient location
// 				if (move_uploaded_file($photoData['tmp_name'], "upload/".$IdPhoto.".jpg")) {
// 					//file moved, all good, generate thumbnail
// 					thumb("upload/".$IdPhoto.".jpg", 180);
// 					print json_encode(array('successful'=>1));
// 				} else {
// 					errorJson('Upload on server problem');
// 				};
 
// 		} else {
// 			errorJson('Upload database problem.'.$result['error']);
// 		}
// 	} else {
// 		errorJson('Upload malfunction');
// 	}
// }

// function postcomment($id, $photo, $comment){
// 	//check if a user ID is passed
// 	if (!$id) errorJson('Authorization required');
	
// 	//submit the comment
// 	$result = query("INSERT INTO comments(IdPhoto, IdUser, comment) VALUES('%d','%d','%s')", $photo, $id, $comment);
// 	if (!$result['error']) {
// 		//handle successful comment
// 		print json_encode(array('successful'=>1));
// 	} else {
// 		errorJson('Unable to post comment'.$result['error']);
// 	}
// } 

// function retrievecomments($IdPhoto){
// 	if ($IdPhoto==0) {
// 		$result = query("SELECT IdPhoto, l.IdUser, username, comment, date FROM comments p JOIN login l ON (l.IdUser = p.IdUser) ORDER BY date ASC LIMIT 50");
// 	} else {
// 		$result = query("SELECT IdPhoto, l.IdUser, username, comment, date FROM comments p JOIN login l ON (l.IdUser = p.IdUser) WHERE p.IdPhoto='%d' ORDER BY date ASC LIMIT 50", $IdPhoto);
// 	}
 
// 	if (!$result['error']) {
// 		print json_encode($result);
// 	} else {
// 		errorJson('Photo stream is broken');
// 	}
// }	

function submitlinks($list) {
	$user = "zach";
	foreach ($list as $i => $row)
	{
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
	  

	$last_update = query("SELECT last_update FROM users WHERE user_name = '{$user}' LIMIT 1");

	// detectes all links that have been added since the last import and adds them to the database
	// change to get links base on the current time

	// if the link exists and is owned by another user : UPDATE ++ saved;
	// if the link exists and is owned by the same user : do nothing;
	// if the link doesnt exist : INSERT

	if ($last_update > $time_added){ 

		$update = query("SELECT count FROM links WHERE resolved_url = '{$resolved_url}' LIMIT 1");
		
		if ($update[0] != '') {
			$saved = $update;
			errorJson($saved[0]);
			$result = query("UPDATE links SET 
							count = '{$saved}'
							WHERE 	resolved_url = '{$resolved_url}'");
		} else {
	  			$result = query("INSERT INTO links(
								item_id ,
								resolved_id ,
								given_url ,
								resolved_title ,
								resolved_url ,
								given_title ,
								favorite ,
								status ,
								time_added ,
								time_updated ,
								time_read ,
								time_favorited ,
								sort_id ,
								excerpt ,
								is_article ,
								is_index ,
								has_video ,
								has_image ,
								word_count ,
								user_id ,
								count
							)
							VALUES (
								'$item_id' ,
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
							)");
			}
		}
	}

	if (!$result['error']) {
		//success
		print json_encode(array('successful'=>1));
	} else {
		//error
		errorJson('Submission failed');
	}
}

function register($user, $pass) {
	//check if username exists
	$login = query("SELECT user_name FROM users WHERE user_name='%s' limit 1", $user);
	if (count($login['result'])>0) {
		errorJson('Username already exists');
	}

	//try to register the user
	$user_password = sha1($pass);
	$result = query("INSERT INTO users(user_name, user_password) VALUES('%s','%s')", $user,$user_password);
	if (!$result['error']) {
		//success
		 login($user, $user_password);
	} else {
		//error
		errorJson('Registration failed');
	}
 
}

function login($user, $pass) {
	$pass = sha1($pass);
	$result = query("SELECT user_id, user_name FROM users WHERE user_name='%s' AND user_password='%s' limit 1", $user, $pass);
 
	if (count($result['result'])>0) {
		//authorized
		$_SESSION['IdUser'] = $result['result'][0]['IdUser'];
		print json_encode($result);
	} else {
		//not authorized
		errorJson('Authorization failed');
	}
}


function currentUser(){
	$result = query("SELECT username FROM login WHERE IdUser='%s' limit 1", $_SESSION['IdUser']);
	print json_encode($result);
}


function stream($IdPhoto=0) {
	if ($IdPhoto==0) {
		$result = query("SELECT IdPhoto, title, l.IdUser, username FROM photos p JOIN login l ON (l.IdUser = p.IdUser) ORDER BY IdPhoto DESC LIMIT 50");
	} else {
		$result = query("SELECT IdPhoto, title, l.IdUser, username FROM photos p JOIN login l ON (l.IdUser = p.IdUser) WHERE p.IdPhoto='%d' LIMIT 1", $IdPhoto);
	}
 
	if (!$result['error']) {
		print json_encode($result);
	} else {
		errorJson('Photo stream is broken');
	}
}

function logout() {
	$_SESSION = array();
	session_destroy();
}

function test(){
	errorJson('Test worked');
}
?>
