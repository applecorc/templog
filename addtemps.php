<?php
//TODO Add email functionality
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
include_once("include_files/access.inc.php");
$db = new mysqli($db_server, $db_username, $db_password, $db_name);

$station = Is_Set_Request('Station',$db);
$item = Is_Set_Request('Item',$db);
$temp = Is_Set_Request('Temp',$db);
$unit = Is_Set_Request('Unit',$db);
$user = $_SESSION['USER'];
$isOutOfRange = 0;

/* Check to see if the temp is out of range */ 
$query = "SELECT `Temp` FROM `ITEMS` WHERE `id` = '$item'";
$results = $db->query($query);
$result = $results->fetch_assoc();
$expectedTemp = $result['Temp'];
switch ($expectedTemp) {
	case 'Hot':
		if ($temp < 135.0) {
			echo "<div>Warning! Temperature is too cold.</div>\n<a href='temps.php'>Return to Temps</a>";
			$isOutOfRange = 1;
		}
	break;
	case 'Cold':
		if ($temp > 41.0) {
			echo "<div>Warning! Temperature is too warm.</div>\n<a href='temps.php'>Return to Temps</a>";
			$isOutOfRange = 1;
		}
	break;
	case 'Frozen':
		if ($temp > 25.0) {
			echo "<div>Warning! Temperature is too warm.</div>\n<a href='temps.php'>Return to Temps</a>";
			$isOutOfRange = 1;
		}
	break;
	default:
		echo "ERROR: AddTemp Expected Temp error: $expectedTemp";
}

/* Insert new temp into the temp table then take any necessary action */
$sql = "INSERT INTO `TEMPS` (`Item`, `Temp`,`Unit`,`Station`,`Time`,`EnteredBy`,`IsOutOfRange`) VALUES ($item,$temp,$unit,$station,now(),$user,$isOutOfRange)";
if ($db->query($sql) === TRUE) {
	if ($isOutOfRange === 1){
		/* If temp not in normal range email management */
		//Add email code here
		exit();
	} else {
		/* If temp in normal range redirect back to temps.php */
		$db->close();
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'temps.php';  // change accordingly
		header("Location: http://$host$uri/$extra");
		exit;
	}
} else {
	echo "Error: $sql AddTemp - " . $db->error ;
	$db->close();
}
?>
