<?php include '../../modelo/conexioni.php';
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Actualizar descuentos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../../assets/datatable/css/dataTables-bootstrap.min.css">
  <script src="../../js/jquery.tablesorter.min.js" type="text/javascript"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
  <script src="../ventas/funciones.js"></script>
  <script type="text/javascript"> 
    $(document).ready(function() {
       $('#example').DataTable();
  
    });
    function referencias(){
        window.open("../lista_vidrios_1.php", "REFERENCIAS", "width=800 , height=600");
    }
    function recibir(id, des){
       $('#ref').val(id);
       $('#des_ref').val(des);
    }

  </script>
<script type="text/javascript">
$(document).ready(function() {
  $(".js-example-basic-single").select2();
});
</script>
</head>
    <body onload="mostrar_ajustes(1);">
        <div class="container">
          <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Listado</a></li>
    <?php if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='STEFANNYR' || $_SESSION['k_username']=='TATIANA.JULIAO' || $_SESSION['k_username']=='LTAMAYO'){ ?>
    <li><a data-toggle="tab" href="#menu1">Configuracion</a></li>
    <?php } ?>
  </ul>
    <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
    <br>
    
<!--      <input type="text" id="proa" placeholder="Buscar por producto">-->
    <table>
        <tr>
          <td>Producto</td>
          <td><select id="proa"  class="js-example-basic-single" style="width: 500px">
                <option value="">Seleccione</option>
                <?php
                $res =  mysqli_query($con,"select id_p, producto, codigo from producto where linea='Vidrio' ");
                while ($r = mysqli_fetch_array($res)) {
                    echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[2].' -'.$r[1].'</option>';
                }

                ?>
          </select>
   
<!--          <input type="text" id="espa" placeholder="Espesor"> -->
          <td><select id="espa"   class="js-example-basic-single"  style="width: 300px" >
                <option value="">Seleccione Espesor</option>
                <?php
                $res =  mysqli_query($con,"select id_vidrio, color_v, espesor_v from tipo_vidrio where estado=0 order by espesor_v asc");
                while ($r = mysqli_fetch_array($res)) {
                    echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[2].'mm - '.$r[1].'</option>';
                }

                ?>
            </select>
          <td><input type="button" id="buscar" value="Buscar">
   </table>
      <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
           <thead>
           <tr>
               
            <th>ITEM</th>
            <th>PRODUCTO X M<sup>2</sup></th>
            <th>ESPESOR</th>
            <th>PRECIO</th>
            <th>AJUSTE</th>
            <th>VENTA</th>
            <th>REGISTRO</th>
            <th>POR</th>
            <th>OPCIONES</th>

          </tr> </thead>
          <tbody id="mostrar_tabla">

          </tbody>

      </table>

    </div>
    <div id="menu1" class="tab-pane fade">
      
            <h3>Actualizar ajuste de precios</h3>
            <b>Referencia</b><br>
            <select id="ref"  class="js-example-basic-single"  style="width: 100%">
                <option value="">Seleccione</option>
                <?php
                $resv =  mysqli_query($con,"select id_p, producto, codigo from producto where linea='Vidrio' ");
                while ($r = mysqli_fetch_array($resv)) {
                    echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[2].'  - '.$r[1].'</option>';
                }
                ?>
            </select>
               <!--            <div class="input-group">
               <input type="text" id="ref" value=""  class="form-control" style="width: 60px" disabled>
               <input type="text" id="des_ref" value=""  class="form-control" onclick="referencias();" style="width: 500px">
               <span id="msg"></span>
            </div>-->
            <br>
            <b>Vidrio</b><br>
            <select id="espesor"  class="js-example-basic-single"  style="width: 100%">
                <option value="">Seleccione</option>
                <?php
                $res =  mysqli_query($con,"select id_vidrio, color_v, espesor_v from tipo_vidrio where estado=0 order by espesor_v asc");
                while ($r = mysqli_fetch_array($res)) {
                    echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[2].'mm - '.$r[1].'</option>';
                }
                ?>
            </select>
<!--            <input type="hidden" id="espesor" value="" class="form-control">
            <input type="text" id="des_espesor" value="" class="form-control" onclick="ref_vidrios();">-->
            <br>
            <b>Precio del sistema</b><br>
            <input type="text" id="precio" value=""  class="form-control" disabled><br>
            <b>Ajuste</b><br>
            <input type="text" id="ajuste" value=""  class="form-control" disabled><br>
            <b>Precio Und.</b><br>
            <input type="text" id="unidad" value=""  class="form-control"><br>
            <input type="button" id="update" onclick="ajustar();" value="Agregar"> <button type="button" onclick="window.close();">Cerrar</button>
    </div>
  </div>
</div>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
    </body>
</html>
