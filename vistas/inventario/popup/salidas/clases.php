<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Material </title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../salidas/documentos/funciones.js?<?php echo rand(100,200) ?>"></script>
      
</head>
<body>
    <div>
        <h3>Materiales para Entregar</h3>
    </div>

    Buscar:<input type="text" id="buscar_empleado" autofocus placeholder=""> 
    <input type="text" id="tipoorden"  placeholder="" style="width: 15px" disabled><input type="text" id="idop"  placeholder="" style="width: 80px" disabled>
    <select id="tipo" style="width: 120px">
        <option value="Perfileria">Perfileria</option>
        <option value="Accesorios">Accesorios</option>
        <option value="Vidrios">Vidrios</option>
        <option value="ORDEN">Perfiles Por Orden</option>
        <option value="ORDENACC">Accesorios Por Orden</option>
    </select> Bodega: <input type="text" id="bod"  value="" style="width: 120px" >
    |
    <button onclick="verop()">Ver detalle de la orden</button>
    <br>
<div class="datagrid" id="usuarios">
     
       </div>     
</body>
</html>
<div class="modal fade" id="inventario_sal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Actualizacion de stock por ubicacion</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                    relacion:<input type="text" id="idre" disabled>
                    <table class="table table-hover">
                        <tr>
                           
                            <th>DESCRIPCION</th>
                            <th>UBICACION</th>
                            <th>CANTIDAD</th>
                            <th>OPCIONES</th>
                        </tr>
                        <tbody id="mostrar_cantidad">
                            
                        </tbody>
                    </table>
                    <hr><br><br>
<!--                  <table class="table table-hover">
                    <tr class="bg-info">
                        <th>CODIGO(PRO)</th> 
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                    </tr>
                   <tbody id="mostrar_ubi_pro_sal">
                   </tbody>
            </table>-->
             
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
                </div>
              </div>
          </div>
      </div>

         

                              
                                