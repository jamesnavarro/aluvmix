<?php
include('../../../modelo/conexioni.php');
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

                $query = mysqli_query($con,"SELECT count(*) FROM productos_var where codigo='$cod'");
                 $fila = mysqli_fetch_array($query);
                echo $fila[0];
           
                
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

