<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $est=$_GET['est'];
            $des=$_GET['des'];
            $res=$_GET['res'];
            $result = mysqli_query($con,"select count(*) from colores where color='$des' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into colores (`color`,`nom_resumido`,`estado_cco`,`usuario`,`cod_empresa`) values ('$des','$res','$est','$usuario','$empresa')");
            }
            else{
                mysqli_query($con,"update colores set nom_resumido='$res',estado_cco='$est' where color='$des'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM colores where color='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=''; 
                 $p[1]=$fila['color'];
                 $p[2]=$fila['nom_resumido'];
                 $p[3]=$fila['estado_cco'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from colores where color='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM colores where color='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p = array();
                 $p[0]=''; 
                 $p[1]=$fila['color'];
                 $p[2]=$fila['nom_resumido'];
                 $p[3]=$fila['estado_cco'];
        
            echo json_encode($p); 
            exit();
            break;
            }

