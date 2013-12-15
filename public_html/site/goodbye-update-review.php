<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");

$userid = $_SESSION['userid'];
$MSG_FIX = $_POST['msgid'];

if(isset($_POST['submit'])){
	$salutation= trim($_POST['salutation']);
	$message= trim($_POST['message']);
	$sql = "UPDATE gb_messages SET  
	salutation=:salutation,
	message=:message
	WHERE userid = $userid AND  msg_id = '$_SESSION[msg_id]'  LIMIT  1";

	$q = $conn->prepare($sql);
	$q->execute(array(
		   ':salutation'=>$salutation,
		    ':message'=>$message
			));
	}
	
$sqlu = "SELECT * FROM gb_messages WHERE msg_id = '$_SESSION[msg_id]' LIMIT 1";
	$qu = $conn->prepare($sqlu);
	$qu->execute();
	$row = $qu->fetch();
	$poc_id = $row['poc_id'];
	$gbmes_data = $salutation ."\n\n". $message;
	$gbmes = $poc_id.'.txt';
	$gbs = fopen('/home/goodbye/public_html/site/gbmes/' . $gbmes, 'w+');
	fwrite($gbs, $gbmes_data);
	fclose($gbs);
?>

<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
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
<style>

#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}
article	{
	text-align:left;}
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
	</div> <!-- END HEADER -->
		
		
<div class="content">
<div id="wrapper">

<?php echo $_SESSION['userid']; ?>
<?php echo $row['userid']; ?>
<?php echo $_SESSION['msg_id']; ?>

<h2>Here is a preview of your message to <?php echo $row['recipient_fn'].' '. $row['recipient_ln'];?></h2>
<article><?php //echo $row['recipient_fn'].' message was written for you on '. $row['msg_d']; ?></article>
<article><?php echo $row['salutation'] ; ?></article>
<article><?php echo nl2br($row['message'] ); ?></article>
<!--<input type="button" value="Approve this Message" />-->
<a href="dashboard.php">Dashboard</a>

<?php
/* Redirect browser */
header("Location: update-goodbye.php?wz01=1&msg_id=$MSG_FIX");
?>


</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	<!--<script src="js/validate.js"></script>-->
</body>
</html>
