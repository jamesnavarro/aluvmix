<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Tipo de Movimiento</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../tmovi/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">
function pasar(cod,nom,ccc){
   window.opener.document.getElementById("doc").value=cod;
   window.opener.document.getElementById("ndoc").value=nom;
   if (ccc=='No'){
                  window.opener.$("#cc").attr("disabled", true);
                  window.opener.$("#btn_cc").attr("disabled", true);
//                  alert("no hay centro de costo");
              }else{
               
                  window.opener.$("#cc").attr("disabled", false);
                  window.opener.$("#btn_cc").attr("disabled", false);
              }
   window.close();
}
</script>

         
</head>
<body>
    <div>
        <h3>LISTA DE TIPOS DE MOVIMIENTOS</h3>
    </div>

Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Descripcion"> 
TIPO:<input type="text" id="tipo" autofocus  disabled><br>
<div class="datagrid" id="usuarios">
     
       </div>     
</body>
</html>

         

                              
                                