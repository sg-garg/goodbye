<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_SESSION['userid'];
$mem_id = $_GET['mem_id'];
$sql = "SELECT * FROM memorials WHERE mem_id = '$_GET[mem_id]
' AND userid = '$userid' LIMIT 1 ";
$q = $conn->prepare($sql);
$q->execute();
$row = $q -> fetch();
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="This is the memorial page of <?php echo  $row['fname'] .' '. $row['mi'] .' ' .$row['lname']. ', ' . $row['bdate'] . ' - ' . $row['dod'] ;  ?>" />
<title><?php echo $row['title'] .' '. $row['fname'] .' '. $row['mi'] .' ' .$row['lname']; ?></title>  
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
#wrap	{
	width:800px;
	margin:0px auto;
	}
.center	{
	text-align:center;
	}
.fltright	{
	float:right;}
.imgshadow	{
	box-shadow: 0px 8px 6px #111;
	padding:8px;
	margin:5px;}
.pad10	{
	padding:10px;}
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
</div>
<div id="wrapper">

<?php
echo "<div align=\"center\">";

echo '<img src="imagesmemorial/'.$row[memimage].'";  width="200px" alt="" class=imgshadow center />';

echo "</div><br><br>";

if(isset($row['nname'])) echo '<figcaption class=center>' .'"'.$row['nname'].'"' .'</figcaption>' ;?>


<h1 class="center"><?php echo $row['memorial'] .' <br /><br /> '  .$row['fname'] .' '. $row['mi'] .' ' .$row['lname'] ; ?></h1>

<h2 class="center"><?php if(isset($row['nname'])) echo '"'.$row['nname'].'"' ; ?></h2>
<article class="center"><?php echo  $row['bdate'] . ' - ' . $row['dod'] ;  ?></article>

<div id="wrap">


</span><!--eo header span-->
<article class="pad10"><?php echo nl2br($row['comments']); ?>

</article>
<h3><?php  if(!empty($row['service'])) echo 'Service Information'; ?></h3>
<article><?php  if(!empty($row['service'])) echo nl2br($row['service']); ?></article>

<h3><?php  if(!empty($row['createby'])) echo 'This Memorial has been Created by;'; ?></h3>
<article><?php  if(!empty($row['createby'])) echo nl2br($row['createby']); ?></article>

<br />





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
