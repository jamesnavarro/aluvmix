<?php
include '../../../modelo/conexioni.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

if(isset($_POST['save_movs'])){
	$key=0;
	$search=mysqli_query($con, "SELECT id_mov, codigo_pro FROM mov_detalle_ubi WHERE id_mov='".$_POST['id_mov']."' and codigo_pro='".$_POST['codigo_pro']."' and ubicacion='".$_POST['ubicacion']."'");
	if(mysqli_num_rows($search)>0){
		mysqli_query($con, "UPDATE mov_detalle_ubi SET cantidad_mov=(cantidad_mov + '".$_POST['cantidad_mov']."') WHERE id_mov='".$_POST['id_mov']."' and codigo_pro='".$_POST['codigo_pro']."'");
		$key=1;
	}else{
		$sql=mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`id_mov`, `id_ref_mov`, `codigo_pro`, `ubicacion`, `cantidad_mov`, `fecha_mov`, `usuario`, `estado_mu`, `cantidad_out`, `tipo_mov`) VALUES ('".$_POST['id_mov']."','".$_POST['id_ref_mov']."','".$_POST['codigo_pro']."','".$_POST['ubicacion']."','".$_POST['cantidad_mov']."','".$fecha_hoy."','".$_SESSION['k_username']."','0','".$_POST['cantidad_mov']."','SALIDA')");
		if(!$sql){
			$key=0;
		}else{
			$key=1;
		}
	}
	$data = array("sucess" => $key);
    echo json_encode($data);
}
if(isset($_POST['ubis'])){
		$sql=mysqli_query($con,"SELECT cantidad_mov, codigo_pro, ubicacion FROM `mov_detalle_ubi` where codigo_pro='".$_POST['cod']."' and id_ref_mov='".$_POST['idf']."' and id_mov='".$_POST['idm']."' and tipo_mov='SALIDA'");
		   while($row=mysqli_fetch_array($sql)){
		    echo '<tr>'.
					 '<td><center><b>'.$row['codigo_pro'].'</center></td>'.
					 '<td><center><b>'.$row['ubicacion'].'</center></td>'.
					 '<td><center><b>'.$row['cantidad_mov'].'</center></td>'.
					 '<td><center><button>Eliminar</button></center></td>'.
				 '</tr>';
		   }
}
if(isset($_POST['save_total'])){
	$key=0;
	$sql=mysqli_query($con, "SELECT id_mdu, codigo_pro, ubicacion, cantidad_mov, saldo_ubicacion FROM mov_detalle_ubi WHERE id_mov='".$_POST['rad']."' and tipo_mov='SALIDA'");
	while ($row=mysqli_fetch_assoc($sql)) {
		$sel=mysqli_query($con, "SELECT stock_ubi FROM relacion_ubicaciones WHERE codigo_pro='".$row['codigo_pro']."' and ubicacion='".$row['ubicacion']."' LIMIT 1");
			$res=mysqli_fetch_assoc($sel);
			mysqli_query($con, "UPDATE mov_detalle_ubi SET saldo_ubicacion='".$res['stock_ubi']."' WHERE id_mdu='".$row['id_mdu']."'");
			mysqli_query($con, "UPDATE relacion_ubicaciones SET stock_ubi=(stock_ubi - '".$row['cantidad_mov']."') WHERE codigo_pro='".$row['codigo_pro']."' and ubicacion='".$row['ubicacion']."' LIMIT 1");
			mysqli_query($con, "UPDATE pro_stock SET stock_actual=(stock_actual-'".$row['cantidad_mov']."'), fecha_ult_sal='".$fecha_hoy."'  WHERE codigo_pro='".$row['codigo_pro']."'");
			$exito=mysqli_query($con, "UPDATE mov_inventario SET save_mov='1' WHERE id_mov='".$_POST['rad']."'");
			if($exito){
				$key=1;
			}else{
				$key=0;
			}
	}
	$data = array("sucess" => $key);
	echo json_encode($data);
}
if(isset($_POST['delete'])){
			$sql="DELETE FROM mov_detalle WHERE id_ref_mov='".$_POST['id']."'";
			if($res=@mysqli_query($con, $sql)){
				$data = array("sucess" => "1");
				echo json_encode($data);
			}else{
				$data = array("sucess" => "0");
				echo json_encode($data);
			}
		
}
if(isset($_POST['bres'])){
	$bodega=$_POST['bodega'];
	$sql=mysqli_query($con, "SELECT * FROM reservas_obras WHERE bod_codigo='$bodega'");
	while ($row=mysqli_fetch_assoc($sql)) {
		$sqlx=mysqli_query($con, "SELECT descripcion, costo_promedio FROM productos_var WHERE codigo='".$row['codigo_pro']."'");
		   	$res=mysqli_fetch_assoc($sqlx);
		echo '<tr>';
		echo '<td><input type="hidden" id="CPRO'.$row['id_reserva'].'" value="'.$row['codigo_pro'].'"/>'.$row['codigo_pro'].'</td>';
		echo '<td><input type="hidden" id="DES'.$row['id_reserva'].'" value="'.$res['descripcion'].'"/>'.$res['descripcion'].'</td>';
		echo '<td><input type="hidden" id="CGR'.$row['id_reserva'].'" value="'.$row['cantidad'].'"/>'.$row['cantidad'].'</td>';
		echo '<td><input type="text" id="CRS'.$row['id_reserva'].'" onkeyup="verfmas('.$row['id_reserva'].');"></td>';
		echo '<td><button onclick="generar_prestamo('.$row['id_reserva'].');">Descargar</button></td>';
		echo '</tr>';
	}
}
if (isset($_POST['generar_p'])) {
	$producto=$_POST['producto'];
	$cantidad=$_POST['cant'];
	$bod_origen=$_POST['bod_origen'];
	$bod_destino=$_POST['bod_destino'];
	$orden=$_POST['orden_pro'];
	$sql=mysqli_query($con, "SELECT * FROM prestamo_entre_obras WHERE bod_codigo_origen='$bod_origen' and bod_codigo_destino='$bod_destino' and codigo_pro='$producto' and id_op='$orden'");
	if(mysqli_num_rows($sql)>0){
		$udp=mysqli_query($con, "UPDATE prestamo_entre_obras SET cantidad=(cantidad + '$cantidad') WHERE bod_codigo_origen='$bod_origen' and bod_codigo_destino='$bod_destino' and codigo_pro='$producto' and id_op='$orden'");
		if($udp){
				$desc=mysqli_query($con,$con,"UPDATE reservas_obras SET cantidad=(cantidad - '$cantidad'), vig_ajuste=(vig_ajuste - '$cantidad') WHERE bod_codigo='$bod_origen' and codigo_pro='$producto'");
				if($desc){
					$act=mysqli_query($con,$con,"UPDATE ");
				}
				$data = array("sucess" => "1");
				echo json_encode($data);
			}else{
				$data = array("sucess" => "0");
				echo json_encode($data);
			}
	}else{
		$ins=mysqli_query($con, "INSERT INTO `prestamo_entre_obras`(`bod_codigo_origen`, `bod_codigo_destino`, `codigo_pro`, `cantidad`, `id_op`) VALUES ('$bod_origen','$bod_destino','$producto','$cantidad','$orden')");
		if($ins){
				$desc=mysqli_query($con,"UPDATE reservas_obras SET cantidad=(cantidad - '$cantidad'), vig_ajuste=(vig_ajuste - '$cantidad') WHERE bod_codigo='$bod_origen' and codigo_pro='$producto'");
				$data = array("sucess" => "1");
				echo json_encode($data);
		}else{
				$data = array("sucess" => "0");
				echo json_encode($data);
		}
	}
}
if(isset($_POST['prest'])){
	$producto=$_POST['producto'];
	$sql=mysqli_query($con,"SELECT codigo_pro, ubicacion, stock_ubi, id_ru FROM relacion_ubicaciones WHERE codigo_pro='$producto' and stock_ubi>'0'");
	while ($row = mysqli_fetch_assoc($sql)) {
		echo '<tr>';
		echo '<td>'.$row['codigo_pro'].'</td>';
		echo '<td>'.$row['ubicacion'].'</td>';
		echo '<td><input type="hidden" id="desubican'.$row['id_ru'].'" value="'.$row['stock_ubi'].'"/>'.$row['stock_ubi'].'</td>';
		echo '<td><input type="text" id="desubi'.$row['id_ru'].'" onkeyup="mirarvalues('.$row['id_ru'].');"/></td>';
		echo '<td><button onclick="bajareserva('.$row['id_ru'].');">Descarga</button></td>';
		echo '</tr>';
	}
}
if(isset($_POST['puesto'])){
	$send='<select id="idpues"><option value="0">No Aplica</option>';
	$sql=mysqli_query($con, "SELECT id_puesto, nombre_puesto FROM puestos_trabajos");
	while ($row=mysqli_fetch_assoc($sql)) {
		$send=$send.'<option value="'.$row['id_puesto'].'">'.$row['nombre_puesto'].'</option>';
	}
	$send=$send.'</select>';
	echo $send;
}
?>