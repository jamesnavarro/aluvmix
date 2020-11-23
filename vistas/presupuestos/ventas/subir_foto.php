<?php
include '../../../modelo/conexioni.php';
$sobre = $_GET['tso'];
$foto = $sobre.'-'.$_FILES["foto"]["name"];
$ingresar = mysqli_query($con,"update cotizacion_item set ruta='$foto' where id_cot_item='$sobre' ");
move_uploaded_file($_FILES['foto']['tmp_name'], '../../../archivos/'.$foto);

echo $ingresar;