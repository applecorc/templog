<?php
session_start();
include_once("include_files/db.inc.php");

if (isset($_REQUEST['name']) && isset($_REQUEST['password'])){
	$db = new mysqli($db_server, $db_username, $db_password, $db_name);
	$user = $db->real_escape_string($_REQUEST['name']);
	$pass = $db->real_escape_string($_REQUEST['password']);
	
	$query = "SELECT `Salt` FROM `USERS` WHERE `Username` = '$user'";
	$results = $db->query($query);
	if ($results->num_rows == 0){
		//$return = 1;
		echo "Error: Username/Password incorrect..";
	} else {
		//$return = 3;
		$result =  $results->fetch_assoc();
		$salt = $result['Salt'];
		$pass = $pass . $salt;
	}
	$query = "SELECT `id`,`FirstName`,`LastName`,`Unit`,`AdminLevel` FROM `USERS` WHERE `Username` = '$user' AND `Password`=sha2('$pass',256)";
	$results = $db->query($query);

	if ($results->num_rows == 0){
		echo "Error: Username/Password incorrect.";
	} else {
		//$return = 3;
		$result =  $results->fetch_assoc();
		$_SESSION['USER'] = $result['id'];
		$_SESSION['FIRSTNAME'] = $result['FirstName'];
		$_SESSION['LASTNAME'] = $result['LastName'];
		$_SESSION['UNIT'] = $result['Unit'];
		$_SESSION['ADMINLEVEL'] = $result['AdminLevel'];
		print_r($_SESSION);
		print_r(str_getcsv($_SESSION['ADMINLEVEL']));
	}
} else {
	//$return = 1;
}
$db->close();
//echo $return;
?>	