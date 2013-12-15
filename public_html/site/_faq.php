<?php 
session_start();
$ver = $_SESSION['ver'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - FAQ</title>
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
<div class="content"><br></div>
	<div id="wrapper">
		<div align="center">

<h1>Contact Information</h1>

<div class="dblock">

<p>For information or support, please contact us by:</p>

<p><b>Email:</b>  support@egoodbyes.com<br>
<b>Phone:</b> 1-800-325-1308 (9 am to 5 pm EST)</p>

<h1>FAQ's</h1>

<div align="left">

<p>Q. How secure are my final goodbye messages? <br>
A. eGoodbyes uses industry standard SSL Encryption Technology, so all your interactions on eGoodbyes are secure.

<p>Q. What is a Point of Contact?  <br>
A. A Point of Contact is a primary contact that will be able to verify your passing.  When you save them as a Point of Contact, they will be notified from eGoodbyes, via email, that they are a Point of Contact for you and they will need to submit a copy of your Death Certificate to validate you have passed. Once your passing has been validated, eGoodbyes will send your final goodbye messages and make your memorial page viewable to the public.  eGoodbyes requires you create at least two Point of Contacts.  eGoodbyes suggests that you inform the person that you have chosen them as a Point of Contact.

<p>Q. Can I have more than 2 Point of Contacts?<br>
A. There is no limit to how many Point of Contacts you can have.

<p>Q. Is there a limit to how many memorial pages I can have? <br>
A. There is no limit to how many memorial pages you can have.

<p>Q. How does my memorial page become viewable to the public when I pass away?  <br>
A. Once eGoodbyes validates your passing, we will make your memorial page viewable to the public.

<p>Q. Is there a limit to how many photos I can upload to a memorial page I created?<br>
A. No, you can you can upload as many photos as you wish.

<p>Q. What happens to my final goodbye messages if I do not update my Recipient information and I pass away?<br>
A. eGoodbyes will make every attempt to send your final goodbye messages to the recipients you have chosen.  eGoodbyes has a monitoring system in place for final goodbye messages that are sent out via email.  Once eGoodbyes validates your passing we will email your final goodbye message to your recipient.  When the recipient downloads your final goodbye message, it will set off a trigger in our database that your recipient has received your final goodbye message.  If this trigger is not set off within two weeks of the validation of your passing, our database will alarm eGoodbyes that one of your final goodbye messages has not been received.  If this occurs we will reach out to the recipient by the phone number and address that you have provided for this recipient.  If your final goodbye message is sent out via mail and gets returned to sender by the postal service, eGoodbyes will make every effort to contact this recipient with the information you provided for them.  

<p>Q. If I receive a goodbye message from someone and I lose it, how can I get it back? <br>
A. You can go back to the original email that you�ve received your goodbye message from or contact eGoodbyes.   After 6 months, from when you received your goodbye message, that goodbye message will be archived so it will take longer to retrieve.

<p>Q.  Can I send goodbye messages to my children, even though they do not have an email address?
A.  Yes.  Simply create or choose a recipient that is the child�s parent/guardian or a close family member.  Simply, title your goodbye message to the name of the child and let the recipient know that you have created a goodbye message for your child, but they will be receiving it.<br>
  
<p>Q. If I am accused of abuse on a memorial page, do I lose my membership? <br>
A. If you are accused of abuse, you will be notified via email.  All abuse will be handled on a case-by-case basis.  Depending on the severity of abuse, it will lead to a warning or termination of your membership.

<p>Q. How do I cancel my membership? <br>
A. In order to cancel your membership you must send an email to support@egoodbyes.com requesting the cancelation.  The email must come from the same email address that you use to login in to your eGoodbyes accout. eGoodbyes will notify you via email that your account has been cancelled.  Your messages, videos and memorial pages will be discarded by eGoodbyes after 90 days.

<p>Q. Can I get a refund if I don�t want my membership? <br>
A. No, eGoodbyes has a no refund policy.

<p>Q. If I cancel my account and I want to rejoin, do I have to pay? <br>
A. If you cancel your account, you will have 90 days to re-activate your account, without paying.  After 90 days, you will have to pay to obtain the standard or premium membership.  You will also have to recreate your messages, videos and memorial pages.


</div>

<p>&nbsp;</p>
<p>&nbsp;</p>
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
