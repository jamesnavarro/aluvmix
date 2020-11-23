<?php
include('../../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_col'];
            $alumcol=$_GET['coloralun'];
            $alumcos=$_GET['cosalumn'];

            if($id==''){
                $ver=mysqli_query($con,"insert into tipo_aluminio (`color_a`,`costo_a`) values ('$alumcol','$alumcos')");
                
                $query = mysqli_query($con,"select max(id_ta) from tipo_aluminio");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ta)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update tipo_aluminio set color_a='$alumcol',costo_a='$alumcos' where id_ta='$id'");
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM tipo_aluminio where id_ta='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_ta']; 
            $p[1]=$fila['color_a'];
            $p[2]=$fila['costo_a'];
            echo json_encode($p); 
            exit();
       break;
   
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query($con,"delete from tipo_aluminio where id_ta='$id' ");
            
            break;
      
}

