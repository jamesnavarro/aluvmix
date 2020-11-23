<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_vic=$_GET['descrip_vi'];
            $estado_tvi=$_GET['estado_tvi'];
           
           
            if($id==''){
                $ver=mysqli_query($con, "insert into configuracion_vidrios (`descripcion_vidrio`,`estado`)"
                        . "values ('$descrip_vic','$estado_tvi')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id) from configuracion_vidrios");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update configuracion_vidrios set descripcion_vidrio='$descrip_vic', estado='$estado_tvi' where id='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM configuracion_vidrios where id='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                   $p[0]=$fila['id'];
                   $p[1]=$fila['descripcion_vidrio'];
                   $p[2]=$fila['estado']; 
          
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from cuenta_cobro where id_cuenta='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                $query = mysqli_query($con,"SELECT * FROM configuracion_vidrios where id='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                  $p[0]=$fila['id'];
                   $p[1]=$fila['descripcion_vidrio'];
                   $p[2]=$fila['estado']; 
                 
            echo json_encode($p); 
            exit();
            break;
     
}