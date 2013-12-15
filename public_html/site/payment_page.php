<?php
session_start();
$_SESSION['ver'] = 1;
include("db.php");
include("functions.php");
$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];
date_default_timezone_set('America/New_York');
$today = date("F j, Y, g:i a");

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
	} else {
	header("Location: " . $site_url . "/site/subscriptions.php");
	}
	// All 10 gathered, UPDATE/CREATE cookie with new expiration
$pdat = $g1."|".$g2."|".$g3."|".$invoice."|".$g5."|".$g6."|".$g7."|".$g8."|".$g9."|".$g10;
setcookie("ppage",$pdat,time()+3600); // exp in 1 hr
// ##################################

	$num = $g1 / 100;
	$amount = number_format(($num),2);
// Check facebook like status
//if ($_COOKIE['fblike'] == "true") {
//$liked_facebook = "1.00";
//} else { $liked_facebook = "0.00"; }
	
getIP();

$tr1 = $data_e;
$tr2 = $amount;
$tr3 = "xxxx-xxxx-xxxx-xxxx";
$tr4 = "xxxx";
$tr5 = "xxxx";
$tr6 = "0";
$tr7 = "0";
$tr8 = "0";
$tr9 = $data_u;
$tr10 = $today;
$tr11 = $ip;
$tr12 = $_COOKIE['fblike'];
$tr13 = $_SESSION['sessionID'];
	
	createInvoice($tr1,$tr2,$tr3,$tr4,$tr5,$tr6,$tr7,$tr8,$tr9,$tr10,$tr11,$tr12,$tr13);
	$invoice = mysql_insert_id();
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Membership Processing</title>

<?php require("include/head.html") ?>
<script language="javascript" type="text/javascript" src="coupon/coupon-check.js"></script>
<script language="javascript" type="text/javascript" src="coupon/calc_script_epay.js"></script>
<script language="javascript" type="text/javascript" >

function confirmRefresh() {
var okToRefresh = confirm("Do you really want to refresh the page?");
if (okToRefresh)
	{
			setTimeout("location.reload(true);",1500);
	}
}

</script>
<style type="text/css"> 
     .bottomline {border-style: none none solid none;border-width: 0px 0px 2px 0px;border-color: #39ad94 }
     .borderblock {border-color: #222222;border-width: 1px;border-style: solid;background-color: #ead6ff;padding: 0px;width: 650px;}
     .donotdisplay {display:none;}
     table.panama { background: url("img/vsmc-logo.png") no-repeat; } 
</style> 
</head>

<body onload="click_update()">
<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '489619547756822', // App ID from the App Dashboard
      channelUrl : '//www.egoodbyes.com/facebook_channel.php', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });
    // Additional initialization code such as adding Event Listeners goes here
  };
  // Load the SDK's source Asynchronously
(function() {
     var e = document.createElement('script'); e.async = true;
     e.src = document.location.protocol +
       '//static.ak.fbcdn.net/connect/en_US/core.debug.js';
     document.getElementById('fb-root').appendChild(e);
   }());
</script>

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
	<p><form name="clear1" class="clear1" id="clear1"><input type="button" value=" BACK to previous page " onclick="history.go(-1);return false;" /></form></p>
	<!-- this is where prepared invoice will go  -->
	<p>Your plan was chosen on the previous page, now simply complete the following steps. Our low-cost subscriptions make it easy to start.</p>
	<table width="575" border="0" cellspacing="10" cellpadding="4">
	<!-- line 1 -->
<tr>
<td class="dotted" align="left"><img src="img/logo.png" alt="eGoodbyes" height="75" width="300" border="0"><br>
<h3>Invoice #<?php echo $invoice; ?></h3>
</td>
<td align="right" class="dotted"><p class="spmarginr"><?php echo $today; ?></p></td>
</tr>

<!-- line 2 -->
<tr>
<td class="dotted" align="left"><p class="spmarginl">
To:<br><?php echo $u1 . " " . $u2 . "<br>" . $u4 . "<br>" . $u5 . ", " . $u6 . " " . $u7; ?></p>
</td>

<td align="right" class="dotted"><p class="spmarginr">&nbsp;</p></td>
</tr>

<!-- line 3 Put plan in here -->
<tr>
<td class="dotted" align="left"><p class="spmarginl">Signup for plan: <b><?php echo $g3; ?></b></p>
</td>

<td align="right" class="dotted"><p class="spmarginr"><?php echo $amount; ?></p></td>
</tr>

<!-- line 5 -->
<tr>
<td class="dotted" align="left"><p class="spmarginl">
Discount Codes Applied <i>(Groupon, etc)</i>
</p>
</td>

<td align="right" class="dotted">
<!-- coupon code check -->
<h3 class="spmarginr" style="cursor:pointer;" onclick="click_go(); ajaxrequest('coupon/couponcheck.php', 'context')"><u>Click to Redeem</u></h3>
<p class="spmarginr"><input type="text" id="txt2" value=""></p>
<div id="context">Coupon Code</div>
</td>
</tr>


<?php
// Check if already received $1 off FB discount
if ($_COOKIE['fblike'] == "true") {
		$liked_facebook = "1.00";
		} else {
		$liked_facebook = "0.00";
		}

$fblikeresult = mysql_query("SELECT * FROM transactions WHERE userid_log='$data_u'");
$data1 = array();
while(($fbrow = mysql_fetch_array($fblikeresult))) {
    $data1[] = $fbrow['liked_facebook'];
    }
if (in_array("USED", $data1)){
	$USED_DISCOUNT = 1;
	$liked_facebook = "0.00";
 	}

if (!isset($USED_DISCOUNT)){
		$liked_facebook = "0.00";
		?>

		<!-- line 6 -->
		<tr>
		<td class="dotted" align="left">

		<p class="spmarginl">
		&nbsp;&nbsp;&nbsp;&#8226; Like us on Facebook ($1 Discount)<br>
		<?php

		if ($_COOKIE['fblike'] == "true") {
		$liked_facebook = "1.00";
		echo "<p class=\"spmarginl\"><b>(Confirmed)</b> You Like the eGoodbyes Facebook Page.</p>\n";
		} else {
		echo "<p class=\"spmarginl\"><fb:like href=\"https://www.facebook.com/Egoodbyes\" send=\"false\" width=\"200\" show_faces=\"false\"></fb:like><br><a href=\"like_us.php?fl=991s4\">Check permissions if not registering discount</a> <a href=\"javascript:confirmRefresh();\">Refresh Page</a></p>\n";
		}
		?>
		</p>
		<p class="spmarginl">&nbsp;&nbsp;&nbsp;&#8226; Follow Us on Twitter<br>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="https://twitter.com/egoodbyes" class="twitter-follow-button" data-width="300px" data-show-count="false" data-lang="en">Follow @egoodbyes</a></p>

		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</td>

		<td align="right" class="dotted"><p class="spmarginr">

		<!-- FACEBOOK LIKE SEGMENT -->
		<!-- FACEBOOK LIKE SEGMENT -->
		<!-- FACEBOOK LIKE SEGMENT -->

		<?php

		if ($_COOKIE['fblike'] == "true") {
		// Code here to display Facebook discount
		echo "<p style=\"color:red\" class=\"spmarginr\">(-1.00)</p>\n";	
		} else {
		echo "<p style=\"color:grey\" class=\"spmarginr\"><i>(n/a)</i><br>Like Us!</p>\n";
		}

		?>
		
	</td>
	</tr>


		<?php
		} // end of Check if already received $1 off FB discount

		?>

<!-- line 7 Put total in here -->
<tr>
<td class="dotted" align="left"><p class="spmarginl">Total with a discounts applied:</p></td>
<td align="right" class="dotted"><p id="final_total" class="spmarginr">FINAL TOTAL</p></td>
</tr>
</table>

<br><br><br>
<hr>

<?php
// make check to see if this is a process request, else, just provide form

if (isset($_REQUEST['process'])) {
     $process_form = $_REQUEST['process'];
      } else {
      $process_form = 0;
      }

?>

<form name="cc" action="payment_page-2.php" method="POST">
<h2>Transaction Data:</h2>
<input type="hidden" name="gby" value="<?php echo $g5; ?>">
<input type="hidden" name="usp" value="<?php echo $g6; ?>">
<input type="hidden" name="vid" value="<?php echo $g7; ?>">
<input type="hidden" name="mem" value="<?php echo $g8; ?>">
<input type="hidden" name="lev" value="<?php echo $g2; ?>">
<input type="hidden" name="fbl" value="<?php echo $u8; ?>">
<input type="hidden" name="f" value="<?php echo $g9; ?>">

<table width="650" border="0" class="panama">
<tr><td align="right" width="150">Invoice #:</td><td><!-- INVOICE --><input size="20" type="text" name="UMinvoice" value="<?php echo $invoice; ?>" readonly></td></tr>

<tr><td align="right">Amount:</td><td><!-- AMOUNT --><input size="20" id="ccamount" type="text" name="UMamount" value="" readonly></td></tr>

<tr><td align="right">Description:</td><td><!-- DESCRIPTION --><input size="20" type="text" name="UMdescription" value="<?php echo $g3; ?>" readonly></td></tr>

<tr><td align="right">Full Name<br>(as appears on card):</td><td valign="bottom"><!-- FULL NAME --><input size="20" type="text" name="UMname" value="<?php echo $u1 . " " . $u2; ?>"></td></tr>

<tr><td align="right">E-mail:</td><td><!-- EMAIL --><input size="20" type="text" name="UMcustemail" value="<?php echo $u3; ?>"></td></tr>

<tr><td align="right">&nbsp;</td><td><span style="font-size:smaller">Billing Address:</span></td></tr>

<tr><td align="right">Street:</td><td><!-- STREET --><input size="20" type="text" name="UMstreet" value="<?php echo $u4; ?>"></td></tr>

<tr><td align="right">City:</td><td><!-- CITY --><input size="20" type="text" name="city" value="<?php echo $u5; ?>"></td></tr>

<tr><td align="right">State:</td><td><!-- STATE --><input size="20" type="text" name="state" value="<?php echo $u6; ?>"></td></tr>

<tr><td align="right">Zip:</td><td><!-- ZIP --><input size="20" type="text" name="UMzip" value="<?php echo $u7; ?>"></td></tr>
</table>

<!-- IP address -->
<input type="hidden" name="UMip" value="<?php echo $_SERVER["REMOTE_ADDR"];?>">
<!-- ORDER -->
<input type="hidden" name="UMorderid" value="<?php echo $invoice; ?>">
<!-- ID -->
<input type="hidden" name="UMcustid" value="<?php echo $invoice; ?>">
<!-- COMMENTS -->
<input type="hidden" name="UMcomments" value="eGoodbyes is awesome!">

<!-- CC INFO -->
<div class="borderblock">
	<h1>Credit Card Info:</h1>
		<table width="650" border="0">
		<tr><td width="150">Card Type:</td><td>
		<select name="cardtype">
			<option>Visa</option>
			<option>Mastercard</option>
			<option>Amex</option>
			<option>Discover</option>
		</select>
		</td></tr>
	<tr><td>Card Number:</td><td><input size="20" type="text" id="UMcard" name="UMcard" value=""></td></tr>
	<tr><td>Expiration (MMYY):</td><td><input size="20" type="text" id="UMexpir" name="UMexpir" value=""></td></tr>
	<tr><td>Cvv2:</td><td><input size="20" type="text" id="UMcvv2" name="UMcvv2"></td></tr>
	<tr><td>&nbsp;</td><td><input size="20" type="submit" name="submit" value="Submit Payment"></td></tr>
	</table>
	


</form>

</div>

<br><br><br>


<div class="donotdisplay">
<form action="default.php" method="post" name="fin">

<p id="inv">Invoice: <input value="<?php echo $invoice; ?>" type="text" name="invoice" size="8" onBlur="addit()" onKeyPress="return disableEnterKey(event)"></p>

<p id="num1">Original Total: <input value="<?php echo $amount; ?>" type="text" name="plan_total" size="8" onBlur="addit()" onKeyPress="return disableEnterKey(event)"></p>

<p id="num2">Facebook Like: <input value="<?php echo $liked_facebook; ?>" type="text" name="facebook_like" size="8" onBlur="addit()" onKeyPress="return disableEnterKey(event)"></p>

<p id="num3">Groupon Amount: <input id="groupon_code" value="" type="text" name="groupon_code" size="8" onBlur="addit()" onKeyPress="return disableEnterKey(event)"></p>

<p id="num4">Final Total: <input id="final_total" value="<?php echo $amount; ?>" type="text" name="final_total" size="8" onBlur="addit()" onKeyPress="return disableEnterKey(event)"></p>

<input id="num5" type="image" name="submit5" src="img/next.png" alt="Payment Processing Page" border="0">

</form>
<p>[Temporarily Disabled]</p>

</div>


<?php

require("development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div> <!-- end #wrapper -->

	<div id="footer">
		<div class="content">
		<?php include("include/footer.php") ;?>
		</div> <!-- end content -->
	</div> <!-- end footer -->

</div> <!-- end wrapperA -->
	
<script src="js/validate-cc.js"></script>
</body>
</html>
