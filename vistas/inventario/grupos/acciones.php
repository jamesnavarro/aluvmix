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
            $result = mysqli_query($con,"select count(*) from grupos where gru_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into grupos (`gru_codigo`,`gru_nombre`,`gru_resumen`,`gru_estado`,`gru_usuario`,`cod_empresa`) values ('$cod','$des','$res','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update grupos set gru_resumen='$res', gru_nombre='$des',gru_estado='$est' where gru_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM grupos where gru_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['gru_codigo']; 
                 $p[1]=$fila['gru_nombre'];
                 $p[2]=$fila['gru_resumen'];
                 $p[3]=$fila['gru_estado'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from grupos where gru_codigo='$id' ");
            break;
            case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM grupos where gru_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['gru_codigo']; 
                 $p[1]=$fila['gru_nombre'];
                 $p[2]=$fila['gru_resumen'];
                 $p[3]=$fila['gru_estado'];
        
            echo json_encode($p); 
            exit();
            break;
            }

