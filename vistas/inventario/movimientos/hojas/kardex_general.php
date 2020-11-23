<?php
require('../../../../fpdf/fpdf.php');
require('../../../../modelo/conexioni.php');
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 10, '', 0);
$pdf->Image('../../../../imagenes/logo3.png' , 10 ,10, 60 , 28,'PNG', 'http://www.templadosa.com');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(110, 8, '', 0);
$pdf->Cell(0, 1, 'Hoja de Kardex ', 50);
$pdf->Ln(20);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 8, 'CODIGO DE PRODUCTO', 0);
$pdf->Cell(60, 8, 'DESCRIPCION', 0);
$pdf->Cell(40, 8, 'STOCK GENERAL', 0);
$pdf->Cell(40, 8, 'STOCK DISPONIBLE', 0);
$pdf->Cell(40, 8, 'STOCK RESERVA', 0);
$pdf->Cell(30, 8, 'V. UNITARIO', 0);
$pdf->Cell(30, 8, 'V. TOTAL', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
$productos = mysqli_query($con, "SELECT pro.descripcion, pro.costo_ult_com, ps.* FROM pro_stock ps 
								INNER JOIN productos_var pro ON pro.codigo=ps.codigo_pro");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysqli_fetch_array($productos)){
	$item = $item+1;
	$disponible=intval($productos2['stock_actual']-$productos2['stock_res']);
	$pdf->Cell(50, 5, $productos2['codigo_pro'], 0);
	$pdf->Cell(60, 5, $productos2['descripcion'], 0);
	$pdf->Cell(40, 5, $productos2['stock_actual'], 0);
	$pdf->Cell(40, 5, $disponible, 0);
	$pdf->Cell(40, 5, $productos2['stock_res'], 0);
	$pdf->Cell(30, 5, $productos2['costo_ult_com'], 0);
	$pdf->Cell(30, 5, '$ '.number_format($productos2['stock_actual']*$productos2['costo_ult_com']), 0);
	$pdf->Ln(5);
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(8);
$pdf->Cell(104,8,'',0);
$pdf->Cell(31,8,'',0);
$pdf->Cell(90,8,'',0);
$pdf->Cell(5,8,'Total Items. '.$item,0);

$pdf->Output('kardex_general.pdf','D');
?>