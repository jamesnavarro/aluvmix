<?php
include('../../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id_preare'];
            $preli=$_GET['prelinean'];
            $prde=$_GET['predesn'];
            $presi=$_GET['presign'];
            $prefa=$_GET['prefan'];
            $pread=$_GET['preadin'];
            $remdn=$_GET['remedn'];

            if($id==''){
                $ver=mysqli_query($con,"insert into subproceso (`sede_sub`,`nombre_subpro`,`asignacion`,`precio`,`precio_adicional`,`medida`) values ('$preli','$prde','$presi','$prefa','$pread','$remdn')");
                
                $query = mysqli_query($con,"select max(id_subpro) from subproceso");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_subpro)'];
                echo $ultimo;
            }
            else{
             
                mysqli_query($con,"update subproceso set sede_sub='$preli', nombre_subpro='$prde', asignacion='$presi', precio='$prefa', precio_adicional='$pread', medida='$remdn'  where id_subpro='$id'");
              
                echo $id;
            }
            
        break;
        case 2:
            $id=$_GET['id'];
            $query = mysqli_query($con,"SELECT * FROM subproceso where id_subpro='$id' "); //consultA modificada por navabla
            $fila = mysqli_fetch_array($query);
            $p = array();
            $p[0]=$fila['id_subpro']; 
            $p[1]=$fila['sede_sub'];
            $p[2]=$fila['nombre_subpro'];
            $p[3]=$fila['asignacion'];
            $p[4]=$fila['precio'];
            $p[5]=$fila['precio_adicional']; 
            $p[6]=$fila['medida']; 

            echo json_encode($p); 
            exit();
       break;
   
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query($con,"delete from subproceso where id_subpro='$id' ");
            
            break;
      
}

