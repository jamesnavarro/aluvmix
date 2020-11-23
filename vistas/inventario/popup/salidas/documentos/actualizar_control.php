<?php
include('../../../../../modelo/conexionv1.php');
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
   
                 
                 
                 
                 $consulta =mysqli_query($con2,"select count(despachado) from control_despacho where id_cot='$idcot' and cod_producto='$id' ");
                    $c = mysqli_fetch_array($consulta);
                    if($c[0]==0){
                        
                       mysqli_query($con2,"insert into control_despacho (id_cot,cod_producto,despachado,linea,ult_despacho,ult_user)"
                               . " values ('$idcot','$id','$can','Vidrios','".date("Y-m-d H:i:s")."','".$_SESSION['k_username']."') ");
                       echo mysqli_error($con2) .' ='.$c[0];
                    }else{
                        mysqli_query($con2,"update control_despacho set despachado=despachado+'$can' where cod_producto='$id' and id_cot='$idcot' ");
                        echo mysqli_error($con2).' ='.$c[0];
                    }
                      
               echo 'paso'.$rad;
