<?php 
session_start();
require_once("pdoconnect.inc.php");
$ver = $_SESSION['ver'];

$event_id = $_GET['event_id'];
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="css/default.ie7.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<!--[if lte IE 7]>
<link rel="stylesheet" href="css/design3-styleie.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.ie7.css">
<![endif]-->
<script language="javascript" type="text/javascript" src="js/nav2.1.js"></script>
<script language="javascript" type="text/javascript" src="js/menu.js"></script>
<link rel="stylesheet" href="css/extra-style.css">

<style>
table	{
	text-align:left;
	}
td	{
	padding-right:20px;}
#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}

h1	{
	color:#000;
	font-size:36px;}
.imgshadow	{
	box-shadow: 0px 8px 8px #111;
	padding:10px;
	margin-bottom:30px;
	
	}
.clear	{
	clear:both;
	}
.fltright	{
	float:right;
	padding:15px;
	}
.centert	{
	text-align:center;
	display:block;
	width:200px;
	margin:auto;}
.center{
	text-align:center;
	display:block;
	width:inherit;
	margin:auto;}
.leftfloat	{
	text-align:left;
	padding:15px;
	}
div.pagination a {
	padding: 2px 5px 2px 5px;
	margin: 2px;
	border: 1px solid #AAAADD;
	
	text-decoration: none; /* no underline */
	color: #000099;
}
div.pagination a:hover, div.pagination a:active {
	border: 1px solid #000099;

	color: #000;
}
div.pagination span.current {
	padding: 2px 5px 2px 5px;
	margin: 2px;
		border: 1px solid #000099;
		
		font-weight: bold;
		background-color: #000099;
		color: #FFF;
	}
	div.pagination span.disabled {
		padding: 2px 5px 2px 5px;
		margin: 2px;
		border: 1px solid #EEE;
	
		color: #DDD;
	}
</style>
<?php
if( $_GET['page'] >1 || isset($_POST['sea'])){
?>
<script>
window.onload = function() {
    var el = document.getElementById('target');
    el.scrollIntoView(true);
}</script>

<?php
}?>

</head>

<body>

<div id="minMax">
		<div id="header">
			<div align="center">
			<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
			<?php include("include/nav-main.php"); ?>
			</div> <!-- end of center -->
			<div class="content"><br></div>
		</div>
		
<div class="content">
<div id="main">

<?php $sqls = "SELECT * FROM event WHERE event_id = '$event_id' ";
$qs = $conn->prepare($sqls);
$qs->execute();

$rowe = $qs->fetch();

echo '<h1>'.$rowe['event'].'</h1>';
echo '<img src="eventimage/'.$rowe['ev_img'].' " alt="" class="imgshadow fltright" width="400px" />';  
echo '<br /><br />';
if(isset($row['caption'])) echo '<figcaption class=center>' .'"'.$rowe['caption'].'"' .'</figcaption>' ;
echo '<div class=leftfloat>' . nl2br($rowe['story']).'</div>';
?>

<div class="clear"></div>
<div id="target"></div>
<h3 class="center">Search Active Memorials</h3>
<br />
<form method="post" action="" >
<table width="200px" class="centert"><tr><td>
<input type="text" name="sm" /></td><td>
<!--<input type="text" name="address" class="important" />-->
<input type="submit" name="sea" value="Search" /></td></tr></table>

</form>
<article  class="center"><b>Enter a first <i>or</i> a last name.</b></article>
<!--<a href="#here">here</a>-->

<!--<div id="250"></div>-->

<br />


<?php
if(!isset($_POST['sea'])){
//if(empty($_POST['sea'])){
/////////////////////////////////////////////////////////
	$tbl_name="victims";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 3;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT event_id  FROM $tbl_name WHERE event_id = '$event_id' ";
	
	$q = $conn->prepare($query);
	$q->execute();
	$total_pages = $q->rowCount();


	//$total_pages = mysql_fetch_array(mysql_query($query));
	//$total_pages = $total_pages[num];

  //?event_id=$event_id
	$targetpage = "current-events.php";	//your file name  (the name of this file)
						//how many items to show per page
				$limit = 25; 				

  $page = $_GET['page'];

	


	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	$sql = "SELECT * FROM $tbl_name WHERE event_id = '$_GET[event_id]' ORDER BY lname ASC LIMIT $start, $limit ";
		$result = $conn->prepare($sql);
		$result->execute();
	//$result = mysql_query($sql);
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$prev\">� previous</a>";
		else
			$pagination.= "<span class=\"disabled\">� previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=1\"> 1 </a>";
				$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=2\"> 2 </a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$counter\">$counter</a>";					
				}
			}

		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?event_id=$event_id&page=$next\"> next  � </a>";
		else
			$pagination.= "<span class=\"disabled\"> next � </span>";
		$pagination.= "</div>\n";		
	
	}

?>

<table>
	<?php
	echo '<tr><th>Name</th><th>Date of Death</th><th>Age</th><th>Occupation</th><th>From</th><th>Create a Memorial</th></tr>';
		while($row = $result->fetch())
		{

	echo '<tr><td>' . $row['fname']. ' '. $row['mi'].' '. $row['lname'].'</td><td> '  . $row['dod'].'</td><td> '. $row['age'].'</td><td> ' . $row['occup']. '</td><td>'.$row['town'].' '. $row['state']. '</td><td><a href=create-memorial.php?vic_id='.$row['vic_id'].'>Create a Memorial</a></td><td>
<td>';?>
<?php if(!empty($row['mem_id'])) {echo '<a href=memorial.php?mem_id='.$row['mem_id'].'>View Memorial</a>';}
'</td></tr>';
		}

		//{
		//.if(isset($row['mem_id'])){echo 'yes';}.

?>
</table>
<br /><br />
<?=$pagination?>
<br /><br />

<h3 id="seares">Search Results</h3>
	
<?php } ?>
<?php 
if(isset($_POST['sea']) && $_POST['sm'] !==''){
$sm = trim($_POST['sm']);
$sqlsv = "SELECT * 
FROM   `victims` 
WHERE  (
		`fname` LIKE '$sm%' 
		  OR `lname` LIKE '$sm%'      
		   ) 
		   AND event_id = '$event_id'
		 ";
$qsv = $conn->prepare($sqlsv);
$qsv->execute();
$count = $qsv->rowCount();
// this is the search 
if($count ==0){echo 'Your search did not return any entries';}
else{
echo '<table>';

echo '<tr><th>Name</th><th>Date of Death</th><th>Age</th><th>Occupation</th><th>From</th><th>Create a Memorial</th></tr>';
		while($rowsv = $qsv->fetch())
		{
			echo '<tr><td>' . $rowsv['fname']. ' '. $rowsv['mi'].' '. $rowsv['lname'].'</td><td> ' . $rowsv['dod'].'</td><td> ' . $rowsv['age'].'</td><td> ' . $rowsv['occup']. '</td><td>'.$rowsv['town'].' '. $row['state']. '</td><td><a href=create-memorial.php?vic_id='.$rowsv['vic_id'].'>Create a Memorial</a></td></tr>';
		}
		echo '</table>';
		}
		}

?>

<br />

</div> <!-- end outer2 -->
</div><!-- end #wrapper -->

<div id="footer">
<div class="content">
<?php include("include/footer.php") ;?>
</div> <!-- end content -->
</div> <!-- end footer -->
</div> <!-- end wrapperA -->
	<!--<script src="js/validate.js"></script>-->
</body>
</html>
