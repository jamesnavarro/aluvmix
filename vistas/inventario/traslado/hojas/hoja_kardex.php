<?php
require('../../../../fpdf/fpdf.php');
require('../../../../modelo/conexioni.php');
$cod=$_GET['pro'];
$print=mysqli_query($con,"SELECT * FROM productos_var WHERE codigo='".$cod."'");
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
$pdf->Cell(0, 1, 'Hoja de Kardex ', 50);
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(0, 1, 'Codigo Producto: '.$cod, 0);
$pdf->Ln(4);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(0, 1, 'Descripcion Producto: '.$datos['descripcion'], 0);
$pdf->Ln(4);
$pdf->Cell(50, 8, '', 0);
$pdf->Cell(0, 1, 'Costo Unitario: '.$datos['costo_ult_com'], 0);
$pdf->Ln(23);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 8, 'FECHA', 0);
$pdf->Cell(40, 8, 'TIPO DOCTO', 0);
$pdf->Cell(50, 8, 'NUMERO DOCUMENTO', 0);
$pdf->Cell(40, 8, 'C.ENTRADA', 0);
$pdf->Cell(40, 8, 'C.SALIDA', 0);
$pdf->Cell(20, 8, 'SALDO', 0);
$pdf->Cell(40, 8, 'SALDO INICIAL', 0);
$pdf->Cell(30, 8, 'V. TOTAL', 0);
$pdf->Ln(8);
$pdf->SetFont('Arial', '', 8);
$productos = mysqli_query($con, "SELECT mb.*, mi.tipo_movimiento, mi.num_documento  FROM mov_detalle_ubi mb
								INNER JOIN mov_inventario mi ON mi.id_mov=mb.id_mov WHERE codigo_pro='".$cod."'");
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
	$pdf->Cell(40, 5, $productos2['saldo_ubicacion'], 0);
	$pdf->Cell(30, 5, number_format($datos['costo_ult_com']*$productos2['cantidad_mov']), 0);
	$pdf->Ln(5);
}

$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(8);
$pdf->Cell(104,8,'',0);
$pdf->Cell(31,8,'',0);
$pdf->Cell(90,8,'',0);
$pdf->Cell(5,8,'Total Items. '.$item,0);

$pdf->Output('kardex.pdf','D');
?>