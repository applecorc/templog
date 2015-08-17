<?php
	session_start();
	include_once("include_files/db.inc.php");
	$db = new mysqli($db_server, $db_username, $db_password, $db_name);
	
	$station = $db->real_escape_string($_REQUEST['Station']);
	$item = $db->real_escape_string($_REQUEST['Item']);
	$temp = $db->real_escape_string($_REQUEST['Temp']);
	$response = "";
	
	$sql = "INSERT INTO `TEMPS` (`Item`, `Temp`,`Unit`,`Station`,`Time`,`EnteredBy`,`IsOutOfRange`) VALUES ($item,$temp,12,$station,now(),1,0)";
	
	if ($db->query($sql) === TRUE) {
		$id = $db->insert_id;
		$query = "SELECT `Temp` FROM `ITEMS` WHERE `id` = '$item'";
		$results = $db->query($query);
		$result = $results->fetch_assoc();
		$expectedTemp = $result['Temp'];
		switch ($expectedTemp) {
			case 'Hot':
				if ($temp < 135.0) {
					echo "<div>Warning! Temperature is too cold.</div>\n<a href='temps.php'>Return to Temps</a>";
					$sql = "UPDATE `TEMPS` SET `IsOutOfRange`= TRUE WHERE `id`=$id";
					$db->query($query);
				}
				$db->close();
				exit;
			break;
			case 'Cold':
				if ($temp > 41.0) {
					echo "<div>Warning! Temperature is too warm.</div>\n<a href='temps.php'>Return to Temps</a>";
					$sql = "UPDATE `TEMPS` SET `IsOutOfRange`= TRUE WHERE `id`=$id";
					$db->query($query);
				}
				$db->close();
				exit;
			break;
			case 'Frozen':
				if ($temp > 25.0) {
					echo "<div>Warning! Temperature is too warm.</div>\n<a href='temps.php'>Return to Temps</a>";
					$sql = "UPDATE `TEMPS` SET `IsOutOfRange`= TRUE WHERE `id`=$id";
					$db->query($query);
				}
				$db->close();
				exit;
			break;
			default:
				echo "ERROR: Expected temp error $expectedTemp";
		}
		$db->close();
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'temps.php';  // change accordingly
		header("Location: http://$host$uri/$extra");
		exit;
	}
	else {
	 $reponse = 'Error: '. $db->error;
	}
	$db->close();
	echo $response;
?>
