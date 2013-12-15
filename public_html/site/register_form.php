<?php
session_start();
$_SESSION['ver'] = 1;
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
</div> <!-- end of center -->

<div class="content"><br></div>

</div> <!-- end header -->
<div id="wrapper">
					
<div id="egcolsc">
<div class="content">

<h3>Register Form</h3>

<p>Fill in the form below to register with eGoodbyes.com.</p>
<p>If you already have an account, <a href="login.php">login</a> here.</p>

<?

include 'include/join_form.html'; // Show the form

?>


<p><fb:like href="https://www.facebook.com/Egoodbyes" send="true" width="450" show_faces="false"></fb:like></p>

<!-- special code -->
<p>
<fb:login-button scope="user_likes">
  Grant Permissions to Allow access to Likes
</fb:login-button>
</p>

<p>
<a href="https://twitter.com/egoodbyes" class="twitter-follow-button" data-show-count="false" data-lang="en" data-size="large">Follow @eGoodbyes</a>
</p>

    <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
 <!-- Twitter follow check -->

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
