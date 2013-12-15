<?php 
session_start();
$ver = $_SESSION['ver'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Benefits</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

<style>
.sptext {font-size: smaller;font-style: italic;color: #a1a1a1;}
.dblock {
	font-size: 14px;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	width: 700px;
	border-color: #353d6b;
	border-style: solid;
	border-width: 1px;
	padding: 5px;
	margin: 5px;
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
		<div class="content"><br></div>
	</div>
<div class="content"><br></div><!--Scott, Gary added this to fix mac problem-->
	<div id="wrapper">
		<div align="center">

<h1>Benefits</h1>

<div class="dblock">

<p>eGoodbyes wants to give everyone the opportunity to securely create their final goodbyes to the people in their lives and to be remembered forever by creating your personal memorial page or for someone that has already passed.</p>

<h2>Goodbye Messages</h2>

<p>Create your final goodbye messages in a document format to be sent by email or mail.</p>
<p>Create your final goodbye messages in a video format to be sent out by email.</p>

<h2>Memorial Pages</h2>

<p>Create a memorial page for yourself to be remembered forever.</p>
<p>Create a memorial for someone that has passed to remember them forever.</p>

<h2>Memorial Section/Public Memorials</h2>

<p>Visit our memorial section to remember those who have lost their lives.</p>
<p>Visit our Public Memorials to view created memorial pages to remember someone close to you who has passed.</p>


<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


</div> <!-- end of (wireframe) block -->



<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


</div> <!-- end content -->
</div> <!-- end outer2 -->


		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script type="text/javascript">

$('#updatedata').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});

</script>

<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>



</body>
</html>
