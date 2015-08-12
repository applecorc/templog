<?php
	//session_start();
	include_once("include_files/db.inc.php");
	$station = $_REQUEST['Station'];
	$item = $_REQUEST['Item'];
	$temp = $_REQUEST['Temp'];
	$response = "";
	
	$db = new mysqli($db_server, $db_username, $db_password, $db_name);
	$sql = "INSERT INTO `TEMPS` (`Item`, `Temp`,`Unit`,`Station`,`Time`,`EnteredBy`,`IsOutOfRange`) VALUES ($item,$temp,12,$station,now(),1,0)";
	
	//echo $sql;
	if ($db->query($sql) === TRUE) {
		//$response = $db->insert_id;
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'index.php';  // change accordingly
		header("Location: http://$host$uri/$extra");
		exit;
	}
	else {
	 $reponse = 'Error: '. $db->error;
	}
	$db->close();
	echo $response;
	/*
	$response = "";
	$db = new mysqli($db_server, $db_username, $db_password, $db_name);
	$sql = "INSERT INTO `comments` (`user_id`, `post_id`, `description`, `created`)
 VALUES ('$user', '$post_id', '$desc', NOW())";//SELECT id, description, user_id FROM posts";
	
	print_r($_REQUEST);*/
?>