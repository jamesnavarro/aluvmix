<?php
include('../../../../modelo/conexioni.php');

 $ids = $_GET['id'];
  $sis = $_GET['sis'];
   $hoja = $_GET['hoja'];
  //validar codigo si existe en la base de datos

  if($ids==''){
      
      $res = mysqli_query($con,"insert into hojas (hoja, descripcion) values ('$hoja','$sis')");
      echo 'Se agrego con exito'.$res;
  }else{
      
      mysqli_query($con,"update hojas set descripcion='$sis' where id_hoja= '$ids' ");
      echo 'Se edito con exito';
      
  }
