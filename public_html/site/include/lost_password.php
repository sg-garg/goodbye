<?php
session_start();
include 'db.php';

//if(isset($_SESSION['userid'])){
//$user = $_SESSION['userid'];
//date_default_timezone_set('America/New_York');
//$today = date("Y-m-d");		
//		} else {
//			/* Redirect browser */
//			header("Location: https://www.egoodbyes.com/site/login.php");
//}

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

<h3>Lost Password Recovery</h3>
<p>In case you need to reset your password <i>(we understand, it happens!)</i> You may do so here.  Please enter your E-mail address, and we'll send instructions.</p>

<?php
// Only perform check *IF* this is a submission

if (ISSET($_POST['recover'])) {
echo "<p>Checking Records</p>";
include 'db.php';
	if (ISSET($_POST['email_address'])) {		
	$email_address = stripslashes($_POST['email_address']);
	} else {
	echo "<p class=\"errortext\">&nbsp;&nbsp;&#8226; You forgot to enter your Email address.</p>";
	}
	/*if (ISSET($_POST['user_name'])) {
	$user_name = stripslashes($_POST['user_name']);
	} else {
	echo "<p class=\"errortext\">&nbsp;&nbsp;&#8226; You forgot to enter your User name.</p>";
	}*/
	// set the default timezone to use. Available since PHP 5.1
	// date_default_timezone_set('UTC');
		date_default_timezone_set('America/New_York'); 
		$date_stamp = date('Y-m-d H:i:s');

// quick check to see if record exists

		if(mysql_num_rows(mysql_query("SELECT email_address FROM users WHERE email_address = '$email_address'"))) {
// Steps to do if email was found
echo "<p class=\"errortext\">Account found for " . $email_address . "</p>";

		// Everything looks ok, generate password, update it and send it!
		function makeRandomPassword() {
			$salt = "abchefghjkmnpqrstuvwxyz0123456789";
			srand((double)microtime()*1000000);
			$i = 0;
			while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($salt, $num, 1);
			$pass = $pass . $tmp;
			$i++;
			}
			return $pass;
		}
	
// echo "<p>Generating PW</p>";
		$random_password = makeRandomPassword();
		$db_password = $random_password;

// echo "<p>Making SQL query</p>";
	
$sql = mysql_query("UPDATE users SET password = '$db_password', record_update = '$date_stamp' WHERE email_address = '$email_address'");

//next segment email

$subject = "Password request for eGoodbyes.com!";

$message = "Hi, We have reset your password.

New Password: $db_password

https://www.egoodbyes.com/site/login.php

Thanks!
Webmaster, eGoodbyes
This is an automated response, please do not reply!";

mail($email_address, $subject, $message, "From: eGoodbyes Webmaster <scott@egoodbyes.com>" . phpversion());

echo "<p><b style=\"color: red;font-weight: bold;\">Your password has been sent! Please check your email! Please check your Spam folder just in case the email got delivered there instead of your inbox</b></p>";

} else {
	// Steps to do if email was NOT found
	echo "<h1>This email id not registered with us.</h1>";
	echo "<p class=\"errortext\">Please try again, and double-check your entry.</p>";
}

} // end of recover conditional

// This login form only needs to appear ONE time
include 'include/lost_pw.html';

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
	<script src="js/validate3.js"></script>
</body>
</html>
