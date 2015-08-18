<?php
//TODO Add everything
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
DEFINE("ADMINLEVELNEEDED",'AddTemp');
include_once("include_files/access.inc.php");
$db = new mysqli($db_server, $db_username, $db_password, $db_name);