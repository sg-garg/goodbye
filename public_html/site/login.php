<?php
session_start();
include ("db.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<META NAME="Keywords" CONTENT="online memorial death memory video photographs loved ones grief sorrow saddness pain therapy depression bereaved dying funeral children spouse teenagers infants husbands wives anniversaries love birthdays">
<META NAME="Description" CONTENT="Say goodbye to a loved one with an online video memorial with photos. Celebrate life - record, upload and save your memories prior to death.">
<title>Memorial pages of loved ones at eGoodbyes.  Send a video goodbye in a way that lives on.</title>

<?php require("include/head.html") ?>

<style type="text/css">
    .WelcomeText
    {
        padding-bottom: 12px;      
        font-size: larger;font-family: Tahoma, Geneva, sans-serif;
    }
    
    .ThankyouText
    {
        padding-bottom: 12px;
        text-align: center;                
    }
    
    .Important > div
    {        
        width: 200px;
        padding: 2px;
        color: White;
        
        box-shadow: 10px 10px 5px #888888;
        text-shadow: 2px 2px 2px #000;
        -moz-border-radius: 15px;
        border-radius: 15px;
    }       
        
    .Important > div > a
    {        
        overflow: hidden;
        display: block;
        text-decoration: none;
        border: solid 2px White;
        color: White;
        line-height: 22px;
        height: 45px;
        padding: 0 10px;
        text-align: center;
        font-size: larger;
        font-weight: bold;        
        
        -moz-border-radius: 17px;
        border-radius: 17px;
    }
    
    .Important3 > div
    {
        background: #f1e767; /* Old browsers */
        background: -moz-linear-gradient(top, #f1e767 0%, #feb645 100%); /* FF3.6+ */
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#f1e767), color-stop(100%,#feb645)); /* Chrome,Safari4+ */
        background: -webkit-linear-gradient(top, #f1e767 0%,#feb645 100%); /* Chrome10+,Safari5.1+ */
        background: -o-linear-gradient(top, #f1e767 0%,#feb645 100%); /* Opera 11.10+ */
        background: -ms-linear-gradient(top, #f1e767 0%,#feb645 100%); /* IE10+ */
        background: linear-gradient(to bottom, #f1e767 0%,#feb645 100%); /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1e767', endColorstr='#feb645',GradientType=0 ); /* IE6-9 */
    }
    
    .Important1  > div
    {
        background: rgb(206,220,231); /* Old browsers */
background: -moz-linear-gradient(top, rgba(206,220,231,1) 0%, rgba(89,106,114,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(206,220,231,1)), color-stop(100%,rgba(89,106,114,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(206,220,231,1) 0%,rgba(89,106,114,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cedce7', endColorstr='#596a72',GradientType=0 ); /* IE6-9 */
    }
    
    .Important2 > div
    {
        
        
        background: rgb(44,83,158); /* Old browsers */
background: -moz-linear-gradient(top, rgba(44,83,158,1) 0%, rgba(44,83,158,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(44,83,158,1)), color-stop(100%,rgba(44,83,158,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, rgba(44,83,158,1) 0%,rgba(44,83,158,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, rgba(44,83,158,1) 0%,rgba(44,83,158,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, rgba(44,83,158,1) 0%,rgba(44,83,158,1) 100%); /* IE10+ */
background: linear-gradient(to bottom, rgba(44,83,158,1) 0%,rgba(44,83,158,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2c539e', endColorstr='#2c539e',GradientType=0 ); /* IE6-9 */
    }
    
   
</style>

</head>

<body>

	<div id="minMax">
		<div id="header">
			<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0">
			</div> <!-- end of center -->
			<div class="content"></div>
		</div> <!-- end header -->

<div id="wrapper">
<div id="topbar"></div>
			
<div id="egcolsc">
<div class="content">

<div align="center">
<h1>Welcome to eGoodbyes</h1>


<table width="80%" border="0">

    <tr>
        <td colspan="3" class="Themed WelcomeText">
            We live in a world where war, tragedies and horrific events occur and lives are taken away well before their time. Here at eGoodbyes, securely create and store your final goodbye messages, create a virtual memorial for yourself or someone else to be remembered forever. Register for free today to receive one goodbye message and one memorial page to make sure you have the chance to say goodbye.             
        </td>
    </tr>
    <tr>
        <td colspan="3" class="Themed ThankyouText">            
            <h2>Thank you for visiting eGoodbyes.</h2>
        </td>
    </tr>
    <tr>
        <td class="Important Important1">
            <div><a href="#" class="tooltipped" data-tipid="videogoodbyetip">
                COMPOSE A DOCUMENT OR VIDEO GOODBYE
            </a></div>            
        </td>        
        <td class="Important Important3">
            <div><a href="#" class="tooltipped" data-tipid="memorialtip2">
                CREATE A MEMORIAL FOR A LOVED ONE
            </a></div>            
        </td>
        <td class="Important Important2">
            <div><a href="#" class="tooltipped" data-tipid="memorialtip">
                CREATE A MEMORIAL FOR YOURSELF
            </a></div>            
        </td>
    </tr>   
<tr>
    <td colspan="3"><table widt="100%"><tr>
<td width="33%" valign="top" align="left">
<h3>Register for Free</h3>
<a name="register"></a>
<?php include("include/join_form.html"); ?>




<!-- special code -->
<!--<p>
<fb:login-button scope="user_likes">
  Grant Permissions to Allow access to Likes
</fb:login-button>
</p>-->




</td>
<td width="50%" valign="top" align="left" style="padding-left:10%;">

<?php include 'include/login_form.html'; ?>

<p><a href="lost_password.php">Forgot password?</a></p>
<br>
<a href="current-events-list.php"><img src="img/to-memorial-page.jpg" alt="Visit Memorial Section" height="230" width="315" border="0"></a>
</td>
                
            </tr></table></td>
</tr>
</table>

 
 </div><!--end center-->

<?php include("development.php"); ?>

 <div id="footersocial">
    <fb:like href="https://www.facebook.com/Egoodbyes" send="true" width="50%" show_faces="false"></fb:like>
    
    <a href="https://twitter.com/egoodbyes" class="twitter-follow-button" 
       data-show-count="false" data-lang="en" data-size="large">Follow @eGoodbyes</a>    
</div>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
 
 <!-- Twitter follow check -->
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

<div class="tooltip2" id="videogoodbyetip">
                Get unlimited emailed goodbye messages, five mailed goodbyes and five video goodbyes (10 minutes or 40mb per video) with our Premium Membership for only $24.99. While you&rsquo;re alive, you can edit, redo or delete your goodbyes. Register at eGoodbyes for free to get started.
            </div>
            <div class="tooltip2" id="memorialtip">
                Memorialize yourself with text and photos. While you&rsquo;re alive, you can update or edit your memorial. Your memorial page is always private and when you pass, it will become public, allowing everyone to see how you want to be remembered. Coming soon &ndash; Your Memorial Video Timeline.
            </div>
            <div class="tooltip2" id="memorialtip2">
                Memorialize a loved that has passed with text and photos. Share the memorial you created on your Facebook and/or Twitter so all your friends can help you mourn and remember the one you lost. Get two memorial pages with our Premium Membership, only at eGoodbyes.
            </div>

<script type="text/javascript">

function changeTooltipPosition (event) {
    var tooltipX = event.pageX - 8;
    var tooltipY = event.pageY + 8;
    $('div.tooltip2').css({top: tooltipY, left: tooltipX});
}
function showTooltip(event) {
    var $tgt = $(event.target),
        tooltip = $tgt.attr('data-tipid');
    // Hide other tooltips
    hideTooltip();
    $('#' + tooltip).show(400);        
    changeTooltipPosition(event);
}
function hideTooltip () {
    $('div.tooltip2').stop(true).hide(400);
}

$('.tooltipped').each(function(){    
    var tooltipped = $(this);
    tooltipped.bind( { 
        mousemove: changeTooltipPosition, 
        mouseenter: showTooltip,
        mouseleave: hideTooltip,
        click: function(event) { event.preventDefault(); }
    })
})	

</script>

</body>
</html>
