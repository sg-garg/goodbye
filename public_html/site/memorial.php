<?php 
session_start();
	$ver = $_SESSION['ver'];
	$time_stamp = date('m/d/y h:i:s A' );
	//require_once("authhead.php");
	require_once('pdoconnect.inc.php');
	include("db.php");
	$userid = $_SESSION['userid'];//this is the person logged into 
	$mem_id = $_SESSION['mem_id'] = $_GET['mem_id'];
	$mem_id=$_GET['mem_id'];
	$commentpage = $_SERVER['PHP_SELF'];
	$_SESSION['commentvid'] = "memorial.php?memid=$mem_id";
	setcookie("vppage",$commentpage,time()+3600); // exp in 1 hr

	$sqlm = "SELECT userid_m FROM uimages WHERE mem_id='$mem_id' AND userid_m IS NOT NULL ";
	$qm = $conn->prepare($sqlm);
	$qm->execute();
	$rowm = $qm->fetch();
	$userid_m = $rowm['userid_m'];

	$sqlq = "SELECT * FROM memorials WHERE mem_id = '$mem_id'  AND status ='2' LIMIT 1 ";
		$qq = $conn->prepare($sqlq);
		$qq->execute();
		$rowq = $qq -> fetch();

	if(isset($_POST['com'])){
		$comments = trim($_POST['comments']);
		$image = $_POST['image'];
		$userid_m = $rowq['userid']; // this is the dead person

if($_POST['image']!==''){
		$image_file = $_FILES['image']['name'];
		$image_type = $_FILES['image']['type'];
		$image_size = $_FILES['image']['size']; 
		}
		
	if(!empty($image_file)){
		if (($image_type == 'image/gif') || ($image_type == 'image/jpeg') || ($image_type == 'image/pjpeg') || ($image_type == 'image/png') && ($image_size < 3000000))  {
        if ($_FILES['image']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'imagesmemorial'. '/' . $image_file;
          
		if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
			$sqlic = "INSERT INTO uimages (userid, mem_id, image, time_stamp, comments) VALUES (:userid, :mem_id, :image, :time_stamp, :comments)";
			$qic = $conn->prepare($sqlic);
			$qic->execute(array(':userid'=> $userid, ':mem_id'=>$mem_id, ":image"=>$image_file, ':time_stamp'=>$time_stamp, ':comments'=>$comments));
				}
		}
		}
							}
							
if ($sqlic == true){
	// blank line
	}else{
	$comments = trim($_POST['comments']);
	$sqlicn = "INSERT INTO uimages (userid, mem_id, time_stamp, comments) VALUES (:userid, :mem_id, :time_stamp, :comments)"; 
	$qicn = $conn->prepare($sqlicn);
	$qicn->execute(array(':userid'=> $userid, ':mem_id'=>$mem_id,  ':time_stamp'=>$time_stamp,  ':comments'=>$comments));
	}
}
if(isset($_POST['com'])){
header("location:#comment");}


$resultinfo = mysql_query("SELECT * FROM memorials WHERE mem_id='$mem_id' LIMIT 1");
$row = mysql_fetch_array($resultinfo) or die(mysql_error());
    $data1 = $row['fname'];
    $data2 = $row['mi'];
    $data3 = $row['lname'];
    $data4 = $row['nname'];
    $data5 = $row['createby'];
    $data6 = $row['bdate'];
    $data7 = $row['dod'];
    $data8 = $row['title'];
    $data9 = $row['memurl'];
    $data10 = $row['memimage'];
    $data11 = $row['memorial'];
    $data12 = $row['sname'];
    $data13 = $row['comments'];
    $data14 = $row['service'];
    $data15 = $row['memimage'];

?>

<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="This is the memorial page of <?php
echo $data1 . ' ' . $data2 . ' ' . $data3 . ', ' . $data6 . ' - ' . $data7;
echo ' ' . $data8;
 ?>" />
<meta name="keywords" content="<?php
echo $data1.', '.$data2.', '.$data3.', '.$data8.' ('.$data6.'-'.$data7.')';
?>">
<title><?php
echo $data1 . ' ' . $data2 . ' ' . $data3 .' ('.$data6.'-'.$data7.')';
?></title>  

<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>

<link rel="stylesheet" href="css/default.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->

    <script src="js/html5lightbox.js"></script>
<link rel="stylesheet" href="css/extra-style.css">  
    <!--<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/bar.css" type="text/css" media="all" />-->
 <!--   <link rel="stylesheet" href="style.css" type="text/css" media="screen" />-->


<style>
body	{
	background: #b8e1fc; /* Old browsers */
/* IE9 SVG, needs conditional override of 'filter' to 'none' */
background: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEgMSIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+CiAgPGxpbmVhckdyYWRpZW50IGlkPSJncmFkLXVjZ2ctZ2VuZXJhdGVkIiBncmFkaWVudFVuaXRzPSJ1c2VyU3BhY2VPblVzZSIgeDE9IjAlIiB5MT0iMTAwJSIgeDI9IjEwMCUiIHkyPSIwJSI+CiAgICA8c3RvcCBvZmZzZXQ9IjAlIiBzdG9wLWNvbG9yPSIjYjhlMWZjIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMjUlIiBzdG9wLWNvbG9yPSIjOTBiYWU0IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMzclIiBzdG9wLWNvbG9yPSIjOTBiY2VhIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNDQlIiBzdG9wLWNvbG9yPSIjZDJlNGYyIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNTAlIiBzdG9wLWNvbG9yPSIjOTBiZmYwIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iNzQlIiBzdG9wLWNvbG9yPSIjZDBkOWUyIiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iOTIlIiBzdG9wLWNvbG9yPSIjYTJkYWY1IiBzdG9wLW9wYWNpdHk9IjEiLz4KICAgIDxzdG9wIG9mZnNldD0iMTAwJSIgc3RvcC1jb2xvcj0iI2JkZjNmZCIgc3RvcC1vcGFjaXR5PSIxIi8+CiAgPC9saW5lYXJHcmFkaWVudD4KICA8cmVjdCB4PSIwIiB5PSIwIiB3aWR0aD0iMSIgaGVpZ2h0PSIxIiBmaWxsPSJ1cmwoI2dyYWQtdWNnZy1nZW5lcmF0ZWQpIiAvPgo8L3N2Zz4=);
background: -moz-linear-gradient(45deg,  #b8e1fc 0%, #90bae4 25%, #90bcea 37%, #d2e4f2 44%, #90bff0 50%, #d0d9e2 74%, #a2daf5 92%, #bdf3fd 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left bottom, right top, color-stop(0%,#b8e1fc), color-stop(25%,#90bae4), color-stop(37%,#90bcea), color-stop(44%,#d2e4f2), color-stop(50%,#90bff0), color-stop(74%,#d0d9e2), color-stop(92%,#a2daf5), color-stop(100%,#bdf3fd)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(45deg,  #b8e1fc 0%,#90bae4 25%,#90bcea 37%,#d2e4f2 44%,#90bff0 50%,#d0d9e2 74%,#a2daf5 92%,#bdf3fd 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(45deg,  #b8e1fc 0%,#90bae4 25%,#90bcea 37%,#d2e4f2 44%,#90bff0 50%,#d0d9e2 74%,#a2daf5 92%,#bdf3fd 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(45deg,  #b8e1fc 0%,#90bae4 25%,#90bcea 37%,#d2e4f2 44%,#90bff0 50%,#d0d9e2 74%,#a2daf5 92%,#bdf3fd 100%); /* IE10+ */
background: linear-gradient(45deg,  #b8e1fc 0%,#90bae4 25%,#90bcea 37%,#d2e4f2 44%,#90bff0 50%,#d0d9e2 74%,#a2daf5 92%,#bdf3fd 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b8e1fc', endColorstr='#bdf3fd',GradientType=1 ); /* IE6-8 fallback on horizontal gradient */
}
textarea {
    width:500px;
    height:100px;
    border:1px solid #aaa; 
    padding:5px;
}
#minMax {
	box-shadow: 0px 0px 24px #111;}
#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	border:1px #000099 solid;
	-moz-border-radius: 6px  6px 6px 6px;
	-khtml-border-radius: 6px  6px 6px 6px;
	-webkit-border-radius: 6px  6px 6px 6px;
	border-radius: 6px  6px 6px 6px;
	box-shadow: 0px 0px 18px #3384DF;
	
	}
	
#wrap	{
	width:880px;
	margin:0px auto;
	}
.center	{
	text-align:center;
	display:block;
	width:100%;
	margin:0px auto;
	}
.centerimg	{
	text-align:center;
	display:block;
	width:300px;
	margin:0px auto;
	
	}
hr	{
		box-shadow: 0px 2px 8px #3384DF;
		width:90%;
		margin:0px auto;}
.fltright	{
	float:right;}
	
	.scottfltright	{display:inline}

.fltleft	{
left: 200px;
	float: left;}
.fl	{
	float:left;}
.imgshadow	{
	box-shadow: 0px 0px 16px #111;
	padding:4px;
	}
.pad10	{
	padding: 0px 26px 10px 10px;}
.clear	{
	clear:both;}
.rightm	{
	margin-right: 20px;}
.padleft	{
	padding-left:114px;}
.pad15	{
	padding-left:15px;}
#slider	{
	width:220px;
	margin:0px auto;

}
#space	{
	min-height:25px;
	padding-top:25px;}
.inline	{
	display:inline;
	}
.inlines	{
	
	overflow:scroll;
	width:860px;
	height:350px;
	
	}
.rs 	{
	width:100px;
	height:auto;
	}
	
	
.commentblock {
	font-size: 14px;
	font-family: Helvetica, Verdana, Arial, sans-serif;
	width: 600px;
	border-color: #353d6b;
	border-style: solid;
	border-width: 1px;
	padding: 5px;
	margin: 5px;
}

a.rabuse:link { color: #999999; text-decoration: none }
a.rabuse:visited { color: #999999; text-decoration: none }
a.rabuse:hover { color: #0a0f32; text-decoration: none }
a.rabuse:active { color: #999999; text-decoration: none }

.goodtext {
	font-size: 14px;
	font-family: Palatino, "Times New Roman", Georgia, Times, serif;
}

.largetext {
margin-bottom: 10px;
padding-bottom: 10px;
line-height: 30px;
	font-weight: bold;
	color: #373737;
	font-size: 16px;
	font-family: Futura, Verdana, Helvetica, Arial;
}

</style>

</head>
<body>
<div id="minMax">
	<div id="header">
		<div align="center">
		<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
		<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
		<script language="javascript" type="text/javascript" src="js/menu.js"></script>

		<?php include("include/nav-main.php"); ?>
		</div> <!-- end of center -->
		<div class="content"><br></div>
	</div><!-- end of header -->

<div class="content">
<div id="main">

	<?php 
	//this is also the query for nivo

		$sqlci = "SELECT * FROM uimages WHERE  mem_id = '$mem_id' AND image IS NOT NULL AND image <> 'TV-ICON-SCREEN-VIDEO.png'  AND userid_m = '$userid_m' " ;
		$qci = $conn->prepare($sqlci);
		$qci->execute();
		$countci = $qci->rowCount();
		if ($countci == 0 ){
			$dfs = 'image';
			}else{
			if($countci >=1 ){
			$dfs = 'slider';
			}
			}
		?>
<div class="clear"></div>
<article class=pad15><br /><!--This adds 15 px padding to left of page-->

<?php 
////////////////////////////////Memorial Section\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	if($dfs =='image' || $dfs == 'slider'){
		$sql = "SELECT * FROM memorials WHERE   mem_id = '$mem_id' AND status ='2' LIMIT 1  ";
		$q = $conn->prepare($sql);
		$q->execute();
		$row = $q -> fetch(); 
		echo '<div class="centerimg">';
		if(!empty($row['memimage'])){
		echo '<img src="imagesmemorial/'.$row[memimage].'" width="300px" alt="" class=" imgshadow" />';  
		if(!empty($row['nname'])) echo '<figcaption class=center>' .'"'.$row['nname'].'"' .'</figcaption>' ;
	}
	?>
	
	<h1 class="center"><?php echo $row['memorial'] ;?> </h1><h2> <?php echo  $row['fname'] .' '. $row['mi'].'   ' .$row['lname'] ; ?></h1>

	<p class="center"><?php echo "<span class=\"largetext\">" . $row['bdate'] . " - " . $row['dod'] . "</span>"; ?></p>
	<?php echo '</div >';?>

	<div id="wrap">

	<p class="pad10"><?php echo "<span class=\"goodtext\">" . nl2br($row['comments']) . "</span>"; ?></p>
	<h3><?php  if(!empty($row['service'])) echo 'Service Information'; ?></h3>
	<p class="pad10"><?php  if(!empty($row['service'])) echo "<span class=\"goodtext\">" . nl2br($row['service']) . "</span>"; ?></p>
	<h3><?php  if(!empty($row['createby'])) echo 'Created by:'; ?></h3>
	<p class="pad10"><?php  if(!empty($row['createby'])) echo "<span class=\"goodtext\">" . nl2br($row['createby']) . "</span>"; ?></p>
	<div class="clear"></div>
	<hr class="clear" />
	<br />

	<?php 
	if($countci >=1){
	echo '<div class="inlines">';
	//////////////////////////////////image gallery\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\

	while($rowci = $qci->fetch()){
	echo '<ul class="inline">';
	
	echo '<li class="inline"><a href="imagesmemorial/' . $rowci['image'] . '" class="html5lightbox" title="' . $rowci['image_comment'].'" alt="' . $rowci['image_comment'].'"><img width="75" height="75" src="imagesmemorial/' .$rowci['image'].'" class="imgshadow rs" style="height: 75px;width: 75px;"/></a></li>';
	
	echo '</ul>';
		}
	echo'</div>';
	}
	?>

<h2>Add your Comments:<br>

<?php 
if($ver ===1){
		$sqlc = "SELECT * FROM users ORDER BY time_stamp WHERE userid = '$userid'  AND userid !=='userid_m' LIMIT 1";
		$qc = $conn->prepare($sqlc);
		$qc -> execute();
		$rowc = $qc->fetch();
		}

if($ver ===1){
		if(!empty($rowc['avatar'])) echo '<img src="avatar/'.$rowc['avatar'].' " class="fltleft" width ="75px"/>';

		echo '<br class="clear"/>';
		echo '<p class="fltleft" >'.$rowc['first_name'].' ' .$rowc['middle_name'].' ' .$rowc['last_name'].'</p>';
		echo '<br class="clear"/>';
		echo '<form id="memedit" action="" method ="post" enctype="multipart/form-data" >';
		echo '<textarea name="comments" id="comments" cols="15" rows="5"></textarea></h2>';
		
		echo '<p>Upload Photo<br /><input type="file" name="image" /></p>';
	
// Include a video with your comment	
		
		
		echo '<br><p>Include a Video<br /> <a href="video-record-upload.php?mem_id=' . $mem_id . '"/>Click Here</a></p>';
				
		echo '<p><input type="hidden" id="date" name="date" ></p>';//changed by gary
		echo '<script type="text/javascript">';
		echo 'var now = new Date();';
		echo 'now.format("yyyy-mm-dd HH:MM:ss");';
		echo 'document.getElementById("date").value = now;';
		echo '</script>';

		echo '<input type=submit name="com" id="com" value="Add Your Comment" />';
		echo "</form>";
		echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
		}
		
if($ver !==1){

	echo 'You must log in to post a comment';
?>

<form action="login.php">
<input type="hidden" name="return" value="<?php echo($_SERVER['REQUEST_URI']); ?>" />
<input type="submit" name="li" value="Log In" />
</form>

<?php } ?>
<hr />
<!-- COMMENTS -->


<h2 id="comment">Comments</h2>

<?php
// COMMENTS
// COMMENTS
// COMMENTS

$sqlpc = "SELECT users.userid, users.first_name, users.middle_name, users.last_name, users.avatar, uimages.userid, uimages.userid_m, uimages.msg_id, uimages.image, uimages.slider, uimages.comments, uimages.time_stamp FROM users JOIN uimages ON (users.userid = uimages.userid) WHERE  uimages.mem_id = '$mem_id'  ORDER BY uimages.time_stamp DESC";

	$qpc= $conn->prepare($sqlpc);
	$qpc->execute();
	//this is the commenter's ava and name and timestamp
	//if( isset ($rowpc['comments']) || !empty($rowpc['image'])){

	while($rowpc = $qpc->fetch()){
	

//LOOP 3
//LOOP 3
//LOOP 3	
     if($rowpc['slider'] !=='yes'){
     //this keeps images uploaded by memorial creator from comment timeline
     //LOOP 2
	if(!empty($rowpc['avatar'])){
	echo "<div class=\"commentblock\">"; //comment block start
	//LOOP 1 LOOP 1 LOOP 1
	echo '<img src="avatar/'.$rowpc['avatar'].' " class="fltleft rightm" width="75px"/>';
	echo "<p><b>" . $rowpc['first_name'].' ' .$rowpc['middle_name'].' ' .$rowpc['last_name'] . ' '. ' said on ' . $rowpc['time_stamp'] .':</b></p><br/>';
		if(((!empty($rowpc['image']) && $rowpc['image'] !=='TV-ICON-SCREEN-VIDEO.png') && $rowpc['slider'] !== 'yes')){
		echo '<img src="imagesmemorial/'.$rowpc['image'].'" class="scottfltright" width="200" " />';}
echo '<article class="clear"><br /></article>';echo '<article class=padleft>'.$rowpc['comments'].'</article>';echo '<article class="clear "><br /></article>';
//scotts code - check for video
if (preg_match("/^TV-ICON/", $rowpc['image'])) {
   $qre = $rowpc['msg_id'];
   $result = mysql_query("SELECT * FROM vid_upload_comments WHERE vid_id='$qre'   LIMIT 1");
   $row = mysql_fetch_assoc($result);
   $vname = $row['videoname'];
   $vtitle = $row['vidtitle'];
   $vpath = $row['vidpath'];
   echo '<a href="video-play-direct-com.php?vid=' . $vname . '"><img src="imagesmemorial/'.$rowpc['image'].' "class="scottfltright" width="200" " /></a>';
   //echo '<hr />';
   echo '<br />';
   }  //end check for video 			
			
// Abuse Button		
   echo '<p><a href="abuse-report.php?mem_id='
    . $mem_id . '&comments='. $rowpc['comments']
     . '&abuse=1" class="rabuse">Report Abuse</a></p>';
   
   echo '</div> <!-- end of comment block -->';
   echo '<article class="clear"></article>';
//echo "<p>End loop (1)</p>/n";
}  //end avatar loop
//echo "<p>End loop (2)</p>/n";
}  //end slider loop
//echo "<p>End loop (3)</p>/n";
}   //end comment block div loop



// COMMENTS
// COMMENTS
// COMMENTS
?>
</article>  <!-- end of this article tag line 224 article class=pad15 -->

<form name="Tick">
<input id="timestamp" style="display:none" type="text" size="20" name="Clock">
</form>

<script>
function show(){
var Digital=new Date()
var year=Digital.getYear()
if (year < 1000)
year+=1900
var day=Digital.getDay()
var month=Digital.getMonth()+1
if (month<10)
month="0"+month
var daym=Digital.getDate()
if (daym<10)
daym="0"+daym
var hours=Digital.getHours()
var minutes=Digital.getMinutes()
var seconds=Digital.getSeconds()
var dn="AM"
if (hours>12){
dn="PM"
hours=hours-12
}
if (hours==0)
hours=12
if (minutes<=9)
minutes="0"+minutes
if (seconds<=9)
seconds="0"+seconds
document.Tick.Clock.value=month+"/"+daym+"/"+year+" "+hours+":"+minutes+":"+seconds+" "+dn
setTimeout("show()",1000)
}
show()
</script>

<?php
} //end of loop from ???
?>


</div><!-- end #wrapper -->
</div>

		<div id="footer">
			<div class="content">
			<?php include("include/footer.php") ;?>
			</div> <!-- end content -->
		</div> <!-- end footer -->
		</div> <!-- end wrapperA -->
<script>
    $(document).ready(function() {
        $('#slider').nivoSlider({effect:'sliceUpRight'});
    });

$('#memedit').plum('form', {
	ajax: false,
	labels: true,
	action: null,
	shake: true});
	
function vid_go(){
	window.location.href = "video-record-upload.php?mem_id=<?php echo $mem_id; ?>";
	}
	
</script>
	
</body>
</html>
