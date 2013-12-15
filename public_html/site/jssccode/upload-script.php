<?php 

 $target = "/home/goodbye/public_html/site/videouploads/"; 
 // $uploaddir = '/home/egoodbye/public_html/site/videouploads/';
 $target = $target . basename($_FILES['image_file']['name']); 
 $ok=1; 
 
 echo "<p>Your file, " . $target . " has a filesize of " . filesize($target) . "</p>";
 
 if(move_uploaded_file($_FILES['image_file']['tmp_name'], $target)) {
 echo "<p>The file ". basename( $_FILES['uploadedfile']['name']). " has been uploaded</p>";
 } else {
 echo "<p>Sorry, there was a problem uploading your file.</p>";
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