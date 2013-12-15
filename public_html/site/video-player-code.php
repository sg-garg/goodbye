<?php
session_start();
$_SESSION['ver'] = 1;
include("db.php");
if(isset($_SESSION['userid'])){
$user = $_SESSION['userid'];
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

$vid = $_GET['vid'];
$vidd = urlencode($vid);
//$rtmp_server = "rtmp://www.egoodbyes.com/dir/";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Video Player</title>
<?php require("include/head.html") ?>
<script src="jwplayer/jwplayer.js"></script>
<script>jwplayer.key="X9gcnJD+G11hBlaVdPEqyWyzMuKxJF7L6Dh9kQ=="</script>
</head>

<body>
	<div id="minMax">
		<div id="header">

		<div align="center">
		<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
		<?php include("include/nav-main.php"); ?>
		</div>
		 <!-- end of center -->

		<div class="content">&nbsp;</div>

		</div> <!-- end header -->

		<div id="wrapper">
		
<div id="egcol2">
<div class="content">

<?php require("include/side_menu.php"); ?>

<hr>

</div> <!-- end content -->
</div> <!-- end outer3 -->

<div id="egcol1">
<div class="content">

<script type="text/javascript"
src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js">
</script>

<script type="text/javascript">
var flashvars = { file: "<?php echo urlencode($vid); ?>.flv", streamer: "<?php echo $rtmp_server; ?>", autostart: "true", type: "rtmp", image: "<?php echo  dirname($_SERVER['PHP_SELF']) . "/" . (file_exists("snapshots/$vid.jpg")?"snapshots/$vid.jpg":"snapshots/no_video.png"); ?>" };
  
  swfobject.embedSWF('jwplayer/jwplayer.flash.swf','container1','480','360','9','false', flashvars,   {allowfullscreen:'true',allowscriptaccess:'always'},   {id:'jwplayer',name:'jwplayer'}  );
</script>

<?php
// quick file check
$fullpath = '/usr/local/red5/webapps/oflaDemo/streams/'. $vidd .'.flv';

//$fullpath = 'https://www.egoodbyes.com/dir/'. $vidd .'.flv';
if (!file_exists($fullpath)) {
    header("Location: video-player-code-s.php?vid=".$vidd);
} 
?>


<h3>Video Playback Page</h3>

<div id='my-video'></div>
<script type='text/javascript'>
    jwplayer('my-video').setup({
        file: 'https://www.egoodbyes.com/dir/<?php echo $vidd; ?>.flv',
        width: '360',
        height: '270',
        image: 'img/eg-vid-screen.jpg'
    });
</script>

<h2><a href="../rec/">Record Videos</a>&nbsp;&#8226;&nbsp;<a href="dashboard.php">Dashboard</a></h2>
<?php require("development.php"); ?>
</div> <!-- end content -->
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
