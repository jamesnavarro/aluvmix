<?php
include('../../../../modelo/conexion.php');
   $id = $_GET['id'];
  $sis = $_GET['sis'];
  $resultado = mysqli_query($con,"select espesor from espesores where espesor='$sis' ");
  $r = mysqli_fetch_array($resultado);
  if(!$r){
      if($id==''){

          mysqli_query($con,"insert into espesores (espesor) values ('$sis')");
          echo 'Se agrego con exito';
      }else{

          mysqli_query($con,"update espesores set espesor='$sis' where id_espesor= '$id' ");
          echo 'Se edito con exito';

      }
  }else{
      echo 'Ya existe este items';
  }
