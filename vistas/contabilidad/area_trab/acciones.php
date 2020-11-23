<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $nombartN=$_GET['nombart'];
            $estartN=$_GET['estart'];
           
            if($id==''){
                $ver=mysqli_query($con, "insert into areas (`area`,`estado_areat`) "
                                                . "values ('$nombartN','$estartN')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id) from areas");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id)'];
                echo $ultimo;
            }
            else{
                mysqli_query($con,"update areas set area='$nombartN', estado_areat='$estartN' where id='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM areas where id='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id'];
                 $p[1]=$fila['area'];
                 $p[2]=$fila['estado_areat'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from areas where id='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM areas where area='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id'];
                 $p[1]=$fila['area'];
                 $p[2]=$fila['estado_areat'];
            echo json_encode($p); 
            exit();
            break;
         
}