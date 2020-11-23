<?php
include '../../../modelo/conexioni.php';
//include '../../../modelo/conexion.php';
session_start();
date_default_timezone_set("America/Bogota" ) ; 
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
// JPARDOQ  27961
//       //Cannot add or update a child row: a foreign key constraint fails (`aluvmix`.`mov_inventario`, CONSTRAINT `mov_inventario_ibfk_2` FOREIGN KEY (`cod_empresa`) REFERENCES `inf_empresa` (`cod_empresa`))0
           case 1:
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
           
            if($id==''){
                $ver=mysqli_query($con,"insert into mov_inventario (`rad_fom`,`sede`,`codigo_tm`,`cen_codigo`,`obs`,`id_orden`,`num_documento`,`bod_codigo`,`total`,`save_mov`,`codigo_ter`,`diferencia`,`usuario`,`tipo_movimiento`,`cod_empresa`,`tipo_orden`,`tercerofom`)"
                        . " values ('$docfom', '$sede','$doc','$cc','$obs','$compra','$factura','$almori','$totalx','$est','$ter','$diferencia','$usuario','$descarga','$empresa','$tipo','$ced')");
        
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
          
        case 2:
                 $rad=$_GET['rad'];
                 $des=$_GET['des'];
                 $col=$_GET['col'];
                 $med=$_GET['med'];
                 $stc=$_GET['stc'];
                 $can=$_GET['can'];
                 $pre=$_GET['pre'];
                 $cod=$_GET['cod'];
                 $almori=$_GET['almori'];
                 $id=$_GET['id_proadd'];
               
            if($id==''){
                $result = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$almori'");
                $r = mysqli_fetch_row($result);
                $saldo = $r[0];
           
                  $ver=mysqli_query($con,"insert into mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                               ."values ('$rad','$des','$col','$med','$saldo','$can','$pre','$cod','$almori','0')");
                echo mysqli_error($con);
                
            }else{
                mysqli_query($con,"update mov_detalle set  id_mov='$rad', desc_prod='$des', color='$col', medida='$med', saldo_inicial='$stc', cantidad='$can', valor_unidad='$pre', pro_codigo='$cod', bod_codigo='$almori' where id_ref_mov='$id'");
                echo $id;
            }
          
        
            break;
           case 3:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM  mov_detalle where id_ref_mov='$id' "); 
                 $fila = mysqli_fetch_array($query);
                     $p = array(); 
                     $p[0]=$fila['id_mov'];
                     $p[1]=$fila['desc_prod'];
                     $p[2]=$fila['color']; 
                     $p[3]=$fila['medida'];
                     $p[4]=$fila['saldo_inicial'];
                     $p[5]=$fila['cantidad'];
                     $p[6]=$fila['valor_unidad'];
                     $p[7]=$fila['pro_codigo'];
                     $p[8]=$fila['bod_codigo'];
                
            echo json_encode($p); 
            exit();
            break;
        
             case 4:
                 $c = 0;$t = 0;$tr=0;
            $sql=mysqli_query($con,"SELECT * FROM mov_detalle WHERE id_mov='".$_GET['ord']."'");
		   while($row=mysqli_fetch_array($sql)){
		   	$sqlx=mysqli_query($con, "SELECT descripcion,  costo_promedio FROM productos_var WHERE codigo='".$row['pro_codigo']."'");
		   	$res=mysqli_fetch_assoc($sqlx);
		   	$lis=mysqli_query($con, "SELECT SUM(cantidad_mov) FROM mov_detalle_ubi WHERE id_ref_mov='".$row['id_ref_mov']."' and codigo_pro='".$row['pro_codigo']."'");
		   	$ress=mysqli_fetch_assoc($lis);
		   	$resta=intval($row['cantidad']-$ress['SUM(cantidad_mov)']);
		   	$send= "'".$row['pro_codigo']."','".str_replace('"','',$row['desc_prod'])."',".$resta.','.$row['id_ref_mov'].','.$row['id_mov'].','.$row['valor_unidad'].','."'".trim($row['color'])."'".','."'".trim($row['medida'])."'";
                        $c +=$row['cantidad'];
                        $t +=$row['valor_unidad']*$row['cantidad'];
                        $tr +=$resta;
                        echo '<tr>'.
					 '<td><center><b>'.$row['pro_codigo'].'</center></td>'.
					 '<td><b>'.str_replace('"','',$row['desc_prod']).'</td>'.
					 '<td><center><b>'.$row['color'].'</center></td>'.
					 '<td><center>'.$row['medida'].'</center></td>'.
					 '<td><center><b>'.$row['cantidad'].'</center></td><td>-</td>'.
					 '<td><center><b>'.$resta.'</center></td>'
                                       . '<td style="text-align:right">'.($row['valor_unidad']).'</td>'
                            . '         <td style="text-align:right">'.number_format($row['valor_unidad']*$row['cantidad'],2).'</td>'.
					   '<td><button onclick="dar_acesso('.$send.');">U</button>'
                                . '<button onclick="del_ite('.$row['id_ref_mov'].');" id="borrar">-</button></td>'.
					   
				 '</tr>';
		   }
                   echo '<tr><td colspan="4">Totales</td>'
                   . '<td><center>'.$c.'</center></td><td>-</td><td><input type="text" disabled id="totalp" value="'.$tr.'" style="text-align:right;width:100%"></td>'
                   . '<td>-</td>'
                   . '<td style="text-align:right"><input type="text" disabled id="totald" value="'.number_format($t, 2, '.', '').'" style="text-align:right;width:100%"></td>';
            break;
           case 5:
               $rad = $_GET['rad'];
               $cod = $_GET['cod'];
               $query = mysqli_query($con,"select * from mov_detalle_ubi where id_ref_mov='$rad' ");
               $i = 0;
               while($r = mysqli_fetch_array($query)){
                   $i++;
                   echo '<tr><td>'.$r['codigo_pro'].'</td>'
                           . '<td id="colu'.$r['id_mdu'].'" >'
                           . '<input type="hidden" id="upubi'.$r['id_mdu'].'" value="'.$r['ubicacion'].'" style="width:50px">'
                           . '<input type="hidden" id="upbod'.$r['id_mdu'].'" value="'.$r['bodega'].'" style="width:50px">'
                           . '<input type="hidden" id="upmed'.$r['id_mdu'].'" value="'.$r['medida_du'].'" style="width:50px">'
                           . '<input type="hidden" id="upcol'.$r['id_mdu'].'" value="'.$r['color_du'].'" style="width:50px">'
                           . '<input type="hidden" id="upcod'.$r['id_mdu'].'" value="'.$r['codigo_pro'].'" style="width:50px">'
                           . '<input type="text" id="ub'.$r['id_mdu'].'" onclick="buscarb2('.$r['id_mdu'].')" value="'.$r['ubicacion'].'" style="width:50px"></td>'
                           . '<td><input type="text" id="upcan'.$r['id_mdu'].'" value="'.$r['cantidad_mov'].'" style="width:50px" disabled></td>';
               }
               
               break;
           case 6:
               
               $rad = $_GET['rad'];
               $cod = $_GET['cod'];
               $loc = $_GET['loc'];
               $cant = $_GET['cant'];
               $ubi = $_GET['ubi'];
               $cost = $_GET['cost'];
               $idmd = $_GET['idmd'];
               $st = $_GET['st'];
               $color = $_GET['color'];
               $med = $_GET['med'];
               //esta parte se actualiza al momento de guardar. 321532033 
               $result = mysqli_query($con,"select count(codigo_pro), cantidad_mov from mov_detalle_ubi where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' and color_du='$color' and medida_du='$med' ");
               $r = mysqli_fetch_row($result);
               $saldo = $r[1];
               if($r[0]==0){
                   $resultu = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$loc' and ubicacion='$ubi' and color_ubi='$color' and medida='$med' ");
                   $ru = mysqli_fetch_row($resultu);
                   $saldo = $ru[0];
                
                    mysqli_query($con, "INSERT INTO `mov_detalle_ubi`(`saldo_ubicacion`,`estado_mu`,`id_mov`,`id_ref_mov`,`bodega`, `codigo_pro`, `ubicacion`, `cantidad_mov`,  `fecha_ult_com`, `user_ult_com`, `costo_ult_com`, `color_du`, `medida_du`) "
                       . "VALUES ('".$saldo."','0', '".$rad."','".$idmd."','".$loc."','".$cod."','".$ubi."','".$cant."','".date("Y-m-d")."','".$_SESSION['k_username']."', '".$cost."', '".$color."', '".$med."')");
              
               }else{
                   mysqli_query($con,"update mov_detalle_ubi set saldo_ubicacion='$st',cantidad_mov='$cant',  fecha_ult_com='".date("Y-m-d")."',user_ult_com='".$_SESSION['k_username']."',costo_ult_com='$cost' where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$loc' and id_mov='$rad' and color_du='$color' and medida_du='$med'  ");
               }
                      
//996070389 corrient               mysqli_query($con, "insert into mov_productos (id_mov,id_md,codigo_pro,ubicacion,cantidad,bodega)"
//  493042162                              . " values('".$rad."','".$idmd."','".$cod."','".$ubi."','".$cant."','".$loc."')");
               
               break;
           case 7:
                $id = $_GET['id'];
                mysqli_query($con,"delete from mov_detalle where id_ref_mov='$id' ");
                mysqli_query($con,"delete from mov_detalle_ubi where id_ref_mov='$id' ");
                
                
               break;
           case 8:
               $rad = $_GET['rad'];
               $dif = $_GET['dif'];
               $tipo = $_GET['tipo'];
               $ord = $_GET['ord'];
               $fom = $_GET['fom'];
               //cambio de estado a 1
               mysqli_query($con, "update mov_inventario set rad_fom='$fom', save_mov='1',diferencia='$dif',pendiente='0',usuario='$usuario' where id_mov='$rad'  ");
               mysqli_query($con, "update mov_detalle_ubi set estado_mu='1' where id_mov='$rad' ");
               mysqli_query($con, "update mov_detalle set estado_mov='1' where id_mov='$rad'  ");
               
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
                   $med = $f['medida_du'];
                   $query = mysqli_query($con, "select count(codigo_pro) from relacion_ubicaciones where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$color' and medida='$med' ");
                   $c = mysqli_fetch_array($query);
                   
                   $calculo = mysqli_query($con, "select sum(cantidad*valor_unidad) as vt,sum(cantidad) as ct from mov_detalle where pro_codigo='$cod' and estado_mov='1' ");
                   $cc = mysqli_fetch_array($calculo);
                   $precio_total = $cc[0];
                   $cantidad_total = $cc[1];
                   $precio_promedio = $precio_total / $cantidad_total;
                   if($c[0]==0){
                       mysqli_query($con,"insert into relacion_ubicaciones (codigo_pro,ubicacion,stock_ubi,fecha_ult_ent,ultimo_usuario,bod_codigo,cod_empresa,costo_ultimo, color_ubi,medida)"
                               . " values ('$cod','$ubi','$can','".date("Y-m-d")."','".$usuario."','$bod','$empresa','$precio_promedio','$color','$med')");
                   
                       $error = $error.$c[0].'-insert';
                   }else{
                       if($tipo=='ENTRADA'){
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi+'$can',costo_ultimo='$precio_promedio' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$color' and medida='$med' ");
                       }else{
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$can' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$color' and medida='$med' ");
                       
                            $falla = mysqli_error($con);
                       }
                       $error = $error.$can.'-'.$tipo.'-'.$falla;
                   }
                   
               }
               echo $error;
               
               break;
               case 9:
               $rad = $_GET['rad'];
               $dif = $_GET['dif'];
               $tipo = $_GET['tipo'];
               //cambio de estado a 1
               mysqli_query($con, "update mov_inventario set save_mov='0',diferencia='$dif' where id_mov='$rad'  ");
               mysqli_query($con, "update mov_detalle_ubi set estado_mu='0' where id_mov='$rad' ");
               mysqli_query($con, "update mov_detalle set estado_mov='0' where id_mov='$rad'  ");
               break;
           case 10:
               $cod = $_GET['cod'];
               $loc = $_GET['loc'];
               $color = $_GET['color'];
               $sql = mysqli_query($con,"SELECT a.codigo_pro,b.descripcion,a.color_ubi,a.ubicacion,b.alto,a.costo_ultimo,stock_ubi,a.id_ru FROM relacion_ubicaciones a, productos_var b where a.codigo_pro=b.codigo and a.stock_ubi!=0 and b.codigo= '".$cod."' and a.bod_codigo='$loc' and a.color_ubi='$color'  ".$limit);
		$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
                                        $stc=0;
					$item = $item+1;
                                       echo '<tr>
                                                <td><input type="text" id="co'.$mostrar['id_ru'].'" value="'.$mostrar['codigo_pro'].'" style="width:50px" disabled></td>
                                                <td>'.$mostrar['descripcion'].'</td>'
                                                . '<td><input type="text" id="ub'.$mostrar['id_ru'].'" value="'.$mostrar['ubicacion'].'" style="width:50px" disabled></td>'
                                                . '<td><input type="text" id="st'.$mostrar['id_ru'].'" value="'.$mostrar['stock_ubi'].'" style="width:50px" disabled></td>'
                                               . '<td><input type="text" id="ca'.$mostrar['id_ru'].'" value="'.$_GET['can'].'" style="width:50px">'
                                               . '<input type="hidden" id="color'.$mostrar['id_ru'].'" value="'.$mostrar['color_ubi'].'" style="width:50px">'
                                               . '<input type="hidden" id="cas'.$mostrar['id_ru'].'" value="'.$_GET['can'].'" style="width:50px"></td>'
                                               . '<td> <button class="btn btn-success" onclick="save_mod_ubi_sal('.$mostrar['id_ru'].')">+</button> </td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
               
               break;
                case 11:
               
                    $tipo=$_GET['tipo'];
                    $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM tipos_movimientos where observacion='$tipo' and codigo_tm='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
       
                 $p[0]=''; 
                 $p[1]=$fila['codigo_tm'];
                 $p[2]=$fila['movimiento'];  
                 $p[3]=$fila['cent_cos'];
        
            echo json_encode($p); 
            exit();
            break;
             case 12:
               $idc=$_GET['codcc'];
                 $query = mysqli_query($con,"SELECT * FROM centrocostos where cen_codigo like '%".$idc."' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
             
                 $p[0]=''; 
                 $p[1]=$fila['cen_codigo'];
                 $p[2]=$fila['cen_nombre'];
        
            echo json_encode($p); 
            exit();
            break;
         case 13:
               $idb=$_GET['codb'];
                 $query = mysqli_query($con,"SELECT * FROM bodegas where bod_codigo LIKE '%".$idb."' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
    
                 $p[0]=''; 
                 $p[1]=$fila['bod_codigo'];
                 $p[2]=$fila['bod_nombre'];
                 $p[3]=$fila['sede'];
        
            echo json_encode($p); 
            exit();
            break;
    case 14:
               $idt=$_GET['codt'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where cod_ter = '$idt' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
          
                  $p = array();
                 $p[0]=''; 
                 $p[1]=$fila['cod_ter'];
                 $p[2]=$fila['nom_ter'];
        
            echo json_encode($p); 
            exit();
            break;
           case 15:
               $orden=$_GET['orden'];
               $orden = str_pad($orden, 9, "0", STR_PAD_LEFT);
               $descarga=$_GET['descarga'];
               
               if($descarga=='ENTRADA'){
                $result = mysqli_query($con,"SELECT * FROM orden_compra where ordenfom ='".$orden."' ");
                $r = mysqli_fetch_array($result);
                
                    $p = array();
                    $p[0] = $r['bod_codigo'];
                    $p[1] = $r['cod_ter'];
                    $p[2] = $r['total'];
                    $query = mysqli_query($con, "select sum(cantidad_pend) from orden_compra_detalle where codigo_orden='$orden' ");
                    $c = mysqli_fetch_array($query);
                    $p[3] = $c[0];
                    echo json_encode($p);
               }ELSE{
                   //JALA ORDEN DE PRODUCCION
                   $result = mysql_query("SELECT cod_ter,nom_ter FROM orden_produccion a, cont_terceros b where a.id_cliente=b.id_ter and a.opf ='".$orden."' ");
                   $r = mysql_fetch_array($result);
                    $p = array();
                    $p[0] = '';
                    $p[1] = $r['cod_ter'];
                    $p[2] = '';
                    $p[3] = 1;
                    echo json_encode($p);
               }
                

               
               break;
           case 16:
                $id=$_GET['ord'];
            $result = mysqli_query($con,"select * from mov_inventario where id_mov='$id' ");
            $e = mysqli_fetch_array($result);
            
            $result4 = mysqli_query($con,"select pre_codigo from prefijosinv where pre_tipmov='".$e['codigo_tm']."'  ");
            $pr = mysqli_fetch_array($result4);
            
            if($pr!=''){
                $prefijo = $pr[0];
            }else{
                $prefijo = '';//
            }
            if($e['tipo_orden']=='01'){
                $afecta = '1';
            }else{
                $afecta = '0';
            }
            if($e['tercerofom']==''){
                $tercero = $e['codigo_ter'];
            }else{
                $tercero = $e['tercerofom'];
            }
             $orden = str_pad($e['id_orden'], 9, "0", STR_PAD_LEFT);
            $p = array();
            $p['Empresa'] = $e['cod_empresa'];
            $p['TipoMovimiento'] = $e['codigo_tm'];
            $p['Prefijo'] = '';
            $p['NumeroDocumento'] = $e['id_mov'];
            $p['FechaDocumento'] = date("Y-m-d").'T00:00:00.000Z';
            $p['Bodega'] = $e['bod_codigo'];
            $p['Observaciones'] = $e['obs'];
            $p['AfectaO'] = $e['tipo_orden'];
            $p['AfectaOrden'] = $orden;
            $p['Tercero'] = $tercero;
            $p['CentroCosto'] = $e['cen_codigo'];
            $p['Usuario'] = $e['usuario'];
            $p['Programa'] = 'frmPRO202';
            $p['DocumentoFomplus'] = $e['sede_dir'];
            $p['Contabilizado'] = true;
       
            $detalles = mysqli_query($con,"select * from mov_detalle where id_mov='$id' "); 
            $t = array();
            while($f = mysqli_fetch_array($detalles)){
                
                $d = array();
                $c++;
                $d['BodegaDestino'] = $e['bod_codigo'];
                $d['Articulo'] = $f['pro_codigo'];         
                $d['UnidadMedida'] = "Und";
                $d['Cantidad'] = $f['cantidad'];
                $d['CostoUnitario'] = $f['valor_unidad'];
                $d['ValorVenta'] =  $f['valor_unidad'];
                $d['Medida'] =  $f['medida'];
                $d['Color'] =  $f['color'];
                $t[] = $d;
            }
            
            $p["Detalle"] = $t;
            echo json_encode($p);
           
               
               
               break;
                case 16.1:
                    //procedimiento para ser contabilizado
                $id=$_GET['ord'];
            $result = mysqli_query($con,"select * from mov_inventario where id_mov='$id' ");
            $e = mysqli_fetch_array($result);
            
            $result4 = mysqli_query($con,"select pre_codigo from prefijosinv where pre_tipmov='".$e['codigo_tm']."'  ");
            $pr = mysqli_fetch_array($result4);
            
            if($pr!=''){
                $prefijo = $pr[0];
            }else{
                $prefijo = '';//
            }
            if($e['codigo_tm']=='01'){
                $afecta = '1';
            }else{
                $afecta = '0';
            }
            if($e['tercerofom']==''){
                $tercero = $e['codigo_ter'];
            }else{
                $tercero = $e['tercerofom'];
            }
            $orden = str_pad($e['id_orden'], 9, "0", STR_PAD_LEFT);
            $opf = str_pad($e['rad_fom'], 9, "0", STR_PAD_LEFT);
            $p = array();
            $p['Empresa'] = $e['cod_empresa'];
            $p['TipoMovimiento'] = $e['codigo_tm'];
            $p['Prefijo'] = '';
            $p['NumeroDocumento'] = $e['id_mov'];
            $p['FechaDocumento'] = date("Y-m-d").'T00:00:00.000Z';
            $p['Bodega'] = $e['bod_codigo'];
            $p['Observaciones'] = $e['obs'];
            $p['AfectaO'] = $e['tipo_orden'];
            $p['AfectaOrden'] = $orden;
            $p['Tercero'] = $tercero;
            $p['CentroCosto'] = $e['cen_codigo'];
            $p['Usuario'] = $e['usuario'];
            $p['Programa'] = 'frmPRO202';
            $p['DocumentoFomplus'] = $opf;
            $p['Contabilizado'] = false;
       
            $detalles = mysqli_query($con,"select * from mov_detalle where id_mov='$id' "); 
            $t = array();
            while($f = mysqli_fetch_array($detalles)){
                
                $d = array();
                $c++;
                $d['BodegaDestino'] = $e['bod_codigo'];
                $d['Articulo'] = $f['pro_codigo'];         
                $d['UnidadMedida'] = "Und";
                $d['Cantidad'] = $f['cantidad'];
                $d['CostoUnitario'] = $f['valor_unidad'];
                $d['ValorVenta'] =  $f['valor_unidad'];
                $d['Medida'] =  $f['medida'];
                $d['Color'] =  $f['color'];
                $t[] = $d;
            }
            
            $p["Detalle"] = $t;
            echo json_encode($p);
           
               
               
               break;
           case 17:
               $id=$_GET['ord'];
               $fom=$_GET['fom'];
            $result = mysqli_query($con,"update mov_inventario set rad_fom='$fom'  where id_mov='$id' ");
              if($result){
                  echo 'Se guardo con exito en fomplus';
              }else{
                  echo 'Hubo un error durante el proceso'.mysqli_error($con);
              }
               break;
               case 18:
               $id=$_GET['id'];
               $ubi=$_GET['ubi'];
               $bod=$_GET['bod'];
               $med=$_GET['med'];
               $col=$_GET['col'];
               $cod=$_GET['cod'];
               $can=$_GET['can'];
               $tipo=$_GET['tipo'];
               $ub=$_GET['ub'];
               $result = mysqli_query($con,"update mov_detalle_ubi set ubicacion='$ub' where id_mdu='$id' ");
               
               $query = mysqli_query($con, "select count(codigo_pro) from relacion_ubicaciones where codigo_pro='$cod' and ubicacion='$ub' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                   $c = mysqli_fetch_array($query);

                   if($c[0]==0){
                       mysqli_query($con,"insert into relacion_ubicaciones (codigo_pro,ubicacion,stock_ubi,fecha_ult_ent,ultimo_usuario,bod_codigo,cod_empresa,costo_ultimo, color_ubi,medida)"
                               . " values ('$cod','$ub','$can','".date("Y-m-d")."','".$usuario."','$bod','$empresa','0','$col','$med')");
                   mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$can' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                       $error = 'Se agrego el  codigo a una nueva ubicacion';
                   }else{
                       
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi+'$can' where codigo_pro='$cod' and ubicacion='$ub' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                       
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$can' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                       
                       $error = 'Se actualizo la ubicacion a otra';
                   }
                   echo $error;
               break;
    
    
}

