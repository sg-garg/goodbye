<?php 
session_start();
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_SESSION['userid'];
$poc_id = $_SESSION['poc_id'];
if(isset($_GET['del'])){
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>untitled</title>  
<style>

</style>
</head>  
<body>
<?php echo $poc_id. '<br />'. $msg_id. '<br />'. $userid;?><br />
<?php 
$sqlr = "SELECT *  FROM  pocontact WHERE userid =:userid AND poc_id = :poc_id LIMIT 1 ";
$qr = $conn->prepare($sqlr);
$qr->execute(array(':userid'=>$userid, ':poc_id'=>$poc_id));
while($rowr = $qr->fetch()){
echo '<b>Your message to ' . $rowr['recipient_fn']. ' '.$rowr['recipient_mi']. ' '.$rowr['recipient_ln']. ' -'. $rowr['relation'].' ';
}
echo 'is about to be deleted </b><br />';
 
?>
<p>Are You Sure?</p>
<form name="delyes" action="" method="get" >
<input type="submit" name="delyes" value="Delete" />
</form>

<?php 
}else{
if(isset($_GET['delyes'])){
$sql = "DELETE FROM  pocontact WHERE userid =:userid AND poc_id = :poc_id  ";
$q = $conn->prepare($sql);
$q->execute(array(':userid'=>$userid, ':poc_id'=>$poc_id));

if($q  == true){echo 'Your Message was Deleted';
}else{
if($q == false){echo 'false';}
 }
 }
 }
?>
<p><a href="dashboard.php">Return to Dashboard</a></p>
</body>
</html>
