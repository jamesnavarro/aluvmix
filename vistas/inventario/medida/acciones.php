<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $cod=$_GET['cod'];
            $des=$_GET['des'];
            $res=$_GET['res'];
            $est=$_GET['est'];
            $fmedh=$_GET['fmedh'];
            $fmedv=$_GET['fmedv'];
            $fsepa=$_GET['fsepa'];
            $ftipom=$_GET['ftipom'];
            $result = mysqli_query($con,"select count(*) from medidas where cod_medida='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into medidas (`cod_medida`,`nom_medida`,`resu_medida`,`esta_medida`,`hor_medida`,`vert_medida`,`sepa_medida`,`tipo_medida`) values ('$cod','$des','$res','$est','$fmedh','$fmedv','$fsepa','$ftipom')");
            }
            else{
                mysqli_query($con,"update medidas set nom_medida='$des', resu_medida='$res', esta_medida='$est', hor_medida='$fmedh', vert_medida='$fmedv', sepa_medida='$fsepa', tipo_medida='$ftipom' where cod_medida='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM medidas where cod_medida='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_medida']; 
                 $p[1]=$fila['nom_medida'];
                 $p[2]=$fila['resu_medida'];
                 $p[3]=$fila['esta_medida'];
                 $p[4]=$fila['hor_medida'];
                 $p[5]=$fila['vert_medida']; 
                 $p[6]=$fila['sepa_medida'];
                 $p[7]=$fila['tipo_medida'];
                
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from medidas where cod_medida='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM medidas where cod_medida='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p[0]=$fila['cod_medida']; 
                 $p[1]=$fila['nom_medida'];
                 $p[2]=$fila['resu_medida'];
                 $p[3]=$fila['esta_medida'];
                 $p[4]=$fila['hor_medida'];
                 $p[5]=$fila['vert_medida']; 
                 $p[6]=$fila['sepa_medida'];
                 $p[7]=$fila['tipo_medida'];
            echo json_encode($p); 
            exit();
            break;
            }

