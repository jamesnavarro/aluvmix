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
            $result = mysqli_query($con,"select count(*) from centroproduccion where cp_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into centroproduccion (`cp_codigo`,`cp_nombre`,`cp_nomrem`,`cp_activo`,`usuario`,`cod_empresa`) values ('$cod','$des','$res','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update centroproduccion set cp_nomrem='$res', cp_nombre='$des', cp_activo='$est', usuario='$usuario' where cp_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM centroproduccion where cp_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cp_codigo']; 
                 $p[1]=$fila['cp_nombre'];
                 $p[2]=$fila['cp_nomrem'];
                 $p[3]=$fila['cp_activo'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from centroproduccion where cp_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM centroproduccion where cp_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['cp_codigo']; 
                 $p[1]=$fila['cp_nombre'];
                 $p[2]=$fila['cp_nomrem'];
                 $p[3]=$fila['cp_activo'];
        
            echo json_encode($p); 
            exit();
            break;
            }

