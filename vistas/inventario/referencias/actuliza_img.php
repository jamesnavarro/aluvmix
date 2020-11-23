<?php
require_once '../../../modelo/conexioni.php';
if(isset($_POST['prod'])){
	$sql=mysqli_query($con,"UPDATE productos SET ruta_img='".$_POST['ruta']."' WHERE pro_referencia='".$_POST['ref']."'");
	$data = array("sucess" => '1');
	echo json_encode($data);
}else{
	$data = array("sucess" => '0');
	echo json_encode($data);
}
?>