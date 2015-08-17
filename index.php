<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>UW Dining Temperature Log </title>
<link href="include_files/login-box.css" rel="stylesheet" type="text/css" />
<meta name="author" content="Cory Cloutier">
<!-- Date: 2015-08-15  -->
</head>

<body>
<form action="login.php">
<div style="padding: 100px 0 0 250px;">
	<div id="login-box">
		<H2>Login</H2>
		Temperature Log For UW Dining
		<br />
		<br />
		<div id="login-box-name" style="margin-top:20px;">User Name:</div><div id="login-box-field" style="margin-top:20px;">
			<input type="text" name="name" class="form-login" id="userName" title="Username" value="" size="30" maxlength="2048" />
		</div>
		<div id="login-box-name">Password:</div>
		<div id="login-box-field">
			<input name="password" type="password" id="password" class="form-login" title="Password" value="" size="30" maxlength="2048" />
		</div>
		<br />
		<span class="error" id="loginerror"></span>
		<br />
		<br />
		<input type="image" src="include_files/images/login-btn.png" border="0" alt="Submit" width="103" height="42" style="margin-left:90px;" />
	</div>
</div>
</form>
</body>
</html>