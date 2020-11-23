<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_pr'];
            $ref=$_GET['refeen'];
            $des=$_GET['descppn'];
            $int=$_GET['intnn'];
            $fr_cobn=$_GET['fr_cobb'];
            $uti=$_GET['utinn'];

            if($id==''){
               
                $ver=mysqli_query($con,"insert into referencia_mo (`referencia`,`descripcion_mo`,`instalacion`,`unidad_cobro`,`utilidad`) values ('$ref','$des','$int','$fr_cobn','$uti')");
                
                $query = mysqli_query($con,"select max(id_ref_mo) from referencia_mo");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ref_mo)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update referencia_mo set referencia='$ref',descripcion_mo='$des',instalacion='$int',unidad_cobro='$fr_cobn',utilidad='$uti' where id_ref_mo='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM referencia_mo where id_ref_mo='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_ref_mo']; 
            $p[1]=$fila['referencia'];
            $p[2]=$fila['descripcion_mo'];
            $p[3]=$fila['instalacion'];
            $p[4]=$fila['unidad_cobro'];
            $p[5]=$fila['utilidad'];
            echo json_encode($p); 
            exit();
       break;
   
    case 3:
          
            $id=$_GET['id'];
            $query = mysqli_query($con,"delete from referencia_mo where id_ref_mo='$id' ");
            
    break;
}

