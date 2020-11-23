<?php
include '../../../../modelo/conexioni.php';
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
        <title>Listado de referencias</title>
        <meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <link href="../../../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../../js/jquery.min.js"></script>
                <script src="../../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../../js/sweetalert.css">
                <script src="funciones.js?<?php echo rand(1,100) ?>"></script>

    </head>
    <body>
        <div class="page-content">
            <div>
               
                <button onclick="window.close()">Cerrar</button>
                <input type="text" id="parametro" value="<?php echo $_GET['parametro'] ?>" disabled> | Referencia 
                <input type="text" id="codigo" value="<?php echo $_GET['cod'] ?>" disabled>
            </div>
           
            <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12">
           
  
                <div class="datagrid">
                    <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                           <th>CODIGO</th>
                                           <th>DESCRIPCION REFERENCIA</th>
                                           <th>COLOR</th>
                                           <th>UNID MEDIDA</th>
                                           <th> AGREGAR M<sup>2</sup></th>
                                       </tr>
                                       <tr>
                                           <td>
                                               <input type="text" id="idxs" style="width:100%" onchange="mostrar(1)" disabled> 
                                           </td>
                                           <td>
                                              <input type="text" id="nombrex" style="width:100%" onchange="mostrar(1)"> 
                                           </td>
                                           <td></td>
                                           <td></td>
                                           <td></td>
                                        
                                       </tr>
                            </thead>
                        <tbody id="mostrar_tabla">
                            
                        </tbody>
                    </table>
                         
                </div>
                
            </div>
            
        </div>
        <script src="../../../assets/js/jquery-2.1.4.min.js"></script>
		<script src="../../../assets/js/bootstrap.min.js"></script>

	
    </body>
</html>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Item</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table>
              <tr>
                  <td>Id</td>
                  <td><input type="text" id="ids" disabled></td>
              </tr>
              <tr>
                  <td>Sistema</td>
                  <td><input type="text" id="sistema"></td>
              </tr>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-danger" onclick="limpiar_cajas()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="add_sistema()">Guardar</button>
      </div>
    </div>
  </div>
</div>
