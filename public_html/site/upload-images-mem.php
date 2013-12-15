<?php
require_once("authhead.php");
require_once("pdoconnect.inc.php");

$userid = $_SESSION['userid'];
$mem_id = $_GET['mem_id'];
$userid_m = $userid; // this is a dup so only images input memorial created show in nivo slider
$slider = 'yes';
$image_comment = trim($_POST['image_comment']);

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

$sqlul = "INSERT INTO uimages (userid, userid_m, poc_id, mem_id, image, image_comment, slider) VALUES ( 
:userid, 
:userid_m, 
:poc_id, 
:mem_id,

:image,
:image_comment,
:slider
)"; 

$qul = $conn->prepare($sqlul);

$qul->execute(array(
':userid'=>$userid,
':userid_m'=>$userid_m,
':poc_id'=>$poc_id,
':mem_id'=>$mem_id,

':image'=>$image_file,
':image_comment'=>$image_comment,
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
	
.img-block {
	line-height: 15px;
	font-size: 14px;
	float: left;
	padding: 5px;
	text-align: center;
	color: #353d6b;
	background-color: white;
	border-color: #353d6b;
	border-width: 1px;
	border-style: solid;
	height: 125px;
	width: 125px;
	margin: 5px;
	font-family: sans-serif;
}

.img-block-clear {
	float: left;
	padding: 5px;
	text-align: center;
	color: #ffffff;
	background-color: ffffff;
	border-color: #ffffff;
	border-width: 1px;
	border-style: solid;
	height: 125px;
	width: 125px;
	margin: 5px;
	font-family: sans-serif;
}

.clear_fix {
clear:both;
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

<div align="center">
<h1>Add Additional Images to the Memorial you have Created!</h1>
<p>&nbsp;</p>

		<form method="post" action="" enctype="multipart/form-data">
		<table width="700">
		<tr><td width="50%" valign="top" ><input name="image" required type="file" /></td></tr>
        <tr><td>Add a few words about the image</td></tr><tr><td><input type="text" name="image_comment" id="image_comment" size="100" /></td></tr>
		<td width="50%" valign="top" ><input type="submit" name="submit" value="Upload Image" /></td></tr>
		</table>
		</form>
</div> <!-- end of center -->
<?php 

	$sql = "SELECT * FROM uimages WHERE mem_id ='$mem_id' AND image IS NOT NULL AND image <> 'TV-ICON-SCREEN-VIDEO.png' AND slider ='yes' ";
	$q = $conn->prepare($sql);
	$q->execute();

		while($row = $q->fetch())//remove extra ) when no loop
		{
		
		echo '<div class="img-block">';
		$nimg = $row['image'];
		$modimgnam = substr ($nimg, 0, 15);
echo '<img src="imagesmemorial/'.$nimg.'" alt="'.$nimg.'" title="'.$nimg.'" width="75" height="75"><br>'.$modimgnam;
echo '<form method=post action=delimage.php>';
echo '<input type=hidden name=mem_id value='.$row['mem_id'].'>';
echo '<input type=hidden name=userid value='.$row['userid'].'>';
echo '<input type=hidden name=image value='.$row['image'].'>';
echo '<input type=submit name=delimage id=delimage value="Delete this Image"><br>';
echo'</form>';
echo '</div>';
		}
		echo '<div class="clear_fix"></div>';

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

<script type="text/javascript">
$('form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
</script>

</body>
</html>
