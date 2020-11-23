<?php
include '../../../modelo/conexioni.php';
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Parametros de Costos</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <link href="../../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
                     <script src="funciones.js?v=1.0"></script>

    </head>
    <body onload="mostrar_mo()">
        <div class="page-content">
            <div>
                Puesto de Tabajo: <input type="text" id="puesto"  disabled value="<?php echo $_GET['id']; ?>"> 
                <button onclick="window.close()">Cerrar</button> <span id="msg"></span><br>
               
            </div>
           
            <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12">
           
  
                <div class="datagrid">
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>Cedula <button onclick="usuario();">+</button></th>
                                        <th>Nombre del empleado</th>
                                        <th>Cargo</th>
                                        <th>Mano de Obra</th>
                                        <th>Sede</th>
                                        <th>Porcentaje</th>
                                        <th>Salario</th>
                                        <th>Valor</th>
                                        <th>Opcion</th>
                                       </tr>
                                       <tr>
                                        <td><input type="text" id="cedula" value="" style="width: 90px"></td>
                                        <td><input type="text" id="nombre" value="" style="width: 100%" disabled></td>
                                        <td><input type="text" id="cargo" value="" style="width: 100px"></td>
                                        <td><select id="mano" >
                                                <option value="">Mano de Obra</option>
                                                <option value="DIRECTA">DIRECTA</option>
                                                <option value="INDIRECTA">INDIRECTA</option>
                                            </select></td>
                                        <td><input type="text" id="cp" value="<?php echo $_GET['cp']; ?>" style="width: 50px" disabled></td>
                                        <td><input type="text" id="por" value="" style="width: 50px">%</td>
                                        <td><input type="text" id="salario" value="" style="width: 50px" disabled></td>
                                        <td><input type="text" id="valor" value="" style="width: 50px" disabled></td>
                                        <td><button id="agregar" onclick="agregar_por_mo()">+</button></td>
                                       </tr>
                                       
                            </thead>
                        <tbody id="mostrar_mo">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>
        <script src="../../assets/js/jquery-2.1.4.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>

	
    </body>
</html>

