<?php
session_start();
include("../db.php");
$filename = $_POST['filename'];
$path = $_POST['directory'];
$userid = $_SESSION['userid'];

$sql = mysql_query("DELETE FROM mem_vid_upload WHERE videoname='$filename' AND userid='$userid'");

if(file_exists($path."/".$filename)) { 
	// unlink($path."/".$filename); //delete file
	chmod("$path/$filename", 0777);
	chown("$path/$filename", "sallard:sallard");
	// echo "/$path/$filename to /$path/ZZZ_$filename";
	rename("$path/$filename", "$path/ZZZ_$filename");
 }
 
Header( "Location: ../dashboard.php" );
?>
