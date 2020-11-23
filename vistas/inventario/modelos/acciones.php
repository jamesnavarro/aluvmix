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
            $result = mysqli_query($con,"select count(*) from modelo where cod_modelo='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into modelo (`cod_modelo`,`nom_modelo`,`resu_modelo`,`estado_mod`) values ('$cod','$des','$res','$est')");
            }
            else{
                mysqli_query($con,"update modelo set resu_modelo='$res', nom_modelo='$des', estado_mod='$est' where cod_modelo='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM modelo where cod_modelo='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_modelo']; 
                 $p[1]=$fila['nom_modelo'];
                 $p[2]=$fila['resu_modelo'];
                 $p[3]=$fila['estado_mod'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from modelo where cod_modelo='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM modelo where cod_modelo='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_modelo']; 
                 $p[1]=$fila['nom_modelo'];
                 $p[2]=$fila['resu_modelo'];
                 $p[3]=$fila['estado_mod'];
        
            echo json_encode($p); 
            exit();
            break;
            }

