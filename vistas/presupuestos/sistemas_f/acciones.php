<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_sist=$_GET['descrip_sist'];
         
           
            if($id==''){
                $ver=mysqli_query($con,"insert into sistemas (`nombre_sistema`)"
                        . "values ('$descrip_sist')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_sistema) from sistemas");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_sistema)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update sistemas set nombre_sistema='$descrip_sist' where id_sistema='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM sistemas where id_sistema='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_sistema'];
                 $p[1]=$fila['nombre_sistema'];
            echo json_encode($p); 
            exit();
            break;
        
             case 3:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from sistemas where id_sistema='$id' ");
             break;
        
            
     
}