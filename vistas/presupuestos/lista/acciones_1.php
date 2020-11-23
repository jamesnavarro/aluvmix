<?php
include('../../../modelo/conexionv1.php');
session_start();
$usuario = $_SESSION['k_username'];
switch ($_GET['sw']) {
        
            case 6:
            $id=$_GET['id'];
            $iva=$_GET['iva'];
           
            $ver = mysqli_query($con2,"update producto set ivapro='$iva' where id_p='$id' ");
            if($ver){
                echo 'Se modifico con exito '.$iva.' %';
            }else{
                echo 'Error al editar'. mysqli_error($con2).'';
            }
            break;
            
            }

