<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
    <title>Reprogramar actividad</title>
                 <link rel="stylesheet" href="../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../../js/jquery.min.js"></script>
        <script src="../../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
        <script src="funciones.js"></script>
    </head>
    <body>
        <center>
            <legend><b>Reprogramar Notificacion</b></legend>
        <table>
            <tr>
                <td>Fecha de Programacion</td>
                <td><input name="remitosucursal" id="fec_ini" type="date" required class="form-control"></td>
            </tr><tr></tr><tr></tr>
            <tr>
                <td>Hora</td>
                <td> <input name="remitonumero" id="hra" type="time" required class="form-control"></td>
            </tr>
        </table><br>
        <button class="btn btn-primary" onclick="add_reprogramar(<?php echo $_GET['id']; ?>)">Listo</button>
        <button class="btn btn-danger"  onclick="window.close()">Cerrar </button>
        </center>
    </body>
</html>
