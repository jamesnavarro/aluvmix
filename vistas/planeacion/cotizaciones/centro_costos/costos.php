<?php
 session_start();
  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Centro de Costo</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../../../../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../centro_costos/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">

</script>

         
</head>
<body>
    <div>
        <h3>Centro de Costo</h3>
    </div>

    Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Descripcion" value=""><br>
  <input type="hidden" id="resultado">
<div class="datagrid" id="usuarios">
      <table>
        <tr>
            <th>CODIGO</th>
            <th>CENTRO DE COSTO</th>

        </tr>
        <tbody id="mostrar_sucursales">
            
        </tbody>
    </table>
       </div>     
</body>
</html>

         

                              
                                