<?php
session_start();
$_SESSION['ver'] = 1;
include("../db.php");
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	
$access_id = $_SESSION['accessid'] = $_GET['accessid'];

if($_SESSION['userid'] == '7'){
$user = $_SESSION['userid'];
setcookie("username",urlencode($username),time()+36000);		
	} else {
	/* Redirect browser */
	header("Location: " . $site_url . "/site/admin.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>EG Account Admin</title>

<link rel="stylesheet" href="../css/default.css">
<link rel="stylesheet" href="../css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="../css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="../css/default.ie7.css">
<![endif]-->
<script src="../js/jquery.js"></script>
<script src="../js/jquery.plum.form.js"></script>
<style>
body { padding: 0px; margin: 0px; background-image: url(img/grey-001c.jpg); font-size:76%; font-family:"trebuchet MS", verdana, arial, sans-serif;color: #353d6b;}
.content {color: #353d6b;}
</style>
</head>

<body>

<div id="minMax">
	<div id="header">
		<div align="center">
		<img src="img/grey-header-eGoodbyes.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
		</div> <!-- end of center -->
					<div class="content">&nbsp;</div>
	</div> <!-- end header -->

<div id="wrapper">

			<div id="egcol2">
			<div class="content">
			<!-- sidebar -->
			<h3>Sidebar</h3>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			<p>&nbsp;</p>
			</div> <!-- end content -->
			</div> <!-- end outer3 -->
			
<div id="egcol1">
<div class="content">
		<div align="center">
			<form name="admin"  action="eg-adminpage.php">
			<input type="submit" value="Return to Search" />
			</form>
		</div>
<h3>Account for userid: <?php echo $access_id; ?></h3>
<p>You may verify and update account information here.</p>

<?php

if (ISSET($_POST['doupdate'])) {

// This puts all post data I define into session

// $userid = $_SESSION['userid'];  // don't forget critical user id!!
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
$u27 = $_POST['death_cert'];
$u28 = $_POST['alive'];
// Provide some kind of feedback on what the user changed
// First Name
if ($_SESSION['first_name'] != $_POST['first_name']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; First Name has been updated</span><br>";
$sql = mysql_query("UPDATE users SET first_name = '$u6' WHERE userid = '$access_id'");}
// Middle Name
if ($_SESSION['middle_name'] != $_POST['middle_name']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Middle Name has been updated</span><br>";
$sql = mysql_query("UPDATE users SET middle_name = '$u7' WHERE userid = '$access_id'");}
// Last Name
if ($_SESSION['last_name'] != $_POST['last_name']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Last Name has been updated</span><br>";
$sql = mysql_query("UPDATE users SET last_name = '$u8' WHERE userid = '$access_id'");}
// Email
if ($_SESSION['email_address'] != $_POST['email_address']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; E-mail has been updated</span><br>";
$sql = mysql_query("UPDATE users SET email_address = '$u9' WHERE userid = '$access_id'");}
// Username
if ($_SESSION['username'] != $_POST['username']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Username has been updated</span><br>";
$sql = mysql_query("UPDATE users SET username = '$u10' WHERE userid = '$access_id'");}
// Password
if ($_SESSION['password'] != $_POST['password']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Password has been updated</span><br>";
$sql = mysql_query("UPDATE users SET password = '$u11' WHERE userid = '$access_id'");}
// info
if ($_SESSION['info'] != $_POST['info']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Info has been updated</span><br>";
$sql = mysql_query("UPDATE users SET info = '$u12' WHERE userid = '$access_id'");}
// birthday
if ($_SESSION['birthday'] != $_POST['birthday']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Birthday has been updated</span><br>";
$sql = mysql_query("UPDATE users SET birthday = '$u16' WHERE userid = '$access_id'");}
// date_of_death
if ($_SESSION['date_of_death'] != $_POST['date_of_death']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Date of Death has been updated</span><br>";
$sql = mysql_query("UPDATE users SET date_of_death = '$u17' WHERE userid = '$access_id'");}
//gender
if ($_SESSION['gender'] != $_POST['gender']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Gender has been updated</span><br>";
$sql = mysql_query("UPDATE users SET gender = '$u18' WHERE userid = '$access_id'");}
// Street Address
if ($_SESSION['street_address'] != $_POST['street_address']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Street Address has been updated</span><br>";
$sql = mysql_query("UPDATE users SET street_address = '$u20' WHERE userid = '$access_id'");}
// City
if ($_SESSION['city'] != $_POST['city']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; City has been updated</span><br>";
$sql = mysql_query("UPDATE users SET city = '$u21' WHERE userid = '$access_id'");}
// State
if ($_SESSION['state'] != $_POST['state']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; State has been updated</span><br>";
$sql = mysql_query("UPDATE users SET state = '$u22' WHERE userid = '$access_id'");}
// Zip
if ($_SESSION['zip'] != $_POST['zip']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Zip has been updated</span><br>";
$sql = mysql_query("UPDATE users SET zip = '$u23' WHERE userid = '$access_id'");}
// Phone
if ($_SESSION['phone'] != $_POST['phone']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Phone has been updated</span><br>";
$sql = mysql_query("UPDATE users SET phone = '$u24' WHERE userid = '$access_id'");}
// Promo email preference
if ($_SESSION['promo_emails'] != $_POST['promo_emails']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; E-mail preference has been updated</span><br>";
$sql = mysql_query("UPDATE users SET promo_emails = '$u25' WHERE userid = '$access_id'");}
// Country
if ($_SESSION['country'] != $_POST['country']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Country has been updated</span><br>";
$sql = mysql_query("UPDATE users SET country = '$u26' WHERE userid = '$access_id'");}
// Death Certificate
if ($_SESSION['death_cert'] != $_POST['death_cert']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; Death_Cert has been updated</span><br>";
$sql = mysql_query("UPDATE users SET death_cert = '$u27' WHERE userid = '$access_id'");}

// Alive / Dead
if ($_SESSION['death_cert'] != $_POST['alive']) {
echo "<span class=\"errortext\">&nbsp;&nbsp;&#8226; <i>Alive Status</i> has been updated</span><br>";
$sql = mysql_query("UPDATE users SET alive = '$u28' WHERE userid = '$access_id'");}

}

$result = mysql_query("SELECT * FROM users WHERE userid='$access_id' LIMIT 1");
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
$d27 = $_SESSION['death_cert']		= $row['death_cert'];
$d28 = $_SESSION['alive']		= $row['alive'];

echo "<div id=\"account_info\">";
echo "<form id=\"account_info\" action=\"eg-editaccount.php?accessid=$access_id\" method=\"post\" enctype=\"multipart/form-data\">\n";
// provide trigger to update
echo "<input name=\"doupdate\" type=\"hidden\" value=\"doupdate\">\n";
echo "<input name=\"user_level\" type=\"hidden\" value=\"$d13\">\n";
echo "<input name=\"avatar\" type=\"hidden\" value=\"$d19\">\n";

echo "<p><b>Avatar:</b> " . $d19 . "</p>\n";
echo "<p><img src=\"../avatar/$d19\" alt=\"Your Avatar\" height=\"75\" width=\"75\" border=\"1\"><br><a href=\"#\">Update Avatar <i>disabled</i></a></p>\n";

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
 name=\"country\" size=\"50\" value=\"$d26\"></label><br><hr><br>\n";
 

echo "<b>Receive E-mailings:</b> " . $d25 . "<br>\n";

if ($d25 == "true") {
		echo "<label><input id=\"promo_emails\" name=\"promo_emails\"
			 type=\"checkbox\" value=\"true\" checked> Please send promotional emails</label><br>\n";
			} else {
		echo "<label><input id=\"promo_emails\" name=\"promo_emails\"
			 type=\"checkbox\" value=\"true\"> Please send promotional emails</label><br>\n";
			}

 echo "<hr><br>\n";
 echo "<label>Alive Status <input id=\"alive\"
 name=\"alive\" size=\"50\" value=\"$d28\"></label> (1=alive, 0=dead)<br>\n";
 
 echo "<hr><br>\n";

 echo "<label>Death Certificate <input id=\"death_cert\"
 name=\"death_cert\" size=\"50\" value=\"$d27\"></label><br>\n";
 
echo "<input type=\"submit\" value=\"Save\">\n";
echo "</form>\n";

echo "<h1>Death Certificate on File:</h1>\n";

if ($d27 != ""){
	echo "<p><a href=\"dcertificates/$d27\" target=\"_blank\"><img src=\"img/pdf-icon400.jpg\" title=\"Death Certificate\" height=\"190\" width=\"190\" border=\"0\"></a>\n";
	} else {
	echo "<h2>Status: <i>No Death Certificate on file yet.</i></h2>\n";
	}
    
// end of logged in conditional [taken out]
//Add Death Certificate Upload

?>

</div> <!-- end of content -->

<a name="mycode"></a>

	<div class="upload_form_cont">

	<form id="upload_form" name="uf" enctype="multipart/form-data" method="post" action="jssccode/upload-script.php">
	<div>
	<div><label for="image_file">Select PDF file to upload</label></div>
	<div><input type="file" name="image_file" id="image_file" onchange="fileSelected();" /></div>
	</div>

	<div id="fileinfo">
		<div id="filename"></div>
		<div id="filesize"></div>
		<div id="filetype"></div>
		<div id="filedim"></div>
	</div>

	<div id="error">You must select valid file formats, ie: .PDF, .JPG</div>

	<div id="error2">An error occurred while uploading the file</div>

	<div id="abort">The upload has been canceled by the user or the browser dropped the connection</div>

	<div id="warnsize">Your file is very big. We can't accept it. Please select more small file</div>
	<div id="progress_info">
	<div id="progress"></div>
	<div id="progress_percent">&nbsp;</div>
	<div class="clear_both"></div>
		<div>
		<div id="speed">&nbsp;</div>
		<div id="remaining">&nbsp;</div>
		<div id="b_transfered">&nbsp;</div>
		<div class="clear_both"></div>
		</div>
	<div id="upload_response"></div>
	</div>
	<img id="preview" />

<div>
<input type="button" value="Upload" onclick="startUploading();" />
</div>

</form>


<hr>

<br><br><br>

</div> </div>
</div> <!-- end outer2 -->
</div> <!-- end #wrapper -->

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

<script src="js/upload-script.js"></script>
<link href="js/upload-main.css" rel="stylesheet" type="text/css" />

</body>
</html>
