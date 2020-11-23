<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
           
            $num=$_GET['numero'];
            $nombre=$_GET['nombre'];
            $estado=$_GET['estado'];
        
            if($num==''){
              
                mysqli_query($con,"insert into tipos (nombre, estado) values ('$nombre','$estado')")or die(mysqli_error());

                $query = mysqli_query($con,"select max(id_tipo) from tipos ");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_tipo)'];
                echo $ultimo;
            }else{
                mysqli_query($con,"update tipos set nombre='".$nombre."', estado='$estado' WHERE id_tipo='$num'");
               
                echo $num;
            }
            
        break;
        case 2:
       
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * from tipos where id_tipo='$id' ");
            $fila = mysqli_fetch_array($query);
       
            $p = array();
            $p[0]=$fila['id_tipo']; 
            $p[1]=$fila['nombre'];
            $p[2]=$fila['estado'];
        
            echo json_encode($p);
            exit();
            break;
        case 3:
         
            $id=$_GET['id'];
         
            $query = mysqli_query($con,"delete from tipos where id_tipo='$id' ");
            
            break;
        
}

