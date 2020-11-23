<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $userid = $_SESSION["id_user"];
   $sql=mysqli_query($con,"SELECT * FROM solicitudes_item WHERE id_sol=0 and user_id='$userid' ");
   $c=0;
   $total =0;
   while($row=mysqli_fetch_array($sql)){
       $c++;
       $total +=$row['precio']*$row['cantidad'];
       echo '<tr>'.
		 '<td style="color: blue;"><b>'.$row['codigo'].'</td>'.
		 '<td style="color: red;"><b>'.$row['descripcion'].'</td>'.
		 '<td>'.$row['medida'].'</td>'.
		 '<td>'.$row['color'].'</td>'.
		 '<td>'.$row['cantidad'].' '.$row['undmed'].'</td>'.
                 '<td style="text-align:right">$'.number_format($row['precio'],2).'</td>'.
                 '<td style="text-align:right">$'.number_format($row['precio']*$row['cantidad'],2).'</td>'.
		 '<td>'.$row['observacion'].'</td>'.
		 '<td>&nbsp;<span onclick="previusedit('.$row['solicitud'].')" class="glyphicon glyphicon-pencil"></span>&nbsp; &nbsp;<span onclick="eliminar_items('.$row['solicitud'].')" class="glyphicon glyphicon-trash"></span></td>'.
		 '</tr>';
   }
   if($c>0){
      echo '<tr><td colspan="6"><button type="button" class="btn btn-danger" id="save" onclick="generar();"><span class="glyphicon glyphicon-save"></span> Generar Solicitud</button></td>'
         . '<td style="text-align:right">$ '.number_format($total,2).'</td><td colspan="2"></td>';
   }
}
?>
