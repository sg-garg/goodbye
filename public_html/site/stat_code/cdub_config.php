<?php
// ###################################
// #   Config file for cdubz logs    #
// ###################################

// NOTE : IF YOU SET $cdub_globals TO no THE SCRIPT MAY NOT WORK, ONLY SET THIS TO no if you have global variables turned on
// in your server settings, if you are unsure leave this as 'yes'
$cdub_globals = 'no'; // ENTER HERE IF YOU WANT GLOBAL VARIABLES REGISTERED. IF YOU DO NOT WANT THEM ENTER no INSTEAD OF yes.


// SET ALL VARIABLES TO GLOBAL DO NOT EDIT
$cdub_globals = strtolower($cdub_globals);
if($cdub_globals = 'yes') {
while (list($key, $val) = @each($HTTP_GET_VARS)) {
$GLOBALS[$key] = $val;
}
while (list($key, $val) = @each($HTTP_POST_VARS)) {
$GLOBALS[$key] = $val;
}
while (list($key, $val) = @each($HTTP_SESSION_VARS)) {
$GLOBALS[$key] = $val;
}
}
// DO NOT EDIT ANYTHING ABOVE THIS EVER!


$cdub_db_host = 'localhost';     // ENTER YOUR DATABASE HOST HERE, NORMALLY 'localhost'
$cdub_db_login = 'egoodbye_info';    // ENTER YOUR DATABASE LOGIN NAME HERE.
$cdub_db_pass = 'wsSx,QZf7Tod';      // ENTER YOUR DATABASE PASSWORD HERE.
$cdub_db_name = 'egoodbye_stats'; // ENTER THE NAME OF YOUR DATABASE HERE


// DO NOT EDIT THE FOLLOWING 2 LINES
$cdub_db_connect = @mysql_connect($cdub_db_host, $cdub_db_login, $cdub_db_pass) or die("Couldn't Connect to database!"); // DO NOT EDIT
$cdub_db_select = @mysql_select_db($cdub_db_name, $cdub_db_connect) or die("Couldn't select database!"); // DO NOT EDIT
// DO NOT EDIT THE ABOVE 2 LINES


//$cdub_site = 'https://www.egoodbyes.com/site/stat_code'; // ENTER YOUR SITES URL HERE
$cdub_site = $site_url . '/site/stat_code'; // ENTER YOUR SITES URL HERE




// FUNCTIONS NEEDED
// ##############################################
// #   cdubz logs functions were created by :   #
// #             Mark-Shamus McCahey            #
// #           mark-shamus@mccahey.com          #
// ##############################################
// DO NOT EDIT ANYTHING BELOW EVER!
?>
<?php
function cdub_error($msg) {
?>
<html>
<head>
<script language="JavaScript">
	alert("<?php $msg; ?>");
	history.back(1);
</script>
</head>
<body>
</body>
</html>
<?php
exit;
}
function cdub_newwindow($link) {
?>
<script language=javascript>
	window.navigate("<?php $link; ?>");
</script>
<?php
}
function cdub_alert($msg) { ?>
	<script language="JavaScript">
	alert("<?php $msg; ?>");
	</script>
<?php }
function cdub_alertgo($msg, $navto) { ?>
<script language="JavaScript">
	alert("<?php $msg; ?>");
	window.navigate("<?php $navto; ?>");
</script>
<?php
}
?>