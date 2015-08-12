<?php
	include_once("include_files/db.inc.php");
	$db = new mysqli($db_server, $db_username, $db_password, $db_name);
	$sql = "SELECT * FROM `STATIONS` ORDER BY `Name`";
	$result = $db->query($sql);
	$stations=array();
	$items=array();

	while($row = $result->fetch_assoc()) {
		$stations[$row['id']] = $row["Name"];
	}
	
	$sql = "SELECT * FROM `ITEMS` ORDER BY `Name`";
	$result = $db->query($sql);

	while($row = $result->fetch_assoc()) {
		$items[$row['id']] = $row["Name"];
	}
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Temperature Log</title>
 </head>
 
 <body>
  <form action="temps.php">
   <p>
	<select name="Station">
<?php
	foreach($stations as $id => $name) {
		echo "<option value='$id'>$name</option>\n";
	}
?>
	</select>
   </p>
   <p>
	<select name ="Item">
<?php
	foreach($items as $id => $name) {
		echo "<option value='$id'>$name</option>";
	}
?>
	</select>
   </p>
   
   <p>
	<input type="text" name="Temp">
   </p>
   
   <p>
	<input type="submit">
   </p>
  </form>
 </body>
</html>