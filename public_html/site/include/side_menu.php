
<p>&nbsp;&nbsp;&nbsp;&#8226; <a href="like_us.php">Facebook</a></p>
<p>&nbsp;&nbsp;&nbsp;&#8226; <a href="like_us.php">Twitter</a></p>

<?php
if(isset($_SESSION['userid'])){

echo "<p>Logged in as " . $_SESSION['first_name'] ." ". $_SESSION['last_name'] . ".<br><a href=\"logout.php\">Not you?</a></p>";
echo "<br><br>";

echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"logout.php\">Log Out</a></p>";
echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"lost_password.php\">Lost Password</a></p>";

echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"my_account.php\">My Account</a></p>\n";

} else {

echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"login.php\">Login</a></p>";
echo "<p>&nbsp;&nbsp;&nbsp;&#8226; <a href=\"register_form.php\">Register</a></p>";

}


?>
