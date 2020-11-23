<?php
include('../../../modelo/conexioni.php');
session_start();
switch ($_GET['sw']) {
        case 1:
            $codigo = $_GET['cod'];
            $resultado = mysqli_query($con, "select count(codigo) from productos_var where codigo='$codigo' ");
            $r = mysqli_fetch_row($resultado);
            echo $r[0];
            if($r[0]==0){
            $sql=mysqli_query($con,"INSERT INTO `productos_var`(`codigo`, `descripcion`, `referencia`, `color`,`usuario`, `costo_promedio`, `costo_ult_com`, `cod_empresa`)"
                    . " VALUES ('".$_GET['cod']."','".$_GET['des']."','".$_GET['ref']."','".$_GET['col']."','".$_GET['user']."','".$_GET['valor']."','".$_GET['valor']."','TEMPLADOS')");
            }
        break;
        case 2:
            
       break;
   
    case 3:
     
            
    break;
}

