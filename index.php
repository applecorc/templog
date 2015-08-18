<?php
session_start();
DEFINE("TITLE",'Log In');
include_once("include_files/html.inc.php");
Header_Html();
?>
Temperature Log For UW Dining
<form action="login.php">
	<label for='userName'>User Name:</label>
	<input type="text" name="name" class="form-login" id="userName" title="Username" value="" size="30" maxlength="2048" />
	<label for='password'>Password:</label>
	<input name="password" type="password" id="password" class="form-login" title="Password" value="" size="30" maxlength="2048" />
	<input type="image" src="includes/images/login-btn.png" border="0" alt="Submit" width="103" height="42" />
</form>
<?php
Footer_Html();
?>