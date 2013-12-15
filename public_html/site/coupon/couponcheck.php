<?php
// if data are received via POST, with index of 'codeoption'
if (isset($_POST['codeoption'])) {
	$promocodevalid = false;
	$file  = fopen('groupon-codes.csv', 'r');
	$coupon = array($_POST['codeoption']); 
	$coupondef = $_POST['codeoption'];             // get data
	if ($_POST['codeoption'] == ""){
	$promocode = "0";
	$ab ="0";
	}
	
	$coupon = array_map('preg_quote', $coupon);
	$regex = '/'.implode('|', $coupon).'/i';
	while (($line = fgetcsv($file)) !== FALSE) {  
		list($promocode, $famount) = $line;

           if(preg_match($regex, $promocode)) {
           $ab = sprintf ("%.2f", $famount);
		echo "Coupon: '<i>" . $coupondef . "</i>' is valid, with $" . $ab . " discount.";
		echo "<input id=\"discCode\" type=\"hidden\" value=\"$ab\" />";

			$promocodevalid = true;
               break;
           }
        }
	if(!$promocodevalid) {
	echo "Coupon: '<i>".$coupondef."</i> is invalid.";
	}
    }
    ?> 