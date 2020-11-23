<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Producto</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
<script src="../../../../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../productos/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">
function pasar(cod,nom,col,med,cos){
   if(cod==''){
        alert("Digite el codigo!");
        $("#codxa").focus();
        return false;
    } 

      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
                window.opener.document.getElementById("codigo").value=cod;
                window.opener.document.getElementById("nombre").value=nom;
                window.opener.document.getElementById("color").value=da.INV_LOTE;
	        window.opener.document.getElementById("medidas").value=da.INV_UBICA;
                window.opener.document.getElementById("precio").value=da.INV_VALCOM;
                window.opener.document.getElementById("med").value=da.INV_UNDMED;
                window.opener.document.getElementById("iva").value=da.INV_IVA;
                window.opener.$("#stock").focus();
                window.close();
 
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
}
function pasarx(cod,nom,col,med,cos){
   if(cod==''){
        alert("Digite el codigo!");
        $("#codxa").focus();
        return false;
    } 
    window.opener.document.getElementById("codigo").value=cod;
                window.opener.document.getElementById("nombre").value=nom;
	        window.opener.document.getElementById("color").value=col;
	        window.opener.document.getElementById("medidas").value=med;
                window.opener.document.getElementById("precio").value=cos;
                window.opener.document.getElementById("stock").value='Und';
                window.close();
            }
function bus_cod_fom(){

    if(cod==''){
        alert("Digite el codigo!");
        $("#codxa").focus();
        return false;
    }
      $.ajax({
          type:'GET',
          //data: JSON.stringify(datos),
          url:'http://172.16.0.30:8989/api/MAEINV/'+cod,
          contentType: 'application/json',
          success: function(da){
             var p = eval(da);
                window.opener.document.getElementById("codigo").value=cod;
                window.opener.document.getElementById("nombre").value=nom;
	        window.opener.document.getElementById("color").value=col;
	        window.opener.document.getElementById("medidas").value=med;
                window.opener.document.getElementById("precio").value=cos;
                window.close();
          }
      }).fail( function( jqXHR, textStatus, errorThrown ) {
             alert( 'Este codigo no esta registrado en fom plus\n Comuniquese con el area de inventario para crear el producto' );
//           $("#est"+ced).html('');
             return false;
        });
  }
</script>      
</head>
<body>
    <div>
        <h3>LISTA DE PRODUCTOS</h3>
    </div>

Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Descripcion"><br>
<div class="datagrid" id="usuarios">   
</div>     
</body>
</html>

         

                              
                                