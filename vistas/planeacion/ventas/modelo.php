<?php
include '../../../modelo/conexioni.php';
session_start();
$usuario = $_SESSION['k_username'];
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:
              $request2=mysqli_query($con,'select max(orden) from cotizacion ');
              $row2=mysqli_fetch_array($request2);
              $orden = $row2[0]+1;
              mysqli_query($con, "update cotizacion set estado='Aprobado', orden='$orden', fecha_pedido='$fecha',usuario_pedido='$usuario'  WHERE id_cot='".$_GET["cot"]."' ");
              echo 'Se genero el pedido No.'.$orden;
        break;
    case 2:
              $cot = $_GET['cot'];
              $ped = $_GET['ped'];
              $opf = $_GET['opf'];
              mysqli_query($con, "insert into orden_produccion (id_cot,fecha_registro,estado_o,opf,generado_user)"
                      . " values ('$cot','".date("Y-m-d")."','En proceso','$opf','$usuario')  ");
              $orden = mysqli_insert_id($con);
      
              $p = array();
              $p[0] = $cot;
              $p[1] = $orden;
              echo json_encode($p);
        break;
}

