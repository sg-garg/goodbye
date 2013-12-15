<?php 
session_start();
//require_once("authhead.php");
require_once("pdoconnect.inc.php");

include("include/check_max.php");
check_max("3");

$userid = $_SESSION['userid'];
$_SESSION['ver'] = 1;
include("db.php");

if(isset($_SESSION['userid'])){
		$user = $_SESSION['userid'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d");
//$username = $user . "_" . $today;
$username = $user . "_";
		setcookie("username",urlencode($username),time()+36000);		
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

$user = $_SESSION['userid'];
$path = "/usr/local/red5/webapps/oflaDemo/streams/";
$path2 = "/home/goodbye/public_html/site/videouploads/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"> 
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Upload a Video</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

function fenderBuzz(){
var vfn = document.uf.image_file.value;
var cleanfile = vfn.replace("C:\\fakepath\\", "");
var filename = cleanfile.substring(cleanfile.lastIndexOf('/')+1);
document.uf.fileidname.value = filename;
}

function click_update(){

var uid = "<?php echo $_SESSION['userid']; ?>";
	var vtitle = document.getElementById('vidtitle').value;
	var vtitle = vtitle.replace(/[^a-zA-Z 0-9]+/g,'');
	var sd3 = document.getElementById('vidmes').value;
	var directory = "/home/goodbye/public_html/site/videouploads/";
	var poc2 = document.getElementById('pocinfo').value;
		var newpoc = poc2.split("--");
		var sd5 = newpoc[0];  //poc number
		var sd6 = newpoc[1];  //recipient
	var fname = document.getElementById('fileidname').value;
	saveDatabase2(fname,vtitle,directory,uid,sd5,sd6,sd3);

}

</script>
<script src="jssccode/upload-script.js"></script>

<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

<link href="jssccode/upload-main.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="css/extra-style.css">
<style>
#main	{min-height:600px;}
width:880px; {margin:0px auto;background-color:#353D6B;overflow:hidden;}
article{color:#000;padding:5px;}
</style>

</head>

<body>

	<div id="minMax">
		<div id="header">
			<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
			<?php include("include/nav-main.php"); ?>
			</div> <!-- end of center -->
			<div class="content"><br></div>
		</div> <!-- END HEADER -->
			

<div align="center"> <!--center-->
<h1 style="color:#21235b">Upload Your Video Goodbye</h1>
<div class="container">
<div class="upload_form_cont">
	<form id="upload_form" name="uf" enctype="multipart/form-data" method="post" action="jssccode/upload-script.php">
	
	<input type="hidden" name="max_file_size" value="97000000">
	
<div>
	<div><label for="image_file">Please select video file</label></div>
	<div align="center"><input type="file" name="image_file" id="image_file" onchange="fileSelected();" /></div>
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
<!--<img id="preview" />-->

<h3>Select Recipient:</h3>

            
<?php 
	$sql = "SELECT * FROM pocontact WHERE  userid = '$_SESSION[userid]' ";
		$q = $conn->prepare($sql);
		$q->execute();
		$count = $q->rowCount();
			if($count==0){echo '<a href="compose-goodbye.php">You have not entered any Points of Contact, Please Click Here</a>';
			} else {
			echo '<select name="poc_id" id="pocinfo">';
			while ($row = $q->fetch()){
			//echo '<option value="'.$row[poc_id].'">'.$row[recipient_fn]. '  ' . $row[recipient_mi]. ' ' .$row[recipient_ln]. ' - '. $row[relation].'</option>';
			echo '<option value="'.$row[poc_id].'--'.$row[recipient_fn].' '.$row[recipient_ln].', '.$row[relation].'">'.$row[recipient_fn]. '  ' . $row[recipient_mi]. ' ' .$row[recipient_ln]. ' - '. $row[relation].'</option>';
			
			}
			echo '</select>';
			}
?>
<p><a href="point-of-contact.php">If you do not see the person you want to send a message to, please create a new recipient.</a></p>

<!--style="border-color: white;border-style: solid;border-width: 1px;"-->
<input id="fileidnameh" style="display:none" type="text" name="vidfullpath"/>
<input id="fileidname" style="display:none" type="text" name="vidfilename" />

<h3>Title:</h3>
<p><input type="text" id="vidtitle" name="vidtitle" value="Enter Title"/></p>


<h3>Message:</h3>
<p><textarea rows="4" cols="30" id="vidmes" name="limitedtextarea" onKeyDown="limitText(this.form.limitedtextarea,this.form.countdown,100);" 
onKeyUp="limitText(this.form.limitedtextarea,this.form.countdown,100);">
</textarea></p><br>
<font size="1">(Maximum characters: 100)<br>
You have <input readonly type="text" name="countdown" size="3" value="100"> characters left.</font>
<br>

<!--<input type="submit" name="submit" value="Upload Your Video" />-->
<h3>&nbsp;&nbsp;&nbsp;1) Select video<br>
&nbsp;&nbsp;&nbsp;2) Select recipient<br>
&nbsp;&nbsp;&nbsp;3) Fill in a title and a message<br>
&nbsp;&nbsp;&nbsp;4) Pressing button will start upload<br>and save info in one step</h3>

<div>
<input type="button" value="upload" onclick="startUploading(); fenderBuzz(); setTimeout('click_update()',8000);"/>
</div>

</form>
<br />
<p style="color:red;font-size: 15px;">* If your passing results in a purposeful criminal act, your goodbye messages will not be sent out.</p>

<?php include("development.php"); ?>

</div> <!-- end of center -->
</div> <!-- end container -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script type="text/javascript">

function deleteFile(fname,rowid,directory) {
		$.ajax({ type: "POST",
		url: "jssccode/deletevideofile.php",
		data: {"filename":fname,"directory":directory},
		async: false,
		beforeSend: function() {
		alert('Action: ' + directory + fname);
		},
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

	function saveDatabase(sd1,sd2,sd3) {
		$.ajax({ type: "POST",
		url: "jssccode/vu-savevideofile.php",
		data: {"filename":sd1,"vtitle":sd2,"vidmes":sd3},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
			success: function(output) {
			alert('Saving: ' + sd1 + '; Message: ' + sd3 + '; Title: ' + sd2 + '.');
			},
		complete: function(response){
			console.log(response);
			alert('Complete');}
		});
}

	function saveDatabase2(fname,vtitle,directory,uid,sd5,sd6,sd3) {
		$.ajax({ type: "POST",
		url: "../rec/savevideofile.php",
		data: {"filename":fname,"directory":directory,"title":vtitle,"userid":uid,"rec":sd5,"rec2":sd6,"ext":sd3},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
			success: function(output) {
			//alert('Saving: ' + fname + '; To path: ' + directory);
			},
		complete: function(response){
			console.log(response);
			//alert('Your Video Has Been Saved.');
			}
		});
}

$('#upload_form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
	$( "#upload_form" ) .attr( "enctype", "multipart/form-data" ) .attr( "encoding", "multipart/form-data" );

</script>

</body>
</html>
