<?php
require_once("authhead.php");
require_once("pdoconnect.inc.php");

include("include/check_max.php");
check_max("4");

$userid = $_SESSION['userid'];
$sq = "SELECT * FROM memorials WHERE userid = '$userid' AND self_mem = 'yes' ";
$qs = $conn->prepare($sq);
$qs->execute();
$rowc = $qs->fetch();
$y = $rowc['self_mem'];
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
		</div>

<div class="content">
<div id="wrapper">
<div align="center">
<?php 

if($rowc['self_mem'] === 'yes'){

echo '<h1>You have already created a memorial for yourself</h1> 
<br />
 <h2>You may wish to return to the Dashboard to compose a Googbye message to an individual or edit your existing memorial Page</h2>';
 
 } else {

//echo $rowc['userid'];
//echo $rowc['self_mem'];
//echo $rowc['mem_id'];
//echo $rowc['memorial'];
//echo $y;
//echo $userid;
 ?>
 
<h2>Create a Memorial for Yourself</h2>

<h3>This memorial page will be viewable to the public after you've passed.</h3>
<br/>

<?php

$sql = "SELECT *  FROM users WHERE userid = '$userid'";
$q = $conn->prepare($sql);
$q->execute();

$row = $q->fetch();
?>

<form id="radical" action="upload-memorial-images.php" method="post" enctype="multipart/form-data" >

<table width="780" border="0" cellspacing="5">

<!--<tr><td><label>Userid- for debug</label></td><td><input name="userid" type="text" readonly=readonly value="<?php //echo $_SESSION['userid']; ?>"  /></td></tr>-->


<tr><td align="right"><label>Name of Memorial:</label></td><td><input id="memorial" name="memorial" type="text" required ="required"/></td></tr>

<tr><td>&nbsp;</td>

<td><input name="self_mem" type="hidden" value ='yes'/></td></tr>

<tr><td align="right"><label>Surname:</label></td>
<td><input id="sname" name="sname" type="text"  /></td></tr>

<tr><td align="right"><label>First Name:</label></td>
<td><input id="fname" name="fname" type="text" required value="<?php echo $row['first_name']; ?>" /></td></tr>

<tr><td align="right"><label>Middle Name:</label></td>
<td><input id="mi" name="mi" type="text" required value="<?php echo $row['middle_name'];  ?>" /></td></tr>

<tr><td align="right"><label>Last Name:</label></td>
<td><input id="lname" name="lname" type="text" required value="<?php echo $row['last_name'];  ?>" /></td></tr>

<tr><td align="right"><label>'Nick' Name:</label></td>
<td><input id="nname" name="nname" type="text"  value="<?php echo $_SESSION['nname']; ?>" /></td></tr>

<!--<tr><td><label>URL for Memorial</label></td><td><input name="memurl" type="text" value="<?php //echo $_SESSION['memurl']; ?>" /></td></tr>-->

<tr><td align="right"><label>Upload Main Image:</label></td>
<td><input id="memimage" name="memimage" type="file"/></td></tr>

<tr><td align="right"><label>Birthdate:</label></td>
<td><input id="bdate" name="bdate" type="text" value="<?php echo $row['birthday']; ?>" /></td></tr>

<!--<tr><td><label>Pass Date</label></td><td><input name="dod" type="text" value="<?php //echo $_SESSION['dod']; ?>" /></td></tr>-->

<tr><td align="right"><label>Title:</label></td>
<td><input id="title" name="title" type="text" placeholder = "In Loving Memory" value="<?php echo $_SESSION['title']; ?>" /></td></tr>

<!--<tr><td><label>Created by</label></td><td><textarea name="createby" cols="40" rows="4" ><?php //echo $_SESSION['createby']; ?></textarea></td></tr>-->

<tr><td align="right"><label>How do you want to be remembered?:</label></td>
<td><textarea id="comments" name="comments" cols="80" rows="20" ><?php echo $_SESSION['comments']; ?></textarea></td></tr>

<!--<tr><td><label>Information about Services</label></td><td><textarea name="service" cols="40" rows="8" ><?php //echo $_SESSION['service']; ?></textarea></td></tr>-->

</table>

<input name="submit" type="submit" value="Save Your Memorial" />

</form>

<br />

<?php }?>

<br />
<p style="color:red;font-size: 15px;">* If your passing results in a purposeful criminal act, your memorial page will not be viewable.</p>


</div> <!--end of center -->

</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->

</div> <!-- end wrapperA -->

<script type="text/javascript">

$('#radical').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
$('#memorial').plum('form.verify', { min: 2 });
$('#fname').plum('form.verify', { min: 2 });
$('#lname').plum('form.verify', { min: 1 });
$('#comments').plum('form.verify', { min: 10 });
</script>

</body>
</html>
