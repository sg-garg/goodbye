<?php
session_start();
$_SESSION['ver'] = 1;
include("../db.php");
date_default_timezone_set('America/New_York');
$today = date("Y-m-d");	

if($_SESSION['userid'] == '7'){
$userid = $user = $_SESSION['userid'];
$access_id = $_GET['accessid'];
include("../pdoconnect.inc.php");

setcookie("username",urlencode($username),time()+36000);		
	} else {
	/* Redirect browser */
	header("Location: " . $site_url . "/site/admin.php");
}

	$sqldb = "SELECT * FROM users WHERE userid='$access_id'";
	$qdb = $conn->prepare($sqldb);
	$qdb->execute();

	$rowdb = $qdb->fetch();
		if($rowdb['user_level'] ==0){$ul = 'Free Member';}
		if($rowdb['user_level'] ==1){$ul = 'Standard Member';}
		if($rowdb['user_level'] ==2){$ul = 'Premium Member';}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="utf-8">
<title>Administration Dashboard</title>
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
					<div class="content">&nbsp;</div>
	</div> <!-- end header -->

<div id="wrapper">

		<div id="egcol2">
			<div class="content">
			<!-- sidebar -->
			<?php include("../include/db-acct-info.php"); ?>
			</div> <!-- end content (SIDEBAR) -->
		</div> <!-- end egcol2 -->
			
<div id="egcol1">  <!-- start egcol1 -->
<div class="content">
		<div align="center">
			<form name="admin"  action="eg-adminpage.php">
			<input type="submit" value="Return to Search" />
			</form>
		</div>

		
		<?php  if(!empty($rowdb['avatar'])){
		echo '<img src="../avatar/'.$rowdb['avatar'].' " alt=""  class="fltleft" width="100px" />';
		//echo '<img src="eventimage/'.$row['ev_img'].' " alt="" class="imgshadow fltright" />';  
		} 
		?>

		<h1><?php echo 'Welcome '. $rowdb ['first_name']. ' ' . $rowdb ['last_name']; 
		echo '<br />User #' . $access_id . '<br>';
		echo $ul;
		?></h1>
<hr/>

<p style="color: #a6a6a6;font-size: 11px;"><a href="../point-of-contact.php">ADMIN Add Point of Contact</a></p>

<!-- POINT OF CONTACT -->
<h3>Points of Contact</h3>

<?php

	$sqlppoc = "SELECT * FROM pocontact WHERE userid = '$access_id' AND prim = '1' ORDER BY recipient_ln ASC LIMIT 3";
$qppoc = $conn->prepare($sqlppoc);
$qppoc->execute();
$rowcount = $qppoc ->rowCount(); 

echo '<table cellpadding="5" width="560" border="1">';
echo '<th width="25%">Name</th><th width="25%">Relationship</th><th width="25%">Date Added</th><th width="25%">ACTION</th>';
	while($rowppoc = $qppoc->fetch()) {
		echo '<tr><td class="tw300">'. $rowppoc['recipient_fn']. ' ' .$rowppoc['recipient_mi']. '  ' . $rowppoc['recipient_ln'].'</td><td>'. $rowppoc['relation'].'</td><td><a href="../update-poc.php?poc_id='.$rowppoc['poc_id'].'">Edit</a></td><th><a href="eg-action-display-profile.php?aid='.$rowppoc['poc_id'].'" target="_blank"><img src="img/star_icon50x50.png" alt="Action" border="0"></a></th></tr>';
		}
echo '</table>';

if($rowcount >2){
		echo'<a href="../dashboardfull.php">View your full Contact List</a>';
				}

//if($rowcount>1){
?>

<hr />

<p style="color: #a6a6a6;font-size: 11px;"><a href="../point-of-contact.php">ADMIN Add Contact</a></p>

<!-- YOUR CONTACT  People you can send messages to -->
<h3>Your Contacts</h3>
<?php 

	$sqlpoc = "SELECT * FROM pocontact WHERE userid='$access_id' ORDER BY recipient_ln ASC LIMIT 3";
	$qpoc = $conn->prepare($sqlpoc);
	$qpoc->execute();

	echo '<table cellpadding="5" width="560" border="1">';
echo '<th width="25%">Name</th><th width="25%">Relationship</th><th width="25%">Point of Contact?</th><th>ACTION</th>';
while($rowpoc = $qpoc->fetch()){
	echo '<tr><td width="25%">'. $rowpoc['recipient_fn']. ' ' .$rowpoc['recipient_mi']. '  ' . $rowpoc['recipient_ln'].'</td><td>'. $rowpoc['relation'].'</td><td>';?><?php if(isset($rowpoc['prim']) && $rowpoc['prim']==1){echo 'Yes';}?>

<?php echo '</td><th><a href="../update-poc.php?poc_id='.$rowpoc['poc_id'].'">Edit</a><br><a href="eg-action-display-profile.php?aid='.$rowpoc['poc_id'].'" target="_blank"><img src="img/star_icon50x50.png" alt="Action" border="0"></a></th></tr>';

}
echo '</table>';

$_SESSION['gb_id']= $row['gb_id'];

?>
<hr />

<!-- GOODBYE -->

<p style="color: #a6a6a6;font-size: 11px;"><a href="../compose-goodbye.php">ADMIN Compose a New Goodbye Message</a></p>

<?php 


try{
/*$sql = "SELECT * FROM pocontact, gb_messages   WHERE userid ='$access_id'
";*/

$sql="SELECT    pocontact.recipient_fn, pocontact.recipient_mi, pocontact.recipient_ln, pocontact.relation,
 gb_messages.msg_date, gb_messages.msg_id, gb_messages.type FROM pocontact  JOIN gb_messages 
ON (gb_messages.poc_id = pocontact.poc_id) 
WHERE gb_messages.userid =? ";


$q = $conn->prepare($sql);
$q->execute(array($access_id));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}

$count = $q->rowCount();
if($count>= 1){
echo '<h3>Existing Goodbye Messages</h3>'; //  # # # # # # # # # # # # # # # # # # # # # # # #
		}else{
		if($count == 0){
		echo '<h3>You have Not Created any Goodbye Messages</h3>';
		}
		}

//Edited by SCOTT - added column 'type' 1=mail message; 2=email message 
//   NAME     DATE      RELATIONSHIP    #TYPE#     EDIT

// GOODBYES # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

echo '<table cellpadding="5" width="560" border="1">';
echo '<tr><th width="25%">Name</th><th width="25%">Date</th><th width="25%">Relationship</th><th width="25%">ACTION</th></tr>';
		while($row = $q->fetch()){
		//check which type (1 or 2)
if ($row['type'] == 1){$typeofmess = "E-mail";} else {$typeofmess = "USPS Mail";}
		echo '<tr><td>'. $row['recipient_fn'].' '.$row['recipient_mi'].' '.$row['recipient_ln'].'</td><td>'. $row['msg_date'].' </td><td>'. $row['relation'].'</td><th><a href="update-goodbye.php?msg_id='.$row['msg_id'].'">Edit</a> ('.$typeofmess.')<br><a href="eg-action.php?mid='.$row['msg_id'].'" target="_blank"><img src="img/star_icon50x50.png" alt="Action" border="0"></a></th></tr>';
		}
echo '</table>';

?>
<hr />

<!--VIDEO MESSAGES-->
<!--VIDEO MESSAGES-->
<!--VIDEO MESSAGES-->
<!--VIDEO MESSAGES-->

<p style="color: #a6a6a6;font-size: 11px;"><a href="../video-upload-s.php">ADMIN Video Upload</a></p>
<p style="color: #a6a6a6;font-size: 11px;"><a href="<?php echo $site_url; ?>/rec/index.php">ADMIN Record Video</a></p>

<?php 
// Perform Video Check: X of X videos
$vidcheck1 = mysql_query( "SELECT count(*) FROM mem_vid_upload WHERE userid='$access_id'" );
	$num_videos = mysql_result($vidcheck1, 0);
$vidcheck2 = mysql_query("SELECT * FROM users WHERE userid='$access_id' LIMIT 1");
$numvids = mysql_fetch_assoc($vidcheck2);
	$max_videos = $numvids["videos"];

//put this below
echo "<h2>You have uploaded <b>" . $num_videos . "</b> of <b>" . $max_videos . "</b> Videos</h2>\n";

// This part above gives X of X videos uploaded
// this method not used anymore
// $specific_files = glob($path_to_videos .'*.mp4', GLOB_BRACE);

$result = mysql_query("SELECT * FROM mem_vid_upload WHERE userid='$access_id'");
//$row = mysql_fetch_array($result) or die(mysql_error());
//$totalitems1 =  mysql_num_rows($result);

$data1 = array();
$data2 = array();
$data3 = array();
$data4 = array();
$data5 = array();
$data6 = array();
while(($row = mysql_fetch_array($result))) {
    $data1[] = $row['vidpath'];
    $data2[] = $row['vidtitle'];
    $data3[] = $row['vid_date'];
    $data4[] = $row['mem_id'];
    $data5[] = $row['recipient'];
    $data6[] = $row['vid_id'];
    
}

$count=1;
echo "<table border=\"1\" cellpadding=\"5\" width=\"560\">";
echo "<tr><th width=\"25%\">Title</th><th width=\"25%\">Date</th><th width=\"25%\">Recipient</th><th width=\"25%\">ACTION</th></tr>";
foreach($data2 as $dispimage){
		$count2 = $count - 1;
		$filepath = pathinfo($data1[$count2]);
		$orig_date = $data3[$count2];
		$textdate = date('F d, Y', strtotime($orig_date));
$vidid = $data6[$count2];
$mesid = $data4[$count2];
$vrecipient = $data5[$count2];
$path1 = $filepath['dirname'];
$path2 = $filepath['basename'];

//$p3 = $filepath['basename'] . "." . $filepath['extension'];

$vid = preg_replace('/\.[^.]*$/', '', $path2);  //remove extension not needed

    echo "<tr id='del$count'><td><a alt='$path2' title='$path2' href='../video-play-direct.php?vid=$path2'>$dispimage</a></td>
    <td>$textdate</td>
    <td><i>$vrecipient</i></td><th><a href='../video-dbupdate.php?v=$path2'>Edit</a><br><a href=\"eg-action.php?vid=$vidid\" target=\"_blank\"><img src=\"img/star_icon50x50.png\" alt=\"Action\" border=\"0\"></a></th></tr>\n";
    
    $count++;
}
echo "</table>";

?>

<hr />

<!-- MEMORIAL PAGES -->

<p style="color: #a6a6a6;font-size: 11px;"><a href="../create-memorial-self.php">ADMIN Create Memorial (SELF)</a></p>
<p style="color: #a6a6a6;font-size: 11px;"><a href="../create-memorial.php">ADMIN Create Memorial</a></p>


<?php 
$sqlm = "SELECT * FROM memorials WHERE userid = '$access_id'";
$qm = $conn->prepare($sqlm);
$qm->execute();
$rowm = $qm->fetch();
$mem_id = $_SESSION['mem_id']= $rowm['mem_id'];
$countm = $qm->rowCount();
if($countm >=1){
// EXSISTING MEMORIALS
echo '<h3>Existing Memorials</h3>';
		}else{
		if($countm ==0 ){
		echo '<h3>You have Not Created a Memorial</h3>';
		}
		}
echo '<table cellpadding="5" width="560" border="1">';
echo '<tr><th width="25%">Name</th><th width="25%">Edit</th><th width="25%">Upload Images</th><th width="25%">ACTION</th>';

$sqlm1 = "SELECT * FROM memorials WHERE userid = '$access_id' LIMIT 3 ";
$qm1 = $conn->prepare($sqlm1);
$qm1->execute();

while($rowm1 = $qm1->fetch()){
echo "<tr><td>
<a href='../preview-memorial.php?mem_id=" . $rowm1['mem_id'] . "'>" . $rowm1['fname'] ." ". $rowm1['lname'] . "</a></td>

<td><a href='../update-memorial.php?mem_id=" . $rowm1['mem_id'] . "'>Edit</a></td>

<td><a href='../upload-images-mem.php?mem_id=" . $rowm1['mem_id'] . "'>Upload Images for this Memorial</a></td>

<th><a href='eg-action-memorial.php?mem=" . $rowm1['mem_id'] . "' target='_blank'><img src='img/star_icon50x50.png' alt='Action' border='0'></a></th></tr>";

	}
echo "</table>";
$_SESSION['mem_id']= $rowm1['mem_id'];

//}
//else{
//echo'<h3>You must have at least 2 Points of Contact.</h3>';}?>


<hr />

<?php 
$sqllmem = "SELECT * FROM memorials WHERE userid ='$access_id' AND STATUS ='2'";
$qlmem = $conn->prepare($sqllmem);
$qlmem->execute();

if($sqllmem !==''){
		echo '<h3>Active Memorials</h3>';
// ACTIVE MEMORIALS
		echo '<table cellpadding="5" width="560" border="1">';
		echo '<tr><th width="25%">Title</th><th width="25%">Date</th><th width="25%">Recipient</th><th width="25%">ACTION</th></tr>';

		while($rowlmem = $qlmem->fetch()){				//remove extra ) when no loop
		echo '<tr><td><a href="../memorial.php?mem_id='.$rowlmem['mem_id'].'">'. $rowlmem['fname']. ' "' . $rowlmem['nname']. '" ' . $rowlmem['lname']. '</a></td>';
		
		echo '<td><i>date</i></td>';
		echo '<td><i>recipient</i></td>';
		echo "<th><a href='eg-action-memorial.php?mem=" . $rowlmem['mem_id'] . "' target='_blank'><img src='img/star_icon50x50.png' alt='Action' border='0'></a></th></tr>";
		}
		echo '</table>';
		}
?>

<hr>

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

</body>
</html>
