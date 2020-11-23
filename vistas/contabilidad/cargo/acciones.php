<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            $id=$_GET['id'];
            $nombcargN=$_GET['nombcarg'];
            $estadcargN=$_GET['estadcarg'];
           
            if($id==''){
                $ver=mysqli_query($con, "insert into cargos (`nom_cargo`,`estado_cargo`) "
                                                . "values ('$nombcargN','$estadcargN')");
                echo mysqli_error($con);
                $query = mysqli_query($con,"select max(id_cargo) from cargos");
                $m = mysqli_fetch_array($query);
                $ultimo = $m['max(id_cargo)'];
                echo $ultimo;
            }
            else{
               
                mysqli_query($con,"update cargos set nom_cargo='$nombcargN', estado_cargo='$estadcargN' where id_cargo='$id'");
                echo $id;
            }
            break;
             case 2:
                 $id=$_GET['id'];
                 $query = mysqli_query($con,"SELECT * FROM cargos where id_cargo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array(); 
                 $p[0]=$fila['id_cargo'];
                 $p[1]=$fila['nom_cargo'];
                 $p[2]=$fila['estado_cargo'];
            echo json_encode($p); 
            exit();
            break;
            case 3:
               $id=$_GET['id'];
               $query = ("delete from cargos where id_cargo='$id' ");
            break;
            case 4:
                 $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM cargos where nom_cargo='$id' "); //consultA modificada por navabla
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['id_cargo'];
                 $p[1]=$fila['nom_cargo'];
                 $p[2]=$fila['estado_cargo'];
            echo json_encode($p); 
            exit();
            break;
         
}