<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
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
table	{
	text-align:left;}
#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}
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

<h2>Enter a New Event Here</h2>
<h3>This page is not viewed by the public.</h3>
<form action=" event-review.php" method="post" enctype="multipart/form-data">
<table>
<!--<tr><td><label>Event ID #</label></td><td><input name="event_id"  type="text" placeholder="Leave Blank"  /></td></tr>-->

<tr><td><label> Name of Event (Title)</label></td><td><input name="event" autofocus=autofocus type="text" size="60" required  /></td></tr>
<tr><td><label>Date</label></td><td><input name="eventdate" type="text" required /></td></tr>

<tr><td><label>Event Synopsis</label></td><td><textarea name="story" cols="60" rows="10" value="Your Comments"></textarea></td></tr>
<tr><td>Enter Main Image</td><td><input type="file" name="ev_img" required /></td></tr>
</table>
<input name="submit" type="submit" value="Submit" />
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
