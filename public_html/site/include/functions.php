<?php

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

function setppage(){
// Take down all GET sent, current post takes priority over cookie
         $g1 = $_GET["amt"];
         $g2 = $_GET["lev"];
         $g3 = $_GET["pln"];
         $g5 = $_GET["gby"];
         $g6 = $_GET["usp"];
         $g7 = $_GET["vid"];
         $g8 = $_GET["mem"];
         $g9 = $_GET["exa"];
        $g10 = $_GET["exb"];

		// All 10 gathered, UPDATE/CREATE cookie with new expiration
		$pdat = $g1."|".$g2."|".$g3."|".$invoice."|".$g5."|".$g6."|".$g7."|".$g8."|".$g9."|".$g10;
		setcookie("ppage",$pdat,time()+3600); // exp in 1 hr
}

function setudat(){
// Extract data for user, store in cookie
	$result = mysql_query("SELECT * FROM users WHERE userid='$data_u' AND email_address='$data_e' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$d6 = $_SESSION['first_name']		 = $row['first_name'];
	$d7 = $_SESSION['middle_name']		 = $row['middle_name'];
	$d8 = $_SESSION['last_name']		 = $row['last_name'];
	$d9 = $_SESSION['email_address']	 = $row['email_address'];
	$d10 = $_SESSION['username']		 = $row['username'];
	$d19 = $_SESSION['avatar']			 = $row['avatar'];
	$d20 = $_SESSION['street_address']	 = $row['street_address'];
	$d21 = $_SESSION['city']			 = $row['city'];
	$d22 = $_SESSION['state']			 = $row['state'];
	$d23 = $_SESSION['zip']				 = $row['zip'];

if ($_SESSION['liked_facebook'] == "true"){$fbl = "1"; } else { $fbl = "0"; }

	$udat = $d6."|".$d8."|".$d9."|".$d20."|".$d21."|".$d22."|".$d23."|".$fbl."|0|0";
	setcookie("uuser",$udat,time()+3600); // exp in 1 hr
	}
	
function writeToDatabase(){
// This segment processes data #############
// Update transactions
$update_trans = "UPDATE transactions SET amount='$amount', credit_card='$new_card', exp_date='$ccexp', cvv2='null' WHERE invoice_number='$g4'";
$result1=mysql_query($update_trans);

// Update users
$update_user = "UPDATE users SET user_level='$g2', plan_name='$g3', goodbyes='$g5', usps_mailings='$g6', videos='$g7', memorials='$g8', record_update='$today' WHERE userid='$data_u' AND email_address='$data_e'";
$result2=mysql_query($update_user);

// if successfull
if($result1) {
   if(mysql_affected_rows($result1)){
      echo mysql_affected_rows($result1) . " rows updated";
} else {
	echo "<p style=\"color:green\">No rows updated: <br />\n" . htmlspecialchars($update_trans) . "</p>";
	}
	} else {
	echo "<p style=\"color:red\">ERROR</p>";
}  
// next
if($result2) {
   if(mysql_affected_rows($result2)){
      echo mysql_affected_rows($result2) . " rows updated";
} else {
	echo "<p style=\"color:green\">No rows updated: <br />\n" . htmlspecialchars($update_user) . "</p>";
	}
	} else {
	echo "<p style=\"color:red\">ERROR</p>";
}
} 
	
function createBlankInvoice(){

$sql = mysql_query("INSERT INTO transactions (user_email,
amount,
credit_card,
exp_date,
cvv2,
extra1,
extra2,
extra3,
userid_log,
timestamp,
ip_address,
liked_facebook,
session_code)
       
VALUES(
'$email',
'0.00',
'xxxx-xxxx-xxxx-xxxx',
'xxxx',
'xxxx',
'0',
'0',
'0',
'$data_u',
'$time_stamp',
'$ip_address',
'$like_fb',
'$session_code')");

}

	
?>