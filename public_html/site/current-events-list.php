<?php 
session_start();
require_once("pdoconnect.inc.php");
$catid = null;

if (isset($_GET['categoryid']))
{
  // param was set in the query string
   if(!empty($_GET['categoryid']))
   {
     // query string had param set to nothing ie ?param=&param2=something
       $catid = $_GET['categoryid'];
   }
}

if ($catid != '*'){
    if (!is_numeric($catid))
        $catid = null;
    else
        $catid = intval($catid);
}

// Get categories which are in use
$catSQL = 'select distinct EC.name, EC.eventcatid, EC.isdefault from eventcat EC   
    inner join event E
    on EC.eventcatid = E.eventcatid
    order by sequence, name
';
$catqs = $conn->prepare($catSQL);
$catqs->execute();

$filter = 'EC.eventcatid = :catid';
$args = array(':catid' => $catid );

if ($catid == null){
    $filter = 'EC.isdefault = 1';
    $args = array();    
}
else if ($catid == "*")
{
    $filter = '1=1';
    $args = array();    
}



$sqls = "
    SELECT E.* FROM event E 
    left join eventcat EC
    on E.eventcatid = EC.eventcatid
    where " . $filter . "
    ORDER BY eventdate DESC ";

$myCatSeen = $catid == "*";
$rows = array();
while($row = $catqs->fetch()){
    if ($catid == $row['eventcatid'] ||
        ($catid == null &&  $row['isdefault'] == 1))         
        $myCatSeen = true;
    array_push($rows, $row);
}
if (!$myCatSeen)
{
    // Redirect to default
    if ($catid == null)
        header("Location: current-events-list.php?categoryid=*");
    else
        header("Location: current-events-list.php?categoryid=");
}


?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>Memorials</title>
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
width:840px;
	margin:0px auto;
	background-color:#D8E0E4;
	overflow:hidden;
	text-align:left;
	padding:20px 10px 20px 30px;
	}

h1	{
	color:#000;}
.imgshadow	{
	box-shadow: 0px 8px 8px #111;
	
	}
.fltright	{
	float:right;
	}
.center	{
	text-align:center;}



a.MoreLink
{    
    color: #649BF5;
    display: block;
    margin: 12px 0;
}

div.Hero > a.Event
{    
    display:block;
    color: rgb(10, 15, 50);
    text-decoration: none;
    font-size: large;
    margin-bottom: 12px;
}

div.Sidebar
{
    width: 200px;
    float: left;
}
div.Hero
{
    width: 600px;
    margin: 0 20px;
    float: left;
    color: Gray;
}

div.Sidebar ul
{
    margin: 0;
    padding: 0;
}

div.Sidebar ul > li
{
    list-style-type: none;
    background-color: #64D2F5;    
    margin: 0 0 12px 0;
    padding: 0;
    border: solid 1px rgb(10, 15, 50);
}

div.Sidebar ul > li.Active
{
    background-color: rgb(10, 15, 50);    
    border: solid 1px #64D2F5;
}

a.CatLink
{
    color: rgb(10, 15, 50);
    text-decoration: none;
    display: block;
    width: 100%;
    margin: 5px 5px;
    padding: 0;
}
li.Active > a.CatLink
{
    color: #64D2F5;
}

div.SidebarTitle
{
    font-size: large;
    color: rgb(10, 15, 50);
    margin-bottom: 12px;
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
			<div class="content"><br></div>
		</div>
			
			
<div class="content">
<div id="main">

<?php 

$qs = $conn->prepare($sqls);
$qs->execute($args);



echo '<div class="Sidebar"><div class="SidebarTitle">Categories</div><ul>';
$class = 'Active';
if ($catid != '*') $class = '';
echo '<li class="' . $class . '"><a class="CatLink" href="current-events-list.php?categoryid=*">All</a></li>';
foreach($rows as $row){
    $class = '';
    if ($catid == $row['eventcatid'] ||
        ($catid == null && $row['isdefault'] == 1))
        $class = 'Active';
    
    echo '<li class="'.$class .'"><a class="CatLink" href="current-events-list.php?categoryid=' . 
            htmlspecialchars( $row['eventcatid']) . '">' . htmlspecialchars( $row['name']);
    echo '</li>';
}
echo '<li><a class="CatLink" href="public-memorials.php">Public Memorials</a></li>';
echo '</ul></div><div class="Hero">';


$introTextLength = 200;
while($row = $qs->fetch()){
//abcdefghijklmnotprstuvwxyz
echo '<a class="Event" href="current-events.php?event_id='.$row['event_id'].'">'. htmlspecialchars($row['event']) .'</a>';

$paragraph = $row['story'] ;
 
$rough_short_par = substr($paragraph, 0, $introTextLength); //chop it off at 80
$last_space_pos = strrpos($rough_short_par, " "); //search from end: http://uk.php.net/manual/en/function.strrpos.php
$clean_short_par = substr($rough_short_par, 0, $last_space_pos);
$more = '';
// JRH add three dots if we cut off
if (strlen($paragraph) > $last_space_pos)
    $more = '...';
// add three dots...
$clean_sentence = $clean_short_par . $more . '<a class="MoreLink" href=current-events.php?event_id='.$row['event_id'].'>Read more</a>'; //could link the read more to full article
echo $clean_sentence;
}

?>
</div><!-- Hero -->

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
