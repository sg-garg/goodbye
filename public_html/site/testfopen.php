<?php 
error_reporting(E_ALL);
require_once("pdoconnect.inc.php");
/*require_once("authhead.php");*/
$userid = $_SESSION['userid'];
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
<?php 



$cf = $_POST['cf'];
$myfile = 'myfile.txt';
$gbs = fopen('/home/goodbye/public_html/site/gbmes/' .$myfile, 'a+');
fwrite($gbs, $cf);
echo 'This is contents of readfile:';
echo '<br />';
readfile($myfile);
fclose($myfile);


if (file_exists($myfile)) {
    echo "The file $myfile exists";
} else {
    echo "The file $myfile does not exist";
}


?>

<form action="" method="post" enctype="multipart/form-data">

<input type="text" name="cf" />
<input type="submit" name="submit"/>
</form>

<br />
<?php $what = file_get_contents('myfile.txt');
echo $what;?>
<br />

</body>
</html>
