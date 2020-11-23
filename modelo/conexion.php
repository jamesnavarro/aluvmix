<?php
//$servidorbd = "webtemplado.com";
//$usuarioBaseDatos = "webtem5_templado";
//$claveBaseDatos = "20031123003";
//$baseDatos = "webtem5_aluvmix"; ace-icon fa fa-cog bigger-130
//define('DB_HOST', 'localhost');
//define('DB_USER', 'root');
//define('DB_PASS', 'T3mpl@d02o2o*');
//define('DB_NAME', 'aluvmixv2');
//
//    $con=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    
$servidorbd = "localhost";
$usuarioBaseDatos = "root";
$claveBaseDatos = "T3mpl@d02o2o*"; 
$baseDatos = "virtuald_templadosa";

$conexion = @mysqli_connect($servidorbd,$usuarioBaseDatos,$claveBaseDatos,$baseDatos);

if (!$conexion)
die('No se Puede Conectar: ' . mysqli_error($conexion));

date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
?>