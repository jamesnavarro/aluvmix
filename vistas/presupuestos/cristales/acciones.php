<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_cris'];
            $descrip_cris=$_GET['descrip_cris'];
            $area_cris=$_GET['area_cris'];
            $sec_cris=$_GET['secu_cristal'];
          

            if($id==''){
               
                $ver=mysqli_query($con,"insert into cristales (`cristal`,`id_area`,`secuencia`) values ('$descrip_cris','$area_cris','$sec_cris')");
                
                $query = mysqli_query($con,"select max(id) from cristales");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update cristales set cristal='$descrip_cris', id_area='$area_cris', secuencia='$sec_cris' where id='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM cristales where id='$id' ");
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id']; 
            $p[1]=$fila['cristal'];
            $p[2]=$fila['id_area'];
            $p[3]=$fila['secuencia'];
          
            echo json_encode($p); 
            exit();
       break;
   
    case 3:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from cristales where id='$id' ");
            
    break;
}

