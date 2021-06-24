<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        
            case 1:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM relacion_ubicaciones where id_ru='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['codigo_pro']; 
                 $p[1]=$fila['ubicacion'];
                 $p[2]=$fila['stock_ubi'];
                 $p[3]=$fila['bod_codigo'];
                 $p[4]=$fila['color_ubi'];
                 $p[5]=$fila['medida'];
        
            echo json_encode($p); 
            exit();
            break;
            case 2:
               $id=$_GET['id'];
               $ubi=$_GET['oubi'];
               $bod=$_GET['bod'];
               $med=$_GET['med'];
               $col=$_GET['col'];
               $cod=$_GET['cod'];
               $can=$_GET['ocan'];
               $dcan=$_GET['dcan'];
               $tipo=$_GET['tipo'];
               $ub=$_GET['dubi'];
               
               
               
               $query = mysqli_query($con, "select count(codigo_pro) from relacion_ubicaciones where codigo_pro='$cod' and ubicacion='$ub' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                   $c = mysqli_fetch_array($query);

                   if($c[0]==0){
                       mysqli_query($con,"insert into relacion_ubicaciones (codigo_pro,ubicacion,stock_ubi,fecha_ult_ent,ultimo_usuario,bod_codigo,cod_empresa,costo_ultimo, color_ubi,medida)"
                               . " values ('$cod','$ub','$dcan','".date("Y-m-d")."','".$usuario."','$bod','$empresa','0','$col','$med')");
                   mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$dcan' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                       $error = 'Se agrego el  codigo a una nueva ubicacion';
                   }else{
                       
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi+'$dcan' where codigo_pro='$cod' and ubicacion='$ub' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                       
                            mysqli_query($con, "update relacion_ubicaciones set stock_ubi=stock_ubi-'$dcan' where codigo_pro='$cod' and ubicacion='$ubi' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' ");
                       
                       $error = 'Se actualizo la ubicacion a otra';
                   }
                   echo $error;
               break;
        case 3:
            $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM relacion_ubicaciones where id_ru='$id' ");
                 $fila = mysqli_fetch_array($query);

                 $cod=$fila['codigo_pro']; 
                 $ubi=$fila['ubicacion'];
   
                 $bod=$fila['bod_codigo'];
                 $col=$fila['color_ubi'];
                 $med=$fila['medida'];
                 $ucod = "'".$cod."'";
                 $uubi = "'".$ubi."'";
                 $ubod = "'".$bod."'";
                 $ucol = "'".$col."'";
                 $umed = "'".$med."'";
              
                 $query2 = mysqli_query($con,"SELECT * FROM mov_detalle_ubi a, mov_inventario b where a.id_mov=b.id_mov and ubicacion='$ubi' and  bodega ='$bod' and codigo_pro='$cod' and color_du='$col'  "); // and medida_du='$med' and color_du='$col' consultA modificada por navabla
                 $in = 0;$out=0;
                 while($row = mysqli_fetch_array($query2)){
                     if($row['tipo_movimiento']=='ENTRADA'){
                         $in += $row['cantidad_mov'];
                     }else{
                         $out +=$row['cantidad_mov'];
                     }
                     echo '<tr>'
                     . '<td>'.$row['rad_fom'].'</td>'
                             . '<td>'.$row['fecha_ult_com'].'</td>'
                             . '<td>'.$row['ubicacion'].'</td>'
                             . '<td>'.$row['cantidad_mov'].'</td>'
                             . '<td>'.$row['tipo_movimiento'].'</td><td>'.$row['user_ult_com'].'</td>';
                 }
                 $saldo = $in - $out;
                 //if($_SESSION['k_username']=='admin'){
                     $btn = '<button onclick="editaru('.$ubod.','.$ucod.','.$ucol.','.$umed.','.$uubi.','.$saldo.')">Editar</button>';
//                 }else{
//                     $btn = '';
//                 }
                 echo '<tr><td colspan="3">Cantidad Total:</td><td>'.$saldo.'</td><td>'.$btn.'</td></tr>';
                 

            break;
            case 4:
                 $bod=$_GET['bod'];
                 $cod=$_GET['cod'];
                  $col=$_GET['col'];
                   $med=$_GET['med'];
                    $ubi=$_GET['ubi'];
                     $can=$_GET['can']; 
                     mysqli_query($con,"update relacion_ubicaciones set stock_ubi='$can' where codigo_pro='$cod' and bod_codigo='$bod' and color_ubi='$col' and medida='$med' and ubicacion='$ubi'  ");
                     echo 'Se edito con exito .'.  mysqli_error($con). ' ='.$can; 
                break;
            
            case 5:
                    $idu =$_GET['idu']; 
                    $bod=$_GET['bod'];
                    $cod=$_GET['cod'];
                    $col=$_GET['col'];
                    $med=$_GET['med'];
                    $ubi=$_GET['ubi'];
                    $sto=$_GET['sto'];
                    $can=$_GET['can']; 
                     if($_GET['tipo']=='ENTRADA'){
                         $doc='04';    
                     }else{
                         $doc='64';                
                     }
                    $cc='00030001';
                   $obs='ACTUALIZAION DE CANTIDADES POR UBICACION INDIVIDUAL ';
                   $compra='0';
                   $factura='0';
                   $almori=$_GET['bod'];
                   $totalx=0;
                   $est= 1 ;
                   $ter=$_GET['ter'];
                   $diferencia='';
                   $sede='GALAPA';
                   $descarga=$_GET['tipo'];
                   $docfom='000000000';
                   $ced= '800112904-6';
                   $tipo='6';
                   $puesto='0';
           
            //se inserta el encabezado
                $ver=mysqli_query($con,"insert into mov_inventario (`rad_fom`,`sede`,`codigo_tm`,`cen_codigo`,`obs`,`id_orden`,`num_documento`,`bod_codigo`,`total`,`save_mov`,`codigo_ter`,`diferencia`,`usuario`,`tipo_movimiento`,`cod_empresa`,`tipo_orden`,`tercerofom`,`id_puesto`)"
                        . " values ('$docfom', '$sede','$doc','$cc','$obs','$compra','$factura','$almori','$totalx','$est','$ter','$diferencia','$usuario','$descarga','$empresa','$tipo','$ced','$puesto')");
        
                 $rad = mysqli_insert_id($con);
                 $query = mysqli_query($con,"select desc_prod,valor_unidad from mov_detalle where id_ref_mov='$idu' ");
                 $d = mysqli_fetch_array($query);
                 $des = $d[0];
                 $pre = $d[1]; 
                 // se inserta en la tabla antes de dar ubicacion
                 $ver=mysqli_query($con_duos,"insert into mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                               ."values ('$rad','$des','$col','$med','$sto','$can','$pre','$cod','$almori','1')");
                 $idi =  mysqli_insert_id($con_duos);
                 
                 // se inserta en la ubicaacion
               
                break;
            }

