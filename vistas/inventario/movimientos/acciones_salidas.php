<?php
include '../../../modelo/conexioni.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

if(isset($_POST['save'])){
		$sql=mysqli_query($con,"SELECT * FROM mov_detalle WHERE pro_codigo='".$_POST['pro_codigo']."' and id_mov='".$_POST['id_mov']."'");
		if(mysqli_num_rows($sql)>0){
			$sald=mysqli_query($con,"SELECT cantidad FROM mov_detalle WHERE pro_codigo='".$_POST['pro_codigo']."'  and id_mov='".$_POST['id_mov']."'");
			$saldo=mysqli_fetch_assoc($sald);
			mysqli_query($con,"UPDATE mov_detalle SET cantidad=(cantidad+'".$_POST['cantidad']."') , saldo_inicial='".$saldo['cantidad']."' WHERE pro_codigo='".$_POST['pro_codigo']."' and id_mov='".$_POST['id_mov']."'");
			$data = array("sucess" => '1');
		    echo json_encode($data);
		}else{
			mysqli_query($con,"INSERT INTO `mov_detalle`(`id_mov`, `bod_codigo`, `pro_codigo`, `cantidad`, `saldo_inicial`, `medida`, `color`, `estado_mov`, `fecha_registro`, `usuario`, `cod_empresa`) VALUES ('".$_POST['id_mov']."','".$_POST['bod_codigo']."','".$_POST['pro_codigo']."','".$_POST['cantidad']."','0','".$_POST['medida']."','".$_POST['color']."','0','".$fecha_hoy."','".$_SESSION['k_username']."','".$_SESSION['empresa']."')");

			$data = array("sucess" => '1');
		    echo json_encode($data);
		}
}else{
	$data = array("sucess" => '0');
		    echo json_encode($data);
}
?>