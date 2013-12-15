<?php 
require_once("pdoconnect.inc.php");
include("db.php");
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>untitled</title>  
  <script type="text/javascript" src="js/jquery-1.7.1min.js"></script>
    <script type="text/javascript" src="js/jquery.nivo.slider.js"></script>
    <link rel="stylesheet" href="css/bar.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
<style>
.imgshadow	{
	box-shadow: 0px 8px 6px #111;
	padding:8px;
	margin:5px;
	}
    </style>
</head>  
<body>
<?php
$sqlci = "SELECT * FROM uimages WHERE  mem_id = '1360196062' AND image IS NOT NULL AND image <> 'TV-ICON-SCREEN-VIDEO.png'    " ;
$qci = $conn->prepare($sqlci);
$qci->execute();

echo '<div id="wrapper">'; //begin nivo
echo '<div class="slider-wrapper theme-bar">';
 echo ' <div id="slider" class="nivoSlider">';

  
while($rowci = $qci->fetch())//remove extra ) when no loop
{
 echo ' <img src="'.$site_url.'/site/imagesmemorial/'.$rowci['image'].'" class="imgshadow"  />';
		}
            echo ' </div>    ';
      echo ' </div>    ';
    echo ' </div>'; //eo nivo divs
?>	
        
        			 
    <script>
    $(document).ready(function() {
        $('#slider').nivoSlider();
    });
    </script>
</body>
</html>