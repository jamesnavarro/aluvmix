<?php
require('../../../../fpdf/fpdf.php');
require('../../../../modelo/conexioni.php');
$cod=$_GET['tipo'];
$print=mysqli_query($con,"SELECT * FROM tipos_movimientos WHERE codigo_tm='".$cod."'");
$datos=mysqli_fetch_assoc($print);
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(5, 10, '', 0);
$pdf->Image('../../../../imagenes/logo3.png' , 10 ,10, 60 , 28,'PNG', 'http://www.templadosa.com');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(15);
$pdf->SetFont('Arial', 'B', 20);
$pdf->Cell(110, 8, '', 0);
$pdf->Cell(0, 1, 'INFORME DE MOVIMIENTOS ', 50);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(0, 1, 'Codigo Movimiento: '.$cod, 0);
$pdf->Ln(4);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(0, 1, 'Descripcion Movimiento: '.$datos['movimiento'], 0);
$pdf->Ln(4);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(0, 1, 'Observacion: '.$datos['observacion'], 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, 'FECHA', 0);
$pdf->Cell(40, 8, 'TIPO DOCTO', 0);
$pdf->Cell(50, 8, 'NUMERO DOCUMENTO', 0);
$pdf->Cell(40, 8, 'C.ENTRADA', 0);
$pdf->Cell(40, 8, 'C.SALIDA', 0);
$pdf->Cell(20, 8, 'SALDO', 0);
$pdf->Cell(40, 8, 'UBICACION', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
$productos = mysqli_query($con, "SELECT mb.*, mi.tipo_movimiento, mi.num_documento  FROM mov_detalle_ubi mb
								INNER JOIN mov_inventario mi ON mi.id_mov=mb.id_mov WHERE mi.codigo_tm='".$cod."'");
$item = 0;
$totaluni = 0;
$totaldis = 0;
while($productos2 = mysqli_fetch_array($productos)){
	$item = $item+1;
	$pdf->Cell(30, 5, $productos2['fecha_mov'], 0);
	$pdf->Cell(40, 5, $productos2['tipo_movimiento'], 0);
	$pdf->Cell(50, 5, $productos2['num_documento'], 0);
	$pdf->Cell(40, 5, $productos2['cantidad_in'], 0);
	$pdf->Cell(40, 5, $productos2['cantidad_out'], 0);
	$pdf->Cell(20, 5, $productos2['cantidad_mov'], 0);
	$pdf->Cell(40, 5, $productos2['ubicacion'], 0);
	$pdf->Ln(5);
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(8);
$pdf->Cell(104,8,'',0);
$pdf->Cell(31,8,'',0);
$pdf->Cell(90,8,'',0);
$pdf->Cell(5,8,'Total Items. '.$item,0);

$pdf->Output('informe_movimientos.pdf','D');
?>