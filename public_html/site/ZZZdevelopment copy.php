<p>&copy; 2013 eGoodbyes</p>

<?php

//if($_SESSION['userid'] == '47' || $_SESSION['userid'] == '48') {

if($_SESSION['userid'] == '5034567abcde'){
		$uid = $_SESSION['userid'];
		$ulv = $_SESSION['user_level'];
			if(isset($_GET['plan'])) {$flag = $_GET['plan'];}

		echo "<table width=\"500\" border=\"1\"><tr><td>Currently under USER: $uid</td><td>";
		echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"get\"><input type=\"hidden\" name=\"uid\" value=\"$uid\"><select name=\"plan\" size=\"1\"><option value=\"\">Change Plan</option>";

if ($ulv == 0){
		echo "<option selected value=\"0\">Level 0 - Free</option>
		<option value=\"1\">Level 1</option>
		<option value=\"2\">Level 2 - Standard</option>
		<option value=\"3\">Level 3 - Premium</option>\n";
}
if ($ulv == 1){
		echo "<option value=\"0\">Level 0 - Free</option>
		<option selected value=\"1\">Level 1</option>
		<option value=\"2\">Level 2 - Standard</option>
		<option value=\"3\">Level 3 - Premium</option>\n";
}
if ($ulv == 2){
		echo "<option value=\"0\">Level 0 - Free</option>
		<option value=\"1\">Level 1</option>
		<option selected value=\"2\">Level 2 - Standard</option>
		<option value=\"3\">Level 3 - Premium</option>\n";
}
if ($ulv == 3){
		echo "<option value=\"0\">Level 0 - Free</option>
		<option value=\"1\">Level 1</option>
		<option value=\"2\">Level 2 - Standard</option>
		<option selected value=\"3\">Level 3 - Premium</option>\n";
}
echo "</select><input type=\"submit\" value=\"GO\"></form></td></tr></table>";

		if (isset($flag)){
		$sql = mysql_query("UPDATE users SET user_level='$flag' WHERE userid='$uid'");
		$_SESSION['user_level'] = $flag;
		}

		echo "<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>";
}

if($_SESSION['userid'] == '47') {
		// Must fully define user levels
		// Level 0 - Free membership (default)
		// Level 1 - Memorial plan (2.99)
		// Level 2 - Standard Goodbyes (14.99)
		// Level 3 - Premium Paid (24.99)
		// Level 4 - Single Memorial Only  
		// Level 5 - Test Level / extra

		//print the transaction data for liked_facebook
		if(isset($data1)) {print_r ($data1);}

			$uid = $_SESSION['userid'];
			$ulv = $_SESSION['user_level'];

		if(isset($_GET['plan'])) {$flag = $_GET['plan'];}

		echo "<table width=\"500\" border=\"1\"><tr><td>Currently under USER: $uid</td><td>";
		echo "<form action=\"" . $_SERVER['PHP_SELF'] . "\" method=\"get\"><input type=\"hidden\" name=\"uid\" value=\"$uid\"><select name=\"plan\" size=\"1\"><option value=\"\">Change Plan</option>";

if ($ulv == 0){
		echo "<option selected value=\"0\">Level 0 - Free</option>
		<option value=\"1\">Level 1</option>
		<option value=\"2\">Level 2 - Standard</option>
		<option value=\"3\">Level 3 - Premium</option>\n";
}
if ($ulv == 1){
		echo "<option value=\"0\">Level 0 - Free</option>
		<option selected value=\"1\">Level 1</option>
		<option value=\"2\">Level 2 - Standard</option>
		<option value=\"3\">Level 3 - Premium</option>\n";
}
if ($ulv == 2){
		echo "<option value=\"0\">Level 0 - Free</option>
		<option value=\"1\">Level 1</option>
		<option selected value=\"2\">Level 2 - Standard</option>
		<option value=\"3\">Level 3 - Premium</option>\n";
}
if ($ulv == 3){
		echo "<option value=\"0\">Level 0 - Free</option>
		<option value=\"1\">Level 1</option>
		<option value=\"2\">Level 2 - Standard</option>
		<option selected value=\"3\">Level 3 - Premium</option>\n";
}

echo "</select><input type=\"submit\" value=\"GO\"></form></td></tr></table>";

		if (isset($flag)){
		$sql = mysql_query("UPDATE users SET user_level='$flag' WHERE userid='$uid'");
		$_SESSION['user_level'] = $flag;
		}


echo "<br><br>\n";
echo "<h2><a href=\"video-player-list.php\"><b style=\"color:red\">ADMIN:</b> Edit Video List</a></h2>\n";

// Request Key / Value
echo "<table width=\"575\" border=\"1\"><tr><th>Request Key</th><th>Value</th></tr>\n";
		foreach($_REQUEST as $name => $value) {
		echo "<tr><td>$name</td><td>$value</td></tr>\n";
		}
echo "</table><br>";

// POST Key / Value
echo "<table width=\"575\" border=\"1\"><tr><th>Post Key</th><th>Value</th></tr>\n";
		foreach($_POST as $name => $value) {
		echo "<tr><td>$name</td><td>$value</td></tr>\n";
		}
echo "</table><br>";


// Session Key / Value
echo "<table width=\"575\" border=\"1\"><tr><th>Session Key</th><th>Value</th></tr>\n";
		foreach($_SESSION as $name => $value) {
		echo "<tr><td>$name</td><td>$value</td></tr>\n";
		}
echo "</table><br>";

// Cookie Key / Value
echo "<table width=\"575\" border=\"1\"><tr><th>Cookie</th><th>Value</th></tr>\n";
		foreach ($_COOKIE as $key=>$val) {
		echo "<tr><td>$key</td><td>$val</td></tr>\n";
		}
echo "</table><br><br>";

}




?>

