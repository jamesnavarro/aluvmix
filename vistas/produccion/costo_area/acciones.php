<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_public=$_GET['descrip_public'];
            $servi_public=$_GET['servi_public'];
            $fech_public=$_GET['fech_public'];
           
            if($id==''){
                $ver=mysqli_query($con,"insert into publicos_serv (`descripcion_p`,`usuario`,`fecha`)"
                        . "values ('$descrip_public','$servi_public','$fech_public')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_publicos) from publicos_serv");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_publicos)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update publicos_serv set descripcion_p='$descrip_public', usuario='$servi_public', fecha='$fech_public' where id_publicos='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM publicos_serv where id_publicos='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_publicos'];
                 $p[1]=$fila['descripcion_p'];
                 $p[2]=$fila['usuario']; 
                 $p[3]=$fila['fecha'];
            echo json_encode($p); 
            exit();
            break;
        
            case 3:
               $id=$_GET['id'];
               $query = ("delete from publicos_serv where id_publicos='$id'");
            break;
        
            case 4:
                 $id=$_GET['cod'];
                $query = mysqli_query($con,"SELECT * FROM publicos_serv where id_publicos='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                   $p[0]=$fila['id_publicos'];
                   $p[1]=$fila['descripcion_p'];
                   $p[2]=$fila['usuario']; 
                   $p[3]=$fila['fecha'];                 
            echo json_encode($p); 
            exit();
            break;
     
}