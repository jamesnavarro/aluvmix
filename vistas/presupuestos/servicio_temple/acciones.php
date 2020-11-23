<?php
include('../../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_e'];
            $espesr=$_GET['rspsrr'];
            $tem_cos=$_GET['cost_tm'];

            if($id==''){
               
                $ver=mysqli_query($con,"insert into servicio_temple (`espesor`,`costo`) values ('$espesr','$tem_cos')");
                
                $query = mysqli_query($con,"select max(id_temple) from servicio_temple");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_temple)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update servicio_temple set espesor='$espesr',costo='$tem_cos' where id_temple='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM servicio_temple where id_temple='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_temple']; 
            $p[1]=$fila['espesor'];
            $p[2]=$fila['costo'];
            echo json_encode($p); 
            exit();
       break;
      
}

