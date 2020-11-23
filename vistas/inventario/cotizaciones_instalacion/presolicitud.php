<?php
   include '../../../modelo/conexionv1.php';
   session_start();
   if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
   $userk=$_SESSION['k_username'];
   $date= date("Y-m-d");
   $consultaq = mysqli_query($con2,"select * from cotizacion where id_cot='".$_GET['cot']."' ");
$row = mysqli_fetch_array($consultaq);
$obra = $row['obra'];
$numero = $row['numero_cotizacion'].'. '.$row['version'];
$usuario = $row['presupuesto'];
$costo = $row['costo_total'];

?>
<!-- ESTADO EN PROCESO DE CREACION -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Detalle de la cotizacion </title>
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery.gritter.min.css" />
        <link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../../assets/css/chosen.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-colorpicker.min.css" />
        <link href="../../../css/estilo.css" rel="stylesheet">
        <script src="funciones.js?<?php echo rand(1, 999) ?>"></script>
    </head>
    <body>
        <div>
            <h3>Listado de items </h3> 
        </div>
        <div class="border">
          
               <div  style="float:left">

                   <button onclick="salir();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>

                   <input type="text" id="cot" value="<?php echo $_GET['cot'];?>" disabled><br>
                         <b>1. Cotizacion No. : <?php echo $numero; ?></b><br>
                        <b>2. Nombre de la Obra : <?php echo $obra; ?></b><br>
                        <b>3. Usuario. : <?php echo $usuario; ?></b><br>
      
               </div>
            <form name="buscarA" action="http://172.16.0.40/cotizacionv2/vistas/print.php" method="get"  target="_blank"  enctype="multipart/form-data">
                <div align="right">
                    <input style="width:30px;" type="hidden" name="cot" id="cotizacionx" value="<?php echo $_GET['cot']; ?>">
                    <input style="width:30px;" type="hidden" name="c" value="">
                    <input style="width:30px;" type="hidden" name="ciudad" value="<?php if(isset($_POST['col'])){echo $_POST['ciudad'];} ?>">
                    <input style="width:30px;" type="hidden" name="total_item" value="<?php echo $row_total_item; ?>" /><!--Codigo Agregado (Jaime)-->
                    <input style="width:30px;" type="number" name="col" value="<?php if(isset($_POST['col'])){echo $_POST['col'];}else{echo '7';} ?>">
                    
                    <button type="submit"><img src="../imagenes/print.png"> Imprimir PDF</button>   
                </div>
          </form>

            </div>
        <br><hr>
        <div class="border">
     <button type="button"  id="verificador" onclick="planilla(<?php echo $_GET['cot'] ?>,<?php echo $costo ?>);"><img src="../../images/ver.png">1. Planilla de Costo General</button>

                <div class="form" id="">
                   <?php

              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
               $table = $table.'<th  width="10%">'.'Tipo'.' </th>';
               $table = $table.'<th width="40%">'.'Producto'.' </th>';
               $table = $table.'<th width="10%">'.'Ancho'.' </th>';
              $table = $table.'<th width="10%">'.'Alto'.'</th>';  
              $table = $table.'<th width="10%">'.'Cantidad'.'</th>';
              $table = $table.'<th width="40%">'.'Ver'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';

              $request=mysqli_query($con2,"SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " and c.id_compuesto=0 ORDER BY c.fila ASC ");
              while($row=mysqli_fetch_array($request))
	      { 
                  
                  
                  $table = $table.'<tr><td>'.$row['tip'].'</td>';
                  $table = $table.'<td>'.$row['fila'].'</td>';
                  $table = $table.'<td>'.$row['producto'].' , '.$row['observaciones'].'</td>';
                  $table = $table.'<td>'.$row['ancho_c'].'</td>';
                  $table = $table.'<td>'.$row['alto_c'].'</td>';
                  $table = $table.'<td>'.$row['cantidad_c'].'</td>';
                  $table = $table.'<td><button onclick="verdt('.$row['id_cotizacion'].')"> Ver DT </button></td>';
              }
            
              $table = $table.'</table>';
              echo $table; 
       ?>
                   
                   
                      
                </div>
     

            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>


      <script type="text/javascript">
          var id='<?php echo $_GET['cot'];?>';

        </script>
    </body>
</html>