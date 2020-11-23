<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

    $query = mysqli_query($con,"SELECT * FROM pagos_realizados where id_cliente_fact='".$_GET['id']."' order by fecha_regs_factura desc ");
   
   $comf = 0; $plan = 0;
   $vr = 0;
    while ($fila = mysqli_fetch_array($query)){
        if($fila['estado_ret']=='No cancelado'){
            $stilo = ' style="background-color:red;" ';
            $plan += 1; 
        }else{
             $stilo = ' style="background-color:green;" ';
             $comf += 1;
        }
        $vr += $fila['valor_retegarantia_f'];
        echo '<tr>' 
       . '<td>'.$fila['remision_fac'].'</td>'
       . '<td>'.$fila['pedido_fact'].'</td>'
       . '<td>'.$fila['fecha_regs_factura'].'</td>'
//      . '<td><a href="mailto:'.$fila['email1'].'">'.$fila['email1'].'</a></td>'
       . '<td>'.$fila['registra_nom_fact'].'</td>'
       . '<td>'.number_format($fila['valor_retegarantia_f']).'</td>'
       . '<td>'.$fila['cobrado_por'].'</td>'
       . '<td'.$stilo.'>'.$fila['estado_ret'].'</td>'
       . '<td> <input type="checkbox" id="id'.$fila['id_pagos_f'].'" name="item" onclick="rete('.$fila['id_pagos_f'].')" checked></td>';
    
    }
 echo '<tr><td></td>'
         . '<td></td>'
         . '<td></td>'
         . '<td>Total a Pagar</td>'
         . '<td><input type="text" id="vret" value="'.$vr.'" disabled style="width:80px"></td>'
         . '<td><input type="text" id="cobrado" value="'.$_SESSION['k_username'].'" disabled style="width:80px"></td>'
         . '<td><button onclick="pagar();">Cobrar</button></td>';
    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

