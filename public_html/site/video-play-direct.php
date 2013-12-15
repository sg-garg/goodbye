<?php
session_start();
$_SESSION['ver'] = 1;
$vid = $_GET['vid'];
include("db.php");
$result = mysql_query("SELECT * FROM mem_vid_upload WHERE vidpath LIKE '%$vid' LIMIT 1");
$row = mysql_fetch_assoc($result);
//$d1 = $_SESSION['poc_id']			= $row['poc_id'];
//$d2 = $_SESSION['vid_id']			= $row['vid_id'];
//$d3 = $_SESSION['mem_id']			= $row['mem_id'];
//$d4 = $_SESSION['recipient']		= $row['recipient'];
$vname = $_SESSION['videoname']		= $row['videoname'];
//$d6 = $_SESSION['vidmes']			= $row['vidmes'];
$vtitle = $_SESSION['vidtitle']			= $row['vidtitle'];
$vpath = $_SESSION['vidpath']			= $row['vidpath'];
//$d10 = $_SESSION['vid_date']		= $row['vid_date'];

//$vname = $row['vidpath']; //this column contains full path
//$fnonly = basename($vname);

	//$ext = substr(strrchr($vname,'.'),1);
	$ext = pathinfo($vname, PATHINFO_EXTENSION);
	
if ($ext == "flv") {
		//if(file_exists($vpath)) {
	header("Location: " . $site_url . "/player-flv.php?vid=".$vname."&p=".$vpath);
	exit;
		//}
		}

if ($ext == "wmv") {
		if(file_exists($vpath)) {
	header("Location: " . $site_url . "/player-wmv.php?vid=".$vname."&p=".$vpath);
	exit;
		}}

if ($ext == "mov" || $ext == "MOV" || $ext == "m4p" || $ext == "mp4" || $ext == "avi") {
		if(file_exists($vpath)) {
	header("Location: " . $site_url . "/player-qtv.php?vid=".$vname."&p=".$vpath);
	exit;
		}}

//remove this for test
header("Location: " . $site_url . "/player-error.php?vid=".$vname."&p=".$vpath);
//echo "Ext equals: " . $ext . ". My conditional did not work.<br>";
//echo "vpath=". $vpath . " vtitle=" . $vtitle . " vname=" . $vname;
//exit;

//header("Location: https://www.egoodbyes.com/site/dashboard.php");
?>