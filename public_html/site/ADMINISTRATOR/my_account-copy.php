<?php
session_start();
$_SESSION['ver'] = 1;
require("../db.php");

if(isset($_SESSION['userid'])){

$user = $_SESSION['userid'];

date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>My Account</title>
<?php require("../include/head.html") ?>
</head>

<body>

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php require("../include/nav_code-m.html"); ?>
</div> <!-- end of center -->
				
<div class="content"><br></div>
			
</div> <!-- end header -->


<div id="wrapper">

<div id="egcol2">
<div class="content">

<?php require("../include/side_menu.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer3 -->


		<div id="topbar">
		<div class="content">
		<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h3>		
		</div>
		</div>
			
			
<div id="egcol1">
<div class="content">
<h3>My Account</h3>
<p>You may verify and update your account information here.</p>

<?php

if (ISSET($_POST['doupdate'])) {

// This puts all post data I define into session

$userid = $_SESSION['userid'];  // don't forget critical user id!!
$u1 = $_POST['plan_name'];
$u2 = $_POST['goodbyes'];
$u3 = $_POST['usps_mailings'];
$u4 = $_POST['videos'];
$u5 = $_POST['memorials'];
$u6 = $_POST['first_name'];
$u7 = $_POST['middle_name'];
$u8 = $_POST['last_name'];
$u9 = $_POST['email_address'];
$u10 = $_POST['username'];
$u11 = $_POST['password'];  //sensitive, md5?
$u12 = $_POST['info'];
$u13 = $_POST['user_level'];  // post problem notice
$u14 = $_POST['signup_date'];
$u15 = $_POST['last_login'];
$u16 = $_POST['birthday'];
$u17 = $_POST['date_of_death'];
$u18 = $_POST['gender'];  // post problem notice
$u19 = $_POST['avatar'];  // post problem notice
$u20 = $_POST['street_address'];
$u21 = $_POST['city'];
$u22 = $_POST['state'];
$u23 = $_POST['zip'];
$u24 = $_POST['phone'];
$u25 = $_POST['promo_emails'];  // post problem notice
$u26 = $_POST['country'];  // post problem notice
// Provide some kind of feedback on what the user changed
// First Name
if ($_SESSION['first_name'] != $_POST['first_name']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; First Name has been updated</span><br>";
$sql = mysql_query("UPDATE users SET first_name = '$u6' WHERE userid = '$userid'");}
// Middle Name
if ($_SESSION['middle_name'] != $_POST['middle_name']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Middle Name has been updated</span><br>";
$sql = mysql_query("UPDATE users SET middle_name = '$u7' WHERE userid = '$userid'");}
// Last Name
if ($_SESSION['last_name'] != $_POST['last_name']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Last Name has been updated</span><br>";
$sql = mysql_query("UPDATE users SET last_name = '$u8' WHERE userid = '$userid'");}
// Email
if ($_SESSION['email_address'] != $_POST['email_address']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; E-mail has been updated</span><br>";
$sql = mysql_query("UPDATE users SET email_address = '$u9' WHERE userid = '$userid'");}
// Username
if ($_SESSION['username'] != $_POST['username']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Username has been updated</span><br>";
$sql = mysql_query("UPDATE users SET username = '$u10' WHERE userid = '$userid'");}
// Password
if ($_SESSION['password'] != $_POST['password']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Password has been updated</span><br>";
$sql = mysql_query("UPDATE users SET password = '$u11' WHERE userid = '$userid'");}
// info
if ($_SESSION['info'] != $_POST['info']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Info has been updated</span><br>";
$sql = mysql_query("UPDATE users SET info = '$u12' WHERE userid = '$userid'");}
// birthday
if ($_SESSION['birthday'] != $_POST['birthday']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Birthday has been updated</span><br>";
$sql = mysql_query("UPDATE users SET birthday = '$u16' WHERE userid = '$userid'");}
// date_of_death
if ($_SESSION['date_of_death'] != $_POST['date_of_death']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Date of Death has been updated</span><br>";
$sql = mysql_query("UPDATE users SET date_of_death = '$u17' WHERE userid = '$userid'");}
//gender
if ($_SESSION['gender'] != $_POST['gender']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Gender has been updated</span><br>";
$sql = mysql_query("UPDATE users SET gender = '$u18' WHERE userid = '$userid'");}
// Street Address
if ($_SESSION['street_address'] != $_POST['street_address']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Street Address has been updated</span><br>";
$sql = mysql_query("UPDATE users SET street_address = '$u20' WHERE userid = '$userid'");}
// City
if ($_SESSION['city'] != $_POST['city']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; City has been updated</span><br>";
$sql = mysql_query("UPDATE users SET city = '$u21' WHERE userid = '$userid'");}
// State
if ($_SESSION['state'] != $_POST['state']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; State has been updated</span><br>";
$sql = mysql_query("UPDATE users SET state = '$u22' WHERE userid = '$userid'");}
// Zip
if ($_SESSION['zip'] != $_POST['zip']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Zip has been updated</span><br>";
$sql = mysql_query("UPDATE users SET zip = '$u23' WHERE userid = '$userid'");}
// Phone
if ($_SESSION['phone'] != $_POST['phone']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Phone has been updated</span><br>";
$sql = mysql_query("UPDATE users SET phone = '$u24' WHERE userid = '$userid'");}
// Promo email preference
if ($_SESSION['promo_emails'] != $_POST['promo_emails']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; E-mail preference has been updated</span><br>";
$sql = mysql_query("UPDATE users SET promo_emails = '$u25' WHERE userid = '$userid'");}
// Country
if ($_SESSION['country'] != $_POST['country']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Country has been updated</span><br>";
$sql = mysql_query("UPDATE users SET country = '$u26' WHERE userid = '$userid'");}

// items to do when posting update
// upload.php - (avatar upload will be on separate page!)

//end of avatar upload

// NOW, update db with new info (old way)
/*$sql = mysql_query("UPDATE users 
SET
 plan_name = '$u1',
 goodbyes = '$u2',
 usps_mailings = '$u3',
 videos = '$u4',
 memorials = '$u5',
 first_name = '$u6',
 middle_name = '$u7',
 last_name = '$u8',
 email_address = '$u9',
 username = '$u10',
 password = '$u11',
 info = '$u12',
 user_level = '$u13',
 signup_date = '$u14',
 last_login = '$u15',
 birthday = '$u16',
 date_of_death = '$u17',
 gender = '$u18',
 avatar = '$u19',
 street_address = '$u20',
 city = '$u21',
 state = '$u22',
 zip = '$u23',
 phone = '$u24',
 promo_emails = '$u25',
 country = '$u26',
  
WHERE
    userid = '$userid'");
    */

}

echo "<h2>Edit anything that needs changing, then hit <i>Save</i>:</h2>\n";

// Must fully define user levels
// Level 0 - Free membership (default)
// Level 1 - Memorial plan (2.99)
// Level 2 - Standard Goodbyes (14.99)
// Level 3 - Premium Paid (24.99)
// Level 4 - Test Level / extra

if (isset($_SESSION['userid']) && $_SESSION['user_level'] >= 0) {
    echo "Welcome to the member's area, " . $_SESSION['first_name'] . "!";
    
echo "Your user level is ". $_SESSION['user_level']." which enables you access to the following areas: <br/>";

   if($_SESSION['user_level'] == 0){
echo "<p>Currently, you are enrolled in the Free (basic) plan. This allows you to see how site works.<br><br>You can select that plan to continue to next screen or upgrade to a paid plan to enjoy the greater features of the site.</p>";
}

if($_SESSION['user_level'] == 1){
echo "<p>Currently, you are enrolled in the Memorial plan. This allows you upload memorials to your loved ones and others.</p>";
}

if($_SESSION['user_level'] == 2){
echo "<p>Currently, you are enrolled in the Standard Goodbye plan. This allows you upload and save standard Goodbyes.</p>";
}

if($_SESSION['user_level'] == 3){
echo "<p>Currently, you are enrolled in the Premium plan. This allows you upload and save standard Goodbyes, upload videos, and say goodbye to multiple individuals.</p>";
}

echo "<h2><a href=\"subscriptions.php\">Upgrade to Subscription Plan?</a></h2>\n";
echo "<hr>\n";

// Call mysql to get info in system
// Call mysql to get info in system
// Call mysql to get info in system

$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];

$result = mysql_query("SELECT * FROM users WHERE userid='$data_u' AND email_address='$data_e' LIMIT 1");
$row = mysql_fetch_assoc($result);
$d1 = $_SESSION['plan_name']		 = $row['plan_name'];
$d2 = $_SESSION['goodbyes']			 = $row['goodbyes'];
$d3 = $_SESSION['usps_mailings']	 = $row['usps_mailings'];
$d4 = $_SESSION['videos']			 = $row['videos'];
$d5 = $_SESSION['memorials']		 = $row['memorials'];
$d6 = $_SESSION['first_name']		 = $row['first_name'];
$d7 = $_SESSION['middle_name']		 = $row['middle_name'];
$d8 = $_SESSION['last_name']		 = $row['last_name'];
$d9 = $_SESSION['email_address']	 = $row['email_address'];
$d10 = $_SESSION['username']		 = $row['username'];
//$d11 = $_SESSION['password']		 = $row['password'];
$d12 = $_SESSION['info']			 = $row['info'];
$d13 = $_SESSION['user_level']		 = $row['user_level'];
$d14 = $_SESSION['signup_date']		 = $row['signup_date'];
$d15 = $_SESSION['last_login']		 = $row['last_login'];
$d16 = $_SESSION['birthday']		 = $row['birthday'];
$d17 = $_SESSION['date_of_death']	 = $row['date_of_death'];
$d18 = $_SESSION['gender']			 = $row['gender'];
$d19 = $_SESSION['avatar']			 = $row['avatar'];
$d20 = $_SESSION['street_address']	 = $row['street_address'];
$d21 = $_SESSION['city']			 = $row['city'];
$d22 = $_SESSION['state']			 = $row['state'];
$d23 = $_SESSION['zip']				 = $row['zip'];
$d24 = $_SESSION['phone']			 = $row['phone'];
$d25 = $_SESSION['promo_emails']	 = $row['promo_emails'];
$d26 = $_SESSION['country']			 = $row['country'];


echo "<form action=\"my_account.php\" method=\"post\" enctype=\"multipart/form-data\">\n";
// provide trigger to update
echo "<input name=\"doupdate\" type=\"hidden\" value=\"doupdate\"><br>\n";
echo "<input name=\"user_level\" type=\"hidden\" value=\"$d13\"><br>\n";
echo "<input name=\"avatar\" type=\"hidden\" value=\"$d19\"><br>\n";

echo "<p><b>Avatar:</b> " . $d19 . "</p>\n";
echo "<p><img src=\"./avatar/$d19\" alt=\"Your Avatar\" height=\"75\" width=\"75\" border=\"1\"><br><a href=\"change_avatar2.php\">Update Avatar</a></p>\n";

echo "<p><b>Plan Name:</b> " . $d1 . "<br>\n";
echo "<input name=\"plan_name\" type=\"hidden\" value=\"$d1\">\n";

echo "<b>Goodbyes:</b> " . $d2 . "<br>\n";
echo "<input name=\"goodbyes\" type=\"hidden\" value=\"$d2\">\n";

echo "<b>USPS Mailing:</b> " . $d3 . "<br>\n";
echo "<input name=\"usps_mailings\" type=\"hidden\" value=\"$d3\">\n";

echo "<b>Videos:</b> " . $d4 . "<br>\n";
echo "<input name=\"videos\" type=\"hidden\" value=\"$d4\">\n";

echo "<b>Memorials:</b> " . $d5 . "<br>\n";
echo "<input name=\"memorials\" type=\"hidden\" value=\"$d5\">\n";

echo "<b>Date of signup:</b> " . $d14 . "<br>\n";
echo "<input name=\"signup_date\" type=\"hidden\" value=\"$d14\">\n";

echo "<b>Last Logged in:</b> " . $d15 . "<br>\n";
echo "<input name=\"last_login\" type=\"hidden\" value=\"$d15\">\n";


echo "<label>First Name <input id=\"fname\"
 name=\"first_name\" size=\"50\" value=\"$d6\"></label><br>\n";

echo "<label>Middle Name or Initial <input id=\"mname\"
 name=\"middle_name\" size=\"50\" value=\"$d7\"></label><br>\n";

echo "<label>Last Name <input id=\"lname\"
 name=\"last_name\" size=\"50\" value=\"$d8\"></label><br>\n";

echo "<label>E-mail <input id=\"email\"
 name=\"email_address\" size=\"50\" value=\"$d9\"></label><br>\n";

echo "<label>Username <input id=\"username\"
 name=\"username\" size=\"50\" value=\"$d10\"></label><br>\n";

echo "<label>New Password <input id=\"password\"
 name=\"password\" size=\"50\" value=\"\"></label><br>\n";
 
echo "<label>Tell a little about yourself here... <input id=\"info\"
 name=\"info\" size=\"50\" value=\"$d12\"></label><br>\n";
 
echo "<label>Birthday (MM/DD/YYYY) <input id=\"birthday\"
 name=\"birthday\" size=\"50\" value=\"$d16\"></label><br>\n";
 
echo "<label>Date of Death (MM/DD/YYYY) <input id=\"date_of_death\" name=\"date_of_death\" size=\"50\" value=\"$d17\"></label><br>\n";

if ($d18 == "male") {
echo "<label>Gender: <input name=\"gender\"
 type=\"radio\" value=\"male\" checked> male &nbsp;&nbsp;&nbsp;<input name=\"gender\" type=\"radio\" value=\"female\"> female</label><br>\n";
} else if ($d18 == "female") {
echo "<label>Gender: <input name=\"gender\"
 type=\"radio\" value=\"male\"> male &nbsp;&nbsp;&nbsp;<input name=\"gender\" type=\"radio\" value=\"female\" checked> female</label><br>\n";
} else {
echo "<label>Gender: <input name=\"gender\"
 type=\"radio\" value=\"male\"> male &nbsp;&nbsp;&nbsp;<input name=\"gender\" type=\"radio\" value=\"female\"> female</label><br>\n";
}
 
echo "<label>Street Address <input id=\"street_address\"
 name=\"street_address\" size=\"50\" value=\"$d20\"></label><br>\n";
 
echo "<label>City <input id=\"city\"
 name=\"city\" size=\"50\" value=\"$d21\"></label><br>\n";
 
echo "<label>State <input id=\"state\"
 name=\"state\" size=\"50\" value=\"$d22\"></label><br>\n";
 
echo "<label>Zip <input id=\"zip\"
 name=\"zip\" size=\"50\" value=\"$d23\"></label><br>\n";
 
echo "<label>Phone <input id=\"phone\"
 name=\"phone\" size=\"50\" value=\"$d24\"></label><br>\n";
 
 echo "<label>Country <input id=\"country\"
 name=\"country\" size=\"50\" value=\"$d26\"></label><br>\n";

echo "<b>Receive E-mailings:</b> " . $d25 . "<br>\n";

if ($d25 == true) {
echo "<label><input id=\"promo_emails\" name=\"promo_emails\"
 type=\"checkbox\" value=\"true\" checked> Please send promotional emails</label><br>\n";
} else {
echo "<label><input id=\"promo_emails\" name=\"promo_emails\"
 type=\"checkbox\" value=\"true\"> Please send promotional emails</label><br>\n";

}
 
echo "<input type=\"submit\" value=\"Save\">\n";
echo "</form>\n";
    
    
// end of logged in conditional
} else {
    echo "Please <a href=\"login.php\">log in</a> first to see this page.";
}


//$sql = mysql_query("UPDATE users SET password = '$db_password', record_update = '$date_stamp' WHERE username = '$user_name' AND email_address = '$email_address'");

?>

<hr>

<br><br><br>


<?php require("../development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php require("../include/footer_code.html") ?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<!--<script src="js/validate4.js"></script>-->

<script>

$('form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});

$('#first_name').plum('form.verify', { min: 1 });
$('#middle_name').plum('form.verify', { min: 1 });
$('#last_name').plum('form.verify', { min: 1 });
$('#info').plum('form.verify', { min: 0 });
$('#birthday').plum('form.verify', { min: 1 });
$('#date_of_death').plum('form.verify', { min: 0 });
$('#street_address').plum('form.verify', { min: 4 });
$('#city').plum('form.verify', { min: 1 });
$('#state').plum('form.verify', { min: 2 });
$('#zip').plum('form.verify', { min: 5 });
$('#phone').plum('form.verify', { method: 'tel' });
	
// Validate email address
$('#email').plum('form.verify', { method: 'email' });

$('#email-retype').plum('form.verify', function () {
var email = $('#email').val();
return email && email === this.value;
});

// Custom validation: username must be all lowercase and minimum 4 characters
$('#user_name').plum('form.verify', function () {
	return /[a-z]{4}/.test(this.value);
});


</script>

</body>
</html>
