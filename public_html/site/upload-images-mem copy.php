<?php
require_once("authhead.php");
require_once("pdoconnect.inc.php");

$userid = $_SESSION['userid'];
$mem_id = $_GET['mem_id'];
$userid_m = $userid; // this is a dup so only images input memorial created show in nivo slider
$slider = 'yes';

	if(isset($_POST['submit']) ){
		$image = $_POST['image'];

		$image_file = $_FILES['image']['name'];
		$image_type = $_FILES['image']['type'];
		$image_size = $_FILES['image']['size']; 
		$image_file=str_replace(' ','-',$image_file);
			if (!empty($image_file)) {
				if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {
				if ($_FILES['image']['error'] == 0) {
				// Move the file to the target upload folder
				$target = 'imagesmemorial'. '/' . $image_file;
					if (move_uploaded_file($_FILES['image']['tmp_name'], $target)){

$sqlul = "INSERT INTO uimages (userid, userid_m, poc_id, mem_id, image, slider) VALUES ( 
:userid, 
:userid_m, 
:poc_id, 
:mem_id,

:image,
:slider
)"; 

$qul = $conn->prepare($sqlul);

$qul->execute(array(
':userid'=>$userid,
':userid_m'=>$userid_m,
':poc_id'=>$poc_id,
':mem_id'=>$mem_id,

':image'=>$image_file,
':slider'=>$slider
));
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


<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

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
			<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
			<script language="javascript" type="text/javascript" src="js/menu.js"></script>
			<?php include("include/nav-main.php"); ?>
			</div> <!-- end of center -->
			<div class="content"><br></div>
		</div> <!-- END HEADER -->



<div class="content">
<div id="wrapper">

<h1>Add Images</h1>
<p>&nbsp;</p>

		<form method="post" action="" enctype="multipart/form-data">
		<input name="image" required type="file" />
		<input type="submit" name="submit" value="Submit Your Image" />
		</form>

<?php 

	$sql = "SELECT * FROM uimages WHERE mem_id ='$mem_id' AND image IS NOT NULL AND image <> 'TV-ICON-SCREEN-VIDEO.png' ";
	$q = $conn->prepare($sql);
	$q->execute();
	echo '<table border="1" cellspacing="5">';
	echo '<th>Name of Image</th>';

		while($row = $q->fetch())//remove extra ) when no loop
		{
echo '<tr><td><img src = imagesmemorial/'.$row['image'].' width="75"><td>'.$row['image'].'</td></tr>';
echo '<form method=post action=delimage.php>';
echo '<input type=hidden name=mem_id value='.$row['mem_id'].'>';
echo '<input type=hidden name=userid value='.$row['userid'].'>';
echo '<input type=hidden name=image value='.$row['image'].'>';
echo '<tr><td><input type=submit name=delimage id=delimage value="Delete this Image"></td></tr>';
echo'</form>';
		}
		
echo '</table>';
   if($sqlul == true) {
       echo "<h3>Successfully Inserted Your Image! <br /> If you would like to add another image to this memorial, please click Browse to select your image file!</h3>";
   } else {
       //echo "Some Error Occured While Inserting Records";
}		  
?>
<br />

<!--<form name="dashboard"  action="dashboard.php">
<input type="submit" value="Return to Dashboard" >
</form>-->


</div> <!-- end content -->
</div><!-- end #wrapper -->

	<div id="footer">
		<div class="content">
		<?php include("include/footer.php") ;?>
		</div> <!-- end content -->
	</div> <!-- end footer -->
</div> <!-- end wrapperA -->

</body>
</html>
