<?php
include('../../../../modelo/conexioni.php');
session_start();
  $refdt = $_GET['refdt'];
  $ref = $_GET['ref'];
  $par = $_GET['par'];
  if($par=='tipo_alfa'){
      $mod='Alfajia';
  }else{
      $mod='Rieles';
  }

  $usuario=$_SESSION['k_username'];
  //echo 'ref:'.$ref.', cod:'.$cod.', par:'.$par.'&sel:'.$sel;
    $ver = mysqli_query($con,"select count(*) from producto_perfiles where codigo='$refdt' and referencia='$ref' and modulo='$mod' ");
    $v = mysqli_fetch_row($ver);
  
  if($v[0]==0){
      
      $ver2 = mysqli_query($con,"select pro_nombre from productos where  pro_referencia='$ref'  ");
      $f = mysqli_fetch_row($ver2);
      $desopc = $f[0];
         mysqli_query($con,"INSERT INTO `producto_perfiles` (`perfiles`,`modulo`,`name_opc`, `codigo`, `referencia`, `desc_referencia`, `formula`, `lado`, `lado_ref`, `ope1`, `var1`, `ope2`, `var2`, `cantidad`, `medidas`, `piezas`, `cadav`, `cadah`)"
                    . " VALUES ('Dinamico', '$mod','$desopc', '$refdt', '$ref', '$desopc', 'Si', 'Ancho', 'ancho', '-', '0', '-', '0', '1', '1', 'No', '0', '0');");
          echo 'Se agrego con exito';
  }else{
          echo 'Ya existe esta referencia en la dt';
  }

