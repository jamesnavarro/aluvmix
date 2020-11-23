<?php
include('../../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_otr'];
            $reftr=$_GET['ref_otrr'];
            $destr=$_GET['des_otrr'];
            $inttr=$_GET['cantrr'];
            $frtr=$_GET['vaotrr'];
            if($id==''){
               
                $ver=mysqli_query($con,"insert into referencia_otro (`referencia_ot`,`descripcion_ot`,`cantidad_ot`,`valor_ot`) values ('$reftr','$destr','$inttr','$frtr')");
                
                $query = mysqli_query($con,"select max(id_ref_ot) from referencia_otro");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ref_ot)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update referencia_otro set referencia_ot='$reftr',descripcion_ot='$destr',cantidad_ot='$inttr',valor_ot='$frtr' where id_ref_ot='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM referencia_otro where id_ref_ot='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_ref_ot']; 
            $p[1]=$fila['referencia_ot'];
            $p[2]=$fila['descripcion_ot'];
            $p[3]=$fila['cantidad_ot'];
            $p[4]=$fila['valor_ot'];
            echo json_encode($p); 
            exit();
       break;
   
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query($con,"delete from referencia_otro where id_ref_ot='$id' ");
            
            break;
      
}

