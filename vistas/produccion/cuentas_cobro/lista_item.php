<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['id_cuenta'];
    $request_ac = mysqli_query($con,"SELECT *  FROM cuenta_cobro_items a, puestos_trabajos b where a.id_puestos=b.id_puesto and  a.id_cuenta= '".$cod."' "  );
    $total2=0;
	while($fila=mysqli_fetch_array($request_ac))        
	{  
        $total2 +=$fila['valor_total'];
        echo '<tr>'
       . '<td>'.$fila['id_servicio'].'</td>'
       . '<td>'.$fila['descripcion'].'</td>'
       . '<td>'.$fila['nombre_puesto'].'</td>'
       . '<td>'.$fila['movimientos'].'</td>'
       . '<td style="text-align:right">'.number_format($fila['cantidad']).'</td>'
       . '<td style="text-align:right">'.number_format($fila['valor_unidad']).'</td>'
       . '<td style="text-align:right">'.number_format($fila['valor_total']).'</td>'
       . '<td style="text-align:right"> <img onclick="editar_items('.$fila['id'].');" src="images/modificar.png"> <img onclick="eliminar_items('.$fila['id'].');" src="images/eliminar.png">'
       . '</td>';
  }
  echo '<tr class="bg-info">
          <th colspan="6"><label style="float: right"><b>Total</b></label></th>
          <th><input type="text" id="resultado" disabled style="text-align:right;width:100%" value="$'.number_format($total2).'" class="col-xs-4 col-sm-8" style="width: 100%"></th>
          <th></th>
          </tr>';
 mysqli_query($con,"update cuenta_cobro set gran_total='$total2' where id_cuenta= '".$cod."' "  );
                 ?>
  
   <?php  }else {
   
      echo 'error';
    
}  ?>
