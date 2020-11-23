<?php
include '../../../modelo/conexioni.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

$id_mov=$_POST['id_mov'];
$id_ref_mov=$_POST['id_ref_mov'];
$pro_codigo=$_POST['pro_codigo'];
$cantidad=$_POST['cantidad'];
$ubic=$_POST['ubic'];

$sql=mysqli_query($con, "SELECT cantidad_mov FROM mov_detalle_ubi WHERE id_mov='$id_mov' and ubicacion='$ubic'");
if(mysqli_num_rows($sql)>0){
	$resul=mysqli_fetch_assoc($sql);
	$upd=mysqli_query($con, "UPDATE mov_detalle_ubi SET cantidad_mov=(cantidad_mov + '$cantidad'), cantidad_in='$cantidad', saldo_ubicacion='".$resul['cantidad_mov']."' WHERE id_mov='$id_mov' and ubicacion='$ubic'");
	if($upd){
		$data = array("result" => "1");
		echo json_encode($data);
	}else{
		$data = array("result" => "0");
		echo json_encode($data);
	}
}else{
	$inst=mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`id_mov`, `id_ref_mov`, `codigo_pro`, `ubicacion`, `cantidad_mov`, `saldo_ubicacion`, `fecha_mov`, `usuario`, `estado_mu`, `cantidad_in`, `tipo_mov`) VALUES ('$id_mov','$id_ref_mov','$pro_codigo','$ubic','$cantidad','0','".$fecha_hoy."','".$_SESSION['k_username']."','0', '".$_POST['cantidad']."','ENTRADA')");
	if($inst){
		$data = array("result" => "1");
		echo json_encode($data);
	}else{
		$data = array("result" => "0");
		echo json_encode($data);
	}
}
?>