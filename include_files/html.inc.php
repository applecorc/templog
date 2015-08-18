<?php

function Header_Html(){
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo TITLE; ?></title>
	<link href="//tools.wiscwebcms.wisc.edu/cmsassets/uwtemplates/v1.4/css/uw-classic.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="includes/854.css" rel="stylesheet">
	<meta name="author" content="Cory Cloutier">
	<!-- Date: 2015-08-15  -->
</head>
<body class="for-non-residents">
<div class="utility-nav sticky hide-for-small">
	<div class="contain-to-grid">
		<nav class="top-bar" data-topbar data-options="sticky_on: large">
			<div class="section top-bar-section">
				<ul class="wordmark">
					<li>
						<a class="brand-wordmark" href="http://www.wisc.edu">University of Wisconsin&mdash;Madison</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>
</div>
<header class="page-header" role="banner">
	<div class="row">
		<div class="small-12 column">
			<div class="department-banner">
				<a href="index.php">University Housing</a>
			</div>
			<a href="index.php"><img class="brand-logo" src="includes/images/crest.png" alt=""/></a>
			<a class="brand-wordmark" href="index.php">University of Wisconsin&mdash;Madison</a>
		</div>
	</div>
</header>
<div class="main-nav contain-to-grid">
	<nav class="top-bar" data-topbar>
		<ul class="title-area">
			<li class="name">
				<div class="department-banner department-banner--mobile">
					<a href="index.htm">University Housing</a>
				</div>
			</li>
		</ul>
		<div class="section top-bar-section">
			<ul class="left">
<?php
/* Define the admin level needed. Valid values are:
'ChangeUnit','AddTemp','AddItem','AddUser','ViewLog'
*/
if(isset($_SESSION['ADMINLEVEL']) && !empty($_SESSION['ADMINLEVEL'])){
	if(strpos($_SESSION['ADMINLEVEL'], 'AddTemp') !== false){
		echo '<li id="temp"><a href="temps.php">Take Temp</a></li>';
	}
	if(strpos($_SESSION['ADMINLEVEL'], 'AddItem') !== false){
		echo '<li id="item"><a href="items.php">Add Item</a></li>';
	}
	if(strpos($_SESSION['ADMINLEVEL'], 'AddUser') !== false){
		echo '<li id="user"><a href="users.php">Add User</a></li>';
	}
	if(strpos($_SESSION['ADMINLEVEL'], 'ViewLog') !== false){
		echo '<li id="log"><a href="logs.php">View Logs</a></li>';
	}
	if(strpos($_SESSION['ADMINLEVEL'], 'EditItems') !== false){
		echo '<li id="editItem"><a href="eitems.php">Edit Item</a></li>';
	}
	if(strpos($_SESSION['ADMINLEVEL'], 'EditUsers') !== false){
		echo '<li id="editUser"><a href="eusers.php">Edit User</a></li>';
	}
	echo '<li id="logout"><a href="logout.php">Log Out</a></li>';
}
?>
			</ul>
		</div>
	</nav>
</div>
<main class="page-main">
	<div class="row">
		<div class="small-12 column content">
			<div class="clearfix cb cb-textarea">
				<h1><?php echo TITLE; ?></h1>
<?php
}

function Footer_Html(){
?>
			</div>
		</div>
	</div>
</main>
<footer class="page-footer">
	<div class="row">
		<div class="column small-12">
			<div class="row">
				<div class="column medium-3">
					<div class="row">
						<div class="column small-12">
							<div class="clearfix cb cb-textarea">
								<p style="text-align: center;">
									<img src="includes/images/uwlogo_web_sm_ctr_wht.png" alt="UW Logo">
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="column medium-3">
					<div class="row">
						<div class="column small-12">
							<div class="clearfix cb cb-textarea">
								<div class="block-title">
									<h2>Contact Info</h2>
								</div>
								<p>For questions or if errors are found please email:</p>
								<p>
									<a href="mailto:cory.cloutier@housing.wisc.edu">Cory Cloutier</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="clearfix cb cb-textarea">
				<ul class="ftr-social text-center">
					Created By Cory Cloutier
				</ul>
			</div>
		</div>
	</div>
</footer>
</body>
</html>
<?php
}


