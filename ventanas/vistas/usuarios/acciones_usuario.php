<?php
include('../../modelo/conexion.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            
            $cd=$_GET['codigo'];
            $nom=$_GET['nombres'];
            $usu=$_GET['usuario'];
            $cla= md5($_GET['clave']);
            $est=$_GET['estado'];
    
            if($cd==''){
               
                mysqli_query($con,"insert into usuarios (nombres, usuario, clave, estado) values ('$nom','$usu', '$cla','$est')");

                $query = mysqli_query($con,"select max(id_usuario) from usuarios ");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_usuario)'];
                echo $ultimo ;
            }else{
                if($cla==''){
                  mysqli_query($con,"update usuarios set nombres='$nom',usuario='$usu' , estado='$est' where id_usuario='$cd' ");  
                }else {
                 mysqli_query($con,"update usuarios set nombres='$nom',usuario='$usu' ,clave='$cla', estado='$est' where id_usuario='$cd' ");
                }
        
                echo $cd;
            }
            
        break;
        case 2:
      
            $id=$_GET['id'];
            $query = mysqli_query($con,"select * from usuarios where id_usuario='$id' ");
            $fila = mysqli_fetch_array($query);
        
            $p = array();
            $p[0]=$fila['id_usuario']; 
            $p[1]=$fila['usuario'];
            $p[2]=$fila['nombres']; 
            $p[3]=$fila['clave'];
            $p[4]=$fila['fecha_reg'];
            $p[5]=$fila['estado'];
        
            echo json_encode($p);
            exit();
            break;
        case 3:
          
            $id=$_GET['id'];
        
            $query = mysqli_query($con,"delete from usuarios where id_usuario='$id' ");
            
            break;
        
}

