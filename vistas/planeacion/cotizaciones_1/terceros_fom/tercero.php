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
    <title>Buscar Tercero</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../../../../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../terceros_fom/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
<script language="javascript" type="text/javascript">

</script>

         
</head>
<body>
    <div>
        <h3>Lista de Tercero</h3>
    </div>

    Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Descripcion" value="<?php if(isset($_GET['cc'])){if($_GET['cc']=='0' || $_GET['cc']=='123456789'){echo '';}else{echo $_GET['cc'];}} ?>"><br>
  <input type="hidden" id="resultado">
<div class="datagrid" id="">
     <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>DOCUMENTO</th>
                                        <th>NOMBRE DEL CLIENTE</th>
                                        <th>ESTADO</th>
                                    </tr>
                                </thead>
                                <tbody id="mostrar_tabla2">
                                   
                                </tbody>
                                 <tr><td colspan="2">
                  <img src="../../../images/at2.png"  onclick="paginacion(-1)" style="cursor: pointer;">
                       Pagina: <input type="text" id="page" placeholder="" value="1"  disabled style="width: 30px"/>
                       <img src="../../../images/sig2.png" onclick="paginacion(1)" style="cursor: pointer;">
                       <input type="hidden" id="tamano" placeholder="" value="10"  disabled/>
                       </td></tr>
                            </table>
       </div>     
</body>
</html>

         

                              
                                