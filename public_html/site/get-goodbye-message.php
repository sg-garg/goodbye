<?php
session_start();

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
<form name="form" method="get" action="createpdf.php" >
<table>
<tr><td>Insert User Id</td><td><input type="text" name="userid" required /></td></tr>
<tr><td>Insert POC Id</td><td><input type="text" name="poc_id" required /></td></tr>
<tr><td>Insert Message Id</td><td><input type="text" name="msg_id" required /></td></tr>
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
