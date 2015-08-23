<?php
//TODO Add email functionality
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
include_once("include_files/access.inc.php");
$db = new mysqli($db_server, $db_username, $db_password, $db_name);

$temps = FALSE;
$station = FALSE;
$user = FALSE;
$temps = FALSE;
$unit = FALSE;
$inserts = array();

$station = Is_Set_Request('Station',$db);
$user = $_SESSION['USER'];

if(isset($_REQUEST['temp']) && !empty($_REQUEST['temp'])) {
	$temps = $_REQUEST['temp'];
}

if(Check_Admin_String('ChangeUnit',$_SESSION['ADMINLEVEL'])){ 
	$unit = Is_Set_Request('Unit',$db);
} else {
	$unit = $_SESSION['UNIT'];
}

if($station != FALSE && $user != FALSE && $unit != FALSE && $temps != FALSE){
	foreach($temps as $item => $temp) {
		if(is_numeric($item)) {
			$item = $db->real_escape_string($item);
		} else {
			$item = FALSE;
		}
		if(is_numeric($temp)) {
			$temp = $db->real_escape_string($temp);
		} else {
			$temp = FALSE;
		}
		if($temp !== FALSE && $item !== FALSE) {
			/* Check to see if the temp is out of range */ 
			$isOutOfRange = 0;
			$query = "SELECT `Temp` FROM `ITEMS` WHERE `id` = '$item'";
			$results = $db->query($query);
			$result = $results->fetch_assoc();
			$expectedTemp = $result['Temp'];
			switch ($expectedTemp) {
				case 'Hot':
					if ($temp < 135.0) {
						//echo "<div>Warning! Temperature is too cold.</div>\n<a href='temps.php'>Return to Temps</a>";
						$isOutOfRange = 1;
					}
				break;
				case 'Cold':
					if ($temp > 41.0) {
						//echo "<div>Warning! Temperature is too warm.</div>\n<a href='temps.php'>Return to Temps</a>";
						$isOutOfRange = 1;
					}
				break;
				case 'Frozen':
					if ($temp > 25.0) {
						//echo "<div>Warning! Temperature is too warm.</div>\n<a href='temps.php'>Return to Temps</a>";
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
					$insertId = $db->insert_id;
					$inserts[] = $insertId;
				}
			} else {
				echo "Error: $sql AddTemp - " . $db->error ;
			}
		}
	}
}
$db->close();

if(count($inserts)==0) {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'temps.php';  // change accordingly
	header("Location: http://$host$uri/$extra");
} else {
	$_SESSION['OORTemps'] = $inserts;
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'correctiveaction.php';  // change accordingly
	header("Location: http://$host$uri/$extra");
}

?>
