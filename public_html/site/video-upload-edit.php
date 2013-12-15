<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_SESSION['userid'];
$vid_id = $_SESSION['vid_id'];
$vrname = $_SESSION['vrname'];

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
article{
	color:#000;
	padding:5px;
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

<h2>Edit your uploaded video goodbye message for <?php echo $vrname; ?>.</h2>

<form action="" method="post" enctype="multipart/form-data">
<?php 
$sql = "SELECT * FROM mem_vid_upload WHERE  vid_id = '$vid_id' LIMIT 1 ";
$q = $conn->prepare($sql);
$q->execute();


$row = $q->fetch();

?>
<article class=black >Click Browse to Select the Video you Want to Upload</article>
<article> Existing Video File: <?php  echo $row['videoname']; ?></article>
<article><input type="file" name="video_file" id="video_file"/></article>
<article>Would you like to title your video></article>
<article><input type="text" name="vidtitle"  value="<?php echo $row['vidtitle']; ?> "/></article>
<article>Would you like a message to go with this video?</article>
<textarea name="vidmes"><?php echo $row['vidmes']; ?> </textarea>
<br /><br />
<input type="submit" name="submit" value="Upload Your Video" />
</form>
<?php
if(isset($_POST['submit'])){
$video_file = $_POST['video_file'];

$vidmes = trim($_POST['vidmes']);
//$vid_id =$userid.time();
$vidtitle = trim($_POST['vidtitle']);
$vidpath = '/home/goodbye/public_html/site/videouploads/';

}

$video_file =   $_FILES['video_file']['name'];
$video_type = $_FILES['video_file']['type'];
$video_size =  $_FILES['video_file']['size']; 
$video_file =str_replace(' ', '-', $video_file);
/*
if($video_size >	6000000)	{


class ImgResizer {
	private $originalFile = '$video_file';
	public function __construct($originalFile = '$video_file') {
		$this -> originalFile = $originalFile;
	}
	public function resize($newWidth, $targetFile) {
		if (empty($newWidth) || empty($targetFile)) {
			return false;
		}
		$src = imagecreatefromjpeg($this -> originalFile);
		list($width, $height) = getimagesize($this -> originalFile);
		$newHeight = ($height / $width) * $newWidth;
		$tmp = imagecreatetruecolor($newWidth, $newHeight);
		imagecopyresampled($tmp, $src, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
		if (file_exists($targetFile)) {
			unlink($targetFile);
		}
		imagejpeg($tmp, $targetFile, 85); // 85 is my choice, make it between 0 – 100 for output image quality with 100 being the most luxurious
	}
}
}*/

    if (!empty($video_file)) {
      if (($video_type == 'video/x-ms-wmv') ||  ($video_type == 'video/mov')  ||  ($video_type == 'video/mp4')  ||  ($video_type == 'video/flv') && ($video_size < 50000000)) {
        if ($_FILES['video_file']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'videouploads'. '/' . $video_file;
          if (move_uploaded_file($_FILES['video_file']['tmp_name'], $target)){
		 
	if(isset($_POST['submit'])){	  
		  //mysql_select_db($database_assess, $assess_remote)or die(mysql_error());
     $sqlvu = "UPDATE mem_vid_upload SET

				videoname = :videoname,
				 vidmes =	  :vidmes,
				 vidtitle = :vidtitle

WHERE vid_id = '$vid_id' ";

	  $qvu = $conn->prepare($sqlvu);
	  $qvu->execute(array(
	
	 ':videoname'=>$video_file,
	  ':vidmes'=>$vidmes,
	  ':vidtitle'=>$vidtitle
	  ));
	  }
// $sqlu = ($sqlu)or die(mysql_error());
   if($sqlvu == true) {
       echo "<h3>Successfully Inserted Your video! </h3>";
   } else {
       echo "Some Error Occured While Inserting Records";
			}		  
		 }
	   }
	}
  }




 ?>
<br />
<form name="dashboard"  action="dashboard.php">
<input type="submit" value="Return to Dashboard" />
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
