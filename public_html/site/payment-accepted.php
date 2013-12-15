<?php
session_start();
$_SESSION['ver'] = 1;
include("db.php");

// Call mysql to get info in system
// Comment out what we do not need

$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];
date_default_timezone_set('America/New_York');
$today = date("F j, Y, g:i a");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>eGoodbyes - Payment Processing</title>
<?php require("include/head.html") ?>
</head>

<body>
<div id="minMax">
		<div id="header">
			<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
			<<?php include("include/nav-main.php"); ?>
			</div> <!-- end of center -->
				<div class="content"><br /></div>
		</div> <!-- end header -->
		<div class="content"><br /></div>

<div id="wrapper">	
		<div id="egcol2">
		<div class="content">
		
		
		<?php
		if(isset($_SESSION['userid'])){

echo "<p>Logged in as " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . ".<br><a href=\"logout.php\">Not you?</a></p>";
echo "<br><br>";

}
		
		
		
		?>
		
		
		
		
		
		</div> <!-- end content -->
		</div> <!-- end outer3 -->

<div id="egcol1">
	<div class="content">
	
	<!-- Page Start -->	
		
	<p>Success!  Your payment has been processed.</p>
<h1><a href="<?php echo $site_url; ?>/site/dashboard.php"><img src="img/egoodbyes_proceed_dashboard.gif" alt="Proceed to Dashboard" border="0"></a></h1>

<?php

//unset cookie
setcookie("ppage", null, 1);
// This allows NEW invoice to be created.  Otherwise, same invoice is used.
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
