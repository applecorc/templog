<?php 

if (!isset($_SESSION['USER'])){
	//check to see if the user is logged in and if not redirect.
	header('Location: index.php');
	exit();
} elseif (empty($_SESSION['USER'])){
	//Doublecheck to see if the user is logged in and if not redirect.
	header('Location: index.php');
	exit();
} elseif ($_SESSION['ADMINLEVEL'] < ){
	//Check to see if the user is authorised to see the page
	header('Location: index.php');
	exit();
}