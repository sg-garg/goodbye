<?php
session_start();
?>
<?php require_once("../webassist/file_manipulation/helperphp.php"); ?>
<?php 
error_reporting(E_ALL);
ini_set('display_errors','on');
var_dump($_FILES); 
// configuration
try{
$dbtype		= "mysql";
$dbhost 	= "*******";
$dbname		= "********";//make sure you remove whitespace
$dbuser		= "********";
$dbpass		= "****";
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass, array(PDO::ATTR_PERSISTENT => true));

} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}
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
<h2>Create a Memorial</h2>
<form action="upload-memorial-images.php" method="post" enctype="multipart/form-data">
<table>
<tr><td><label>Userid- for debug</label></td><td><input name="userid" autofocus=autofocus type="text" required  /></td></tr>
<tr><td><label>Name of Memorial</label></td><td><input name="memorial"  type="text" required value="<?php echo $_SESSION['memorial']; ?>" /></td></tr>
<tr><td><label>Sir Name</label></td><td><input name="sname"  type="text"  value="<?php echo $_SESSION['sname']; ?>" /></td></tr>
<tr><td><label>First Name</label></td><td><input name="fname"  type="text" required value="<?php echo $_SESSION['fname']; ?>" /></td></tr>
<tr><td><label>Last Name</label></td><td><input name="lname" type="text" required value="<?php echo $_SESSION['lname']; ?>" /></td></tr>
<tr><td><label>'Nick' Name</label></td><td><input name="nname" type="text"  value="<?php echo $_SESSION['nname']; ?>" /></td></tr>

<tr><td><label>URL for Memorial</label></td><td><input name="memurl" type="text" value="<?php echo $_SESSION['memurl']; ?>" /></td></tr>
<tr><td><label>Upload Main Image</label></td><td><input name="memimage" type="file" value="<?php echo $_SESSION['memimage']; ?>" /></td></tr>
<tr><td><label>Birthdate</label></td><td><input name="bdate" type="text" value="<?php echo $_SESSION['bdate']; ?>" /></td></tr>
<tr><td><label>Pass Date</label></td><td><input name="dod" type="text" value="<?php echo $_SESSION['dod']; ?>" /></td></tr>
<tr><td><label>Title</label></td><td><input name="title" type="text" placeholder = "In Loving Memory" value="<?php echo $_SESSION['title']; ?>" /></td></tr>
<tr><td><label>Created by</label></td><td><textarea name="createby" cols="40" rows="4" ><?php echo $_SESSION['createby']; ?></textarea></td></tr>
<tr><td><label>Words about the deceased</label></td><td><textarea name="comments" cols="40" rows="8" ><?php echo $_SESSION['comments']; ?></textarea></td></tr>
<tr><td><label>Information about Services</label></td><td><textarea name="service" cols="40" rows="8" ><?php echo $_SESSION['service']; ?></textarea></td></tr>
</table>
<input name="submit" type="submit" value="Submit" />
</form>

</body>
</html>
