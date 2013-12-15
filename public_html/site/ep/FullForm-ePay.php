<?php
 
//include "/usr/local/lib/php/usaepay.php";
include "usaepay.php";
 
$tran=new umTransaction;
 
$tran->key="GE4HaE22zaP4FlaWKnotM0t3c2c47Xa6";
$tran->ip=$REMOTE_ADDR;   // This allows fraud blocking on the customers ip address
 
$tran->testmode=1;    // Change this to 0 for the transaction to process
 
$tran->card="4005562233445564";		// card number, no dashes, no spaces
$tran->exp="0113";			// expiration date 4 digits no /
$tran->amount=".01";			// charge amount in dollars
$tran->invoice="1234";   		// invoice number.  must be unique.
$tran->cardholder="Test T Jones"; 	// name of card holder
$tran->street="1234 Main Street";	// street address
$tran->zip="05673";			// zip code
$tran->description="Online Order";	// description of charge
$tran->cvv2="435";			// cvv2 code	
 
echo "<h1>Please wait one moment while we process your card...<br>\n";
flush();
 
if($tran->Process())
{
	echo "<b>Card Approved</b><br>";
	echo "<b>Authcode:</b> " . $tran->authcode . "<br>";
	echo "<b>AVS Result:</b> " . $tran->avs . "<br>";
	echo "<b>Cvv2 Result:</b> " . $tran->cvv2 . "<br>";
} else {
	echo "<b>Card Declined</b> (" . $tran->result . ")<br>";
	echo "<b>Reason:</b> " . $tran->error . "<br>";	
	if(@$tran->curlerror) echo "<b>Curl Error:</b> " . $tran->curlerror . "<br>";	
}		
 
?>