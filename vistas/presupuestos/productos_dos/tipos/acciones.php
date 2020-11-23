<?php
include('../../../../modelo/conexion.php');

 $ids = $_GET['id'];
  $sis = $_GET['sis'];
  $resultado = mysqli_query($con,"select id_tipo from tipos where tipo='$sis' ");
  $r = mysqli_fetch_array($resultado);
  
  if(!$r[0]){
      mysqli_query($con,"insert into tipos (tipo) values ('$sis')");
      echo 'Se agrego con exito';
  }else{
      
      mysqli_query($con,"update tipos set tipo='$sis' where id_tipo= '$r[0]' ");
      echo 'Se edito con exito';
      
  }
