<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
 if ($_POST['address'] != '' ){
die("Changed field");
    } 
$newlinecounter = 0;
foreach($_POST as $key => $val_newline){
if(stristr($val_newline, '\r')){$newlinecounter++;}
if(stristr($val_newline, '\n')){$newlinecounter++;}
if(stristr($val_newline, '\\r')){$newlinecounter++;}
if(stristr($val_newline, '\\n')){$newlinecounter++;}
if(stristr($val_newline, '\r\n')){$newlinecounter++;}
if(stristr($val_newline, '\\r\\n')){$newlinecounter++;}
if(stristr($val_newline, 'Bcc')){$newlinecounter++;}
if(stristr($val_newline, 'http')){$newlinecounter++;}
if(stristr($val_newline, '<')){$newlinecounter++;}
if(stristr($val_newline, '[')){$newlinecounter++;}
if(stristr($val_newline, '<script')){$newlinecounter++;}
}
if ($newlinecounter >= 1)
{ 
die('<h1>Page not Found</h1>');
}
$emc = substr_count($recip_email, '@', 0);
if($emc >=2){
die('Ooops, something went wrong');
}
if(isset($_POST['submit'])){
$userid = $_SESSION['userid'];

$message = trim($_POST['message']);
$_SESSION['message']=$_POST['message'];

$msg_d = trim($_POST['msg_d']) ;
$_SESSION['msg_d']=$_POST['msg_d'];

$prim=$_SESSION['prim'] = $_POST['prim'];

$recipient_mi = trim($_POST['recipient_mi']) ;
$_SESSION['recipient_mi']=$recipient_mi ;

$recipient_fn = trim($_POST['recipient_fn']) ;
$_SESSION['recipient_fn']=$recipient_fn ;

$recipient_ln = trim($_POST['recipient_ln']) ;
$_SESSION['recipient_ln']=$recipient_ln;

$relation = trim($_POST['relation']) ;
$_SESSION['relation']=$relation;

$recip_email = trim($_POST['recip_email']) ;
$_SESSION['recip_email']=recip_email;

$conf_recip_email = trim($_POST['conf_recip_email']) ;
$_SESSION['conf_recip_email']=$_POST['conf_recip_email'];

$usps_mail = trim($_POST['usps_mail']) ;
$_SESSION['usps_mail']=$_POST['usps_mail'];

$usps_mail = trim($_POST['usps_mail']) ;
$_SESSION['usps_mail']=$_POST['usps_mail'];

$usps_mail2 = trim($_POST['usps_mail2']) ;
$_SESSION['usps_mail2']=$_POST['usps_mail2'];

$city = trim($_POST['city']) ;
$_SESSION['city']=$_POST['city'];

$state = trim($_POST['state']) ;
$_SESSION['state']=$state;

$zip = trim($_POST['zip']) ;
$_SESSION['zip']=$_POST['zip'];

$city = trim($_POST['city']) ;
$_SESSION['city']=$_POST['city'];

$country = trim($_POST['country']) ;
$_SESSION['country']=$_POST['country'];

$phone = trim($_POST['phone']) ;
$_SESSION['phone']=$phone;

$notes = trim($_POST['notes']) ;
$_SESSION['notes']=$notes;

$salutation = trim($_POST['salutation']) ;
$_SESSION['salutation']=$salutation;
}


$result ="SELECT * FROM pocontact WHERE userid = ' ".$_SESSION['userid'] ." ' AND recipient_fn = '".$_SESSION['recipient_fn']."' AND recipient_mi = '".$_SESSION['recipient_mi']."' AND recipient_ln ='".$_SESSION['recipient_ln']."' AND relation = '".$_SESSION['relation']."' AND recip_email = '".$_SESSION['recip_email']."'

";  
$qv = $conn->prepare($result);
$qv->execute();
$rowv = $qv->fetch();
$countv = $qv->rowCount();
//if number of rows fields is bigger them 0 that means it's NOT available '  
if($countv >=1){  
    //and we send 0 to the ajax request  
    echo 'You have already created this contact';  
	echo $rowv['recipient_fn']. ' '. $rowv['recipient_mi']. ' '.$rowv['recipient_ln']. ' '.$rowv['relation'];
}else{ 


$ip = $_SERVER['REMOTE_ADDR'];
//$gb_id = time(); drop if not needed -  old
$poc_id = $userid . time();// this stays, this is the only place this is created
if(isset($_POST['submit'])){
$sql = "INSERT INTO pocontact (userid, poc_id, prim, recipient_fn, recipient_mi, recipient_ln, relation, recip_email, conf_recip_email, usps_mail, usps_mail2, city, state,  zip, country, phone, notes, ip) VALUES (:userid, :poc_id,  :prim,  :recipient_fn, :recipient_mi, :recipient_ln, :relation, :recip_email, :conf_recip_email, :usps_mail, :usps_mail2, :city, :state,  :zip, :country, :phone, :notes, :ip)"; 
$q = $conn->prepare($sql);

$q->execute(array(':userid'=>$userid,

':poc_id'=>$poc_id,
':prim'=>$prim,
  ':recipient_fn'=>$recipient_fn,
    ':recipient_mi'=>$recipient_mi,
   ':recipient_ln'=>$recipient_ln,
    ':relation'=>$relation,
	 ':recip_email'=>$recip_email,
	  ':conf_recip_email'=>$conf_recip_email, 
	  ':usps_mail'=>$usps_mail, 
	  ':usps_mail2'=>$usps_mail2,
	   ':city'=>$city,
	    ':state'=>$state,  
		':zip'=>$zip,
		 ':country'=>$country,
		  ':phone'=>$phone,
		  ':notes'=>$notes,

			':state'=>$state, 
			':ip'=>$ip
			));
}
if($prim==1){

$sqls ="SELECT *  FROM users WHERE userid='$userid' ";
$qs = $conn->prepare($sqls);
$qs->execute();

$row = $qs->fetch();

 //$recip_email = filter_input(INPUT_POST, ' $recip_email', FILTER_VALIDATE_EMAIL);
$header = "From: $recip_email \n"
  . "Reply-To: $recip_email \n";
$to="$recip_email";
$subject = "Point of Contact!";
$from = $recip_email ;
$msg = "Dear $recipient_fn ". ''. "$recipient_ln,\n\n"

."You are receiving this email to inform you that you have been assigned as a Point of Contact from ".$row['first_name'] . ' ' .  $row['last_name']. "'s" ." eGoodbyes account.\n\n"
."In the event of ".$row['first_name'] . ' ' .  $row['last_name']."'s" ."  passing, please submit a copy of ".$row['first_name'] . ' ' .  $row['last_name']."'s" ."  death certificate, along with their email address, street address and birthday to validate their passing. \n\n"
."This validation is required by eGoodbyes to release ".$row['first_name'] . ' ' .  $row['last_name']."'s" ."  final goodbye messages and to make ".$row['first_name'] . ' ' .  $row['last_name']."'s" ." memorial page viewable to the public.\n\n"
."If you are not able to obtain a copy of ".$row['first_name'] . ' ' .  $row['last_name']." death certificate, please contact eGoodbyes immediately so we can reach out to their other Points of Contacts to validate their passing.\n\n"

."You can contact eGoodbyes by visiting eGoodbyes.com or by email at support@egoodbyes.com.
\n\n"
;

if(isset($_POST['submit'])){mail($to, $subject, $msg, $header);
}
}
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="new/css/default.ie7.css">
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
	min-height:700px;
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

<h2>You have entered in contact information for  <?php echo $_SESSION['recipient_fn'].' '. $_SESSION['recipient_ln'];?></h2>


<!--<input type="button" value="Approve this Message" />-->
<a href="dashboard.php">Dashboard</a>
<?php }

header("Location: dashboard.php");


?>


</div><!--eo main-->

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	<!--<script src="js/validate.js"></script>-->
</body>
</html>
