<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        
        case 1:
               $id=$_GET['cod'];
                 $query = mysqli_query($con,"SELECT * FROM cont_terceros where cod_ter='$id'");
                 $fila = mysqli_fetch_array($query);
                 $p = array();
                 $p[0]=$fila['cod_ter']; 
                 $p[1]=$fila['nom_ter'];
                 $p[2]=$fila['telmovil_ter'];
                 $p[3]=$fila['correo_ter'];
                 echo json_encode($p); 
                 exit();
                 break;
        case 2:
            
            $sql=mysqli_query($con,"INSERT INTO `cont_terceros`(`cod_ter`, `nom_ter`, `telmovil_ter`, `correo_ter`, `creado`, `fecha_registro`)"
            . " VALUES ('".$_GET['ced']."','".$_GET['nom']."','".$_GET['tel']."','".$_GET['ema']."','".$_GET['use']."','".date("Y-m-d H:i:S")."')");
	    echo  mysqli_error($con);
            break;
            }

