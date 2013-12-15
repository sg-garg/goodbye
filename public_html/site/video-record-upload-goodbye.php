<?php
if(session_id() == "" ) session_start();
$_SESSION['ver'] = 1;
include("pdoconnect.inc.php");
include("db.php");

if(isset($_SESSION['userid'])){
$userid = $_SESSION['userid'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

/*
All Includes:

	db.php					database connection
	pdoconnect.inc.php		database connection
	jquery.js
	jquery.plum.form.js
	swfobject.js

All Functions:

	deleteFile				ajax call to dvf.php
	saveDatabase			ajax call to svf.php
	getFlashMovie
	onRecordPublished		vid recorder function, after recording
	reachedLimit			this disables vid record when hits ie: 5 of 5
	limitText				(for message box) checks characters entered in textarea
	click_update			gathers values of all form values, then pases to svf.php
	
*/

?>

<!DOCTYPE html>  
<html lang="en">  
	<head> 
	<meta charset="utf-8"> 
	<title>Video Record and Upload Module</title>
	<script src="jssccode/upload-script.js"></script>
<link href="jssccode/upload-main-mod.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/swfobject.js"></script> 
<script language="javascript" type="text/javascript">
// GETFLASHMOVIE
function getFlashMovie(movieName) {
	var isIE = navigator.appName.indexOf("Microsoft") != -1;
	return (isIE) ? window[movieName] : document[movieName];
	}  
   
	var params = { allowScriptAccess: "always", allowFullScreen: "true", flashvars:""};
	var atts = { id: "recorder" };

	swfobject.embedSWF("../rec/recorder.swf", "recorder", "320", "295", "8", null, null, params, atts);

// ONRECORDPUBLISHED
// sd1:filename sd2:title sd3:message sd4:path sd5:pocid
function onRecordPublished(obj) {
	var sd1 = obj.filename + '.flv';
	var sd5 = document.getElementById('pocinfo').value;
	var vtitle = document.getElementById('vidtitle').value;
	var sd2 = vtitle.replace(/[^a-zA-Z 0-9]+/g,'');
	var sd3 = document.getElementById('vidmes').value;
	var sd4 = "/usr/local/red5/webapps/oflaDemo/streams/";
	
	alert('Saving... Filename: ' + sd1 + ' Title: ' + sd2);
	saveDatabase(sd1,sd2,sd3,sd4,sd5);
	}

// REACHEDLIMIT
function reachedLimit(){
	document.getElementById('disappear').innerHTML = '<img src=\"../rec/images/no-more-vids.jpg\" alt=\"You have reached your limit\" border=\"0\">';
	}

// LIMITTEXT
function limitText(limitField, limitCount, limitNum) {
		if (limitField.value.length > limitNum) {
			limitField.value = limitField.value.substring(0, limitNum);
		} else {
			limitCount.value = limitNum - limitField.value.length;
			}
		}

// CLICK_UPDATE
// sd1:filename sd2:title sd3:message sd4:path sd5:pocid
function click_update(){

	var sd4 = "/home/goodbye/public_html/site/videouploads/";
	var sd5 = document.getElementById('pocinfo').value;
	var vtit = document.getElementById('vidtitle').value;
	var sd2 = vtit.replace(/[^a-zA-Z 0-9]+/g,'');
	var sd3 = document.getElementById('vidmes').value;
	var vfn = document.uf.image_file.value;
	var filename = vfn.substring(vfn.lastIndexOf('/')+1);
	var sd1 = filename;
	//var sd1 = document.getElementById('vidfilename').value;
	alert('Saving... Filename: ' + sd1 + ' Title: ' + sd2);
saveDatabase(sd1,sd2,sd3,sd4,sd5);
}

</script>

<style type="text/css" media="all">
body { color: #0a0f32;padding: 0px; margin: 0px; background-image: url(img/bkgnd_image_001c.jpg); font-size:76%; font-family:"trebuchet MS", verdana, arial, sans-serif;}
h1 {color: #0a0f32;font:20px/1.3 Arial,sans-serif;}
h2 {color: #434343;font:16px/1.3 Arial,sans-serif;}
.text, p, h3, h4, td {color: #0a0f32;font:14px/1.3 Arial,sans-serif;}
#main {
	width: 880px;
	padding: 0px;
	margin: 0px;
	font-size: 14px;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	color: #160091;
}
</style>

</head>

<body>

<div align="center">
	<table width="900">
		<tr><td bgcolor="#0A0F32">
		<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br><br>
		</td>
		</tr>
		<tr><td bgcolor="#ffffff" style="padding: 5px;margin: 5px;">
		
		<div id="main">
		
		
		<p>&nbsp;&nbsp;&#8226; <a href="dashboard.php">Return to Dashboard</a></p>
<!-- code -->

<h1>Record or Upload Video</h1>

<h2>Please select from one of your Points of Contacts who is to receive this video message.<br><br>

<!-- RECIPIENT VALUE -->
<form id="vid_info" name="vid_info">
<?php 

$sql = "SELECT * FROM pocontact WHERE  userid='$userid'";
		$q = $conn->prepare($sql);
		$q->execute();
		$count = $q->rowCount();
			if($count==0){echo '<a href="compose-goodbye.php">You have not entered any Points of Contact, Please Click Here</a>';
			} else {
			echo '<select name="poc_id" id="pocinfo">';
			
			while ($row = $q->fetch()){
				echo '<option value="' . $row[poc_id] . '">' . $row[recipient_fn] . ' ' . $row[recipient_mi] . ' ' . $row[recipient_ln] . ' - ' . $row[relation] . '</option>';
				}
			echo '</select>';
			}
?>

<!-- TITLE VALUE -->
<br><br>
<h2>Would you like to title your video?<br>
<input type="text" id="vidtitle" name="vidtitle" /></h2>

<!-- MESSAGE VALUE -->
<br><br>
<h2>Would you like a message to go with this video?<br>
<textarea rows="4" cols="30" id="vidmes" name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,100);" 
onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,100);">
</textarea></h2>
<font size="1">(Maximum characters: 100)<br>
You have <input readonly type="text" name="countdown" size="3" value="100"> characters left.</font>

<br><br>

<h2>&nbsp;&nbsp;&nbsp;1) Fill in a title and a message<br>
&nbsp;&nbsp;&nbsp;2) Select Upload or Record Video <i>(live!)</i><br>
&nbsp;&nbsp;&nbsp;3) Pressing button will start upload<br>and save info in one step</h2>
<hr>

<!-- PATH VALUE -->
<!-- FILENAME VALUE -->
<!-- put style="display:none" when done testing -->
<p><input style="display:none" id="fileidnameh" type="text" name="vidfullpath"/></p>
<p><input style="display:none" id="fileidname" type="text" name="vidfilename" /></p>
</form>

<?php

// vid_upload_comments  <-- NEW TABLE
// below was a copied line, meant to follow format
//$sql = mysql_query("UPDATE users SET activated='1' WHERE userid='$userid' AND password='$code'");


// get data out of database
//     - query Number of videos upload so far: in 'mem_vid_upload' table
//     - query number they have total: in 'users' table
// Database Fields in mem_vid_upload:
// userid
// poc_id
// vid_id
// videoname
// vidmes
// vidtitle
// vidpath
// vid_date *NEW*

// SAVE BELOW, for future counting - not needed for comments segment
$vidcheck1 = mysql_query( "SELECT count(*) FROM mem_vid_upload WHERE userid='$userid'" );
	$num_videos = mysql_result($vidcheck1, 0);
$vidcheck2 = mysql_query("SELECT * FROM users WHERE userid='$userid' LIMIT 1");
$numvids = mysql_fetch_assoc($vidcheck2);
	$max_videos = $numvids["videos"];

//put this below
echo "<h2>You have uploaded <b>" . $num_videos . "</b> of <b>" . $max_videos . "</b></h2>\n";

// Reached limit
if ($num_videos >= $max_videos){
	echo "<script type=\"text/javascript\">\n";
	echo "reachedLimit();\n";
echo "</script>\n";
}


?>

</form>

<!-- ################################################################################## -->
<table width="880" border="1" cellspacing="4">
<tr>
<td width="440">
<!-- ########## -->

<!-- Vid module next -->

	<div align="center">
	<div id="disappear">
			<div id="recorder">
			You need Flash player 8+ and JavaScript enabled to view this video.
			</div>
	</div>
	<img src="img/red-sav-pre.png" alt="Record Preview Save" border="0">
	</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</td>
<td width="440">
<!-- ########## -->


<div class="container">

<h2 style="color:black"><i>Upload Method:</i></h2>

<a name="mycode"></a>
            <div class="upload_form_cont">
                <form id="upload_form" name="uf" enctype="multipart/form-data" method="post" action="jssccode/upload-script.php">
                    <div>
                        <div><label for="image_file">Please select video file</label></div>
                        <div><input type="file" name="image_file" id="image_file" onchange="fileSelected();" /></div>
                    </div>

                    <div id="fileinfo">
                        <div id="filename"></div>
                        <div id="filesize"></div>
                        <div id="filetype"></div>
                        <div id="filedim"></div>
                    </div>
                    <div id="error">You should select valid file formats, ie: .MOV, MP4, .AVI, .WMV</div>
                    <div id="error2">An error occurred while uploading the file</div>
                    <div id="abort">The upload has been canceled by the user or the browser dropped the connection</div>
                    <div id="warnsize">Your file is very big. We can't accept it. Please select more small file</div>

                    <div id="progress_info">
                        <div id="progress"></div>
                        <div id="progress_percent">&nbsp;</div>
                        <div class="clear_both"></div>
                        <div>
                            <div id="speed">&nbsp;</div>
                            <div id="remaining">&nbsp;</div>
                            <div id="b_transfered">&nbsp;</div>
                            <div class="clear_both"></div>
                        </div>
                        <div id="upload_response"></div>
                    </div>
                <img id="preview" />


<div>
<input type="button" value="Upload" onclick="startUploading(); click_update();" />
</div>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
</td>
</tr>
</table>

<div align="center">
<form name="dashboard"  action="dashboard.php">
<input type="submit" value="Return to Dashboard" />
</form>

</div>
			
<!-- #########################################################################  -->

						<?php require("development.php"); ?>
						<!-- end of content -->
						
						
						
						</div> <!-- end of main -->
						</td></tr>

						<tr><td bgcolor="#0A0F32" align="right">
						<img src="img/logo.png" border="0" alt="eGoodbyes" width="180" height="50" />
						</td></tr>
						</table>
						</div>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>

<script type="text/javascript">
function saveDatabase(sd1,sd2,sd3,sd4,sd5) {
		$.ajax({ type: "POST",
		url: "jssccode/svf-goodbye.php",
		data: {"filename":sd1,"vtitle":sd2,"vidmes":sd3,"path":sd4,"poc_id":sd5},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
		console.log('An Ajax error was thrown.');
		console.log(XMLHttpRequest);
		console.log(textStatus);
		console.log(errorThrown);
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
			success: function(output) {
			alert('Saving... Filename: ' + sd1 + ' Title: ' + sd2);
			},
		complete: function(response){
		console.log(response);
			alert('Complete');}
			});
}

</script>



</body>
</html>
