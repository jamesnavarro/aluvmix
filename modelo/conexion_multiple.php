<?php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', 'T3mpl@d02o2o*');
define('DB_NAME', 'virtuald_templadosa'); 

    $con_duos=@mysqli_connect(DB_HOST, DB_USER, DB_PASS);
    if(!$con_duos){
        die("imposible conectarse: ".mysqli_error($con_duos));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>