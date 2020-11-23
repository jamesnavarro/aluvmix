<?php
	session_start();
include '../../../modelo/conexion.php';
	$id_cot = $_GET['id_cot'];
	$id_op = $_GET['id_op'];
	$query_cantidad = mysqli_query($conexion,"SELECT * FROM cotizaciones WHERE id_cot = $id_cot");
	//$row_cantidad = mysqli_fetch_array($query_cantidad);
	//
	$query_upload_subpro="UPDATE subproceso set sin = sin - (SELECT cantidad FROM `master_produccion` where op=".$id_op.") WHERE id_subpro = 1";

	$query_delete_master= "DELETE FROM master_produccion WHERE op=$id_op ";
	while ($row_cantidad = mysqli_fetch_assoc($query_cantidad)) {
		$cantidad_cotizada = $row_cantidad['cantidad_c'];
		$cantidad_restante = $row_cantidad['cant_restante'];
		mysqli_query($conexion,"UPDATE cotizaciones SET cant_restante = " . $cantidad_cotizada . " WHERE id_cotizacion = " . $row_cantidad['id_cotizacion']);
	}
        $query_orden = mysqli_query($conexion,"SELECT relacionado FROM orden_detalle WHERE codigo = $id_op and anula=0 "  );
        while ($row = mysqli_fetch_assoc($query_orden)) {
            $item = $row['relacionado'];
            $sqld = "UPDATE `cotizaciones` SET `cant_restante` = `cantidad_c`  WHERE `id_cotizacion` in (" . $item . ");";
        }
        mysqli_query($conexion,"UPDATE orden_detalle SET anula = '1' WHERE codigo = " . $id_op . " ;");
	//$cantidad_cotizada = $row_cantidad['cantidad_c'];
	//$cantidad_restante = $row_cantidad['cant_restante'];
	//echo $id_cot . " - " . $id_op . " - " . $cantidad_cotizada . " - " . $cantidad_restante;
	//mysqli_query($conexion,"UPDATE cotizaciones SET cant_restante = " . $cantidad_cotizada . " WHERE id_cot = " . $id_cot);
	mysqli_query($conexion,"UPDATE orden_produccion SET congelado = 2, estado_o = 'Anulada', anulado_por='".$_SESSION['k_username']."', fecha_anulada='".date("Y-m-d H:m:s")."', porque='".$_GET['por']."' WHERE id_orden = " . $id_op);
	mysqli_query($conexion,"UPDATE procesos_activos SET save = 2 WHERE id_op = " . $id_op);
 

	 mysqli_query($conexion,$query_upload_subpro);
	 echo mysqli_error($conexion);
	 mysqli_query($conexion,$query_delete_master);
	 echo mysqli_error($conexion);
         echo '2';
	// echo $_GET['cant_total']+$_GET['cant_total_p'];
?>
