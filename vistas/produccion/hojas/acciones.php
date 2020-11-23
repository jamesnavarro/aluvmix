<?php
include('../../../modelo/conexion.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
       
          case 1:
                 $id=$_GET['id'];
                 $query = mysqli_query($conexion,"SELECT relacionado,sum(a.cant_ordenada) as can ,sum(b.precio_item/b.cantidad_c) as pre, sum((a.medida1/1000)*(a.medida2/1000)) as m2  FROM orden_detalle a, cotizaciones b, producto c where a.codigo=".$id." and a.parte_otro = 0 AND a.relacionado = b.id_cotizacion AND b.id_referencia = c.id_p group by c.id_p ");
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['relacionado'];
                 $p[1]=$fila['can'];
            echo json_encode($p); 
            exit();
            break;
           case 3:
               $id=$_GET['id'];
               $query = ("delete from burro where id_burro='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM burro where id_burro='$id' "); //consultA modificada por navabla
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