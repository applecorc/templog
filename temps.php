<?php
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
DEFINE("TITLE",'Add Temperature');
include_once("include_files/access.inc.php");
include_once("include_files/html.inc.php");

$stations=array();
$items=array();
$units=array();

$db = new mysqli($db_server, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()) {
	printf("Connect failed: %s\n", mysqli_connect_error());
	exit();
}

Header_Html();

$station = Is_Set_Request('Station',$db);

/*If a station has been selected load the temps for it after the meal has been determined,
ELSE load the form to select the station.*/
if ($station !== FALSE) {
	$unit = Is_Set_Request('Unit',$db);
	$meal = Is_Set_Request('Meal',$db);
	$count = 0;
	$sql = "SELECT DISTINCT `Meal` FROM `ITEMS` WHERE `DefaultStation` = $station";
	$result = $db->query($sql);
	$count = $result->num_rows;
	
	if ($count != 1 && $meal === FALSE) {
		$meals = array();
		while($row = $result->fetch_assoc()) {
			$meals[] = $row["Meal"];
		}
/* Create Form to select which meal */
?>
<form action="temps.php">
	<p>
		<label for="Meal">Meal:</label>
		<select name="Meal" id="Meal" onchange="this.form.submit();">
			<option value='default' selected='selected'>Select a Meal</option>
<?php
foreach($meals as $mealSelection) {
	echo "<option value='$mealSelection'>$mealSelection</option>";
}
?>
		</select>
		<input type="hidden" name="Station" value="<?php echo $station;?>">
		<input type="hidden" name="Unit" value="<?php echo $unit;?>">
	</p>
</form>
<?php
	} elseif ($count == 1) {
		$row = $result->fetch_assoc();
		$meal = $row['Meal'];
	}
	
/* Create form of list of temps */
	if($unit == FALSE) {
		$unit = $_SESSION['UNIT'];
	}
	if(!Check_Admin_String('ChangeUnit',$_SESSION['ADMINLEVEL'])) {
		$unit = $_SESSION['UNIT'];
	}
	
	$sql = "SELECT `id`, `Name` FROM `ITEMS` WHERE `DefaultStation` = $station AND `Meal` = '$meal' ORDER BY `Temp` DESC, `Name` ASC";
	$result = $db->query($sql);
	while($row = $result->fetch_assoc()) {
		$items[$row['id']] = $row["Name"];
	}
	
?>
<form action="addtemps.php">
	<p>
<?php
foreach($items as $id => $name) {
	echo "<label for='$name'>$name:</label>\n
	<input type='text' name='temp[$id]' id='$name'>\n";
}
?>
	</p>
	<p>
		<input type="hidden" name="Station" value="<?php echo $station;?>">
		<input type="hidden" name="Unit" value="<?php echo $unit;?>">
		<input type="submit">
	</p>
</form>
<?php
} else {
/* Load the form to select a station */
	
	$sql = "SELECT * FROM `STATIONS` ORDER BY `Name`";
	$result = $db->query($sql);
	
	while($row = $result->fetch_assoc()) {
		$stations[$row['id']] = $row["Name"];
	}

	$sql = "SELECT * FROM `UNITS` ORDER BY `Name`";
	$result = $db->query($sql);

	while($row = $result->fetch_assoc()) {
		$units[$row['id']] = $row["Name"];
	}
	
	$db->close();
	
?>
<form action="temps.php">
<?php
	if(Check_Admin_String('ChangeUnit',$_SESSION['ADMINLEVEL'])){   ?>
	<p>
		<label for="Unit">Unit:</label>
		<select name="Unit" id="Unit">
<?php
		foreach($units as $id => $name) {
			echo "<option value='$id'";
			if ($id == $_SESSION['UNIT']) {
				echo " selected='selected'";
			}
			echo ">$name</option>";
		}
		?>
		</select>
	</p>
<?php
	}
?>
	<p>
		<label for="Station">Station:</label>
		<select name="Station" id="Station" onchange="this.form.submit();">
			<option value='default' selected='selected'>Select a Station</option>
<?php
foreach($stations as $id => $name) {
	echo "<option value='$id'>$name</option>\n";
}
?>
		</select>
	</p>
</form>
<?php
}

Footer_Html();
?>