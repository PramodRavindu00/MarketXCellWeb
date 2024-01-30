<?php


include("../php/auth.php");
require('../fpdf/fpdf.php');
require('../php/firebaseRDB.php');
include('../phpqrcode/qrlib.php');

$authobj = new Auth();

if (isset($_POST['logout'])) {
    $authobj->logout($_POST);
}


$clientname = "";
$address = "";
$orderid = "";
$paymentMode = "";

$firebaseObj = new firebaseRDB("https://marketxcell-a2edb-default-rtdb.firebaseio.com/");


if(isset($_GET['orderid'])){
  $orderId = $_GET['orderid'];
  $path = "Orders/".$orderId;
  $orderData = $firebaseObj->retrieve($path);
  $orderData = json_decode($orderData, 1);
  $clientname = $orderData['clientName'];
  $address = $orderData['clientAddress'];
  $orderid = $orderData['orderId'];
  $paymentMode = $orderData['paymentMode'];

}

//Generating QR Code
$tempDir = "../phpqrcode/generatedQR/";
QRcode::png($orderid, $tempDir.'qr.png', QR_ECLEVEL_L, 3);



// Generating PDF file
$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial','',10);
$pdf->Image("../img/Logo.png",10,5,30);
$pdf->Image("../phpqrcode/generatedQR/qr.png",170,5,30);
$pdf->Cell(45,25,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,5,'Sender:',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,5,'MarketXCell (Pvt) Ltd',0,0);
$pdf->Cell(30,5,'',0,0);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,5,'Ship to:',0,0);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,5,$clientname,0,1);

$pdf->Cell(20,5,'',0,0);
$pdf->Cell(45,5,'No 57, Miriyawatta, Ferry Road, Keselwatta,',0,0);
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(45,5,$address,0,1);

$pdf->Cell(20,5,'',0,0);
$pdf->Cell(45,5,'Panadura, Sri Lankua',0,0);
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(45,5,'Order Id: '.$orderid,0,1);

$pdf->Cell(20,5,'',0,0);
$pdf->Cell(45,5,'',0,0);
$pdf->Cell(30,5,'',0,0);
$pdf->Cell(20,5,'',0,0);
$pdf->Cell(45,5,'Payment Mode: '.$paymentMode,0,1);

$pdf->Output();

?>