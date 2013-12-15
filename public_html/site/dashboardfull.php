<?php 
error_reporting(0);
session_start();
require_once("authhead.php");
require_once("pdoconnect.inc.php");
if(isset($_POST['unset'])){
session_destroy();
unset($_SESSION); 

}
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>Dashboard of <?php echo $_SESSION['username']; ?></title>  

<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/default.ie7.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->
<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/extra-style.css">
<style>
th	{
	text-align:left;
	}

/*#dashmenu	{
	width:960px;
	margin:0px auto;
	border:2px solid #ccc;
	/*height:50px;
	background: #D8E0E4;
	
	
	}*/
#leftcol		{
	width:630px;
	float:left;
	padding:5px;
	}
#rightcol		{
	width:210px;
	float:left;
	padding:5px;
	}
.inline	{
	display:inline-block;
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
<div class="content">
<div id="main">
<div id="leftcol">
<h2><a href="events-admin.php">Mike, Click here for Events Admin Page</a></h2>
<h2><?php echo 'Welcome ' .   $_SESSION[username]. ' '. $_SESSION['userid']; ?></h2>
<form action="auth.inc.php" method="post">
<input type="submit" name="unset" value="Log Out" />
</form>
<h2><a href="point-of-contact.php">Enter a New Point of Contact</a></h2>
<h4>Points of Contact</h4>
<?php $sqlppoc = "SELECT * FROM pocontact WHERE userid = '$_SESSION[userid]' AND prim ='1' ORDER BY recipient_ln ASC";
$qppoc = $conn->prepare($sqlppoc);
$qppoc->execute();
$rowcount = $qppoc ->rowCount(); 

echo '<table cellpadding=5>';
while($rowppoc = $qppoc->fetch())
{

echo '<tr><td>'. $rowppoc['recipient_fn']. ' ' .$rowppoc['recipient_mi']. '  ' . $rowppoc['recipient_ln'].'</td><td>'. $rowppoc['relation'].'</td><td><a href="update-poc.php?poc_id='.$rowppoc[poc_id].'">Edit</a></tr>';

}
echo '</table>';

if($rowcount>1){
?>
<h2><a href="point-of-contact.php">Enter a New Contact</a></h2>
<h4>Your Contacts</h4>
<?php 
$sqlpoc = "SELECT * FROM pocontact WHERE userid = '$_SESSION[userid]' ORDER BY recipient_ln ASC ";
$qpoc = $conn->prepare($sqlpoc);
$qpoc->execute();

echo '<table cellpadding=5>';
echo '<th>Name</th><th>Relationship</th><th>Point of Contact?</th>    ';
while($rowpoc = $qpoc->fetch())
{

echo '<tr><td>'. $rowpoc['recipient_fn']. ' ' .$rowpoc['recipient_mi']. '  ' . $rowpoc['recipient_ln'].'</td><td>'. $rowpoc['relation'].'</td><td>';?><?php if(isset($rowpoc['prim']) && $rowpoc['prim']==1){echo 'Yes';}?><?php echo '</td><td><a href="update-poc.php?poc_id='.$rowpoc[poc_id].'">Edit</a></tr>';

}
echo '</table>';
$_SESSION['gb_id']= $row['gb_id'];
?>
<h2><a href="compose-goodbye.php">Compose a New Goodbye</a></h2>
<?php 
$userid = $_SESSION['userid'];

try{
/*$sql = "SELECT * FROM pocontact, gb_messages   WHERE userid ='$userid'
";*/

$sql="
SELECT    pocontact.recipient_fn, pocontact.recipient_mi, pocontact.recipient_ln,
 gb_messages.msg_date, gb_messages.msg_id FROM pocontact  JOIN gb_messages 
ON (gb_messages.poc_id = pocontact.poc_id) 
WHERE gb_messages.userid =? ";


$q = $conn->prepare($sql);
$q->execute(array($userid));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}

$count = $q->rowCount();
if($count>= 1){
echo '<h3>Existing Goodbye Messages</h3>';
}else{
if($count == 0){
echo '<h3>You have Not Created any Goodbye Messages</h3>';
}
}
echo '<table cellpadding=5>';
while($row = $q->fetch())
{

echo '<tr><td>'. $row['recipient_fn']. ' '.$row['recipient_mi'] .' ' . $row['recipient_ln'].'</td><td>'. $row['relation'].'</td><td>'. $row['msg_date'].' </td><td><a href="update-goodbye.php?msg_id='.$row['msg_id'].'">Edit</a></tr>';

}
echo '</table>';

?>
<h2><a href="create-memorial.php">Create a Memorial</a></h2>

<?php 
$sqlm = "SELECT * FROM memorials WHERE userid = '$userid'";
$qm = $conn->prepare($sqlm);
$qm->execute();
$rowm = $qm->fetch();
$mem_id = $_SESSION['mem_id']= $rowm['mem_id'];
$countm= $qm->rowCount();
if($countm  >=1){
echo '<h3>Existing Memorials</h3>';
}else{
if($countm ==0 ){
echo '<h3>You have Not Created a Memorial</h3>';
}
}
echo '<table>';

$sqlm1 = "SELECT * FROM memorials WHERE userid = '$userid'";
$qm1 = $conn->prepare($sqlm1);
$qm1->execute();

while($rowm1 = $qm1->fetch())
{

echo '<tr><td><a href=preview-memorial.php>'. $rowm1['fname']. ' ' . $rowm1['lname'].'</a></td><td><a href="update-memorial.php?mem_id='.$rowm1[mem_id].'">Edit</a></td><td>'.$rowm1['mem_id'].'</td></tr>';

}
echo '</table>';
$_SESSION['mem_id']= $rowm1['mem_id'];
}else{
echo'<h3>You must have at least 2 Points of Contact.</h3>';}?>
</div><!--eo leftcol-->
<div id="rightcol"><h3>Your Account Information</h3>
<?php 
$sqlmai = "SELECT * FROM users WHERE userid = '$userid'";
$qmai = $conn->prepare($sqlmai);
$qmai->execute();
$rowmai = $qmai->fetch();
$mail_remain = $rowmai['goodbyes'] - $count;
?>
<table>
<tr>
<td>User Name:</td><td><?php echo $rowmai['username']; ?></td></tr>
<td>User Id:</td><td><?php echo $rowmai['userid']; ?></td></tr>
<td>Account Level:</td><td><?php echo $rowmai['user_level']; ?></td></tr>
<td>Emails Remaining:</td><td><?php echo $mail_remain; ?>

</td></tr>
<td>Postal Mail Messages Remaining:</td><td><?php echo 5 - $count; ?></td></tr>
<td>Video Uploads Remaining:</td><td></td></tr>
<td>Memorials Remaining:</td><td></td></tr>


</tr>
</table>

</div><!--eo rightcol-->
</div>






</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	<script src="js/validate.js"></script>
</body>
</html>
