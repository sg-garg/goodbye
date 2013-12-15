<?php // shopping-cart.php
session_start();
// Set up the cart session if it doesn't already exist
if (!isset($_SESSION['plum_shop'])) {
	$_SESSION['plum_shop'] = array();
}
// Save the cart to the session
if (isset($_POST['plum_shop'])) {
	$_SESSION['plum_shop'] = $_POST['plum_shop'];
// Retrieve the cart from the session. json_encode() requires PHP 5.2 or newer
} elseif (isset($_GET['plum_shop'])) {
	echo json_encode($_SESSION['plum_shop']);
}
exit;

?>