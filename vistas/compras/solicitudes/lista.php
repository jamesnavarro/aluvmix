<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $sql=mysqli_query($con,"SELECT * FROM solicitudes_item WHERE id_sol=0");
   while($row=mysqli_fetch_array($sql)){
    echo '<tr>'.
		 '<td style="color: blue;"><b>'.$row['codigo'].'</td>'.
		 '<td style="color: red;"><b>'.$row['descripcion'].'</td>'.
		 '<td>'.$row['medida'].'</td>'.
		 '<td>'.$row['color'].'</td>'.
		 '<td>'.$row['cantidad'].'</td>'.
		 '<td>'.$row['date_added'].'</td>'.
		 '</tr>';
   }
}else {
   echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
}
   
   ?>
