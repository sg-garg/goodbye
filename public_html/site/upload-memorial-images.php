<?php
require_once("authhead.php");
require_once("pdoconnect.inc.php");

if(isset($_POST['submit'])){
$userid  = $_SESSION['userid'];
$memorial  = $_SESSION['memorial']= trim($_POST['memorial']);
$status  = $_SESSION['status']= trim($_POST['status']);
$sname= $_SESSION['sname'] = trim($_POST['sname']) ;
$fname = $_SESSION['fname']= trim($_POST['fname']) ;
$mi = $_SESSION['mi']= trim($_POST['mi']) ;
$lname = $_SESSION['lname'] = trim($_POST['lname'] );
$nname  = $_SESSION['nname']= trim($_POST['nname']);
$createby= $_SESSION['createby'] = trim($_POST['createby']) ;
$memurl  = $_SESSION['memurl']= trim($_POST['memurl']);
$self_mem  = $_SESSION['self_mem']= trim($_POST['self_mem']);
$vic_id = trim($_POST['vic_id']);
$bdate= $_SESSION['bdate'] = trim($_POST['bdate'] );
$dod = $_SESSION['dod'] = trim($_POST['dod']);
$title = $_SESSION['title']= trim($_POST['title']) ;
$comments  = $_SESSION['comments']= trim($_POST['comments']);
$service  = $_SESSION['service']= trim($_POST['service']);

$ip= $_SERVER['REMOTE_ADDR'];	
$mem_id = time();

$memimage = $_POST['memimage'];

$image_file = $_FILES['memimage']['name'];
$image_type = $_FILES['memimage']['type'];
$image_size = $_FILES['memimage']['size']; 
/*
if($image_size >	2000000)	{

class ImgResizer {
	private $originalFile = '$image_file';
	public function __construct($originalFile = '$image_file') {
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
}
*/
    if (!empty($image_file)) {
      if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {
        if ($_FILES['memimage']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'imagesmemorial'. '/' . $image_file;
          if (move_uploaded_file($_FILES['memimage']['tmp_name'], $target)){

		  
$sqlul = "INSERT INTO memorials (userid, status, self_mem, mem_id, vic_id,  memorial, sname, fname, mi, lname, nname, createby, memurl, memimage, bdate, dod, title, comments, service, ip) VALUES ( 
:userid, 
:status,
:self_mem, 
:mem_id,
:vic_id,
:memorial, 
:sname, 
:fname, 
:mi,
:lname, 
:nname, 
:createby, 
:memurl, 
:memimage, 
:bdate, 
:dod, 
:title,
:comments, 
:service,
:ip
)"; 

$qul = $conn->prepare($sqlul);

$qul->execute(array(
':userid'=>$userid,
':status'=>$status,
':self_mem'=>$self_mem,
':mem_id'=>$mem_id,
':vic_id'=>$vic_id,
':memorial'=>$memorial, 
':sname'=>$sname, 
':fname'=>$fname, 
':mi'=>$mi, 
':lname'=>$lname, 
':nname'=>$nname, 
':createby'=>$createby, 
':memurl'=>$memurl, 
':memimage'=>$image_file, 
':bdate'=>$bdate, 
':dod'=>$dod, 
':title'=>$title, 
':comments'=>$comments, 
':service'=>$service,
 ':ip'=>$ip
));


}
  }
}
}

if ($sqlul == false){


$sqlul = "INSERT INTO memorials (userid, status,self_mem, mem_id, vic_id,  memorial, sname,fname,  mi,  lname, nname, createby, memurl,  bdate, dod, title, comments, service, ip) VALUES ( 
:userid, 
:status,
:self_mem,
:mem_id,
:vic_id,
:memorial, 
:sname, 
:fname, 
:mi,
:lname, 
:nname, 
:createby, 
:memurl, 

:bdate, 
:dod, 
:title,
:comments, 
:service,
:ip
)"; 

$qul = $conn->prepare($sqlul);

$qul->execute(array(
':userid'=>$userid,
':status'=>$status,
':self_mem'=>$self_mem,
':mem_id'=>$mem_id,
':vic_id'=>$vic_id,
':memorial'=>$memorial, 
':sname'=>$sname, 
':fname'=>$fname, 
':mi'=>$mi, 
':lname'=>$lname, 
':nname'=>$nname, 
':createby'=>$createby, 
':memurl'=>$memurl, 

':bdate'=>$bdate, 
':dod'=>$dod, 
':title'=>$title, 
':comments'=>$comments, 
':service'=>$service,
 ':ip'=>$ip
));
}	  	 

}

// $sql = ($sql)or die(mysql_error());
/*   if($sql == true) {
       echo "<h3>Successfully Inserted Your Image! Please Click Return!</h3>";
   } else {
       echo "Some Error Occured While Inserting Records";
}		*/  

if(isset($_POST['submit'])){
$sql = "UPDATE victims  SET
mem_id=:mem_id WHERE vic_id = '$vic_id' "; //pdo table name in this example
$q = $conn->prepare($sql);
$q->execute(array(':mem_id'=>$mem_id));
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
		<div class="content"><br></div>
	</div>




<div class="content">
<div id="wrapper">


<h1 class="center"><?php echo $_SESSION['title'] .'  ' .$_SESSION['fname'] .' ' .$_SESSION['mi'] . ' '. $_SESSION['lname'] ; ?></h1>
<h2 class="center"><?php if(isset( $_SESSION['nname'])) echo '"'. $_SESSION['nname'].'"' ; ?></h2>
<p class="center"><?php echo   $_SESSION['bdate'] . ' - ' .  $_SESSION['dod'] ;  ?></p>

<div id="wrap">
<span class="fltright"><?php if(!empty( $_SESSION['memimage'])){

echo '<img src="imagesmemorial/'. $_SESSION[memimage].'";  width="200px" alt="" class=imgshadow />';  
if(isset( $_SESSION['nname'])) echo '<figcaption class=center>' .'"'. $_SESSION['nname'].'"' .'</figcaption>' ;
}
?>
</span><!--eo header span-->
<p class="pad10"><?php echo nl2br( $_SESSION['comments']); ?>

</p>
<h3><?php  if(!empty( $_SESSION['service'])) echo 'Service Information'; ?></h3>
<p><?php  if(!empty( $_SESSION['service'])) echo nl2br( $_SESSION['service']); ?></p>

<h3><?php  if(!empty( $_SESSION['createby'])) {echo 'This Memorial has been Created by';} ?></h3>
<p><?php  if(!empty( $_SESSION['createby'])) { echo nl2br( $_SESSION['createby']); }?></p>

<br />

<?php
		/* Redirect browser */
		header("Location: dashboard.php");
?>

</div> <!-- end #wrapper -->
</div><!-- end #content -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
			</div> <!-- end footer -->

</div> <!-- end wrapperA -->


</body>
</html>
