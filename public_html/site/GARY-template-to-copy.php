<?php
session_start();
include 'db.php';
$current_avatar = "avatar/". $_SESSION['avatar'];
$aname = $_SESSION['first_name'] . "'s Avatar";
$new_avatar = "avatar/". $_SESSION['userid'] . ".jpg";
?>

<!-- Replace above with your own verification code -->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Membership Processing</title>
<?php require("include/head.html") ?>
<link href="util/style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="util/style/ulscript.js"></script>
<script type="text/javascript">
    var AvatarVar = "<?php echo $current_avatar; ?>";
    var PersonsName = "<?php echo $aname; ?>";
    var AvatarNew = "<?php echo $new_avatar; ?>";
</script>
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

<!-- whatever you want in SIDEBAR here -->

<?php
if(isset($_SESSION['first_name'])){
	echo "Logged in as " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . ",<br>";
}
if(!is_null($_SESSION['email_address'])) {
	echo "(" . $_SESSION['email_address'] . ")</p>";
}
require("include/side_menu.html");

if(isset($_SESSION['userid'])){

echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"my_account.php\">My Account</a></p>\n";

echo "<p>Your User ID: " . $_SESSION['userid'] . "</p>";

}

?>

</div> <!-- end content -->
</div> <!-- end outer3 -->


<div id="topbar">
<div class="content">
<h3><b>Show your Support</b> Honor the victims by making a donation to the <a href="#hdisaster">hurricane disaster relief fund</a>.</h3>		
</div>
</div>
			
			
<div id="egcol1">
<div class="content">


<!-- Replace with your content & code below vvv -->

<!-- FUN -->
<!-- FUN -->
<!-- FUN -->
<!-- FUN -->
<!-- FUN -->

<!-- Replace with your content & code ABOVE ^^^ -->


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
