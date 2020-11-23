<?php
include '../../../../modelo/conexioni.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
        <title>Sistemas</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <link href="../../../../css/estilo.css" rel="stylesheet">
                <link href="../../../../css/bootstrap.min.css" rel="stylesheet">
                <script src="../../../../js/jquery.min.js"></script>
                <script src="funciones.js"></script>

    </head>
    <body>
        <div class="page-content">
            <div>
                <button onclick="adicionar_item()" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Agregar Sistemas</button> <button onclick="window.close()">Cerrar</button>
            </div>
           
            <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12">
           
  
                <div class="datagrid">
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                           <th>Items</th>
                                           <th>Descripcion</th>
                                       </tr>
                                       <tr>
                                           <td>
                                               <input type="text" id="ids" style="width:100%" onchange="mostrar(1)" disabled> 
                                           </td>
                                           <td>
                                              <input type="text" id="nombrex" style="width:100%" onchange="mostrar(1)"> 
                                           </td>
                                       </tr>
                            </thead>
                        <tbody id="mostrar_tabla">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>
        
    </body>
</html>
