<?php 
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddItem');
include_once("include_files/access.inc.php");

$db = new mysqli($db_server, $db_username, $db_password, $db_name);
$sql = "SELECT * FROM `STATIONS` ORDER BY `Name`";
$result = $db->query($sql);
$stations=array();
$items=array();

while($row = $result->fetch_assoc()) {
	$stations[$row['id']] = $row["Name"];
}
$db->close();
?>
<!DOCTYPE html>
<html>
 <head>
  <title>Item Creation</title>
 </head>
 
 <body>
  <form action="temps.php">
   <p>
    Item name: <input type="text" name="Name">
   </p>
   <p>
    Storage: 
    <select name="Temp">
     <option value="Hot">Hot Held</option>
     <option value="Cold">Refrigerated</option>
     <option value="Frozen">Frozen</option>
    </select>
   </p>
   
   <p>
    Station: 
    <select name="Station">
<?php
foreach($stations as $id => $name) {
	echo "<option value='$id'>$name</option>\n";
}
?>
    </select>
   </p>
   <p>
    Item Added By: 
    <input type="text" name="AddedBy">
   </p>
   <p>
    <input type="submit">
   </p>
  </form>
 </body>

</html>