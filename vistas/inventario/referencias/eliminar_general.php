<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   if(isset($_POST['deldado']) and $_POST['deldado']!=0 and $_POST['deldado']!=''){
	   	$execute=mysqli_query($con, "DELETE FROM proveedores_productos WHERE id_pro_prduc='".$_POST['deldado']."'");
	   	if($execute){
	   		$data = array("sucess" => '1');
	        echo json_encode($data);
		 }else{
		 		$data = array("sucess" => '0');
		        echo json_encode($data);
		 }
    }
}else {
   
      echo 'error';
    
}  
?>
