<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar referencias</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../popup/referencias/funciones.js"></script>
<script language="javascript" type="text/javascript">
function pasar(){
   window.opener.pasar_referencias(document.getElementById('id_ref').value,document.getElementById('ref').value,document.getElementById('referencia').value,document.getElementById('codigo').value,document.getElementById('dado').value,document.getElementById('medida').value);
   window.close();
}

</script>

         
</head>
<body onload="javascript:pasar();">
    <div>
        <h3>Lista de Insumos</h3>
    </div>
                            


<?php

include "../modelo/conexion.php";
     if(isset($_GET['codigo'])){
                     
     $request2=mysqli_query($con,'SELECT * FROM referencias WHERE id_referencia="'.$_GET['codigo'].'"');
     while($row2=mysqli_fetch_array($request2))
	{     
          
              $a = $row2["id_referencia"];
              $b = $row2["descripcion"];
              $c = $row2["referencia"];
              $d = $row2["codigo"];
              $e = $row2["dado"];
              $f = $row2["medida"];



              
           ?>
    

    <input type="text" name="alm1" id="id_ref" readonly value="<?php echo $a ?>" />
     <input type="text" name="alm1" id="ref" readonly value="<?php echo $b ?>" />
     <input type="text" name="alm1" id="referencia" readonly value="<?php echo $c ?>" />
      <input type="text" name="alm1" id="codigo" readonly value="<?php echo $d ?>" />
       <input type="text" name="alm1" id="dado" readonly value="<?php echo $e ?>" />
        <input type="text" name="alm1" id="medida" readonly value="<?php echo $f ?>" />


<a href="" title="pasar valor" onload="javascript:pasar();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }

        }else{
         include '../modelo/conexioni.php';
         ?>
Buscar:<input type="text" id="buscar_empleado" autofocus placeholder="Codigo o Descripcion"><input type="hidden" id="in" value="<?php echo $_GET['in'] ?>"><br>

<div class="datagrid" id="empleados">
    <?php        include '../popup/referencias/mostrar_tabla.php';  ?>
            
            
       </div>
                  
        <?php } ?>                    
</body>
</html>

         

                              
                                