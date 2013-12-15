<?php 
session_start();
if(isset($_GET['submit'])){
$userid = trim($_GET['userid']);
$mem_id = trim($_GET['mem_id']);
require_once("pdoconnect.inc.php");
$sql = "SELECT * FROM memorials WHERE userid = '$userid' AND mem_id = '$mem_id' LIMIT 1";
$q = $conn->prepare($sql);
$q->execute();
$row = $q->fetch();
}
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
			<div class="content"><br></div>
		</div>


<div id="main">
<?php 

if (isset($_GET['submit']) && $sql == true){ 
?>

<?php echo '<h1 class="center"> '.$row['title'] .' <br /><br /> ' . $row['fname'] .'  ' .$row['lname'] .' </h1>';

echo '<img src="imagesmemorial/'.$row[memimage].'";  width="200px" alt="" class=imgshadow />';  
if(isset($row['nname'])) echo '<figcaption >' .'"'.$row['nname'].'"' .'</figcaption>'
 ;
}
?>
<h2 class="center"><?php if(isset($row['nname'])) echo '"'.$row['nname'].'"' ; ?></h2>
<p class="center"><?php echo  $row['bdate'] . ' - ' . $row['dod'] ;  ?></p>

<div id="wrap">
<span class="fltright"><?php if(!empty($row['memimage'])){


?>
</span><!--eo header span-->
<p class="pad10"><?php echo nl2br($row['comments']); ?></p>
<h3><?php  if(isset($row['service'])) echo 'Service Information'; ?></h3>
<p><?php  if(isset($row['service'])) echo nl2br($row['service']); ?></p>

<h3><?php  if(isset($row['createby'])) echo 'This Memorial has been Created by;'; ?></h3>
<p><?php  if(isset($row['createby'])) echo nl2br($row['createby']); ?></p>

<br />
<?php
}else{
?>
<form name="form" method="get" >
<table>
<tr><td>Insert User Id</td><td><input type="text" name="userid" /></td></tr>
<!--<tr><td>Insert POC Id</td><td><input type="text" name="poc_id" /></td></tr>-->
<tr><td>Insert Memorial Id</td><td><input type="text" name="mem_id" /></td></tr>
<tr><td><input type="submit" name="submit" value="Submit your Information" /></td></tr>
</table>
</form>
<?php }?>



</div> <!-- end content -->
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
