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
            $result = mysqli_query($con,"select count(*) from marcas where cod_marca='$cod' ");
            $f = mysqli_fetch_array($result);
            
            if($f[0]==0){
                $ver=mysqli_query($con,"insert into marcas (`cod_marca`,`nom_marca`,`resu_marca`,`est_marca`) values ('$cod','$des','$res','$est')");
            }
            else{
                mysqli_query($con,"update marcas set resu_marca='$res', nom_marca='$des', est_marca='$est' where cod_marca='$cod'");
                echo $id;
            }
            
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM marcas where cod_marca='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_marca']; 
                 $p[1]=$fila['nom_marca'];
                 $p[2]=$fila['resu_marca'];
                 $p[3]=$fila['est_marca'];
        
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from marcas where cod_marca='$id' ");
            break;
        case 4:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM marcas where cod_marca='$id'"); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_marca']; 
                 $p[1]=$fila['nom_marca'];
                 $p[2]=$fila['resu_marca'];
                 $p[3]=$fila['est_marca'];
        
            echo json_encode($p); 
            exit();
            break;
            }

