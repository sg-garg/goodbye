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
$vidpath = $_POST['path'];					//POST sd4
$poc_id = $_POST['poc_id'];					//POST sd5
$recip = $_POST['recip'];					//POST sd6
$vid_id = $userid . time();

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
//mysql_query("UPDATE users SET last_login=now() WHERE userid='$userid'");

$sql = mysql_query("UPDATE mem_vid_upload SET poc_id='$poc_id', vid_id='$vid_id', vidmes='$vidmes', recipient='$recip', vidtitle='$title', vid_date='$date_stamp' WHERE userid='$userid' AND videoname='$filename'") or die (mysql_error());

Header( "Location: ../dashboard.php" );
?>