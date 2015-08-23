<?php
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
DEFINE("TITLE",'Add Temperature');
include_once("include_files/access.inc.php");
include_once("include_files/html.inc.php");

$db = new mysqli($db_server, $db_username, $db_password, $db_name);
$sql = "SELECT * FROM `STATIONS` ORDER BY `Name`";
$result = $db->query($sql);
$stations=array();
$items=array();
$units=array();

while($row = $result->fetch_assoc()) {
	$stations[$row['id']] = $row["Name"];
}

$sql = "SELECT * FROM `ITEMS` ORDER BY `Name`";
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
	$items[$row['id']] = $row["Name"];
}

$sql = "SELECT * FROM `UNITS` ORDER BY `Name`";
$result = $db->query($sql);

while($row = $result->fetch_assoc()) {
	$units[$row['id']] = $row["Name"];
}

$db->close();

Header_Html();

?>
<form action="addtemps.php">
<?php
	if(Check_Admin_String('ChangeUnit',$_SESSION['ADMINLEVEL'])){   ?>
	<p>
		<label for="Unit">Unit:</label>
		<select name="Unit" id="Unit">
<?php
		foreach($units as $id => $name) {
			echo "<option value='$id'";
			if ($id == $_SESSION['UNIT']){
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
		<select name="Station" id="Station">
			<option value='default' selected='selected'>Select a Station</option>
<?php
foreach($stations as $id => $name) {
	echo "<option value='$id'>$name</option>\n";
}
?>
		</select>
	</p>
	<p>
		<label for="Item">Item:</label>
		<select name="Item" id="Item">
<?php
foreach($items as $id => $name) {
	echo "<option value='$id'>$name</option>";
}
?>
		</select>
	</p>
	<p>
		<label for="Temp">Temp:</label>
		<input type="text" name="Temp" id="Temp">
	</p>
	<p>
		<input type="submit">
	</p>
</form>
<?php
Footer_Html();
?>