<?php
require_once("pdoconnect.inc.php");
require('fpdf/fpdf.php');
if(isset($_GET['submit'])){
$userid = trim($_GET['userid']);
$poc_id = trim($_GET['poc_id']);
$msg_id = trim($_GET['msg_id']);

$sql = "SELECT * FROM gb_messages WHERE userid = '$userid' AND msg_id ='$msg_id' AND poc_id = '$poc_id' LIMIT 1";
$q = $conn->prepare($sql);
$q->execute();
$row = $q->fetch();
if (isset($_GET['submit']) && $_GET['userid'] === $row['userid'] && $_GET['msg_id'] === $row['msg_id'] && $_GET['poc_id'] === $row['poc_id']){ 
}
$salutation = $row['salutation'];
$message = $row['message'];
$msg_date = $row['msg_date'];

$sqlu = "SELECT * FROM users WHERE userid ='$userid'";
$qu = $conn->prepare($sqlu);
$qu->execute();
$rowu = $qu->fetch();

$name = $rowu['first_name']. ' '. $rowu['middle_name'].' ' .$rowu['last_name'];
$street = $rowu['street_address'];
$csz = $rowu['city'].' ' .$rowu['state']. ' '  .$rowu['zip'];

$sqlpoc = "SELECT * FROM pocontact WHERE userid ='$userid' AND poc_id ='$poc_id'";
$qpoc = $conn->prepare($sqlpoc);
$qpoc->execute();
$rowpoc = $qpoc->fetch();

$rname = $rowpoc['recipient_fn']. ' '. $rowpoc['recipient_mi'].' ' .$rowpoc['recipient_ln'];
$rstreet = $rowpoc['usps_mail']. ' ' . $rowpoc['usps_mail2'];
$rcsz = $rowpoc['city'].' ' .$rowpoc['state']. ' '  .$rowpoc['zip'];

//$address = 'sometext';
class PDF extends FPDF
{
// Page header
function Header()
{
    // Logo
    $this->Image('../img_3/egoodbyes_transparent-1.jpg',90,6,30);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Move to the right
    $this->Cell(80);
    // Title
    $this->Cell(30,10,'',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,'2405 Ivan Street, Bethlehem Pa 18020',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

    $pdf->Cell(0,5,'From:',0,1);
	 $pdf->Cell(0,5,$name,0,1);
	 $pdf->Cell(0,5,$street,0,1);
	 $pdf->Cell(0,5,$csz,0,1);
	$pdf->Cell(0,5,'To:',0,1);
	 $pdf->Cell(0,5,$rname,0,1);
	 $pdf->Cell(0,5,$rstreet,0,1);
	 $pdf->Cell(0,5,$rcsz,0,1);
	//$pdf->Cell(0,10,'This message was created on ' . $msg_date,0,1);
	$pdf->Cell(0,10,$salutation,0,1);
	 $pdf->MultiCell(0,5,$message , 0,1);
$pdf->Output();
?>

<!DOCTYPE html>  
<html lang="en">  
<head> 
<meta charset="utf-8">   
<meta name="description" content="" />
<title>untitled</title>  
<style>

</style>
</head>  
<body>
<?php }else{
header('Location:get-goodbye-message.php');
}
?>
</body>
</html>
