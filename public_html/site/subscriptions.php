<?php
session_start();
$_SESSION['ver'] = 1;
include("db.php");
include 'functions.php';
if(isset($_SESSION['userid'])){
$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];
date_default_timezone_set('America/New_York');
// to keep good records, make sure this is in db
$ip_address = getIp();
$time_stamp = date('Y-m-d H:i:s');
$session_code = $_REQUEST['PHPSESSID'];
$email = $_SESSION['email_address'];
$like_fb = $_COOKIE['fblike'];	
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}


// must generate data to populate transaction database
// this will create unique id for invoice # AND keep
// things organized

// Extract data for user, store in cookie
	$result = mysql_query("SELECT * FROM users WHERE userid='$data_u' AND email_address='$data_e' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$d6 = $_SESSION['first_name'] = $row['first_name'];
	$d7 = $_SESSION['middle_name'] = $row['middle_name'];
	$d8 = $_SESSION['last_name'] = $row['last_name'];
	$d9 = $_SESSION['email_address'] = $row['email_address'];
	$d10 = $_SESSION['username'] = $row['username'];
	$d19 = $_SESSION['avatar'] = $row['avatar'];
	$d20 = $_SESSION['street_address'] = $row['street_address'];
	$d21 = $_SESSION['city'] = $row['city'];
	$d22 = $_SESSION['state'] = $row['state'];
	$d23 = $_SESSION['zip'] = $row['zip'];

if ($_SESSION['liked_facebook'] == "true"){$fbl = "1"; } else { $fbl = "0"; }

	$udat = $d6."|".$d8."|".$d9."|".$d20."|".$d21."|".$d22."|".$d23."|".$fbl."|0|0";
setcookie("uuser",$udat,time()+36000); // exp in 1 hr
	
// #############################################

// ppage will be set on next page, to save all transaction data
// if user returns here (due to stupidity) the invoice wont be regenerated

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
<div class="content"><br></div>
<div id="wrapper">
		
<div id="egcol2">
<div class="content">

<?php

if(isset($_SESSION['userid'])){

echo "<p>Logged in as " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . ".<br><a href=\"logout.php\">Not you?</a></p>";
echo "<br><br>";
}

// some feedback
if(isset($_COOKIE['ppage'])){
	echo "<p style=\"color:red\">Invoice #: ". $invoice ." is saved, you may continue to next page.</p>\n";
	}

?>


</div> <!-- end content -->
</div> <!-- end outer3 -->
			
			
<div id="egcol1">
<div class="content">

<?php

// Must fully define user levels
// Level 0 - Free membership (default)
// Level 1 - Memorial plan (2.99)
// Level 2 - Standard Goodbyes (14.99)
// Level 3 - Premium Paid (24.99)
// Level 4 - Single Memorial Only  
// Level 5 - Test Level / extra


if (isset($_SESSION['userid']) && $_SESSION['user_level'] >= 0) {

echo "<h2>Welcome ". $_SESSION['first_name'] ." ". $_SESSION['last_name'] ."!
Below, you can purchase more videos and memorial pages:</h2>";

//echo "Your user level is ". $_SESSION['user_level']." which enables you access to the following areas: <br/>";

   if($_SESSION['user_level'] == 0){
echo "<h2>Currently, you are enrolled in the Free membership. You can create one document goodbye message, sent out via email, and one memorial page.</h2>";
}

if($_SESSION['user_level'] == 1){
echo "<h2>Currently, you are enrolled in the Memorial plan. This allows you upload memorials to your loved ones and others.</h2>";
}

if($_SESSION['user_level'] == 2){
echo "<h2>Currently, you are enrolled in the Standard membership. You can create five document goodbye messages, sent out via email.  One document goodbye message, sent out via mail.  One video goodbye message, sent out via email and one memorial page.</h2>";
}

if($_SESSION['user_level'] == 3){
echo "<h2>Currently, you are enrolled in the Premium membership. You can create unlimited document goodbye messages, sent out via email.  Five document goodbye messages, sent out via mail.  Five video goodbye messages, sent out via email and two memorial pages.</h2>";
}

// end of logged in conditional
} else {
    echo "Please <a href=\"login.php\">log in</a>.";
}

?>
<br>

<?php

if($_SESSION['user_level'] <= 1){
	include("include/BLOCK-PremiumPaid.html");
	include("include/BLOCK-Standard.html");
	echo "<div class=\"clear_fix\"></div>";
	include("include/BLOCK-videoplan.html");
	include("include/BLOCK-memorialplan.html");
	echo "<div class=\"clear_fix\"></div>";
	//include("include/BLOCK-testblock.html");
	//include("include/BLOCK-spacer.html");
	//echo "<div class=\"clear_fix\"></div>";
}

if($_SESSION['user_level'] == 2){
	include("include/BLOCK-PremiumPaidUpgrade.html");
	//include("include/BLOCK-Freeplan.html");
	include("include/BLOCK-Standard-enrolled.html");
	echo "<div class=\"clear_fix\"></div>";
	include("include/BLOCK-videoplan.html");
	include("include/BLOCK-memorialplan.html");
	echo "<div class=\"clear_fix\"></div>";
	//include("include/BLOCK-testblock.html");
	//include("include/BLOCK-spacer.html");
	//echo "<div class=\"clear_fix\"></div>";
	//echo "<div class=\"clear_fix\"></div>";
}

if($_SESSION['user_level'] == 3){
	include("include/BLOCK-videoplan.html");
	include("include/BLOCK-memorialplan.html");
	echo "<div class=\"clear_fix\"></div>";
	//include("include/BLOCK-testblock.html");
	//include("include/BLOCK-spacer.html");
	//echo "<div class=\"clear_fix\"></div>";
	//echo "<div class=\"clear_fix\"></div>";
}

?>

<br>

<?php include("development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

	<div id="footer">
		<div class="content">
		<?php include("include/footer.php") ;?>
		</div> <!-- end content -->
	</div> <!-- end footer -->

</div> <!-- end wrapperA -->
	
<!--<script src="js/validate.js"></script>-->
</body>
</html>
