<?php
include('../../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_sr'];
            $deson=$_GET['desss'];
            $rencia=$_GET['refss'];
            $lorva=$_GET['valss'];
            if($id==''){
                $ver=mysqli_query($con,"insert into servicios (`descripcion_serv`,`referencia_serv`,`costo_serv`) values ('$deson','$rencia','$lorva')");
                
                $query = mysqli_query($con,"select max(id_servicio) from servicios");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_servicio)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update servicios set descripcion_serv='$deson',referencia_serv='$rencia',costo_serv='$lorva' where id_servicio='$id'");
                echo $id;
            }
            break;
            case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM servicios where id_servicio='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_servicio']; 
                 $p[1]=$fila['descripcion_serv'];
                 $p[2]=$fila['referencia_serv'];
                 $p[3]=$fila['costo_serv'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = mysqli_query($con,"delete from servicios where id_servicio='$id' ");
            break;
            }

