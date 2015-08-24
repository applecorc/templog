<?php
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
DEFINE("TITLE",'Corrective Action');
include_once("include_files/access.inc.php");
include_once("include_files/html.inc.php");

$db = new mysqli($db_server, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

if (isset($_SESSION['OORTemps'])){
	Header_Html();
	
	$temps = $_SESSION['OORTemps'];
	echo "\n<form action='correctiveaction.php'>";
	foreach($temps as $tempId){
		$sql = "SELECT ITEMS.Temp as `TEMP`, ITEMS.Name as `Name` FROM `TEMPS` INNER JOIN `ITEMS` ON `Item` = ITEMS.id where TEMPS.id = $tempId";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		$temp = $row['TEMP'];
		$name = $row['Name'];
		
		echo "<p>\n<label for='$tempId'>$name</label>\n";
		echo "<select name='action[$tempId]' id='$name'>\n<option value='default' selected='selected'>Select an Action</option>\n";
		if($temp == 'Cold'){
			echo "<option value='Cool'>Cooled down to 41</option>\n";
		}
		if($temp == 'Hot'){
			echo "<option value='Warm'>Rewarmed to 165</option>\n";
		}
		echo "<option value='Discarded'>Discarded</option>\n<option value='Other'>Other</option>\n</select></p>";
	}
	echo "<p>\n<input type='submit'>\n</p>\n</form>";
	
	unset($GLOBALS[_SESSION]['OORTemps']);
	
	Footer_Html();
	$db->close();
} elseif(isset($_REQUEST['action'])) {
	$actions = $_REQUEST['action'];
	$anyOthers = array();
	foreach($actions as $id => $action) {
		$id = $db->real_escape_string($id);
		$action = $db->real_escape_string($action);
		
		$sql = "UPDATE `TEMPS` SET `CorrectiveAction` = '$action' WHERE `id`=$id";
		if ($db->query($sql)){
			if($action=='Other'){
				$anyOthers[] = $id;
			}
		}
	}
	$db->close();
	if(count($anyOthers) != 0){
		$_SESSION['Others'] = $anyOthers;
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'correctiveaction.php';  // change accordingly
		header("Location: http://$host$uri/$extra");
	} else {
		$host  = $_SERVER['HTTP_HOST'];
		$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		$extra = 'temps.php';  // change accordingly
		header("Location: http://$host$uri/$extra");
	}
} elseif(isset($_SESSION['Others'])) {
	
	Header_Html();
	
	$others = $_SESSION['Others'];
	echo "\n<form action='correctiveaction.php'>";
	foreach($others as $tempId){
		$tempId = $db->real_escape_string($tempId);
		$sql = "SELECT ITEMS.Name as `Name` FROM `TEMPS` INNER JOIN `ITEMS` ON `Item` = ITEMS.id where TEMPS.id = $tempId";
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		$name = $row['Name'];
		
		echo "<p>\n<label for='$name'>What other action was taken for $name</label>\n";
		echo "<input type='text' name='Others[$tempId]' id='$name'>\n</p>\n";
	}
	echo "<p>\n<input type='submit'>\n</p>\n</form>";
	
	unset($GLOBALS[_SESSION]['Others']);
	
	Footer_Html();
	$db->close();
	
} elseif(isset($_REQUEST['Others'])) {
	$others = $_REQUEST['Others'];
	
	foreach($others as $id => $otherText) {
		$id = $db->real_escape_string($id);
		$otherText = $db->real_escape_string($otherText);
		
		$sql = "INSERT INTO `CORRECTIVEACTION` VALUES ($id,'$otherText')";
		if ($db->query($sql)){
			
		}
	}
	$db->close();
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'temps.php';  // change accordingly
	header("Location: http://$host$uri/$extra");
} else {
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$extra = 'temps.php';  // change accordingly
	header("Location: http://$host$uri/$extra");
}
?>