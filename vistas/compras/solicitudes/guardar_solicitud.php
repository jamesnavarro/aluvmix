<?php
include '../../../modelo/conexioni.php';
include '../../../modelo/roles_user.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
$date = date("Y-m-d");

if(isset($_POST['items'])){
	$new=mysqli_query($con,"INSERT INTO `solicitudes_item`(`iva`,`undmed`,`codigo`, `id_sol`, `descripcion`, `date_added`, `cantidad`, `cantidad_pen`, `color`, `medida`, `user_id`, `precio`, `observacion`) VALUES ('".$_POST['iva']."','".$_POST['undmed']."','".$_POST['cod']."','0','".$_POST['nom']."','".$fecha_hoy."','".$_POST['stk']."','".$_POST['stk']."','".$_POST['col']."','".$_POST['med']."','".$_SESSION['id_user']."','".$_POST['pre']."','".$_POST['obs_sol']."')");
	if($new){
		$data = array("sucess" => '1');
	        echo json_encode($data);
	}else{
		$data = array("sucess" => '0');
	        echo json_encode($data);
	}
}

if(isset($_POST['orden'])){
	$maximo=0;
	$scan=mysqli_query($con, "SELECT max(id_sol) FROM solicitudes_new");
	if($row=mysqli_fetch_assoc($scan)){
		$maximo=$row['max(id_sol)']+1; 
                }
                
                $resultmax =mysqli_query($con, "SELECT consecutivo_compra FROM areas where area='".$_POST['area']."' ");
                $cc = mysqli_fetch_array($resultmax);
                $cos = $cc[0]+1;
	$ord=mysqli_query($con,"INSERT INTO `solicitudes_new`(`id_sol`, `fecha_reg`, `user_id`, `estado`, `area_reg`, `fecha_solicitada`, `cod_empresa`, `obs_solicitud`, `relacion`, `numero`, `archivo`, `cosecutivo`)"
                . " VALUES ('".$maximo."','".$fecha_hoy."','".$_SESSION['id_user']."','En Proceso','".$_POST['area']."','".$_POST['fech']."','TEMPLADO','".$_POST['notas']."','".$_POST['relax']."','".$_POST['num']."','".$_POST['arc']."','$cos')");
	 mysqli_query($con, "update areas set consecutivo_compra=consecutivo_compra+1 where area='".$_POST['area']."' ");
        
        if($ord){
		$camb=mysqli_query($con, "UPDATE solicitudes_item SET id_sol='".$maximo."' WHERE id_sol='0' and user_id='".$_SESSION['id_user']."'");
		if($camb){
			$data = array("sucess" => '1',"sol" => $maximo);
	        echo json_encode($data);
		}else{
			$data = array("sucess" => '0');
	        echo json_encode($data);
		}
                
	}else{
		$data = array("sucess" => '0');
	        echo json_encode($data);
	}
}

if(isset($_POST['edit'])){
	$edit=mysqli_query($con,"UPDATE `solicitudes_item` SET undmed='".$_POST['undmed']."',precio='".$_POST['pre']."', cantidad='".$_POST['stk']."', cantidad_pen='".$_POST['stk']."', observacion='".$_POST['obs_sol2']."' WHERE solicitud='".$_POST['edt']."'");
	if($edit){
		$data = array("sucess" => '1');
	        echo json_encode($data);
		}else{
			$data = array("sucess" => '0');
	        echo json_encode($data);
		}
}

if(isset($_POST['delitem'])){
	$del=mysqli_query($con,"DELETE FROM `solicitudes_item` WHERE solicitud='".$_POST['delitem']."'");
	if($del){
		$data = array("sucess" => '1');
	        echo json_encode($data);
	}else{
		$data = array("sucess" => '0');
	        echo json_encode($data);
	}
}
if(isset($_POST['send'])){
	$resta=0;
	$serach=mysqli_query($con,"SELECT codigo, color, medida, descripcion, cantidad_pen, precio,undmed FROM `solicitudes_item` WHERE solicitud='".$_POST['id']."' LIMIT 1");
	if($row=mysqli_fetch_assoc($serach)){
		$sql=mysqli_query($con, "INSERT INTO `orden_compra_detalle`(`codigo`, `codigo_orden`, `descripcion`, `cantidad`, `color`, `medida`, `user_id`, `cantidad_rec`, `cantidad_pend`, `id_sol`, `precio`, `undmed`, `solicitud`) VALUES ('".$row['codigo']."','0','".$row['descripcion']."','".$_POST['cant']."','".$row['color']."','".$row['medida']."','".$_SESSION['id_user']."','0','".$_POST['cant']."','".$_POST['sol']."','".$row['precio']."','".$row['undmed']."','".$_POST['id']."')");
		$resta=$row['cantidad_pen']-$_POST['cant'];
		if($sql){
			$mod=mysqli_query($con,"UPDATE `solicitudes_item` SET cantidad_pen='".$resta."' WHERE solicitud='".$_POST['id']."' LIMIT 1");
			if($mod){
				$data = array("sucess" => '1');
		        echo json_encode($data);
			}else{
				$data = array("sucess" => '0');
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

if(isset($_POST['ord'])){
	$orden= $_POST['ordenx'];
	$sum=mysqli_query($con,"SELECT sum(precio*cantidad_pend) as total FROM `orden_compra_detalle` WHERE codigo_orden=0 and id_sol='".$_POST['soli']."'");
	$row=mysqli_fetch_assoc($sum);
	$suma=$row['total'];
        if($orden==''){
            //inserta la orden de compra
            $max = mysqli_query($con,"SELECT max(codigo) FROM `orden_compra` ");
            $row2 = mysqli_fetch_row($max); 
            $maximo=$row2[0]+1;
            mysqli_query($con, "INSERT INTO `orden_compra`(`usuario`,`cod_cuenta`,`codigo`, `fecha`, `user_id`, `cod_ter`, `nom_ter`, `estado`, `bod_codigo`, `total`, `anticipo`, `fecha_anti`, `id_sol`, `sede_dir`, `cod-empresa`, `ordenfom`, `centro_costo`, `observaciones_compra`, `PORIVA`, `tipoORD`, `PORRET`, `retica`, `codica`)"
                    . " VALUES ('".$_SESSION['k_username']."','".$_POST['cue']."','".$maximo."','".$fecha_hoy."','".$_SESSION['id_user']."','".$_POST['cod_ter']."','".$_POST['nom_ter']."','En Proceso','".$_POST['bod']."','".$suma."','".$_POST['ant']."','".$_POST['fec']."','".$_POST['soli']."','".$_POST['sed']."','TEMPLADOS','".$_POST['ordfom']."','".$_POST['cencosto']."','".$_POST['observ']."','".$_POST['iva']."','".$_POST['tipo']."','".$_POST['ret']."','".$_POST['retica']."','".$_POST['codica']."')");
	    $success = mysqli_error($con);
            $msg = 0;
            //actualiza los items a la orden de compra
            //mysqli_query($con, "UPDATE orden_compra_detalle SET codigo_orden='".$maximo."' WHERE id_sol='".$_POST['soli']."' and codigo_orden=0");
            $act = mysqli_error($con);
//            
             mysqli_query($con, "UPDATE solicitudes_new SET ordencompra='".$maximo."' WHERE id_sol='".$_POST['soli']."' ");
//            
      
        }else{
             mysqli_query($con,"update `orden_compra` set  bod_codigo='".$_POST['bod']."' where codigo='$orden' ");
            $success = mysqli_error($con);
             $msg = 1;
             $maximo = $orden;
        }

               $data = array();
               $data[0] = $success;
               $data[1] = $maximo;
               $data[2] = $msg;
               $data[3] = $suma;
               echo json_encode($data);
	
	}
	if(isset($_POST['aprobar'])){
		$check=mysqli_query($con,"UPDATE solicitudes_new SET estado='aprobado', aprobado_por='".$_SESSION['k_username']."', pre_aprobado='".$_POST['por']."',fecha_aprobada='".date("Y-m-d H:i:s")."' WHERE id_sol='".$_POST['soli']."'"); 
		if($check){
			$data = array("sucess" => '1');
		    echo json_encode($data);
		}else{
			$data = array("sucess" => '0');
		    echo json_encode($data);
		}
	}

	if(isset($_POST['solix'])){
		$check=mysqli_query($con,"SELECT estado,ordencompra FROM solicitudes_new WHERE id_sol='".$_POST['solix']."'");
		if($row=mysqli_fetch_assoc($check)){
			$data = array("sucess" => '1',"estado" => $row['estado'],"acceso"=>$acces_user[28],"fom"=>$row['ordencompra']);
		    echo json_encode($data);
		}else{
			$data = array("sucess" => '0');
		    echo json_encode($data);
		}
	}
	if(isset($_POST['enca'])){
		$check=mysqli_query($con,"SELECT * FROM solicitudes_new WHERE id_sol='".$_POST['enca']."'");
		$row=mysqli_fetch_array($check);
                    
				$sql=mysqli_query($con,"SELECT usuario FROM usuarios WHERE id_user='".$row['user_id']."' LIMIT 1");
				$raw=mysqli_fetch_array($sql);
                                if($row['archivo']==''){
                                    $arc = '';
                                }else{
                                    $arc = ' <a href="../vistas/archivos/'.$row['archivo'].'" target="_blank">Soporte de Cotizacion </a> ';
                                }
                                $co = strtoupper(substr($row['area_reg'],0, 4));
				$data = array("sucess" => '1',"error" => mysqli_error($con),"estado" => $row['estado'],"sol" => $row['id_sol'],"fecc" => $row['fecha_reg'],"estado" => $row['estado'],"area" => $row['area_reg'],"fece" => $row['fecha_solicitada'],"user" => $raw['usuario'],"user2" => $row['aprobado_por'],"por" => $row['pre_aprobado'],"notas" => $row['obs_solicitud'],"rel" => $row['relacion'].'&nbsp;&nbsp;&nbsp;'.$row['numero'],"acceso"=>$acces_user[28],"arc"=>$arc,"con" => $co.'-'.$row['cosecutivo']);
		   		 echo json_encode($data);
		
	}
        
        if(isset($_POST['anular'])){
	      mysqli_query($con,"update solicitudes_new set estado='Anulado' where id_sol='".$_POST['ordenx']."'");
              echo 'Se ha anulado la solicitud.';
	}

?>
