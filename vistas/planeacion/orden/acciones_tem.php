<?php
include '../../../modelo/conexion.php';
session_start();
if(isset($_SESSION['k_username'])){
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:
                  $tip=$_GET['tip'];
                  $num=intval($_GET['num']);
                  $pedfom=($_GET['num']);
                  $ped=($_GET['ped']);

                    $queryc = mysqli_query($conexion,"SELECT * FROM cotizacion where pedido='".$ped."' and estado!='Anulado'   ");
                    $fila2 = mysqli_fetch_array($queryc);
                    $estado= $fila2["estado"];
                    $orden= $fila2["orden"];
                    $ubicacion= $fila2["ubicacion"];
                    $obra= $fila2["obra"];
                    $id_cliente= $fila2["id_tercero"];
                    $asesor= $fila2["registrado"];
                    $responsable= $fila2["responsable"];
                    $tel_obra= $fila2["tel_responsable"];
                    $ciudad_obra= $fila2["ciudad"];
                    $fecha= $fila2["fecha_reg_c"];
                    $cotizacion= $fila2["id_cot"];
                    
                    $query = mysqli_query($conexion,"SELECT id_orden,ref, congelado,porque FROM orden_produccion where opf='".$num."' and tipofom='$tip' ");
                    $fila = mysqli_fetch_array($query);
                    if($fila[0]==''){
                        $s = "SELECT max(numero) FROM orden_produccion";
                        $fix =mysqli_fetch_array(mysqli_query($conexion,$s));
                        $maximo= $fix["max(numero)"]+1;

                        $op = $maximo;
  
                        $f1 = date("Y-m-d");
                        $fi = date("Y-m-d");
                        $ff = date("Y-m-d");


                        $sqlo = "INSERT INTO `orden_produccion`(`tipofom`,`pedido`,`generado_user`, `tipo_cli`, `referencia`,`ref`, `sede_op`,`proyecto`, `numero`, `fecha_registro`, `fecha_i`, `fecha_f`, `id_cliente`, `estado_o`, `opf`)";
                        $sqlo.= "VALUES ('".$tip."','".$ped."','".$_SESSION['id_user']."','Empresarial','".$orden."','".$cotizacion."','Vidrio','".$obra."', '".$op."', '".$f1."', '".$fi."', '".$ff."', '".$id_cliente."', 'En proceso', '".$pedfom."')";
                        mysqli_query($conexion,$sqlo);
                
                        $opm = mysqli_insert_id($conexion);
                        $estado = 0;$msj='';
                    }else{
                        $opm = $fila[0];
                        $estado = $fila[2];
                        $msj= $fila[3];
                    }
                    
                    $p = array();
                    $p[0] = $opm;
                    $p[1] = $cotizacion;
                    $p[2] = $tip;
                    $p[3] = mysqli_error($conexion);
                    $p[4] = $orden;
                    $p[5] = $estado;
                    $p[6] = $msj;
                echo json_encode($p); 
               exit();
        
        break;
    case 2:
        $idcot=$_GET['idcot'];
        $cod=$_GET['cod'];
        $med=$_GET['med'];
        $col=$_GET['col'];
        $can=$_GET['can'];
        $query = mysqli_query($conexion,"SELECT id_items FROM `cotizacion_pedidos` where id_cot='".$idcot."' and referencia='$cod' and medida='$med' and color='$col'   ");
        $items;
        while($fila = mysqli_fetch_array($query)){
            $items .= $fila[0].',';
        }
        
        echo substr($items, 0, -1);
         //543127,543147,
        
        break;
    case 3:
        $iditem=$_GET['iditem'];
         $queryc = mysqli_query($conexion,"SELECT *,sum(cantidad_c) as c1,sum(cant_restante) as cr FROM cotizaciones where id_cotizacion in (".$iditem.")   ");
                    $fila = mysqli_fetch_array($queryc);
                 $p = array();
                    if($fila['ancho_temp']==0){
                        $ancho = $fila['ancho_c'];
                        $alto = $fila['alto_c'];
                    }else{
                        $ancho = $fila['ancho_temp'];
                        $alto = $fila['alto_temp'];
                    }
                    $p[0] = $ancho;
                    $p[1] = $alto;
                    $p[2] = $fila['c1'];
                    $p[3] = $fila['cr'];
                    $p[4] = $fila['ubicacion_c'];
                    $p[5] = $fila['observaciones'];
                    if($fila['imagen']=='0'){
                      $di = 'N/A';  
                    }else{
                      $di = $fila['imagen'];
                    }
                    $p[6] = $di;
                    $p[7] = $fila['id_referencia'];
                    $p[8] = $fila['c1']-$fila['cr'];
                    $p[9] = $fila['per'];
                    $p[10] = $fila['boq'];
                    $p[11] = $fila['tip'];
                echo json_encode($p);
                // 543127,543147,
        break;
        case 4:
        $op=$_GET['op'];
            $sq = "SELECT congelado, id_reposicion, opf,ref FROM orden_produccion WHERE id_orden = " . $op;
			$fil = mysqli_fetch_array(mysqli_query($conexion,$sq));
			$congelado = $fil["congelado"];
			$reposicion = $fil["id_reposicion"];
			$opf = $fil["opf"];
                        $cot = $fil["ref"];
                        
         $queryc = mysqli_query($conexion,"SELECT * FROM orden_detalle a, producto b where a.id_producto=b.id_p and a.codigo='".$op."' AND a.anula=0  order by a.id_op asc   ");
         $c=0;
         $co = 0;
         while($fila = mysqli_fetch_array($queryc)){
             $c++;
            
                 $md = $fila['ancho_descuadre'];
                 $md2 = $fila['alto_descuadre'];
            
             $barra = $fila['relacionado'].$fila['contador_item'];
             $anu = '<input id="ido'.$c.'" type="hidden" value="'.$fila['id_orden_d'].'">'
                     . '<input name="anular" type="checkbox" id="'.$c.'" value="' . $row["id_orden_d"] . '">';
             
             $mystring = $fila['producto'];
             $perf   = 'PERFORACION';
             $pos = strpos($mystring, $perf);
             
                $mystring2 = $fila['producto'];
             $boqf   = 'BOQUETE';
             $pos2 = strpos($mystring2, $boqf);
             if($_GET['est']==0){
                 $disabled = '';
                    if ($pos === false) {
                       $disable_per = 'disabled';
                    } else {
                        $disable_per = '';
                    }
                    if ($pos2 === false) {
                        $disable_boq = 'disabled';
                    } else {
                        $disable_boq = '';
                    }
             }else{
                 $disabled = 'disabled';
                 $disable_per = 'disabled';
                 $disable_boq = 'disabled';
             }
             if($fila['parte_otro']==1){
                 if($fila['descomponer']==0){
                       $btnpartes = '<button type="button" onclick="partes('.$fila['id_orden_d'].')" title="Dividir medidas del vidrio" '.$disabled.'  data-toggle="modal" data-target="#ModalDescomponer"><img src="../../images/old_versions.png" alt="ver" height="20px" width="20px"> </button>';
                 }else{
                      $btnpartes = '';
                 }
                 $bgcolor='#DAEBFD';
                 $btntrazabilidad = '<button type="button" '.$disabled.' onclick="agregap('.$fila['id_orden_d'].')"><img src="../../images/modificar.png" alt="ver" height="20px" width="20px" title="Cambiar trazabilidad del vidrio"></button>';
                 $medidas_principal = '('.$fila['medida1_producto'].'x'.$fila['medida2_producto'].')';
             }else{
                 $bgcolor='#FCFCFC';
                 $btnpartes = '';
                 $medidas_principal = '';
                 $btntrazabilidad = '';
             }
             if($fila['imprimir']==1){
                 $bntimp = '';
             }else{
                 $bntimp = '<a target="_blank" href="http://172.16.0.40/planeacion/2/ex.php?u='.$fila['ubic'].'&ior='.$fila['id_orden_d'].'&cot='.$cot.'&orden='.$op.'&cant='.$fila['cant_ordenada'].'&cod_barra='.$barra.'&per='.$fila['perforacion_item'].'&boq='.$fila['boqete_item'].'&laminas=1&r='.$reposicion.'&opf='.$opf.'"><button type="button"><img src="../../images/barcode.png" alt="ver" height="20px" width="20px"></button></a>';
             }
             $co +=$fila['cant_ordenada'];
             echo '<tr title="'.$fila['modificado_por'].'" bgcolor="'.$bgcolor.'">'
         . '<td>'.$c.'</td>'
             . '<td>'.$fila['lado'].'<input type="hidden" id="id'.$fila['id_orden_d'].'" '.$disable_per.' value="'.$fila['id_producto'].'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:40px">'
                     . '<input type="hidden" id="itemsx'.$c.'"  value="'.$fila['relacionado'].'" ></td>'
             . '<td>'.$fila['tipo_items'].'</td>'
             . '<td><input type="text" id="namep'.$fila['id_orden_d'].'" disabled value="'.$fila['producto'].' '.$medidas_principal.'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:100%" >  </td>'
             . '<td><input type="text" id="ubicp'.$fila['id_orden_d'].'" '.$disabled.' value="'.$fila['ubic'].'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:100%" >  </td>'
             . '<td><input type="text" id="per'.$fila['id_orden_d'].'" '.$disable_per.' value="'.$fila['perforacion_item'].'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:40px"></td>'
             . '<td><input type="text" id="boq'.$fila['id_orden_d'].'" '.$disable_boq.' value="'.$fila['boquete_item'].'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:40px"></td>'
             . '<td><input type="text" id="med1'.$fila['id_orden_d'].'" '.$disabled.' value="'.$fila['medida1'].'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:50px">i<input type="text" id="meda1'.$fila['id_orden_d'].'" '.$disabled.' value="'.$md.'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:50px"></td>'
             . '<td><input type="text" id="med2'.$fila['id_orden_d'].'" '.$disabled.' value="'.$fila['medida2'].'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:50px">i<input type="text" id="meda2'.$fila['id_orden_d'].'" '.$disabled.' value="'.$md2.'" onchange="upitemsop('.$fila['id_orden_d'].')" style="width:50px"></td>'
             . '<td>'.$fila['color'].'</td>'
             . '<td>'.$fila['cant_ordenada'].'</td>'
             . '<td>'.$bntimp.'</td>'
             . '<td>'.$anu.' '.$btntrazabilidad.' '.$btnpartes.'</td>';
             // compuestos del pedido 
         }
         echo '<tr><td colspan="10"></td><td><input type="text" value="'.$co.'" style="width:50px" id="canord" disabled></td>'; 
        break;
        case 5:
        $op=$_GET['op'];
            $por = $_GET['ob'].', Mod:'.$_SESSION['k_username'].' dia:'.date("Y-m-d H:i");
            mysqli_query($conexion,"update orden_produccion set congelado='0', estado_o='En proceso', porque='$por'  WHERE id_orden=".$op."; ");
            echo '0';
            break;
         case 6:
        $op=$_GET['item'];
             $per=$_GET['per'];
             $boq=$_GET['boq'];
             $m1=$_GET['m1'];
             $m2=$_GET['m2'];
             
             $ma1=$_GET['ma1'];
             $ma2=$_GET['ma2'];
             $idpro=$_GET['idpro'];
             $ubi=$_GET['ubi'];
            $por = ''.$_SESSION['k_username'].' edito el items el dia:'.date("Y-m-d H:i");
            mysqli_query($conexion,"update orden_detalle set id_producto='$idpro',medida1='$m1', medida2='$m2',ancho_descuadre='$ma1', alto_descuadre='$ma2',des_ancho='$ma1', des_alto='$ma2',ubic='$ubi', perforacion_item='$per', boquete_item='$boq', modificado_por='$por'  WHERE id_orden_d=".$op."; ");
            mysqli_query($conexion,"update orden_detalle set per='$per', boq='$boq'  WHERE id_cotizacion=".$op."; ");
            echo '0';
            break;
    case 7:
        $op=$_GET['item'];
        $ord=$_GET['op'];
        $queryc = mysqli_query($conexion,"SELECT * FROM orden_detalle a, producto b where a.id_producto=b.id_p and a.id_orden_d='".$op."' AND a.anula=0   ");
         $c=0;
         $fila = mysqli_fetch_array($queryc);
             $mt = ($fila["medida1"] / 1000) * ($fila["medida2"] / 1000) * $fila["cant_ordenada"];
             echo '<tr>'
                     . '<td>'.$fila['id_orden_d'].'</td>'
                     . '<td>'.$fila['producto'].'</td>'
                     . '<td>'.$fila['color'].'</td>'
                     . '<td>'.$fila['ubic'].'</td>'
                     . '<td>'.$fila['medida1'].'</td>'
                     . '<td>'.$fila['medida2'].'</td>'
                     . '<td>'.number_format($mt,2).'</td>'
                     . '<td>'.$fila['cant_ordenada'].'</td>'
                     . '<td>'.$ord.'</td>';
         
             $querycd = mysqli_query($conexion,"SELECT * FROM orden_detalle a, producto b where a.id_producto=b.id_p and a.codigo='".$ord."' AND a.anula=0  and descomponer!=0  ");
         $metros_totales=0;
         while($f = mysqli_fetch_array($querycd)){
             $mtt = ($f["medida1"] / 1000) * ($f["medida2"] / 1000) * $f["cant_ordenada"];
             $metros_totales +=$mtt;
             echo '<tr>'
                     . '<td>'.$f['id_orden_d'].'</td>'
                     . '<td>'.$f['producto'].'</td>'
                     . '<td>'.$f['color'].'</td>'
                     . '<td>'.$f['ubic'].'</td>'
                     . '<td>'.$f['medida1'].'</td>'
                     . '<td>'.$f['medida2'].'</td>'
                     . '<td>'.number_format($mtt,2).'</td>'
                     . '<td>'.$f['cant_ordenada'].'</td>'
                     . '<td>-</td>';
        }
        $mt_pen = $mt - $metros_totales;
          echo '<tr>'
                     . '<td></td>'
                     . '<td>'.$fila['producto'].'</td>'
                     . '<td>'.$fila['color'].'</td>'
                     . '<td><input type="text" id="dubi" value="'.$fila['ubic'].'"></td>'
                     . '<td><input type="text" id="dmed1" value="0" style="width:60px"></td>'
                     . '<td><input type="text" id="dmed2" value="0" style="width:60px"></td>'
                     . '<td><input type="text" id="dmt" value="'.number_format($mt_pen,2).'" style="width:50px" disabled></td>'
                     . '<td><input type="text" id="dcant" value="1" style="width:30px"></td>'
                     . '<td><button id="btn" onclick="addpartes('.$fila['id_orden_d'].')">+</button></td>';
         
        
        break;
    case 8:
        $item=$_GET['item'];
        $m1=$_GET['m1'];
        $m2=$_GET['m2'];
        $ubi=$_GET['ubi'];
        $can=$_GET['can'];
        $codigo=$_GET['op'];
        $mt = ($m1 / 1000) * ($m2 / 1000) * $can;
        mysqli_query($conexion,"INSERT INTO `orden_detalle` (`codigo`, `items`, `item_unico`, `producto_od`, `cantidad`, `cant_ordenada`, `medida1`, `medida2`, `medida3`, `medida4`, `ancho_descuadre`, `alto_descuadre`, `color`, `id_proceso`, `id_op`, `sede_od`, `descripcion`, `asignado`, `id_user`, `piezas`, `tiene`, `relacionado`, `estado_op`, `id_producto`, `parte_otro`, `anula`, `ubic`, `observaciones`, `id_prod_cambio`, `lado`, `imprimir`, `descomponer`, `mt2`, `opf`, `id_reposicion`, `des_ancho`, `des_alto`, `perforacion_item`, `boquete_item`, `medida1_producto`, `medida2_producto`, `contador_item`, `updatepor`, `fechaupdate`, `tipo_items`, `descripcion_items`, `modificado_por`)"
                                                   . " select `codigo`, `items`, `item_unico`, `producto_od`, `cantidad`, '$can', '$m1', '$m2', `medida3`, `medida4`, `ancho_descuadre`, `alto_descuadre`, `color`, `id_proceso`, `id_op`, `sede_od`, `descripcion`, `asignado`, `id_user`, `piezas`, `tiene`, `relacionado`, `estado_op`, `id_producto`, `parte_otro`, `anula`, '$ubi', `observaciones`, `id_prod_cambio`, `lado`, '0', '$item', '$mt', `opf`, `id_reposicion`, `des_ancho`, `des_alto`, `perforacion_item`, `boquete_item`, `medida1_producto`, `medida2_producto`, `contador_item`, `updatepor`, `fechaupdate`, `tipo_items`, `descripcion_items`, `modificado_por` from orden_detalle where id_orden_d='$item' ");
                                           
        $max = mysqli_insert_id($conexion);
        $sql211 = "SELECT MAX(item_unico) FROM orden_detalle WHERE id_op = " . $item . "";
			$fila211 = mysqli_fetch_array(mysqli_query($conexion,$sql211));
			$maxei = $fila211["MAX(item_unico)"] + 1;
                        $n = $can;
                        $por = 100 / $n;
			$paso = 1;
			for ($x=1; $x<=$n; $x=$x+1) {
				$user = 0;
				$barra = $fil["relacionado"] . '' . $maxei;
				$it = $barra . $x;
				$cc = $codigo . $x;
				$sql1 = "INSERT INTO `procesos_activos`(`barra_item`, `area_proceso`, `barra`, `paso`, `paso_maq`, `id_op`, `id_orden_d`, `item`, `codigo`, `porcentaje`, `hora_in`, `fecha_in`, `fecha_llegada`, `hora_llegada`, `llegada`, `usuario`, `save`, `ubicacion`)";
				$sql1.= "VALUES ('" . $it . "', 'Vidrio', '" . $barra . "','" . $paso . "', '0', '" . $codigo . "', '" . $max . "', '" . $x . "', '" . $cc . "', '" . $por . "', '" . date("H:i:s") . "', '" . date("Y-m-d") . "', '" . date("Y-m-d") . "', '" . date("H:i:s") . "', '" . date("Y-m-d H:i:s") . "', '" . $user . "', '1', '" . $ubi . "')";
				mysqli_query($conexion,$sql1);
			}
                        
                        $sql3 = "UPDATE procesos_activos SET paso = 0 WHERE id_orden_d = " . $item;
			mysqli_query($conexion,$sql3);
			$sql33 = "UPDATE `orden_detalle` SET `imprimir` = '1' WHERE id_orden_d = " .$item. ";";
			mysqli_query($conexion,$sql33);
                        
        echo 'Se agrego con exito'.mysqli_error($conexion);
        
        break;
    case 9:
                  $tip=$_GET['tip'];
                  $num=intval($_GET['num']);
                  $pedfom=($_GET['num']);
                  $ped=($_GET['ped']);

                    
                    $query = mysqli_query($conexion,"SELECT id_orden,ref, congelado,porque,estado_o FROM orden_produccion where opf='".$num."' and tipofom='$tip' ");
                    $fila = mysqli_fetch_array($query);
                    if($fila['congelado']=='0'){
                        $color = '#EDF713';
                    }else if($fila['congelado']=='1'){
                        $color = '#F9DECC';
                    }else{
                        $color = '#E5F9CC';
                    }
                   
                      $p = array();
                      $p[0] = $fila['congelado'];
                      $p[1] = $fila['estado_o'];
                      echo json_encode($p);
                    // 3
                    break;

}
}
