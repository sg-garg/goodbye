<?php
session_start();
$_SESSION['ver'] = 1;
include 'db.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
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
<h3>Registration Check</h3>
<p>Please take note of any issues and correct to complete registration process.</p>

<?php


// Define post fields into simple variables
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$email_address = $_POST['email_address'];
$password = $_POST['passwordj'];
$birthday = $_POST['birthday'];
$alive = 1;
$gender = $_POST['gender'];
if ($gender = "male") {
	$avatar = "default_avatar_male.jpg";
	} else {
		$avatar = "default_avatar_female.jpg";
		}
$tos = $_POST['agree-to-tos'];
$promo = $_POST['agree-to-promo'];
$plan_name = "Registration Only";
// - Add these: middle_name, birthday, alive (1), gender, avatar, terms_of_service, promo_emails


/* Let's strip some slashes in case the user entered
any escaped characters. */
$first_name = stripslashes($first_name);
$middle_name = stripslashes($middle_name);
$last_name = stripslashes($last_name);
$email_address = stripslashes($email_address);
$password = stripslashes($password);
$birthday = stripslashes($birthday);
$username = strtolower($first_name[0] . $last_name);
 
function getIP() {
$ip;
if (getenv("HTTP_CLIENT_IP"))
$ip = getenv("HTTP_CLIENT_IP");
else if(getenv("HTTP_X_FORWARDED_FOR"))
$ip = getenv("HTTP_X_FORWARDED_FOR");
else if(getenv("REMOTE_ADDR"))
$ip = getenv("REMOTE_ADDR");
else
$ip = "UNKNOWN";
return $ip;

} 


// to keep good records, make sure this is in db
$ip_address = getIp();
	echo "Client IP: " . $ip_address;
date_default_timezone_set('America/New_York');
	$record_update = date('Y-m-d H:i:s');

/* Do some error checking on the form posted fields */
if((!$first_name) || (!$last_name) || (!$email_address) || (!$password)){
	echo 'You did not submit the following required information! <br />';
if(!$first_name){
	echo "&nbsp;&nbsp;&#8226; First Name is required.<br>";
}
if(!$last_name){
	echo "&nbsp;&nbsp;&#8226; Last Name is required.<br>";
}
if(!$email_address){
	echo "&nbsp;&nbsp;&#8226; Email Address is required.<br>";
}
if(!$password){
	echo "&nbsp;&nbsp;&#8226; Password is required.<br>";
}

// include 'join_form.html';
// Tell user to go back and fix

echo "<input type=\"button\" value=\"Go Back And Correct Form\" onclick=\"history.back(-1)\">";


/* End the error checking and if everything is ok, we'll move on to
creating the user account */
//exit(); // if the error checking has failed, we'll exit the script!
}


/* Let's do some checking and ensure that the user's email address or username
does not exist in the database */
$sql_email_check = mysql_query("SELECT email_address FROM users WHERE email_address='$email_address'");
//$sql_username_check = mysql_query("SELECT username FROM users WHERE username='$username'");
$email_check = mysql_num_rows($sql_email_check);
//$username_check = mysql_num_rows($sql_username_check);

// perform some logic checks
if(($email_check > 0) || (0 == 0)){
		echo "<h2>If there are no errors below, then your registration went through.  Please check your E-mail and respond to the activation link.<br />";

// * * * put email check BACK IN after development * * *
//      (((Don't want duplicate emails in system)))

if($email_check > 0) {
echo "<strong style=\"color:red\">&nbsp;&nbsp;&#8226; Your email address has already been used by another member in our database. Please go back and submit a different Email address!<br /></strong>";
unset($email_address);
}
		
//if($username_check > 0) {
//echo "The username you have selected has already been used by another member in our database.";
//unset($username);
//}

// include 'include/join_form.html';
//exit();  // exit the script so that we do not create this account!
}


/* Everything has passed both error checks that we have done.
It's time to create the account! */

/* Random Password generator.
http://www.phpfreaks.com/quickcode/Random_Password_Generator/56.php
We'll generate a random password for the
user and encrypt it, email it and then enter it into the db. */

function makeRandomPassword() {
	$salt = "abchefghjkmnpqrstuvwxyz0123456789";
	srand((double)microtime()*1000000);
	$i = 0;
	while ($i <= 7) {
		$num = rand() % 33;
		$tmp = substr($salt, $num, 1);
		//$pass = $pass . $tmp;
		$i++;
		}
		if (isset($pass)) {
		return $pass;
		}
	}
$random_password = makeRandomPassword();
$db_password = md5($random_password);

// Enter info into the Database.

// - Add these: middle_name, birthday, alive (1), gender, avatar, terms_of_service, promo_emails

//  And these: goodbyes, usps_mailings, videos, memorials

// $info2 = htmlspecialchars($info);


$sql = mysql_query("INSERT INTO users (
first_name,
middle_name,
last_name,
email_address,
username,
password,
birthday,
alive,
gender,
avatar,
terms_of_service,
promo_emails,
plan_name,
goodbyes,
usps_mailings,
videos,
memorials,
signup_date,
ip,
record_update)
       
VALUES(
'$first_name',
'$middle_name',
'$last_name',
'$email_address',
'$username',
'$password',
'$birthday',
'1',
'$gender',
'$avatar',
'$tos',
'$promo',
'$plan_name',
1,
0,
0,
1,
now(),
'$ip_address',
'$record_update')")
      
or die (mysql_error());

if(!$sql){
	echo 'There has been an error creating your account. Please contact the webmaster.';
} else {
	$userid = mysql_insert_id();

// Let's mail the user!

$subject = "Your Membership at eGoodbyes!";
$message = "Dear $first_name $last_name,
Thank you for registering at our website, http://www.egoodbyes.com
You are two steps away from logging in and accessing our exclusive members area.
To activate your membership,
please click here: https://www.egoodbyes.com/site/activate.php?id=$userid&code=$email_address

Once you activate your membership, you will be able to login
with the following information:
Username: $email_address
Password: $password (update this in account management)

Thanks!
The Webmaster
This is an automated response, please do not reply!";
mail($email_address, $subject, $message,
"From: eGoodbyes Webmaster <admin@egoodbyes.com>");

echo 'Your membership information has been mailed to your email address! Please check it and follow the directions!';

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
