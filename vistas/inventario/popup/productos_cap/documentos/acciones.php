<?php
include('../../../../../modelo/conexioni.php');

session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
switch ($_GET['sw']) {
        case 1:
            
            $bod = $_GET['bodega'];
            $id_c = $_GET['id_c'];
            $can = $_GET['can'];
            $ubi = $_GET['ubi'];
            $cod = $_GET['cod'];
            $col = $_GET['col'];
            $costo = $_GET['costo'];
            
            $result = mysqli_query($con, "select count(id_captura) from capturas_items where id_captura='$id_c' and pro_codigo='$cod' and ubicacion='$ubi' and capcolor='$col' ");
            $f = mysqli_fetch_row($result);
            if($f[0]==0){
                    mysqli_query($con, "INSERT INTO `capturas_items` (`id_ci`, `id_captura`, `bod_codigo`, `pro_codigo`, `cantidad`, `estado_mov`, `usuario`, `valor_unidad`, `ubicacion`, `capcolor`) "
                    . " VALUES ('', '$id_c', '$bod', '$cod', '$can', '0', '$usuario', '$costo', '$ubi', '$col');");
                    $error = mysqli_error($con);
                    $msg = 'Se guardo con exito';
            }else{
                
                mysqli_query($con, "update capturas_items set cantidad=cantidad+'$can' where  id_captura='$id_c' and pro_codigo='$cod' and ubicacion='$ubi' and capcolor='$col' ");
                $error = mysqli_error($con);
                 $msg = 'Ya este producto se encuentra agregado, se actualizara las cantidades.';
            }
            if($error){
                echo 'Error al procesar los datos';
            }ELSE{
                echo $msg;
            }
            
            break;
        
}

