<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = 'TEMPLADOS';
switch ($_GET['sw']) {
        
            case 1:
                 $ids=$_GET['tipo'];
                 $query = mysqli_query($con,"SELECT * FROM tipos_movimientos where codigo_tm='$ids' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo_tm']; 
                 $p[1]=$fila['movimiento'];
                 $p[2]=$fila['observacion'];
                 $p[3]=$fila['ult_cons'];
                 $p[4]=$fila['id_codigo'];
                 $p[5]=$fila['id_fuente'];
                 $p[6]=$fila['estado_mov'];
                 $p[7]=$fila['jala_orden'];
                 $p[8]=$fila['act_cont'];
                 $p[9]=$fila['equivalencia'];
                 $p[10]=$fila['cent_cos'];
            echo json_encode($p); 
            exit();
            break;
            case 2:
                  $id=$_GET['cod'];
                 $col=$_GET['col'];
                 $query = mysqli_query($con,"SELECT * FROM productos_var where codigo='$id'");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo']; 
                 $p[1]=$fila['referencia'];
                 $p[2]=$fila['descripcion'];
                 echo json_encode($p); 
               exit();
            break;
        case 3:
                 $cod=$_GET['cod'];
                 $bod=$_GET['bod'];
                 $col=$_GET['col'];
                 $med=$_GET['med'];
                 $tipo=$_GET['tipo']; 
                 if($tipo=='ENTRADA'){
                     $disable = 'disabled';
                    echo '<tr>'
                     . '<td>'.$cod.'</td>'
                             . '<td><input type="text" id="u_col" value="'.$col.'" style="width:80px" disabled></td>'
                             . '<td><input type="text" id="u_ubi" value="" style="width:80px" onclick="buscarb()"></td>'
                             . '<td><input type="text" id="u_can" value="" style="width:50px" disabled></td>'
                             . '<td><input type="text" id="u_ing" value="" style="width:50px"></td>'
                             . '<td><button onclick="addubi('.$fila['id_ru'].')" id="botonubi">Agregar</button></td>'; 
                 }else{
                     $disable = '';
                 }
                 $query = mysqli_query($con,"SELECT * FROM relacion_ubicaciones where stock_ubi>0 and bod_codigo='$bod' and codigo_pro='$cod' "); //consultA modificada por navabla
                 while($fila = mysqli_fetch_array($query)){
                     echo '<tr>'
                     . '<td>'.$fila['codigo_pro'].'</td>'
                             . '<td><input type="text" id="u_col'.$fila['id_ru'].'" value="'.$fila['color_ubi'].'" style="width:80px" disabled></td>'
                             . '<td><input type="text" id="u_ubi'.$fila['id_ru'].'" value="'.$fila['ubicacion'].'" style="width:80px" disabled></td>'
                             . '<td><input type="text" id="u_can'.$fila['id_ru'].'" value="'.$fila['stock_ubi'].'" style="width:50px" disabled></td>'
                             . '<td><input type="text" id="u_ing'.$fila['id_ru'].'" value="" style="width:50px" '.$disable.'></td>'
                             . '<td><button onclick="addubi('.$fila['id_ru'].')" '.$disable.'>Agregar</button></td>';
                 }
                 
                 
            break;
            case 3.1:
                 $cod=$_GET['cod'];
                 $bod=$_GET['bod'];
                 $col=$_GET['col'];
                 $med=$_GET['med'];
                 $query = mysqli_query($con,"SELECT * FROM `relacion_ubicaciones` WHERE bod_codigo='$bod' and codigo_pro='$cod' and stock_ubi>0 "); //consultA modificada por navabla
                 while($fila = mysqli_fetch_array($query)){
                     echo '<tr>'
                     . '<td><input type="text" id="'.$fila['id_ru'].'" value="'.$cod.'" style="width:80px" disabled></td>'
                             . '<td><input type="text" id="'.$fila['id_ru'].'" value="'.$fila['ubicacion'].'" style="width:80px" disabled></td>'
                             . '<td><input type="text" id="'.$fila['id_ru'].'" value="'.$fila['stock_ubi'].'" style="width:50px" disabled></td>'
                             . '';
                 }
                 
            break;
        case 4:
             $id=$_GET['rad'];
            $doc=$_GET['doc'];
            $cc=$_GET['cc'];
            $obs=$_GET['obs'];
            $compra=$_GET['compra'];
            $factura=$_GET['factura'];
            $almori=$_GET['almori'];
            $totalx=$_GET['totalx'];
            $est=$_GET['est'];
            $ter=$_GET['ter'];
            $diferencia=$_GET['diferencia'];
            $sede=$_GET['sede'];
            $descarga=$_GET['descarga'];
            $docfom=$_GET['docfom'];
            $ced=$_GET['ced'];
            $tipo=$_GET['tipo'];
            $puesto=$_GET['puesto'];
           
            if($id==''){
                $ver=mysqli_query($con,"insert into mov_inventario (`rad_fom`,`sede`,`codigo_tm`,`cen_codigo`,`obs`,`id_orden`,`num_documento`,`bod_codigo`,`total`,`save_mov`,`codigo_ter`,`diferencia`,`usuario`,`tipo_movimiento`,`cod_empresa`,`tipo_orden`,`tercerofom`,`id_puesto`)"
                        . " values ('$docfom', '$sede','$doc','$cc','$obs','$compra','$factura','$almori','$totalx','$est','$ter','$diferencia','$usuario','$descarga','$empresa','$tipo','$ced','$puesto')");
        
                $ultimo = mysqli_insert_id($con);
                $error = mysqli_error($con);
                $p = array();
                $p[0] = $ultimo;
                $p[1] = date("Y-m-d");
                $p[2] = $usuario;
                $p[3] = $error;
                echo json_encode($p);
            }
            else{
                mysqli_query($con,"update mov_inventario set rad_fom='$docfom',sede='$sede',codigo_tm='$doc', cen_codigo='$cc', obs='$obs', id_orden='$compra', num_documento='$factura', bod_codigo='$almori', total='$totalx', save_mov='$est', codigo_ter='$ter', diferencia='$diferencia', usuario='$usuario', tipo_movimiento='$descarga' where cod_marca='$cod'");
               
                 $p = array();
                $p[0] = $id;
                $p[1] = date("Y-m-d");
                $p[2] = $usuario;
                echo json_encode($p);
            }
            
            break;
             case 5:
                  $tip=$_GET['tip'];
                  $num=$_GET['num'];
                 $query = mysqli_query($con,"SELECT id_mov,usuario,save_mov,fecha_pro,bod_codigo FROM mov_inventario where rad_fom='$num' and codigo_tm='$tip' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                    $p[0] = $fila[0];
                    $p[1] = $fila[1];
                    $p[2] = $fila[2];
                    $p[3] = $fila[3];
                    $p[4] = $fila[4];
                echo json_encode($p); 
               exit();
            break;
        case 6:
                  $id=$_GET['rad'];
                  $cod=$_GET['cod'];
                  $col=$_GET['col'];
                 $query = mysqli_query($con,"SELECT id_ref_mov FROM mov_detalle where id_mov='$id' and pro_codigo='$cod' and color='$col' ");
                 $fila = mysqli_fetch_array($query);
                 
                 $lis=mysqli_query($con, "SELECT SUM(cantidad_mov) FROM mov_detalle_ubi WHERE id_ref_mov!=0 and id_ref_mov='".$fila[0]."' and codigo_pro='".$cod."'");
		 $ress=mysqli_fetch_assoc($lis);
		 $resta=($ress['SUM(cantidad_mov)']);
                        
                 $p = array();
                    $p[0] = $fila[0];
                    $p[1] = $_GET['can']-$resta;
                echo json_encode($p); 
                
               exit();
            break;
        case 6.1:
                 $id=$_GET['id'];
                 $lis=mysqli_query($con, "DELETE FROM mov_detalle_ubi WHERE id_mov='".$id."' ");
		 
                
               exit();
            break;
        case 6.2:
                 
                  $ref=$_GET['idi'];
                  $rad=$_GET['rad'];
                  $bod=$_GET['bod'];
                  $descarga=$_GET['descarga'];
                  
                 $lis=mysqli_query($con, "SELECT * FROM mov_detalle_ubi WHERE id_mov='".$rad."' and id_ref_mov='$ref' ");
                 while ($row = mysqli_fetch_array($lis)) {
                     $ubi = $row['ubicacion'];
                     $can = $row['cantidad_mov'];
                     $col = $row['color_du'];
                     $loc = $row['bodega'];
                     $cod = $row['codigo_pro'];
                     if($descarga=='SALIDA'){
                         mysqli_query($con,"update `relacion_ubicaciones` set stock_ubi=stock_ubi+'$can' WHERE bod_codigo='$loc' and codigo_pro='$cod'  and ubicacion='$ubi' and color_ubi='$col' "); //consultA modificada por navabla
                      
                     }else{
                         mysqli_query($con,"update `relacion_ubicaciones` set stock_ubi=stock_ubi-'$can' WHERE bod_codigo='$loc' and codigo_pro='$cod'  and ubicacion='$ubi' and color_ubi='$col' "); //consultA modificada por navabla
                     
                     }
                     
                 }
                 
                 $lise=mysqli_query($con, "DELETE FROM mov_detalle_ubi WHERE id_mov='".$rad."' and id_ref_mov='$ref' ");
                 echo 'Se devolvieron las cantidades a su bodega actual';
		 
                
               exit();
            break;
        case 7:
               
               $rad = $_GET['rad'];
               $cod = $_GET['cod'];
               $loc = $_GET['loc'];
               $cant = $_GET['cant'];
               $ubi = $_GET['ubi'];
               $cost = $_GET['cost'];
               $idmd = $_GET['idmd'];
               $st = $_GET['st'];
               $color = $_GET['color'];
               $tipo = $_GET['tipo'];
               //esta parte se actualiza al momento de guardar. 321532033 
               $result = mysqli_query($con,"select count(codigo_pro), cantidad_mov from mov_detalle_ubi where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' and color_du='$color' ");
               $r = mysqli_fetch_row($result);
               $saldo = $r[1];
               if($r[0]==0){
                   $resultu = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$loc' and ubicacion='$ubi' and color_ubi='$color'");
                   $ru = mysqli_fetch_row($resultu);
                   $saldo = $ru[0];
                   if($tipo=='SALIDA'){
                    mysqli_query($con,"update `relacion_ubicaciones` set stock_ubi=stock_ubi-'$cant' WHERE bod_codigo='$loc' and codigo_pro='$cod'  and ubicacion='$ubi' and color_ubi='$color' "); //consultA modificada por navabla
                   }
                    mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`saldo_ubicacion`,`estado_mu`,`id_mov`,`id_ref_mov`,`bodega`, `codigo_pro`, `ubicacion`, `cantidad_mov`,  `fecha_ult_com`, `user_ult_com`, `costo_ult_com`, `color_du`) "
                       . "VALUES ('".$saldo."','0', '".$rad."','".$idmd."','".$loc."','".$cod."','".$ubi."','".$cant."','".date("Y-m-d")."','".$_SESSION['k_username']."', '".$cost."', '".$color."')");
              echo 'Se registro con exito. '.mysqli_error($con).' $cod:'.$cod.' $ubi'.$ubi.' $loc'.$loc.' $color'.$color ;
               }else{
                   mysqli_query($con,"update mov_detalle_ubi set saldo_ubicacion='$saldo',cantidad_mov=cantidad_mov+'$cant',  fecha_ult_com='".date("Y-m-d")."',user_ult_com='".$_SESSION['k_username']."',costo_ult_com='$cost' where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' and color_du='$color' ");
                   if($tipo=='SALIDA'){
                   mysqli_query($con,"update `relacion_ubicaciones` set stock_ubi=stock_ubi-'$cant' WHERE bod_codigo='$loc' and codigo_pro='$cod'  and ubicacion='$ubi' and color_ubi='$color' "); //consultA modificada por navabla
                   }
                   echo 'Se actualizo con exito. '.mysqli_error($con).' saldo:'.$saldo;
                   
               }
               
//               mysqli_query($con, "insert into mov_productos (id_mov,id_md,codigo_pro,ubicacion,cantidad,bodega)"
//                                . " values('".$rad."','".$idmd."','".$cod."','".$ubi."','".$cant."','".$loc."')");
               
               break;
            case 8:
                $idi = $_GET['idi'];
                $cod = $_GET['cod'];
                $lis=mysqli_query($con, "SELECT SUM(cantidad_mov) FROM mov_detalle_ubi WHERE id_ref_mov='".$idi."' and codigo_pro='".$cod."'");
		   	$ress=mysqli_fetch_assoc($lis);
		   	echo $resta=intval($ress['SUM(cantidad_mov)']);
                
                
                break;
             case 9:
               $rad = $_GET['rad'];
               $dif = $_GET['dif'];
               $tipo = $_GET['tipo'];
               $ord = $_GET['ord'];
               $fom = $_GET['fom'];
               $puesto = $_GET['puesto'];
               //cambio de estado a 1
               mysqli_query($con, "update mov_inventario set save_mov='1',pendiente='0',usuario='".$_SESSION['k_username']."' where id_mov='$rad'  ");
               mysqli_query($con, "update mov_detalle_ubi set estado_mu='1' where id_mov='$rad' ");
               mysqli_query($con, "update mov_detalle set estado_mov='1',id_puesto='$puesto' where id_mov='$rad'  ");
               
               if($tipo=='ENTRADA'){
                   mysqli_query($con, "update orden_compra set estado='Completada' where codigo='$ord'  ");
               }
               
               $result = mysqli_query($con,"select * from mov_detalle_ubi where id_mov='$rad' and estado_mu='1' ");
               $error = '';
               while($f = mysqli_fetch_array($result)){
                   $cod = $f['codigo_pro'];
                   $ubi = $f['ubicacion'];
                   $can = $f['cantidad_mov'];
                   $bod = $f['bodega'];
                   $saldo = $f['saldo_ubicacion'];
                   $color = $f['color_du'];
                   $query = mysqli_query($con, "select count(codigo_pro) from relacion_ubicaciones where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' ");
                   $c = mysqli_fetch_array($query);
                   
                   $calculo = mysqli_query($con, "select sum(cantidad*valor_unidad) as vt,sum(cantidad) as ct from mov_detalle where pro_codigo='$cod' and estado_mov='1' ");
                   $cc = mysqli_fetch_array($calculo);
                   $precio_total = $cc[0];
                   $cantidad_total = $cc[1];
                   $precio_promedio = $precio_total / $cantidad_total;
                   if($c[0]==0){
                       mysqli_query($con,"insert into relacion_ubicaciones (codigo_pro,ubicacion,stock_ubi,fecha_ult_ent,ultimo_usuario,bod_codigo,cod_empresa,costo_ultimo, color_ubi)"
                               . " values ('$cod','$ubi','$can','".date("Y-m-d")."','".$usuario."','$bod','$empresa','$precio_promedio','$color')");
                   
                       $error = $error.$c[0].'-insert';
                   }else{
                       if($tipo=='ENTRADA'){
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi+'$can',costo_ultimo='$precio_promedio' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' ");// and color_ubi='$color'
                       }else{
                            //mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$can' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod'  ");//and color_ubi='$color'
                       
                           // $falla = mysqli_error($con); modificado el 21 de mayo 2021
                            $falla = '';
                       }
                       $error = $error.$can.'-'.$tipo.'-'.$falla;  
                   }
                   
               }
               echo $error;
               
               break;
            }

