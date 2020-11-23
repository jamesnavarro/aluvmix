<?php
session_start();
header("Access-Control-Allow-Origin: *");
header('Content-Type: text/html; charset=utf-8');
include 'conexion_fom.php';
include 'conexioni.php';

    $result = sqlsrv_query($conn, "select * from MAEINV where INV_REFER='26086'  ");

        $c = 0;
        while ($row = sqlsrv_fetch_array($result)){
            $codigo = trim(utf8_encode($row['INV_REFER']));
            $nombre = trim(utf8_encode($row['INV_NOMBRE']));
            $referencia = trim(utf8_encode($row['INV_CODIGO']));
            $color = trim(utf8_encode($row['INV_LOTE']));
            $valor = trim(utf8_encode($row['INV_VALCOMPRA']));
            $resultado = mysqli_query($con, "select count(codigo) from productos_var where codigo='$codigo' ");
            $r = mysqli_fetch_row($resultado);
            if($r[0]>0){
                $color = 'green';
            }else{
                $color = 'red'; 
                $c += 1;
                //$sql=mysqli_query($con,"INSERT INTO `productos_var`(`codigo`, `descripcion`, `referencia`, `color`, `ancho`, `alto`, `espesor`, `area`, `peso`, `observaciones`,`estado_cr`,`usuario`, `cod_empresa`, `stock_max`, `costo_promedio`, `costo_ult_com`) VALUES ('".$codigo."','".$nombre."','".$referencia."','".$color."','0','0','0','0','0','0','0','','TEMPLADOS','0','$valor','$valor')");

            }
            echo '('.$r[0].')<font color="'.$color.'">'.$codigo. ' | '.$nombre.'</font><br>';
            
        }
        
   // echo '<script>window.close();</script>';

