<?php
require_once("pdoconnect.inc.php");
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>untitled</title>  
<script src="js/jquery.nivo.gallery.js"></script>
<script src="js/jquery.nivo.gallery.min.js"></script>
<link rel="stylesheet" href="css/nivo-gallery.css">
<link rel="stylesheet" href="css/ng_all.css">
<style>
.imgshadow	{
	box-shadow: 0px 0px 28px #111;
	padding:2px;}
</style>
 <script src="js/modernizr-1.7.min.js"></script>
</head>
<body>

    <div id="wrapper">

        <div id="gallery" class="nivoGallery">
            <ul>
<?php             $sql = "SELECT memimage, comments FROM memorials WHERE memimage IS NOT NULL and userid ='48' ";
$q = $conn->prepare($sql);
$q->execute();

while($row = $q->fetch())//remove extra ) when no loop
{
?>


                <li data-title="<?php echo $row['comments'];?>"><?php echo ' <img src="imagesmemorial/'.$row['memimage'].'" alt="" class="imgshadow" />';?></li>
                            <!-- <li data-title="Lorem ipsum 4" data-caption="dolor sit amet, consectetur adipiscing elit"><img src="images/4.jpg" alt="" /></li>-->
                <?php }?>
               <!-- <li data-type="html" data-title="Lorem ipsum 5" data-caption="dolor sit amet, consectetur adipiscing elit">
                    <h1>Heading</h1>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                    <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                </li>
                <li data-type="video" data-title="Vimeo Video">
                    <iframe src="http://player.vimeo.com/video/29950141?portrait=0&amp;color=ffffff" width="670" height="377" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
                </li>
                <li data-type="video" data-title="YouTube Video">
                    <iframe width="560" height="315" src="http://www.youtube.com/embed/72hTSFkYVAo?wmode=opaque" frameborder="0" allowfullscreen></iframe>
                </li>
                <li data-type="video" data-title="HTML5 Video">
                    <video width="700" height="390" controls="control" preload="none"> 
                        <source src="http://mediaelementjs.com/media/echo-hereweare.mp4" type="video/mp4" /> 
                        <source src="http://mediaelementjs.com/media/echo-hereweare.webm" type="video/webm" /> 
                        <source src="http://mediaelementjs.com/media/echo-hereweare.ogv" type="video/ogg" /> 
                    </video>
                </li>-->
            </ul>
        </div>
        
    </div>
    
   <script src="js/jquery.js"></script>
    <script src="js/jquery.nivo.gallery.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#gallery').nivoGallery();
    });
    </script>

</body>
</html>
