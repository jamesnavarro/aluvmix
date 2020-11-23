<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_servi=$_GET['descrip_servi'];
            $valor_u=$_GET['valor_u'];
            $estado_servi=$_GET['estado_servi'];
            $usu_servi=$_GET['usu_servi'];
            $fecha_servi=$_GET['fecha_servi'];
              
           
           
            if($id==''){
                $ver=mysqli_query($con, "insert into servicios_c (`descripcion_s`,`valor_unidad`,`estado`,`quien_registra`,`fecha_registro`)"
                        . "values ('$descrip_servi','$valor_u','$estado_servi','$usu_servi','$fecha_servi')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id) from servicios_c");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update servicios_c set descripcion_s='$descrip_servi', valor_unidad='$valor_u', estado='$estado_servi', quien_registra='$usu_servi', fecha_registro='$fecha_servi' where id='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM servicios_c where id='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                   $p[0]=$fila['id'];
                   $p[1]=$fila['descripcion_s'];
                   $p[2]=$fila['valor_unidad']; 
                   $p[3]=$fila['estado'];
          
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from servicios_c where id='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                $query = mysqli_query($con,"SELECT * FROM servicios_c where id='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id'];
                 $p[1]=$fila['descripcion_s'];
                 $p[2]=$fila['valor_unidad']; 
                 $p[3]=$fila['estado'];
          
                 
            echo json_encode($p); 
            exit();
            break;
     
}