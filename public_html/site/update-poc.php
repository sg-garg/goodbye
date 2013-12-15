<?php 
session_start();
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid  = $_SESSION['userid'];

if(isset($_POST['submit'])){
	$prim = trim($_POST['prim']);
	$recipient_fn = trim($_POST['recipient_fn']);
	$recipient_mi = trim($_POST['recipient_mi']);
	$recipient_ln = trim($_POST['recipient_ln']);
	$relation = trim($_POST['relation']);
	$recip_email = trim($_POST['recip_email']);
	$conf_recip_email = trim($_POST['conf_recip_email']);
	$usps_mail = trim($_POST['usps_mail']);
	$usps_mail2 = trim($_POST['usps_mail2']);
	$city = trim($_POST['city']);
	$state = trim($_POST['state']);
	$zip = trim($_POST['zip']);
	$country = trim($_POST['country']);
	$phone = trim($_POST['phone']);
	$notes = trim($_POST['notes']);
	$POC_FIX = $_SESSION['poc_id'] = $_GET['poc_id'];

	$sqlud = "UPDATE pocontact SET  

prim=:prim,
recipient_fn =:recipient_fn, 
recipient_mi =:recipient_mi, 
recipient_ln=:recipient_ln, 
relation=:relation, 
recip_email =:recip_email, 
conf_recip_email =:conf_recip_email, 
usps_mail  =:usps_mail, 
usps_mail2 =:usps_mail2, 
city=:city,
state=:state,  
zip=:zip,
country=:country,
phone=:phone,
notes=:notes,
ip =:ip 
WHERE poc_id = $_GET[poc_id]  LIMIT 1";

	$qud = $conn->prepare($sqlud);
	$qud->execute(array(

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

//$gb_id = $_GET['gb_id'];
	$sql = "SELECT * FROM pocontact WHERE userid = $userid AND poc_id = $_GET[poc_id]  LIMIT 1  ";
	$q = $conn->prepare($sql);
	$q->execute();
	$row = $q->fetch();

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

<h3>Update a Point of Contact or Recipient</h3>

<?php
if(isset($_POST['submit'])){
echo "<p style=\"color:red;font-weight:bold\">Your information has been updated.</p>";
}
?>

<form id="pocform" action="" method="post" >

<table border="0" width="600">
<tr><td width="35%" align="right">Point of Contact?</td>

<td width="65%" valign="middle" align="left"><input type="text" name="prim"  size="4"  value="<?php if(  $row['prim'] ==1) {echo'Yes';}else {echo 'No';};?>"  /><input type="checkbox" name="prim" <?php if(  $row['prim'] ==1) {echo'checked="checked" ';};?> value="1" /> </td></tr>
<tr>

<td align="right">Recipient's First Name:</td><td align="left"><input type="text" id="recipient_fn" name="recipient_fn" placeholder="Recipient's First Name" required  value="<?php echo $row['recipient_fn'] ; ?>"  /></td></tr>
<tr>

<td align="right">Recipient's Middle Initial:</td><td align="left"><input type="text" id="recipient_mi" name="recipient_mi" placeholder="MI"  value="<?php  echo $row['recipient_mi'] ; ?>"  /></td></tr>
<tr>

<td align="right">Recipient's Last Name:</td><td align="left"><input type="text" id="recipient_ln" name="recipient_ln" placeholder="Recipient's Last Name" required value="<?php  echo $row['recipient_ln'] ; ?>"  /></td></tr>
<tr>

<td align="right">Recipient's Relationship:</td><td align="left"><input type="text" id="relation" name="relation" placeholder="Recipient's Relationship" required value="<?php echo $row['relation'] ; ?>" /></td></tr>

<tr>

<td align="right">Recipient's Email:</td><td align="left"><input type="text" id="recip_email" name="recip_email" placeholder="Recipient's Email" required value="<?php  echo $row['recip_email'] ; ?>" /></td></tr>
<tr>

<td align="right">Confirm Recipient's Email:</td><td align="left"><input type="text" id="conf_recip_email" name="conf_recip_email" placeholder="Recipient's Email" required  value="<?php  echo $row['conf_recip_email'] ; ?>" /></td></tr>
<tr>

<td align="right">Mailing Address:</td><td align="left"><input type="text" id="usps_mail" name="usps_mail" placeholder="Mailing Address" required value="<?php  echo $row['usps_mail'] ; ?>"  /></td></tr>
<tr>

<td align="right">Mailing Address:</td><td align="left"><input type="text" id="usps_mail2" name="usps_mail2" placeholder="Mailing Address" value="<?php  echo $row['usps_mail2'] ; ?>" /></td></tr>
<tr>

<td align="right">City:</td><td align="left"><input type="text" id="city" name="city" placeholder="City or Town" required value="<?php  echo $row['city'] ; ?>" /></td></tr>
<tr>

<td align="right">State:</td><td align="left">
<select name="state" id="state"/>  
    
    <option value ="<?php echo $row['state']; ?>" ><?php echo $row['state']; ?></option>
      <option value='AL'>Alabama</option>
      <option value='AK'>Alaska</option>
      <option value='AZ'>Arizona</option>
      <option value='AR'>Arkansas</option>
      <option value='CA'>California</option>
      <option value='CO'>Colorado</option>
      <option value='CT'>Connecticut</option>
      <option value='DE'>Delaware</option>
      <option value='DC'>District of Columbia</option>
      <option value='FL'>Florida</option>
      <option value='GA'>Georgia</option>
      <option value='HI'>Hawaii</option>
      <option value='ID'>Idaho</option>
      <option value='IL'>Illinois</option>
      <option value='IN'>Indiana</option>
      <option value='IA'>Iowa</option>
      <option value='KS'>Kansas</option>
      <option value='KY'>Kentucky</option>
      <option value='LA'>Louisiana</option>
      <option value='ME'>Maine</option>
      <option value='MD'>Maryland</option>
      <option value='MA'>Massachusetts</option>
      <option value='MI'>Michigan</option>
      <option value='MN'>Minnesota</option>
      <option value='MS'>Mississippi</option>
      <option value='MO'>Missouri</option>
      <option value='MT'>Montana</option>
      <option value='NE'>Nebraska</option>
      <option value='NV'>Nevada</option>
      <option value='NH'>New Hampshire</option>
      <option value='NJ'>New Jersey</option>
      <option value='NM'>New Mexico</option>
      <option value='NY'>New York</option>
      <option value='NC'>North Carolina</option>
      <option value='ND'>North Dakota</option>
      <option value='OH'>Ohio</option>
      <option value='OK'>Oklahoma</option>
      <option value='OR'>Oregon</option>
      <option value='PA'>Pennsylvania</option>
      <option value='RI'>Rhode Island</option>
      <option value='SC'>South Carolina</option>
      <option value='SD'>South Dakota</option>
      <option value='TN'>Tennessee</option>
      <option value='TX'>Texas</option>
      <option value='UT'>Utah</option>
      <option value='VT'>Vermont</option>
      <option value='VA'>Virginia</option>
      <option value='WA'>Washington</option>
      <option value='WV'>West Virginia</option>
      <option value='WI'>Wisconsin</option>
      <option value='WY'>Wyoming</option>
      </select>

      </td></tr>
      </tr><tr>
      
		<td align="right">Zip Code:</td><td align="left"><input type="text" id="zip" name="zip" placeholder="Zip Code" required  value="<?php  echo $row['zip'] ; ?>"  /></td></tr>
    <tr>
    
		<td align="right">Country:</td><td align="left"><input type="text" id="country" name="country" placeholder="Country" required  value="<?php  echo $row['country'] ; ?>"  /></td></tr>
     <tr>
     
		<td align="right">Phone:</td><td align="left"><input type="text" id="phone" name="phone" placeholder="Phone Number" required value="<?php echo $row['phone'] ; ?>" /></td></tr>
         <tr>
         
		<td align="right">Notes:</td><td align="left"><textarea id="notes" name="notes"><?php echo $row['notes'] ; ?></textarea></td></tr>
				
</table>

<input type="submit" name="submit" value="Update Recipients Information" />
</form>
<br />


<?php
// unset($_SESSION['gb_id'])
$POC_FIX = $_SESSION['poc_id'] = $_GET['poc_id'];
?>

<form id="del" name="del" onSubmit="return click_delete()">
<input type="submit" value="Delete this Contact"/>
</form>


</div> <!-- end centered content -->


</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
			</div> <!-- end footer -->
		</div> <!-- end wrapperA -->

<script type="text/javascript">
	
$('#pocform').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
$('#recipient_fn').plum('form.verify', { min: 2 });
//$('#recipient_mi').plum('form.verify', { min: 1 });
$('#recipient_ln').plum('form.verify', { min: 2 });
$('#relation').plum('form.verify', { min: 3 });
$('#recip_email').plum('form.verify', { method: 'email' });
$('#conf_recip_email').plum('form.verify', function () {
	var emailval = $('#recip_email').val();
	//return email && email === this.value;
	//return emailj && this.value === value;
	return emailval && emailval === this.value;
});

$('#usps_mail').plum('form.verify', { min: 5 });
//$('#usps_mail2').plum('form.verify', { min: 5 });
$('#city').plum('form.verify', { min: 2 });
$('#state').plum('form.verify', { min: 2 });
$('#zip').plum('form.verify', { min: 5 });
$('#country').plum('form.verify', { min: 3 });
$('#phone').plum('form.verify', { method: 'tel' });
//$('#notes').plum('form.verify', { min: 1 });

$('#del').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
function click_delete(){
	if (confirm("Are you sure?")) {
	// delete code
	window.location.href = "deletecontact.php?delyes=1&pocid=<?php echo $POC_FIX; ?>";}
	return false;
}

</script>
</body>
</html>
