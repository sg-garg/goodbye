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

if(isset($_SESSION['userid'])) {$userid = $_SESSION['userid'];}
if(isset($_GET['aid'])) {$access_id = $_GET['aid'];}
if(isset($_GET['mid'])) {$message_id = $_GET['mid'];}    //specific for goodbyes
if(isset($_GET['mem'])) {$memorial = $_GET['mem'];}     //specific for video messages
if(isset($_GET['status'])) {$flag = $_GET['status'];}

if (isset($flag)){
$sql = mysql_query("UPDATE memorials SET status='$flag' WHERE mem_id='$memorial'");
}

/*
 Need memorials table - status
 
 userid		status		self_mem
mem_id		memorial	sname
fname		mi			lname
nname		createby		memurl
memimage	bdate		dod
title			comments	service
submitted	ip

pocontact database:

userid	poc_id	prim	recipient_fn	recipient_mi	recipient_ln	relation	recip_email	conf_recip_email	usps_mail	usps_mail2	city	state	zip	country	phone	notes	submitted	ip

*/

if (isset($access_id)){
$result = mysql_query("SELECT * FROM pocontact WHERE poc_id='$access_id' LIMIT 1");
$row = mysql_fetch_array($result) or die(mysql_error());
    $memo1 = $row['userid'];
    $memo2 = $row['poc_id'];
    $memo3 = $row['prim'];
    $memo4 = $row['recipient_fn'];
    $memo5 = $row['recipient_mi'];
    $memo6 = $row['recipient_ln'];
    $memo7 = $row['relation'];
    $memo8 = $row['recip_email'];
    $memo9 = $row['usps_mail'];
    $memo10 = $row['usps_mail2'];
    $memo11 = $row['city'];
    $memo12 = $row['state'];
    $memo13 = $row['zip'];
    $memo14 = $row['country'];
    $memo15 = $row['phone'];
    $memo16 = $row['notes'];
    $memo17 = $row['submitted'];
    $memo18 = $row['ip'];

    }
    
if (isset($video_id)){
$result = mysql_query("SELECT * FROM mem_vid_upload WHERE vid_id='$video_id' LIMIT 1");
$row = mysql_fetch_array($result) or die(mysql_error("No Recipient Found For This Video"));
    $data1 = $row['userid'];
    $data2 = $row['vid_id'];
    $data3 = $row['poc_id'];
    $data4 = $row['recipient'];
    }

if (isset($aid)) {
$result2 = mysql_query("SELECT * FROM pocontact WHERE poc_id='$aid' LIMIT 1");
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
		<h2>Point of Contact Displayed Here - You may email (if necessary)</h2>
		
		<br>
	<b>User ID:</b> <?php echo $memo1; ?><br>
	<b>POC ID:</b> <?php echo $memo2; ?><br>
	<b>Prim:</b> <?php echo $memo3; ?><br>
	<b>Recipient Fn:</b> <?php echo $memo4; ?><br>
	<b>Recipient Mi:</b> <?php echo $memo5; ?><br>
	<b>Recipient Ln:</b> <?php echo $memo6; ?><br>
	<b>Relation:</b> <?php echo $memo7; ?><br>
	<b>Recipient email:</b> <?php echo $memo8; ?><br>
	<b>USPS Mail:</b> <?php echo $memo9; ?><br>
	<b>USPS Mail2:</b> <?php echo $memo10; ?><br>
	<b>City:</b> <?php echo $memo11; ?><br>
	<b>State:</b> <?php echo $memo12; ?><br>
	<b>Zip:</b> <?php echo $memo13; ?><br>
	<b>Country:</b> <?php echo $memo14; ?><br>
	<b>Phone:</b> <?php echo $memo15; ?><br>
	<b>Notes:</b> <?php echo $memo16; ?><br>
	<b>Submitted:</b> <?php echo $memo17; ?><br>
	<b>IP:</b> <?php echo $memo18; ?><br>
		</p>
		
		<h1>Click icon to print PDF for USPS mailings: <a href="../createpdf.php?userid=<?php echo $data1; ?>&poc_id=<?php echo $data3; ?>&msg_id=<?php echo $data2; ?>&submit=1"><img style="vertical-align: middle;" src="img/cool_icon100x100.png" alt="pdf" height="75" width="75" border="0"></a></h1>

<hr>
<?php
if (isset($sendflag)) {
    $ToEmail = $memo8;
    $EmailSubject = "A message from eGoodbyes.com";
    $mailheader = "From: webmaster@egoodbyes.com\r\n";
    $mailheader .= "Reply-To: webmaster@egoodbyes.com\r\n";
    $mailheader .= "Content-type: text/plain; charset=utf-8\r\n";
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
<td width="71%"><input name="name" type="text" id="name" size="32" value="<?php echo $memo8; ?>"></td>
</tr>
<tr>
<td class="bodytext">Email address (sent from US):</td>
<td><input name="email" type="text" id="email" size="32" value="webmaster@egoodbyes.com"></td>
</tr>
<tr>
<td class="bodytext">Message to be sent:</td>
<td>

<textarea name="comment" cols="45" rows="6" id="comment" class="bodytext">

Dear, <?php echo $memo4 . $memo6; ?>

A Message from eGoodbyes...



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


<?php include("../development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
		<div class="content">
		<?php include("../include/footer_code.html"); ?>
		</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->

</body>
</html>
