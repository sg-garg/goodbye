<?php
session_start();

if(isset($_GET['error'])) {
	$error_msg = $_GET['error'];
	} else {
	$error_msg = "Error Page... Something went wrong.";
	}
?>


<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>Opps! - eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<meta http-equiv="refresh" content="6; URL=dashboard.php">
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>

<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/extra-style.css">

</head>

<body>

<div id="minMax">
		<div id="header">
			<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
			</div> <!-- end of center -->
			<div class="content"><br></div>
		</div> <!-- END HEADER -->


<div id="wrapper">
<div id="topbar"></div>
			
<div id="egcolsc">
<div class="content">

		<div align="center">
			<h1><img src="img/oops.jpg" alt="Opps" border="0" width="150" height="90"></h1>
			<h3><?php echo $error_msg ?></h3>
			<h3><img src="img/motion-cir.gif" alt="redirecting" border="0"></h3>
			<h3 style="color:red">Redirecting Back</h3>
			<form><INPUT TYPE="BUTTON" VALUE="Go Back" ONCLICK="history.go(-1)"></form>
		</div>

</div> <!-- end content -->
</div><!-- end #wrapper -->
</div>

			<div id="footer">
				<div class="content">
				<?php include("include/footer.php") ;?>
				</div> <!-- end content -->
			</div> <!-- end footer -->

		</div> <!-- end wrapperA -->

<!--	<script src="js/validate.js"></script>-->

</body>
</html>
