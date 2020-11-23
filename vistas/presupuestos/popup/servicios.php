<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Servicios</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
    <script src="../../../js/jquery.js" type="text/javascript"></script>
    <script src="../../../js/ajax.js" type="text/javascript"></script>
<link href="../../../css/estilo.css" rel="stylesheet">
<script src="funciones.js"></script>
<script language="javascript" type="text/javascript">
function pasar(){
   window.opener.pasar_referencias(document.getElementById('id_ref').value,document.getElementById('ref').value,document.getElementById('referencia').value);
   window.close();
}
</script>

         
</head>
<body onload="javascript:pasar();">
    <div>
        <h3>Lista de Servicios</h3>
    </div>
                            
    
Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Codigo o Descripcion"><br>

<div class="datagrid" id="empleados">

            
       </div>
               
</body>
</html>

         

                              
                                