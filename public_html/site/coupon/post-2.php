<?php
// if data are received via POST, with index of 'test'
if (isset($_POST['test'])) {
    $file  = fopen('test.csv', 'r');
    $coupon = array($_POST['test']); 
    $coupondef = $_POST['test'];             // get data
    $coupon = array_map('preg_quote', $coupon);
    $regex = '/'.implode('|', $coupon).'/i';
    while (($line = fgetcsv($file)) !== FALSE) {  
    list($promocode, $amount) = $line;

    if(preg_match($regex, $promocode)) {
        echo "Coupon: '<i>".$coupondef."</i> is valid, with ".$amount."% of discount";
        exit; // match made, stop the php file now
    } 
}

// if you get here you know there was no match

 echo "Coupon: '<i>".$coupondef."</i> is invalid.";
 
?> 