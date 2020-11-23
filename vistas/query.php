<?php 
include '../modelo/conexioni.php';
session_start();
if(!isset($_SESSION['k_username'])){
     header("location:../index.php");    
}

$sql=mysqli_query($con, "SELECT costo_ult_com, codigo FROM productos_var");
while ($execute=mysqli_fetch_assoc($sql)) {
	mysqli_query($con,"UPDATE productos_var SET costo_promedio='".$execute['costo_ult_com']."' WHERE codigo='".$execute['codigo']."'");
}

?>

