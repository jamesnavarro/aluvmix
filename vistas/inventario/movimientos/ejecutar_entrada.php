<?php
require('../../../modelo/conexioni.php');
session_start();
$xql=mysqli_query($con, "SELECT id_mov FROM mov_inventario WHERE id_mov='".$_POST['rad']."'");
if(mysqli_num_rows($xql)==0){
	$tipomov=$_POST['tipdoc'];
	$act=mysqli_query($con,"UPDATE tipos_movimientos SET ult_cons=ult_cons+1 where codigo_tm='".$tipomov."'");
	if($act){
		$xsear=mysqli_query($con,"SELECT max(ult_cons) FROM tipos_movimientos WHERE codigo_tm='".$tipomov."' LIMIT 1");
		$rax=mysqli_fetch_assoc($xsear);
		$sql=mysqli_query($con,"INSERT INTO `mov_inventario`(`fecha_pro`, `codigo_tm`, `num_documento`, `doc_referencia`, `bod_codigo`, `cen_codigo`, `usuario`, `save_mov`, `id_orden`, `obs`, `tipo_movimiento`, `codigo_ter`, `nombre_tercero`, `total`, `diferencia`, `cod_empresa`) VALUES ('".$_POST['FecReg']."','".$_POST['tipdoc']."','".$_POST['factura']."','".$rax['max(ult_cons)']."','".$_POST['loc']."','".$_POST['cc']."','".$_POST['por']."','0','".$_POST['compra']."','".$_POST['obs']."','".$_POST['descarga']."','".$_POST['nombrepro']."','".$_POST['nter']."','".$_POST['totalx']."','".$_POST['diferencia']."','".$_SESSION['empresa']."')");
		if($sql){
			$max=0;
			$save=0;
			$fecha='';
			$extra=mysqli_query($con,"SELECT max(id_mov), save_mov, fecha_pro FROM mov_inventario where id_mov=(SELECT MAX(id_mov) FROM mov_inventario)");
			if($row=mysqli_fetch_array($extra)){
			$data = array("sucess" => '1',"radicado" => $row['max(id_mov)'],"estado" => $row['save_mov'],"fecha" => $row['fecha_pro']);
		    echo json_encode($data);
			}
		}else{
	 		$data = array("sucess" => '0');
	        echo json_encode($data);
		}
	 }else{
	 		$data = array("sucess" => '0');
	        echo json_encode($data);
	}
} 
?>