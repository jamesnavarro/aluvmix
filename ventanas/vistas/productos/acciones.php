<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
           
            $id=$_GET['id'];
            $desc=$_GET['desc'];
            $pre=$_GET['pre'];
            $tip=$_GET['tip'];
            $est=$_GET['est'];
      
            if($id==''){
               
                mysqli_query($con,"insert into articulos (descripcion, precio, id_tipo, estado, registrado_por) values ('$desc','$pre','$tip','$est','".$_SESSION['id_usuario']."')");

                $query = mysqli_query($con,"select max(id_a) from articulos ");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_a)'];
                echo $ultimo;
            }else{
               
                mysqli_query($con,"update articulos set descripcion='$desc', precio='$pre', id_tipo='$tip', estado='$est' where id_a='$id' ");

                echo $id;
            }
            
        break;
        case 2:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * from articulos where id_a='$id' ");
            $fila = mysqli_fetch_array($query);
  
            $p = array();
            $p[0]=  $fila['id_a']; 
            $p[1]=$fila['descripcion'];
            $p[2]=$fila['precio'];
            $p[3]=$fila['id_tipo'];
            $p[4]=$fila['estado'];
            $p[5]=$fila['fecha_reg'];
            $p[6]=$fila['registrado_por'];
            echo json_encode($p);
            exit();
            break;
        case 3:
            
            $id=$_GET['id'];
       
            $query = mysqli_query($con,"delete from articulos where id_a='$id' ");
            
            break;
        
}

