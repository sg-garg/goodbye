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

<div id="wrapper">
		
<div id="egcol2">
<div class="content">

<?php

require("include/side_menu.php");

// some feedback
if(isset($_COOKIE['ppage'])){
	echo "<p style=\"color:red\">Invoice #: ". $invoice ." is saved, you may continue to next page.</p>\n";
	}

?>


</div> <!-- end content -->
</div> <!-- end outer3 -->
			
			
<div id="egcol1">
<div class="content">
<h3>Choose a subscription plan:</h3>

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
Before you can access your dashboard and start posting goodbyes, you must select a plan:</h2>";

//echo "Your user level is ". $_SESSION['user_level']." which enables you access to the following areas: <br/>";

   if($_SESSION['user_level'] == 0){
echo "<h2>Currently, you are enrolled in the Free (basic) plan. This allows you to see how site works.<br><br>You can select that plan to continue to next screen or upgrade to a paid plan to enjoy the greater features of the site.</h2>";
}

if($_SESSION['user_level'] == 1){
echo "<h2>Currently, you are enrolled in the Memorial plan. This allows you upload memorials to your loved ones and others.</h2>";
}

if($_SESSION['user_level'] == 2){
echo "<h2>Currently, you are enrolled in the Standard Goodbye plan. This allows you upload and save standard Goodbyes.</h2>";
}

if($_SESSION['user_level'] == 3){
echo "<h2>Currently, you are enrolled in the Premium plan. This allows you upload and save standard Goodbyes, upload videos, and say goodbye to multiple individuals.</h2>";
}

// end of logged in conditional
} else {
    echo "Please <a href=\"login.php\">log in</a>.";
}

?>

<div class="clear_fix"></div>


<!-- LINE BLOCK 1 -->
<div class="plan-block">
<h2>Memorial</h2>
<hr> 
<p><i>$ 2.99 For Per Memorial Page.</i><br>
This plan is for 1 Memorial Page. 
Create a memorial for yourself or 
for someone that has already 
passed away.</p>
<p style="line-height: 4px;">&nbsp;</p>

<!--
<p><a href="payment_page.php?amt=299&pln=Memorial%20Plan&lev=1&gby=0&usp=0&vid=0&mem=1&exa=0&exb=0" class="large button blue">Purchase Now</a></p>
-->

<form name="mycombo">
<p><select name="nummemorials" size="1">
<option selected>Please select one</option>
 <option value="payment_page.php?amt=299&pln=Memorial%20Plan(x1)&lev=1&gby=0&usp=0&vid=0&mem=1&exa=0&exb=0">1</option>
 <option value="payment_page.php?amt=598&pln=Memorial%20Plan(x2)&lev=1&gby=0&usp=0&vid=0&mem=2&exa=0&exb=0">2</option>
 <option value="payment_page.php?amt=897&pln=Memorial%20Plan(x3)&lev=1&gby=0&usp=0&vid=0&mem=3&exa=0&exb=0">3</option>
 <option value="payment_page.php?amt=1196&pln=Memorial%20Plan(x4)&lev=1&gby=0&usp=0&vid=0&mem=4&exa=0&exb=0">4</option>
 <option value="payment_page.php?amt=1495&pln=Memorial%20Plan(x5)&lev=1&gby=0&usp=0&vid=0&mem=5&exa=0&exb=0">5</option>
 <option value="payment_page.php?amt=1794&pln=Memorial%20Plan(x6)&lev=1&gby=0&usp=0&vid=0&mem=6&exa=0&exb=0">6</option>
 <option value="payment_page.php?amt=2093&pln=Memorial%20Plan(x7)&lev=1&gby=0&usp=0&vid=0&mem=7&exa=0&exb=0">7</option>
 <option value="payment_page.php?amt=2392&pln=Memorial%20Plan(x8)&lev=1&gby=0&usp=0&vid=0&mem=8&exa=0&exb=0">8</option>
 <option value="payment_page.php?amt=2691&pln=Memorial%20Plan(x9)&lev=1&gby=0&usp=0&vid=0&mem=9&exa=0&exb=0">9</option>
 <option value="payment_page.php?amt=2990&pln=Memorial%20Plan(x10)&lev=1&gby=0&usp=0&vid=0&mem=10&exa=0&exb=0">10</option>
</select></p>

<script type="text/javascript">
	function goa(){
	location=
	document.mycombo.nummemorials.
	options[document.mycombo.nummemorials.selectedIndex].value
	}
</script>

<input type="button" name="test" value="Purchase Now" onClick="goa()" class="large button blue">
</form>
</div>

<!-- LINE BLOCK 2 -->
<div class="plan-block">
<h2>Free Account - <i>enrolled</i></h2>
<hr>
<p>You are now able to create 
goodbye messages.<br>Free  For 
Life Time</p>

<br>Text Goodbyes via email: 5
<p style="line-height: 47px;">&nbsp;</p>

<p><a href="dashboard.php" class="large button blue">Dashboard</a></p>
</div>

<div class="clear_fix"></div>


<!-- LINE BLOCK 3 -->

<!-- VIDEO PLAN -->
<div class="plan-block">
<h2>Video</h2>
<hr> 
<p><i>$ 2.99 For Additional Videos.</i><br>
Select number of videos below. 
Create a video for yourself to
 send to someone after your
  passing.</p>
<p style="line-height: 4px;">&nbsp;</p>

<!--
<p><a href="payment_page.php?amt=299&pln=Memorial%20Plan&lev=1&gby=0&usp=0&vid=0&mem=1&exa=0&exb=0" class="large button blue">Purchase Now</a></p>
-->

<form name="myvideo">
<p><select name="numvideos" size="1">
<option selected>Please select one</option>
 <option value="payment_page.php?amt=299&pln=Video%20Plan(x1)&lev=1&gby=0&usp=0&vid=1&mem=0&exa=0&exb=0">1</option>
 <option value="payment_page.php?amt=598&pln=Video%20Plan(x2)&lev=1&gby=0&usp=0&vid=2&mem=0&exa=0&exb=0">2</option>
 <option value="payment_page.php?amt=897&pln=Video%20Plan(x3)&lev=1&gby=0&usp=0&vid=3&mem=0&exa=0&exb=0">3</option>
 <option value="payment_page.php?amt=1196&pln=Video%20Plan(x4)&lev=1&gby=0&usp=0&vid=4&mem=0&exa=0&exb=0">4</option>
 <option value="payment_page.php?amt=1495&pln=Video%20Plan(x5)&lev=1&gby=0&usp=0&vid=5&mem=0&exa=0&exb=0">5</option>
 <option value="payment_page.php?amt=1794&pln=Video%20Plan(x6)&lev=1&gby=0&usp=0&vid=6&mem=0&exa=0&exb=0">6</option>
 <option value="payment_page.php?amt=2093&pln=Video%20Plan(x7)&lev=1&gby=0&usp=0&vid=7&mem=0&exa=0&exb=0">7</option>
 <option value="payment_page.php?amt=2392&pln=Video%20Plan(x8)&lev=1&gby=0&usp=0&vid=8&mem=0&exa=0&exb=0">8</option>
 <option value="payment_page.php?amt=2691&pln=Video%20Plan(x9)&lev=1&gby=0&usp=0&vid=9&mem=0&exa=0&exb=0">9</option>
 <option value="payment_page.php?amt=2990&pln=Video%20Plan(x10)&lev=1&gby=0&usp=0&vid=10&mem=0&exa=0&exb=0">10</option>
</select></p>

<script type="text/javascript">
	function gob(){
	location=
	document.myvideo.numvideos.
	options[document.myvideo.numvideos.selectedIndex].value
	}
</script>

<input type="button" name="test" value="Purchase Now" onClick="gob()" class="large button blue">
</form>
</div>

<!-- LINE BLOCK 4 -->
<div class="plan-block-clear">
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
</div>

<div class="clear_fix"></div>
<!-- LINE BLOCK 5 (END) -->

<br><br><br>

<?php require("development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php
require("include/footer_code.html");
?>

</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	
<!--<script src="js/validate.js"></script>-->
</body>
</html>
