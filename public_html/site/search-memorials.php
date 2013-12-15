<?php
session_start();
$ver = $_SESSION['ver'];
require_once("pdoconnect.inc.php");
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
if ($newlinecounter >= 1){ die('<h1>Page not Found</h1>');}


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
.important	{
	visibility: hidden;
	height:15px;
	width:2px;
	}
#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}
table		{
	text-align:left;}
.fltright	{
	float:right;}
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
<div id="main">
<br />
<h1 class="center">Search Active Memorials</h1>
<br />


<form id="searchform" method="post" action="">



<table><tr>
<td valign="top"><input type="text" name="sm"/><input type="text" name="address" class="important" style="display:none;" /></td>
<td valign="top"><input type="submit" name="sea" value="Search" /></td></tr></table>



</form>



<br />

<?php 
if(isset($_POST['sea']) && $_POST['sm'] !==''){
$sm = trim($_POST['sm']);
$sql = "SELECT * 
FROM   `memorials` 
WHERE  (
	 `memorial` LIKE '%$sm%' 
 		OR `fname` LIKE '$sm%' 
          OR `lname` LIKE '$sm%'      
		    OR `bdate` LIKE '$sm%' 
		  OR `dod` LIKE '$sm%' 
		   OR `comments` LIKE '%$sm%' ) 
       AND `status` = '2'     ";
$q = $conn->prepare($sql);
$q->execute();
echo '<table cellpadding=10 cellpadding=5>';
echo '<tr><th>Name of Memorial</th><th>Name</th></tr>';
while($row = $q->fetch())//remove extra ) when no loop
{

echo '<tr><td><a href="memorial.php?mem_id='.$row['mem_id'].'">'.$row['memorial'].'</a></td><td> '.$row['fname'].' '. $row['lname'].'</td></tr>';

}
echo '</table>';
}
?>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script type="text/javascript">

$('#searchform').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
</script>



</body>
</html>
