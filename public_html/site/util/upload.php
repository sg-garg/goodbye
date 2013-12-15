<?php
session_start();
include '../db.php';
if(isset($_SESSION['userid'])){

$userid = $_SESSION['userid'];
$ul_file_name = $userid . ".jpg";
} else {
echo "* * * error * * *";
}

   // Edit upload location here
   // $destination_path = getcwd(). "/avatar/";
   $destination_path = "../avatar/";

   $result = 0;
   
//   $target_path = $destination_path . basename($_FILES['myfile']['name']);
   $target_path = $destination_path . basename($ul_file_name);


//   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {
   if(@move_uploaded_file($_FILES['myfile']['tmp_name'], $target_path)) {  
      $result = 1;

      $sql = mysql_query("UPDATE users SET avatar = '$ul_file_name' WHERE userid = '$userid'");
      
   }
   
   sleep(1);
?>

<script language="javascript" type="text/javascript">window.top.window.stopUpload(<?php echo $result; ?>);</script>   
