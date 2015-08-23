<?php
//TODO Add everything
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
include_once("include_files/access.inc.php");
$db = new mysqli($db_server, $db_username, $db_password, $db_name);

$station = Is_Set_Request('Station',$db);
$name = Is_Set_Request('Name',$db);
$temp = Is_Set_Request('Temp',$db);
$meal = Is_Set_Request('Meal',$db);
$user = $_SESSION['USER'];

/* Insert new temp into the temp table then take any necessary action */
$sql = "INSERT INTO `ITEMS` (`Name`, `Temp`,`DefaultStation`,`AddedBy`,`Created`,`Meal`) VALUES ('$name','$temp',$station,$user,now(),'$meal')";
if ($db->query($sql) === TRUE) {
	$db->close();
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'items.php';  // change accordingly
	header("Location: http://$host$uri/$extra");
	exit;
} else {
	echo "Error: $sql AddTemp - " . $db->error;
	$db->close();
}
?>