<?php
/*
|-----------------
| Chip Download Class
|------------------
*/

require_once("fileDLclass-downloadFLV.php");

/*
|-----------------
| Class Instance
|------------------
*/

//$download_path = "http://www.egoodbyes.com/dir/";
//$download_path = "/dir/";
//$download_path = "/usr/local/red5/webapps/oflaDemo/streams/";
$download_path = "/home/goodbye/public_html/dir/";

$file = $_REQUEST['f'];

$args = array(
		'download_path'		=>	$download_path,
		'file'				=>	$file,		
		'extension_check'	=>	TRUE,
		'referrer_check'	=>	FALSE,
		'referrer'			=>	NULL,
		);
$download = new chip_download( $args );

/*
|-----------------
| Pre Download Hook
|------------------
*/

$download_hook = $download->get_download_hook();
//$download->chip_print($download_hook);
//exit;

/*
|-----------------
| Download
|------------------
*/

if( $download_hook['download'] == TRUE ) {

	/* You can write your logic before proceeding to download */
	
	/* Let's download file */
	$download->get_download();

}

?>
