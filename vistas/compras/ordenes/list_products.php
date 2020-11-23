<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $sql=mysqli_query($con,"SELECT * FROM orden_compra_detalle WHERE codigo_orden='".$_POST['ids']."'");
   $total = 0;
   while($row=mysqli_fetch_array($sql)){
       $total += $row['precio']*$row['cantidad'];
       $a = "'col_col'";
       $b = "'col_med'";
       $c = "'col_can'";
       $d = "'col_pre'";
       $u = "'col_und'";
       $col="'".$row['color']."'";
       $med="'".$row['medida']."'";
       $und="'".$row['undmed']."'";
       $can="'".$row['cantidad']."'";
       $pre="'".$row['precio']."'";
       if($row['mod_use']==''){
       $mod = '';
       }else{
       $mod='Modificado por '.$row['mod_use'].' el '.$row['mod_fec'];
       }
       $query = mysqli_query($con, "select referencia from productos_var where codigo='".$row['codigo']."' ");
       $r = mysqli_fetch_array($query);
       

    echo '<tr title="'.$mod.'">'.
	'<td>'.$row['codigo'].'</td>'.
        '<td>'.$r['referencia'].'</td>'.
	'<td>'.$row['descripcion'].'</td>'.
	'<td id="col_col'.$row['id_oc_de'].'" ondblclick="editar('.$row['id_oc_de'].','.$a.','.$col.')">'.$row['color'].'</td>'.
	'<td id="col_med'.$row['id_oc_de'].'" ondblclick="editar('.$row['id_oc_de'].','.$b.','.$med.')">'.$row['medida'].'</td>'.
        '<td id="col_can'.$row['id_oc_de'].'" ondblclick="editar('.$row['id_oc_de'].','.$c.','.$can.')">'.$row['cantidad'].' </td>'.
        '<td id="col_und'.$row['id_oc_de'].'" ondblclick="editar('.$row['id_oc_de'].','.$u.','.$und.')">'.$row['undmed'].'</td>'.
	'<td id="col_pre'.$row['id_oc_de'].'" ondblclick="editar('.$row['id_oc_de'].','.$d.','.$pre.')">$ '.number_format($row['precio'],2).'</td>'
          . '<td>$ '.  number_format(($row['precio']*$row['cantidad']),2).'</td>'
          . '<td><button onclick="delitemorden('.$row['id_oc_de'].','.$row['solicitud'].','.$row['codigo_orden'].')">Borrar</button></td>'.
	'</tr>';
   }
   echo '<tr><td colspan="8"></td><td>$ '.number_format($total,2).'</td>'; 
}
?>
