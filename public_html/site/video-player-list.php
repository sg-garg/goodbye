<h1><a href="../rec/">Record Videos</a></h1>
<?php
$files = array();
$path = "/usr/local/red5/webapps/oflaDemo/streams/";
// $path = "../rec/streams/streams/";
$dir = opendir($path); // open the cwd..also do an err check.
while(false != ($file = readdir($dir))) {
   if(($file != ".") and ($file != "..") and ($file != "index.php")) {
      $files[] = $file; // put in array.
      }}

// sort.
// natsort($files); 

arsort($files);
// uksort($files, "strnatcasecmp");

date_default_timezone_set('America/New_York');

// print.
echo "<table cellspacing=\"4\" cellpadding=\"2\" border=\"1\">";

$count=1;

foreach($files as $file) {

$fsz = filesize($path . $file);
$mod = filemtime($path . $file);
$vid = preg_replace('/\.[^.]*$/', '', $file);

echo("<tr id='del$count'><td>$count</td><td><a href='video-player-code.php?vid=$vid'>$file</a></td><td>" . date("Y-m-d H:i:s", $mod) . "</td><td>$fsz</td><td><input type='button' id='delete$count' value='Delete' onclick='deleteFile(\"$file\",$count,\"$path\");'></td><td><input type='button' id='delete$count' value='X' onclick='deleteFileReal(\"$file\",$count,\"$path\");'></td><td><b>$path$file</b></td></tr>\n");

    $count++;
    
}

echo "</table>";

?>

<hr>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">
function deleteFile(fname,rowid,directory) {
		$.ajax({ type: "POST",
		url: "deletefile.php",
		data: {"filename":fname,"directory":directory},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
		success: function(output) {
		alert('Confirm that you want to remove ' + 'path: ' + directory + '; filename: ' + fname);
		$("#del"+rowid).remove();},
		complete: function(response){console.log(response);
		alert('Complete');}
		});
}

function deleteFileReal(fname,rowid,directory) {
		$.ajax({ type: "POST",
		url: "deletefile_r.php",
		data: {"filename":fname,"directory":directory},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
		success: function(output) {
		alert('Confirm that you want to *TRULY* delete ' + 'path: ' + directory + '; filename: ' + fname);
		$("#del"+rowid).remove();},
		complete: function(response){console.log(response);
		alert('Complete');}
		});
}


function saveData(nameofsess,sessval) {
var Value = sessval.value;
$.ajax({ url: "savedata.php",
data: {"sess":nameofsess,"sessvalue":Value},
type: 'post',
success: function(output) {
document.getElementById('savestatus').innerHTML = '<span id=\"savestatus\" class=\"done\">Saved</span>';
}
});
}
</script>