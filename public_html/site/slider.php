<?php
require_once("authhead.php");
require_once('pdoconnect.inc.php');
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<!--<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>-->
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
	}
.slides_container {
                width:570px;
                height:270px;
				margin:0 auto;
				line-height:inherit;
            }
.slides_container div {
                width:570px;
                height:270px;
                display:block;
				margin:0 auto;
				line-height:inherit;
            }
</style>
<script src="http://code.jquery.com/jquery-latest.min.js"></script>
<script>"js/slides.min.jquery.js"</script>
<script src="js/slides.jquery.js"></script>

<script>
			$(function(){
      $("#slides").slides({
        paginationClass: 'pagination'
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
<div class="content">
<div id="main">
<br />
<?php 
$sqlsl = "SELECT *  FROM memorials WHERE userid = '48' ";
$qsl = $conn->prepare($sqlsl);
$qsl->execute();
$countsl = $qsl ->rowCount();

echo '<div id="slides">';
echo           ' <div class="slides_container">';
while($row = $q->fetch())
{

 echo               '<div>';
 echo '<img src="imagesmemorial/' .$row['memimage']. ' ">';
  echo              '</div>';
     }           
  echo              '</div>';
  echo              '</div>';

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
