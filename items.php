<?php 
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddItem');
DEFINE("TITLE",'Add Item');
include_once("include_files/access.inc.php");
include_once("include_files/html.inc.php");

$db = new mysqli($db_server, $db_username, $db_password, $db_name);
$sql = "SELECT * FROM `STATIONS` ORDER BY `Name`";
$result = $db->query($sql);
$stations=array();
$items=array();

while($row = $result->fetch_assoc()) {
	$stations[$row['id']] = $row["Name"];
}
$db->close();

Header_Html();

?>
<form action="additems.php">
	<p>
		<label for="Name">Item name:</label>
		<input type="text" name="Name" id="Name">
	</p>
	<p>
		<label for="Temp">Holding Temp</label>
		<select name="Temp" id="Temp">
			<option value="Hot">Hot Held</option>
			<option value="Cold">Refrigerated</option>
			<option value="Frozen">Frozen</option>
		</select>
	</p>
	<p>
		<label for="Station">Default Station</label>
		<select name="Station" id="Station">
<?php
foreach($stations as $id => $name) {
	echo "<option value='$id'>$name</option>\n";
}
?>
		</select>
	</p>
	<p>
		<input type="submit">
	</p>
</form>
<?php
Footer_Html();
?>