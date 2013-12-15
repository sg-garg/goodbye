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
if(isset($_GET['accessid'])) {$access_id = $_GET['accessid'];}
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

*/

if (isset($memorial)){
$result = mysql_query("SELECT * FROM memorials WHERE mem_id='$memorial' LIMIT 1");
$row = mysql_fetch_array($result) or die(mysql_error());
    $memo1 = $row['userid'];
    $memo2 = $row['status'];
    $memo3 = $row['self_mem'];
    $memo4 = $row['mem_id'];
    $memo5 = $row['memorial'];
    $memo6 = $row['sname'];
    $memo7 = $row['fname'];
    $memo8 = $row['mi'];
    $memo9 = $row['lname'];
    $memo10 = $row['nname'];
    $memo11 = $row['createby'];
    $memo12 = $row['memurl'];
    $memo13 = $row['memimage'];
    $memo14 = $row['bdate'];
    $memo15 = $row['dod'];
    $memo16 = $row['title'];
    $memo17 = $row['comments'];
    $memo18 = $row['service'];
    $memo19 = $row['submitted'];
    $memo20 = $row['ip'];
    }
    
if (isset($video_id)){
$result = mysql_query("SELECT * FROM mem_vid_upload WHERE vid_id='$video_id' LIMIT 1");
$row = mysql_fetch_array($result) or die(mysql_error("No Recipient Found For This Video"));
    $data1 = $row['userid'];
    $data2 = $row['vid_id'];
    $data3 = $row['poc_id'];
    $data4 = $row['recipient'];
    }

if (4000 == 200) {
$result2 = mysql_query("SELECT * FROM pocontact WHERE poc_id='$data3' LIMIT 1");
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
		<h2>Memorial action taken here - Switch from private to public (1 to 2)</h2>
		
		<p>
		<b>User ID:</b> <?php echo $memo1; ?><br>
		<b style="color:red">STATUS: <?php echo $memo2; ?></b>
		<?php
		if ($memo2 == "1"){
			echo "<form action=\"eg-action-memorial.php\" method=\"get\"><input type=\"hidden\" name=\"mem\" value=\"$memo4\"><input type=\"radio\" name=\"status\" value=\"1\" checked>Private&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"status\" value=\"2\">Public<input type=\"submit\" value=\"GO\"></form>\n";
		}
		
		if ($memo2 == "2"){
			echo "<form action=\"eg-action-memorial.php\" method=\"get\"><input type=\"hidden\" name=\"mem\" value=\"$memo4\"><input type=\"radio\" name=\"status\" value=\"1\">Private&nbsp;&nbsp;&nbsp;<input type=\"radio\" name=\"status\" value=\"2\" checked>Public<input type=\"submit\" value=\"GO\"></form>\n";
		}
		?>
		<br>
		<b>Self Mem:</b> <?php echo $memo3; ?><br>
		<b>Mem ID:</b> <?php echo $memo4; ?><br>
		<b>Memorial:</b> <?php echo $memo5; ?><br>
		<b>Sname:</b> <?php echo $memo6; ?><br>
		<b>Fname:</b> <?php echo $memo7; ?><br>
		<b>MInitial:</b> <?php echo $memo8; ?><br>
		<b>Lname:</b> <?php echo $memo9; ?><br>
		<b>NName:</b> <?php echo $memo10; ?><br>
		<b>Created by:</b> <?php echo $memo11; ?><br>
		<b>Mem URL:</b> <?php echo $memo12; ?><br>
		<b>Mem img:</b> <?php echo $memo13; ?><br>
		<b>BDate:</b> <?php echo $memo14; ?><br>
		<b>Dod:</b> <?php echo $memo15; ?><br>
		<b>Title:</b> <?php echo $memo16; ?><br>
		<b>Comments:</b> <?php echo $memo17; ?><br>
		<b>Service:</b> <?php echo $memo18; ?><br>
		<b>Submitted By:</b> <?php echo $memo19; ?><br>
		<b>IP:</b> <?php echo $memo20; ?><br>
		</p>
		
		<h1>Click icon to print PDF for USPS mailings: <a href="../createpdf.php?userid=<?php echo $data1; ?>&poc_id=<?php echo $data3; ?>&msg_id=<?php echo $data2; ?>&submit=1"><img style="vertical-align: middle;" src="img/cool_icon100x100.png" alt="pdf" height="75" width="75" border="0"></a></h1>

<hr>
<?php
if (isset($_POST['email'])) {
    $ToEmail = $_POST['name'];
    $EmailSubject = "A message has been left for you on eGoodbyes.com";
    $mailheader = "From: ".$_POST['email']."\r\n";
    $mailheader .= "Reply-To: ".$_POST['email']."\r\n";
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

echo $data6." ".$data7."\n";

if (isset($_GET['vid'])){

echo "Someone sent you a VIDEO message.\n";

echo "Please visit this secure URL to access and download your video message:\n";

echo "https://www.egoodbyes.com/site/get-video-message.php\n";

} else {

echo "Someone sent you a message.\n";

echo "Please visit this secure URL to access and view your personal message:\n";

echo "https://www.egoodbyes.com/site/get-goodbye-message.php\n";

}

?>

To ensure the highest security, the use of 3 encryption codes has been used.  Simply enter these three codes into the form, and you will see your message:

Code 1: <?php echo $data1; ?>

Code 2: <?php echo $data2; ?>

Code 3: <?php echo $data3; ?>

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
