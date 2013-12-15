<?php

// function to check for max
function check_max($val){

$userid = $_SESSION['userid'];
mysql_connect("localhost", "egoodbye_dude", ")TOZUEgo5C3q") or die(mysql_error());
mysql_select_db("egoodbye_membership") or die(mysql_error());

//$pocontact1 = mysql_query( "SELECT count(*) FROM pocontact WHERE userid='$userid'" );
//$used_info2 = mysql_result($pocontact1, 0);

// Check account info
$infocheck2 = mysql_query("SELECT * FROM users WHERE userid='$userid' LIMIT 1");
$row = mysql_fetch_assoc($infocheck2);
//$info1 = $_SESSION['plan_name']			= $row['plan_name'];
//$info2 = $_SESSION['username']			= $row['username'];
$info3 = $_SESSION['goodbyes']			= $row['goodbyes'];
$info4 = $_SESSION['usps_mailings']		= $row['usps_mailings'];
$info5 = $_SESSION['videos']			= $row['videos'];
$info6 = $_SESSION['memorials']			= $row['memorials'];

/*
Email Messages:			2 of 10
Postal Mail Messages:	1 of 10
Video Uploads:			1 of 5
Memorials:				4 of 3

plan_name	goodbyes	usps_mailings	videos	memorials
*/

//check goodbyes
if ($val == "1"){
//column 'type' 1=mail message; 2=email message (I had this backwards!!)
	$goodbye1 = mysql_query( "SELECT count(*) FROM gb_messages WHERE userid='$userid' AND type='1'" );
	$used_info3 = mysql_result($goodbye1, 0);
	
	$usps1 = mysql_query( "SELECT count(*) FROM gb_messages WHERE userid='$userid' AND type='2'" );
	$used_info4 = mysql_result($usps1, 0);
	
	$GOOD_STRING = '<p style="color:#999999;font-size:small;">Used ' . $used_info4 . ' of ' . $info4 . ' USPS messages';
	$GOOD_STRING .= ' and ' . $used_info3 . ' of ' . $info3 . ' E-mail messages<br>';
	$GOOD_STRING .= '<select name="type" id="type">';
	$GOOD_STRING .= '<option value="">Select E-mail/USPS</option>';
	
	if (strval($used_info3) >= strval($info3)){
	$GOOD_STRING .= '<option value="">E-Mail Limit Reached</option>';
	} else {
	$GOOD_STRING .= '<option value="1">E-Mail</option>';
	}
	
	if (strval($used_info4) >= strval($info4)){
	$GOOD_STRING .= '<option value="">US Mail Limit Reached</option>';
	} else {
	$GOOD_STRING .= '<option value="2">US Mail</option>';
	}
	$GOOD_STRING .= '</select>';
	
	RETURN $GOOD_STRING;
}

//check USPS goodbyes
if ($val == "2"){
	$usps1 = mysql_query( "SELECT count(*) FROM gb_messages WHERE userid='$userid' AND type='2'" );
	$used_info4 = mysql_result($usps1, 0);
	
	if ($info4 <= $used_info4){
	header("Location: error-page.php?error=You have reached your USPS Goodbyes limit.");
	} 
}
//check videos
if ($val == "3"){
	$vidcheck1 = mysql_query( "SELECT count(*) FROM mem_vid_upload WHERE userid='$userid'" );
	$used_info5 = mysql_result($vidcheck1, 0);
	
	if ($info5 <= $used_info5){
	header("Location: error-page.php?error=You have reached your Video Goodebyes limit.");
	} 
}
//check memorials
if ($val == "4"){
	$memorial1 = mysql_query( "SELECT count(*) FROM memorials WHERE userid='$userid'" );
	$used_info6 = mysql_result($memorial1, 0);
	
	if ($info6 <= $used_info6){
	header("Location: error-page.php?error=You have reached your Memorials limit.");
	} 
}



}
?>
