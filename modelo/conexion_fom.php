<?php
$serverName = "SRVTEMPLADO";
$connectionOptions = array("Database" => "TEMPLADOS","Uid" => "templado","PWD" => "Sistema0");
//Establecimiento de la ConexiÃ³n
$conn = sqlsrv_connect( $serverName, $connectionOptions );
if( $conn )
{
    
}else{
     echo "ConexiÃ³n no se pudo establecer.<br />";
     die( print_r( sqlsrv_errors(), true));
}

