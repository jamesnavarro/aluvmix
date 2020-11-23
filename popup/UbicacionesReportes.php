<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Referencias</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<script src="../js/myjava.js"></script>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../popup/reporte_ubicaciones_1/funciones.js"></script>
<script language="javascript" type="text/javascript">
function pasar2(cod,nom){
   window.opener.pasar_bodega(cod,nom);
   window.close();
}
</script>       
</head>
<body>
    <div>
        <h3>Lista de referencia por ubicacion</h3>
    </div>
<div class="datagrid">
    <input type="hidden" style="width: 100%" id="idr" disabled value="0">
    <input type="hidden" style="width: 100%" id="est" disabled value="0">
    <input type="hidden" style="width: 100%" id="bod" disabled value="0">
    <input type="hidden" style="width: 100%" id="carga" disabled value="SALIDA">
    <span id="rep1"></span> <span id="rep2"></span>
<table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 70px">Codigo</th>
                                        <th style="width: 350px">Descripcion</th>
                                        <th>Referencia</th>
                                        <th style="width: 190px">Color</th>
                                        <th>Medida</th>
                                        <th>Sede</th>
                                        <th>Stock General</th>
                                        <th>Stock Ubi</th>
                                        <th>Columna</th>
                                        <th>Ubic. Origen</th>
                                    </tr>
                                </thead>
                                <tr>
                                    <td><input type="text" style="width: 100%" id="cod"></td>
                                    <td><input type="text" style="width: 100%" id="des"></td>
                                    <td><input type="text" style="width: 100%" id="ref"></td>
                                    <td><input type="text" style="width: 100%" id="col"></td>
                                    <td><input type="text" style="width: 100%" id="med"></td>
                                    <td><input type="text" style="width: 100%" id="lin"></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="text" style="width: 100%" id="colu"></td>
                                    <td><input type="text" style="width: 100%" id="ubi"></td>            
                                </tr>
                                <tbody id="usuarios">
                                </tbody>
</table>                                    

     
       </div>       
</body>
</html>

         

                              
                                