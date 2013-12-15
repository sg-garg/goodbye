<?php
require_once("authhead.php");
require_once("pdoconnect.inc.php");

include("include/check_max.php");
check_max("4");

$sql = "SELECT * FROM victims WHERE vic_id = '$_GET[vic_id]'";
$q = $conn->prepare($sql);
$q->execute();
$row = $q->fetch();
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
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
<!--<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css">-->

<!--<script src="js/jquery-ui.js"></script>-->
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

<script>
 $(function() {

$( ".datepicker" ).datepicker({
//yearRange: "1970:2012",
changeMonth: true,
changeYear: true
});
});

</script>
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

<div align="center">
<h2>Create a Memorial</h2>

<form id="createmem" action="upload-memorial-images.php"
 method="post" enctype="multipart/form-data">
 <input name="status"  type="hidden" value = "2" />
 <input name="vic_id"  type="hidden" value = "<?php if(!empty($row['vic_id'])) echo $row['vic_id']; ?>" />
 <br>

<table width="780" border="0" cellpadding="5">
<tr><td align="right"><label>Name of Memorial:</label></td>
<td><input id="memorial" name="memorial"  type="text" required /></td></tr>

<tr><td align="right"><label>Surname:</label></td>
<td><input id="sname" name="sname" type="text"   /></td></tr>

<tr><td align="right"><label>First Name:</label></td>
<td><input id="fname" name="fname" type="text" value="<?php if(!empty($row['fname'])) echo $row['fname']; ?>" required /></td></tr>

<tr><td align="right"><label>Middle Initial:</label></td>
<td><input id="mi" name="mi"  type="text" value="<?php if(!empty($row['mi'])) echo $row['mi']; ?>"  /></td></tr>

<tr><td align="right"><label>Last Name:</label></td>
<td><input id="lname" name="lname" type="text" value="<?php if(!empty($row['lname'])) echo $row['lname']; ?>" required  /></td></tr>

<tr><td align="right"><label>'Nick' Name:</label></td>
<td><input id="nname" name="nname" type="text"  /></td></tr>

<tr><td align="right"><label>Upload Main Image:</label></td>
<td><input id="memimage" name="memimage" type="file"  /></td></tr>

<tr><td align="right"><label>Birthdate:</label></td>
<td><label>mm/dd/yyyy<input id="bdate" name="bdate" type="text" /></label></td></tr>

<tr><td align="right"><label>Pass Date:</label></td>
<td><label>mm/dd/yyyy<input id="dod" name="dod" type="text" class="datepicker" value="<?php if(!empty($row['dod'])) echo $row['dod']; ?>" /></label></td></tr>

<tr><td align="right"><label>Created by:</label></td>

<td><input id="createby" name="createby" type="text" /></td></tr>

<tr><td align="right"><label>Words about the deceased:</label></td>
<td><textarea id="comments" name="comments" cols="80" rows="20" ></textarea></td></tr>

<tr><td align="right"><label>Information about Services:</label></td>
<td><textarea id="service" name="service" cols="80" rows="20" ></textarea></td></tr>

</table>
<input id="cmemorial" name="submit" type="submit" value="Submit" />
</form>

<br />
</div> <!-- end of centered content -->

</div><!-- end #wrapper -->
<?php echo $vic_id;?>

</div><!-- end #content -->

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->
		
</div> <!-- end wrapperA -->

<script>
$('#createmem').plum('form', {
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

</script>


</body>
</html>
