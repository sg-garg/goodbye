<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
if(isset($_POST['unset'])){
session_destroy();
unset($_SESSION);
include("db.php");
}

include("include/check_max.php");
//check_max("1");

?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>

<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/extra-style.css"> <!--this does not appear to effect page-->
<style>
table 	{
	text-align:left;
	}
#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
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
		</div> <!-- END HEADER -->
			
<div class="content">
<div id="main">

<?php
if(isset($_SESSION['userid'])){
$data_u = $_SESSION['userid'];
$data_e = $_SESSION['email_address'];
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}
?>

<div align="center">
<h2>Compose a Document Goodbye Message.</h2>

<form action="goodbye-review.php" method="post" >
<table cellpadding="5" width="600" border="0">
<tr><td>Message to</td><td>
<?php
	$sql = "SELECT * FROM pocontact WHERE  userid = '$_SESSION[userid]' ";
	$q = $conn->prepare($sql);
	$q->execute();

	//$row = $q->fetch();
	$count = $q->rowCount();

	if($count==0){echo '<a href="point-of-contact.php">You have not entered any Points of Contact, Please Click Here</a>';}else{
		echo '<select name="poc" id="poc">';
		echo '<option value="" selected>Select from this box</option>';

		while ($row = $q->fetch()){
		echo '<option value="'.$row[poc_id].'">'.$row[recipient_fn]. '  ' . $row[recipient_mi]. ' ' .$row[recipient_ln]. ' - '. $row[relation].'</option>';
		}
	echo '</select>';

//echo $row['userid'];

}

?>

</td></tr><!--matches to line 61-->

<tr><td></td><td><?php
	if($count >=1){
	echo '<a href="point-of-contact.php">If You do not see the person you want to send a message to, please create a new recipient.</a>';
	}
	
	?>
	</td></tr>

<tr><td> Today's Date</td>

<td><input type="text" id="msg_date" name="msg_date" placeholder="Today's Date" required value="<?php 
$ftime = date ("F d, Y ");

echo $ftime; ?>" /></td>

</tr>

<tr><td>Type of Message</td>

<td>
<?php
//echo $GOOD_STRING;
echo check_max("1");

?>

</td></tr>
	
<!--<tr>
  <td>Email notification?</td>
  <td><input type="checkbox" name="emyes"  value="1" />
  By check this box, this person will receive an email that they have a message waiting for them on EGoodbyes.</td>
</tr>-->


<tr><td>Salutation</td><td><input type="text" id="salutation" name="salutation" placeholder="Salutation" required value="<?php if(isset($_SESSION['salutation'] )) echo $_SESSION['salutation'] ; ?>" /></td></tr>

<tr><td>Your Goodbye Message</td>

<td><textarea id="message" name="message" cols="80" rows="20"><?php if(isset($_SESSION['message'] )) echo $_SESSION['message'] ; ?></textarea></td></tr>

</table>
<br />
<input type="submit" name="submit" value="Submit" />
</form>
<br />
<p style="color:red;font-size: 15px;">* If your passing results in a purposeful criminal act, your goodbye messages will not be sent out.</p>
</div> <!-- end center -->


</div><!--eo main-->
</div> <!-- end content -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
			</div> <!-- end footer -->
		</div> <!-- end wrapperA -->

<script>

$('form').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
$('#poc').plum('form.verify', { min: 2 });

$('#msg_date').plum('form.verify', { min: 2 });

$('#type').plum('form.verify', { min: 1 });

$('#salutation').plum('form.verify', { min: 3 });

$('#message').plum('form.verify', { min: 3 });


	
</script>

</body>
</html>
