<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Colores de la Referencia</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../existencias/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">
    $(document).ready(function(){
        MostrarColores(1);
    });
function pasar(cod,stc,des,col,med,cos){
   window.opener.document.getElementById("coder").value=cod;
   window.opener.document.getElementById("des").value=des;
   window.opener.document.getElementById("col").value=col;
   window.opener.document.getElementById("med").value=med;
   window.opener.document.getElementById("pre").value=cos;
   window.opener.document.getElementById("stc").value=stc;
   window.opener.$("#can").focus();
   window.close();
}
</script>

         
</head>
<body>
    <div>
        <h3>Lista de Colores</h3>
    </div>

Buscar:<input type="text" id="buscar_color" value="" placeholder="Descripcion">
<input type="text" id="bod" value="" disabled><br>
<div class="datagrid" id="usuarios">
     
       </div>     
</body>
</html>

         

                              
                                