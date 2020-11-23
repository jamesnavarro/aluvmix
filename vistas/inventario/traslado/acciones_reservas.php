<?php
include '../../../modelo/conexioni.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

if(isset($_POST['save'])){
	$producto=$_POST['pro_codigo'];
	$cantidad=$_POST['cantidad'];
	$obra=$_POST['obra'];
	$bodega=$_POST['bod_codigo'];

	$stock_disponible=0;
	
	$query=mysqli_query($con, "SELECT stock_actual, stock_res FROM pro_stock WHERE codigo_pro='$producto' LIMIT 1");
	if($row=mysqli_fetch_assoc($query)){
		$stock_disponible=intval($row['stock_actual']-$row['stock_res']);
	}

	if($cantidad>$stock_disponible){
		$data = array("result" => 'El stock disponible no tiene la cantidad que desea reservar! Disponible:     '.$stock_disponible);
	    echo json_encode($data);
	}else{
		$sql=mysqli_query($con,"SELECT * FROM reservas_obras WHERE bod_codigo='$bodega' and codigo_pro='$producto'");
		if(mysqli_num_rows($sql)>0){
			$upd=mysqli_query($con,"UPDATE reservas_obras SET cantidad=(cantidad + '$cantidad'), vig_ajuste=(vig_ajuste + '$cantidad') WHERE bod_codigo='$bodega' and codigo_pro='$producto'");
			if($upd){
				$ult=mysqli_query($con,"UPDATE pro_stock SET stock_res=(stock_res+'$cantidad') WHERE codigo_pro='$producto'");
				if($ult){
					$data = array("result" => '1');
	    			echo json_encode($data);
				}
			}
		}else{
				$ins=mysqli_query($con, "INSERT INTO `reservas_obras`(`bod_codigo`, `obra`, `codigo_pro`, `cantidad`, `vig_ajuste`) VALUES ('$bodega','$obra','$producto','$cantidad','$cantidad')");
				if($ins){
					$ult=mysqli_query($con,"UPDATE pro_stock SET stock_res=(stock_res + '$cantidad') WHERE codigo_pro='$producto'");
					if($ult){
						$data = array("result" => '1');
		    			echo json_encode($data);
					}
				}
			}
	}
}

if(isset($_POST['obrares'])){
	$obra=$_POST['obrares'];
	$sql=mysqli_query($con,"SELECT * FROM reservas_obras WHERE bod_codigo='$obra'");
	while ($row=mysqli_fetch_assoc($sql)) {
		echo '<tr>';
		echo '<td class="center"><input type="hidden" value="'.$row['codigo_pro'].'" id="P'.$row['id_reserva'].'"/>'.$row['codigo_pro'].'</td>';
		echo '<td class="center">'.$row['obra'].'</td>';
		echo '<td class="center"><input type="hidden" value="'.$row['vig_ajuste'].'" id="C'.$row['id_reserva'].'"/>'.$row['vig_ajuste'].'</td>';
		echo '<td class="center">'.$row['bod_codigo'].'</td>';
		echo '<td><button onclick="delet_res('.$row['id_reserva'].')">Eliminar</button></td>';
		echo '</tr>';
	}
}

if (isset($_POST['resm'])) {
	$ref=$_POST['resm'];
	$disponible=0;
	$sql=mysqli_query($con,"SELECT stock_res, stock_actual FROM pro_stock WHERE codigo_pro='$ref'");
	if($row=mysqli_fetch_assoc($sql)){
		$disponible=intval($row['stock_actual']-$row['stock_res']);
		$data = array("result" => '1',"general" => $row['stock_actual'],"disponible" => $disponible,"reservado" => $row['stock_res']);
		echo json_encode($data);
	}else{
		$data = array("result" => '0');
		echo json_encode($data);
	}
}

if(isset($_POST['lisrem'])){
	$codigo=$_POST['lisrem'];
	$sql=mysqli_query($con,"SELECT id_reserva, obra, cantidad, bod_codigo FROM reservas_obras WHERE codigo_pro='$codigo'");
	while ($row=mysqli_fetch_assoc($sql)) {
		echo '<tr>';
		echo '<td nowrap><input type="hidden" value="'.$row['bod_codigo'].'" id="loc'.$row['id_reserva'].'">'.$row['obra'].'</td>';
		echo '<td style="padding-left: 5%"><input type="hidden" value="'.$row['cantidad'].'" id="CV'.$row['id_reserva'].'"/>'.$row['cantidad'].'</td>';
		echo '<td style="padding-left: 5%"><input type="number" id="X'.$row['id_reserva'].'" onkeyup="comprobarC('.$row['id_reserva'].')"/></td>';
		echo '<td style="padding-right: 1%;color: red;font-weight: bold;"><button onclick="desc_obra('.$row['id_reserva'].');">Descargar</button></td>';
		echo '</tr>';
	}
}

if (isset($_POST['delete'])) {
	$id=$_POST['delete'];
	$cant=$_POST['cant'];
	$producto=$_POST['produ'];
	$sql=mysqli_query($con,"DELETE FROM reservas_obras WHERE id_reserva='$id'");
	if($sql){
		$sqlx=mysqli_query($con, "UPDATE pro_stock SET stock_res=(stock_res-'$cant') WHERE codigo_pro='$producto'");
		if($sqlx){
			$data = array("result" => '1');
			echo json_encode($data);
		}else{
			$data = array("result" => '0');
			echo json_encode($data);
		}
	}else{
		$data = array("result" => '0');
		echo json_encode($data);
	}
}

if(isset($_POST['carga_disp'])){
	$refe=$_POST['refe'];
	$cant=$_POST['carga_disp'];
	$sql=mysqli_query($con, "UPDATE pro_stock SET stock_actual=(stock_actual + '$cant') WHERE codigo_pro='$refe'");
	if($sql){
		$data = array("sucess" => '1');
			echo json_encode($data);
	}else{
		$data = array("sucess" => '0');
			echo json_encode($data);
	}
}

if(isset($_POST['descarga_disp'])){
	$refe=$_POST['refe'];
	$cant=$_POST['descarga_disp'];
	$sql=mysqli_query($con, "UPDATE pro_stock SET stock_actual=(stock_actual - '$cant') WHERE codigo_pro='$refe'");
	if($sql){
		$data = array("sucess" => '1');
			echo json_encode($data);
	}else{
		$data = array("sucess" => '0');
			echo json_encode($data);
	}
}


if(isset($_POST['des_obra'])){
	$cant=$_POST['cant'];
	$refe=$_POST['refe'];
	$bodega=$_POST['bodega'];
	$sql=mysqli_query($con,"UPDATE reservas_obras SET cantidad=(cantidad - '$cant') WHERE bod_codigo='$bodega' and codigo_pro='$refe'");
	if($sql){
		$query=mysqli_query($con,"UPDATE pro_stock SET stock_res=(stock_res - '$cant'),stock_actual=(stock_actual - '$cant') WHERE codigo_pro='$refe'");
		if($query){
				$data = array("sucess" => '1');
				echo json_encode($data);
		}else{
			$data = array("sucess" => 'No se pudo Actualizar Stock de reserva');
			echo json_encode($data);
		}
	}else{
		$data = array("sucess" => 'No se pudo descargar cantidad en bodega');
		echo json_encode($data);
	}
}


?>