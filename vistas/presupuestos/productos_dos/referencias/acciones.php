<?php
include('../../../../modelo/conexion.php');

 $ids = $_GET['id'];
  $sis = $_GET['sis'];
  //validar codigo si existe en la base de datos
  $resultado = mysqli_query($con,"select id_sistema from sistemas where nombre_sistema='$sis' ");
  $r = mysqli_fetch_array($resultado);
  
  if(!$r[0]){
      
      mysqli_query($con,"insert into sistemas (nombre_sistema) values ('$sis')");
      echo 'Se agrego con exito';
  }else{
      
      mysqli_query($con,"update sistemas set nombre_sistema='$sis' where id_sistema= '$r[0]' ");
      echo 'Se edito con exito';
      
  }
