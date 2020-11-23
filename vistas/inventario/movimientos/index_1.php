
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
        <script src="funciones.js?<?php echo rand(1,100) ?>"></script>
    </head>
    <body>
        <div>
            <h3>DOCUMENTO DE SALIDA</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button" id="Guardar" onclick="save_datos();"><img src="../../images/guardar.png"> Guardar</button>   
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
                               <td><input type="text" id="doc" style="width: 40px"><img src="../../images/buscar.png" onclick="inv_ti_mov_popup();" style="cursor: pointer"> <input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="<?php echo $date;?>" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" id="cc" style="width: 40px"><img src="../../images/buscar.png" onclick="inv_centro_costo_popup();" style="cursor: pointer"> <input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                              
                               <td></td>
                               <td></td>
                          
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" style="width: 100%" ></td>
                           </tr>
                           <tr>
                                <td>Orden Produccion</td>
                                <td><input type="text" id="orden" style="width: 80px"></td>
                                 <td>Remision N°.</td>
                               <td><input type="text" id="factura" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px">
                                   <img src="../../images/buscar.png" onclick="inv_bodega_popup();" style="cursor: pointer"> <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>Total Remision</td>
                               <td><input type="number" id="totalx" style="width: 100px" disabled></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="0" disabled style="width: 30px"> <input type="text" id="estado" value="En proceso" disabled style="width: 100px"></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" style="width: 80px" ><img src="../../images/buscar.png" onclick="inv_tercero_popup();" style="cursor: pointer">
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
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="SALIDA"></td>
                               <td></td>
                              </td>
                           </tr> 
                        </table><br>
                       <center><div><table width="100%" id="">
                           <tr bgcolor="#F2F2F2">
                               <th class="center">CODIGO</th>
                               <th class="center">DESCRIPCION</th>
                               <th class="center">COLOR</th>
                               <th class="center">MEDIDA</th>
                               <th class="center">CANTIDAD</th>
                               <th class="center">PRECIO UNIDAD</th>
                               <th class="center"></th>
                           </tr>
                            <tr bgcolor="#F2F2F2" id="hidden_add">
                               <td><input type="text" id="coder" onclick="inv_mov_sald();"></td>
                               <td><input type="text" id="des" readonly></td>
                               <td><input type="text" id="col" readonly></td>
                               <td><input type="text" id="med" readonly></td>
                               <td><input type="hidden" id="stc"><input type="text" id="can"></td>
                               <td><input type="text" id="pre" readonly></td>
                               <td><button onclick="descarga_ubica();"><b>Añadir</b></button></td>
                           </tr>
                          <tbody id="mostrar_movi_salida">
              </tbody>
                       </table></div></center>
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

                            document.getElementById('tabhidden').style.display='none';

                            $(document).ready(function(){
                              $("#candes").keyup(function(){
                                var x1=parseInt(document.getElementById('candes').value);
                                var z1=parseInt(document.getElementById('canf').value);
                                if(x1 > z1){
                                  alert('Cantidad Supera Limite Asignado!');
                                  document.getElementById('candes').value='';
                                }
                                })
                              });

                            $(document).ready(function(){
                                $("#save_movs").click(function(){

                                   $.post("salidas_mov.php", {"save_movs":"1", "id_mov": $("#codid").val(), "id_ref_mov": $("#refid").val(), "codigo_pro": $("#cod").val(), "ubicacion": $("#ubi").val(), "cantidad_mov": $("#candes").val()}, function(data){
                                          if (data.sucess == 1) {
                                              var cod=$("#cod").val();
                                              var idm=$("#codid").val();
                                              var idf=$("#refid").val();
                                              var can=$("#cant").val();
                                              estraccion(cod,idm,idf,can);
                                              sacarinfo(cod,idf,idm);
                                              document.getElementById('candes').value='';
                                              document.getElementById('ubi').value='';
                                              alert('Se realizo peticion con exito!');
                                           }else{
                                              alert('Ocurrio un error mientras intentaba descontar');
                                           }
                                    },"json");
                                })
                              });

                            function sacarinfo(cod,idf,idm) {
                               $.ajax({
                                    type: 'POST',
                                    data: 'cod=' + cod + '&ubis=1&idf='+idf+'&idm='+idm,
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#mostrar_ubi_pro2").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                                });
                            }

                            function Imprimir() {
            var x = document.getElementById('rad').value;
             $('<form action="../reportes/imprimir_resporte_mov.php" method="post" target="_blank"><input type="hidden" name="id_mov" value="'+x+'"/></form>')
              .appendTo('body').submit();
            }
                            </script>

                        <div class="modal fade" id="salida_inven_ubic" tabindex="-1" role="dialog" aria-labelledby="salida_inven_ubic">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="salida_inven_ubic"><i class='glyphicon glyphicon-edit'></i> Retirar Productos Del Inventario</h4>
                                  </div>
                                  <div class="modal-body" style="margin-bottom: 4%;">
                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Codigo</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="cod" name="cod" placeholder="Referencia del producto" readonly required>
                                         <input type="hidden" id="codid" name="codid" readonly required>
                                         <input type="hidden" id="refid" name="refid" readonly required>
                                      </div>
                                    </div><br><br>
                                     <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Descripcion</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="descb" name="descb" placeholder="Nombre producto" readonly required>
                                      </div>
                                    </div><br><br>

                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Cantidad Faltantes</label>
                                      <div class="col-sm-8">
                                         <input type="hidden" id="cant" name="cant" placeholder="Cantidad" readonly required>
                                        <input type="text" id="canf" name="canf" placeholder="Cantidad" readonly required>
                                      </div>
                                    </div><br><br>

                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Cantidad a descargar</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="candes" name="candes" placeholder="Cantidad" required><p id="resp"></p>
                                      </div>
                                    </div><br><br>

                                    
                                     <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Ubicacion</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="ubi" name="ubi" placeholder="Seleccione Ubicacion" onclick="buscarb();" required>
                                      </div>
                                    </div><br><br>
                                    <h5><b>Ubicaciones de este Producto:</b></h5>
                                    <table class="table table-hover">
                                        <tr class="bg-info">
                                            <th>CODIGO(PRO)</th> 
                                            <th>UBICACION</th>
                                            <th>CANTIDAD</th>
                                            <th></th>
                                        </tr>
                                        <tbody id="mostrar_ubi_pro2">
                                        </tbody>
                                     </table><br><br>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="save_movs">Guardar datos</button>
                                  </div>
                                </div>
                            </div>
                        </div>
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
                             $("#orden").val(data.orden_c);
                             cargar_da_salida();
                          }else{
                            alert('Los datos no pudieron cargarse con exito.');
                          }
                    },"json");
          }
        </script>
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
            <h3>DOCUMENTO DE SALIDA</h3>
        </div>
        <div class="border">
          
               <div>  
                   <img src="../../images/printer.png" class="panel"  onclick="Imprimir();" title="Imprimir Registro">
                   <img src="../../images/salir.png" class="panel"  onclick="salir()" title="Salir del Formulario">
                   <span id="e"></span>
               </div>
              
        <div class="border">
            <fieldset>
                <div class="form">
                    <br>
               <div class="tab-content" id="">
                   <div id="detalle" class="tab-pane fade in active">
                       <table class="tbl-registro" width="100%">
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" id="doc" style="width: 40px"><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="<?php echo $date;?>" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" id="cc" style="width: 40px"><input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                              
                               <td></td>
                               <td></td>
                          
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" style="width: 100%" ></td>
                           </tr>
                           <tr>
                                <td>Orden Produccion</td>
                                <td><input type="text" id="orden" style="width: 80px"></td>
                                 <td>Remision N°.</td>
                               <td><input type="text" id="factura" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px">
                                   <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>Total Remision</td>
                               <td><input type="number" id="totalx" style="width: 100px" disabled></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="1" disabled style="width: 30px"> <input type="text" id="estado" value="Guardado" disabled style="width: 100px"></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" style="width: 80px" >
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
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="SALIDA"></td>
                               <td></td>
                               </td>
                           </tr> 
                        </table><br>
                       <center><div><table width="100%" id="">
                           <tr bgcolor="#F2F2F2">
                               <th class="center">CODIGO</th>
                               <th class="center">DESCRIPCION</th>
                               <th class="center">COLOR</th>
                               <th class="center">MEDIDA</th>
                               <th class="center">CANTIDAD</th>
                               <th class="center">PRECIO UNID</th>
                           </tr>
                          <tbody id="mostrar_movi_salida">
                        </tbody>
                       </table></div></center>
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

                            $(document).ready(function(){
                              $("#candes").keyup(function(){
                                var x1=parseInt(document.getElementById('candes').value);
                                var z1=parseInt(document.getElementById('canf').value);
                                if(x1 > z1){
                                  alert('Cantidad Supera Limite Asignado!');
                                  document.getElementById('candes').value='';
                                }
                                })
                              });

                            $(document).ready(function(){
                                $("#save_movs").click(function(){

                                   $.post("salidas_mov.php", {"save_movs":"1", "id_mov": $("#codid").val(), "id_ref_mov": $("#refid").val(), "codigo_pro": $("#cod").val(), "ubicacion": $("#ubi").val(), "cantidad_mov": $("#candes").val()}, function(data){
                                          if (data.sucess == 1) {
                                              var cod=$("#cod").val();
                                              var idm=$("#codid").val();
                                              var idf=$("#refid").val();
                                              var can=$("#cant").val();
                                              estraccion(cod,idm,idf,can);
                                              sacarinfo(cod,idf,idm);
                                              document.getElementById('candes').value='';
                                              document.getElementById('ubi').value='';
                                              alert('Se realizo peticion con exito!');
                                           }else{
                                              alert('Ocurrio un error mientras intentaba descontar');
                                           }
                                    },"json");
                                })
                              });

                            function sacarinfo(cod,idf,idm) {
                               $.ajax({
                                    type: 'POST',
                                    data: 'cod=' + cod + '&ubis=1&idf='+idf+'&idm='+idm,
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#mostrar_ubi_pro2").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                                });
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
                                                 $("#orden").val(data.orden_c);
                                                 cargar_da_salidas();
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
            <h3>DOCUMENTO DE SALIDA</h3>
        </div>
        <div class="border">
          
               <div>  
                   <img src="../../images/printer.png" class="panel"  onclick="Imprimir();" title="Imprimir Registro">
                   <img src="../../images/salir.png" class="panel"  onclick="salir()" title="Salir del Formulario">
                   <span id="e"></span>
               </div>
              
        <div class="border">
            <fieldset>
                <div class="form">
                    <br>
               <div class="tab-content" id="">
                   <div id="detalle" class="tab-pane fade in active">
                       <table class="tbl-registro" width="100%">
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" id="doc" style="width: 40px"><input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="<?php echo $date;?>" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" id="cc" style="width: 40px"><input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                              
                               <td></td>
                               <td></td>
                          
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" style="width: 100%" ></td>
                           </tr>
                           <tr>
                                <td>Orden Produccion</td>
                                <td><input type="text" id="orden" style="width: 80px"></td>
                                 <td>Remision N°.</td>
                               <td><input type="text" id="factura" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px">
                                  <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>Total Remision</td>
                               <td><input type="number" id="totalx" style="width: 100px" disabled></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="2" disabled style="width: 30px"> <input type="text" id="estado" value="Anulado" disabled style="width: 100px"></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" style="width: 80px" >
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
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="SALIDA"></td>
                               <td></td>
                               </td>
                           </tr> 
                        </table><br>
                       <center><div><table width="100%" id="">
                           <tr bgcolor="#F2F2F2">
                               <th class="center">CODIGO</th>
                               <th class="center">DESCRIPCION</th>
                               <th class="center">COLOR</th>
                               <th class="center">MEDIDA</th>
                               <th class="center">CANTIDAD</th>
                               <th class="center">PRECIO UNID</th>
                           </tr>
                          <tbody id="mostrar_movi_salida">
                          </tbody>
                       </table></div></center>
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
                            $(document).ready(function(){
                              $("#candes").keyup(function(){
                                var x1=parseInt(document.getElementById('candes').value);
                                var z1=parseInt(document.getElementById('canf').value);
                                if(x1 > z1){
                                  alert('Cantidad Supera Limite Asignado!');
                                  document.getElementById('candes').value='';
                                }
                                })
                              });
                            $(document).ready(function(){
                                $("#save_movs").click(function(){

                                   $.post("salidas_mov.php", {"save_movs":"1", "id_mov": $("#codid").val(), "id_ref_mov": $("#refid").val(), "codigo_pro": $("#cod").val(), "ubicacion": $("#ubi").val(), "cantidad_mov": $("#candes").val()}, function(data){
                                          if (data.sucess == 1) {
                                              var cod=$("#cod").val();
                                              var idm=$("#codid").val();
                                              var idf=$("#refid").val();
                                              var can=$("#cant").val();
                                              estraccion(cod,idm,idf,can);
                                              sacarinfo(cod,idf,idm);
                                              document.getElementById('candes').value='';
                                              document.getElementById('ubi').value='';
                                              alert('Se realizo peticion con exito!');
                                           }else{
                                              alert('Ocurrio un error mientras intentaba descontar');
                                           }
                                    },"json");
                                })
                              });
                            function sacarinfo(cod,idf,idm) {
                               $.ajax({
                                    type: 'POST',
                                    data: 'cod=' + cod + '&ubis=1&idf='+idf+'&idm='+idm,
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#mostrar_ubi_pro2").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                                });
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
                                                 $("#orden").val(data.orden_c);
                                                 cargar_da_salidas();
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
}else{
?>
<!-- ESTADO EN BLANCO -->
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
            <h3>DOCUMENTO DE SALIDA</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button" id="Guardar" onclick="save_datos();"><img src="../../images/guardar.png"> Guardar</button> 
                  
                   <img src="../../images/nuevo.png" class="panel"  onclick="Limpiar();" title="Nuevo Registro">  
                   <img src="../../images/printer.png" class="panel"  onclick="Imprimir();" title="Imprimir Registro">
                   <img src="../../images/salir.png" class="panel"  onclick="salir()" title="Salir del Formulario">
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
                               <td><input type="text" id="doc" style="width: 40px"><img src="../../images/buscar.png" onclick="inv_ti_mov_especial();" style="cursor: pointer"> <input type="text" id="ndoc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width: 120px" value="<?php echo $date;?>" disabled> <span id="es"></span></td>
                               <td>Radicado</td>
                               <td><input type="text" id="rad" style="width: 80px" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" id="cc" style="width: 40px"><img src="../../images/buscar.png" onclick="inv_centro_costo_popup();" style="cursor: pointer"> <input type="text" id="centro" style="width: 200px" placeholder="Descripcion" disabled></td>
                              
                               <td>Puesto de Trabajo:</td>
                               <td id="puestot"></td>
                          
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="1"><input type="text" id="obs" style="width: 80%" ></td>
                           </tr>
                           <tr>
                                 <td>Orden Produccion</td>
                                 <td><input type="text" id="orden" style="width: 80px"></td>
                                 <td>Remision N°.</td>
                                 <td><input type="text" id="factura" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Bodega Origen:</td> 
                               <td><input type="hidden" id="almori" style="width: 40px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" id="loc" style="width: 40px">
                               <img src="../../images/buscar.png" onclick="inv_bodega_popup();" style="cursor: pointer"> <input type="text" id="nloc" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>Total Remision</td>
                               <td><input type="number" id="totalx" style="width: 100px" disabled></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" disabled style="width: 30px" > <input type="text" id="estado" disabled style="width: 100px" ></td>
                        
                           </tr>
                           <tr id="ocultotr">
                               <td>Bodega Destino:</td> 
                               <td><input type="text" id="loc2" value="0" style="width: 40px">
                               <img src="../../images/buscar.png" onclick="inv_bodega_especial();" style="cursor: pointer"> <input type="text" id="nloc2" style="width: 200px" placeholder="Descripcion" disabled></td>
                               
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                               <td>-</td>
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                               <td><input type="text" id="nombrepro" style="width: 80px" ><img src="../../images/buscar.png" onclick="inv_tercero_popup();" style="cursor: pointer">
                               <input type="text" id="nterc" style="width: 200px" placeholder="Nombre del tercero" disabled></td>
                               
                               <td>Diferencia</td>
                               <td><input type="number" id="diferencia" style="width: 100px" disabled></td>
                               
                               <td>Registrado Por:</td>
                               <td><input type="text" id="por" style="width: 80px" value="<?php echo $userk;?>" disabled></td>
                           </tr>  
                           <tr>
                               <td></td>
                               <td></td>
                               <td>Descarga Inv.</td>
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="<?php echo $_GET['tipo'] ?>"></td>
                               <td></td>
                               <td><button type="button" id="continuar" onclick="prueba2();"><img src="../../images/play.png"> Continuar</button></td>
                           </tr> 
                        </table><br><hr style="background-color: blue;">
                       <center><div id="tabhidden">
                       </div></center>
                   </div>
               </div>
                </div><hr>
                </fieldset>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
        
                            <script>

                            document.getElementById('tabhidden').style.display='none';
                            document.getElementById('ocultotr').style.visibility='hidden';
                            $(document).ready(function(){
                              $("#candes").keyup(function(){
                                var x1=parseInt(document.getElementById('candes').value);
                                var z1=parseInt(document.getElementById('canf').value);
                                if(x1 > z1){
                                  alert('La Cantidad Supera Limite Asignado!');
                                  document.getElementById('candes').value='';
                                }
                                })
                              });

                            $(document).ready(function(){
                                $("#save_movs").click(function(){

                                   $.post("salidas_mov.php", {"save_movs":"1", "id_mov": $("#codid").val(), "id_ref_mov": $("#refid").val(), "codigo_pro": $("#cod").val(), "ubicacion": $("#ubi").val(), "cantidad_mov": $("#candes").val()}, function(data){
                                          if (data.sucess == 1) {
                                              var cod=$("#cod").val();
                                              var idm=$("#codid").val();
                                              var idf=$("#refid").val();
                                              var can=$("#cant").val();
                                              estraccion(cod,idm,idf,can);
                                              sacarinfo(cod,idf,idm);
                                              document.getElementById('candes').value='';
                                              document.getElementById('ubi').value='';
                                              alert('Se realizo peticion con exito!');
                                           }else{
                                              alert('Ocurrio un error mientras intentaba descontar');
                                           }
                                    },"json");
                                })
                              });

                            function sacarinfo(cod,idf,idm) {
                               $.ajax({
                                    type: 'POST',
                                    data: 'cod=' + cod + '&ubis=1&idf='+idf+'&idm='+idm,
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#mostrar_ubi_pro2").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                                });
                            }

                            function buscar_dato_res() {
                              var bode_origen=document.getElementById('loc').value;
                               $.ajax({
                                    type: 'POST',
                                    data: 'bodega=' + bode_origen + '&bres=1',
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#salida_bog_result").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                                });
                            }

                            function verfmas(id) {
                              var x1=parseInt(document.getElementById('CRS'+id).value);
                              var x2=parseInt(document.getElementById('CGR'+id).value);
                              if(x1>x2){
                                alert('No puede acceder a un valor mayor al de la bodega');
                                document.getElementById('CRS'+id).value='';
                              }
                            }

                            function verstc() {
                              var x1 = parseInt(document.getElementById('can').value);
                              var x2 = parseInt(document.getElementById('stc').value);
                              if(x1>x2){
                                alert('No puede acceder a un valor mayor al de la bodega');
                                document.getElementById('can').value='';
                              }
                            }

                            function prestamos() {
                              document.getElementById('ocultotr').style.visibility='visible';
                              var tip=document.getElementById('doc').value;
                              if(tip=='P028'){
                                document.getElementById('tabhidden').innerHTML='<table width="100%" id=""><tr><th>Codigo</th><th>Descripcion</th><th>Cantidad</th><th>Solictud</th><th></th></tr><tbody id="salida_bog_result"></tbody></table>';
                              }else{
                                document.getElementById('ocultotr').style.visibility='hidden';
                                document.getElementById('tabhidden').innerHTML='<table width="80%" id=""><tr bgcolor="#F2F2F2"><th class="center">CODIGO</th><th class="center">DESCRIPCION</th><th class="center">COLOR</th><th class="center">MEDIDA</th><th class="center">STOCK</th><th class="center">CANTIDAD</th><th class="center">PRECIO UNID</th><th class="center"></th></tr><tr bgcolor="#F2F2F2" id="hidden_add"><td><input type="text" id="coder" onclick="inv_mov_sald();"></td><td><input type="text" id="des" readonly></td><td><input type="text" id="col" readonly></td><td><input type="text" id="med" readonly></td><td><label><input type="text" id="stc" disabled></label></td><td><label><input type="text" id="can" onkeyup="verstc();"></label></td><td><input type="text" id="pre" readonly></td><td><button onclick="descarga_ubica();"><b>Añadir</b></button><img onclick="editar_tabhidden();" src="../../images/modificar.png"></td></tr><tbody id="mostrar_movi_salida"></tbody></table>';
                              }
                            }

                            function generar_prestamo(id) {
                              var pro=document.getElementById('CPRO'+id).value;
                              var cant=document.getElementById('CRS'+id).value;
                              var des=document.getElementById('DES'+id).value;
                              $("#salidas_bod_mod").modal();
                              document.getElementById('codp').value=pro;
                              document.getElementById('canp').value=cant;
                              document.getElementById('descp').value=des;
                              carga_tabla_ub(pro);
                            }

                            function carga_tabla_ub(pro) {
                              alert(pro);
                              $.ajax({
                                    type: 'POST',
                                    data: 'producto=' + pro + '&prest=1',
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#mostrar_ubi_pros").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                              });
                            }

                            function bajareserva(id) {
                              var pro=document.getElementById('codp').value;
                              var bodega_origen=document.getElementById('loc').value;
                              var bodega_destino=document.getElementById('loc2').value;
                              var cant=document.getElementById('desubi'+id).value;
                              var orden=document.getElementById('orden').value;
                               $.post("salidas_mov.php", {"generar_p":"1", "producto":pro,"bod_origen":bodega_origen,"bod_destino":bodega_destino,"cant":cant,"orden_pro":orden}, function(data){
                                          if (data.sucess == 1) {
                                             alert('Se realizo con exito');
                                           }else{
                                              alert('No pudo realizarse el prestamo');
                                           }
                                    },"json");

                            }
                            
                            puestos();

                            function puestos() {
                              $.ajax({
                                    type: 'POST',
                                    data: 'puesto=1',
                                    url: 'salidas_mov.php',
                                    success: function (d) {
                                        $("#puestot").html(d);
                                        if (d == 'error') {
                                            location.href = '../index.php';
                                        }
                                    }
                              });
                            }

                            function mirarvalues(value) {
                              var n1=parseInt(document.getElementById('canp').value);
                              var n2=parseInt(document.getElementById('desubi'+value).value);
                              var n3=parseInt(document.getElementById('desubican'+value).value);
                              if(n2>n1 || n2>n3){
                                alert(n1);
                                alert(n2);
                                document.getElementById('desubi'+value).value='';
                                alert('El valor es mas elevado a lo permitido');
                              }
                            }
                            </script>
                      <!-- MODAL PARA SALIDA NORMALES -->
                        <div class="modal fade" id="salida_inven_ubic" tabindex="-1" role="dialog" aria-labelledby="salida_inven_ubic">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="salida_inven_ubic"><i class='glyphicon glyphicon-edit'></i> Retirar Productos Del Inventario</h4>
                                  </div>
                                  <div class="modal-body" style="margin-bottom: 4%;">
                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Codigo</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="cod" name="cod" placeholder="Referencia del producto" readonly required>
                                         <input type="hidden" id="codid" name="codid" readonly required>
                                         <input type="hidden" id="refid" name="refid" readonly required>
                                      </div>
                                    </div><br><br>
                                     <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Descripcion</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="descb" name="descb" placeholder="Nombre producto" readonly required>
                                      </div>
                                    </div><br><br>

                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Cantidad Faltantes</label>
                                      <div class="col-sm-8">
                                         <input type="hidden" id="cant" name="cant" placeholder="Cantidad" readonly required>
                                        <input type="text" id="canf" name="canf" placeholder="Cantidad" readonly required>
                                      </div>
                                    </div><br><br>

                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Cantidad a descargar</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="candes" name="candes" placeholder="Cantidad" required><p id="resp"></p>
                                      </div>
                                    </div><br><br>

                                    
                                     <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Ubicacion</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="ubi" name="ubi" placeholder="Seleccione Ubicacion" onclick="buscarb();" required>
                                      </div>
                                    </div><br><br>
                                    <h5><b>Ubicaciones de este Producto:</b></h5>
                                    <table class="table table-hover">
                                        <tr class="bg-info">
                                            <th>CODIGO<b>(</b>PRO<b>)</b></th> 
                                            <th>UBICACION</th>
                                            <th>CANTIDAD</th>
                                            <th></th>
                                        </tr>
                                        <tbody id="mostrar_ubi_pro2">
                                        </tbody>
                                     </table><br><br>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="save_movs">Guardar datos</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                      <!-- FIN MODAL PARA SALIDA NORMAL -->

                    <!-- MODAL PARA SALIDAS PRESTAMOS ENTRE BODEGAS -->
                        <div class="modal fade" id="salidas_bod_mod" tabindex="-1" role="dialog" aria-labelledby="salidas_bod_mod">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                   <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="salidas_bod_mod"><i class='glyphicon glyphicon-edit'></i> Retirar Productos Del Inventario</h4>
                                  </div>
                                  <div class="modal-body" style="margin-bottom: 4%;">
                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Codigo</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="codp" name="cod" placeholder="Referencia del producto" readonly required>
                                      </div>
                                    </div><br><br>
                                     <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Descripcion</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="descp" name="descp" placeholder="Nombre producto" readonly required>
                                      </div>
                                    </div><br><br>

                                    <div class="form-group">
                                      <label for="codigo" class="col-sm-3 control-label">Cantidad</label>
                                      <div class="col-sm-8">
                                        <input type="text" id="canp" name="canp" placeholder="Cantidad" readonly required>
                                      </div>
                                    </div><br><br>

                                    <h5><b>Ubicaciones de este Producto:</b></h5>
                                    <table class="table table-hover">
                                        <tr class="bg-info">
                                            <th>CODIGO<b>(</b>PRO<b>)</b></th> 
                                            <th>UBICACION</th>
                                            <th>CANTIDAD</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        <tbody id="mostrar_ubi_pros">
                                        </tbody>
                                     </table><br><br>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary" id="save_movs">Guardar datos</button>
                                  </div>
                                </div>
                            </div>
                        </div>
                    <!-- FIN MODAL PARA SALIDAS POR PRESTAMOS ENTRE BODEGAS -->
    </body>
</html>
<?php
}
?>
