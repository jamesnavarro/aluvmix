
<?php
   include '../../../modelo/conexioni.php';
   session_start();
   if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
   $userk=$_SESSION['k_username'];
   $date= date("Y-m-d");
if(isset($_POST['id'])){
  $save=$_POST['save'];
  if($save==0){
 ?>
<!-- ESTADO EN PROCESO DE CREACION -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro</title>
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
        <script src="funciones.js"></script>
    </head>
    <body>
        <div>
            <h3>DOCUMENTO DE ENTRADA TRASLADO DE BODEGAS</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button"  id="Guardar" onclick="save_traslado();"><img src="../../images/guardar.png"> Cierre Total</button>  
               </div>
               <div id="paginacion"  style="float:right">

               </div>

            </div>
        <br><hr>
        <div class="border">
            <fieldset>
                <div class="form">
                    <br>
               <div class="tab-content" id="">
                   <div id="detalle" class="tab-pane fade in active">
                       <table class="tbl-registro" width="100%">
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" id="doc" readonly="" value="1006" style="width: 40px"><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" value="ENTRADA POR TRASLADO DE BODEGAS" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="<?php echo $date;?>" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" value="" disabled><input type="text" id="radicado" style="width: 80px" value="" disabled></td>
                           </tr>
                           
                           <tr>
                                <td>Orden Traslado</td>
                                <td><input type="text" id="traslado" value="<?php echo $_POST['id'];?>" readonly  style="width: 80px"></td>
                           </tr>
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px">
                                   <img src="../../images/buscar.png" onclick="inv_bodega_popup();" style="cursor: pointer"> <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="0" disabled style="width: 30px" > <input type="text" id="estado" value="En proceso" disabled style="width: 100px" ></td>
                        <td><button type="submit" class="btn btn-danger" onclick="entrada_tras();" id="crear_tras_en">Crear Entrada</button></td>
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" readonly="" value="0" style="width: 80px" >
                               <input type="text" id="nterc" style="width: 200px" placeholder="Nombre del tercero" value="Vacio" disabled></td>
                               <td>Descarga Inv.</td>
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="ENTRADA"></td>
                           </tr>  
                          

                       </table><br><br>
                       <table width="100%">
                           <tr bgcolor="#F2F2F2">
                               <th>CODIGO</th>
                               <th>DESCRIPCION</th>
                               <th>COLOR</th>
                               <th>MEDIDA</th>
                               <th>CANTIDAD</th>
                               <th>CANT PENDIENTE</th>
                               <th>AÑADIR</th>
                           </tr>
                          <tbody id="mostrar_moviemientos">
                          </tbody>
                       </table>
                           <br><hr>
                   </div>
               </div>
                </div>
                </fieldset>


            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
        
        <script>

          verif();
          estados();

          function estados() {
            var ras=document.getElementById('radicado').value;
            if(ras>0){
              document.getElementById('crear_tras_en').style.visibility = "hidden";
            }
          }

          function save_traslado() {
            alert('si');
          }

          function dar_acesso(cod,des,can,idf,idm) {
           var ras=document.getElementById('radicado').value;
           if(ras==0 || ras==''){
            alert('Debe crear la entrada al inventario primero!');
           }else{
             document.getElementById('cod').value = cod;
             document.getElementById('des').value = des;
             document.getElementById('cant').value = can;
             document.getElementById('refid').value = idf;
             document.getElementById('codid').value = idm;
             document.getElementById('canr').value = '';
             document.getElementById('ubi').value = '';
             $("#entrada_traslado").modal();
            sacarinfo();
           }
          }

            function verif() {
              var orden='<?php echo $_POST['id'];?>';
                $.post("sacarinfo.php", {"traslado":orden}, function(data){
                          if(data.sucess==1){
                            cargadatos(orden);
                          }else{
                            $("#mostrar_moviemientos").html('<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>');
                          }
                       },"json");
            }

            function cargadatos(ord) {
                $.ajax({
                    type: 'POST',
                    data: 'ord=' + ord + '&trasl=1',
                    url: 'sacarinfo.php',
                    success: function (d) {
                        $("#mostrar_moviemientos").html(d);
                        if (d == 'error') {
                            location.href = '../index.php';
                        }
                    }
                });
            }

            $(document).ready(function(){
                $("#save_mov").click(function(){

                   $.post("items_traslado.php", {"id_mov":$("#rad").val(),"id_ref_mov":$("#refid").val(),"pro_codigo":$("#cod").val(),"cantidad":$("#canr").val(),"ubic":$("#ubi").val()}, function(data){
                         if(data.result==1){
                            var orden='<?php echo $_POST['id'];?>';
                            alert('Se realizo operacion con éxito');
                            $('#entrada_traslado').modal('hide');
                            cargadatos(orden);
                         }else{
                            alert('No pudo ser procesada esta operacion');
                         }
                    },"json");
                })
              });

            function sacarinfo() {
              var x=document.getElementById('refid').value;
              var x2=document.getElementById('cod').value;
               $.ajax({
                    type: 'POST',
                    data: 'cod=' + x2 + '&ubisx=1&ref=' + x,
                    url: 'sacarinfo.php',
                    success: function (d) {
                        $("#mostrar_ubi_pro").html(d);
                        if (d == 'error') {
                            location.href = '../index.php';
                        }
                    }
                });
            }

            function visitor(value) {
                var valor_focal=parseInt(value);
                var inicial=parseInt(document.getElementById('cant').value);
                if (valor_focal>inicial) {
                  alert('Supero el valor de cantidades');
                    document.getElementById('canr').value = '';
                }
            }

            function Imprimir() {
            var x = document.getElementById('rad').value;
             $('<form action="../reportes/imprimir_resporte_mov.php" method="post" target="_blank"><input type="hidden" name="id_mov" value="'+x+'"/></form>')
              .appendTo('body').submit();
            }
        </script>
      <div class="modal fade" id="entrada_traslado" tabindex="-1" role="dialog" aria-labelledby="entrada_traslado">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="entrada_traslado"><i class='glyphicon glyphicon-edit'></i> Agregar Productos a Inventario</h4>
                </div>
                <div class="modal-body" style="margin-bottom: 4%;">
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Codigo</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="cod" name="cod" placeholder="Referencia del producto" readonly required>
                       <input type="hidden" id="codid" name="codid" readonly required>
                       <input type="hidden" id="refid" name="refid" readonly required>
                    </div>
                  </div><br><br>
                   <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-8">
                      <input type="text" id="des" name="des" placeholder="Nombre producto" readonly required>
                      <input type="hidden" id="med" name="med">
                      <input type="hidden" id="col" name="col">
                      <input type="hidden" id="movi" name="movi">
                    </div>
                  </div><br><br>
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Cantidad</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="cant" name="cant" placeholder="Cantidad Pediente" readonly required>
                    </div>
                  </div><br><br>

                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Cantidad recibida</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="canr" name="canr" placeholder="Cantidad recibida" onkeyup="visitor(this.value);" required>
                    </div>
                  </div><br><br>
                   <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Ubicacion</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="ubi" name="ubi" placeholder="Seleccione Ubicacion" onclick="buscarb();" required>
                    </div>
                  </div><br><br>
                  <table class="table table-hover">
                    <tr class="bg-info">
                                         <th>CODIGO(PRO)</th> 
                                         <th>UBICACION</th>
                                         <th>CANTIDAD</th>
                                    </tr>
                                   <tbody id="mostrar_ubi_pro">
                                   </tbody>
            </table><br><br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                  <button type="submit" class="btn btn-primary" id="save_mov">Guardar datos</button>
                </div>
              </div>
          </div>
      </div>
    </body>
</html>
<?php
}elseif ($save==1) {
?>
<!-- ESTADO GUARDADO -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro</title>
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
        <script src="funciones.js"></script>
    </head>
    <body>
        <div>
            <h3>DOCUMENTO DE ENTRADA ORDEN DE COMPRA</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <img src="../../images/printer.png" class="panel"  onclick="Imprimir();" title="Imprimir Registro">
                   <img src="../../images/salir.png" class="panel"  onclick="salir();" title="Salir del Formulario">
                   <span id="e"></span>
               </div>
               <div id="paginacion"  style="float:right">

               </div>

            </div>
            <br><hr>
        <div class="border">
            <fieldset>
                <div class="form">
                    <br>
               <div class="tab-content" id="">
                   <div id="detalle" class="tab-pane fade in active">
                       <table class="tbl-registro" width="100%">
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" id="doc" style="width: 40px" disabled><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" id="cc" style="width: 40px"disabled> <input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                              
                               <td></td>
                               <td></td>
                          
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" style="width: 100%" disabled></td>
                           </tr>
                           <tr>
                                <td>Orden Compra</td>
                                <td><input type="text" id="compra" style="width: 80px" disabled></td>
                                 <td>Remision N°.</td>
                               <td><input type="text" id="factura" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px" disabled>
                                   <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>Total Remision</td>
                               <td><input type="number" id="totalx" style="width: 100px" disabled></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="1" disabled style="width: 30px"> <input type="text" id="estado" value="Guardado" disabled style="width: 100px" ></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" style="width: 80px" disabled>
                               <input type="text" id="nterc" style="width: 200px" placeholder="Nombre del tercero" disabled></td>
                               
                               <td>Diferencia</td>
                               <td><input type="number" id="diferencia" style="width: 100px" disabled></td>
                               
                               <td>Registrado Por:</td>
                               <td><input type="text" id="por" style="width: 80px" value="" disabled></td>
                           </tr>  
                           <tr>
                              <td></td>
                               <td></td>
                               <td>Descarga Inv.</td>
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="ENTRADA"></td>
                               <td></td>
                               <td></td>
                           </tr> 
                       </table>
                       <table width="100%">
                             <tr bgcolor="#F2F2F2">
                                 <th>CODIGO</th>
                                 <th>DESCRIPCION</th>
                                 <th>COLOR</th>
                                 <th>MEDIDA</th>
                                 <th>CANTIDAD</th>
                                 <th>CANT PENDIENTES</th>
                                 <th>PRECIO TOTAL</th>
                             </tr>
                            <tbody id="mostrar_moviemientos">
                            </tbody>
                        </table>
                           <br><hr>
                   </div>
               </div>
                </div>
            </fieldset>


            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
        
        <script>
                    $("#compra").keyup(function(){

                      var orden=$("#compra").val();

                        $.post("sacarinfo.php", {"orden":orden}, function(data){
                                  if(data.sucess==1){
                                    cargadatos(orden);
                                  }else{
                                    $("#mostrar_moviemientos").html('<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>');
                                  }
                               },"json");
                    });

                    function cargadatos2(ord) {
                        $.ajax({
                            type: 'POST',
                            data: 'ord=' + ord + '&tablas=1',
                            url: 'sacarinfo.php',
                            success: function (d) {
                                $("#mostrar_moviemientos").html(d);
                                if (d == 'error') {
                                    location.href = '../index.php';
                                }
                            }
                        });
                    }

                    $(document).ready(function(){
                        $("#save_mov").click(function(){

                           $.post("acciones.php", {"save":"1","id_mov":$("#rad").val(),"bod_codigo":$("#loc").val(),"pro_codigo":$("#cod").val(),"cantidad":$("#canr").val(),"medida":$("#med").val(),"color":$("#col").val(),"compra":$("#compra").val(),"idpro":$("#codid").val(),"ubic":$("#ubi").val(),"tiac":$("#descarga").val()}, function(data){
                                  if(data.sucess==1){
                                    alert('Se realizo operacion con exito.');
                                    $('#inventario_send').modal('hide');
                                    var x=$("#compra").val();
                                    cargadatos(x);
                                  }else{
                                    alert('no llego');
                                  }
                            },"json");
                        })
                      });

                    function sacarinfo(cod) {
                      var x=document.getElementById('movi').value;
                       $.ajax({
                            type: 'POST',
                            data: 'cod=' + cod + '&ubis=1&mov=' + x,
                            url: 'sacarinfo.php',
                            success: function (d) {
                                $("#mostrar_ubi_pro").html(d);
                                if (d == 'error') {
                                    location.href = '../index.php';
                                }
                            }
                        });
                    }

                    function visitor(value) {
                        var valor_focal=parseInt(value);
                        var inicial=parseInt(document.getElementById('cant').value);
                        if (valor_focal>inicial) {
                          alert('Supero el valor de cantidades');
                            document.getElementById('canr').value = '';
                        }
                    }

                    function Imprimir() {
                      var x = document.getElementById('rad').value;
                       $('<form action="../reportes/imprimir_resporte_mov.php" method="post" target="_blank"><input type="hidden" name="id_mov" value="'+x+'"/></form>')
                        .appendTo('body').submit();
                      }
        </script>
        <script type="text/javascript">
          var id='<?php echo $_POST['id'];?>';
          sacarinfo3(id);
          function sacarinfo3(id) {
            $.post("acciones.php", {"api-rest":true,"id":id}, function(data){
                          if(data.sucess==1){
                             $("#doc").val(data.tipo_mov);
                             $("#ndoc").val(data.name_tipo);
                             $("#cc").val(data.code_costo);
                             $("#centro").val(data.name_cc);
                             $("#loc").val(data.code_bodega);
                             $("#nloc").val(data.name_bodega);
                             $("#nombrepro").val(data.cod_ter);
                             $("#nterc").val(data.nom_ter);
                             $("#FecReg").val(data.fecha);
                             $("#factura").val(data.remision);
                             $("#totalx").val(data.totalr);
                             $("#diferencia").val(data.diferencia);
                             $("#por").val(data.por);
                             $("#compra").val(data.orden_c);
                             cargadatos2(data.orden_c);
                          }else{
                            alert('Los datos no pudieron cargarse con exito.');
                          }
                    },"json");
          }
        </script>
    </body>
</html>

<?php
}else{
?>
<!-- ESTADO ANULADO -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro</title>
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
        <script src="funciones.js"></script>
    </head>
    <body>
        <div>
            <h3>DOCUMENTO DE ENTRADA ORDEN DE COMPRA</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <img src="../../images/printer.png" class="panel"  onclick="Imprimir();" title="Imprimir Registro">
                   <img src="../../images/salir.png" class="panel"  onclick="salir();" title="Salir del Formulario">
                   <span id="e"></span>
               </div>
               <div id="paginacion"  style="float:right">

               </div>

            </div>
            <br><hr>
        <div class="border">
            <fieldset>
                <div class="form">
                    <br>
               <div class="tab-content" id="">
                   <div id="detalle" class="tab-pane fade in active">
                       <table class="tbl-registro" width="100%">
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" id="doc" style="width: 40px" disabled><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" id="cc" style="width: 40px"disabled> <input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                              
                               <td></td>
                               <td></td>
                          
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" style="width: 100%" disabled></td>
                           </tr>
                           <tr>
                                <td>Orden Compra</td>
                                <td><input type="text" id="compra" style="width: 80px" disabled></td>
                                 <td>Remision N°.</td>
                               <td><input type="text" id="factura" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px" disabled>
                                   <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>Total Remision</td>
                               <td><input type="number" id="totalx" style="width: 100px" disabled></td>
                               <td>Estado</td>
                               <td style="color: red;font-weight: bold;"><input type="hidden" id="est" value="2" disabled style="width: 30px"><h5><b>Anulado</b></h5></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" style="width: 80px" disabled>
                               <input type="text" id="nterc" style="width: 200px" placeholder="Nombre del tercero" disabled></td>
                               
                               <td>Diferencia</td>
                               <td><input type="number" id="diferencia" style="width: 100px" disabled></td>
                               
                               <td>Registrado Por:</td>
                               <td><input type="text" id="por" style="width: 80px" value="" disabled></td>
                           </tr>  
                           <tr>
                              <td></td>
                               <td></td>
                               <td>Descarga Inv.</td>
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="ENTRADA"></td>
                               <td></td>
                               <td></td>
                           </tr> 
                       </table>
                       <table width="100%">
                             <tr bgcolor="#F2F2F2">
                                <th>CODIGO</th>
                                 <th>DESCRIPCION</th>
                                 <th>COLOR</th>
                                 <th>MEDIDA</th>
                                 <th>CANTIDAD</th>
                                 <th>CANT PENDIENTES</th>
                                 <th>PRECIO TOTAL</th>
                             </tr>
                            <tbody id="mostrar_moviemientos">
                            </tbody>
                        </table>
                           <br><hr>
                   </div>
               </div>
                </div>
            </fieldset>


            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
        
        <script>
                    $("#compra").keyup(function(){

                      var orden=$("#compra").val();

                        $.post("sacarinfo.php", {"orden":orden}, function(data){
                                  if(data.sucess==1){
                                    cargadatos(orden);
                                  }else{
                                    $("#mostrar_moviemientos").html('<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>');
                                  }
                               },"json");
                    });

                    function cargadatos2(ord) {
                        $.ajax({
                            type: 'POST',
                            data: 'ord=' + ord + '&tablas=1',
                            url: 'sacarinfo.php',
                            success: function (d) {
                                $("#mostrar_moviemientos").html(d);
                                if (d == 'error') {
                                    location.href = '../index.php';
                                }
                            }
                        });
                    }

                    $(document).ready(function(){
                        $("#save_mov").click(function(){

                           $.post("acciones.php", {"save":"1","id_mov":$("#rad").val(),"bod_codigo":$("#loc").val(),"pro_codigo":$("#cod").val(),"cantidad":$("#canr").val(),"medida":$("#med").val(),"color":$("#col").val(),"compra":$("#compra").val(),"idpro":$("#codid").val(),"ubic":$("#ubi").val(),"tiac":$("#descarga").val()}, function(data){
                                  if(data.sucess==1){
                                    alert('Se realizo operacion con exito.');
                                    $('#inventario_send').modal('hide');
                                    var x=$("#compra").val();
                                    cargadatos(x);
                                  }else{
                                    alert('no llego');
                                  }
                            },"json");
                        })
                      });

                    function sacarinfo(cod) {
                      var x=document.getElementById('movi').value;
                       $.ajax({
                            type: 'POST',
                            data: 'cod=' + cod + '&ubis=1&mov=' + x,
                            url: 'sacarinfo.php',
                            success: function (d) {
                                $("#mostrar_ubi_pro").html(d);
                                if (d == 'error') {
                                    location.href = '../index.php';
                                }
                            }
                        });
                    }

                    function visitor(value) {
                        var valor_focal=parseInt(value);
                        var inicial=parseInt(document.getElementById('cant').value);
                        if (valor_focal>inicial) {
                          alert('Supero el valor de cantidades');
                            document.getElementById('canr').value = '';
                        }
                    }
        </script>
        <script type="text/javascript">
          var id='<?php echo $_POST['id'];?>';
          sacarinfo3(id);
          function sacarinfo3(id) {
            $.post("acciones.php", {"api-rest":true,"id":id}, function(data){
                          if(data.sucess==1){
                             $("#doc").val(data.tipo_mov);
                             $("#ndoc").val(data.name_tipo);
                             $("#cc").val(data.code_costo);
                             $("#centro").val(data.name_cc);
                             $("#loc").val(data.code_bodega);
                             $("#nloc").val(data.name_bodega);
                             $("#nombrepro").val(data.cod_ter);
                             $("#nterc").val(data.nom_ter);
                             $("#FecReg").val(data.fecha);
                             $("#factura").val(data.remision);
                             $("#totalx").val(data.totalr);
                             $("#diferencia").val(data.diferencia);
                             $("#por").val(data.por);
                             $("#compra").val(data.orden_c);
                             cargadatos2(data.orden_c);
                          }else{
                            alert('Los datos no pudieron cargarse con exito.');
                          }
                    },"json");
          }

          function Imprimir() {
            var x = document.getElementById('rad').value;
             $('<form action="../reportes/imprimir_resporte_mov.php" method="post" target="_blank"><input type="hidden" name="id_mov" value="'+x+'"/></form>')
              .appendTo('body').submit();
            }
        </script>
    </body>
</html>
<?php
}
?>

<?php
}
?>