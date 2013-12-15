<html> 

<head> 
<title>Parse Output</title>

</head>

<body bgcolor="white" text="blue">

<h1>Variables Received (output), $_POST</h1>
<?php

    // Read incoming POST request
    if (!empty($_POST)){
        $params = join(" ", $_POST);
        //print_r($params);
        echo "|$params|" . "|";
    }
?>
    
 <h1>Variables Received (output), $_REQUEST</h1>   
        
<?php

// Read incoming POST request (Experiment with $_GET, $_POST, and $_REQUEST)
    if (!empty($_REQUEST)){
        $params = join(" ", $_REQUEST);
        //print_r($params);
        echo "|$params|" . "|";
    }
    

// Print params & timestamp to file called listenerLog.txt
// $logFile = "http://travisng.com/listenerLog.txt";

// $fileHandle = fopen($logFile, 'a') or die("Unable to open the listenerLog.txt.");
// fwrite($fileHandle, $params);
// fclose($fileHandle);

// $output = file_get_contents($logFile);

// Print listenerLog.txt
//echo $output;

?>

</body>

</html>




