<?php
include('../../../../../modelo/conexion_multiple.php');
session_start();

            $orden = $_POST['orden'];
            $rad = $_POST['rad'];
            $can = $_POST['can'];
            $pcan = $_POST['pcan'];
             $idcot = $_POST['idcot'];
            $id = $_POST['id'];//update orden_compra_detalle

                              
                 $des=$_POST['des'];//?
                 $col=$_POST['col'];//?
                 $med=$_POST['med'];//?

                 $pre=$_POST['pre'];//?
                 $cod=$_POST['cod'];//?
                 $almori=$_POST['bod'];
                 $line=$_POST['line'];
                 $ubi=$_POST['ubi'];

                $result = mysqli_query($con_duos, "SELECT sum(stock_ubi) FROM aluvmixv2.relacion_ubicaciones where codigo_pro='$cod' and bod_codigo='$almori' and color_ubi='$col' ");
                $r = mysqli_fetch_row($result);
                $saldo = $r[0];
           
                $ver=mysqli_query($con_duos,"insert into aluvmixv2.mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                               ."values ('$rad','$des','$col','$med','$saldo','$can','$pre','$cod','$almori','0')");
               $idmd = mysqli_insert_id($con_duos);
                $result4 = mysqli_query($con_duos,"select count(codigo_pro), cantidad_mov from aluvmixv2.mov_detalle_ubi where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$almori' and id_mov='$rad' and color_du='$col' and medida_du='$med' ");
               $r4 = mysqli_fetch_row($result4);
               $saldo4 = $r4[1];
               if($r4[0]==0){

                    mysqli_query($con_duos, "INSERT INTO aluvmixv2.mov_detalle_ubi(`saldo_ubicacion`,`estado_mu`,`id_mov`,`id_ref_mov`,`bodega`, `codigo_pro`, `ubicacion`, `cantidad_mov`,  `fecha_ult_com`, `user_ult_com`, `costo_ult_com`, `color_du`, `medida_du`) "
                       . "VALUES ('".$saldo."','0', '".$rad."','".$idmd."','".$almori."','".$cod."','".$ubi."','".$can."','".date("Y-m-d")."','".$_SESSION['k_username']."', '".$pre."', '".$col."', '".$med."')");
              
               }else{
                   mysqli_query($con_duos,"update aluvmixv2.mov_detalle_ubi set saldo_ubicacion='$st',cantidad_mov='$can',  fecha_ult_com='".date("Y-m-d")."',user_ult_com='".$_SESSION['k_username']."',costo_ult_com='$pre' where codigo_pro='$cod' and ubicacion='$ubi' and bodega='$almori' and id_mov='$rad' and color_du='$col' and medida_du='$med'  ");
               }
               
                $result25 = mysqli_query($con_duos,"select cantidad from virtuald_templadosa.saldos_ordenes where orden='$orden' and codigo='".$cod."' and posicion='$id' and linea='$line'  ");
                $qc = mysqli_fetch_array($result25);
                if($qc){
                   
                   //UPDATE
                     $ver=mysqli_query($con_duos,"update virtuald_templadosa.saldos_ordenes set cantidad=cantidad+'$can' where orden='$orden' and codigo='".$cod."' and posicion='$id' and linea='$line' )");
                     echo 'Se edito '.mysqli_error($con_duos);
                }else{
                     //INSERT
                   mysqli_query($con_duos,"INSERT INTO virtuald_templadosa.saldos_ordenes (`id_so`, `orden`, `codigo`, `cantidad`, `linea`, `ultima_entrega`, `user`, `posicion`) VALUES (NULL, '$orden', '$cod', '$can', '$line', CURRENT_TIMESTAMP, '".$_SESSION['k_username']."', '$id')");
                   echo "Se guardo  ".mysqli_error($con_duos);
                 }

