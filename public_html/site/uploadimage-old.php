<?php session_start();
error_reporting(E_ALL);
ini_set('display_errors','on');
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>untitled</title>  
<style>

</style>
</head>  
<body>

<?php try{
$dbtype		= "mysql";
$dbhost 	= "localhost";
$dbname		= "Membership_Database";//make sure you remove whitespace
$dbuser		= "root";
$dbpass		= "CoUn7Utz";
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass, array(PDO::ATTR_PERSISTENT => true));

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}?>


<?php echo $_SESSION['userid']; ?>
<form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data" name="memimage">
<label>Insert your firm logo.</label><br />
<input name="memimage" type="file" />
<p class="small">You may submit a .jpg or .gif file. <br />
Maximum file size 100kb. This image will display 150 px in width.</p>
<input name="submit" type="submit" value="Submit Your Image" />
</form>
<?php

$sqll = "SELECT userid FROM memorials";
$ql = $conn->prepare($sqll);
$ql->execute();

$row = $ql->fetch()

if (isset($_POST['submit'])) 	{
$memimage=$_POST['memimage'];



$image_file = $_FILES['memimage']['name'];
$image_type = $_FILES['memimage']['type'];
$image_size = $_FILES['memimage']['size']; 


/*$newlinecounter = 0;
foreach($_POST as $key => $val_newline){
if(stristr($val_newline, '\r')){$newlinecounter++;}
if(stristr($val_newline, '\n')){$newlinecounter++;}
if(stristr($val_newline, '\\r')){$newlinecounter++;}
if(stristr($val_newline, '\\n')){$newlinecounter++;}
if(stristr($val_newline, '\r\n')){$newlinecounter++;}
if(stristr($val_newline, '\\r\\n')){$newlinecounter++;}
if(stristr($val_newline, 'Bcc')){$newlinecounter++;}
}
if ($newlinecounter >= 1){ die('<h1>Page not Found, notify webmaster</h1>');}*/

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

    if (!empty($image_file)) {
      if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {
        if ($_FILES['memimage']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'imagesmemorial'. '/' . $image_file;
          if (move_uploaded_file($_FILES['memimage']['tmp_name'], $target)){
		  $conn;
		  
		  //mysql_select_db($database_assess, $assess_remote)or die(mysql_error());
		      $sql = "UPDATE memorials SET memimage = $image_file WHERE mem_id = '$_GET[mem_id]' ";
		



	  $q = $conn->prepare($sql);
	  $q->execute(array($memimage));

/* $sql = ($sql)or die(mysql_error());*/
   if($sql == true) {
       echo "<h3>Successfully Inserted Your Image! Please Click Return!</h3>";
   } else {
       echo "Some Error Occured While Inserting Records";
}		  



		 }

	   }
	}
  }

}
?>

</div>
<p><a href="preview-memorial.php">Preview</a></p>
</body>
</html>