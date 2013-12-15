<?php
session_start();
$_SESSION['ver'] = 1;
include("../db.php");
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	

if($_SESSION['userid'] == '7'){
$user = $_SESSION['userid'];
setcookie("username",urlencode($username),time()+36000);		
	} else {
	/* Redirect browser */
	header("Location: " . $site_url . "/site/admin.php");
}


$access_id = $_GET['accessid'];
$search_id = $_GET['query'];
$search_field = $_GET['field'];

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>eGoodbyes Administration Page</title>
<script src="../js/jquery.js"></script>
<script src="../js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="img/all-style.css">
<!--[if lte IE 7]>
<link rel="stylesheet" href="../css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="../css/default.ie7.css">
<![endif]-->
<style>
body { padding: 0px; margin: 0px; background-image: url(img/grey-001c.jpg); font-size:76%; font-family:"trebuchet MS", verdana, arial, sans-serif;color: #353d6b;}
.content {color: #353d6b;}
</style>
</head>

<body>

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/grey-header-eGoodbyes.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>

</div> <!-- end of center -->
				
<div class="content"><br></div>
			
</div> <!-- end header -->


<div id="wrapper">

<div id="egcol2">
<div class="content">

<h2>Sidebar</h2>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</div> <!-- end content -->
</div> <!-- end outer3 -->
			
<div id="egcol1">
<div class="content">
<h3>Search Admin</h3>
		<p>&nbsp;</p>
		<div align="center">
			<table width="500" border="1" cellspacing="2">
			<tr><th align="right">Search by:</th><th>&nbsp;&nbsp;&nbsp;</th><th>&nbsp;&nbsp;&nbsp;</th></tr>
			
			<form id="search1" name="search1" action="eg-adminpage.php" method="get">
			<tr><td align="right">First Name:</td><td><input type="text" name="query" size="15"><input type="hidden" name="field" value="1"><input type="submit" value="SEARCH" name="go"></td><td align="left">&nbsp;</td></tr>
			</form>
			
			<form id="search2" name="search2" action="eg-adminpage.php" method="get">
			<tr><td align="right">Last Name:</td><td><input type="text" name="query" size="15"><input type="hidden" name="field" value="2"><input type="submit" value="SEARCH" name="go"></td><td align="left">&nbsp;</td></tr>
			</form>
			
			<form id="search3" name="search3" action="eg-adminpage.php" method="get">
			<tr><td align="right">Address:</td><td><input type="text" name="query" size="15"><input type="hidden" name="field" value="3"><input type="submit" value="SEARCH" name="go"></td><td align="left">&nbsp;</td></tr>
			</form>
			
			<form id="search4" name="search4" action="eg-adminpage.php" method="get">
			<tr><td align="right">Birthday (MM/DD/YYYY):</td><td><input type="text" name="query" size="15"><input type="hidden" name="field" value="4"><input type="submit" value="SEARCH" name="go"></td><td align="left">&nbsp;</td></tr>
			</form>
			</table>
		</div>
		
<?php

if(!isset($_GET['query'])){
	echo "Access User Id has NOT been provided.";
	} else {
// Code for if the user has provided a search post
// Put the results of the search form HERE
// Otherwise, a search form will be presented
		$aid = $_SESSION['accessid'] = $_GET['accessid'];
		$sid = $_SESSION['query'] = $_GET['query'];
		echo "Access User Id has been provided: " . $sid;
if ($search_field == '1'){
	$result = mysql_query("SELECT * FROM users WHERE first_name='$sid'");
}
if ($search_field == '2'){
	$result = mysql_query("SELECT * FROM users WHERE last_name='$sid'");
}
if ($search_field == '3'){
	$result = mysql_query("SELECT * FROM users WHERE street_address='$sid'");
}
if ($search_field == '4'){
	$result = mysql_query("SELECT * FROM users WHERE birthday='$sid'");
}
// Leave space for MORE search queries

$data1 = array(); // list first names
$data2 = array(); // list middle names
$data3 = array(); // list last names
$data4 = array(); // list birthday
$data5 = array(); // list street address
$data6 = array(); // list city
$data7 = array(); // list state
$data8 = array(); // list zip
$data9 = array(); // list email
$data10 = array(); // list userid

while(($row = mysql_fetch_array($result))) {
    $data1[] = $row['first_name'];
    $data2[] = $row['middle_name'];
    $data3[] = $row['last_name'];
    $data4[] = $row['birthday'];
    $data5[] = $row['street_address'];
    $data6[] = $row['city'];
    $data7[] = $row['state'];
    $data8[] = $row['zip'];
    $data9[] = $row['email_address'];
    $data10[] = $row['userid'];
}

$count=1;
echo "<table border=\"1\" cellpadding=\"5\" width=\"700\">";
echo "<tr><th width=\"150\">NAME</th><th width=\"120\">BIRTHDAY</th><th width=\"150\">ADDRESS</th><th width=\"20\">UID</th><th width=\"130\">&nbsp;</th><th width=\"130\">&nbsp;</th><th width=\"130\">&nbsp;</th></tr>";


foreach($data1 as $displaydata){
	$count2 = $count - 1;
	$fname = $data1[$count2];
	$mname = $data2[$count2];
	$lname = $data3[$count2];
	$bday = $data4[$count2];
	$ad1 = $data5[$count2];
	$ad2 = $data6[$count2];
	$ad3 = $data7[$count2];
	$ad4 = $data8[$count2];
	$uid = $data10[$count2];
		//$filepath = pathinfo($data1[$count2]);
		//$orig_date = $data3[$count2];
		//$textdate = date('F d, Y', strtotime($orig_date));
		//$mesid = $data4[$count2];
		//$vrecipient = $data5[$count2];
			//$path1 = $filepath['dirname'];
			//$path2 = $filepath['basename'];
			//$vid = preg_replace('/\.[^.]*$/', '', $path2);  //remove extension not needed


    echo "<tr id='del$count'><td>$fname $mname $lname</td>
    <td>$bday</td>
    <td><i>$ad1, $ad2, $ad3 $ad4</i></td><td>$uid</td><td><a alt='$lname' title='$lname' href='eg-editaccount.php?accessid=$uid'>Edit Account</a></td><td><a alt='$lname' title='$lname' href='eg-dashboard.php?accessid=$uid'>Messages</a></td><td><input name='deleteuser' type='button' value='Delete' onclick='click_delete();'></td></tr>\n";
    
    $count++;
}
echo "</table>";
}
		
?>
		
<p>&nbsp;</p>
<hr>
<p>&nbsp;</p>
<br><br><br>

<?php include("../development.php"); ?>

</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
		<div class="content">
		<?php include("../include/footer_code.html"); ?>
		</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script language="javascript" type="text/javascript">

	function click_delete(){

	if (confirm("Are you sure?")) {
			// delete code
			
		}
		return false;
	}



</script>

</body>
</html>
