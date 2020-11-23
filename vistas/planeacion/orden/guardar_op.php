<?php
include '../../../modelo/conexion.php';

 session_start();
  $sql3 = "UPDATE `orden_produccion` SET `congelado`='1',`generado_user`=".$_SESSION['id_user'].", `estado_o`='En produccion'  WHERE id_orden=".$_GET['op'].";";
         mysqli_query($conexion,$sql3);
         
 $sql3x = "UPDATE `procesos_activos` SET `save`='1' WHERE id_op=".$_GET['op'].";";
 mysqli_query($conexion,$sql3x);

//$sql_subpro = "UPDATE subproceso set sin = sin + ".($_GET['cant_total']+$_GET['cant_total_p'])." WHERE id_subpro = 1";
// mysqli_query($conexion,$sql_subpro);


//insert master_produccion
date_default_timezone_set("America/Bogota" );
$op = $_GET['op'];
$opf = $_GET['opf'];
$cot = $_GET['cot'];
$fecha_orden = date('Y-m-d');
$clase_vid = $_GET['clase_vid'];
$estado = 'En produccion';
$observacion = $_GET['observacion'];
$area = 1;
$nombre_obra = $_GET['nombre_obra'];
$nombre_cliente = $_GET['nombre_cliente'];
$peso=0;
$canth=0;
$sqlx=mysqli_query($conexion,"SELECT c.peso_cot, c.cantidad_huacales FROM procesos_activos p, orden_detalle e, cotizaciones co, cotizacion c WHERE p.id_op='".$op."' and e.id_orden_d=p.id_orden_d and co.id_cotizacion=e.relacionado and c.id_cot=co.id_cot LIMIT 1");
if($row=mysqli_fetch_assoc($sqlx)){
	$peso=$row['peso_cot'];
	$canth=$row['cantidad_huacales'];
}
$query_produccion = 'INSERT INTO master_produccion (op, opf, cot, fecha_orden, estado, id_area, nombre_obra, nombre_cliente,clase, ubicacion, observacion, cantidad, cartera, peso_ord, cantidad_huacales) 
			                 VALUES ("'.$op.'", "'.$opf.'", "'.$cot.'", "'.$fecha_orden.'", "'.$estado.'", "'.$area.'", "'.$nombre_obra.'","'.$nombre_cliente.' ", "'.$clase_vid.'", "'.$_SESSION["sede_user"].'", "'.$observacion.'", "'.($_GET['cant_total']).'", "Retenida", "'.$peso.'", "'.$canth.'")';
mysqli_query($conexion,$query_produccion);

echo 'La OP ha entrado en produccion'.mysqli_error($conexion);
//  