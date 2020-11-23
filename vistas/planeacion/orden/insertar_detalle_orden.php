<?php
	include '../../../modelo/conexion.php';
//	include '../clases/clases.php';
//	include 'insertar_detalle_orden_sub.php';
	//$clases = new general();
	$colors = array();
	$colors_seconds = array();
	date_default_timezone_set("America/Bogota" );
	$hora = date('H:i:s',time() - 3600*date('I'));
	$status = "";
	$ref = $_GET["ord"];
	$can = $_GET["cantidad"];
        $tipo_vx =  $_GET["tipo"];
	$user = 0;
	if (isset($_GET['observaciones'])) {
		$obs = $_GET['observaciones'];
	} else {
		$obs = '';
	}
	$ubic = $_GET["ubicacion"];
	//$sql21 = ("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND c.id_cotizacion = " . $_GET["ord"]);
	//Quedaste por aqui optimizando los query, al terminar hay que pasarlos a insertar_detalle_orden_sub
	$sql21 = ("SELECT id_cot,id_vidrio,id_vidrio2,id_vidrio3,id_vidrio4,id_vidrio5,id_vidrio6,linea_cot, c.laminas, c.porcentaje_mp,id2_vidrio,id3_vidrio,id4_vidrio,cierre,ancho_abajo,sum(cantidad_c) as c1,sum(cant_restante) as cr,valor_c,estado_c,num_pedido,orden,hojas,cuerpo,linea,traz_vid,traz_vid2,traz_vid3,traz_vid4,modulo FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND c.id_cotizacion in (".$_GET["ord"].")");
	//$sql21 = ("SELECT * FROM producto a, cotizaciones c, cotizaciones_sub cs WHERE c.id_cotizacion = " . $_GET["ord"]. " AND c.id_cotizacion = cs.id_producto_cot AND (c.id_referencia = a.id_p OR cs.id_referencia_sub = a.id_p)");
	//
	$fila21 = mysqli_fetch_array(mysqli_query($conexion,$sql21));
	echo mysqli_error();
	$id = $fila21['id_cot'];
	
	$cons_vi = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $fila21['id_vidrio'] . " ";
	$fv = mysqli_fetch_array(mysqli_query($conexion,$cons_vi));
	$cons_vi2 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $fila21['id_vidrio2'] . " ";
	$fv2 = mysqli_fetch_array(mysqli_query($conexion,$cons_vi2));
	$cons_vi3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $fila21['id_vidrio3'] . " ";
	$fv3 = mysqli_fetch_array(mysqli_query($conexion,$cons_vi3));
	$cons_vi4 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $fila21['id_vidrio4'] . " ";
	$fv4 = mysqli_fetch_array(mysqli_query($conexion,$cons_vi4));
	$cons_vi5 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $fila21['id_vidrio5'] . " ";
	$fv5 = mysqli_fetch_array(mysqli_query($conexion,$cons_vi5));
	$cons_vi6 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = " . $fila21['id_vidrio6'] . " ";
	$fv6 = mysqli_fetch_array(mysqli_query($conexion,$cons_vi6));
	$linea_cot = $fila21["linea_cot"];
	
	$colors_seconds[] = $fv['color_v'];
	if ($fv2['color_v'] != '') {
		$colors_seconds[] = $fv2['color_v'];
	}
	if ($fv3['color_v'] != '') {
		$colors_seconds[] = $fv3['color_v'];
	}
	if ($fv4['color_v'] != '') {
		$colors_seconds[] = $fv4['color_v'];
	}
	if ($fv5['color_v'] != '') {
		$colors_seconds[] = $fv5['color_v'];
	}
	if ($fv6['color_v'] != '') {
		$colors_seconds[] = $fv6['color_v'];
	}
	
	/*foreach ($colors_seconds as $algo) {
		echo '<script lanquage="javascript">alert("' . $algo . '");</script>';
	}*/
	
	//echo '<script lanquage="javascript">alert("' . $linea_cot . '");</script>';
	if ($linea_cot == "Vidrio" || $linea_cot == "VIDRIO" || $linea_cot == "Vidrios Decoracion Jamar" || $linea_cot == "Puertas Batiente en Vidrio") {
		
		$colors[] = $fv['color_v'];
		if ($fv2['color_v'] != '') {
			$colors[] = $fv2['color_v'];
		}
		if ($fv3['color_v'] != '') {
			$colors[] = $fv3['color_v'];
		}
		if ($fv4['color_v'] != '') {
			$colors[] = $fv4['color_v'];
		}
		if ($fv5['color_v'] != '') {
			$colors[] = $fv5['color_v'];
		}
		if ($fv6['color_v'] != '') {
			$colors[] = $fv6['color_v'];
		}
	} else {
		$colors[] = $fv['color_v'];
	}
	
	/*foreach ($colors as $algo) {
		echo '<script lanquage="javascript">alert("' . $algo . '");</script>';
	}*/
	
	$laminas = $fila21["laminas"];
	$precio_mp = $fila21["porcentaje_mp"];
	$id_vidrio = $fila21["id_vidrio"];
	$id2_vidrio = $fila21["id2_vidrio"];
	$id3_vidrio = $fila21["id3_vidrio"];
	$id4_vidrio = $fila21["id4_vidrio"];
	$cierre = $fila21["cierre"];
	$ancho_c = $_GET["ancho"]; //Editado bslp
	//$ancho_c = $_GET["anchohid"];
	//Feditado
	$alto_c = $_GET["alto"];
	$aa = $fila21["ancho_abajo"];
	$cantidad_c = $fila21["c1"];
	$cantidad_r = $fila21["cr"];
	$valor_c = $fila21["valor_c"];
	$estado_c = $fila21["estado_c"];
	$num_pedido = $fila21["num_pedido"];
	$orden_p = $fila21["orden"];
	$color_v = $fv["color_v"];
	$espesor = $fv["espesor_v"];
	$color_v2 = $fv2["color_v"];
	$espesor2 = $fv2["espesor_v"];
	$color_v3 = $fv3["color_v"];
	$espesor3 = $fv3["espesor_v"];
	$color_v4 = $fv4["color_v"];
	$espesor4 = $fv4["espesor_v"];
	$hojas = $fila21["hojas"];
	$cuerpo = $fila21["cuerpo"];
	$codigo = $_GET['op'];
        //nuevo----parametros de medidas nuevas
        $mx = mysqli_query($conexion,"select * from medidas where op=".$codigo." ");
        $m = mysqli_fetch_array($mx);
        if($m[0]==''){
            $m1 = 400;
            $m2 = 200;
            $m3 = 400;
            $m4 = 200;
        }else{
            $m1 = $m[1];
            $m2 = $m[2];
            $m3 = $m[3];
            $m4 = $m[4];
        }
	$area = $fila21["linea"];
	$tc = $cantidad_r;
	$re = $tc - $can;
	$altura = $cuerpo;
	$altura_ventana = $_GET["alto"] - $cuerpo;
	$traz_vid = $fila21["traz_vid"];
	$traz_vid2 = $fila21["traz_vid2"];
	$traz_vid3 = $fila21["traz_vid3"];
	$traz_vid4 = $fila21["traz_vid4"];
	$modulo = $fila21["modulo"];
	$id_referencia = $_GET["id"];
	$id_ref_cambio = $_GET["id"];
	$lado = $_GET["lado"];
	/*$anmin = $_GET["anchohid"] - $m1;
	$anmax = $_GET["anchohid"] + $m2;*/
	$anmin = $_GET["anchocomp"] - $m1;
	$anmax = $_GET["anchocomp"] + $m2;
	//--------
	$almin = $_GET["altohid"] - $m3;
	$almax = $_GET["altohid"] + $m4;
	//echo "<script>alert('" . $_GET['anchohid'] . "' + ' - ' + '" . $_GET['ancho'] . "' + ' - ' + '" . $_GET['altohid'] . "' + ' - ' + '" . $_GET['alto'] . "' + ' - ' + '" . $anmin . "' + ' - ' + '" . $anmax . "' + ' - ' + '" . $almin . "' + ' - ' + '" . $almax . "');</script>";
	if ($_GET["ancho"] < $anmin || $_GET["ancho"] > $anmax) {
		echo 'El ancho digitado sobrepasa los descuento de la medida '.$anmin.' ancho max '.$anmax;
	} else {
		if ($_GET["alto"] < $almin || $_GET["alto"] > $almax) {
			echo 'El alto digitado supera los cambios establecido';
		} else {
			if ($_GET["cantidad"] > $cantidad_r) {
				echo 'la cantidad a producir es mayor a la cantidad pendiente'.$_GET["cantidad"].' > '. $cantidad_r.' | '.$_GET['ord'];
			} else {
				$query_select_contador_item = mysqli_query($conexion,"SELECT MAX(contador_item) AS contador_item FROM orden_detalle WHERE relacionado in (" . $_GET["ord"] . ") ");
				$row_contador_item = mysqli_fetch_array($query_select_contador_item);
				//-----
				$contador_item = $row_contador_item['contador_item'] + 1;
				//time_nanosleep(0, 100000000);//1 segundos
				//$aux_contador = $contador_item;
				$row_contador_item = mysqli_fetch_array($query_select_contador_item);
				if ($row_contador_item['contador_item'] == $contador_item) 
					$contador_item++; 
				//---------
				foreach ($colors as $color_vidrio) {
					//echo '<script lanquage="javascript">alert("' . $color_vidrio . '");</script>';
					$sql211 = "SELECT MAX(item_unico) FROM orden_detalle WHERE id_op in (" . $_GET["ord"] . ")";
					$fila211 = mysqli_fetch_array(mysqli_query($conexion,$sql211));
					$maxei = $fila211["MAX(item_unico)"] + 1;
					$producto = $_GET["producto"];
					//inserta orden detalle del item princical, los secundarios con en calculo_vidrios.php
					$sql = "INSERT INTO `orden_detalle`(`contador_item`,`des_ancho`,`des_alto`,`id_prod_cambio`, `lado`, `ubic`, `observaciones`, `estado_op`, `id_producto`, `relacionado`, `sede_od`, `asignado`,`descripcion`,`codigo`, `item_unico`, `producto_od`, `cantidad`, `cant_ordenada`, `medida1`, `medida2`, `medida3`, `color`,  `id_proceso`,`id_op`,`tipo_items`,`perforacion_item`,`boquete_item`)";
					$sql.= "VALUES ('".$contador_item."','".$_GET["anchod"]."','".$_GET["altod"]."','".$id_ref_cambio."', '".$lado."', '".$ubic."', '".$obs."', '1', '".$id_referencia."', '".$_GET["ord"]."', '".$area."', '".$user."','".$obs."','".$codigo."', '".$maxei."', '".$producto."', '".$tc."', '".$can."', '".$ancho_c."', '".$alto_c."', '".$espesor."', '".$color_vidrio."', '".$id_referencia."', '".$_GET["ord"]."', '".$tipo_vx."', '".$_GET["per"]."', '".$_GET["boq"]."')";
					mysqli_query($conexion,$sql);
					$status = "ok";
					$sqlt = "SELECT MAX(id_orden_d) FROM orden_detalle WHERE id_op in (" . $_GET["ord"] . ")";
					$filat = mysqli_fetch_array(mysqli_query($conexion,$sqlt));
					$max = $filat["MAX(id_orden_d)"];
					$n = $_GET["cantidad"];
					$por = 100 / $n;
					$paso = 1;
					//$consulta = mysqli_query($conexion,'select a.*, b.* from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$ref.' order by a.orden asc limit 1');
					//$fil = mysqli_fetch_array($consulta);
					//$id_subpr = $fil['id_subpro'];
					//$menor = mysqli_query($conexion,"SELECT * FROM subproceso_maq where ocupado=(select min(ocupado) from subproceso a, subproceso_maq b where a.id_subpro=b.id_subproceso and a.id_subpro=".$id_subpr.") and id_subproceso=".$id_subpr." ");
					//$mi = mysqli_fetch_array($menor);
					//$sig = $mi['paso_maq'];
					//$ma = "SELECT max(ocupado) FROM subproceso_maq where id_subproceso=".$id_subpr."";
					//$filt = mysqli_fetch_array(mysqli_query($conexion,$ma));
					//$maxa = $filt["max(ocupado)"] + 1;
					//$sql34 = "UPDATE `subproceso_maq` SET `ocupado`='".$maxa."' WHERE id_subproceso=".$id_subpr." and ocupado=".$filt["max(ocupado)"].";";
					//mysqli_query($conexion,$sql34);
					//
					//item_child_count
					$query_count = 'SELECT MAX(item_child_count) from procesos_activos;';
					$item_child_count = mysqli_fetch_array(mysqli_query($conexion,$query_count))['MAX(item_child_count)']+1;
					//echo $item_child_count;
					//
					for ($x=1; $x<=$n; $x=$x+1) {
						$barra = $max. '' . $maxei;
                                                $y =str_pad($x, 3, "0", STR_PAD_LEFT);
						$it = $barra . $y;
						$cc = $codigo . $y;
						$idare=0;
						if($area!='Vidrio' and $area!='Vidrios Decoracion Jamar' and $area!='Acero'){
							$paso=1;
							$idare=15;
						}else{
							$paso=1;
							$idare=1;
						}
						$sql1 = "INSERT INTO `procesos_activos`(`barra_item`, `area_proceso`, `area_id`, `barra`, `paso`, `paso_maq`, `id_op`, `id_orden_d`, `item`, `codigo`, `porcentaje`, `hora_in`, `fecha_in`, `fecha_llegada`, `hora_llegada`, `llegada`, `usuario`, `item_child_count`)";
						$sql1.= "VALUES ('".$it."', '".$area."', '".$idare."','".$barra."','".$paso."','0','".$_GET['op']."', '".$max."', '".$x."', '".$cc."', '".$por."', '".date("H:i:s")."', '".date("Y-m-d")."', '".date("Y-m-d")."', '".date("H:i:s")."', '".date("Y-m-d H:i:s")."', '".$user."', '".$item_child_count."')";
						mysqli_query($conexion,$sql1);
						echo mysqli_error();
					}
				}
				for ($lam=0; $lam<$laminas; $lam=$lam+1) {
					//echo "<script>alert('Entro " . " - " . $laminas . " - " . $traz_vid . "');</script>";
					if ($traz_vid != 0) {
						//echo "<script>alert('" . $lam . "' + ' - ' + '" . $colors_seconds[$lam] . "');</script>";
						if ($linea_cot != "Vidrios Decoracion Jamar") {
							require 'calculo_vidrios.php';
						}
					}
				}
					
				$sq = "SELECT COUNT(*) FROM `procesos_activos` WHERE id_op  " . $_GET['op'] . "";
				$fil = mysqli_fetch_array(mysqli_query($conexion,$sq));
				$con = $fil["COUNT(*)"];
				$t = 100 / $con;
				$sql3 = "UPDATE `procesos_activos` SET `por_global` = '" . $t . "' WHERE id_op = " . $_GET['op'] . ";";
				mysqli_query($conexion,$sql3);
				$sql4 = "UPDATE `cotizaciones` SET `cant_restante` = cant_restante -'$can' WHERE id_cotizacion in (" . $ref . ");";
				mysqli_query($conexion,$sql4);
                                
                                echo 'Se ha generado el sticker con exito';
			}
			//echo 'Ha ingresado a produccion';
			//insertar_subItems($item_child_count);
		}
	}
	
	//$clases ->mostrarOrden($_GET['op'],$_GET['cot'],$_GET['cli']);
?>