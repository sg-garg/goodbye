<?php
session_start();
$_SESSION['ver'] = 1;
include("db.php");
include("functions.php");
// Call mysql to get info in system
// Comment out what we do not need
$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];
date_default_timezone_set('America/New_York');
$today = date();
$today_b = date("F j, Y, g:i a");

getIP();

if(isset($_COOKIE['ppage'])){
// cookie ppage IS set, USE COOKIE
	$pdat = $_COOKIE['ppage'];
	$plandata = explode("|", $pdat);
    $g1 = $plandata[0]; //amt
    $g2 = $plandata[1]; //lev
    $g3 = $plandata[2]; //pln
    $g4 = $plandata[3]; //inv
    $g5 = $plandata[4];    //gby
    $g6 = $plandata[5];    //usp
    $g7 = $plandata[6];    //vid
    $g8 = $plandata[7];    //mem
    $g9 = $plandata[8];  //exa
    $g10 = $plandata[9]; //exb
	}

// Insert / Update new data
$invoice = $_POST['UMinvoice'];
$amount = $_POST['UMamount'];
$cctype = $_POST['cardtype'];
$ccnum = $_POST['UMcard'];
$ccexp = $_POST['UMexpir'];
if ($cctype == "Amex"){
	// take last 3 digits
	$new_card = "xxxx-xxxx-xxx" . substr($ccnum,-4,4);
	} else {
		// take last 4 digits
		$new_card = "xxxx-xxxx-xxxx-" . substr($ccnum,-4,4);
		}

function recordTrans($s1,$s2,$s3,$s4,$s5,$s6,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9){
$xx1 = $_COOKIE['ppage'];
$xx2 = $_COOKIE['uuser'];
$fflagg = $_POST['f'];
if ($_COOKIE['fblike'] == "true") {
$fblike = "USED";
}
$query ="UPDATE transactions 
             SET amount = '$s1',
              credit_card = '$s2',
              exp_date = '$s3',
              cvv2 = 'null',
              extra1 = '$xx1',
              extra2 = '$xx2',
              liked_facebook = '$fblike',
              ip_address = '$s5',
              session_code = '$s6' 
              WHERE invoice_number = '$s4' LIMIT 1";
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
/*
      Add TO!  Do not overwrite old values.  Must ADD to
      Pull old values FIRST, must define variables IN FUNKTION
*/
  
     
$aa1 = $_SESSION['goodbyes'];		// orig value
$bb1 = $_SESSION['usps_mailings'];	// orig value
$cc1 = $_SESSION['videos'];			// orig value
$dd1 = $_SESSION['memorials'];		// orig value

	$aa2 = $_POST['gby'];			// New value
	$bb2 = $_POST['usp'];			// New value
	$cc2 = $_POST['vid'];			// New value
	$dd2 = $_POST['mem'];			// New value

		$ee1 = $_SESSION['user_level'];		// orig value
		$ee2 = $_POST['lev'];				// New value
		$v1 = max($ee1,$ee2); // max takes the higher value
		
// NEW VALUSE		
$aatotal = $aa1 + $aa2;
$bbtotal = $bb1 + $bb2;
$cctotal = $cc1 + $cc2; //possible condition, user brout a vid/mem, then upgraded
$ddtotal = $dd1 + $dd2;

		$vupdate = max($cc1,$cc2); //this code is pointless!
		$mupdate = max($dd1,$dd2);

// CONDITION: ONLY ADD TO Video
if ($fflagg == "a"){
$query ="UPDATE users 
             SET videos = '$cctotal',
              record_update = '$v7' 
              WHERE (userid = '$v8' AND email_address = '$v9') LIMIT 1";
             mysql_query($query)or die("Error ".mysql_error());
}
// CONDITION: ONLY ADD TO Memorial
if ($fflagg == "b"){
$query ="UPDATE users 
             SET memorials = '$ddtotal',
              record_update = '$v7' 
              WHERE (userid = '$v8' AND email_address = '$v9') LIMIT 1";
             mysql_query($query)or die("Error ".mysql_error());
}
// CONDITION: Upgrade Plan, (0 to 2) or (2 to 3)
if ($fflagg == "c"){
$query ="UPDATE users 
             SET user_level = '$v1',
              plan_name = '$v2',
              goodbyes = '$aa2',
              usps_mailings = '$bb2',
              videos = '$cctotal',
              memorials = '$ddtotal',
              record_update = '$v7' 
              WHERE (userid = '$v8' AND email_address = '$v9') LIMIT 1";
             mysql_query($query)or die("Error ".mysql_error());
}
// CONDITION: Select A Plan, 2 or 3 (Standard -OR- Premium) (NOT AN UPGRADE)
if ($fflagg == "d"){
$query ="UPDATE users 
             SET user_level = '$v1',
              plan_name = '$v2',
              goodbyes = '$v3',
              usps_mailings = '$v4',
              videos = '$cctotal',
              memorials = '$ddtotal',
              record_update = '$v7' 
              WHERE (userid = '$v8' AND email_address = '$v9') LIMIT 1";
             mysql_query($query)or die("Error ".mysql_error());
}


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


function emailCustomer($inv1,$inv2,$inv3,$inv4,$inv5,$inv6){
//Must send TOemail, fullname, inv#, date, amt, description
    $ToEmail = $inv1;
    $EmailSubject = "Invoice from eGoodbyes.com\r\n";
    $mailheader = "From: webmaster@egoodbyes.com\r\n";
    $mailheader .= "Bcc: michaelsaggio@hotmail.com\r\n";
    $mailheader .= "Reply-To: webmaster@egoodbyes.com\r\n";
    $mailheader .= "Content-type: text/plain; charset=utf-8\r\n";
    $MESSAGE_BODY = "    Account Owner: ". $inv2 . "
    For: " . $inv6 . "
    Thank you for your purchase today.  Please contact support@egoodbyes.com if there are any questions or issues.\n
    Invoice#: " . $inv3 . "
    Date: " . $inv4 . "
    Amount: ". $inv5 . "
    \n
    --
    Webmaster,
    http://www.eGoodbyes.com
    Say Goodbye Now, Be Remembered Forever\r\n";
    
    //echo "TO: ".$ToEmail."<br>SUB: ".$EmailSubject."<br>BODY: ".$MESSAGE_BODY."<br>HEAD: ".$mailheader."<br><hr>";
    
    mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure");

}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Payment Processing</title>
<?php require("include/head.html") ?>
<script language="javascript" type="text/javascript" src="coupon/coupon-check.js"></script>
<script language="javascript" type="text/javascript" src="coupon/calc_script_epay.js"></script>

<style type="text/css"> 
     .bottomline {border-style: none none solid none;border-width: 0px 0px 2px 0px;border-color: #39ad94 }
     .borderblock {border-color: #222222;border-width: 1px;border-style: solid;background-color: #ead6ff;padding: 0px;width: 650px;}
     .donotdisplay {display:none;}
     table.panama { background: url("img/vsmc-logo.png") no-repeat; } 
</style> 
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
	
	<p><form><input type="button" value=" BACK to previous page " onclick="history.go(-1);return false;" /></form></p>
	
	<!-- this is where prepared invoice will go  -->
	<p>Your Transaction is being processed.</p>
	
	
<?php
		$s1 = $amount;
		$s2 = $new_card;
		$s3 = $ccexp;
		$s4 = $invoice;
		$s5 = $_SERVER["REMOTE_ADDR"];
		$s6 = $_REQUEST['EGB'];
		$v1 = $g2;
		$v2 = $g3;
		$v3 = $g5;
		$v4 = $g6;
		$v5 = $g7;
		$v6 = $g8;
		$v7 = $today;
		$v8 = $data_u;
		$v9 = $data_e;
// make check to see if this is a process request, else, just provide form
$ip = $_REQUEST ['UMip'];
$card = $_REQUEST ['UMcard'];
$expir = $_REQUEST ['UMexpir'];
$cvv2 = $_REQUEST ['UMcvv2'];
$invoice = $_REQUEST ['UMinvoice'];
$amount = $_REQUEST ['UMamount'];
$description = $_REQUEST ['UMdescription'];
//$comments = $_REQUEST ['UMcomments'];
$fullname = $_REQUEST ['UMname'];
$custemail = $_REQUEST ['UMcustemail'];
$address = $_REQUEST ['UMstreet'];
$city = $_REQUEST ['city'];
$state = $_REQUEST ['state'];
$zip = $_REQUEST ['UMzip'];
$custid = $_REQUEST ['UMcustid'];
$orderid = $_REQUEST ['UMorderid'];
$country = $_REQUEST ['UMbillcountry'];

// This file MUST be included!!
     include "/home/goodbye/public_html/site/ep/usaepay.php";

// Instantiate USAePay client object
$tran=new umTransaction;
$tran->cabundle="/home/goodbye/public_html/site/ep/curl-ca-bundle.crt";
$tran->key="GE4HaE22zaP4FlaWKnotM0t3c2c47Xa6";
$tran->pin="1234";
$tran->command="sale";
$tran->orderid=$orderid;
$tran->custid=$custid;
$tran->currency="USD";
$tran->ip=$ip;
$tran->testmode=0;
$tran->card=$card;		
$tran->exp=$expir;
$tran->cvv2=$cvv2;
$tran->amount=$amount;			
$tran->invoice=$invoice;   		
$tran->cardholder=$fullname; 	
$tran->street=$address;	
$tran->zip=$zip;			
$tran->description="Online Order: $description";	
//$tran->proxyurl="https://www.egoodbyes.com:80";
//$tran->usesandbox=true;

echo "<h3>Please Wait One Moment While We process your card.</h3>\n";

//flush();

ob_start();
if($tran->Process()){
	echo "<b>Card approved</b><br>";
	echo "<b>Authcode:</b> " . $tran->authcode . "<br>";
	echo "<b>AVS Result:</b> " . $tran->avs_result . "<br>";
	echo "<b>Cvv2 Result:</b> " . $tran->cvv2_result . "<br>";
	recordTrans($s1,$s2,$s3,$s4,$s5,$s6,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9);
	//Must send TOemail, fullname, inv#, date, amt, description
	emailCustomer($custemail,$fullname,$invoice,$today_b,$amount,$description);
/* Redirect browser */
header("Location:payment-accepted.php");
} else {
	echo "<b>Card Declined</b> (" . $tran->result . ")<br>";
	echo "<b>Reason:</b> " . $tran->error . "<br>";	
	echo "<b>Raw Result:</b> " . $tran->rawresult . "<br>";
	echo "<b>Result Code:</b> " . $tran->resultcode . "<br>";
// recordTrans($s1,$s2,$s3,$s4,$s5,$s6,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9); // remove for production
	/* Redirect browser */
header("Location:payment-declined.php");
	if($tran->curlerror) echo "<b>Curl Error:</b> " . $tran->curlerror . "<br>";	
}

     
?>
<br><br>
<hr>
<br><br>
<?php require("development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div> <!-- end #wrapper -->

	<div id="footer">
		<div class="content">
		<?php include("include/footer.php") ;?>
		</div> <!-- end content -->
	</div> <!-- end footer -->

</div> <!-- end wrapperA -->
	
<!--<script src="js/validate5.js"></script>-->
</body>
</html>
