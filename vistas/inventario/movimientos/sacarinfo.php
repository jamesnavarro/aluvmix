<?php
   include '../../../modelo/conexioni.php';
   session_start();
   date_default_timezone_set("America/Bogota" ) ; 
	$hora = date('H:i:s',time() - 3600*date('I'));
	$fecha_hoy = date("Y-m-d").' '.$hora;
	$date = date("Y-m-d");
	if(isset($_POST['orden'])){
		$sql=mysqli_query($con, "SELECT codigo FROM orden_compra WHERE codigo='".$_POST['orden']."' and codigo!=0 LIMIT 1");
		if($row=mysqli_fetch_assoc($sql)){
		    $data = array("sucess" => '1');
	        echo json_encode($data);
		}else{
		   $data = array("sucess" => '0');
	        echo json_encode($data);
		}
	}
	if(isset($_POST['tabla'])){
		$sql=mysqli_query($con,"SELECT * FROM orden_compra_detalle WHERE codigo_orden='".$_POST['ord']."' and codigo_orden!=0");
		   while($row=mysqli_fetch_array($sql)){
		   	$send=$row['id_oc_de'].",'".$row['codigo']."','".trim($row['descripcion'])."',".$row['cantidad_pend'].",'".trim($row['color'])."',"."'".trim($row['medida'])."'";
		    echo '<tr>'.
					 '<td><center><b>'.$row['codigo'].'</center></td>'.
					 '<td><center><b>'.$row['descripcion'].'</center></td>'.
					 '<td><center><b>'.$row['color'].'</center></td>'.
					 '<td><center>'.$row['medida'].'</center></td>'.
					 '<td><center><b>'.$row['cantidad'].'</center></td>'.
					  '<td><center><b>'.$row['cantidad_pend'].'</center></td>'.
					  '<td><center>'.$row['precio'].'</center></td>'.
					   '<td><center><button onclick="inv_send('.$send.');"><img src="../../images/agregar.png"></button></center></td>'.
				 '</tr>';
		   }
	}
	if(isset($_POST['tablas'])){
		$sql=mysqli_query($con,"SELECT * FROM orden_compra_detalle WHERE codigo_orden='".$_POST['ord']."' and codigo_orden!=0");
		   while($row=mysqli_fetch_array($sql)){
		   	$send=$row['id_oc_de'].",'".$row['codigo']."','".trim($row['descripcion'])."',".$row['cantidad_pend'].",'".trim($row['color'])."',"."'".trim($row['medida'])."'";
		    echo '<tr>'.
					 '<td><center><b>'.$row['codigo'].'</center></td>'.
					 '<td><center><b>'.$row['descripcion'].'</center></td>'.
					 '<td><center><b>'.$row['color'].'</center></td>'.
					 '<td><center>'.$row['medida'].'</center></td>'.
					 '<td><center><b>'.$row['cantidad'].'</center></td>'.
					  '<td><center><b>'.$row['cantidad_pend'].'</center></td>'.
					  '<td><center>'.$row['precio'].'</center></td>'.
				 '</tr>';
		   }
	}
	if(isset($_POST['trasl'])){
		$sql=mysqli_query($con,"SELECT * FROM mov_detalle WHERE id_mov='".$_POST['ord']."'");
		   while($row=mysqli_fetch_array($sql)){
		   	$sqlx=mysqli_query($con, "SELECT descripcion, costo_promedio FROM productos_var WHERE codigo='".$row['pro_codigo']."'");
		   	$res=mysqli_fetch_assoc($sqlx);
		   	$lis=mysqli_query($con, "SELECT SUM(cantidad_mov) FROM mov_detalle_ubi WHERE id_ref_mov='".$row['id_ref_mov']."' and codigo_pro='".$row['pro_codigo']."'");
		   	$ress=mysqli_fetch_assoc($lis);
		   	$resta=intval($row['cantidad']-$ress['SUM(cantidad_mov)']);
		   	$send="'".$row['pro_codigo']."','".trim($res['descripcion'])."',".$resta.','.$row['id_ref_mov'].','.$row['id_mov'];
		    echo '<tr>'.
					 '<td><center><b>'.$row['pro_codigo'].'</center></td>'.
					 '<td><center><b>'.$res['descripcion'].'</center></td>'.
					 '<td><center><b>'.$row['color'].'</center></td>'.
					 '<td><center>'.$row['medida'].'</center></td>'.
					 '<td><center><b>'.$row['cantidad'].'</center></td>'.
					 '<td><center><b>'.$resta.'</center></td>'.
					   '<td><center><button onclick="dar_acesso('.$send.');"><img src="../../images/agregar.png"></button></center></td>'.
					   
				 '</tr>';
		   }
	}
	if(isset($_POST['ubis'])){
		$sql=mysqli_query($con,"SELECT SUM(cantidad_mov), codigo_pro, ubicacion FROM `mov_detalle_ubi` where codigo_pro='".$_POST['cod']."' and tipo_mov='ENTRADA' and id_mov='".$_POST['mov']."' GROUP BY ubicacion");
		   while($row=mysqli_fetch_array($sql)){
		    echo '<tr>'.
					 '<td><center><b>'.$row['codigo_pro'].'</center></td>'.
					 '<td><center><b>'.$row['ubicacion'].'</center></td>'.
					 '<td><center><b>'.$row['SUM(cantidad_mov)'].'</center></td>'.
				 '</tr>';
		   }
	}
	if(isset($_POST['ubisx'])){
		$sql=mysqli_query($con,"SELECT SUM(cantidad_mov), codigo_pro, ubicacion FROM `mov_detalle_ubi` where codigo_pro='".$_POST['cod']."' and tipo_mov='ENTRADA' and id_ref_mov='".$_POST['ref']."' GROUP BY ubicacion");
		   while($row=mysqli_fetch_array($sql)){
		    echo '<tr>'.
					 '<td><center><b>'.$row['codigo_pro'].'</center></td>'.
					 '<td><center><b>'.$row['ubicacion'].'</center></td>'.
					 '<td><center><b>'.$row['SUM(cantidad_mov)'].'</center></td>'.
				 '</tr>';
		   }
	}
	if(isset($_POST['tab'])){
		$sql=mysqli_query($con,"SELECT * FROM mov_detalle WHERE id_mov='".$_POST['mov']."'");
		   while($row=mysqli_fetch_array($sql)){
		   	$sqlx=mysqli_query($con, "SELECT descripcion, costo_promedio FROM productos_var WHERE codigo='".$row['pro_codigo']."'");
		   	$res=mysqli_fetch_assoc($sqlx);
		   	$send="'".$row['pro_codigo']."','".trim($res['descripcion'])."',".$row['cantidad'].','.$row['id_ref_mov'].','.$row['id_mov'];
		   	$trash=$row['id_ref_mov'];
		    echo '<tr>'.
					 '<td><center><b>'.$row['pro_codigo'].'</center></td>'.
					 '<td><center><b>'.$res['descripcion'].'</center></td>'.
					 '<td><center><b>'.$row['color'].'</center></td>'.
					 '<td><center>'.$row['medida'].'</center></td>'.
					 '<td><center><b>'.$row['cantidad'].'</center></td>'.
					 '<td><center>'.$res['costo_promedio'].'</center></td>'.
					 '<td><center><button onclick="dar_ubicacion('.$send.');"><img src="../../images/agregar.png"></button></center></td>'.
					 '<td><center><button onclick="trash_item('.$trash.')"><img src="../../images/icn_alert_error.png"></button></center></td>'.
				 '</tr>';
		   }
	}
	if(isset($_POST['tabf'])){
		$sql=mysqli_query($con,"SELECT * FROM mov_detalle WHERE id_mov='".$_POST['mov']."'");
		   while($row=mysqli_fetch_array($sql)){
		   	$sqlx=mysqli_query($con, "SELECT descripcion, costo_promedio FROM productos_var WHERE codigo='".$row['pro_codigo']."'");
		   	$res=mysqli_fetch_assoc($sqlx);
		   	$send="'".$row['pro_codigo']."','".trim($res['descripcion'])."',".$row['cantidad'].','.$row['id_ref_mov'].','.$row['id_mov'];
		   	$trash=$row['id_ref_mov'];
		    echo '<tr>'.
				 '<td><center><b>'.$row['pro_codigo'].'</center></td>'.
				 '<td><center><b>'.$res['descripcion'].'</center></td>'.
				 '<td><center><b>'.$row['color'].'</center></td>'.
				 '<td><center>'.$row['medida'].'</center></td>'.
				 '<td><center><b>'.$row['cantidad'].'</center></td>'.
				 '<td><center>'.$res['costo_promedio'].'</center></td>'.
				 '</tr>';
		   }
	}
	if (isset($_POST['res'])) {
		$sql=mysqli_query($con, "SELECT sum(cantidad_mov) FROM mov_detalle_ubi WHERE id_ref_mov='".$_POST['idf']."' and codigo_pro='".$_POST['cod']."'");
		$res=mysqli_fetch_row($sql);
		$num = $res[0];
		
		if($num!=NULL){
			$data = array("result" => $num);
		    echo json_encode($data);
		}else{
			$data = array("result" => '0');
		    echo json_encode($data);
		}
	}
	if(isset($_POST['traslado'])){
		$sql=mysqli_query($con, "SELECT id_mov FROM mov_inventario WHERE id_mov='".$_POST['traslado']."' LIMIT 1");
		if($row=mysqli_fetch_assoc($sql)){
			$data = array("sucess" => '1');
	        echo json_encode($data);
		}else{
			$data = array("sucess" => '0');
	        echo json_encode($data);
		}
	}
?>


