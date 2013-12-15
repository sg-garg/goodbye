<?php 
session_start();
$ver = $_SESSION['ver'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - How It Works</title>
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
		<div class="content"><br /></div>
	</div>
		<div class="content"><br /></div>
	<div id="wrapper">
		<div align="center">

<h1>How It Works</h1>

<div class="dblock">

<div align="left">

<h2>Registration/Activation</h2>
<p>To register for free, simply enter the information that is required.  Log into your email account and look for the email from webmaster@egoodbyes.com.  Click the activation link and you are ready to login.  The first time you login to your eGoodbyes account you are required to enter your address.  Once this has been completed, click the Home button in the toolbar to start creating your goodbye messages and memorial pages.</p>

<h2>Point of Contact</h2>
<p>A Point of Contact or POC, is very important.  To assure that your final goodbye messages gets sent out promptly, you need to designate at least 2 POC's.  A POC's responsibility is to submit a copy of your death certificate to eGoodbyes to validate that you've passed away.  We recommend that you choose someone close to you like your spouse or a family member.  Once eGoodbyes validates your passing, eGoodbyes will send out your final goodbye messages to the recipients you have chosen and allow the memorial page you've created for yourself to be viewable to the public.  Once you save a POC, they will receive an email letting them know that you have chosen them for this responsibility.  You can have as many POC's as you need.  Once you've created your POC's you are ready to start creating your final goodbye messages.  It is very important that you keep your POC and your Recipients' information current and up-to-date so that eGoodbyes has the correct information to send your goodbye messages.</p>

<h2>Emailed/Mailed Goodbyes</h2>
<p>Compose a Document Goodbye:  This will let you create goodbye messages in a document format to be sent out via email or mail.</p> 

<h1>Video Goodbyes</h1>
<h2>Upload a Video Goodbye:</h2>
<p>Create your video goodbye on any device that lets you record videos.  Once you create your video goodbye message on your device, simply upload your goodbye message.  You will have up 20 megabytes per video upload.</p>

<h2>Compose a Video Goodbye:</h2>
<p>Create your video goodbye under this option only if you have a webcam.  Simply follow the instruction and record your goodbye message live.  You are allowed 10 minutes per goodbye message under this option.</p>

<h1>Memorials</h1>
<h2>Create a Memorial:</h2>
<p>Create a memorial page for someone close to you that has passed away.  Select a name for your memorial and add a main photo of that person.  You can also add text to your page and include a brief summary of their life, important memories, or simply what that person meant to you.  Once you have saved a memorial, you can add as many photos as like by clicking Add/Remove photos on your home page, under existing memorials.  Once you have completed a memorial page, make sure you share it to Facebook or Twitter, so your friends and family can remember them.</p>

<h2>Create a Memorial for Yourself:</h2>
<p>Create a memorial page for yourself while you are still alive.  Select a name for your memorial and choose your main photo.  You can also add text to your page and include a brief summary of your life, important memories, highlights in your life and some final wishes.  Once you have saved a memorial, you can add as many photos as you like by clicking Add/Remove photos on your home page, under existing memorials. This type of memorial page will always be private while you are still alive.   When you have passed and eGoodbyes validates your passing from a POC, then eGoodbyes will make this memorial page public so your friends and family can always remember you.</p>


<h2>After You Pass</h2>
<p>When you pass away and a POC validates your passing with eGoodbyes, eGoodbyes will send out all of your goodbye messages.  If it is a document or video goodbye message, the recipient that you have chosen will receive an email.  For your recipient to retrieve your goodbye message, they will have to click the link in the email.  Once they have clicked on the link, they will be prompted to enter 3 security codes.  These codes will also be in the email.  Once they have entered the security codes, the recipient will be able to view/save their document goodbye or watch/download their video goodbye.  If you have chosen your document goodbye message to be sent via mail, then eGoodbyes will simply mail your document goodbye message to that recipient.  If you have created a memorial page for yourself, eGoodbyes will make that memorial page viewable to the public.</p>

</div>

<p style="color:red">*eGoodbyes will never view your final goodbye messages, no matter what format they are in.  The only person that sees your final goodbye messages are you and the recipient you have chosen.</p>


<p>&nbsp;</p>
<p>&nbsp;</p>


</div> <!-- end of (wireframe) block -->



<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>


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

</script>

<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>



</body>
</html>
