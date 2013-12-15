<?php 
require_once("authhead.php");
require_once("pdoconnect.inc.php");
$userid = $_SESSION['userid'];
$msg_id = $_SESSION['msg_id']; 
$poc_id = $_SESSION['poc_id'];

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
<?php $sql = "SELECT videoname FROM mem_vid_upload WHERE videoname ='cj_63061.wmv' ";
$q = $conn->prepare($sql);
$q->execute();

$row = $q->fetch();
echo "<src=/mem_vid_upload/".$row[videoname].">";
?>
</body>
</html>
