<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$event_id = $_GET['event_id'];
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
<?php
if(isset($_GET['del'])){


?><br />
<?php 
$sqlr = "SELECT  * FROM  event WHERE event_id ='$event_id' LIMIT 1 ";
$qr = $conn->prepare($sqlr);
$qr->execute();
$rowr = $qr->fetch();
echo '<h1>Your Event  "' . $rowr['event'].'"';

echo '<br /> '. 'Event Id: ' . $rowr['event_id']. '<br /> '. 'is about to be deleted </h1><br />';
 echo $event_id;
 echo 'get'. $_GET['event_id'];
 echo $rowr['event'];
 $event =  $rowr['event'];
?>
<h2>Are You Sure?</h2>

<form action="deleteevent.php" method="GET" >
<input type="submit" name="delyes" value="Delete" />
</form>

<?php 
}
//if(isset($_GET['delyes'])){
$sql = "DELETE FROM  event WHERE event_id = :event_id  LIMIT 1  ";
$q = $conn->prepare($sql);
$q->execute(array(':event_id'=>$event_id));

if($q  == true){echo 'Your Message was Deleted';
}else{
if($q == false){echo 'false';}
 }
 //}
// }
?>
<p><a href="events-admin.php">Return to Admin</a></p>

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
	<!--<script src="js/validate.js"></script>-->
  
</body>
</html>
