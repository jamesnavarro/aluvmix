<?php
	include '../../../modelo/conexion.php';

	$query_select_anulax = mysqli_query($conexion,"SELECT * FROM orden_detalle WHERE id_orden_d = " . $_GET['orden'] . " ");
	$row_anula = mysqli_fetch_array($query_select_anulax);

	if ($row_anula['anula'] == 0) {

		mysqli_query($conexion,"UPDATE orden_detalle SET anula = '1' WHERE id_orden_d = " . $_GET['orden'] . " ;");

		$query_select_cantidad = mysqli_query($conexion,"SELECT * FROM orden_detalle WHERE id_orden_d = " . $_GET['orden'] . "  and parte_otro=0 ");
		$row_cantidad = mysqli_fetch_array($query_select_cantidad);
           

                
		$sqld = "UPDATE `cotizaciones` SET `cant_restante` = cant_restante + '" .$row_cantidad['cant_ordenada']. "'  WHERE `id_cotizacion` in (" . $_GET['item'] . ");";
		mysqli_query($conexion,$sqld);
                echo mysqli_error($conexion).' e:'.$_GET['orden'].' i:'.$_GET['item'];

	}
	//3008763985 
?>