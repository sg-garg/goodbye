<?php
include '../db.php';
$filename = $_POST['filename'];  //this must contain full file name
$path = $_POST['directory'];


//Do reverse of savevideofile.php
// removed file AND clear from database
// Database Fields in mem_vid_upload:
// userid
// poc_id
// vid_id
// videoname
// vidmes
// vidtitle
// vidpath
// vid_date

$fullpath = "$path/$filename";

$sql = mysql_query("DELETE FROM mem_vid_upload WHERE vidpath='$path$/filename'"); 
//chmod("$path/$filename.flv", 0777);
//chown("$path/$filename.flv", "sallard:sallard");
//rename("$path/$filename", "$path/ZZZ_$filename");
unlink($path/$filename);

if(file_exists($path.$filename)) { 
unlink($path/$filename); //delete file
//chmod("$path/$filename", 0777);
//chown("$path/$filename", "sallard:sallard");
// echo "/$path/$filename to /$path/ZZZ_$filename";


 }
Header( "Location: dashboard.php" );
?>