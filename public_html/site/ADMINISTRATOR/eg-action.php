<?php
session_start();
$_SESSION['ver'] = 1;
include("../db.php");
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	

if($_SESSION['userid'] == '7'){
$user = $_SESSION['userid'];
setcookie("username",urlencode($username),time()+36000);		
	} else {
	/* Redirect browser */
	header("Location: " . $site_url . "/site/admin.php");
}

$site_email = "webmaster@egoodbyes.com";
if(isset($_SESSION['userid'])) {$userid = $_SESSION['userid'];}
if(isset($_GET['accessid'])) {$access_id = $_GET['accessid'];}
if(isset($_GET['mid'])) {$message_id = $_GET['mid'];}    //specific for goodbyes
if(isset($_GET['vid'])) {$video_id = $_GET['vid'];}     //specific for video messages

/*
 Need recipient
 and these 3 from gb_messages database:
 	userid   <-- need
 	msg_id   <-- need
 	poc_id   <-- need
 	recipients name
 	date of message msg_date
 	whatever else
	salutation ??   <-- need
	
Next, get Point of contact info from pocontact database
		recipient_fn
		recipient_ln
		recip_email
		
Other data in pocontact
		
	userid			poc_id			prim
	recipient_fn	recipient_mi	recipient_ln
	relation
	recip_email      <----- NEED THIS
	conf_recip_email
	usps_mail		usps_mail2		city
	state			zip				country
	phone			notes			submitted
	ip

*/

if (isset($message_id)){
$result = mysql_query("SELECT * FROM gb_messages WHERE msg_id='$message_id' LIMIT 1");
$row = mysql_fetch_array($result) or die(mysql_error());
    $data1 = $row['userid'];
    $data2 = $row['msg_id'];
    $data3 = $row['poc_id'];
    $data4 = $row['salutation'];
    }
    
if (isset($video_id)){
$result = mysql_query("SELECT * FROM mem_vid_upload WHERE vid_id='$video_id' LIMIT 1");
$row = mysql_fetch_array($result) or die(mysql_error("No Recipient Found For This Video"));
    $data1 = $row['userid'];
    $data2 = $row['vid_id'];
    $data3 = $row['poc_id'];
    $data4 = $row['recipient'];
    
$result2 = mysql_query("SELECT * FROM pocontact WHERE poc_id='$data3' LIMIT 1");
$row2 = mysql_fetch_array($result2) or die(mysql_error("No POC Found"));
    $data5 = $row2['recip_email'];
    $data6 = $row2['recipient_fn'];
    $data7 = $row2['recipient_ln'];
    $data8 = $row2['usps_mail'];
    $data9 = $row2['usps_mail2'];
    $data10 = $row2['city'];
    $data11 = $row2['state'];
    $data12 = $row2['zip'];
    
    }

if (isset($access_id)) {
$result2 = mysql_query("SELECT * FROM pocontact WHERE poc_id='$access_id' LIMIT 1");
$row2 = mysql_fetch_array($result2) or die(mysql_error());
    $data5 = $row2['recip_email'];
    $data6 = $row2['recipient_fn'];
    $data7 = $row2['recipient_ln'];
    $data8 = $row2['usps_mail'];
    $data9 = $row2['usps_mail2'];
    $data10 = $row2['city'];
    $data11 = $row2['state'];
    $data12 = $row2['zip'];
    }
    
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Administration ACTION Page</title>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.plum.form.js"></script>

<link rel="stylesheet" href="img/all-style.css">
<!--[if lte IE 7]>
<link rel="stylesheet" href="../css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="../css/default.ie7.css">
<![endif]-->

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
			<?php include("../include/db-acct-info.php"); ?>

<div align="center">
<br><br>	
<form name="Tick"><input id="timestamp" type="text" size="20" name="Clock"></form>
</div>

<!--timestamp-->
<script>
function show(){var Digital=new Date();var year=Digital.getYear();if (year < 1000){year+=1900;}var day=Digital.getDay();var month=Digital.getMonth()+1;if (month<10){month="0"+month};var daym=Digital.getDate();if (daym<10){daym="0"+daym;}var hours=Digital.getHours();var minutes=Digital.getMinutes();var seconds=Digital.getSeconds();var dn="AM";if (hours>12){dn="PM";hours=hours-12;}if (hours==0){hours=12;}if (minutes<=9){minutes="0"+minutes;}if (seconds<=9){seconds="0"+seconds;}document.Tick.Clock.value=month+"/"+daym+"/"+year+" "+hours+":"+minutes+":"+seconds+" "+dn;setTimeout("show()",1000)}show();
</script>
</div> <!-- end content (SIDEBAR) -->
</div> <!-- end egcol2 -->
			
			<div id="egcol1">  <!-- start egcol1 -->
					<div class="content">
						<div align="center">
							<form name="admin"  action="eg-adminpage.php">
							<input type="submit" value="Return to Search" />
							</form>
						</div>
<!-- Start of content -->
		
		<H1>ACTION PAGE</H1>
		<h2>Message id and action taken here - mail to intended recipient</h2>
		
		<p>
		<b>User ID:</b> <?php echo $data1; ?><br>
		<b>Message ID:</b> <?php echo $data2; ?><br>
		<b>POC ID:</b> <?php echo $data3; ?><br>
		<b>Recipient's Email:</b> <?php echo $data5; ?><br>
		<b>First/Last Name:</b> <?php echo $data6 . " " . $data7; ?><br>
		<b>Salutation:</b> <?php echo $data4; ?><br>
		<b><u>For USPS only</u>:</b><br>
		<b>USPS Mail1:</b> <?php echo $data8; ?><br>
		<b>USPS Mail2:</b> <?php echo $data9; ?><br>
		<b>City, State, zip:</b> <?php echo $data10 . ", " . $data11 . " " . $data12; ?><br>
		</p>
		
		<h1>Click icon to print PDF for USPS mailings: <a href="../createpdf.php?userid=<?php echo $data1; ?>&poc_id=<?php echo $data3; ?>&msg_id=<?php echo $data2; ?>&submit=1"><img style="vertical-align: middle;" src="img/cool_icon100x100.png" alt="pdf" height="75" width="75" border="0"></a></h1>

<hr>
<?php
if (isset($_POST['email'])) {
    $ToEmail = $_POST['name'];
    $EmailSubject = "A message from eGoodbyes.com";
    $mailheader = "From: ".$_POST['email']."\r\n";
    $mailheader .= "Reply-To: ".$site_email."\r\n";
    $mailheader .= "Content-type: text/html; charset=utf-8\r\n";
    //$MESSAGE_BODY = "Name: ".$_POST['name']."\r\n";
    //$MESSAGE_BODY .= "Email: ".$_POST['email']."\r\n";
    $MESSAGE_BODY = "\r\n".nl2br($_POST['comment'])."\r\n";
    
    echo "TO: ".$ToEmail."<br>SUB: ".$EmailSubject."<br>BODY: ".$MESSAGE_BODY."<br>HEAD: ".$mailheader."<br><hr>";
    
    mail($ToEmail, $EmailSubject, $MESSAGE_BODY, $mailheader) or die ("Failure");
    
    echo "<h1 style=\"color:red\">E-mail message sent</h1>";
} else {

?>
<hr>

<form action="eg-action.php" method="post">
<table width="560" border="1" cellspacing="2" cellpadding="0">
<tr>
<td width="29%" class="bodytext">Recipient (sent TO):</td>
<td width="71%"><input name="name" type="text" id="name" size="32" value="<?php echo $data5; ?>"></td>
</tr>
<tr>
<td class="bodytext">Email address (sent from US):</td>
<td><input name="email" type="text" id="email" size="32" value="scott@atalantawebdesign.com"></td>
</tr>
<tr>
<td class="bodytext">Message to be sent:</td>
<td><textarea name="comment" cols="45" rows="6" id="comment" class="bodytext">Dear, <?php

echo $data6." ".$data7."\n"; ?>

Insert Message HERE...

--
Thank You,

Webmaster@egoodbyes.com

&#34;Say goodbye now, be remembered forever.&#34;
</textarea>

</td>
</tr>
<tr>
<td class="bodytext"> </td>
<td align="left" valign="top"><input type="submit" name="Submit" value="Send"></td>
</tr>
</table>
</form>

<?php

}

echo "<h2>Response Form</h2>";

?>


<br><br><br>


<?php require("../development.php"); ?>

</div> <!-- end content -->
<!--</div>  end outer2 -->
</div> <!-- end #wrapper -->

			<div id="footer">
			<div class="content">
			<?php require("../include/footer_code.html") ?>
			</div> <!-- end content -->
			</div> <!-- end footer -->
			
			
</div> <!-- end wrapperA -->

</body>
</html>
