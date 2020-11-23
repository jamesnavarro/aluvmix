<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $est=$_GET['est'];
            $cod=$_GET['cod'];
            $des=$_GET['des'];
            $result = mysqli_query($con,"select count(*) from unidad where cod_unid='$cod'");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into unidad (`cod_unid`,`obser_unid`,`estado_unid`) values ('$cod','$des','$est')");
            }
            else{
                mysqli_query($con,"update unidad set obser_unid='$des', estado_unid='$est' where cod_unid='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $ids=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM unidad where cod_unid='$ids' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_unid']; 
                 $p[1]=$fila['obser_unid'];
                 $p[2]=$fila['estado_unid'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $idt=$_GET['id'];
               $query = mysqli_query($con,"delete from unidad where cod_unid='$idt' ");
            break;
        case 4:
               $idr=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM unidad where cod_unid='$idr'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_unid']; 
                 $p[1]=$fila['obser_unid'];
                 $p[2]=$fila['estado_unid'];
        
            echo json_encode($p); 
            exit();
            break;
            }

