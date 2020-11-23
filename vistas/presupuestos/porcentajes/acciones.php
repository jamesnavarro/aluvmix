<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_p'];
            $linn=$_GET['lin'];
            $pruno=$_GET['prr1'];
            $prdos=$_GET['prr2'];
           

            if($id==''){
               
                $ver=mysqli_query($con,"insert into porcentajes (`nombre`,`porc_desp`,`porc_venta`) values ('$linn','$pruno','$prdos')");
                
                $query = mysqli_query($con,"select max(id_por) from porcentajes");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_por)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update porcentajes set nombre='$linn', porc_desp='$pruno', porc_venta='$prdos' where id_por='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM porcentajes where id_por='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_por']; 
            $p[1]=$fila['nombre'];
            $p[2]=$fila['porc_desp'];
            $p[3]=$fila['porc_venta'];
       
            echo json_encode($p); 
            exit();
       break;
     
     
        case 7:
            echo date("Y-m-d H:i:s");
            break;
}

