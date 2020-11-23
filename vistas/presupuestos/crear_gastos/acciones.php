<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_pr'];
            $refern=$_GET['refee'];
            $descripc=$_GET['descpp'];
            $porcen=$_GET['porr'];
            $estga=$_GET['estgas'];

            if($id==''){
               
                $ver=mysqli_query($con,"insert into referencia_admin (`referencia_ad`,`descripcion_ad`,`porcentaje_ad`,`estado`) values ('$refern','$descripc','$porcen','$estga')");
                
                $query = mysqli_query($con,"select max(id_ref_ad) from referencia_admin");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_ref_ad)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update referencia_admin set referencia_ad='$refern', descripcion_ad='$descripc',  porcentaje_ad='$porcen',  estado='$estga'  where id_ref_ad='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM referencia_admin where id_ref_ad='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_ref_ad']; 
            $p[1]=$fila['referencia_ad'];
            $p[2]=$fila['descripcion_ad'];
            $p[3]=$fila['porcentaje_ad'];
            $p[4]=$fila['estado'];
            echo json_encode($p); 
            exit();
       break;
   
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query($con,"delete from referencia_admin where id_ref_ad='$id' ");
            
            break;
      
}

