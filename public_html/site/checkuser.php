<?php
session_start();
$_SESSION['ver'] = 1;
include 'db.php';

if(isset($_SESSION['userid'])){
$user = $_SESSION['userid'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");		
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Membership Processing</title>
<?php require("include/head.html") ?>
</head>

<body>

<div id="minMax">
<div id="header">

<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>

</div> <!-- end of center -->

<div class="content"><br></div>

</div> <!-- end header -->

<div id="wrapper">

			
<div id="egcolsc">
<div class="content">
<h3>Account Check & Verification</h3>

<?php

/* Check User Script */
// Conver to simple variables
$email = $_REQUEST['email_address'];
$password = $_REQUEST['password'];

if((!$email) || (!$password)){
	echo "<p>Please enter your login information below:<br />";
	include 'include/login_form.html';
// exit();
	}
	
// Convert password to md5 hash, option to have system create password, or user create it.
$mpassword = md5($password);

// check if the user info validates the db
	$sql = mysql_query("SELECT * FROM users WHERE email_address='$email' AND (BINARY password='$password' OR password='$mpassword') AND activated='1'");

	$login_check = mysql_num_rows($sql);
	if($login_check > 0){
		while($row = mysql_fetch_array($sql)){
			foreach( $row AS $key => $val ){
			$$key = stripslashes( $val );
			}

// Register some session variables!

//session_register('userid');  // ESSENTIAL userid!
	$_SESSION['userid'] = $userid;
//session_register('first_name');
	$_SESSION['first_name'] = $first_name;
//session_register('last_name');
	$_SESSION['last_name'] = $last_name;
//session_register('email_address');
	$_SESSION['email_address'] = $email_address;
//session_register('special_user');
	$_SESSION['user_level'] = $user_level;
//session_register('is_admin');
	$_SESSION['is_admin'] = $is_admin;
mysql_query("UPDATE users SET last_login=now() WHERE userid='$userid'");

// If user has already signed up...
// if ($user_level >= 1){

if ($_COOKIE['f'] != "q1496"){
header("Location: dashboard.php");
} else {
header("Location: login_success.php");
}
		}  // end of while loop
		} else {
		echo "<p style=\"color: red;font-weight: bold;\">You could not be logged in! Either the username and password do not match or you have not validated your membership!<br><br>Please try again!</p>";

include 'include/login_form.html';

}

?>
<br>
<p>Don't have an account?  Please <a href="login.php">Register</a> today!<br>
<a href="lost_password.php">Forgot password?</a></p>
<br><br><br><br>
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
