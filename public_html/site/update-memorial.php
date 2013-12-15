<?php
require_once("authhead.php");
require_once('pdoconnect.inc.php');

$mem_id = $_SESSION['mem_id'] = $_GET['mem_id'];

	if(isset($_POST['submit'])){
		$memorial = trim($_POST['memorial']);
		$sname = trim($_POST['sname']);
		$fname = trim($_POST['fname']);
		$mi = trim($_POST['mi']);

		$lname = trim($_POST['lname']);
		$nname = trim($_POST['nname']);
		$createby = trim($_POST['createby']);
		$memurl = trim($_POST['memurl']);
		
		$memimage =  trim($_POST['memimage']);		
		$bdate = trim($_POST['bdate']);
		$dod = trim($_POST['dod']);
		$title = trim($_POST['title']);
		$comments = trim($_POST['comments']);
		$service = trim($_POST['service']);
		$userid = $_SESSION['userid'];

		$mem_id = $_SESSION['mem_id'] = $_GET['mem_id'];

		$image_file = $_FILES['memimage']['name'];
		$image_type = $_FILES['memimage']['type'];
		$image_size = $_FILES['memimage']['size']; 

	if (!empty($image_file)) {
		if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {

		if ($_FILES['memimage']['error'] == 0) {

		// Move the file to the target upload folder
		$target = 'imagesmemorial'. '/' . $image_file;
		  
		if (move_uploaded_file($_FILES['memimage']['tmp_name'], $target)){
		  
		  $udi ="UPDATE memorials SET memimage = :memimage WHERE   mem_id =  '$_GET[mem_id]'  ";
		  $qli = $conn->prepare($udi);
          $qli->execute(array(':memimage' => $image_file));
		  }
		  }
		  }
}
	}
////////above works without the added update


	
	if(isset($_POST['submit'])){	
  
$ud = "UPDATE memorials  SET  
memorial = :memorial , 
sname = :sname,
fname =:fname,
mi =:mi,
 lname =:lname, 
 nname = :nname, 
 createby =:createby, 
 memurl = :memurl, 
 bdate = :bdate, 
 dod = :dod,
 title = :title , 
 comments = :comments , 
 service = :service 

WHERE   mem_id =  '$_GET[mem_id]'  ";
$ql = $conn->prepare($ud);
$ql->execute(array(
':memorial' => $memorial ,  
':sname'=>$sname, 
':fname' => $fname , 
':mi'=>$mi,
':lname' =>$lname ,  
':nname' => $nname ,  
':createby' => $createby ,  
':memurl' => $memurl , 
':bdate' => $bdate ,  
':dod' => $dod ,  
':title' => $title ,  
':comments' => $comments ,  
':service'=>$service
));

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
<div id="wrapper">

<?php 

$sql = "SELECT * FROM memorials WHERE mem_id = '$_GET[mem_id]'  LIMIT 1";
$q = $conn->prepare($sql);
$q->execute();
$row = $q->fetch();
?>

<div align="center">

<h2>Update a Memorial</h2>

<?php
if(isset($_POST['submit'])){
echo "<p style=\"color:red;font-weight:bold\">Your information has been updated.</p>";
}
?>

<form id="updatemem" action="" method="post" enctype="multipart/form-data" >

<table width="790" border="0" cellspacing="5">

<!--<tr><td><label>Userid- for debug</label></td><td><input name="userid"  type="readonly"  value="<?php //echo $row['userid']; ?>"  /></td></tr>-->

<tr><td align="right"><label>Name of Memorial:</label></td>
<td><input id="memorial" name="memorial" type="text" required value="<?php echo $row['memorial']; ?>" /></td></tr>

<tr><td align="right"><label>Surname:</label></td>
<td><input id="sname" name="sname" type="text"  value="<?php echo $row['sname']; ?>" /></td></tr>

<tr><td align="right"><label>First Name:</label></td>
<td><input id="fname" name="fname" type="text" required value="<?php echo $row['fname']; ?>" /></td></tr>

<tr><td align="right"><label>Middle Initial:</label></td>
<td><input id="mi" name="mi" type="text"  value="<?php echo $row['mi']; ?>" /></td></tr>

<tr><td align="right"><label>Last Name:</label></td>
<td><input id="lname" name="lname" type="text" required value="<?php echo $row['lname']; ?>" /></td></tr>

<tr><td align="right"><label>'Nick' Name:</label></td>
<td><input id="nname" name="nname" type="text"  value="<?php echo $row['nname']; ?>" /></td></tr>

<!--<tr><td><label>URL for Memorial</label></td><td><input name="memurl" type="text" value="<?php /*echo $row['memurl'];*/ ?>" /></td></tr>-->

<tr><td align="right"><label>Upload Main Image:</label></td>
<td><input id="memimage" name="memimage" type="file" value=<?php echo $row['memimage']; ?>  />

<!--</td><td><input name="memimage" type="file"  /></td></tr>-->

<tr><td align="right"><label>Birthdate:</label></td>
<td><input id="bdate" name="bdate" type="text" value="<?php echo $row['bdate']; ?>" /></td></tr>

<tr><td align="right"><label>Pass Date:</label></td>
<td><input id="dod" name="dod" type="text" value="<?php echo $row['dod']; ?>" /></td></tr>


<!--<tr><td><label>Title</label></td><td><input name="title" type="text" placeholder = "In Loving Memory" value="<?php // echo $row['title']; ?>" /></td></tr>-->


<tr><td align="right"><label>Created by:</label></td>
<td><input id="createby" name="createby" type="text" value="<?php echo $row['createby']; ?>" />
</td></tr>

<tr><td align="right"><label>Words about the deceased:</label></td>
<td><textarea id="comments" name="comments" cols="80" rows="15" ><?php echo $row['comments']; ?></textarea></td></tr>


<tr><td align="right"><label>Information about Services:</label></td>
<td><textarea id="service" name="service" cols="80" rows="15" ><?php echo $row['service']; ?></textarea></td></tr>

</table>
<br>
<a href="<?php echo 'preview-memorial.php?mem_id='.$_GET['mem_id']; ?>"><h3>Preview Your Memorial</h3></a>
<br>
<input name="submit" type="submit" value="Update Memorial" />
</form>

<!--<form name="preview"  action="<?php/* echo 'preview-memorial.php?mem_id='.$_GET['mem_id'];*/?>">
<input type="submit" value="Preview This Memorial" />
</form>-->
<br />
<form id="delmem" name="delmem" onSubmit="return click_delete()">
<input type="submit" value="Delete Memorial"/>
</form>

</div> <!-- end of center -->

</div> <!-- end content -->
</div><!-- end #wrapper -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script type="text/javascript">
$('#updatemem').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
$('#memorial').plum('form.verify', { min: 2 });
$('#fname').plum('form.verify', { min: 2 });
$('#lname').plum('form.verify', { min: 1 });
$('#createby').plum('form.verify', { min: 3 });
$('#comments').plum('form.verify', { min: 10 });

// date of death mm/dd/yyyy
$('#dod').plum('form.verify', function () { return /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/.test(this.value) && /[0-9]/.test(this.value);
});

// date of birth mm/dd/yyyy
//$('#bdate').plum('form.verify', function () { 
//if($(this).val() === ""){
//return false;
//} else {
//return /^(0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])[- /.](19|20)\d\d$/.test(this.value) && /[0-9]/.test(this.value);
//}
//});

$('#delmem').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
function click_delete(){
	if (confirm("Are you sure?")) {
	// delete code
	window.location.href = "deletememorial.php?delyes=1&memid=<?php echo $mem_id; ?>";}
	return false;
}
	
	

</script>

</body>
</html>
