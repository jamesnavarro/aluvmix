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
                     <script src="funciones.js"></script>

    </head>
    <body onload="mostrar_cif(<?php echo $_GET['id'] ?>)">
        <div class="page-content">
           
            <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12">
           
  
                <div class="datagrid">
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
<!--                                        <th>Cedula <button onclick="usuario();">+</button></th>-->
                                        <th>ID</th>
                                        <th>DESCRIPCION</th>
                                        <th>FECHA</th>
                                        <th nowrap>VALOR TOTAL</th>
                                       </tr>
                                   
                                       
                            </thead>
                        <tbody id="mostrar_cif">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>
        <script src="../../assets/js/jquery-2.1.4.min.js"></script>
		<script src="../../assets/js/bootstrap.min.js"></script>

	
    </body>
</html>

