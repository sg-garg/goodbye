<?php
session_start();
include("../db.php");

date_default_timezone_set('America/New_York'); 
$date_stamp = date('Y-m-d H:i:s');
$userid = $_SESSION['userid'];
// sd1:filename sd2:title sd3:message sd4:path sd5:pocid
$filename = $_POST['filename'];				//POST sd1
$title = $_POST['vtitle'];					//POST sd2
$vidmes = trim($_POST['vidmes']);			//POST sd3
$vidpath = $_POST['path'] . $filename;		//POST sd4
$poc_id = $_POST['poc_id'];					//POST sd5
$vid_id = $userid . time();


$filename = stripslashes($filename);
$title = stripslashes($title);
$vidmes = stripslashes($vidmes);
$vidpath = stripslashes($vidpath);
$poc_id = stripslashes($poc_id);

//    $vid = preg_replace('/\.[^.]*$/', '', $filename);

//if(file_exists($path . "/" . $filename)) { 
//$newfilename = $userid . "_" . $filename;
//rename($path . "/" . $filename, $path . "/" . $newfilename);
//$dbfname = $path . "/" . $newfilename;
//}

// $dbfname = $path . $filename;

// Write this file to database 
// Database Fields in mem_vid_upload:
// userid
// poc_id
// vid_id
// videoname
// vidmes
// vidtitle
// vidpath
// vid_date

$sql = mysql_query("INSERT INTO mem_vid_upload(userid,
poc_id,
vid_id,
videoname,
vidmes,
vidtitle,
vidpath,
vid_date)
       
VALUES (
'$userid',
'$poc_id',
'$vid_id',
'$filename',
'$vidmes',
'$title',
'$vidpath',
'$date_stamp')") or die (mysql_error());

Header( "Location: video-record-upload.php" );
?>