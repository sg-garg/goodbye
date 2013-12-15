<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_POST['userid'];
$image = $_POST['image'];
$mem_id = $_SESSION['mem_id'] =  $_POST['mem_id'];

?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="new/css/default.ie7.css">
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
	min-height:600px;
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
</div>
<div id="main">



<?php 

$sqlr = "SELECT *  FROM  uimages WHERE userid =:userid AND image = :image LIMIT 1 ";
$qr = $conn->prepare($sqlr);
$qr->execute(array( ':userid'=>$userid, ':image'=>$image));
while($rowr = $qr->fetch()){
echo $userid.'<br />';
echo $image.'<br />';

echo '<img src = imagesmemorial/'.$rowr['image'].' width = 200px ><br />';
}
echo ' is about to be deleted </b><br />';

?>
<p>Are You Sure?</p>
<form name="delyes" action="delimagecom.php" method="post" >
<input type="hidden" name = "del" id="del" value="del" />
<input type="hidden" name = "image"  value="<?php echo $image; ?>" />
<input type="hidden" name = "userid"  value="<?php echo $userid; ?>" />
<input type="submit" name="delyes" value="Delete" />
</form>

<br /><br />

<p><a href="<?php echo 'upload-images-mem.php?mem_id='.$mem_id. ' ';?>">Return to Image Page</a></p>


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
