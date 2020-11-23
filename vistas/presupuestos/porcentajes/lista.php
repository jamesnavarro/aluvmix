<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
 ?>            
<div class="table-responsive"> 
     <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
   <table class="table table-hover">
    <tr class="bg-info">
        <th>ITEMS</th>
        <th>LINEAS</th>
        <th>% DESPERDICIO</th> 
        <th>% VENTA</th> 
        <th>EDITAR</th> 
    </tr>
 <?php 
$query = mysqli_query($con,"SELECT * FROM porcentajes");

  while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
       
        . '<td>'.$fila['id_por'].'</td>'
        . '<td>'.$fila["nombre"].'</td>'
        . '<td>'.$fila['porc_desp'].'%</td>'
        . '<td>'.$fila['porc_venta'].'%</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_por'].')" > <img src="../imagenes/modificar.png"></button></a></td>';
 
  }
?>
</table>
 </div>
</div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
