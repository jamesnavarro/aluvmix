<?php
include 'conexioni.php';
include 'conexion_fom.php';
session_start();
$empresa = $_SESSION['empresa'];
$usuario = $_SESSION['k_username'];
$result = sqlsrv_query($conn, "SELECT * FROM MAESEC ");
while ($row = sqlsrv_fetch_array($result)){
    
     $color = utf8_encode($row[1]);
     $dateFromDB = $row[7];

    $fecha = date_format($dateFromDB, 'Y-m-d H:i:s');
    $fecham = date_format($row[8], 'Y-m-d H:i:s');

//  $ver = mysqli_query($con, "insert into centrocostos (cen_codigo,cen_nombre,cen_nomrem,cen_activo,cen_equipo,cod_empresa,usuario,cen_fechareg,cen_fechamod) "
//            . "values ('$row[0]','$color','$row[2]','$row[3]','$row[4]','$empresa','$usuario','$fecha','$fecham')");
    echo mysqli_error($con);
}
