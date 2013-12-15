<?php
include("cdub_config.php");

//$cdub_date = date("m-d-Y");              // Today's Date
date_default_timezone_set('America/New_York');
$cdub_date = date("F j, Y, g:i a");

$cdub_ip = $_SERVER['REMOTE_ADDR'];          // The visitors IP Address
$cdub_ref = "";
if(isset($_SERVER['HTTP_REFERER'])) {
    $cdub_ref = $_SERVER['HTTP_REFERER'];        // Where the visitor came from, if any
}
$cdub_browse = $_SERVER['HTTP_USER_AGENT'];  // What browser the visitor is using
$cdub_page = $_SERVER['PHP_SELF'];       // The main url of the page the visitor is looking at
$cdub_query = getenv("QUERY_STRING");             // The Query if any that is part of the main URL

// SELECT AN IP FROM THE VIPS TABLE IN THE DATABASE
$cdub_Result=mysql_query("Select vip FROM cdub_vips WHERE vip ='$cdub_ip'"); 
			    $cdub_countResult = mysql_num_rows($cdub_Result);
// IF THERE IS NO IP IN THE VIPS TABLE THEN ENTER THE FOLLOWING INFORMATION				
if($cdub_countResult == 0) {

// INSERT THE IP INTO THE VIPS TABLE IN THE DATABASE
$cdub_insertvip = mysql_query("INSERT INTO cdub_vips SET
						  vip = '$cdub_ip'");
}
// UPDATE THE VISITORS TABLE IF THE IP IS NOT IN IT
$Result=mysql_query("Select ip FROM cdub_visitors WHERE ip ='$cdub_ip'"); 
			    $cdub_countResult9 = mysql_num_rows($Result);
				
if($cdub_countResult9 <= 0) {
$cdub_insertinfo = mysql_query("INSERT INTO cdub_visitors SET
							ip = '$cdub_ip',
							ref = '$cdub_ref',
							browse = '$cdub_browse',
							hits = '1',
							fvisit = '$cdub_date'");
}
// GET THE TOTAL AMOUNT OF PAGE VIEWS FROM THE DATABASE
$cdub_gettotalp = mysql_query("SELECT views FROM cdub_logs_views");
while ($row = mysql_fetch_array($cdub_gettotalp)) {
$cdub_totalp = $row["views"];
// ADD 1 TO THE TOTAL AMOUNT OF PAGEVIEWS
$cdub_totalp = $cdub_totalp + 1;
// UPDATE THE PAGE VIEWS TABLE IN DATABASE
$cdub_updateviews = mysql_query("UPDATE cdub_logs_views SET
							views = '$cdub_totalp'
							WHERE id = '1'");
	}
// IF THE IP IS IN THE VISITORS SET UPDATE THE VISITORS HIT FIELD
if($cdub_countResult9 == 1) {
$cdub_gethits = mysql_query("SELECT hits FROM cdub_visitors WHERE ip ='$cdub_ip'");
while ($row = mysql_fetch_array($cdub_gethits)) {
$cdub_hits = $row["hits"];
// ADD 1 TO THE VISITORS HITS
$cdub_hitsU = $cdub_hits+1;
// UPDATE THE VISITORS FIELD IN THE DATABASE
$cdub_updatehits = mysql_query("UPDATE cdub_visitors SET
							hits = '$cdub_hitsU',
							lvisit = '$cdub_date'
							WHERE ip = '$cdub_ip'");
}
}
// CHECK TO SEE IF THE IP HAS ANY PAGE VIEWS IN THE DATABASE
$cdub_Result=mysql_query("Select ip FROM cdub_pagviews WHERE ip ='$cdub_ip'"); 
$cdub_countnic = mysql_num_rows($cdub_Result);
// IF THE IP IS IN THE DATABASE CHECK TO SEE IF IT HAS A NICK NAME ASSIGNED IF NOT... LEAVE NICK NAME BLANK
if($cdub_countnic >= 1) {
$cdub_getnic = mysql_query("SELECT * FROM cdub_pagviews WHERE ip = '$cdub_ip' LIMIT 0, 1");
while ($row = mysql_fetch_array($cdub_getnic)) {
$cdub_nic = $row["nic"];
// INSERT THE PAGE VIEW INTO THE PAGE VIEWS TABLE WITH THE NICNAME
$cdub_insertviews = mysql_query("INSERT INTO cdub_pagviews SET
							ip = '$cdub_ip', 
							page = '$cdub_page?$cdub_query',
							date = '$cdub_date',
							nic = '$cdub_nic'");
} 
// IF THE IP ISN'T IN THE PAGEVIEWS TABLE. ENTER A PAGEVIEW WITH NO NICKNAME
} else if($cdub_countnic <= 0) {
$cdub_insertviews = mysql_query("INSERT INTO cdub_pagviews SET
							ip = '$cdub_ip',
							page = '$cdub_page?$cdub_query',
							date = '$cdub_date'");
}

?>