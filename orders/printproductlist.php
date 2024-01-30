<?php

include ("../php/auth.php");

if(!isset($_SESSION['email'])){
  header("Location: ../auth/login.php");
}

require('../fpdf/fpdf.php');
require('../php/firebaseRDB.php');

$pdf = new FPDF('p','mm','A4');
$pdf->AddPage();

$firebaseObj = new firebaseRDB("https://marketxcell-a2edb-default-rtdb.firebaseio.com/");

$agentid = "";
$orderid = "";
$cartId = "";
$productList;

if(isset($_GET['orderid'])){
  $orderId = $_GET['orderid'];
  $path = "Orders/".$orderId;
  $orderData = $firebaseObj->retrieve($path);
  $orderData = json_decode($orderData, 1);
  $cartId = $orderData['cartId'];
  $orderid = $orderData['orderId'];
  $agentid = $orderData['agentId'];
}


$pdf->SetFont('Arial','B',20);
$pdf->Cell(71,10,'',0,0);
$pdf->Cell(59,5,'Product List',0,0);
$pdf->Cell(59,10,'',0,1);

$pdf->SetFont('Arial','B',15);
$pdf->Cell(50,10,'',0,0);
$pdf->Cell(50,10,'',0,0);
$pdf->Cell(74,10,'Details',0,1);

$pdf->SetFont('Arial','B',10);

$pdf->Cell(100,5,'',0,0);
$pdf->Cell(25,5,'Order ID: ',0,0);
$pdf->Cell(64,5,$orderid,0,1);

$pdf->Cell(100,5,'',0,0);
$pdf->Cell(25,5,'Agent No: ',0,0);
$pdf->Cell(64,5,$agentid,0,1);

$pdf->Cell(50,10,'',0,1);

// Heading of the table 
$pdf->SetFont('Arial','B',10);
$pdf->Cell(15,6,'No',1,0,'C');
$pdf->Cell(40,6,'Product Id',1,0,'C');
$pdf->Cell(60,6,'Product Name',1,0,'C');
$pdf->Cell(23,6,'Qty',1,0,'C');
$pdf->Cell(50,6,'Unit Price',1,1,'C');


// Body of the table
$pdf->SetFont('Arial','',10);

$path = "cartItems/".$agentid."/".$cartId;
$ProductData = $firebaseObj->retrieve($path);
$ProductData = json_decode($ProductData, 1);
// print_r($ProductData);
if(is_array($ProductData)){
  foreach($ProductData as $id => $product){
    $pdf->Cell(15,6,'01',1,0,'C');
    $pdf->Cell(40,6,$product['ProductId'],1,0,'C');
    $pdf->Cell(60,6,$product['ProductName'],1,0,'C');
    $pdf->Cell(23,6,$product['qty'],1,0,'C');
    $pdf->Cell(50,6,$product['unitPrice'],1,1,'C');
  }
}



$pdf->Output();

?>