<?php
  session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>eGoodbyes - Session has expired</title>
<meta http-equiv="refresh" content="0;url=<?php echo $site_url; ?>/site/login.php"/>
<?php require("include/head.html") ?>
</head>

<body>

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php include("include/nav-main.php"); ?>
</div> <!-- end of center -->

<div class="content"><br></div>

</div> <!-- end header -->

<div id="wrapper">
<div id="egcol2">
<div class="content">

<?php require("include/side_menu.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer3 -->
			
<div id="egcol1">
<div class="content">
<h3>Logout</h3>

<p>You have been successfully logged out. Your session has expired.</p>

<p>You must re-login to continue.  <a href="login.php">Log in</a></p>

<?php require("development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	
	<script src="js/validate.js"></script>
</body>
</html>
