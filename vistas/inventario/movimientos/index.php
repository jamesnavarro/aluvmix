<?php
   include '../../../modelo/conexioni.php';
   include('../../../modelo/roles_user.php');
   session_start();
   if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
   $userk=$_SESSION['k_username'];
   $date= date("Y-m-d");
if($_GET['tipo']=='ENTRADA'){
    $tipomov = '01';
    $namemov = 'COMPRAS';
    $centro = '00030001';
    $namecentro = 'PLANTA BQUILLA';
}else{
    $tipomov = '57';
    $namemov = 'PRODUCCION';
    $centro = '';
    $namecentro = '';
}
?>
<!-- ESTADO EN PROCESO DE CREACION -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro </title>
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
        <script src="funciones.js?v=<?php echo rand(1, 999) ?>"></script>
        <script src="controlador.js?v=<?php echo rand(999, 1999) ?>"></script>
    </head>
    <body>
        <div>
            <h3>DOCUMENTO DE <?php echo $_GET['tipo'] ?></h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button"  id="Guardar" onclick="save_total();"><img src="../../images/save.png"> Guardar</button> 
                   <button onclick="inv_orden_compra('<?php echo $_GET['tipo'] ?>');"><img src="../../images/nuevo.png"   title="Nuevo Registro"> Nuevo</button>
                   <button  onclick="Imprimir();"><img src="../../images/printer.png" title="Imprimir Registro"> Imprimir</button>
                   <button onclick="salir();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>
<!--                   <button onclick="revertir();"><img src="../../images/up.jpg"  title="Salir del Formulario">Abrir</button> -->
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
                               <td>Tipo de Orden</td>
                               <td>
                                 <select id="typo" style="width: 100px">
                                   <option value="1">1.-Orden Bquilla</option>
                                   <option value="2">2.-Rep Bquilla</option>
                                   <option value="3">3.-Op Vidrio Galapa</option>
                                   <option value="4">4.-Orden Acero</option>
                                   <option value="5">5.-Externa Con Dsc</option>
                                   <option value="6">6.-Orden Galapa</option>
                                   <option value="7">7.-Rep. Galapa</option>
                                   <option value="8">8.-Externa Sin Dsc</option>
                                   <option value="9">9.-Ordenes</option>
                                 </select>
                               <?php if($_GET['tipo']=='ENTRADA'){ echo ' Orden de compra';}else{    echo '<a href="#" onclick="verop()">*</a>Orden de Producción'; } ?>
                               <input type="text" id="compra" style="width: 100px" onchange="ordenes()" autofocus><button onclick="comp_popup();" id="btnn_mov">00</button></td>
                               <td><?php if($_GET['tipo']=='ENTRADA'){ echo 'Remision N°.';}else{    echo 'No. Pedido'; } ?></td>
                               <td><input type="text" id="factura" style="width: 100px" ></td>
                               <td><input type="text" id="cedula" value="" disabled style="width: 130px" placeholder="NIT "></td>
                           </tr>
                           <tr>
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" onchange="busca_mov();" id="doc" style="width: 100px" value="<?php echo $tipomov ?>"><button onclick="inv_ti_mov_popup();" id="btn_mov">00</button>
                                   <input type="text" id="ndoc" style="width: 250px" disabled  value="<?php echo $namemov ?>"></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width:250px" value="" disabled> <span id="ebs"></span></td>
                               <td>Radicado
                                   <?php 
                                       //if($acces_user[33]=='1'){
                                       if($_SESSION['k_username']=='admin'){
                                       ?>
                                   <button onclick="fom_savemovimiento()" id="btnfom">F</button>
                                   <button onclick="fom_savemovimientocontabilizado()" id="btnfom">C</button>
                                   <?php } ?>
                               </td>
                               <td><input type="text" id="rad" style="width: 100px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" onchange="bus_cencost();" id="cc"  style="width: 100px"  value="<?php echo $centro ?>"><button onclick="inv_centro_costo_popup();" id="btn_cc">00</button> <input type="text" id="centro" style="width: 250px" disabled  value="<?php echo $namecentro ?>"></td>
                               <td>SEDE</td>
                               <td><input type="text" id="sede" style="width: 100px" disabled></td>
                               <td><font color="red">Documento Fom</font></td>
                               <td><input type="text" id="docfom" style="width: 100px" ></td>
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" style="width: 100%" ></td>
                           </tr>
                           
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 100px" value="<?php echo $_SESSION['alm'] ?>"><input type="text" onchange="bus_bodega();" id="loc" style="width: 100px"><button onclick="inv_bodega_popup();" id="btn_bod">00</button>  <input type="text" id="nloc" style="width: 250px" disabled></td>
                               
                               <td>Valor Total </td>
                               <td><input type="number" id="totalx" style="width: 100px" ></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="0" disabled style="width: 30px" > <input type="text" id="estado" value="En proceso" disabled style="width: 100px" ></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                              <td><input type="text" onchange="bus_ter();" id="nombrepro" style="width: 100px" value="800112904-6"><button onclick="inv_tercero_popup();" id="btn_ter">00</button> 
                               <input type="text" id="nterc" style="width: 250px" disabled value="TEMPLADO S A"></td>
                               
                               <td>Diferencia</td>
                               <td><input type="number" id="diferencia" style="width: 100px" disabled></td>
                               
                               <td>Registrado Por:</td>
                               <td><input type="text" id="por" style="width: 80px" value="" disabled></td>
                           </tr>  
                           <tr>
                              <td></td>
                               <td></td>
                               <td>Descarga Inv.</td>
                               <td><input type="text" id="descarga" style="width: 80px" disabled value="<?php echo $_GET['tipo'] ?>"></td>
                               <td></td>
                               <td><button type="button" id="continuar" onclick="continuar();"><img src="../../images/play.png"> Continuar</button></td>
                           </tr> 
                       </table>
                       <table width="100%">
                           <tr bgcolor="#F2F2F2">
                               <th style="width: 90px">CODIGO</th>
                               <th>DESCRIPCION</th>
                               <th style="width: 150px">COLOR</th>
                               <th style="width: 90px">MEDIDA</th>
                               <th style="width: 70px">STOCK</th>
                               <th style="width: 70px">CANTIDAD</th>
                               <th title="Cantidades pendientes por ubicacion" style="width: 80px">PENDIENTE</th>
                               <th style="width:100px">PRECIO UNID</th>
                               <th style="width: 100px">TOTAL</th>
                               <th>AÑADIR</th>
                           </tr>
                           
                           <tr>
                               <td><input type="hidden" id="id_proadd" placeholder="" class="col-xs-4 col-sm-4" style="width: 100%" disabled>
                                   <input type="text" id="coder" onclick="inv_mov_sald('<?php echo $_GET['tipo'] ?>');" style="width: 100%"></td>
                               <td><input type="text" id="des" readonly style="width: 100%"></td>
                               <td><input type="text" id="col" readonly style="width: 100%"></td>
                               <td><input type="text" id="med" readonly style="width: 100%"></td>
                               <td><input type="text" id="stc"  style="width: 100%" disabled></td>
                               <td><input type="text" id="can" style="width: 100%" onchange="calculo_total()"></td>
                               <td><input type="text" id="canp" readonly style="width: 100%"></td>
                               <td><input type="text" id="pre"  style="width: 100%" onchange="calculo_total()"></td>
                               <td><input type="text" id="pret" style="width: 100%" disabled></td>
                               <td><button onclick="add_pro();" id="additem"><b>Agregar</b></button></td>
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
            $(document).ready(function(){
                $("#save_mov").click(function(){
                   save_mod_ubi();
                });
              });

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
            var es = $("#estado").val();
            if(es=='Guardado'){
             $('<form action="../reportes/imprimir_resporte_mov.php" method="post" target="_blank"><input type="hidden" name="id_mov" value="'+x+'"/></form>')
              .appendTo('body').submit();
            }else{
                alert("El documento debe estar guardado.");
            }
            }
        </script>
      <div class="modal fade" id="inventario_send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar Productos a Inventario x ubicacion</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Codigo</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="cod" name="cod" placeholder="Referencia del producto" readonly required>
                      <input type="hidden" id="codid" name="codid" readonly required>
                    </div>
                  </div><br><br>
                   <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-8">
                      <input type="text"   id="descri" name="des" placeholder="Nombre producto" readonly required>
                      
                      <input type="hidden" id="col" name="col">
                      <input type="hidden" id="movi" name="movi">
                      <input type="hidden" id="preu" name="preu">
                      <input type="text" id="colo" name="colo">
                    </div>
                  </div><br><br>
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Cantidad</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="cant" name="cant" placeholder="Cantidad Pediente" readonly required>
                    <input type="text" id="medu" name="medu" disabled>
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
        
        <div class="modal fade" id="inventario_sal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Salida de Productos x Ubicacion</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                    relacion:<input type="text" id="idre" disabled>
                    <table class="table table-hover">
                        <tr>
                            <th>CODIGO(PRO)</th> 
                            <th>DESCRIPCION</th>
                            <th>UBICACION</th>
                            <th>CANTIDAD</th>
                            <th>SALIDA</th>
                            <th>OPCIONES</th>
                        </tr>
                        <tbody id="mostrar_cantidad">
                            
                        </tbody>
                    </table>
                    <hr><br><br>
                  <table class="table table-hover">
                    <tr class="bg-info">
                        <th>CODIGO(PRO)</th> 
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                    </tr>
                   <tbody id="mostrar_ubi_pro_sal">
                   </tbody>
            </table><br><br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
                </div>
              </div>
          </div>
      </div>
      <script type="text/javascript">
          var id='<?php echo $_POST['id'];?>';
          sacarinfo3(id);
         
        </script>
    </body>
</html>