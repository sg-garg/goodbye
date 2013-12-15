<?php
session_start();
$_SESSION['ver'] = 1;
include("db.php");

if(isset($_SESSION['userid'])){
$user = $_SESSION['userid'];
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");		
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<html xmlns:fb="http://ogp.me/ns/fb#">
<head>
<meta charset="utf-8">
<title>Membership Processing</title>
<?php require("include/head.html") ?>

</head>

<body>

<div id="fb-root"></div>
<script>
  window.fbAsyncInit = function() {
    // init the FB JS SDK
    FB.init({
      appId      : '489619547756822', // App ID from the App Dashboard
      channelUrl : '//www.egoodbyes.com/facebook_channel.php', // Channel File for x-domain communication
      status     : true, // check the login status upon init?
      cookie     : true, // set sessions cookies to allow your server to access the session?
      xfbml      : true  // parse XFBML tags on this page?
    });

    // Additional initialization code such as adding Event Listeners goes here

  };

  // Load the SDK's source Asynchronously
  // Note that the debug version is being actively developed and might 
  // contain some type checks that are overly strict. 
  // Please report such bugs using the bugs tool.
  (function(d, debug){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
     ref.parentNode.insertBefore(js, ref);
   }(document, /*debug*/ false));
</script>

<!-- facebook like check -->

	<div id="minMax">
		<div id="header">

<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php include("include/nav-main.php"); ?>

</div> <!-- end of center -->

<div class="content"><br></div>

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
<h1>Like us on Facebook, Follow us on Twitter</h1>
<h2><i>Get $1 discount!</i></h2>
<h2>We just need to get your permission to access your facebook status - it will only take a second or two, and a few mouse-clicks!</h2>

<table width="100%" border="0" cellspacing="3">
<!--1-->
<tr>
		<td width="400">1) Grant Facebook Permissions (you'll be asked to log in, if not already)<br><br><br><br></td>
		<td><fb:login-button scope="user_likes">Grant Facebook Permissions</fb:login-button></td>
</tr>
<!--2-->
<tr>
		<td>2) Like the eGoodbyes facebook page <i>(easy!)</i>:<br><br><br><br></td>
		<td>
		<fb:like href="https://www.facebook.com/Egoodbyes" send="false" width="200" show_faces="false"></fb:like>
		</td>
</tr>
<!--3-->
<tr>
		<td>3) Check status <i>(just to make sure it registered)</i>:<br><br><br><br></td>
		<td><img src="fb/check-fb-status.gif" alt="check status" border="0" onclick="checkDoesLike()"></td>
</tr>

<!--4-->
<tr>
		<td>4) Proceed to signup page, and discount will display on invoice.<br><br></td>
		<td><h1 id="fb-like">Like Status</h1></td>
</tr>
</table>

<?php
require('fb/facebook.php');
$facebook = new Facebook(array(
    'appId'  => '489619547756822',
    'secret' => '1220e1f1ed63a9646ed56e71ed94a2b3',
    'cookie' => true,
));
$result = $facebook->api(array(
    'method' => 'fql.query',
    'query' => 'select fan_count from page where page_id = 354902157932773;'
));
//$access_token = $facebook->getAccessToken();
?>


<script>
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/; domain=www.egoodbyes.com";
}

window.checkDoesLike = function() {
  FB.api({ method: 'pages.isFan', page_id: '354902157932773' }, function(resp) {
    if (resp) {
document.getElementById('fb-like').innerHTML = '<!-- FB Like --><h1>You Like the eGoodbyes Facebook Page</h1><!-- end FB Like-->';
createCookie('fblike','true','10');
    } else {
document.getElementById('fb-like').innerHTML = '<!-- FB Like --><h1>You <b>Do Not</b> Like the eGoodbyes Facebook Page</h1><!-- end FB Like-->';
createCookie('fblike','false','10');
    }
  });
};

</script>

<!--
<div align="center">
<p><a href="subscriptions.php"><img src="img/egoodbyes_proceed.gif" alt="Proceed to Subscription" height="150" width="350" border="0"></a></p>-->

</div>

<p>&nbsp;</p>
<p>
<a href="https://twitter.com/egoodbyes" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="large">Follow @eGoodbyes</a>
</p>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
 <!-- Twitter follow check -->
<?php
	if ($_GET['fl'] == "991s4"){
	echo "<h3><a href=\"subscriptions.php\">Return to Previous Page</a></h3>";
	}
?>

<h3><a href="subscriptions.php">Subscription Page</a></h3>

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

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
</body>
</html>
