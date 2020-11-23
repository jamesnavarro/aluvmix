<?php
include('../../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
         
            $id=$_GET['ids'];
            $noms=$_GET['nombres'];
            if($id==''){
               
                $ver=mysqli_query($con,"insert into sistemas (`nombre_sistema`) values ('$noms')");
                
                $query = mysqli_query($con,"select max(id_sistema) from sistemas");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_sistema)'];
                echo $ultimo;
            }
            else{
     
                mysqli_query($con,"update sistemas set nombre_sistema='$noms' where id_sistema='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT *from sistemas where id_sistema='$id' "); //consultA modificada por navabla
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
             echo json_encode($p); 
            exit();
       break; 
  
}

