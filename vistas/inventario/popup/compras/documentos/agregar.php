<?php
include('../../../../../modelo/conexioni.php');

            $orden = $_POST['orden'];
            $rad = $_POST['rad'];
            $can = $_POST['can'];
            $id = $_POST['id'];//update orden_compra_detalle

                              
                 $des=$_POST['des'];//?
                 $col=$_POST['col'];//?
                 $med=$_POST['med'];//?

                 $pre=$_POST['pre'];//?
                 $cod=$_POST['cod'];//?
                 $almori=$_POST['bod'];

                $result = mysqli_query($con, "SELECT sum(stock_ubi) FROM `relacion_ubicaciones` where codigo_pro='$cod' and bod_codigo='$almori'");
                $r = mysqli_fetch_row($result);
                $saldo = $r[0];
           
                  $ver=mysqli_query($con,"insert into mov_detalle(`id_mov`,`desc_prod`,`color`,`medida`,`saldo_inicial`,`cantidad`,`valor_unidad`,`pro_codigo`,`bod_codigo`,`estado_mov`)"
                                                               ."values ('$rad','$des','$col','$med','$saldo','$can','$pre','$cod','$almori','0')");
                echo mysqli_error($con);
                
                mysqli_query($con,"update orden_compra_detalle set cantidad_pend=cantidad_pend-'$can', cantidad_rec='$can' where id_oc_de='$id' ");
                 mysqli_query($con,"update orden_compra set estado='Completada' where codigo='$id' ");   
echo 'paso'.$saldo;
