<?php
require_once('config.php');
/* read the docs!
	by default, I'm just returning the 5 most recent
	pocket items.
	read more here: http://getpocket.com/developer/docs/v3/retrieve
 */
	// $url = 'https://getpocket.com/v3/get?count=5';
	// $url = 'https://getpocket.com/v3/get?count=1';
	// $url = 'https://getpocket.com/v3/get?favorite=1';
	$url = 'https://getpocket.com/v3/get';
$data = array(
	'consumer_key' => $consumer_key, 
	'access_token' => $access_token
);
$options = array(
	'http' => array(
		'method'  => 'POST',
		'content' => http_build_query($data)
	)
);
$context  = stream_context_create($options);
$result = file_get_contents($url, false, $context);
// var_dump($result);
// echo "</br></br>";

// $result = '{"foo": "bar", "cool": "attr"}';
$json_result = json_decode($result, true);
// var_dump($json_result);

// echo "</br></br> result: </br>";
$list = $json_result['list'];
$last = count($list) - 1;
?>