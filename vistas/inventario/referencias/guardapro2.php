<?php
 require_once '../../../modelo/conexioni.php';
 session_start();
 if(isset($_POST['codx'])){
     $cod= $_POST['codx'];
      $query = mysqli_query($con," Select count(codigo) from `productos_var` where codigo='$cod' ");
      $s= mysqli_fetch_array($query);
      if($s[0]=='0'){
          $sql=mysqli_query($con,"INSERT INTO `productos_var`(`codigo`, `descripcion`, `referencia`, `tipo_articulo`, `color`, `ancho`, `alto`, `espesor`, `area`, `peso`, `observaciones`,`estado_cr`,`usuario`, `cod_empresa`, `stock_max`, `stock_min`, `stock_seg`, `clase`, `grupo`, `aplicaiva`, `iva`, `costo_promedio`, `unidad`) VALUES ('".$_POST['codx']."','".$_POST['nomx']."','".$_POST['refx']."','".$_POST['artx']."','".$_POST['colx']."','".$_POST['anchox']."','".$_POST['altox']."','".$_POST['espx']."','".$_POST['arex']."','".$_POST['pesx']."','".$_POST['obsx']."','1','".$_POST['userx']."','".$_POST['empresax']."','".$_POST['stc_max']."','".$_POST['stc_min']."','".$_POST['stc_seg']."','".$_POST['clax']."','".$_POST['grux']."','".$_POST['ivax']."','".$_POST['porivx']."','".$_POST['costo']."','".$_POST['und_x']."')");
	$error = mysqli_error($con);
      }else{
          $sql=mysqli_query($con,"UPDATE `productos_var` SET `descripcion`='".$_POST['nomx']."',`tipo_articulo`='".$_POST['artx']."',`observaciones`='".$_POST['obsx']."',`cod_empresa`='".$_SESSION['empresax']."',`usuario`='".$_SESSION['userx']."',`ancho`='".$_POST['anc']."',`espesor`='".$_POST['espx']."',`alto`='".$_POST['altox']."',`color`='".$_POST['colx']."',`area`='".$_POST['arex']."',`peso`='".$_POST['pesx']."',`stock_max`='".$_POST['stc_max']."', `stock_min`='".$_POST['stc_min']."', `stock_seg`='".$_POST['stc_seg']."', `clase`='".$_POST['clax']."', `grupo`='".$_POST['grux']."', `aplicaiva`='".$_POST['ivax']."', `iva`='".$_POST['porivx']."', `costo_promedio`='".$_POST['costo']."', `unidad`='".$_POST['und_x']."', `referencia`='".$_POST['refx']."' WHERE codigo='".$_POST['codx']."'");
          $error = mysqli_error($con);
      }
  
        if($sql){
	 	$data = array("sucess" => '1',"result" => $error);
	        echo json_encode($data);
	 }else{
	        $data = array("sucess" => '0',"result"=>$error);
	        echo json_encode($data);
	 }
 }
if(isset($_POST['sub'])){
    
	date_default_timezone_set("America/Bogota" ) ; 
	$hora = date('H:i:s',time() - 3600*date('I'));
	$fecha_hoy = date("Y-m-d").' '.$hora;
 	$sql=mysqli_query($con,"UPDATE `productos_var` SET `codigo`='".$_POST['cod']."',`descripcion`='".$_POST['des']."',`tipo_articulo`='".$_POST['tip']."',`observaciones`='".$_POST['obs']."',`cod_empresa`='".$_SESSION['empresa']."',`usuario`='".$_SESSION['k_username']."',`fecha_mod`='".$fecha_hoy."',`ancho`='".$_POST['anc']."',`espesor`='".$_POST['esp']."',`alto`='".$_POST['alt']."',`color`='".$_POST['col']."',`area`='".$_POST['are']."',`peso`='".$_POST['pes']."', `costo_promedio`='".$_POST['costo']."', `stock_max`='".$_POST['stc_max']."', `stock_min`='".$_POST['stc_min']."', `stock_seg`='".$_POST['stc_seg']."',`clase`='".$_POST['clas']."',`grupo`='".$_POST['grup']."',`aplicaiva`='".$_POST['ivae']."',`iva`='".$_POST['poriv']."',`unidad`='".$_POST['unxd']."' WHERE codigo='".$_POST['sub']."'");

	 if($sql){
	 	$data = array("sucess" => '1');
	        echo json_encode($data);
	 }else{
	 		$data = array("sucess" => '0');
	        echo json_encode($data);
	 }
 }
?>
