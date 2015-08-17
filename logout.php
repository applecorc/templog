<?php
session_start();

// remove all session variables
session_unset();

// destroy the session
session_destroy();

//get url then send the user to index.
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$extra = 'index.php';  // change accordingly
header("Location: http://$host$uri/$extra");
exit;
?>