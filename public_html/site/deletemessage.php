<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_SESSION['userid'];
$msg_id = $_SESSION['msg_id']; 
$poc_id = $_SESSION['poc_id'];
$msg_id = $_GET['msgid']; //fix
$poc_id = $_GET['pocid']; //fix

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
<br />

<?php

if(isset($_GET['del'])){
	$sqlr = "SELECT *  FROM pocontact WHERE userid =:userid AND poc_id = :poc_id LIMIT 1 ";
	$qr = $conn->prepare($sqlr);
	$qr->execute(array(':userid'=>$userid, ':poc_id'=>$poc_id));

		while($rowr = $qr->fetch()){
		echo '<h1>Your message to ' . $rowr['recipient_fn']. ' '.$rowr['recipient_mi']. ' '.$rowr['recipient_ln']. ' -'. $rowr['relation'].' ';
		}

		echo 'is about to be deleted </h1><br />';
 
?>
<br />
<h2>Are You Sure?</h2>
<br />
<form name="delyes" action="" method="get" >
<input type="submit" name="delyes" value="Delete" />
</form>

<?php 
	} else {
	if(isset($_GET['delyes'])){
		$sql = "DELETE FROM gb_messages WHERE userid =:userid AND poc_id = :poc_id AND msg_id = :msg_id ";
		$q = $conn->prepare($sql);
		$q->execute(array(':userid'=>$userid, ':poc_id'=>$poc_id, ':msg_id'=>$msg_id));
		/* Redirect browser */
		header("Location: dashboard.php");

	if($q  == true){
	echo 'Your Message ' . $msg_id . ' to ' . $poc_id . ', has been Deleted.';
	}else{
		if($q == false){
		echo 'false';
		}
 }
 }
 }
?>

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
	<script src="js/validate.js"></script>
</body>
</html>
