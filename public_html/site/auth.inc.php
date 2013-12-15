<?php
session_start();
 if ($_POST['address'] != '' ){
die();
    } 
$newlinecounter = 0;
foreach($_POST as $key => $val_newline){
if(stristr($val_newline, '\r')){$newlinecounter++;}
if(stristr($val_newline, '\n')){$newlinecounter++;}
if(stristr($val_newline, '\\r')){$newlinecounter++;}
if(stristr($val_newline, '\\n')){$newlinecounter++;}
if(stristr($val_newline, '\r\n')){$newlinecounter++;}
if(stristr($val_newline, '\\r\\n')){$newlinecounter++;}
if(stristr($val_newline, 'Bcc')){$newlinecounter++;}
if(stristr($val_newline, 'http')){$newlinecounter++;}
if(stristr($val_newline, '<')){$newlinecounter++;}
if(stristr($val_newline, '[')){$newlinecounter++;}
if(stristr($val_newline, '<script')){$newlinecounter++;}
}
if ($newlinecounter >= 1){ die('<h1>Page not Found</h1>');}

if(isset($_POST['submit']))
{
$emc = substr_count($email_address, '@', 0);
if($emc >=2)
{
die();
}
}
// configuration
require_once('pdoconnect.inc.php');

if(isset($_POST['submit'])){
$username = $_SESSION['username'] =trim($_POST['username']);
$password =$_SESSION['password']= trim($_POST['password']);
$email_address =$_SESSION['email_address']= trim($_POST['email_address']);
}
$email_address = filter_input(INPUT_POST, 'email_address', FILTER_VALIDATE_EMAIL);

if(($username !='') && ($_POST['password'] !='')){
$sql = "SELECT userid, username, email_address, password FROM users WHERE (username = :username) OR (email_address=:email_address) AND (password = :password) LIMIT 1 " ;

$q = $conn->prepare($sql);
$q->setFetchMode(PDO::FETCH_ASSOC);
$q->bindparam(':username', $username,  PDO::PARAM_STR);
$q->bindparam(':password', $password,  PDO::PARAM_STR);
$q->bindparam(':email_address', $username,  PDO::PARAM_STR);
$q->execute();
$row = $q->fetch();
}
if(isset($_POST['submit']) &&(($row['username']===$_POST['username']) || ($row['email_address']===$_POST['username']) && ($row['password']===$_POST['password'] ))) {

echo "Welcome " . $row['username'] ." your ID number is " .$row['userid']; 

$_SESSION['ver'] = 1;
header("location:dashboard.php");
}else{

if(($row['username']!==$_POST['username']) && $row['password']!==$_POST['password'] ){

echo 'Sorry, your user name or password did not match'; 
$_SESSION['ver'] = 0;
}
}
$_SESSION['userid'] = $row['userid'];
?>
<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<title>eGoodbyes - Say Goodbye Now, Be Remembered Forever</title>
<script src="js/jquery.js"></script>
<script src="js/jquery.plum.form.js"></script>
<link rel="stylesheet" href="new/css/default.ie7.css">
<link rel="stylesheet" href="css/design3-style.css" type="text/css" media="all" />
<link rel="stylesheet" href="css/default.css">
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
.important	{
	visibility:hidden;
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


<h1>Please Log Into Your EGoodbyes Account</h1>
<table>
<form action="" method="post">
<tr><td>Username</td><td> <input type="text" id="email" name="username" placeholder = "Email or Username" required /></td></tr>
<tr><td>Password</td><td> <input type="password" name="password" id = "password" required placeholder="Password" /></td></tr>
<tr class="important"><td class="important">Address</td><td class="important"> <input type="text" name="address"  /></td></tr>
<tr><td><input type="submit" name="submit" value="Log In" /></td></tr>
</form>
</table>
<br />

<h2>Not a Member Yet?</h2>
<form action="../new/register_form.php"><br>
<input type="submit" value="Register for FREE" />
</form>

<br /><br />
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
