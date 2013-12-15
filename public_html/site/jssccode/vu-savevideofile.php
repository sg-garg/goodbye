<?php
session_start();
include '../db.php';

date_default_timezone_set('America/New_York'); 
$date_stamp = date('Y-m-d H:i:s');
$userid = $_SESSION['userid'];
$filename = $_POST['filename'];
$title = $_POST['vtitle'];
$vidmes = trim($_POST['vidmes']);
$vidpath = "/home/goodbye/public_html/site/videouploads/" . $filename;
$poc_id = $_SESSION['poc_id'] = trim($_POST['poc_id']);
$vid_id = $userid.time();


/* Check for fakepath (often uploaded from iphones)
RECORDS to DB as:
VIDTITLE:        C:fakepath	rim.SZXIrZ.MOV
VID_PATH: /home/egoodbye/public_html/site/videouploads/C:fakepath	rim.SZXIrZ.MOV
*/

if (strpos($filename,'fakepath') !== false) {
$bfile = explode(".", $filename);
$fn1 = $bfile[1];
$fn2 = $bfile[2];
$filename = "trim." . $fn1 . "." . $fn2;
$vidpath = "/home/goodbye/public_html/site/videouploads/trim." . $fn1 . "." . $fn2;
}


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

$sql = mysql_query("INSERT INTO mem_vid_upload (
userid,
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
'$date_stamp')")
      
or die (mysql_error());

Header( "Location: ../video-upload-s.php" );
?>