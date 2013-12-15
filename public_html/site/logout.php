<?php
session_start();
session_destroy();
include("db.php");
header('Location: ' . $site_url . '/site/login.php');

// session_start();
// session_unset();
// session_destroy();
// session_write_close();
// setcookie(session_name(),'',0,'/');
// session_regenerate_id(true);
// $_SESSION = array();

include 'db.php';

// unset cookies
if (isset($_SERVER['HTTP_COOKIE'])) {
$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
foreach($cookies as $cookie) {
$parts = explode('=', $cookie);
$name = trim($parts[0]);
setcookie($name, '', time()-1000);
setcookie($name, '', time()-1000, '/');
}
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>eGoodbyes - Logout</title>
<meta http-equiv="refresh" content="0;url=https://www.egoodbyes.com/site/login.php"/>
<?php require("include/head.html") ?>
</head>

<body>

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php include("include/nav-main.php"); ?>
</div> <!-- end of center -->

<div class="content"><br></div>

</div> <!-- end header -->

<div id="wrapper">
<div id="egcol2">
<div class="content">

<?php require("include/side_menu.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer3 -->
			
<div id="egcol1">
<div class="content">
<h3>Logout</h3>

<p>You have been successfully logged out.</p>

<?
if(!isset($_REQUEST['logmeout'])){
		echo "<center>Are you sure you want to logout?</center><br />";
		echo "<center><a href=logout.php?logmeout=true>Yes</a> | <a href=javascript:history.back()>No</a>";
		} else {
session_destroy();
	if(!session_is_registered('first_name')){
		echo "<center><font color=red><strong>You are now logged out!</strong></font></center><br />";
		echo "<center><strong>Login:</strong></center><br />";

include 'include/login_form.html';
}
}

?>

<?php require("development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	
	<script src="js/validate.js"></script>
</body>
</html>
