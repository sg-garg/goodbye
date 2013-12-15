<?php
session_start();
$_SESSION['ver'] = 1;
include("pdoconnect.inc.php");
include("db.php");

if(isset($_SESSION['userid'])){
	$userid = $_SESSION['userid'];
	$mem1 = $_SESSION['commentvid'];
	// memorial.php?mem_id=1361759212
	$memid = $_SESSION['mem_id'];
	$mid = $_GET['mem_id'];
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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
	<head> 
	<meta charset="utf-8"> 
	<title>Video Record and Upload Module</title>
	<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<script src="jssccode/upload-script-mod.js"></script>
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
//var sd5 = document.getElementById('pocinfo').value;
var sd5 = "<?php echo $mid; ?>";
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



function fenderBuzz(){
var vfn = document.uf.image_file.value;
//var garbage = ['C:fakepath', 'C:\\fakepath\\', 'trim.'];
var garbage = 'C:\\fakepath\\';
var cleanfile = vfn.replace(garbage, "");
//var filename = cleanfile.substring(cleanfile.lastIndexOf('/')+1);
document.uf.vidfilename.value = cleanfile;
}


// CLICK_UPDATE
// sd1:filename sd2:title sd3:message sd4:path sd5:pocid
function click_update(){

	var sd4 = "/home/goodbye/public_html/site/videouploads/";
//var sd5 = document.getElementById('pocinfo').value;
var sd5 = "<?php echo $mid; ?>";
	var vtit = document.getElementById('vidtitle').value;
	var sd2 = vtit.replace(/[^a-zA-Z 0-9]+/g,'');
	var sd3 = document.getElementById('vidmes').value;
	//var vfn = document.uf.image_file.value;
	var vfn = document.getElementById('fileidname').value;
	var filename = vfn.substring(vfn.lastIndexOf('/')+1);
	var sd1 = filename;
	//var sd1 = document.getElementById('vidfilename').value;
		alert('Saving... Filename: ' + sd1 + ' Title: ' + sd2);
	
saveDatabase(sd1,sd2,sd3,sd4,sd5);
}

</script>

<style type="text/css" media="all">
		body { color: #0a0f32;padding: 0px; margin: 0px; background-image: url(img/bkgnd_image_001c.jpg); font-size:76%; font-family:"trebuchet MS", verdana, arial, sans-serif;}
h1 {font-size:20px; margin:0; padding:10px 0; color: #21235b;}
h2 {font-size:18px; margin:0; padding:10px 0; color: #21235b;}
h3 {font-size:16px; margin:0; padding:8px 0; color: #21235b;}
p {font-size:12px; line-height:1.5em; margin:0; padding:5px 0;}

.containerSc {
    overflow:hidden;
    width:440px;
    margin:20px auto;
}

.upload_form_contSc {
    color:#000;
    overflow:hidden;
}
#upload_formSc {
    float:left;
    padding:5px;
    width:400px;
}

#upload_formSc > div {
    margin-bottom:10px;
    margin-left:20px;
    padding-left: 25px;
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
		
<div id="wrapper">
		
	<p>&nbsp;&nbsp;&#8226; <a href="memorial.php?mem_id=<?php echo $mid; ?>">Return to Memorial Page</a></p>
<!-- code -->

<div align="center">

	<h1>Record or Upload Video</h1>
<form id="videoform" name="videoform" action="">

<!-- TITLE VALUE -->
<br><br>
<h2>Title of video?<br>
<input type="text" id="vidtitle" name="vidtitle" /></h2>

<!-- MESSAGE VALUE -->
<br><br>
<h2>Comments to post with this video?<br>
<textarea rows="4" cols="30" id="vidmes" name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,100);" 
onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,100);">
</textarea></h2>
<font size="1">(Maximum characters: 100)<br>
You have <input readonly type="text" name="countdown" size="3" value="100"> characters left.</font>

<br><br>

<h2>&nbsp;&nbsp;&nbsp;1) Fill in a title and a message<br>
&nbsp;&nbsp;&nbsp;2) Select Upload or Record Video <i>(live!)</i><br>
&nbsp;&nbsp;&nbsp;3) Pressing button will start upload<br>and save info in one step</h2>

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

?>

</form>

<!-- ################################################################################## -->

<table width="880" border="1" style="background:url(img/doublevid.png) no-repeat;">
<tr>
<td width="440">
<p>&nbsp;</p>
<p>&nbsp;</p>

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

<h2 style="color:black"><i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Upload Method:</i></h2>

<a name="mycode"></a>

<div class="upload_form_cont">
<form id="upload_form" name="uf" enctype="multipart/form-data" method="post" action="jssccode/upload-script.php">
<!--style="border-color: white;border-style: solid;border-width: 1px;"-->
<input id="fileidnameh" style="display:none" type="text" name="vidfullpath"/>
<input id="fileidname" style="border-color: white;border-style: solid;border-width: 1px;" type="text" name="vidfilename" />
	<div>
	<div><label for="image_file">Please select video file</label></div>
	<div><input size="10" type="file" name="image_file" id="image_file" onchange="fileSelected();" /></div>
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
                


<div>
<input type="button" value="Upload" onclick="startUploading(); fenderBuzz(); setTimeout('click_update()',8000);" />
</div>

</form>

</td>
</tr>
</table>
<br>
<p><a href="memorial.php?mem_id=<?php echo $mid; ?>">Return to Memorial Page</a></p>

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



<script type="text/javascript">
function saveDatabase(sd1,sd2,sd3,sd4,sd5) {
sd1 = sd1.replace("C:\\fakepath\\", "");
		$.ajax({ type: "POST",
		url: "jssccode/svf.php",
		data: {"filename":sd1,"vtitle":sd2,"vidmes":sd3,"path":sd4,"poc_id":sd5},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
		console.log('An Ajax error was thrown.');
		console.log(XMLHttpRequest);
		console.log(textStatus);
		console.log(errorThrown);
         //alert(xmlHttpRequest, textStatus, errorThrown);
         },
			success: function(output) {
			alert('Saving... Filename: ' + sd1 + ' Title: ' + sd2);
			},
		complete: function(response){
		console.log(response);
			alert('Please do not leave page till upload is complete...');}
			});
}

$('#videoform').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
$('#upload_form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});

</script>



</body>
</html>
