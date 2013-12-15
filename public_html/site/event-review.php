<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");


$event = trim($_POST['event']);
$eventdate = trim($_POST['eventdate']);
$story = trim($_POST['story']);
$ev_img = $_POST['ev_img'];

$image_file = $_FILES['ev_img']['name'];
$image_type = $_FILES['ev_img']['type'];
$image_size = $_FILES['ev_img']['size']; 

$ip = $_SERVER['REMOTE_ADDR'];

/*$last= $conn->lastInsertId();*/

/*if($image_size >	2000000)	{

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
}*/

    if (!empty($image_file)) {
      if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {
        if ($_FILES['ev_img']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'eventimage'. '/' . $image_file;
          if (move_uploaded_file($_FILES['ev_img']['tmp_name'], $target)){
		 
		  $sql = "INSERT INTO event (
		  event, 
		  eventdate, 
		  story, 
		  ev_img, 
		  ip
		  ) VALUES (
		  :event, 
		  :eventdate, 
		  :story, 
		  :ev_img,  
		  :ip
		  )"; 
$q = $conn->prepare($sql);
$q->execute(array(
':event'=>$event,
':eventdate'=>$eventdate, 
':story'=>$story, 
':ev_img'=>$image_file, 
':ip'=>$ip));


/*		 try{
		  $sqlim = "UPDATE event SET ev_img = :ev_img  WHERE event_id = '$last' ";
	  $qim = $conn->prepare($sqlim);
	  $qim->execute(array(':ev_img'=>$image_file));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}*/
 //$sqlim = ($sqlim)or die(mysql_error());
   if($sql == true) {
       echo "<h3>Successfully Inserted Your Image! Please Click Return!</h3>";
   } else {
       echo "Some Error Occured While Inserting Records";
}		  



		 }

	   }
	}
  }


$sqls = "SELECT * FROM event WHERE event ='$event ' ";
$qs = $conn->prepare($sqls);
$qs->execute();

$row = $qs->fetch();
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title><?php echo $row['event'];  ?></title>  
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
h1	{
	color:#fff;}
	#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}

.imgshadow	{
	box-shadow: 0px 8px 8px #111;
	
	}
.fltright	{
	float:right;
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
var_dump($_POST);
echo '<h1>'.$event.'</h1>';
echo '<img src="eventimage/'.$image_file.'";  width="200px" alt="" class="imgshadow fltright" />';  
if(isset($row['caption'])) echo '<figcaption class=center>' .'"'.$row['caption'].'"' .'</figcaption>' ;
echo nl2br($story);

$sql = "SELECT * FROM victims WHERE event_id = $event_id'";
$qvl = $conn->prepare($sqlvl);
$qvl->execute();
if($qvl == false){
echo 'Victims of '. $event;
echo '<table>';
echo '<tr><th>Name</th><th>Age</th><th>Occupation</th><th>From</th></tr>';
while($rowvl = $qvl->fetch())
{
echo '<tr><td>' . $rowvl['fname'].' </td><td>' . $rowvl['mi'].' </td><td>' . $rowvl['lname'].'</td><td> ' . $rowvl['age'].'</td><td> ' . $rowvl['occup']. '</td></tr>';
echo '<tr><td>' . $rowvl['story']. '</td></tr>';

}
echo '</table>';
}
?>
<p><a href="victim-input.php">Input Victim List</a></p>
<form action="events-admin.php">
<input type="submit"  value="Go to Event Admin Page" />
</form>


</div>
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
