<?php 
// Connects to Our Database

mysql_connect("localhost", "egoodbye_dude", ")TOZUEgo5C3q") or die(mysql_error());
	
//mysql_pconnect("localhost", "egoodbye_dude", ")TOZUEgo5C3q") or die(mysql_error());

mysql_select_db("egoodbye_membership") or die(mysql_error());

// use mysql_pconnect for persistent connections

// Define full path to site url (with no trailing slash)

if (!empty($_SERVER['HTTPS'])){
	//$secure_connection = true;
	$site_url = "https://";
	} else {
	$site_url = "http://";
	}
	
	$site_url = $site_url . $_SERVER["HTTP_HOST"];

session_set_cookie_params(0, '/', NULL, TRUE, TRUE);	
ini_set('session.cookie_domain', $_SERVER["SERVER_NAME"]);


?>