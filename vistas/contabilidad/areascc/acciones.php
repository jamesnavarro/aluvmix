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
            $result = mysqli_query($con,"select count(*) from areascc where are_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into areascc (`are_codigo`,`are_nombre`,`are_nomrem`,`are_activo`,`usuario`,`cod_empresa`) values ('$cod','$des','$res','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update areascc set are_nomrem='$res', are_nombre='$des', are_activo='$est', usuario='$usuario' where are_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM areascc where are_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['are_codigo']; 
                 $p[1]=$fila['are_nombre'];
                 $p[2]=$fila['are_nomrem'];
                 $p[3]=$fila['are_activo'];
                 $p[4]=substr($fila['are_codigo'],0,2);
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from areascc where are_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM areascc where are_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['are_codigo']; 
                 $p[1]=$fila['are_nombre'];
                 $p[2]=$fila['are_nomrem'];
                 $p[3]=$fila['are_activo'];
                 $p[4]=substr($fila['are_codigo'],0,2);
        
            echo json_encode($p); 
            exit();
            break;
            }

