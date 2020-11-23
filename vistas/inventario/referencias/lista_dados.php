<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $sql=mysqli_query($con,"SELECT * FROM proveedores_productos WHERE pro_referencia='".$_POST['ref']."'");
   while($fila=mysqli_fetch_array($sql)){
   $send=$fila['id_pro_prduc'].','."'".trim($fila['pro_referencia'])."'";
   	    echo '<tr>'
        . '<td>'.$fila['pro_referencia'].'</td>'
        . '<td>'.$fila['cod_ter'].'</td>'
        . '<td>'.$fila['dado_prod_provee'].'</td>'
	. '<td><button onclick="eliminar_dado('.$send.');">Eliminar</button></td>'
        . '</tr>';
   }
}else {
   
      echo 'error';
    
}  
?>
