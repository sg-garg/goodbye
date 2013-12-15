<?php 
require_once("authhead.php");
require_once("authadmin.php");
require_once("pdoconnect.inc.php");
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

#main	{
width:880px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	}
</style>
</head>

<body>

<div id="minMax">
<div id="header">
<div align="center">
<img src="img/eGoodbyes-COVER2.jpg" alt="eGoodbyes" height="200" width="900" border="0"><br>
<?php include("include/nav-main.php"); ?>
</div> <!-- end of center -->
<div class="content">
<div id="main">

<p><a href="event-catadmin.php">Go to Category Maintenance</a></p>
<h2><a href="event-input.php">Enter New Event</a></h2>

<?php 

$sql = "SELECT E.eventdate as 'E.eventdate', E.event as 'E.event', E.event_id as 'E.event_id', EC.name as 'EC.name' 
    FROM event E left join eventcat EC on E.eventcatid = EC.eventcatid
    order by E.event
";
$q = $conn->prepare($sql);
$q->execute();
//$rowid=$q->fetch();

echo '<table>';
echo '<tr><th>Date</th><th>Name of Event</th><th>Event Id </th><th>Category</th><th /></tr>';
while($row = $q->fetch())//remove extra ) when no loop
{
    $cat = $row['EC.name'];
    if ($cat == null || $cat == ''){
        $cat = 'Warning: No Category';
    }
    
echo '<tr><td>'.$row['E.eventdate'].'</td><td>'.$row['E.event'].'</td><td>'.$row['E.event_id'].'</td><td>' .
        htmlspecialchars($cat).
        '</td><td><a href="event-update.php?event_id='.$row['E.event_id'].'">Edit</a></td></tr>';
}
echo '</table>';

?>
<h2><a href="victim-input.php">Enter New Victim</a></h2>

<?php 

$sqlv = "SELECT * FROM victims";
$qv = $conn->prepare($sqlv);
$qv->execute();
echo '<table>';
echo '<tr><th>Name</th><th>Age</th><th>Event Id </th></tr>';
while($rowv = $qv->fetch())//remove extra ) when no loop
{
echo '<tr><td>'.$rowv['lname'].','.$rowv['fname'].'</td><td>'.$rowv['age'].'</td><td>'.$rowv['event_id'].'</td><td><a href="victim-update.php?vic_id='.$rowv['vic_id'].'">Edit</a></td></tr>';
}
echo '</table>';
?>



</div><!--eo main-->
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
</body>
</html>
