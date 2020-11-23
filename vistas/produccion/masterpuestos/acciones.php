<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $descrip_bur=$_GET['descrip_bur'];
            $esta_b=$_GET['esta_b'];
            $planta_b=$_GET['planta_b'];
            if($id==''){
                $ver=mysqli_query($con2,"insert into puestos (`nombrepuesto`,`sede`,`planta_sede`)"
                . "values ('$descrip_bur','$esta_b','$planta_b')");
                echo mysqli_error($con2);
                $query = mysqli_query($con2,"select max(id_puestos) from puestos");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_puestos)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con2,"update puestos set nombrepuesto='$descrip_bur', sede='$esta_b', planta_sede='$planta_b' where id_puestos='$id'");
                echo $id;
            }
            break;
          case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con2,"SELECT * FROM puestos where id_puesto='$id' ");
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila[0];
                 $p[1]=$fila[1];
                 $p[2]=$fila[2]; 
                 $p[3]=$fila[3];
                 $p[4]=$fila[4]; 
                 $p[5]=$fila[5]; 
                 $p[6]=$fila[6]; 
                 $p[7]=$fila[7]; 
                 $p[8]=$fila[8]; 
                 $p[9]=$fila[9]; 
                 $p[10]=$fila[10]; 
            echo json_encode($p); 
            exit();
            break;
           case 3:
               $id=$_GET['id'];
               $query = ("delete from puestos where id_puestos='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con2,"SELECT * FROM puestos where id_puestos='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_puestos'];
                 $p[1]=$fila['nombrepuesto'];
                 $p[2]=$fila['sede'];   
                 $p[3]=$fila['planta_sede']; 
            echo json_encode($p); 
            exit();
            break;
         case 5:
            $id=$_GET['id'];
            $sede=$_GET['sede'];
            $nom=$_GET['nom'];
            $mo=$_GET['mo'];
            $um1=$_GET['um1'];
            $ma=$_GET['ma'];
            $um2=$_GET['um2'];
            $ci=$_GET['ci'];
            $um3=$_GET['um3'];
       
               if($id==''){
                   mysqli_query($con2,"INSERT INTO `puestos` (`id_puesto`, `id_area`, `centrocosto`, `nombrepuesto`, `sede`, `valmo`, `um1`, `valmq`, `um2`, `valcif`, `um3`) "
                           . "VALUES (NULL, '$id', '', '$nom', '$sede', '$mo', '$um1', '$ma', '$um2', '$ci', '$um3')");
                   echo 'Se agrego con exito';
               }else{
                   mysqli_query($con2,"UPDATE `puestos` SET sede='$sede',`nombrepuesto` = '$nom',`valmo` = '$mo', `um1` = '$um1', `valmq` = '$ma', `um2` = '$um2', `valcif` = '$ci', `um3` = '$um3' WHERE  id_puesto='$id'  ");
                   echo 'Se edito con exito';
               }
            
            break;
     
}