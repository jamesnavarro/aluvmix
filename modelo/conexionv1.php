<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'virtuald_templad');
define('DB_PASS', '20031123003');
define('DB_NAME', 'virtuald_templadosa'); 

    $con2=@mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if(!$con2){
        die("imposible conectarse: ".mysqli_error($con2));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>