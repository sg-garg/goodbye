<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");


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

#main	{width:880px;margin:0px auto;background-color:#D8E0E4;overflow:hidden;}
.important	{visibility: hidden;height:15px;}
.smalltext {width: 400px;margin: 2px;border-color: #0a0f32;
border-width: 1px;border-style: solid;padding: 3px;color: #0a0f32;
	text-align: left;
	font-size: 11px;
	font-family: Verdana, Arial, sans-serif;
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
<h2>Create a Point of Contact or Recipient</h2>
<p class="smalltext">A <i>Point of Contact</i> is someone that you choose to verify your passing.  They will be notified from eGoodbyes, via email, that they are a Point of Contact for you and they will need to submit a copy of your Death Certificate to validate you have passed.  If they do not receive an email, please have them check their spam folder.  eGoodbyes requires you create at least 2 Point of Contacts.</p>



<br>
<form id="pocform" action="contact-review.php" method="post" >
<table cellspacing="2" cellpadding="3" border="0" width="600">
<tr><td align="right" width="35%">Is This A  Point of Contact?</td>
<td width="65%" align="left"><input type="checkbox" name="prim" checked="checked" value="1" /></td></tr>

<tr><td align="right"> Recipient's First Name</td><td align="left"><input type="text" id="recipient_fn" name="recipient_fn" placeholder="Recipient's First Name" required autofocus="autofocus"  value="<?php //if(isset($_SESSION['recipient_fn'] )) echo $_SESSION['recipient_fn'] ; ?>"  /></td></tr>

<tr><td align="right">Recipient's Middle Initial</td><td align="left"><input type="text" id="recipient_mi" name="recipient_mi" placeholder="Recipient's Middle Initial"  value="<?php  //echo $_SESSION['recipient_mi'] ; ?>"  /></td></tr>

<tr><td align="right">Recipient's Last Name</td><td align="left"><input type="text" id="recipient_ln" name="recipient_ln" placeholder="Recipient's Last Name" required value="<?php //if(isset($_SESSION['recipient_ln'] )) echo $_SESSION['recipient_ln'] ; ?>"  /></td></tr>

<tr><td align="right">Recipient's Relationship</td><td align="left"><input type="text" id="relation" name="relation" placeholder="Recipient's Relationship" required value="<?php //if(isset($_SESSION['relation'] )) echo $_SESSION['relation'] ; ?>" /></td></tr>

<tr><td align="right">Recipient's Email</td><td align="left"><input type="text" id="recip_email" name="recip_email"  id='check_username_availability' placeholder="Recipient's Email" required value="<?php //if(isset($_SESSION['recip_email'] )) echo $_SESSION['recip_email'] ; ?>" /></td></tr>

<tr><td align="right">Confirm Recipient's Email</td><td align="left"><input type="text" id="conf_recip_email" name="conf_recip_email" placeholder="Recipient's Email" required  value="<?php //if(isset($_SESSION['conf_recip_email'] )) echo $_SESSION['conf_recip_email'] ; ?>" /></td></tr>

<tr><td align="right">Mailing Address</td><td align="left"><input type="text" id="usps_mail" name="usps_mail" placeholder="Mailing Address" required value="<?php //if(isset($_SESSION['usps_mail'] )) echo $_SESSION['usps_mail'] ; ?>"  /></td></tr>

<tr><td align="right">Mailing Address</td><td align="left"><input type="text" id="usps_mail2" name="usps_mail2" placeholder="Mailing Address"  value="<?php //if(isset($_SESSION['usps_mail2'] )) echo $_SESSION['usps_mail2'] ; ?>" /></td></tr>

<tr><td align="right">City</td><td align="left"><input type="text" id="city" name="city" placeholder="City or Town" required value="<?php //if(isset($_SESSION['city'] )) echo $_SESSION['city'] ; ?>" /></td></tr>

<tr><td align="right">State</td><td align="left">
<select name="state" id="state"/>  
    <option value="" selected="selected"></option>
       <option<?php if($_SESSION['state']=='AK') { echo "
		selected=selected"; } ?> value="AK">Alaska</option>
		<option<?php if($_SESSION['state']=='AL') { echo "
		selected=selected"; } ?> value="AL">Alabama</option>
		<option<?php if($_SESSION['state']=='AR') { echo "
		selected=selected"; } ?> value="AR">Arkansas</option>  
        <option<?php if($_SESSION['state']=='AZ') { echo "
		selected=selected"; } ?> value="AZ">Arizona</option>
         <option<?php if($_SESSION['state']=='CA') { echo "
		selected=selected"; } ?> value="CA">California</option>
       <option<?php if($_SESSION['state']=='CO') { echo "
		selected=selected"; } ?> value="CO">Colorado</option>
         <option<?php if($_SESSION['state']=='CT') { echo "
		selected=selected"; } ?> value="CT">Connecticut</option>
		<option<?php if($_SESSION['state']=='DC') { echo "
		selected=selected"; } ?> value="DC">District of Columbia</option>
		<option<?php if($_SESSION['state']=='DE') { echo "
		selected=selected"; } ?> value="DE">Delaware</option>  
        <option<?php if($_SESSION['state']=='FL') { echo "
		selected=selected"; } ?> value="FL">Florida</option>
         <option<?php if($_SESSION['state']=='GA') { echo "
		selected=selected"; } ?> value="GA">Georgia</option>
       <option<?php if($_SESSION['state']=='HI') { echo "
		selected=selected"; } ?> value="HI">Hawaii</option>
         <option<?php if($_SESSION['state']=='IA') { echo "
		selected=selected"; } ?> value="IA">Iowa</option>
		<option<?php if($_SESSION['state']=='ID') { echo "
		selected=selected"; } ?> value="ID">Idaho</option>
		<option<?php if($_SESSION['state']=='IL') { echo "
		selected=selected"; } ?> value="IL">Illinois</option>  
        <option<?php if($_SESSION['state']=='IN') { echo "
		selected=selected"; } ?> value="IN">Indiana</option>
         <option<?php if($_SESSION['state']=='KS') { echo "
		selected=selected"; } ?> value="KS">Kansas</option>
       <option<?php if($_SESSION['state']=='KY') { echo "
		selected=selected"; } ?> value="KY">Kentucky</option>
         <option<?php if($_SESSION['state']=='LA') { echo "
		selected=selected"; } ?> value="LA">Louisiana</option>
		<option<?php if($_SESSION['state']=='MA') { echo "
		selected=selected"; } ?> value="MA">Massachusetts</option>
		<option<?php if($_SESSION['state']=='MR') { echo "
		selected=selected"; } ?> value="MR">Maryland</option>  
        <option<?php if($_SESSION['state']=='ME') { echo "
		selected=selected"; } ?> value="ME">Maine</option>
         <option<?php if($_SESSION['state']=='MI') { echo "
		selected=selected"; } ?> value="MI">Michigan</option>
       <option<?php if($_SESSION['state']=='MN') { echo "
		selected=selected"; } ?> value="MN">Minnesota</option>
         <option<?php if($_SESSION['state']=='MO') { echo "
		selected=selected"; } ?> value="MO">Missouri</option>
		<option<?php if($_SESSION['state']=='MS') { echo "
		selected=selected"; } ?> value="MS">Mississippi</option>
		<option<?php if($_SESSION['state']=='MT') { echo "
		selected=selected"; } ?> value="MT">Montana</option>  
        <option<?php if($_SESSION['state']=='NC') { echo "
		selected=selected"; } ?> value="NC">North Carolina</option>
         <option<?php if($_SESSION['state']=='ND') { echo "
		selected=selected"; } ?> value="ND">North Dakota</option>
       <option<?php if($_SESSION['state']=='NE') { echo "
		selected=selected"; } ?> value="NE">Nebraska</option>
         <option<?php if($_SESSION['state']=='NH') { echo "
		selected=selected"; } ?> value="NH">New Hampshire</option>
		<option<?php if($_SESSION['state']=='NJ') { echo "
		selected=selected"; } ?> value="NJ">New Jersey</option>
		<option<?php if($_SESSION['state']=='NM') { echo "
		selected=selected"; } ?> value="NM">New Mexico</option>  
        <option<?php if($_SESSION['state']=='NV') { echo "
		selected=selected"; } ?> value="NV">Nevada</option>
         <option<?php if($_SESSION['state']=='NY') { echo "
		selected=selected"; } ?> value="NY">New York</option>
       <option<?php if($_SESSION['state']=='OH') { echo "
		selected=selected"; } ?> value="OH">Ohio</option>
         <option<?php if($_SESSION['state']=='OK') { echo "
		selected=selected"; } ?> value="OK">Oklahoma</option>
		<option<?php if($_SESSION['state']=='OR') { echo "
		selected=selected"; } ?> value="OR">Oregon</option>
		<option<?php if($_SESSION['state']=='PA') { echo "
		selected=selected"; } ?> value="PA">Pennsylvania</option>  
        <option<?php if($_SESSION['state']=='PR') { echo "
		selected=selected"; } ?> value="PR">Puerto Rico</option>
         <option<?php if($_SESSION['state']=='RI') { echo "
		selected=selected"; } ?> value="RI">Rhode Island</option>
       <option<?php if($_SESSION['state']=='SC') { echo "
		selected=selected"; } ?> value="SC">South Carolina</option>
         <option<?php if($_SESSION['state']=='SD') { echo "
		selected=selected"; } ?> value="SD">South Dakota</option>
		<option<?php if($_SESSION['state']=='TN') { echo "
		selected=selected"; } ?> value="TN">Tennessee</option>
		<option<?php if($_SESSION['state']=='TX') { echo "
		selected=selected"; } ?> value="TX">Texas</option>  
        <option<?php if($_SESSION['state']=='UT') { echo "
		selected=selected"; } ?> value="UT">Utah</option>
         <option<?php if($_SESSION['state']=='VA') { echo "
		selected=selected"; } ?> value="VA">Virginia</option>
       <option<?php if($_SESSION['state']=='VT') { echo "
		selected=selected"; } ?> value="VT">Vermont</option>
         <option<?php if($_SESSION['state']=='WA') { echo "
		selected=selected"; } ?> value="WA">Washington</option>
		<option<?php if($_SESSION['state']=='WI') { echo "
		selected=selected"; } ?> value="WI">Wisconsin</option>
		<option<?php if($_SESSION['state']=='WV') { echo "
		selected=selected"; } ?> value="WV">West Virginia</option>  
        <option<?php if($_SESSION['state']=='WY') { echo "
		selected=selected"; } ?> value="WY">Wyoming</option>
</select>
</td></tr>
      
    <tr><td align="right">Zip Code</td><td align="left"><input type="text" id="zip" name="zip" placeholder="Zip Code" required  value="<?php // if(isset($_SESSION['zip'] )) echo $_SESSION['zip'] ; ?>"  /></td></tr>
    
    <tr><td align="right">Country</td><td align="left"><input type="text" id="country" name="country" placeholder="Country" required  value="<?php // if(isset($_SESSION['country'] )) echo $_SESSION['country'] ; ?>"  /></td></tr>
     
     <tr><td align="right">Phone</td><td align="left"><input type="text" id="phone" name="phone" placeholder="Phone Number" required value="<?php //if(isset($_SESSION['phone'] )) echo $_SESSION['phone'] ; ?>" /></td></tr>
         
     <tr><td align="right">Notes</td><td align="left"><textarea id="notes" name="notes"> <?php // if(isset($_SESSION['notes'] )) echo $_SESSION['notes'] ; ?></textarea></td></tr>
     
     <!-- <tr><td class="important" align="right">Phone</td><td class="important"><input type="text" name="address" placeholder="Number"/></td></tr> -->
     
     <tr><td>&nbsp;</td><td align="center"></td></tr>  
</table>
<input id="submitpoc" type="submit" name="submit" value="Submit">
</form>



</div> <!-- end center -->
<br /><br />
<?php //mysql query to select field username if it's equal to the username that we check '  
$result ='SELECT * FROM pocontact WHERE usernid = ' .$userid . ' AND recipient_fn ='. recipient_fn. 'AND recipient_mi ='. recipient_mi. '  AND recipient_ln = '.recipient_ln.' AND recip_email ='.recip_email.'';  
$qv = $conn->prepare($result);
$qv->execute();

$row = $qv->fetch();
$count = $qv->rowCount();
//if number of rows fields is bigger them 0 that means it's NOT available '  
if($count >0){  
    //and we send 0 to the ajax request  
    echo 0;  
}else{  
    //else if it's not bigger then 0, then it's available '  
    //and we send 1 to the ajax request  

}  ?>
<script>
$(document).ready(function() {
//function to check username availability
function check_availability(){
		//get the username
		var username = $('#username').val();
		//use ajax to run the check
		$.post("check_username.php", { username: username },
			function(result){
//if the result is 1
	if(result == 1){
//show that the username is available
	$('#username_availability_result').html(username + ' is Available');
	}else{
	//show that the username is NOT available
	$('#username_availability_result').html(username + ' is not Available');
	}
	
});
}
});

</script>
<script>
$("#recip_email").blur(function(){
  $.ajax({url: 'point-of-contact.php', type: 'POST'})
  .done(function(response){
    $("#my_div").html(response);
  })
})

$('form').plum('form', {
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

</script>



</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

		<div id="footer">
		<div class="content">
		<?php include("include/footer.php") ;?>
		</div> <!-- end content -->
		</div> <!-- end footer -->
</div> <!-- end wrapperA -->


</body>
</html>
