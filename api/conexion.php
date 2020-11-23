<?php
//$conw=@mysqli_connect('templadosa.com.co', 'templa', '20031123003', 'embudo');
$conw=@mysqli_connect('softmediko.com', 'softmed1_templa', 'Jnavarro32', 'softmed1_templado');
    if(!$conw){
        die("imposible conectarse a la web: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }

?>
