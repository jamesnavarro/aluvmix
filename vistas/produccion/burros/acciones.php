<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_bur=$_GET['descrip_bur'];
            $esta_b=$_GET['esta_b'];
            $planta_b=$_GET['planta_b'];
            if($id==''){
                $ver=mysqli_query($con2,"insert into burro (`nombre`,`estado_actual`,`planta_sede`)"
                . "values ('$descrip_bur','$esta_b','$planta_b')");
                echo mysqli_error($con2);
                $query = mysqli_query($con2,"select max(id_burro) from burro");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_burro)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con2,"update burro set nombre='$descrip_bur', estado_actual='$esta_b', planta_sede='$planta_b' where id_burro='$id'");
                echo $id;
            }
            break;
          case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con2,"SELECT * FROM burro where id_burro='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_burro'];
                 $p[1]=$fila['nombre'];
                 $p[2]=$fila['estado_actual']; 
                 $p[3]=$fila['planta_sede']; 
            echo json_encode($p); 
            exit();
            break;
           case 3:
               $id=$_GET['id'];
               $query = ("delete from burro where id_burro='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con2,"SELECT * FROM burro where id_burro='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_burro'];
                 $p[1]=$fila['nombre'];
                 $p[2]=$fila['estado_actual'];   
                 $p[3]=$fila['planta_sede']; 
            echo json_encode($p); 
            exit();
            break;
     
}