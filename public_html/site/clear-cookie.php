<?php

setcookie ("access", "", time() - 3600);

echo "<p><b>DEVELOPMENT</b><br>";
// for development, print out ALL sent variables
foreach($_REQUEST as $name => $value) {
print "$name : $value\n";
}
echo "</p><hr>";

echo "<p><b>SESSION:</b><br>\n";
print_r ($_SESSION);
echo "</p>";

?>