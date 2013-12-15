<?php 
session_start();
include("../../db.php");
$access_id = $_SESSION['accessid'];
$target = "/home/egoodbye/public_html/site/ADMINISTRATOR/dcertificates/"; 
$ul_file_name = $access_id . "_dcertificate.pdf";
$fullpath = $target . $ul_file_name;
$ok=1; 
 
if(move_uploaded_file($_FILES['image_file']['tmp_name'], $fullpath)){
	echo "The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
	$sql = mysql_query("UPDATE users SET death_cert='$ul_file_name' WHERE userid='$access_id'");
	} else {
	echo "Sorry, there was a problem uploading your file.";
	}

// original script:

function bytesToSize1024($bytes, $precision = 2) {
    $unit = array('B','KB','MB');
    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
}

$sFileName = $_FILES['image_file']['name'];
$sFileType = $_FILES['image_file']['type'];
$sFileSize = bytesToSize1024($_FILES['image_file']['size'], 1);

echo <<<EOF
<p>Your file: {$sFileName} has been successfully received.</p>
<p>Type: {$sFileType}</p>
<p>Size: {$sFileSize}</p>
EOF;


?>