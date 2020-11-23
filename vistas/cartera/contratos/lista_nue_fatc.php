<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

   $query = mysqli_query($con,"SELECT * FROM pagos_realizados where id_cliente_fact='".$_GET['id']."' order by fecha_regs_factura desc ");
   
   $comf = 0; $plan = 0;
   $vtotal = 0;
    while ($fila = mysqli_fetch_array($query)){
        if($fila['estado_nue_fact']=='No cancelado'){
            $stilo = ' style="background-color:red;" ';
            $plan += 1; 
        }else{
             $stilo = ' style="background-color:green;" ';
             $comf += 1;
        }
        $vtotal += $fila['valor_total_fact'];
        echo '<tr>' 
       . '<td>'.$fila['remision_fac'].'</td>'
       . '<td>'.$fila['pedido_fact'].'</td>'
       . '<td>'.$fila['fecha_regs_factura'].'</td>'
       . '<td>'.$fila['fecha_pagada'].'</td>'
       . '<td>'.number_format($fila['valor_total_fact']).'</td>'
       . '<td'.$stilo.'>'.$fila['estado_nue_fact'].'</td>'
       . '<td> <button onclick="editar_nuefact('.$fila['id_pagos_f'].')" class="glyphicon glyphicon-pencil"> </button></td>';
    
    }
 echo '<tr><td></td>'
         . '<td></td>'
         . '<td></td>'
         . '<td style="text-align:right"><b>Total Facturas</b></td>'
         . '<td><input type="text" id="vtot" value="'.$vtotal.'" disabled style="width:80px;text-align:right"></td>'
         . '<td></td>'
         . '<td></td>';
  echo '<tr><td></td>'
         . '<td></td>'
         . '<td></td>'
         . '<td style="text-align:right"><b>Saldo Principal</b></td>'
         . '<td><input type="text" id="vtot" value="'.$_GET['saldo'].'" disabled style="width:80px;text-align:right"></td>'
         . '<td></td>'
         . '<td></td>';
   echo '<tr><td></td>'
         . '<td></td>'
         . '<td></td>'
         . '<td style="text-align:right"><b>Saldo Pendiente</b></td>'
         . '<td><input type="text" id="vtot" value="'.($_GET['saldo']-$vtotal).'" disabled style="width:80px;text-align:right"></td>'
         . '<td></td>'
         . '<td></td>';
    ?>

<?php  }else {
   
   echo '<script> window.close(); </script>';
    
} ?>

