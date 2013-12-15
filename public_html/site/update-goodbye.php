<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid  = $_SESSION['userid'];
$MSG_FIX = $_SESSION['msg_id'] = $_GET['msg_id']; 
$sql = "SELECT * FROM gb_messages WHERE userid = $userid AND msg_id = $_GET[msg_id]  LIMIT 1  ";
$q = $conn->prepare($sql);
$q->execute();
$row = $q->fetch();
$poc_id = $row['poc_id'];
$POC_FIX = $_SESSION['poc_id'] = $poc_id;
$sqlp = "SELECT * FROM pocontact WHERE userid = $userid AND poc_id = $poc_id  LIMIT 1  ";
$qp = $conn->prepare($sqlp);
$qp->execute();
$rowp = $qp->fetch();

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
<link rel="stylesheet" href="css/extra-style.css">
<style>
table	{
	text-align:left;}
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

<div align="center">

<h2>Update Your Document Goodbye Message</h2>

<?php
if(isset($_GET['wz01'])){
echo "<p style=\"color:red;font-weight:bold\">Your information has been updated.</p>";
}
?>


<form action="goodbye-update-review.php" method="post" >

<input type="hidden" name="msgid" value="<?php echo $MSG_FIX; ?>">

	<table cellpadding="5" width="600" border="0" style="padding-right: 45px;">
	<tr><td align="right">Today's Date:</td>
	<td><?php $ftime = date ("F d, Y "); echo $ftime; ?></td></tr>
	<tr><td align="right">Recipient's First Name:</td><td><?php echo $rowp['recipient_fn']; ?></td></tr>
	<tr><td align="right">Recipient's Last Name:</td><td><?php  echo $rowp['recipient_ln']; ?></td></tr>
	<tr><td align="right">Recipient's Relationship:</td><td><b><?php echo $rowp['relation']; ?></b></td></tr>
	<tr><td align="right">Salutation:</td><td><input type="text" name="salutation"  required value="<?php  echo $row['salutation']; ?>"/></td></tr>
	<tr><td align="right">Your Goodbye Message:</td><td align="center"><textarea name="message" cols="80" rows="20"><?php  echo $row['message']; ?></textarea>
	</td></tr>
	</table>

<p>&nbsp;</p>
<input type="submit" name="submit" value="Update Information" />
</form>
<?php // unset($_SESSION['gb_id'])?>




<!-- NEW Confirmation Code -->
<form id="del" name="del" onSubmit="return click_delete()">
<input type="submit" value="Delete this Message"/>
</form>


<br />
<p style="color:red;font-size: 15px;">* If your passing results in a purposeful criminal act, your goodbye messages will not be sent out.</p>

</div> <!-- end centered content -->



</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

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
	
function click_delete(){
	if (confirm("Are you sure?")) {
	// delete code
	window.location.href = "deletemessage.php?delyes=1&pocid=<?php echo $POC_FIX; ?>&msgid=<?php echo $MSG_FIX; ?>";}
	return false;
}
	
</script>

</body>
</html>
