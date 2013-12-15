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
$query ="UPDATE transactions 
             SET amount='$amount',
              credit_card='$new_card',
              exp_date='$ccexp',
              cvv2='null'
              WHERE invoice_number='$g4'";
             mysql_query($query)or die("Error ".mysql_error());
// if successfull
if($query) {
   if(mysql_affected_rows($query)){
      echo mysql_affected_rows($query) . " rows updated";
} else {
	echo "<p style=\"color:green\">No rows updated: <br />\n" . htmlspecialchars($query) . "</p>";
	}
	} else {
	echo "<p style=\"color:red\">ERROR</p>";
}  
// mysql debug

$query ="UPDATE users 
             SET user_level='$g2',
              plan_name='$g3',
              goodbyes='$g5',
              usps_mailings='$g6',
              videos='$g7',
              memorials='$g8',
              record_update='$today',
              WHERE userid='$data_u'
              AND email_address='$data_e'";
             mysql_query($query)or die("Error ".mysql_error());
// if successfull
if($query) {
   if(mysql_affected_rows($query)){
      echo mysql_affected_rows($query) . " rows updated";
} else {
	echo "<p style=\"color:green\">No rows updated: <br />\n" . htmlspecialchars($query) . "</p>";
	}
	} else {
	echo "<p style=\"color:red\">ERROR</p>";
}  
// mysql debug
             
             
             }

function DoNotDo(){
$update_trans = "UPDATE transactions SET amount='$amount', credit_card='$new_card', exp_date='$ccexp', cvv2='null' WHERE invoice_number='$g4'";
//$result1=mysql_query($update_trans);
mysql_query($update_trans)or die("Error ".mysql_error());

// Update users
$update_user = "UPDATE users SET user_level='$g2', plan_name='$g3', goodbyes='$g5', usps_mailings='$g6', videos='$g7', memorials='$g8', record_update='$today' WHERE userid='$data_u' AND email_address='$data_e'";
//$result2=mysql_query($update_user);
mysql_query($update_user)or die("Error ".mysql_error());

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
	
function createInvoice($tr1,$tr2,$tr3,$tr4,$tr5,$tr6,$tr7,$tr8,$tr9,$tr10,$tr11,$tr12,$tr13)
{

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
'$tr1',
'$tr2',
'$tr3',
'$tr4',
'$tr5',
'$tr6',
'$tr7',
'$tr8',
'$tr9',
'$tr10',
'$tr11',
'$tr12',
'$tr13')");

}

/*
if(isset($_COOKIE['ppage'])){
// cookie ppage IS set, USE COOKIE
	$pdat = $_COOKIE['ppage'];
	$plandata = explode("|", $pdat);
    $g1 = $plandata[0]; //amt
    $g2 = $plandata[1]; //lev
    $g3 = $plandata[2]; //pln
    $g4 = $plandata[3]; //inv
    $g5 = $plandata[4]; //gby
    $g6 = $plandata[5]; //usp
    $g7 = $plandata[6]; //vid
    $g8 = $plandata[7]; //mem
    $g9 = $plandata[8]; //exa
    $g10 = $plandata[9]; //exb
	}
	
if(isset($_COOKIE['uuser'])){
// cookie uuser IS set, USE COOKIE
	$udat = $_COOKIE['uuser'];
	$udata = explode("|", $udat);
      $u1 = $udata[0]; //fname d6
      $u2 = $udata[1]; //lname d8
      $u3 = $udata[2]; //email d9
      $u4 = $udata[3]; //street d20
      $u5 = $udata[4]; //city d21
      $u6 = $udata[5]; //state d22
      $u7 = $udata[6]; //zip d23
      $u8 = $udata[7]; //fb
	}
	// All 10 gathered, UPDATE/CREATE cookie with new expiration
$pdat = $g1."|".$g2."|".$g3."|".$invoice."|".$g5."|".$g6."|".$g7."|".$g8."|".$g9."|".$g10;
//setcookie("ppage",$pdat,time()+3600); // exp in 1 hr
// ##################################
*/

?>