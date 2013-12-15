<h3>Account Information</h3>

<?php 

// Perform Video Check: X of X videos & each count

// pocontact
// Points_of_Contact - what was this for?

$pocontact1 = mysql_query( "SELECT count(*) FROM pocontact WHERE userid='$userid'" );
	$used_info2 = mysql_result($pocontact1, 0);
	
$goodbye1 = mysql_query( "SELECT count(*) FROM gb_messages WHERE userid='$userid' AND type='1'" );
	$used_info3 = mysql_result($goodbye1, 0);
	
$usps1 = mysql_query( "SELECT count(*) FROM gb_messages WHERE userid='$userid' AND type='2'" );
	$used_info4 = mysql_result($usps1, 0);

$vidcheck1 = mysql_query( "SELECT count(*) FROM mem_vid_upload WHERE userid='$userid'" );
	$used_info5 = mysql_result($vidcheck1, 0);
	
$memorial1 = mysql_query( "SELECT count(*) FROM memorials WHERE userid='$userid'" );
	$used_info6 = mysql_result($memorial1, 0);

// Check account info
$infocheck2 = mysql_query("SELECT * FROM users WHERE userid='$userid' LIMIT 1");
$row = mysql_fetch_assoc($infocheck2);
$info1 = $_SESSION['plan_name']			= $row['plan_name'];
$info2 = $_SESSION['username']			= $row['username'];
$info3 = $_SESSION['goodbyes']			= $row['goodbyes'];
$info4 = $_SESSION['usps_mailings']		= $row['usps_mailings'];
$info5 = $_SESSION['videos']			= $row['videos'];
$info6 = $_SESSION['memorials']			= $row['memorials'];

/*
Email Messages:			2 of 10
Postal Mail Messages:	1 of 10
Video Uploads:			1 of 5
Memorials:				4 of 3

plan_name	goodbyes	usps_mailings	videos	memorials
*/

// Display infinity symbol for 99
if ($info3 >= 99){$info3 = "<span style=\"font-size: 175%\">&#8734;</span>";}

?>


<table border="0" cellpadding="2" width="250">
	<tr>
		<td align="right">&nbsp;</td>
		<td align="center">Used:</td>
	</tr>
	<tr>
		<td align="right">Emailed Goodbyes:</td>
		<td align="center"><?php echo $used_info3 . " of " . $info3; ?></td>
	</tr>
	<tr>
		<td align="right">Mailed Goodbyes: </td>
		<td align="center"><?php echo $used_info4 . " of " . $info4; ?></td>
	</tr>
	<tr>
		<td align="right">Video Goodbyes:</td>
		<td align="center"><?php echo $used_info5 . " of " . $info5; ?></td>
	</tr>
	<tr>
		<td align="right">Memorials:</td>
		<td align="center"><?php echo $used_info6 . " of " . $info6 ; ?></td>
	</tr>
</table>