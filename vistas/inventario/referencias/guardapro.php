<?php
 require_once '../../../modelo/conexioni.php';
if(isset($_POST['salvar'])){
	 $sql=mysqli_query($con,"INSERT INTO `productos`(`pro_referencia`, `pro_nombre`, `pro_undmed`, `clase`, `grupo`, `linea`, `sistema`, `pro_estado`, `usuario`,`cod_empresa`) VALUES ('".$_POST['ref']."','".$_POST['nom']."','".$_POST['und']."','".$_POST['clas']."','".$_POST['grup']."','".$_POST['lin']."','".$_POST['sistema']."','0','".$_POST['user']."','Empresa')");
 if($sql){
 	$data = array("sucess" => '1');
        echo json_encode($data);
 }else{
 		$data = array("sucess" => '0');
        echo json_encode($data);
 }
}
 
if(isset($_POST['editar'])){
	 $sql=mysqli_query($con,"UPDATE `productos` SET `pro_nombre`='".$_POST['nom']."', `pro_undmed`='".$_POST['und']."', `clase`='".$_POST['clas']."', `grupo`='".$_POST['grup']."', `linea`='".$_POST['lin']."', `pro_estado`='1', `usuario`='".$_POST['user']."',`cod_empresa`='Empresa', `sistema`='".$_POST['sistema']."' WHERE pro_referencia='".$_POST['ref']."'");
 if($sql){
 	$data = array("sucess" => '1');
        echo json_encode($data);
 }else{
 		$data = array("sucess" => '0');
        echo json_encode($data);
 }
} 

if(isset($_POST['dado'])){
	 $sql=mysqli_query($con,"INSERT INTO `proveedores_productos`(`cod_ter`, `pro_referencia`, `dado_prod_provee`) VALUES ('".$_POST['prove']."','".$_POST['ref']."','".$_POST['valor']."')");
 if($sql){
 	$data = array("sucess" => '1');
        echo json_encode($data);
 }else{
 		$data = array("sucess" => '0');
        echo json_encode($data);
 }
} 
?>