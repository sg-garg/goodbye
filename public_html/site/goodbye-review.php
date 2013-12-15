<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");

	$poc_id = trim($_POST['poc']);
	$chk = "SELECT poc_id FROM gb_messages WHERE poc_id = '$poc_id' ";
	$qchk = $conn->prepare($chk);
	$qchk -> execute();
	$chkcount = $qchk -> rowCount();

	if($chkcount >=1){
echo 'You have already composed a message to this recipient, please go to the <a href="dashboard.php">Dashboard</a> to edit your existing message.';
	}else{

$userid = $_SESSION['userid'];
$sqlpoc = "SELECT * FROM pocontact WHERE userid = '$userid' AND poc_id = '$poc_id'";
	$qpoc = $conn->prepare($sqlpoc);
	$qpoc->execute();
	$rowpoc = $qpoc->fetch();
	$recip_email = $rowpoc['recip_eamil'];

if(isset($_POST['submit'])){
$userid = $_SESSION['userid'];

$emyes = $_SESSION['emyes'] = trim($_POST['emyes']);

$message = trim($_POST['message']);
$_SESSION['message'] = $message;

$msg_date = trim($_POST['msg_date']) ;
$_SESSION['msg_date'] = $msg_date;

$type  = trim($_POST['type']);
$_SESSION['type'] = $type;

$salutation = trim($_POST['salutation']);
$_SESSION['salutation'] = $salutation;
}

$ip = $_SERVER['REMOTE_ADDR'];
$msg_id = time();


$gbmes_data = $salutation ."\n\n". $message;
$gbmes = $poc_id . '.txt';
$gbs = fopen('/home/goodbye/public_html/site/gbmes/' . $gbmes, 'w+');
fwrite($gbs, $gbmes_data);
fclose($gbs);


if(isset($_POST['submit'])){

	$sql = "INSERT INTO gb_messages (userid, msg_id, poc_id, msg_date, type, emyes, salutation, message, gbmes, ip) VALUES (:userid, :msg_id, :poc_id,  :msg_date, :type, :emyes, :salutation, :message, :gbmes,  :ip)";

	//pdo table name in this example

	$q = $conn->prepare($sql);
	$q->execute(array(
':userid'=>$userid,
':msg_id'=>$msg_id,
':poc_id'=>$poc_id,
':msg_date'=>$msg_date,
':type'=>$type,
':emyes'=>$emyes,
':salutation'=>$salutation,
':message'=>$message,
':gbmes'=>$gbmes,
':ip'=>$ip));

}

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

#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	color:#000;
	}
p	{
	color:#000;
	}
.black	{
	color:#000000;
	}
</style>
</head>

<body>
<?php
if (file_exists($gbmes)) {
    echo "The file $gbmes exists";
		} else {
		echo "The file $gbmes does not exist";
		}
	echo $gbmes;
?>

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
// echo $_POST['poc'];

$sqlgb = "SELECT * FROM gb_messages WHERE poc_id = '$poc_id'";
$qgb = $conn->prepare($sqlgb);
$qgb->execute();
$rowgb = $qgb->fetch();


if($rowgb['type'] == 1 ){?>

<h2>Here is a preview of your message to <?php echo $rowpoc['recipient_fn'] .'  '. $rowpoc['recipient_ln'];?></h2>
<p><?php echo $rowpoc['recipient_fn'].', this message was written for you on '. $_SESSION['msg_date']; ?></p>
<p><?php echo $_SESSION['salutation'] ; ?></p>
<p><?php echo nl2br($_SESSION['message'] ); ?></p>
<?php }else{
if($rowgb['type']==2){
$usersql = "SELECT * FROM users WHERE userid ='$userid'";
$qu = $conn->prepare($usersql);
$qu->execute();
$rowu = $qu->fetch();
echo '<div id=letter>';
echo '<h1 class=center>'.$rowu['first_name']. ' ' .$rowu['last_name'].'</h1>';
echo '<p class=center>'.$rowu['street_address'].'<br />';
echo $rowu['city']. ' ' .$rowu['state']. ' ' .$rowu['zip'];
echo '</p>';

  date_default_timezone_set('America/New_York');
	echo date('l F jS, o');
echo '<br />';

echo '<p class="black">' .$rowgb['salutation'].';';
echo '<p>' .nl2br($rowgb['message']).'</p>';
echo '<p> This message was originally written on ' .  $rowgb['msg_date'].'</p>';
}
}
echo '</div>';

if($emyes==1){

$sqls ="SELECT  * FROM pocontact WHERE userid='$userid' AND poc_id = '$poc_id'";

$qs = $conn->prepare($sqls);
$qs->execute();

$row = $qs->fetch();

 //$recip_email = filter_input(INPUT_POST, ' $recip_email', FILTER_VALIDATE_EMAIL);
$header = "From: $recip_email \n"
  . "Reply-To: $recip_email \n";
$to="$recip_email";
$subject = "This is a goodbye notification message from EGoodbyes!";
$from = $recip_email ;
$msg = "First Name: $row[recipient_fn]\n" 
. "Last Name: $row[recipient_ln]\n"

."Email: $row[recip_email]\n"

."Enter the egoodbye message here, edit line 134\n"
//."Message from ".$rowu['first_name'] ."  ". $rowu['last_name'].""
;

if(isset($_POST['submit'])){mail($to, $subject, $msg, $header);
}
}
?>
<!--<input type="button" value="Approve this Message" />-->

<?php }?>


<?php

$what = file_get_contents('gbmes.txt');

echo $what;

header("Location: dashboard.php");

?>


</div><!--eo main-->
</div> <!-- end content -->


	<div id="footer">
		<div class="content">
		<?php include("include/footer.php") ;?>
		</div> <!-- end content -->
	</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	<!--<script src="js/validate.js"></script>-->
</body>
</html>
