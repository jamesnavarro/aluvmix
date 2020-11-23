<?php
include '../../../modelo/conexioni.php';
session_start();
$emp = $_SESSION['id_user'].date("YmdHis");

$foto = $emp.$_FILES["foto"]["name"];
$ver = move_uploaded_file($_FILES['foto']['tmp_name'], '/var/www/html/laboratorio/aluvmix/vistas/archivos/'.$foto);
//if( $ver ) {
//  echo "Successfully uploaded";         
//} else {
//  echo "Not uploaded";
//}
echo $foto;
//

