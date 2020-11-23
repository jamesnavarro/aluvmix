<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Vendedores
    </title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../vendedores/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">
function pasar(cod,nom){
   window.opener.document.getElementById("loc_tras").value=cod;
    window.opener.document.getElementById("nloc_tras").value=nom;
    
   window.close();
}
</script>

         
</head>
<body>
    <div>
        <h3>LISTA DE VENDEDORES</h3>
    </div>
<div class="datagrid" id="">
    <input type="text" id="buscar_empleado" onkeyup="tabla_sucursales(1)">
    <table>
        <tr>
            <th>CEDULA</th>
            <th>COD</th>
            <th>NOMBRE DEL VENDEDOR</th>

        </tr>
        <tbody id="mostrar_sucursales">
            
        </tbody>
    </table>
       </div>     
</body>
</html>

         

                              
                                