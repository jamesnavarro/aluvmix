<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="../../js/jquery.min.js"></script>
        <script src="function.js?<?php echo rand(1,100) ?>"></script>
    </head>
    <body>
        <button onclick="prueba()">ok</button>
        <div id="" style="text-align: center; width: 900px">
            
        <div id="" style="float: left">
        <table>
            <tr>
                <td>Ancho</td>
                <td><input type="text" id="ancho"></td>
       
            </tr>
            <tr>
                <td>Alto</td>
                <td><input type="text" id="alto"></td>
              
            </tr>
            <tr>
                <td>Alto Cuerpo fijo Sup</td>
                <td><input type="text" id="altocfs"></td>
              
            </tr>
            <tr>
                <td>Alto Cuerpo fijo Inf</td>
                <td><input type="text" id="altocfi"></td>
              
            </tr>
            <tr>
                <td>Ancho cuerpo fijo der</td>
                <td><input type="text" id="anchocfd"></td>
              
            </tr>
            <tr>
                <td>Ancho cuerpo fijo izq</td>
                <td><input type="text" id="anchocfi"></td>
              
            </tr>
        </table>
            </div>
        <div id="diseno" style="float: right">
            <table style="width: 400px" border="1">
<!--                        <tr style="height: 100px">
                            <td rowspan="3">cf izq</td>
                            <td colspan="2">cf sup</td>
                            <td rowspan="3">cf der</td>
                        </tr>-->
                        <tr style="height: 200px">
                            <td>der</td>
                            <td>izq</td>
                        </tr>
<!--                        <tr style="height: 100px">
                            <td colspan="2">cf inf</td>
                            
                        </tr>-->
                    </table>
        </div>
            </div>
    </body>
</html>
