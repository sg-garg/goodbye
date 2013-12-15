<?php
error_reporting(0);
session_start();
if((isset($_SESSION['username']) && $_SESSION['ver']===1)){
}else{
if((!isset($_SESSION['username']) && $_SESSION['ver']!==1)){
echo 'oops';
header("location:login.php");
}
}

?>