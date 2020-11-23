<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:

            $cod=$_GET['cod'];
            $des=$_GET['des'];

            $result = mysqli_query($con,"select count(*) from clases_centros where cla_codigo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into clases_centros (`cla_codigo`,`cla_nombre`,`usuario`) values ('$cod','$des','$usuario')");
            }
            else{
                mysqli_query($con,"update clases_centros set  cla_nombre='$des', usuario='$usuario' where cla_codigo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM clases_centros where cla_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cla_codigo']; 
                 $p[1]=$fila['cla_nombre'];

        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from clases_centros where cla_codigo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM clases_centros where cla_codigo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                  $p = array();
                 $p[0]=$fila['cla_codigo']; 
                 $p[1]=$fila['cla_nombre'];
  
        
            echo json_encode($p); 
            exit();
            break;
            }

