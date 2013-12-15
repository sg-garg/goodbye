<?php
error_reporting(0);
session_start();
if((isset($_SESSION['is_admin'])) && $_SESSION['is_admin'] == 'true' ){
}else{
echo 'Access Denied';
header("location:login.php");
}
?>