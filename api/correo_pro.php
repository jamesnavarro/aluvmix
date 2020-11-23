<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando Email de Orden Compra</title>
    </head>
    <body>
        <img src="enviar.gif" width="150px">
    </body>
</html>
<?php
include 'conector.php';

$result = mysqli_query($con,"select * from ordenes where id_orden='".$_GET['orden']."' ");
$r = mysqli_fetch_array($result);
echo $r[0];

                $para = $r[4];
                $mensaje = $r[1];
                $titulo = 'Templado S.A.S Orden de Compras No.'.$_GET['orden'];

                // Cabecera que especifica que es un HMTL
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Cabeceras adicionales
                $cabeceras .= 'From: compras@templadosa.com' . "\r\n";
                $cabeceras .= 'Cc: jamesnavarroblanco@gmail.com' . "\r\n";

                mail($para, $titulo, $mensaje, $cabeceras);
                echo '<script>window.close()</script>';
