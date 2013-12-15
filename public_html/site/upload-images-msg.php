<?php
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_SESSION['userid'];
$msg_id = $_SESSION['msg_id'];
if(isset($_POST['submit'])){

$image = $_POST['image'];

$image_file = $_FILES['image']['name'];
$image_type = $_FILES['image']['type'];
$image_size = $_FILES['image']['size']; 

    if (!empty($image_file)) {
      if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {
        if ($_FILES['image']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'imagesmemorial'. '/' . $image_file;
          if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){

		  
$sqlul = "INSERT INTO uimages (userid, poc_id, msg_id, image) VALUES ( 
:userid, 
:poc_id, 
:msg_id,

:image
)"; 

$qul = $conn->prepare($sqlul);

$qul->execute(array(
':userid'=>$userid,
':poc_id'=>$poc_id,
':msg_id'=>$msg_id,

':image'=>$image_file

));

	  	 

}

// $sql = ($sql)or die(mysql_error());
   if($sqlul == true) {
       echo "<h3>Successfully Inserted Your Image! Please Click Return!</h3>";
   } else {
       echo "Some Error Occured While Inserting Records";
}		  

}
  }
}
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
	color:#000;
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
<?php echo $userid; ?>
<form method="post" action="" enctype="multipart/form-data">
  <input name="image" required type="file" />
  <input type="submit" name="submit" value="Submit Your Image" />
</form>

<br />
<form name="dashboard"  action="dashboard.php">
<input type="submit" value="Return to Dashboard" >
</form>
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
