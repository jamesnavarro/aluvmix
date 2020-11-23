<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['rad_cap'];
            $fec_cap=$_GET['fec_cap'];
            $al_cap=$_GET['al_cap'];
            $alm_cap=$_GET['alm_cap'];
            $proc_cap=$_GET['proc_cap'];
            $usu_cap=$usuario;
            $est_cap=$_GET['est_cap'];
            $sede=$_GET['sede'];
           
            if($id==''){
                $ver=mysqli_query($con, "insert into capturas (`sede`,`fecha_cap`,`cod_bodega`,`nom_bod`,`linea`,`registrado_por`,`estado`)"
                        . "values ('$sede','$fec_cap','$al_cap','$alm_cap','$proc_cap','$usu_cap','$est_cap')");
                mysqli_error($con);

                $id = mysqli_insert_id($con);

                
            }
            else{
//                $estado='Guardado';
                mysqli_query($con,"update capturas set fecha_cap='$fec_cap', cod_bodega='$al_cap', nom_bod='$alm_cap', linea='$proc_cap', registrado_por='$usuario', estado='1' where id_captura='$id'");
//                $estado='Guardado';
                $error='';
                $resultx = mysqli_query($con, "select * from capturas_items where id_captura='$id' ");
                    while($r = mysqli_fetch_array($resultx)){
                        $cod = $r['pro_codigo'];
                        $ubi = $r['ubicacion'];
                        $bod = $r['bod_codigo'];
                        $color = $r['color_ubi'];
                        $med = $r['medida'];
                        mysqli_query($con, "UPDATE `relacion_ubicaciones` SET `stock_ubi` = '0' WHERE codigo_pro='$cod' and bod_codigo='$bod'  ");
                         //mysqli_query($con, "update relacion_ubicaciones set stock_ubi='0' where codigo_pro='$cod' and bod_codigo='$bod' and color_ubi='$color' and medida='$med' ");
                       $error =  $cod;
                        }
            }
            $p = array(); 
                     $p[0]=$id;
                     $p[1]=$error;
                     $p[2]=date('Y-m-d'); 
                      
            echo json_encode($p); 
            exit();
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM capturas where id_captura='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                     $p = array(); 
                     $p[0]=$fila['id_captura'];
                     $p[1]=$fila['fecha_cap'];
                     $p[2]=$fila['cod_bodega']; 
                     $p[3]=$fila['nom_bod'];
                     $p[4]=$fila['linea'];
                     $p[5]=$fila['registrado_por'];
                     $p[6]=$fila['estado'];
                     $p[7]=$fila['sede'];
                     if($fila['liquidacion']==0){
                         $p[8]= '<button onclick="preliq()" class="btn btn-success" type="button">Liquidar</button>';
                     }else{
                         $p[8]= '';
                     }
            echo json_encode($p); 
            exit();
            break;
//            case 3:
//               $id=$_GET['id'];
//               $query = ("delete from cuenta_cobro where id_cuenta='$id' ");
//            break;
        
//            case 4:
//                 $id=$_GET['cod'];
//                $query = mysqli_query($con,"SELECT * FROM cuenta_cobro where id_cuenta='$id' "); //consultA modificada por navabla
//                 $fila = mysqli_fetch_array($query);
//                    $p = array(); 
//                   $p[0]=$fila['id_cuenta'];
//                   $p[1]=$fila['puesto'];
//                   $p[2]=$fila['estado']; 
//                   $p[3]=$fila['operacion'];
//                   $p[4]=$fila['por'];
//                   $p[5]=$fila['fecha'];
//            echo json_encode($p); 
//            exit();
//            break;
//           
           case 5:
          
                 $id_servicio=$_GET['id_servicio'];
                 $des_s=$_GET['des_s'];
                 $cant_s=$_GET['cant_s'];
                 $val_s=$_GET['val_s'];
                 $totl_s=$_GET['totl_s'];
                 $id_cta_c=$_GET['id_cta_c'];
                 $id_itm=$_GET['id_itm'];
                 $puesto=$_GET['puesto'];
                 $movimiento=$_GET['movimiento'];
            if($id_itm==''){
                  $ver=mysqli_query($con,"insert into cuenta_cobro_items(`id_cuenta`,`id_servicio`,`descripcion`,`cantidad`,`valor_unidad`,`valor_total`,`registrado`,`id_puestos`,`movimientos`)"
                                                               ."values ('$id_cta_c','$id_servicio','$des_s','$cant_s','$val_s','$totl_s','$usuario','$puesto','$movimiento')");
                echo mysqli_error($con);
            }else{
                mysqli_query($con,"update cuenta_cobro_items set  cantidad='$cant_s', valor_unidad='$val_s', valor_total='$totl_s', registrado='$usuario', id_puestos='$puesto', movimientos='$movimiento' where id='$id_itm'");
                echo $id_itm;
            }
          
        
            break;
        
        case 6:
                $id=$_GET['id'];
                $query = mysqli_query($con,"delete from cuenta_cobro_items where id='$id' ");
            break;
        
        
        
         case 7:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cuenta_cobro_items a, puestos_trabajos b where a.id=b.id_puesto and  id='$id' "); 
                 $fila = mysqli_fetch_array($query);
                     $p = array(); 
                     $p[0]=$fila['id_cuenta'];
                     $p[1]=$fila['id_servicio'];
                     $p[2]=$fila['descripcion']; 
                     $p[3]=$fila['cantidad'];
                     $p[4]=$fila['valor_unidad'];
                     $p[5]=$fila['valor_total'];
                     $p[6]=$fila['id_puestos'];
                     $p[7]=$fila['movimientos'];
                
            echo json_encode($p); 
            exit();
            break;
        
         case 8:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where cod_ter='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);

                  $p = array(); 
                     $p[0]=$fila['cod_ter'];
                     $p[1]=$fila['nom_ter'];
            echo json_encode($p); 

            exit();
            break;
        case 9:
            $idc=$_GET['idc'];
            $result = mysqli_query($con, "select * from capturas_items a, productos_var b where a.pro_codigo=b.codigo and a.id_captura='$idc' ");
            while($r = mysqli_fetch_array($result)){
                if($r['capcolor']==''){
                    $colo = $r['color'];
                }else{
                    $colo = $r['capcolor'];
                }
                echo '<tr>'
                        . '<td>'.$r['codigo'].'</td>'
                        . '<td>'.$r['descripcion'].'</td>'
                        . '<td>Und</td>'
                        . '<td><input type="" id="cap_col'.$r['id_ci'].'" value="'.$colo.'" style="width:100px" disabled> <img src="../imagenes/buscar.png" onclick="buscarcolor('.$r['id_ci'].')"  data-toggle="modal" data-target="#myModal" style="height:15px"></td>'
                        . '<td>'.$r['ancho'].'</td>'
                        . '<td>'.$r['cantidad'].'</td>'
                        . '<td>'.$r['ubicacion'].'</td>'
                        . '<td><button class="btn btn-danger" onclick="borrarcap('.$r['id_ci'].')"><i class="ace-icon fa fa-times red2"></i></button></td>';
            }
            
            break;
        case 10:
            $id = $_GET['id'];
            mysqli_query($con, "DELETE FROM `capturas_items` WHERE `id_ci` ='$id' ");
            
            
            break;
        case 11;
            $idc = $_GET['idc'];
            $max = '';
            //SALIDA DE INVENTARIO
            $result = mysqli_query($con, "select COUNT(*) from capturas_items where id_captura='$idc' and diferencia<0 ");
            $s = mysqli_fetch_array($result);
            if($s[0]>0){
            
                $doc='1012';
                $cc='';
                $obs='AJUSTE DE INVENTARIO';
                $compra='0';
                $factura=0;
                $almori=$_GET['almori'];
                $totalx=0;
                $est=1;
                $ter='800112904-6';
                $diferencia=0;
                $sede=$_GET['sede'];
                $descarga='SALIDA';
                $ver=mysqli_query($con,"insert into mov_inventario (`sede`,`codigo_tm`,`cen_codigo`,`obs`,`id_orden`,`num_documento`,`bod_codigo`,`total`,`save_mov`,`codigo_ter`,`diferencia`,`usuario`,`tipo_movimiento`,`cod_empresa`)"
                        . " values ('$sede','$doc','$cc','$obs','$compra','$factura','$almori','$totalx','$est','$ter','$diferencia','$usuario','$descarga','$empresa')");
                $ultimo = mysqli_insert_id($con);
                $max = $max.' '.$ultimo.' ';
                $result2 = mysqli_query($con, "select * from capturas_items a, productos_var b where a.pro_codigo=b.codigo and a.id_captura='$idc' and a.diferencia<0 ");
                $tt = 0;
                while($rw = mysqli_fetch_array($result2)){
                     $rad=$ultimo;
                     $des=  str_replace('"','',$rw['descripcion']);
                     $col=$rw['capcolor'];
                     $med=$rw['capmedida'];
                     
                     $can=abs($rw['diferencia']);
                     $pre=$rw['costo_promedio'];
                     $cod=$rw['codigo_pro'];
                     $almori=$almori;
                     //para sumar el total del documento
                      $dif =  abs($rw['diferencia']);
                      $costot = $pre * $dif;
                       $tt += $costot;
                      //fin del calculo
                    
                     //se agrega el items en la tabla de mov_detalle
                     $result3 = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$almori' and color_ubi='$col' and medida='$med' ");
                     $r = mysqli_fetch_row($result3);
                     $saldo = $r[0];
                     $saldorel = $r[0];

                     mysqli_query($con,"insert into mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                                ."values ('$rad','$des','$col','$med','$saldo','$can','$pre','$cod','$almori','1')");
                         $idmd = mysqli_insert_id($con);
                         //fin de proceso mov_detalle
                         
                         //se agrega a la ubicacion
                           $loc = $almori;
                           $cant = abs($rw['diferencia']);
                           $ubi = $rw['ubicacion'];
                           $cost = $rw['costo_promedio'];
                           $idmd = $idmd;
                           $st = $_GET['st'];
                           //esta parte se actualiza al momento de guardar.
                           $result4 = mysqli_query($con,"select count(codigo_pro), cantidad_mov from mov_detalle_ubi where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' ");
                           $rr = mysqli_fetch_row($result4);
                           $saldo = $rr[1];
                           if($rr[0]==0){
                               $resultu = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$loc' and ubicacion='$ubi' and color_ubi='$col' and medida='$med' ");
                               $ru = mysqli_fetch_row($resultu);
                               $saldo = $ru[0];
                             

                                mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`saldo_ubicacion`,`estado_mu`,`id_mov`,`id_ref_mov`,`bodega`, `codigo_pro`, `ubicacion`, `cantidad_mov`,  `fecha_ult_com`, `user_ult_com`, `costo_ult_com`, `color_du`, `medida_du`) "
                                   . "VALUES ('".$saldo."','1', '".$rad."','".$idmd."','".$loc."','".$cod."','".$ubi."','".$cant."','".date("Y-m-d")."','".$_SESSION['k_username']."', '".$cost."', '".$col."', '".$med."')");

                           }else{
                               mysqli_query($con,"update mov_detalle_ubi set saldo_ubicacion='$saldo',cantidad_mov='$cant',  fecha_ult_com='".date("Y-m-d")."',user_ult_com='".$_SESSION['k_username']."',costo_ult_com='$cost' where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and color_du='$col' and medida_du='$med' and id_mov='$rad' ");
                           }
                         //fin de ubicacion

                      }
                      //se actualizar el valor total del documento
                      mysqli_query($con, "update mov_inventario set save_mov='1',total='$tt' where id_mov='$ultimo'  ");
                      //se actualiza el stock general
                           $tipo = $descarga;
                           $result4 = mysqli_query($con,"select * from mov_detalle_ubi where id_mov='$rad' and estado_mu='1' ");
                           $error = '';
                           while($f = mysqli_fetch_array($result4)){
                               $cod = $f['codigo_pro'];
                               $ubi = $f['ubicacion'];
                               $can = $f['cantidad_mov'];
                               $bod = $f['bodega'];
                               $col = $f['color_du'];
                               $med = $f['medida_du'];
                               $saldo = $f['saldo_ubicacion'];
                               $query = mysqli_query($con, "select count(codigo_pro) from relacion_ubicaciones where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                               $c = mysqli_fetch_array($query);

                               $calculo = mysqli_query($con, "select sum(cantidad*valor_unidad) as vt,sum(cantidad) as ct from mov_detalle where pro_codigo='$cod' and estado_mov='1' ");
                               $cc = mysqli_fetch_array($calculo);
                               $precio_total = $cc[0];
                               $cantidad_total = $cc[1];
                               $precio_promedio = $precio_total / $cantidad_total;
                               if($c[0]==0){
                                   mysqli_query($con,"insert into relacion_ubicaciones (codigo_pro,ubicacion,stock_ubi,fecha_ult_ent,ultimo_usuario,bod_codigo,cod_empresa,costo_ultimo, color_ubi,medida)"
                                           . " values ('$cod','$ubi','$can','".date("Y-m-d")."','".$usuario."','$bod','$empresa','$precio_promedio','$col','$med')");

                                   $error = $error.$c[0].'-insert';
                               }else{
                                   if($tipo=='ENTRADA'){
                                        mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi+'$can',costo_ultimo='$precio_promedio' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                                   }else{
                                        mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$can' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");

                                        $falla = mysqli_error($con);
                                   }
                                   $error = $error.$can.'-'.$tipo.'-'.$falla;
                               }

                           }
                           //fin  de stck general
                
            }
            //FIN DE SALIDA
            
            //ENTRADA DE INVENTARIO
            $result5 = mysqli_query($con, "select COUNT(*) from capturas_items where id_captura='$idc' and diferencia>0 ");
            $sE = mysqli_fetch_array($result5);
            if($sE[0]>0){
            
                $doc='2012';
                $cc='';
                $obs='AJUSTE DE INVENTARIO';
                $compra='0';
                $factura=0;
                $almori=$_GET['almori'];
                $totalx=0;
                $est=1;
                $ter='800112904-6';
                $diferencia=0;
                $sede=$_GET['sede'];
                $descarga='ENTRADA';
                $ver=mysqli_query($con,"insert into mov_inventario (`sede`,`codigo_tm`,`cen_codigo`,`obs`,`id_orden`,`num_documento`,`bod_codigo`,`total`,`save_mov`,`codigo_ter`,`diferencia`,`usuario`,`tipo_movimiento`,`cod_empresa`)"
                        . " values ('$sede','$doc','$cc','$obs','$compra','$factura','$almori','$totalx','$est','$ter','$diferencia','$usuario','$descarga','$empresa')");
                $ultimo = mysqli_insert_id($con);
                $max = $max.' '.$ultimo.' ';
                $result2 = mysqli_query($con, "select * from capturas_items a, productos_var b where a.pro_codigo=b.codigo and a.id_captura='$idc' and a.diferencia>0 ");

                $tt = 0;
                while($rw = mysqli_fetch_array($result2)){
                     $rad=$ultimo;
                     $des=$rw['descripcion'];
                     $col=$rw['capcolor'];
                     $med=$rw['capmedida'];
                     
                     $can=abs($rw['diferencia']);
                     $pre=$rw['costo_promedio'];
                     $cod=$rw['codigo'];
                     $almori=$almori;
                     //para sumar el total del documento
                      $dif =  abs($rw['diferencia']);
                      $costot = $pre * $dif;
                       $tt += $costot;
                      //fin del calculo
                    
                     //se agrega el items en la tabla de mov_detalle
                     $result3 = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$almori' and color_ubi='$col' and medida='$med'");
                     $r = mysqli_fetch_row($result3);
                     $saldo = $r[0];

                     mysqli_query($con,"insert into mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                                ."values ('$rad','$des','$col','$med','$saldo','$can','$pre','$cod','$almori','1')");
                         $idmd = mysqli_insert_id($con);
                         //fin de proceso mov_detalle
                         
                         //se agrega a la ubicacion
                           $loc = $almori;
                           $cant = abs($rw['diferencia']);
                           $ubi = $rw['ubicacion'];
                           $cost = $rw['costo_promedio'];
                           $idmd = $idmd;
                           $st = $_GET['st'];
                           //esta parte se actualiza al momento de guardar.
                           $result4 = mysqli_query($con,"select count(codigo_pro), cantidad_mov from mov_detalle_ubi where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' ");
                           $rr = mysqli_fetch_row($result4);
                           $saldo = $rr[1];
                           if($rr[0]==0){
                               $resultu = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$loc' and ubicacion='$ubi' and color_ubi='$col' and medida='$med' ");
                               $ru = mysqli_fetch_row($resultu);
                               $saldo = $ru[0];

                                mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`saldo_ubicacion`,`estado_mu`,`id_mov`,`id_ref_mov`,`bodega`, `codigo_pro`, `ubicacion`, `cantidad_mov`,  `fecha_ult_com`, `user_ult_com`, `costo_ult_com`, `color_du`, `medida_du`) "
                                   . "VALUES ('".$saldo."','1', '".$rad."','".$idmd."','".$loc."','".$cod."','".$ubi."','".$cant."','".date("Y-m-d")."','".$_SESSION['k_username']."', '".$cost."','$col','$med')");

                           }else{
                               mysqli_query($con,"update mov_detalle_ubi set saldo_ubicacion='$saldo',cantidad_mov='$cant',  fecha_ult_com='".date("Y-m-d")."',user_ult_com='".$_SESSION['k_username']."',costo_ult_com='$cost' where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' ");
                           }
                         //fin de ubicacion 

                      }
                      //se actualiza el valor total del documento
                      mysqli_query($con, "update mov_inventario set save_mov='1',total='$tt' where id_mov='$ultimo'  ");
                      //se actualiza el stock general
                           $tipo = $descarga;
                           $result4 = mysqli_query($con,"select * from mov_detalle_ubi where id_mov='$rad' and estado_mu='1' ");
                           $error = '';
                           while($f = mysqli_fetch_array($result4)){
                               $cod = $f['codigo_pro'];
                               $ubi = $f['ubicacion'];
                               $can = $f['cantidad_mov'];
                               $bod = $f['bodega'];
                               $saldo = $f['saldo_ubicacion'];
                               $col = $f['color_du'];
                               $med = $f['medida_du'];
                               $query = mysqli_query($con, "select count(codigo_pro) from relacion_ubicaciones where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                               $c = mysqli_fetch_array($query);

                               $calculo = mysqli_query($con, "select sum(cantidad*valor_unidad) as vt,sum(cantidad) as ct from mov_detalle where pro_codigo='$cod' and estado_mov='1' ");
                               $cc = mysqli_fetch_array($calculo);
                               $precio_total = $cc[0];
                               $cantidad_total = $cc[1];
                               $precio_promedio = $precio_total / $cantidad_total;
                               if($c[0]==0){
                                   mysqli_query($con,"insert into relacion_ubicaciones (codigo_pro,ubicacion,stock_ubi,fecha_ult_ent,ultimo_usuario,bod_codigo,cod_empresa,costo_ultimo,color_ubi,medida)"
                                           . " values ('$cod','$ubi','$can','".date("Y-m-d")."','".$usuario."','$bod','$empresa','$precio_promedio','$col','$med')");

                                   $error = $error.$c[0].'-insert';
                               }else{
                                   if($tipo=='ENTRADA'){
                                        mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi+'$can',costo_ultimo='$precio_promedio' where codigo_pro='$cod' and ubicacion='$ubi' and color_ubi='$col' and medida='$med' and bod_codigo='$bod' ");
                                   }else{
                                        mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$can' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");

                                        $falla = mysqli_error($con);
                                   }
                                   $error = $error.$can.'-'.$tipo.'-'.$falla;
                               }

                           }
                           //fin  de stck general
                
            }
            //FIN DE INVENATRIO
             mysqli_query($con, "update capturas_items set fecha_ajuste='".date("Y-m-d")."' where id_captura='$idc'  ");
             echo $max;
            break;
        case 12:
            echo $_GET['idc'];
            break;
         case 13:
            $id = $_GET['cod'];
            $col = $_GET['col'];
            mysqli_query($con, "update capturas_items set capcolor='".$col."' where id_ci='$id'  ");
            
            
            break;
        
       
}