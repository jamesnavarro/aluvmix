<?php
include('../../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $est=$_GET['est'];
            $cod=$_GET['cod'];
            $des=$_GET['des'];
            $res=$_GET['res'];
            $result = mysqli_query($con,"select count(*) from clases where cla_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into clases (`cla_codigo`,`cla_nombre`,`cla_resumen`,`cla_estado`,`cla_usuario`,`cod_empresa`) values ('$cod','$des','$res','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update clases set cla_resumen='$res', cla_nombre='$des', cla_estado='$est'  where cla_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM clases where cla_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cla_codigo']; 
                 $p[1]=$fila['cla_nombre'];
                 $p[2]=$fila['cla_resumen'];
                 $p[3]=$fila['cla_estado'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from clases where cla_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM clases where cla_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['cla_codigo']; 
                 $p[1]=$fila['cla_nombre'];
                 $p[2]=$fila['cla_resumen'];
                 $p[3]=$fila['cla_estado'];
        
            echo json_encode($p); 
            exit();
            break;
            }

