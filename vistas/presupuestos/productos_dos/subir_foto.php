<?php
include('../../../modelo/conexioni.php');
$sobre = $_GET['idp'];
$foto = date("YmdHis").'-'.$_FILES["foto"]["name"];
echo $ingresar = mysqli_query($con,"update producto set ruta='$foto' where codigo='$sobre' ");
move_uploaded_file($_FILES['foto']['tmp_name'], '../../../producto/'.$foto);