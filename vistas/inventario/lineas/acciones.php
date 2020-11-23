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
            $res=$_GET['res'];
            $result = mysqli_query($con,"select count(*) from lineas where lin_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into lineas (`lin_codigo`,`lin_nombre`,`lin_resumen`,`lin_estado`,`lin_usuario`,`cod_empresa`) values ('$cod','$des','$res','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update lineas set lin_resumen='$res', lin_nombre='$des', lin_estado='$est' where lin_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM lineas where lin_codigo='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['lin_codigo']; 
                 $p[1]=$fila['lin_nombre'];
                 $p[2]=$fila['lin_resumen'];
                 $p[3]=$fila['lin_estado'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from lineas where lin_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM lineas where lin_codigo='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['lin_codigo']; 
                 $p[1]=$fila['lin_nombre'];
                 $p[2]=$fila['lin_resumen'];
                 $p[3]=$fila['lin_estado'];
        
            echo json_encode($p); 
            exit();
            break;
            }

