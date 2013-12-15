<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");


if(isset($_POST['update'])){
$event= trim($_POST['event']);
$story= trim($_POST['story']);
$eventdate= trim($_POST['eventdate']);
$ev_img = trim($_POST['ev_img']);
$catid = trim($_POST['categoryid']);
$sqlud = "UPDATE event SET  
event=:event,
eventdate=:eventdate,
story=:story,
eventcatid=:eventcatid

WHERE event_id = '$_GET[event_id]'  LIMIT  1";

$qud = $conn->prepare($sqlud);
$qud->execute(array(
		   ':event'=>$event,		  
                    ':eventdate'=>$eventdate,
                    ':story'=>$story,
                    ':eventcatid' => $catid
                ));
}

$ev_img = $_POST['ev_img'];


$image_file = $_FILES['ev_img']['name'];
$image_type = $_FILES['ev_img']['type'];
$image_size = $_FILES['ev_img']['size']; 

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
		 
		  
		 try{
		  $sqlim = "UPDATE event SET ev_img = :ev_img  WHERE event_id = '$_GET[event_id]' ";
	  $qim = $conn->prepare($sqlim);
	  $qim->execute(array(':ev_img'=>$image_file));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}
 $sqlim = ($sqlim)or die(mysql_error());
   if($sqlim == true) {
       echo "<h3>Successfully Inserted Your Image! Please Click Return!</h3>";
   } else {
       echo "Some Error Occured While Inserting Records";
}		  



		 }

	   }
	}
  }


$sql = "SELECT * FROM event WHERE event_id ='$_GET[event_id]' ";
$q = $conn->prepare($sql);
$q->execute();

$row = $q->fetch();

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

<h2>This page is to update an existing event entered into the database</h2>
<h3>This page is not viewed by the public.</h3>
<form action=" " method="post" enctype="multipart/form-data">
<table>
<tr><td><label>Event ID #</label></td><td title="Read Only"><input name="event_id" readonly=readonly  type="text" value="<?php echo $row['event_id']; ?>" /></td></tr>

<tr><td><label> Name of Event (Title)</label></td><td><input name="event"  value="<?php echo $row['event']; ?>" type="text" size="60" required  /></td></tr>
<tr><td><label>Date</label></td><td><input name="eventdate" type="text"  value="<?php echo $row['eventdate']; ?>" /></td></tr>
<tr><td><label> Event Category</label></td><td><select name="categoryid" required><option value="">Select a value</option>
    <?php
        $sql = "select name, eventcatid from eventcat order by sequence, name";
        echo 1;
        $cmd = $conn->prepare($sql);
        echo 2;
        $cmd->execute();
        echo 3;
        $lookingFor = $row['eventcatid'];
        echo 4;
        while ($catRow = $cmd->fetch()){
            echo '4a';
            $val = $catRow['eventcatid'];
            $selected = '';
            if ($val == $lookingFor)            
                $selected = 'selected="selected"';
            echo '5a';
            echo '<option value="' . $val . '" ' . $selected .'>' . htmlspecialchars($catRow['name']) . '</option>';
            echo '6a';
        }
        echo 5;
    ?></select>
</td></tr>
<!--<tr><td><label>Email</label></td><td><input name="email" type="text" required value=" /></td></tr>
<tr><td><label>Phone</label></td><td><input name="phone" type="text" value="<?php /*echo $_SESSION['phone']; */?>" /></td></tr>
<tr><td><label>Town</label></td><td><input name="town" type="text" value="<?php /*echo $_SESSION['town'];*/ ?>" /></td></tr>
<tr><td><label>Subject</label></td><td><input name="subject" type="text" value="<?php /*echo $_SESSION['subject']; */?>" /></td></tr>-->
<tr><td><label>Event Synopsis</label></td><td><textarea name="story" cols="60" rows="10" value="Your Comments"><?php echo $row['story']; ?></textarea></td></tr>
<tr><td>Enter Main Image</td><td><input type="text"  value="<?php echo $row['ev_img']; ?>" size="40" /></td><td><input type="file" name="ev_img"  value="<?php echo $row['ev_img']; ?>" /></td></tr>
</table>
<input name="update" type="submit" value="Update Event Information" />
</form>
<?php  if(isset($_POST['update'])) {echo 'Information Updated';} ?>
<form action="events-admin.php">
<input type="submit"  value="Go to Event Admin Page" />
</form>
<br />
<form name=del action="deleteevent.php" method="get">
<input name="event_id"   type="hidden" value="<?php echo $row['event_id']; ?>" />
<input type="submit" name="del" value="Delete this Event"
/>
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
