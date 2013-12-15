<?php 
session_start();
//require_once("authhead.php");
include("pdoconnect.inc.php");
include("db.php");
$_SESSION['ver'] = 1;
if(isset($_SESSION['userid'])){
		$user = $_SESSION['userid'];
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d");
	
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

// Call mysql to get info in system

$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];
$data_c = $_GET['v'];

$result = mysql_query("SELECT * FROM mem_vid_upload WHERE userid='$data_u' AND vidpath LIKE '%$data_c' LIMIT 1");
$row = mysql_fetch_assoc($result);
$d1 = $_SESSION['poc_id']			= $row['poc_id'];
$d2 = $_SESSION['vid_id']			= $row['vid_id'];
$d3 = $_SESSION['mem_id']			= $row['mem_id'];
$d4 = $_SESSION['recipient']		= $row['recipient'];
$d5 = $_SESSION['videoname']		= $row['videoname'];
$d6 = $_SESSION['vidmes']			= $row['vidmes'];
$d7 = $_SESSION['vidtitle']			= $row['vidtitle'];
$d9 = $_SESSION['vidpath']			= $row['vidpath'];
$d10 = $_SESSION['vid_date']		= $row['vid_date'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Upload a Video</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

<style>
.sptext {font-size: smaller;font-style: italic;color: #a1a1a1;}
.dblock {
	font-size: 14px;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	width: 700px;
	border-color: #353d6b;
	border-style: solid;
	border-width: 1px;
	padding: 5px;
	margin: 5px;
}
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
	</div>

	

<div id="wrapper">

<div align="center">
<h1>Edit Your Video Goodbye Message</h1>
<form id="updatedata" name="updatedata">

<div class="dblock">

	<table width="700" border="0" cellspacing="5" cellpadding="3">
	<tr><td width="110">&nbsp;</td>
	<th width="295">Current Goodbye Information</th><th width="295">New Goodbye Information</th></tr>
	
	<tr><td align="right">Recipient:</td><td bgcolor="#e6e6e6"><?php echo $d4; ?></td>
	<td>
<?php 
	$sql = "SELECT * FROM pocontact WHERE  userid = '$_SESSION[userid]' ";
		$q = $conn->prepare($sql);
		$q->execute();
		$count = $q->rowCount();
			if($count==0){echo '<a href="compose-goodbye.php">You have not entered any Points of Contact, Please Click Here</a>';
			} else {
			echo '<select name="poc_id" id="pocinfo">';
			while ($row = $q->fetch()){
			echo '<option value="'.$row[poc_id].'--'.$row[recipient_fn].' '.$row[recipient_ln].', '.$row[relation].'">'.$row[recipient_fn]. '  ' . $row[recipient_mi]. ' ' .$row[recipient_ln]. ' - '. $row[relation].'</option>';
			}
			echo '</select>';
			}
?>

</td></tr>
	
		
	<tr><td align="right">Original Date:</td><td bgcolor="#e6e6e6"><?php echo $d10; ?></td>
	<td><span class="sptext"><?php echo $today; ?></span></td></tr>
	
	<tr><td align="right">Title:</td><td bgcolor="#e6e6e6"><?php echo $d7; ?></td>
	<td><input type="text" size="35" id="newtitle" name="newtitle" value="<?php echo $d7; ?>"></td></tr>
	
	
<tr><td align="right">Message:</td><td bgcolor="#e6e6e6"><?php echo $d6; ?></td><td><input type="text" size="35" id="newmessage" name="newmessage" value="<?php echo $d6; ?>"></td></tr>
</table>

<!-- put style="display:none" when done testing -->
<p><input style="display:none" id="fileidnameh" type="text" name="vidfullpath"/></p>
<p><input style="display:none" id="fileidname" type="text" name="vidfilename" /></p>

</div> <!-- end of (wireframe) block -->
<p>&nbsp;</p>
<input name="saveinfo" type="button" value="Submit" onclick="click_update();"/>
<br><br>
<input name="deletevid" type="button" value="Delete Video" onclick="click_delete();">
<br>
</form>
</div> <!-- end content -->
</div> <!-- end outer2 -->


		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script type="text/javascript">

$('#updatedata').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});

function deleteFile(fname,rowid,directory) {
		$.ajax({ type: "POST",
		url: "jssccode/deletefile-awesome.php",
		data: {"filename":fname,"directory":directory},
		async: false,
		beforeSend: function() {
		//confirm('Confirm that you want to remove ' + 'path: ' + directory + '; filename: ' + fname);
		},
		success: function(output) {
		$("#del"+rowid).remove();},
		complete: function(response){
		console.log(response);
		alert('Done!');
		window.location.href = "dashboard.php";
		}
		});
}

	function saveDatabase(sd1,sd2,sd3,sd4,sd5,sd6) {
		$.ajax({ type: "POST",
		url: "jssccode/dbupdate-save.php",
		data: {"filename":sd1,"vtitle":sd2,"vidmes":sd3,"path":sd4,"poc_id":sd5,"recip":sd6},
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
			alert('Complete');
			window.location.href = "dashboard.php";}
		});
}

</script>

<script language="javascript" type="text/javascript">
function limitText(limitField, limitCount, limitNum) {
	if (limitField.value.length > limitNum) {
		limitField.value = limitField.value.substring(0, limitNum);
	} else {
		limitCount.value = limitNum - limitField.value.length;
	}
}

function click_delete(){
var ds1 = "<?php echo $d9; ?>" // fullpath
var ds2 = "<?php echo $d5; ?>" // filename
if (confirm("Are you sure?")) {
        // delete code
        deleteFile(ds2,0,ds1);
    }
    return false;
}

function click_update(){
var sd1 = "<?php echo $d5; ?>"; //filename, not needed
var vtit = document.getElementById('newtitle').value;
var sd2 = vtit.replace(/[^a-zA-Z 0-9]+/g,'');  //video title
var sd3 = document.getElementById('newmessage').value; //message
var sd4 = "<?php echo $d9; ?>";  //path, not needed
var poc2 = document.getElementById('pocinfo').value;
var newpoc = poc2.split("--");
var sd5 = newpoc[0];  //poc number
var sd6 = newpoc[1];  //recipient
saveDatabase(sd1,sd2,sd3,sd4,sd5,sd6);
}

</script>

<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>



</body>
</html>
