<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $sql=mysqli_query($con,"SELECT * FROM solicitudes_item WHERE solicitud='".$_POST['ref']."' LIMIT 1");
   if($row=mysqli_fetch_assoc($sql)){
   	$data = array("sucess" => '1',"cod" =>$row["codigo"],"nom" =>$row["descripcion"],"col" =>$row["color"],"med" =>$row["medida"],"cant" =>$row["cantidad"],"pre" =>$row["precio"],"undmed" =>$row["undmed"],"obs_item" =>$row["observacion"]);
        echo json_encode($data);
   }else{
   	$data = array("sucess" => '0');
        echo json_encode($data);
   }
 }else {
      echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
}
   
?>
