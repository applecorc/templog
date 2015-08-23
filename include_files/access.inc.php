<?php 
session_start();
DEFINE("DEBUG",FALSE);
include_once("include_files/db.inc.php");

/* Function to check if user has access to the page */
function Check_Admin_String($neededLevel,$currentLevel){
	if (strpos($currentLevel, $neededLevel) !== false) {
		return true;
	} else {
		return false;
	}
}

/* function to escape $_REQUESTs */
function Is_Set_Request($request,$db){
	/* check if server is alive */
	if ($db->ping()) {
		/* escape request string */
		if(isset($_REQUEST[$request]) && !empty($_REQUEST[$request])) {
			return $db->real_escape_string($_REQUEST[$request]);
		} else {
			if(DEBUG){
				echo "ERROR: Is Set Request error 1";
			}
			return FALSE;
		}
	} else {
		echo "ERROR: Is Set Request error 2";
		return FALSE;
	}
}

if (!isset($_SESSION['USER'])){
	//check to see if the user is logged in and if not redirect.
	header('Location: index.php');
	exit();
} elseif (empty($_SESSION['USER'])){
	//Doublecheck to see if the user is logged in and if not redirect.
	header('Location: index.php');
	exit();
} elseif (!Check_Admin_String(ADMINLEVELNEEDED,$_SESSION['ADMINLEVEL'])){
	//Check to see if the user is authorised to see the page
	header('Location: index.php');
	exit();
}