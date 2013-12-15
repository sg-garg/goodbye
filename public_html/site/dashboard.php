<?php
session_start();
$userid = $_SESSION['userid'];
$poc_id = $userid . time();
require_once("pdoconnect.inc.php");
require_once("db.php");

	$sqldb = "SELECT * FROM users WHERE userid='$userid'";
	$qdb = $conn->prepare($sqldb);
	$qdb->execute();

	$rowdb = $qdb->fetch();
		if($rowdb['user_level'] <= "1"){
			$ul = 'Free Member';
			$_SESSION['user_level'] = "0";
		}
		if($rowdb['user_level'] == "2"){
			$ul = 'Standard Member';
			$_SESSION['user_level'] = "2";
		}
		if($rowdb['user_level'] == "3"){
			$ul = 'Premium Member';
			$_SESSION['user_level'] = "3";
		}
		
$result = mysql_query("SELECT * FROM users WHERE userid='$userid' LIMIT 1");
	$row = mysql_fetch_assoc($result);
	$PLAN_NAME_NOT_GARYS = $row['plan_name'];
	$USER_LEVEL_FROM_DB = $row['user_level'];

if(isset($_SESSION['userid'])){
		date_default_timezone_set('America/New_York');
		$today = date("Y-m-d");		
		} else {
			/* Redirect browser */
			header("Location: " . $site_url . "/site/login.php");
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head> 
<meta charset="utf-8">   
<title>Dashboard of <?php echo $rowdb ['first_name'] .' '. $rowdb ['last_name']; ?></title>  
<style>
h1	{font-size:36px;}

h1, h2, h3, h4		{color:#00054F;}
table				{text-align:left;}
th					{text-align:left;padding-left:20px;font-size:20px;color:#00054F;}
td					{padding-left:20px;width:200px;}
.tw300				{width:300px;}
#leftcol			{width:580px;float:left;padding:5px;}
#rightcol			{width:220px;float:left;padding:5px;}
.inline				{display:inline-block;}
#main				{width:880px;margin:0px auto;background-color:#D8E0E4;overflow:hidden;}
.fltleft			{float:left;}
.clear				{clear:both;min-height:120px;}
#hint				{cursor:pointer;}
.tooltip			{margin:8px;padding:8px;border:1px solid #0a0f32;background-color: #a5d0f0;position: absolute;z-index: 2;}
</style>
<?php require("include/head.html") ?>
</head>

<body>

<div id="minMax">
		<div id="header">
		<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
			<?php include("include/nav-main.php"); ?>
		</div> <!-- end of center -->
		<div class="content">&nbsp;</div>

<div class="content">
	<div id="main">
		<div id="leftcol">
		<div class="clear" style="width: 480px;">
		<?php  if(!empty($rowdb['avatar'])){
		echo '<img src="avatar/'.$rowdb['avatar'].' " alt=""  class="fltleft" width="100px" height="100px"/>';
		//echo '<img src="eventimage/'.$row['ev_img'].' " alt="" class="imgshadow fltright" />';  
		} 
		?>

		<h1><?php echo '<br>Welcome '. $rowdb ['first_name']. ' ' . $rowdb ['last_name']; 
		echo '<br />';
		// echo $ul . "- <i>userlevel: " . $USER_LEVEL_FROM_DB ."</i>";
		echo $ul;

		?></h1>
		</div>
<hr/>
<p>
<form action="point-of-contact.php" id="entry">
<input type="submit" value="New Point of Contact or Recipient" />
<div class="info"></div>
</form></p>

<!-- POINT OF CONTACT -->
<h3>Points of Contact <span id="poc"><img style="vertical-align: middle;" src="img/help_icon_small.png" alt="info" border="0"></span></h3>

<?php

	$sqlppoc = "SELECT * FROM pocontact WHERE userid = '$userid' AND prim = '1' ORDER BY recipient_ln ASC";
$qppoc = $conn->prepare($sqlppoc);
$qppoc->execute();
$rowcount = $qppoc ->rowCount(); 
echo '<table cellpadding="5" width="560" border="0">';
echo '<th width="25%">Name</th><th width="25%">Relationship</th><th width="25%">Date Added</th><th width="25%">&nbsp;</th>';
	while($rowppoc = $qppoc->fetch()) {
	$sdate = date('F d, Y', strtotime($rowppoc['submitted']));
		echo '<tr><td class="tw300">'. $rowppoc['recipient_fn']. ' ' .$rowppoc['recipient_mi']. '  ' . $rowppoc['recipient_ln'].'</td><td>'. $rowppoc['relation'].'</td><td>'.$sdate.'</td><td><a href="update-poc.php?poc_id='.$rowppoc["poc_id"].'">Edit</a></td></tr>';
		}
echo '</table>';

//if($rowcount >2){
//echo'<a href="dashboardfull.php">View your full Contact List</a>';
//}

//if($rowcount>1){
?>

<hr />


<!-- YOUR CONTACT  People you can send messages to -->
<h3>Recipients <span id="contact"><img style="vertical-align: middle;" src="img/help_icon_small.png" alt="info" border="0"></span></h3>
<?php 

	$sqlpoc = "SELECT * FROM pocontact WHERE userid='$userid' ORDER BY recipient_ln ASC LIMIT 6";
	$qpoc = $conn->prepare($sqlpoc);
	$qpoc->execute();

	echo '<table cellpadding="5" width="560">';
echo '<th width="25%">Name</th><th width="25%">Relationship</th><th width="25%">Point of Contact?</th>';
while($rowpoc = $qpoc->fetch()){
	echo '<tr><td width="25%">'. $rowpoc['recipient_fn']. ' ' .$rowpoc['recipient_mi']. '  ' . $rowpoc['recipient_ln'].'</td><td>'. $rowpoc['relation'].'</td><td>';?><?php if(isset($rowpoc['prim']) && $rowpoc['prim']==1){echo 'Yes';}?>

<?php echo '</td><td><a href="update-poc.php?poc_id='.$rowpoc["poc_id"].'">Edit</a></td></tr>';

}
echo '</table>';

//$_SESSION['gb_id']= $row['gb_id'];

?>
<hr />

<!-- GOODBYE -->
<p><form action="compose-goodbye.php" >
<input type="submit" value="Compose a Document Goodbye" />
</form></p>

<?php 


try{
/*$sql = "SELECT * FROM pocontact, gb_messages   WHERE userid ='$userid'
";*/

$sql="SELECT    pocontact.recipient_fn, pocontact.recipient_mi, pocontact.recipient_ln, pocontact.relation,
 gb_messages.msg_date, gb_messages.msg_id, gb_messages.type FROM pocontact  JOIN gb_messages 
ON (gb_messages.poc_id = pocontact.poc_id) 
WHERE gb_messages.userid =? ";


$q = $conn->prepare($sql);
$q->execute(array($userid));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die('Ooops');
}

$count = $q->rowCount();
if($count>= 1){
echo '<h3>Existing Goodbye Messages</h3>';
		}else{
		if($count == 0){
		echo '<h3>You have Not Created any Goodbye Messages</h3>';
		}
		}

//Edited by SCOTT - added column 'type' 1=mail message; 2=email message 
//   NAME     DATE      RELATIONSHIP    #TYPE#     EDIT

echo '<table cellpadding="5" width="560">';
echo '<tr><th width="25%">Recipient</th><th width="25%">Relationship</th><th width="25%">Date</th><th width="25%">&nbsp;&nbsp;&nbsp;</th></tr>';
		while($row = $q->fetch()){
		//check which type (1 or 2)
if ($row['type'] == 1){$typeofmess = "E-mail";} else {$typeofmess = "USPS Mail";}
		echo '<tr><td>'. $row['recipient_fn'].' '.$row['recipient_mi'].' '.$row['recipient_ln'].'</td><td>'. $row['relation'].'</td><td>'. $row['msg_date'].' </td><td><a href="update-goodbye.php?msg_id='.$row['msg_id'].'">Edit</a> ('.$typeofmess.')</td></tr>';
		}
echo '</table>';

?>
<hr />

<!--VIDEO MESSAGES-->
<!--VIDEO MESSAGES-->
<!--VIDEO MESSAGES-->
<!--VIDEO MESSAGES-->

<p>
<form action="video-upload-s.php">
<input type="submit" value="Upload a Video Goodbye">
</form>
<form action="<?php echo $site_url; ?>/rec/index.php" >
<input type="submit" value="Compose a Video Goodbye">
</form>
</p>



<?php 
// Perform Video Check: X of X videos
$vidcheck1 = mysql_query( "SELECT count(*) FROM mem_vid_upload WHERE userid='$userid'" );
	$num_videos = mysql_result($vidcheck1, 0);
$vidcheck2 = mysql_query("SELECT * FROM users WHERE userid='$userid' LIMIT 1");
$numvids = mysql_fetch_assoc($vidcheck2);
	$max_videos = $numvids["videos"];

//put this below
echo "<h2>You have uploaded <b>" . $num_videos . "</b> of <b>" . $max_videos . "</b> Videos</h2>\n";

// This part above gives X of X videos uploaded
// this method not used anymore
// $specific_files = glob($path_to_videos .'*.mp4', GLOB_BRACE);

$result = mysql_query("SELECT * FROM mem_vid_upload WHERE userid='$userid'");
//$row = mysql_fetch_array($result) or die(mysql_error());
//$totalitems1 =  mysql_num_rows($result);

$data1 = array();
$data2 = array();
$data3 = array();
$data4 = array();
$data5 = array();
while(($row = mysql_fetch_array($result))) {
    $data1[] = $row['vidpath'];
    $data2[] = $row['vidtitle'];
    $data3[] = $row['vid_date'];
    $data4[] = $row['mem_id'];
    $data5[] = $row['recipient'];
}

// Put title code here! (Not needed on dashboard)

//echo "<form><p style=\"font-weight:bold; color:#353d6b; font-size: 16px;\">\nChoose a Title:<br>\n<label><input id=\"vtitle\" type=\"text\" name=\"videotitle\" value=\"Name your video\" size=\"15\"></label>\n";

//<input type='button' id='savebtn' value='Save' onclick='saveData(\"videotitle\",\"vtitle\");'>\n <span id=\"savestatus\">&nbsp;&nbsp;&nbsp;&nbsp;</span></p>\n";

//Make a table, diplay in jquery/ajax with awesome delete buttons
$count=1;
echo "<table border=\"0\" cellpadding=\"5\" width=\"560\">";
echo "<tr><th width=\"25%\">Recipient</th><th width=\"25%\">Title</th><th width=\"25%\">Date</th><th width=\"25%\">&nbsp;</th></tr>";
foreach($data2 as $dispimage){
		$count2 = $count - 1;
		$filepath = pathinfo($data1[$count2]);
		$orig_date = $data3[$count2];
		$textdate = date('F d, Y', strtotime($orig_date));

		$mesid = $data4[$count2];
$vrecipient = $data5[$count2];
$path1 = $filepath['dirname'];
$path2 = $filepath['basename'];

//$p3 = $filepath['basename'] . "." . $filepath['extension'];

$vid = preg_replace('/\.[^.]*$/', '', $path2);  //remove extension not needed

/*
    echo "<tr id='del$count'><td>$count</td>
    <td><img src=\"../rec/ori/images/$vid.jpg\" alt=\"$vid\" height=\"75\" width=\"95\" border=\"0\"></td>
    <td><a alt='$path2' title='$path2' href='../site/video-player-code.php?vid=$vid'>$textdate</a></td>
    <td>$dispimage</td><td>
    <input type='button' id='delete$count' value='Delete' onclick='deleteFile(\"$path2\",$count,\"$path1\");'>
    </td></tr>";
*/
    echo "<tr id='del$count'>
    <td><i>$vrecipient</i></td>
    
    <td><a alt='$path2' title='$path2' href='video-play-direct.php?vid=$path2'>$dispimage</a></td>
    
    <td>$textdate</td>
    
    <td><a href='video-dbupdate.php?v=$path2'>Edit</a></td>
    </tr>\n";
    
    $count++;
}
echo "</table>";

?>

<hr />

<!-- MEMORIAL PAGES -->
<!--<h2><a href="create-memorial.php">Create a Memorial</a></h2>-->


<p>
<form action="create-memorial.php" >
<input type="submit" value="Create a Memorial " />
</form>
<form action="create-memorial-self.php" >
<input type="submit" value="Create a Memorial for Yourself" />
</form>
</p>

<?php 
$sqlm = "SELECT * FROM memorials WHERE userid = '$userid'";
$qm = $conn->prepare($sqlm);
$qm->execute();
$rowm = $qm->fetch();
$mem_id = $_SESSION['mem_id'] = $rowm['mem_id'];
$memorial_title = $_SESSION['memorial'] = $rowm['memorial'];
$countm = $qm->rowCount();
if($countm >=1){
echo '<h3>Existing Memorials</h3>';
		}else{
		if($countm ==0 ){
		echo '<h3>You have Not Created a Memorial</h3>';
		}
		}
echo '<table cellpadding="5" width="560" border="0">';
echo '<tr>
<th width="25%">Preview</th>
<th width="25%">Title</th>
<th width="25%">Photos</th>
<th width="25%">&nbsp;</th>
</tr>';

$sqlm1 = "SELECT * FROM memorials WHERE userid = '$userid' LIMIT 6 ";
$qm1 = $conn->prepare($sqlm1);
$qm1->execute();

while($rowm1 = $qm1->fetch()){
echo "<tr>
<td><a href='preview-memorial.php?mem_id=" . $rowm1['mem_id'] . "'>" . $rowm1['fname'] ." ". $rowm1['lname'] . "</a></td>

<td><i>" . $rowm1['memorial'] . "</i></td>

<td><a href='upload-images-mem.php?mem_id=" . $rowm1['mem_id'] . "'>Add/Remove Photos</a></td>
<td><a href='update-memorial.php?mem_id=" . $rowm1['mem_id'] . "'>Edit</a></td>
</tr>";

	}
echo "</table>";

$_SESSION['mem_id'] = $rowm1['mem_id'];

//}
//else{
//echo'<h3>You must have at least 2 Points of Contact.</h3>';}?>

<hr />

<?php 
$sqllmem = "SELECT * FROM memorials WHERE userid ='$userid' AND STATUS ='2'";
$qlmem = $conn->prepare($sqllmem);
$qlmem->execute();

if($sqllmem !==''){
		echo '<h3>Active Memorials <span id="amemorial"><img style="vertical-align: middle;" src="img/help_icon_small.png" alt="info" border="0"></span></h3>';
		echo '<table cellpadding=\"5\" width=\"560\">';
		echo "<tr><th width=\"25%\">Preview</th><th width=\"25%\">Title</th><th width=\"25%\">Date</th><th width=\"25%\">&nbsp;</th></tr>";

		while($rowlmem = $qlmem->fetch()){				//remove extra ) when no loop
		$sudate = date('F d, Y', strtotime($rowlmem['submitted']));
		echo '<tr>
		
		<td><a href="memorial.php?mem_id='.$rowlmem['mem_id'].'">'. $rowlmem['fname']. ' "' . $rowlmem['nname']. '" ' . $rowlmem['lname']. '</a></td>';
		
		echo '<td><i>'. $rowlmem['memorial']. '</i></td>';
		
		echo '<td><i>'. $sudate . '</i></td>';

$tit1 = $rowlmem['memorial'];
$tit2 = "eGoodbyes Memorial Page, for " . $tit1;
$sharetitle = urlencode($tit2);
$shareurl = "https://www.egoodbyes.com/site/memorial.php?mem_id=" . $rowlmem['mem_id'];
		
		echo '<td><a href="http://www.facebook.com/sharer.php?u=' . $shareurl . '"><img src="img/icon_fb.png" alt="facebook" height="25" width="25" border="0"></a> &nbsp; <a href="http://twitter.com/share?text='. $sharetitle . '&url=' . $shareurl . '"><img src="img/icon_twit.png" alt="twit" height="25" width="25" border="0"></a>
		</td>';
		
		
		echo '</tr>';
		}
		echo '</table>';
		}
?>

</div>

<!--eo leftcol-->

<div id="rightcol">

<!-- side for Account & Upgrading -->

<?php

include("include/db-acct-info.php");

if ($USER_LEVEL_FROM_DB == "3"){
echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-M.png\" alt=\"Memorial\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-V.png\" alt=\"Video\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

}

if ($USER_LEVEL_FROM_DB == "2"){
echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-Pupgrade.png\" alt=\"Premium Upgrade\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-M.png\" alt=\"Memorial\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-V.png\" alt=\"Video\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

}

if ($USER_LEVEL_FROM_DB <= "1"){

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-P.png\" alt=\"Premium\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-S.png\" alt=\"Standard\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-M.png\" alt=\"Memorial\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

echo "<p><a href=\"subscriptions.php\"><img src=\"img/SIDE-IMAGES-V.png\" alt=\"Video\" height=\"183\" width=\"250\" border=\"0\"></a></p>\n";

}
?>

<!-- side for upgrading -->

</div><!--eo rightcol-->

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php include("development.php"); ?>

<!--</div>-->



</div> <!-- end content -->
</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

	<div id="footer">
	<div class="content">
		<?php include("include/footer.php") ;?>
	</div> <!-- end content -->
	</div> <!-- end footer -->
</div> <!-- end wrapperA -->

<script src="js/validate-dashboard.js"></script>


<script type="text/javascript">

function deleteFile(fname,rowid,directory) {
		$.ajax({ type: "POST",
		url: "jssccode/deletevideofile.php",
		data: {"filename":fname,"directory":directory},
		async: false,
		beforeSend: function() {
		alert('Action: ' + directory + '/' + fname);
		},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
		success: function(output) {
		alert('Confirm that you want to remove ' + 'path: ' + directory + '; filename: ' + fname);
		$("#del"+rowid).remove();},
		complete: function(response){console.log(response);
		alert('Complete');}
		});
}

	function saveDatabase(fname,vtitle,directory,uid) {
		$.ajax({ type: "POST",
		url: "savevideofile.php",
		data: {"filename":fname,"directory":directory,"title":vtitle,"userid":uid},
		async: false,
		beforeSend: function() {$('#resp').html('Loading...');},
		error: function (xmlHttpRequest, textStatus, errorThrown) {
         alert(xmlHttpRequest, textStatus, errorThrown);
         },
			success: function(output) {
			alert('Saving: ' + fname + '; To path: ' + directory);
			},
		complete: function(response){
			console.log(response);
			alert('Complete');}
		});
}


$(document).ready(function() {
var changeTooltipPosition = function(event) {
var tooltipX = event.pageX - 8;
var tooltipY = event.pageY + 8;
$('div.tooltip').css({top: tooltipY, left: tooltipX});
};

var showTooltip = function(event) {
$('div.tooltip').remove();
$('<div class="tooltip">Point of Contact is a person who will be in charge of your account, upon your passing.</div>')
.appendTo('body');
changeTooltipPosition(event);
};
	var hideTooltip = function() {$('div.tooltip').remove();};
	$("span#poc'").bind({mousemove : changeTooltipPosition,mouseenter : showTooltip,mouseleave: hideTooltip});
	
var showTooltip2 = function(event) {
$('div.tooltip').remove();
$('<div class="tooltip">A <i>Recipient</i> is a person who will be receiving your final goodbye message.</div>')
.appendTo('body');
changeTooltipPosition(event);
};
	$("span#contact'").bind({mousemove : changeTooltipPosition,mouseenter : showTooltip2,mouseleave: hideTooltip});
	
var showTooltip3 = function(event) {
$('div.tooltip').remove();
$('<div class="tooltip">An Active Memorial will be view-able to the public.</div>')
.appendTo('body');
changeTooltipPosition(event);
};
	$("span#amemorial'").bind({mousemove : changeTooltipPosition,mouseenter : showTooltip3,mouseleave: hideTooltip});
	
	
});

</script>

</body>
</html>
