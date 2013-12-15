<?php 
session_start();
include("db.php");
$_SESSION['ver'] = 1;
if(isset($_SESSION['userid'])){
		$user = $_SESSION['userid'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d");
	
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Upload a Video</title>
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

	<div id="wrapper">
		<div align="center">

<h1>Information</h1>
	<div class="dblock">
		<p>About eGoodbyes</p>
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
