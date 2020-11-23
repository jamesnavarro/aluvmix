<?php
include('../../../../modelo/conexion.php');
session_start();
  $ref = $_GET['ref'];
  $cod = $_GET['cod'];
  $par = $_GET['par'];
  $sel = $_GET['sel'];
  $can = $_GET['can'];
  $usuario=$_SESSION['k_username'];
  //echo 'ref:'.$ref.', cod:'.$cod.', par:'.$par.'&sel:'.$sel;
    $ver = mysqli_query($con,"select count(*) from productos_parametros where codigo_pro='$cod' and codigo_ref='$ref' and parametro='$par' ");
    $v = mysqli_fetch_row($ver);
  
  if($v[0]==0){
           mysqli_query($con,"insert into productos_parametros (codigo_pro,codigo_ref,parametro,estado_par,usuario,cantidad) "
                   . "values ('$cod','$ref','$par','1','$usuario','$can')");
          echo 'Se agrego con exito';
  }else{
      if($sel=='0'){
          $c = 1;
      }else{
          $c = 0;
      }
            mysqli_query($con,"update productos_parametros set estado_par='$c',cantidad='$can' where  codigo_pro='$cod' and codigo_ref='$ref' and parametro='$par' ");
            echo 'Se edito con exito';
  }

