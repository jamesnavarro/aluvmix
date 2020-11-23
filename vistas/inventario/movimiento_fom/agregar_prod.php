<?php
include('../../../modelo/conexion_multiple.php');
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

                $result = mysqli_query($con_duos, "SELECT sum(stock_ubi) FROM aluvmixv3.relacion_ubicaciones where codigo_pro='$cod' and bod_codigo='$almori'");
                $r = mysqli_fetch_row($result);
                $saldo = $r[0];
           
                $ver=mysqli_query($con_duos,"insert into aluvmixv3.mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                               ."values ('$rad','$des','$col','$med','$saldo','$can','$pre','$cod','$almori','0')");
                $idi =  mysqli_insert_id($con_duos);
                echo $idi;
//                
//                $result25 = mysqli_query($con_duos,"select cantidad from virtuald_templadosa.saldos_ordenes where orden='$orden' and codigo='".$cod."' and posicion='$id' and linea='$line'  ");
//                $qc = mysqli_fetch_array($result25);
//                if($qc){
//                   
//                   //UPDATE
//                     $ver=mysqli_query($con_duos,"update virtuald_templadosa.saldos_ordenes set cantidad=cantidad+'$can' where orden='$orden' and codigo='".$cod."' and posicion='$id' and linea='$line' )");
//                     echo 'Se edito '.mysqli_error($con_duos);
//                }else{
//                     //INSERT
//                   mysqli_query($con_duos,"INSERT INTO virtuald_templadosa.saldos_ordenes (`id_so`, `orden`, `codigo`, `cantidad`, `linea`, `ultima_entrega`, `user`, `posicion`) VALUES (NULL, '$orden', '$cod', '$can', '$line', CURRENT_TIMESTAMP, '".$_SESSION['k_username']."', '$id')");
//                   echo "Se guardo  ".mysqli_error($con_duos);
//                 }

