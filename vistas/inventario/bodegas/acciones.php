<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['bodcod'];
            $nom=$_GET['bodnomb'];
            $resu=$_GET['bodresum'];
            $bodcta=$_GET['bodta'];
            $api=$_GET['ctaapibod'];
            $est=$_GET['est'];
            $ciu=$_GET['ciudbod'];
            $ica=$_GET['codicabod'];
            $cost=$_GET['costbod'];
            $nit=$_GET['codnibod'];   
            $sed_bod=$_GET['sed_bod'];
            $result = mysqli_query($con,"select count(*) from bodegas where bod_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into bodegas (`bod_codigo`,`bod_nombre`,`nom_resumido`,`bod_cuenta`,`bod_ctaapi`,`bod_estado`,`cod_empresa`,`usuario`,`bod_fechareg`,`bod_ciudad`,`bod_codica`,`bod_costos`,`bod_ctanic`,`sede`) "
                                            . "values ('$cod','$nom','$resu','$bodcta','$api','$est','$empresa','$usuario','".date("Y-m-d H:i:s")."','$ciu','$ica','$cost','$nit','$sed_bod')");
            }
            else{
                mysqli_query($con,"update bodegas set bod_nombre='$nom', nom_resumido='$resu', bod_cuenta='$bodcta', bod_ctaapi='$api', bod_estado='$est', bod_ciudad='$ciu', bod_codica='$ica', bod_costos='$cost', bod_ctanic='$nit', sede='$sed_bod' where bod_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM bodegas where bod_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['bod_codigo']; 
                 $p[1]=$fila['bod_nombre'];
                 $p[2]=$fila['nom_resumido'];
                 $p[3]=$fila['bod_cuenta'];
                 $p[4]=$fila['bod_ctaapi'];
                 $p[5]=$fila['bod_estado'];
                 $p[6]=$fila['bod_ciudad'];
                 $p[7]=$fila['bod_codica'];
                 $p[8]=$fila['bod_costos'];
                 $p[9]=$fila['bod_ctanic']; 
                 $p[10]=$fila['sede'];    
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query =  ("delete from bodegas where bod_codigo='$id' ");
            break;
        case 4:
                  $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM bodegas where bod_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p = array();
                 $p[0]=$fila['bod_codigo']; 
                 $p[1]=$fila['bod_nombre'];
                 $p[2]=$fila['nom_resumido'];
                 $p[3]=$fila['bod_cuenta'];
                 $p[4]=$fila['bod_ctaapi'];
                 $p[5]=$fila['bod_estado'];
                 $p[6]=$fila['bod_ciudad'];
                 $p[7]=$fila['bod_codica'];
                 $p[8]=$fila['bod_costos'];
                 $p[9]=$fila['bod_ctanic'];
                 $p[10]=$fila['sede'];    
            echo json_encode($p); 
            exit();
            break;
            }

