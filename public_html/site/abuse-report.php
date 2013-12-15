<?php 
require_once("authhead.php");
require_once('pdoconnect.inc.php');
$mem_id =$_GET['mem_id']; 
$comments =$_GET['comments']; 

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
	min-height:650px;
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
		</div> <!-- end header -->

<div id="wrapper">	
<div id="main">

<?php 

if(isset($_GET['abuse'])){
$header = "From: gpaul@paulgdesigns.com\n"
  . "Reply-To: gpaul@paulgdesigns.com\n";
$to="michaelsaggio@hotmail.com";
$subject = "This is a report of abuse!";
$from = "gpaul@paulgdesigns.com";
$msg = "Yo yo yo, sum mufucka put sum shit yo, up in yo grill, like, it be buggin yo\n"
."So like U shud check dis mofo out yo, like its memorial number an shit is\n"

."$mem_id\n" 
."an like dis is wat dis nigga said yo\n"
."$comments\n\n"
."fer reel";
mail($to, $subject, $msg, $header);

}?>

<h1>Your message has been sent, one of our monitors will look at the comment and take the appropriate action.</h1>
<h2>Thank you for being part of eGoodbyes!</h2>


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
