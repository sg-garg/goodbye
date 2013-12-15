<?php
session_start();
include("../db.php");

date_default_timezone_set('America/New_York');

$date = date_create();
//$time_stamp = date_format($date, 'Y-m-d H:i:s');
// we want it in: Scott Clement Allard said on 04/09/13 10:00:18 PM:
// we DONT WANT Scott Clement Allard said on 2013-04-09 23:02:01:
$time_stamp = date_format($date, 'm/d/Y h:i:s A');


$userid = $_SESSION['userid'];
$filename = $_POST['filename'];				//POST sd1
	$title = $_POST['vtitle'];					//POST sd2
	$vidmes = trim($_POST['vidmes']);			//POST sd3

//$poc_id = $_POST['poc_id'];					//POST sd5
$memid = $_POST['poc_id'];					//POST sd5 redone!
$vid_id = $userid . time();
$poc_id = $userid . time();

$garbage = array("C:\\fakepath\\", "trim.", "rim.");

//$fix1 = str_replace("C:fakepath", "", $filename); // fix this fucking problem!!

$newphrase = str_ireplace($garbage,"",$filename);
$vidpath = $_POST['path'] . $newphrase;

//$vidpath = $_POST['path'] . $fix1;		//POST sd4
//$fix2 = str_replace("trim.", "", $vidpath); // fix this fucking problem!!

/* Check for fakepath (often uploaded from iphones)
RECORDS to DB as:
VIDTITLE:        C:fakepath	rim.SZXIrZ.MOV
VID_PATH: /home/egoodbye/public_html/site/videouploads/C:fakepath	rim.SZXIrZ.MOV

other problem (mikes laptop)
/home/egoodbye/public_html/site/videouploads/C:fakepathSledding.mp4

if (strpos($filename,'fakepath') !== false) {
	if (strpos($filename,'rim.') !== false) {
		$bfile = explode(".", $filename);
		$fn1 = $bfile[1];
		$fn2 = $bfile[2];
		$filename = "trim." . $fn1 . "." . $fn2;
		$vidpath = "/home/egoodbye/public_html/site/videouploads/trim." . $fn1 . "." . $fn2;
	} else {
//str_replace  ( $search  , $replace  , $subject )	
$fn1 = str_replace  ( "C:fakepath"  , ""  , $filename );
	$vidpath = "/home/egoodbye/public_html/site/videouploads/trim." . $fn1;
	}
}
*/

$sql = mysql_query("INSERT INTO vid_upload_comments(userid,
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
'$newphrase',
'$vidmes',
'$title',
'$vidpath',
'$time_stamp')") or die (mysql_error());

$sqlcom = mysql_query("INSERT INTO uimages(userid,
poc_id,
msg_id,
mem_id,
image,
comments,
time_stamp)
       
VALUES (
'$userid',
'$poc_id',
'$vid_id',
'$memid',
'TV-ICON-SCREEN-VIDEO.png',
'$vidmes',
'$time_stamp')") or die (mysql_error());

Header( "Location: video-record-upload.php" );
?>