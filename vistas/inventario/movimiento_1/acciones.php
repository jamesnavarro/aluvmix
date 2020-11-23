<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['movcod'];
            $movnom=$_GET['movnomb'];
            $movtip=$_GET['movtipo'];
            $movultconse=$_GET['movultconsec'];
            $movcodcon=$_GET['movcodcontab'];
            $movcodfuent=$_GET['movcodfuente'];
            $movestad=$_GET['estadomov'];
            $movactpro=$_GET['movactprod'];
            $movactucont=$_GET['movactuconta'];
            $movequi=$_GET['movaequiv'];
            $centr_c=$_GET['centro_c'];
           
            $result = mysqli_query($con,"select count(*) from tipos_movimientos where codigo_tm='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into tipos_movimientos (`codigo_tm`,`movimiento`,`observacion`,`ult_cons`,`id_codigo`,`id_fuente`,`estado_mov`,`jala_orden`,`act_cont`,`equivalencia`,`cent_cos`,`cod_empresa`,`usuario`) "
                                            . "values ('$cod','$movnom','$movtip','$movultconse','$movcodcon','$movcodfuent','$movestad','$movactpro','$movactucont','$movequi','$centr_c','$empresa','$usuario')");
            echo mysqli_error($con);
                
            }
            
            else{
                mysqli_query($con,"update tipos_movimientos set movimiento='$movnom', ult_cons='$movtip', id_codigo='$movcodcon', id_fuente='$movcodfuent', estado_mov='$movestad', jala_orden='$movactpro', act_cont='$movactucont',  equivalencia='$movequi',  cent_cos='$centr_c' where codigo_tm='$cod'");
                echo $id;
                 echo mysqli_error($con);
            }
            
            break;
            case 2:
                 $ids=$_GET['id'];
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
            case 3:
               $id=$_GET['id'];
               $query =  ("delete from tipos_movimientos where codigo_tm='$id' ");
            break;
        case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM tipos_movimientos where codigo_tm='$id' "); //consultA modificada por navabla
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
        case 5:
            $id=$_GET['cod'];
            $iva=$_GET['iva'];
            mysqli_query($con,"update tipos_movimientos set poriva='$iva' where codigo_tm='$id' ");
            
            break;
            }

