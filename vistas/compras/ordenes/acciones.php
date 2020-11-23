<?php
include '../../../modelo/conexioni.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

if(isset($_POST['enca'])){
		$check=mysqli_query($con,"SELECT * FROM orden_compra a, cont_terceros b WHERE a.cod_ter=b.cod_ter and a.codigo='".$_POST['enca']."'");
		if($row=mysqli_fetch_assoc($check)){
				$sql=mysqli_query($con,"SELECT usuario FROM usuarios WHERE id_user='".$row['user_id']."' LIMIT 1");
				$raw=mysqli_fetch_assoc($sql);
				$sqlx=mysqli_query($con,"SELECT bod_nombre FROM bodegas WHERE bod_codigo='".$row['bod_codigo']."' LIMIT 1");
				$rawx=mysqli_fetch_assoc($sqlx);
				$data = array("sucess" => '1',"estadox" => $row['estado'],"empresax" => $row['cod-empresa'],"feccx" => $row['fecha'],"bodegax" => $rawx['bod_nombre'],"provex" => $row['nom_ter'],"userx" => $raw['usuario'],"cenx" => $row['centro_costo'], "correo"=> $row['correo_ter'], "fom"=> $row['ordenfom']);
		   		echo json_encode($data);
		}else{
		    $data = array("sucess" => '0');
		    echo json_encode($data);
		}
	}

?>