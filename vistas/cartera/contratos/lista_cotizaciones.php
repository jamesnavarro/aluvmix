<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $query = mysqli_query($con,"SELECT a.id_cot,a.version, a.costo_total,a.numero_cotizacion,a.presupuesto, a.obra, a.grabado, a.registrado, a.fecha_modificacion, a.fecha_reg_c, a.impresion, a.estado, b.cod_ter FROM cotizacion a, cont_terceros b where a.id_tercero= b.id_ter and a.id_contrato= '".$_GET['id']."' ");
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
        . '<td>'.$fila['numero_cotizacion'].'.'.$fila['version'].'</td>'
        . '<td>'.$fila['presupuesto'].'</td>'
        . '<td>'.$fila['registrado'].'</td>'
        . '<td>'.$fila['estado'].'</td>'
        . '<td>'.$fila['fecha_reg_c'].'</td>'  
        . '<td>$ '.number_format($fila['costo_total']).'</td>'
        . '<td><button onclick="desplegar('.$fila['id_cot'].')"><img src="../../../imagenes/pop.png">'
        . '</button> <button onclick="imprimir('.$fila['id_cot'].')"><img src="../../../imagenes/print_1.png"> </button> </td>';
    }
    ?>

<?php  }else {
    header("location:../index.php");
} ?>

