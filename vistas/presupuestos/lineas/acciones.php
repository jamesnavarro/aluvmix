<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_lil'];
            $reflineas=$_GET['dlineasl'];
          

            if($id==''){
               
                $ver=mysqli_query($con,"insert into lineas (`linea`) values ('$reflineas')");
                
                $query = mysqli_query($con,"select max(id_linea) from lineas");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_linea)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update lineas set linea='$reflineas' where id_linea='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM lineas where id_linea='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_linea']; 
            $p[1]=$fila['linea'];
          
            echo json_encode($p); 
            exit();
       break;
   
    case 3:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from lineas where id_linea='$id' ");
            
    break;
}

