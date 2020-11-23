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

			$id_c=mysqli_query($con,"SELECT id_ref_mov, id_mov FROM mov_detalle WHERE pro_codigo='".$_POST['pro_codigo']."' and id_mov='".$_POST['id_mov']."'");
			$id=mysqli_fetch_assoc($id_c);

			$unic=mysqli_query($con, "SELECT cantidad_mov FROM mov_detalle_ubi WHERE ubicacion='".$_POST['ubic']."' and codigo_pro='".$_POST['pro_codigo']."' and id_mov='".$id['id_mov']."' LIMIT 1");
			if(mysqli_num_rows($unic)>0){
				$res=mysqli_fetch_assoc($unic);
				mysqli_query($con, "UPDATE mov_detalle_ubi SET cantidad_mov=cantidad_mov+'".$_POST['cantidad']."', cantidad_in='".$_POST['cantidad']."', saldo_ubicacion='".$res['cantidad_mov']."' WHERE codigo_pro='".$_POST['pro_codigo']."' and ubicacion='".$_POST['ubic']."' and id_mov='".$id['id_mov']."'");

				//mysqli_query($con, "UPDATE orden_compra_detalle SET  cantidad_rec=(cantidad_rec+'".$_POST['cantidad']."'), cantidad_pend=(cantidad_pend -'".$_POST['cantidad']."') WHERE id_oc_de='".$_POST['idpro']."'");

				$data = array("sucess" => '1');
		    	echo json_encode($data);
                        
                        
			}else{
				mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`id_mov`, `bodega`, `codigo_pro`, `ubicacion`, `cantidad_mov`, `saldo_ubicacion`, `fecha_mov`, `usuario`, `estado_mu`, `cantidad_in`, `tipo_mov`) VALUES ('".$id['id_mov']."','".$id['id_ref_mov']."','".$_POST['pro_codigo']."','".$_POST['ubic']."','".$_POST['cantidad']."','0','".$fecha_hoy."','".$_SESSION['k_username']."','0', '".$_POST['cantidad']."','ENTRADA')");

                                mysqli_query($con, "insert into mov_productos (id_mov,codigo_pro,ubicacion,cantidad) values('".$id['id_mov']."','".$_POST['pro_codigo']."','".$_POST['ubic']."','".$_POST['cantidad']."')");
			
				//mysqli_query($con, "UPDATE orden_compra_detalle SET  cantidad_rec=(cantidad_rec+'".$_POST['cantidad']."'), cantidad_pend=(cantidad_pend -'".$_POST['cantidad']."') WHERE id_oc_de='".$_POST['idpro']."'");

				$data = array("sucess" => '1');
		    	echo json_encode($data);
			}
		}else{
			$sql=mysqli_query($con,"INSERT INTO `mov_detalle`(`id_mov`, `bod_codigo`, `pro_codigo`, `cantidad`, `saldo_inicial`, `medida`, `color`, `estado_mov`, `fecha_registro`, `usuario`, `cod_empresa`) VALUES ('".$_POST['id_mov']."','".$_POST['bod_codigo']."','".$_POST['pro_codigo']."','0','0','".$_POST['medida']."','".$_POST['color']."','0','".$fecha_hoy."','".$_SESSION['k_username']."','".$_SESSION['empresa']."')");

			$id_ref=mysqli_insert_id($con);
			$id_mov=$_POST['id_mov'];


			mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`id_mov`, `id_ref_mov`, `codigo_pro`, `ubicacion`, `cantidad_mov`, `saldo_ubicacion`, `fecha_mov`, `usuario`, `estado_mu`, `cantidad_in`, `tipo_mov`) VALUES ('".$id_mov."','".$id_ref."','".$_POST['pro_codigo']."','".$_POST['ubic']."','".$_POST['cantidad']."','0','".$fecha_hoy."','".$_SESSION['k_username']."','0','".$_POST['cantidad']."', 'ENTRADA')");

			//mysqli_query($con, "UPDATE orden_compra_detalle SET  cantidad_rec=(cantidad_rec+'".$_POST['cantidad']."'), cantidad_pend=(cantidad_pend -'".$_POST['cantidad']."') WHERE id_oc_de='".$_POST['idpro']."'");
                        
                        $data = array("sucess" => '1');
		    echo json_encode($data);
		}
}

if (isset($_POST['api-rest'])) {
		$sql=mysqli_query($con, "SELECT * FROM mov_inventario WHERE id_mov='".$_POST['id']."'");
		if($row=mysqli_fetch_assoc($sql)){
			$tm=mysqli_query($con, "SELECT movimiento FROM tipos_movimientos WHERE codigo_tm='".$row['codigo_tm']."'");
			$tipo=mysqli_fetch_assoc($tm);
			$cc=mysqli_query($con, "SELECT cen_nombre FROM centrocostos WHERE cen_codigo='".$row['cen_codigo']."'");
			$cnc=mysqli_fetch_assoc($cc);
			$bod=mysqli_query($con, "SELECT bod_nombre FROM bodegas WHERE bod_codigo='".$row['bod_codigo']."'");
			$bode=mysqli_fetch_assoc($bod);
                        $bodd=mysqli_query($con, "SELECT bod_nombre FROM bodegas WHERE bod_codigo='".$row['bod_destino']."'");
			$boded=mysqli_fetch_assoc($bodd);
                        $ter=mysqli_query($con, "SELECT nom_ter FROM cont_terceros WHERE cod_ter='".$row['codigo_ter']."'");
			$t=mysqli_fetch_assoc($ter);

			$data = array("sucess" => '1', "desca" => $row['tipo_movimiento'],"sede" => $row['sede'],"estado" => $row['save_mov'], "obs" => $row['obs'], "tipo_mov" => $row['codigo_tm'], "name_tipo" => $tipo['movimiento'],"code_costo"=>$row['cen_codigo'],"name_cc"=>$cnc['cen_nombre'],"code_bodega"=>$row['bod_codigo'], "name_bodega" => $bode['bod_nombre'], "cod_ter" =>$row['codigo_ter'], "nom_ter"=>$row['nombre_tercero'], "fecha"=>$row['fecha_pro'], "remision" =>$row['num_documento'], "totalr"=> $row['total'],"diferencia"=>$row['diferencia'], "por"=>$row['usuario'], "orden_c"=>$row['id_orden'], "nter"=>$t['nom_ter'], "dest"=>$row['bod_destino'], "destn"=>$boded['bod_nombre']);
		    echo json_encode($data);
		}
}

if(isset($_POST['save_total'])){
		$sql=mysqli_query($con,"SELECT * FROM mov_detalle_ubi WHERE id_mov='".$_POST['rad']."'");
		while ($row=mysqli_fetch_assoc($sql)) {
                    
			mysqli_query($con, " UPDATE mov_detalle SET cantidad=(cantidad + '".$_POST['cantidad_mov']."') WHERE id_ref_mov='".$row['id_ref_mov']."'");

			$uni2=mysqli_query($con, "SELECT * FROM relacion_ubicaciones WHERE codigo_pro='".$row['codigo_pro']."' and ubicacion='".$row['ubicacion']."'");

			if(mysqli_num_rows($uni2)>0){
				mysqli_query($con, "UPDATE relacion_ubicaciones SET stock_ubi=(stock_ubi + '".$row['cantidad_mov']."'), fecha_ult_ent='".$fecha_hoy."', ultimo_usuario='".$_SESSION['k_username']."' WHERE codigo_pro='".$row['codigo_pro']."' and ubicacion='".$row['ubicacion']."'");
			
                                
                        }else{
				$bodega=0000;
				$infob=mysqli_query($con, "SELECT bod_codigo FROM mov_detalle WHERE id_ref_mov='".$row['id_ref_mov']."'");
				if(mysqli_num_rows($infob)>0){
					$sinfo=mysqli_fetch_assoc($infob);
					$bodega=$sinfo['bod_codigo'];
				}
				mysqli_query($con, "INSERT INTO `relacion_ubicaciones`(`codigo_pro`, `ubicacion`, `stock_ubi`, `fecha_ult_ent`,`ultimo_usuario`, `bod_codigo`, `cod_empresa`) VALUES ('".$row['codigo_pro']."','".$row['ubicacion']."','".$row['cantidad_mov']."','".$fecha_hoy."','".$_SESSION['k_username']."','".$bodega."','".$_SESSION['empresa']."')");
			}

			$pro=mysqli_query($con,"SELECT * FROM pro_stock WHERE codigo_pro='".$row['codigo_pro']."' LIMIT 1");
				if(mysqli_num_rows($pro)>0){
					mysqli_query($con, "UPDATE pro_stock SET stock_actual=(stock_actual+'".$row['cantidad_mov']."'), fecha_ult_com='".$fecha_hoy."'  WHERE codigo_pro='".$row['codigo_pro']."'");
				}else{
					$bodega=0000;
					$infob=mysqli_query($con, "SELECT bod_codigo FROM mov_detalle WHERE id_ref_mov='".$row['id_ref_mov']."'");
					if(mysqli_num_rows($infob)>0){
						$sinfo=mysqli_fetch_assoc($infob);
						$bodega=$sinfo['bod_codigo'];
					}
					mysqli_query($con, "INSERT INTO `pro_stock`(`codigo_pro`, `stock_actual`,`fecha_ult_com`, `usuario`, `bod_codigo`, `cod_empresa`) VALUES ('".$row['codigo_pro']."','".$row['cantidad_mov']."','".$fecha_hoy."','".$_SESSION['k_username']."','".$bodega."','".$_SESSION['empresa']."')");
				}

			mysqli_query($con, "UPDATE mov_inventario SET save_mov='1' WHERE id_mov='".$_POST['rad']."'");
		}
		$data = array("sucess" => '1');
		echo json_encode($data);
}
?>