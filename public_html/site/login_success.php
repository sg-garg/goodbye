<?php
session_start();
$_SESSION['ver'] = 1;
require("db.php");
if(isset($_SESSION['userid'])){
$user = $_SESSION['userid'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

// Register some session variables!

//session_register('userid');  // ESSENTIAL userid!
//	$_SESSION['userid'] = $userid;
//session_register('first_name');
//	$_SESSION['first_name'] = $first_name;
//session_register('last_name');
//	$_SESSION['last_name'] = $last_name;
//session_register('email_address');
//	$_SESSION['email_address'] = $email_address;
//session_register('special_user');
//	$_SESSION['user_level'] = $user_level;
//mysql_query("UPDATE users SET last_login=now() WHERE userid='$userid'");


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
		
<div id="egcol2">
<div class="content">

<?php
if(isset($_SESSION['userid'])){

echo "<p>Logged in as " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . ".<br><a href=\"logout.php\">Not you?</a></p>";
echo "<br><br>";

} else {

echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"login.php\">Login</a></p>";
echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"register_form.php\">Register</a></p>";

}

?>

</div> <!-- end content -->
</div> <!-- end outer3 -->
			
			
<div id="egcol1">
<div class="content">
<h3>You have successfully logged in to eGoodbyes.com.</h3>

<?php

// Must fully define user levels
// Level 0 - Free membership (default)
// Level 1 - Memorial plan (2.99)
// Level 2 - Standard Goodbyes (14.99)
// Level 3 - Premium Paid (24.99)
// Level 4 - Test Level / extra


echo "<h2>Welcome ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] ."!</h2>";

//echo "Your user level is ". $_SESSION['user_level']." which enables you access to the following areas: <br/>";

   if($_SESSION['user_level'] == 0){
echo "<h2>By registering with eGoodbyes, you are enrolled in our free sign up.  Our free plan will allow you to create 1 goodbye message in a text document format, which will get sent out to the recipient via email and allow you to view and post comments on memorial pages.<br>

<blockquote>
<span style=\"letter-spacing: 1px;font-weight: bold;color: red;text-decoration: underline;\">We strongly suggest you create at least 2 Point of Contacts first before creating goodbye messages.</span>
</blockquote>

Before you can proceed to your home page and start creating your final goodbye messages, please click on my account link below.<br>
<ul><li><a href=\"my_account.php?f=q1496\">My&nbsp;Account</a></li></ul></h2>";

}

if($_SESSION['user_level'] == 1){
echo "<h2>Currently, you are enrolled in the Memorial plan. This allows you upload memorials to your loved ones and others.</h2>
<ul><li><a href=\"my_account.php?f=q1496\">My&nbsp;Account</a></li></ul>";
}

if($_SESSION['user_level'] == 2){
echo "<h2>Currently, you are enrolled in the Standard Goodbye plan. This allows you upload and save standard Goodbyes.</h2>
<ul><li><a href=\"my_account.php?f=q1496\">My&nbsp;Account</a></li></ul>";
}

if($_SESSION['user_level'] == 3){
echo "<h2>Currently, you are enrolled in the Premium plan. This allows you upload and save standard Goodbyes, upload videos, and say goodbye to multiple individuals.
<ul><li><a href=\"my_account.php?f=q1496\">My&nbsp;Account</a></li></ul></h2>";
}
?>

<br><br><br>

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
