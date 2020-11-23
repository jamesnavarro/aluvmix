<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
                mysqli_query($con,"INSERT INTO `solicitudes_item`(`iva`,`undmed`,`codigo`, `id_sol`, `descripcion`, `date_added`, `cantidad`, `cantidad_pen`, `color`, `medida`, `user_id`, `precio`, `observacion`)"
                        . "  VALUES ('".$_GET['iva']."','".$_GET['und']."','".$_GET['cod']."','0','".$_GET['des']."','".date("Y-m-d")."','".$_GET['can']."','".$_GET['can']."','".$_GET['col']."','".$_GET['per']."','".$_SESSION['id_user']."','".$_GET['pre']."','".$_GET['obs']."')");
	
                 echo mysqli_error($con);
            break;
            case 2:
              $consulta=mysql_query($con,"select sum(stock_ubi) as st FROM `relacion_ubicaciones` where bod_codigo='".$_GET['bod']."' and codigo_pro='".$_GET['cod']."' ");
                     $s = mysqli_fetch_array($consulta);
                     $stock = $s[0];
                     if($stock==null){
                         $st = 0;
                     }else{
                         $st = $stock;
                     }
                     echo $st;
            break;
        case 3:
              
            break;
            }


