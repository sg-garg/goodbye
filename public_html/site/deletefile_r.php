<?php
$filename = $_POST['filename'];
$path = $_POST['directory'];
if(file_exists($path."/".$filename)) { 
unlink($path."/".$filename); // Truly delete file
// chmod("$path/$filename", 0777);
// chown("$path/$filename", "sallard:sallard");
// echo "/$path/$filename to /$path/ZZZ_$filename";
// rename("$path/$filename", "$path/ZZZ_$filename");
 }
Header( "Location: video-player-list.php" );
?>
