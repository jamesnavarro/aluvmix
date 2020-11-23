<?php
include('../../../modelo/conexioni.php');

session_start();
$consecutivo = $_GET['consecutivo'];
$idcontra = $_GET['idcontra'];
$tipo_doc = $_GET['tipo_doc'];
$sugeren = $_GET['sugeren'];
$regis_arc = $_GET['regis_arc'];
if($_FILES["archivo"]["name"]!=''){
    $foto = $_FILES["archivo"]["name"];
}else{
    $foto ='';
}

if($consecutivo==''){
     $ingresar = mysqli_query($con,"insert into archivos_obras (id_contrato,tipo_documento,sugerencias,archivo,registr_arc_por) values('$idcontra','$tipo_doc','$sugeren','$foto','".$_SESSION['k_username']."')");
     move_uploaded_file($_FILES['archivo']['tmp_name'], '../../../archivos/'.$foto);
     $ver = mysqli_query($con,"select max(id_arc) from archivos_obras");
     $v = mysqli_fetch_row($ver);
     //muestra es el id del ultimo que se inserto en la tabla archivo
     echo $v[0];
}else{
    
    mysqli_query($con,"update archivos_obras set tipo_documento='$tipo_doc' ,sugerencias='$sugeren' where id_arc='$consecutivo' ");
   //lo que muestra es el id del la tabla archivos
    echo $consecutivo;
    
}
 
