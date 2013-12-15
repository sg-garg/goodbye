<?php
session_start();
include("db.php");

if(isset($_GET['submit'])){
$uid = $_GET['userid'];
$pid = $_GET['poc_id'];
$vid = $_GET['vid_id']; //main one we need

$result = mysql_query("SELECT * FROM mem_vid_upload WHERE vid_id='$vid' AND userid='$uid' LIMIT 1");
$row = mysql_fetch_assoc($result);
$vname = $_SESSION['videoname']		= $row['videoname'];
$d6 = $_SESSION['vidmes']			= $row['vidmes'];
$vtitle = $_SESSION['vidtitle']			= $row['vidtitle'];
$vpath = $_SESSION['vidpath']			= $row['vidpath'];

/* Redirect browser */
	header("Location: " . $site_url . "/site/video-play-direct.php?vid=$vname&p=$vpath");
	} else {
	//header("Location: https://www.egoodbyes.com/site/error-page.php");
	}
?>

<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/default.ie7.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->
<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/extra-style.css">
<style>

#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}
.center	{
	text-align:center;
	}
.imgshadow	{
	box-shadow: 0px 8px 8px #111;
	padding:10px;
	float:right;
	margin-right:20px;}
</style>
</head>

<body>

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php include("include/nav-main.php"); ?>
</div> <!-- end of center -->
<div class="content">
<div id="main">
<?php 


?>
<form name="form" method="get" action="get-video-message.php" >
<table>
<tr><td>Insert CODE 1: </td><td><input type="text" name="userid" required /></td></tr>
<tr><td>Insert CODE 2: </td><td><input type="text" name="vid_id" required /></td></tr>
<tr><td>Insert CODE 3: </td><td><input type="text" name="poc_id" required /></td></tr>
<tr><td><input type="submit" name="submit" value="Submit your Information" /></td></tr>
</table>
</form>




</div><!--eo main-->
</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
<!--	<script src="js/validate.js"></script>-->
</body>
</html>
