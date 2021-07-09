<?php
//import pdf
require('fpdf/fpdf.php');

include('connectdb.php');

$id = $_GET['id'];

$select = $pdo->prepare("select * from tbl_invoice where invoice_id = $id");
$select->execute();

$row = $select->fetch(PDO::FETCH_OBJ);



$pdf = new FPDF('P','mm',array(80,200));

$pdf->AddPage();


$pdf->SetFont('Arial','B',16);
$pdf->cell(60,8,'Prachi Enterprise.',1,1,'');



$pdf->SetFont('Arial','B',8);

$pdf->cell(60,5,'Address : ShivPuri,Boring Rd,  Patna-800020',0,1,'C');

//$pdf->SetFont('Arial','',10);
//$pdf->cell(112,5,'Invoice : #12345',0,1,'C');



$pdf->cell(60,5,'Phone Number : 12345',0,1,'C');


//$pdf->SetFont('Arial','',10);
//$pdf->cell(112,5,'Date : 12-02-19',0,1,'C');



$pdf->cell(60,5,'Email Id : test@gmail.com',0,1,'C');
$pdf->cell(60,5,'Website : test@gmail.com',0,1,'C');

$pdf->Line(7,38,72,38);

$pdf->Ln(1);


$pdf->SetFont('Arial','BI',8);
$pdf->cell(20,4,'Bill To :',0,0,'');

$pdf->SetFont('Courier','BI',8);
$pdf->cell(40,4,$row->customer_name,0,1,'');

$pdf->SetFont('Arial','BI',8);
$pdf->cell(20,4,'Invoice Id :',0,0,'');


$pdf->SetFont('Arial','BI',8);
$pdf->cell(40,4,$row->invoice_id,0,1,'');

$pdf->SetFont('Arial','BI',8);
$pdf->cell(20,4,'Date :',0,0,'');


$pdf->SetFont('Arial','BI',8);
$pdf->cell(40,4,$row->order_date,0,1,'');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(34,5,'PRODUCT',1,0,'C');
$pdf->cell(11,5,'QTY',1,0,'C');
$pdf->cell(8,5,'PRICE',1,0,'C');
$pdf->cell(12,5,'TOTAL',1,1,'C');

$select = $pdo->prepare("select * from tbl_invoice_details where invoice_id = $id");
$select->execute();

while($item = $select->fetch(PDO::FETCH_OBJ)){
	$pdf->SetX(7);
	$pdf->SetFont('Helvetica','B',8);
	$pdf->cell(34,5,$item->product_name,1,0,'L');
	$pdf->cell(11,5,$item->qty,1,0,'C');
	$pdf->cell(8,5,$item->price,1,0,'C');
	$pdf->cell(12,5,$item->price*$item->qty,1,1,'C');

}


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'SubTotal',1,0,'C');
$pdf->cell(25,5,$row->subtotal,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'Tax(5%)',1,0,'C');
$pdf->cell(25,5,$row->tax,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'Discount',1,0,'C');
$pdf->cell(25,5,$row->discount,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'GrandTotal',1,0,'C');
$pdf->cell(25,5,$row->total,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'Paid',1,0,'C');
$pdf->cell(25,5,$row->paid,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'Due',1,0,'C');
$pdf->cell(25,5,$row->due,1,1,'C');


$pdf->SetX(7);
$pdf->SetFont('Courier','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(20,5,'',0,'L');
//$pdf->cell(20,10,'',0,'C');
$pdf->cell(25,5,'Payment Type',1,0,'C');
$pdf->cell(25,5,$row->payment_type,1,1,'C');

$pdf->cell(20,5,'',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Arial','B',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(25,5,'Important Notice :',0,1,'');

$pdf->SetX(7);
$pdf->SetFont('Arial','',8);
//$pdf->SetFillColor(205,205,205);
$pdf->cell(75,5,'No Item Will Be Replaced Or Refunded.',0,2,'');



$pdf->Output();