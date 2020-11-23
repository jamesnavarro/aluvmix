<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Enviando Email de solicitud</title>
    </head>
    <body>
        <img src="enviar.gif" width="150px">
    </body>
</html>
<?php
$maximo = $_GET['sol'];
$area = $_GET['area'];
$nota = $_GET['nota'];
$tipo = $_GET['tipo'];
$numero = $_GET['numero'];
$fecha = $_GET['fecha'];
if(isset($_GET['sol'])){
$para = 'jamesnavarroblanco@gmail.com';
                 $mensaje = 'Se ha generado la Solicitud. No'.$maximo.'<br>Solicitado por el area de '.$area.'. <BR>'
                         . 'relacionado con '.$tipo.' No. '.$numero.'<br> Solicitado para el: '.$fecha.''
                         . '<br> Nota:'.$nota.'<br> Verifica la solicitud en el sistema Aluvmix';
                $titulo = 'Nueva Solicitud de compras No.'.$maximo;

                // Cabecera que especifica que es un HMTL
                $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
                $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                // Cabeceras adicionales
                $cabeceras .= 'From: notificacionaluvmix@gmail.com' . "\r\n";
                $cabeceras .= 'Cc: jamesjnb@hotmail.com' . "\r\n";

                mail($para, $titulo, $mensaje, $cabeceras);
                echo '<script>window.close()</script>';
}