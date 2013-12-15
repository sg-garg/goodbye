<?php
if(session_id() == "" ) session_start();
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



$current_avatar = "avatar/". $_SESSION['avatar'];
$aname = $_SESSION['first_name'] . "'s Avatar";
$new_avatar = "avatar/". $_SESSION['userid'] . ".jpg";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Update Avatar</title>
<style type="text/css" media="all">
body { padding: 0px; margin: 0px; background-image: url(img/bkgnd_image_001c.jpg); font-size:76%; font-family:"trebuchet MS", verdana, arial, sans-serif;}
</style>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/extra-style.css">
<link href="util/style/style.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="util/style/ulscript.js"></script>
<script type="text/javascript">
    var AvatarVar = "<?php echo $current_avatar; ?>";
    var PersonsName = "<?php echo $aname; ?>";
    var AvatarNew = "<?php echo $new_avatar; ?>";
</script>

</head>

<body>

<div align="center">
<table width="900">
<tr><td bgcolor="#0A0F32">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br><br>
</td>
</tr>
<tr><td bgcolor="#ffffff" style="padding: 5px;margin: 5px;">
<p>&nbsp;&nbsp;&#8226; <a href="my_account.php">Return to Account</a></p>
<!-- code -->

<h3>Change your avatar</h3>
			<p>Customize your profile!</p>
			<p>Add a photo to identify yourself - any profile pic will do!<br>
			<i>(Please use .jpg format, 500x500 max size)</i></p>



		<div id="container">
		<div id="content">
			<div class="clear_fix"></div>

			<form action="util/upload.php" method="post" enctype="multipart/form-data" target="upload_target" onsubmit="startUpload();" >

			<p id="f1_upload_process">Loading...<br/>
			<img src="util/loader.gif" /><br/></p>
	
			<p id="f1_upload_form" align="center"><br/>
			<label>File: <input name="myfile" type="file" size="30" /></label>
			<label><input type="submit" name="submitBtn" class="sbtn" value="Upload" /></label></p>
	
			<p id="f1_display_avatar">Here is how your avatar is currently displayed:<br><br>
			<img src="<?php echo $current_avatar ?>" alt="<?php echo $aname ?>" height="200" width="200" border="1"></p>
			<iframe id="upload_target" name="upload_target" src="#" style="width:0;height:0;border:0px solid #fff;"></iframe>

			</form>
		</div>
		</div>
						<div class="clear_fix"></div>
						
						
<?php require("development.php"); ?>





<!-- end of content -->
</td></tr>



<tr><td bgcolor="#0A0F32" align="right">
<img src="img/logo.png" border="0" alt="eGoodbyes" width="180" height="50" />
</td></tr>
</table>

</div>
</body>
</html>