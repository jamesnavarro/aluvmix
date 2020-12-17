<?php
   include '../../../modelo/conexionv1.php';
   session_start();
   if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
   $userk=$_SESSION['k_username'];
   $date= date("Y-m-d");
  
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
        <script src="funciones.js?ve=<?php echo rand(1000, 1100) ?>"></script>
    </head>
    <body>
        <div>
            <h3>Mantenimiento de Pedido</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button"  id="Guardar" onclick="anular_pedido();"><img src="../../images/verficar.png" style="height: 32px">1. Anular Pedido Monty</button>
                   <button type="button"  id="GuardarFom"  onclick="update_fom();"><img src="../../images/save.png">2. Editar pedido Fom</button>
                   
                   <button  onclick="ImprimirPedido();"><img src="../../images/printer.png" title="Imprimir Registro"> Imprimir</button>
<!--                   <button onclick="anul_c();"><img src="../../images/eliminar.png"  title="Salir del Formulario">Anular</button>-->
                   <button onclick="salir();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>
<!--                   <button onclick="pedidofom();"><img src="../../images/up.jpg"  title="Salir del Formulario">Ver</button> -->
                   <span id="e"></span>
               </div>
               <div id=""  style="float:right"> 
                  Numero de Cotizacion: <input type="text" id="numcot" style="width: 100px" value="" disabled>
                 |Id
                   <input type="text" id="cot" style="width: 100px" value="<?php echo $_GET['cot'] ?>" disabled>
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
                               <td>Tipo de pedido</td>
                               <td>
                                 <select id="tipo" style="width: 100px" disabled>
                                   <option value="1">1.-Pedido</option>
                                   <option value="2">2.-Cotizacion</option>
                                   <option value="3">3.-Consignacion</option>
                                   <option value="4">4.-Pedido Bquilla</option>
                                   <option value="5">5.-Pedido Suc</option>
                                   <option value="6">6.-Exportacion</option>
                                   <option value="">Seleccione</option>
                                 </select>
                               </td>
                               <td>No. Pedido</td>
                               <td><input type="text" id="pedido" disabled style="width: 100px" ></td>
                               <td>Fecha de Registro</td>
                               <td><input type="text" id="fecha" value="<?php echo date("Y-m-d") ?>" disabled style="width: 130px" placeholder=""></td>
                           </tr>
                           <tr>
                                <td>Tercero</td>
                              <td><input type="text" disabled onchange="validar_tercero(this.value);" id="nombrepro" style="width: 100px" value=""><button onclick="inv_tercero_popup(0);" id="btn_ter">00</button> 
                               <input type="text" id="nterc" style="width: 250px" disabled value=""></td>
                               <td>Direccion</td>
                               <td><input type="text" id="direccion" style="width:250px" value=""> <span id="ebs"></span></td>
                               <td>Ciudad<input type="text" id="ciu" style="width: 70px" value="" disabled></td>
                               <td><input type="text" id="ciudad" style="width: 130px" value="" disabled></td>
                           </tr>
                            <tr>
                                
                              <td>Tipo de Cuenta</td>
                              <td><input type="text" disabled onchange="consultar_cuenta(this.value);" id="codcue" style="width: 100px" value="00">
                                  <button id="btn_ter" disabled>00</button> 
                               <input type="text" id="nomcue" style="width: 250px" disabled value="VENTAS DE CONTADO"></td>
                               
                               
                               
                               <td></td>
                               <td></td>
                               <td>Sucursal</td>
                               <td><input type="text" id="sucursal" disabled style="width: 130px" value="" onclick="sucursales()"></td>
                           </tr>  
                           <tr>
                               <td>Almacen:</td> 
                               <td><input type="text" id="codalm" disabled style="width: 100px"  onchange="bus_almacen();" value="">
                                   <button onclick="inv_bodega_popup();" id="btn_bod">00</button> 
                                   <input type="text" id="nomalm" style="width: 250px" disabled></td>
                               
                               <td>Transportador </td>
                               <td><input type="text" id="tran" disabled style="width: 100px" value="0001">
                                   <input type="text" id="nomtran" style="width: 150px" disabled value="LOCAL"> </td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="0" disabled style="width: 100px" ></td>
                        
                           </tr>
                           <tr>
                                
                               <td>Centro de Costo:</td>
                               <td><input type="text" onchange="bus_cencost();" id="cc"  style="width: 100px"  value="<?php echo $centro ?>"><button onclick="inv_centro_costo_popup();" id="btn_cc">00</button>
                                   <input type="text" id="centro" style="width: 250px" disabled  value=""></td>
                               <td>Vendedor id</td>
                               <td><input type="text" id="idven" style="width: 100px" onclick="vendedores()">
                               <input type="text" id="por" style="width: 150px" value="" disabled></td>
                               
                               <td>Registrado por</td>
                               <td><input type="text" id="PED_CODOPE" value="" disabled></td>
                           </tr>  
                           <tr>
                                
                               <td>Observaciones:</td>
                               <td colspan="7"><input type="text" id="obs"  style="width: 100%"  value="" onchange="uppedido()"></td>
                              
                           </tr>
                            
                       </table>
                       <table width="100%">
                           <tr bgcolor="#F2F2F2">
                               <th style="width: 5px"></th>
                               <th style="width: 90px">REFERENCIA</th>
                               <th>DESCRIPCION</th>
                               <th style="width: 100px">UND</th>
                               <th style="width: 120px">MEDIDA</th>
                               <th style="width: 100px">COLOR</th>
                               <th style="width: 50px">CANT</th>
                               <th style="width:80px">PRECIO UNID</th>
                               <th style="width: 80px">TOTAL</th>
<!--                               <th>OBSERVACIONES</th>-->
                               <th style="width: 10px"></th>
                           </tr>
                           
                          <tbody id="mostrar_moviemientos">
                          </tbody>
                       </table>
                           <br><hr>
                             <div><p id="msg">Cargando...</p></div>
                   </div>
                   Historia de modificaciones:
                   <span id="modificaciones"></span>
               </div>
                </div>
<!--                <button onclick="updatepedidofom()">Up</button>-->
                <input type="hidden" id="PED_TIPPED" value=""> <br>
                <input type="hidden" id="PED_NUMPED" value=""> <br>
                <input type="hidden" id="PED_CIUDAD" value=""> <br>
                <input type="hidden" id="PED_CEDULA" value=""> <br>
                <input type="hidden" id="PED_CEDCON" value=""> <br>
                <input type="hidden" id="PED_FECPED" value=""> <br>
                <input type="hidden" id="PED_FECINI" value=""> <br>
                <input type="hidden" id="PED_FECVEN" value=""> <br>
                <input type="hidden" id="PED_ORDCOM" value=""> <br>
                <input type="hidden" id="PED_AGENTE" value=""> <br>
                <input type="hidden" id="PED_DESPP" value=""> <br>
                <input type="hidden" id="PED_DESPF" value=""> <br>
                <input type="hidden" id="PED_PLAZO" value=""> <br>
                <input type="hidden" id="PED_VENDED" value=""> <br>
                <input type="hidden" id="PED_TIPCLI" value=""> <br>
                <input type="hidden" id="PED_LISPRE" value=""> <br>
                <input type="hidden" id="PED_TIPCTA" value=""> <br>
                <input type="hidden" id="PED_TIPNOT" value=""> <br>
                <input type="hidden" id="PED_VALFLE" value=""> <br>
                <input type="hidden" id="PED_VALSEG" value=""> <br>
                <input type="hidden" id="PED_TASARM" value=""> <br>
                <input type="hidden" id="PED_MONEDA" value=""> <br>
                <input type="hidden" id="PED_BODEGA" value=""> <br>
                <input type="hidden" id="PED_ALMCON" value=""> <br>
                <input type="hidden" id="PED_CODSEC" value=""> <br>
                <input type="hidden" id="PED_CODTRA" value=""> <br>
                <input type="hidden" id="PED_OBSERV" value=""> <br>
                <input type="hidden" id="PED_OBSADI" value=""> <br>
                <input type="hidden" id="PED_DIRENV" value=""> <br>
                <input type="hidden" id="PED_ESTREG" value=""> <br>
                <input type="hidden" id="PED_ACTIVO" value=""> <br>
                <input type="hidden" id="PED_CIERRE" value=""> <br>
                <input type="hidden" id="PED_ESTADO" value=""> <br>
                <input type="hidden" id="PED_COPIAS" value=""> <br>
                <input type="hidden" id="PED_NOMEMP" value=""> <br>
                <input type="hidden" id="PED_VERSIO" value=""> <br>
                <input type="hidden" id="PED_EQUIPO" value=""> <br>
                <input type="hidden" id="PED_CODOPE" value=""> <br>
                <input type="hidden" id="PED_FECOPE" value=""> <br>
                <input type="hidden" id="PED_USUARIO" value=""> <br>
                <input type="hidden" id="PED_PROREG" value=""> <br>
                <input type="hidden" id="PED_SECTOR" value=""> <br>
                <input type="hidden" id="PED_NUMREQ" value=""> <br>
                <input type="hidden" id="PED_TIPREQ" value=""> <br>
                <input type="hidden" id="PED_TIPOPE" value=""> <br>
                <input type="hidden" id="PED_CEDREF" value=""> <br>
                <input type="hidden" id="PED_NUMEVE" value=""> <br>
                <input type="hidden" id="PED_VALPED" value=""> <br>
                <input type="hidden" id="PED_TIPINV" value=""> <br>
                <input type="hidden" id="PED_PREFIJ" value=""> <br>
                <input type="hidden" id="PED_OBSINT" value=""> <br>
                <input type="hidden" id="PED_FECAUT" value=""> <br>
                <input type="hidden" id="PED_PORIMP" value=""> <br>
                <input type="hidden" id="PED_PORADM" value=""> <br>
                <input type="hidden" id="PED_CODCLI" value=""> <br>
                <input type="hidden" id="PED_FECENT" value=""> <br>
                <input type="hidden" id="PED_CONENT" value=""> <br>
                <input type="hidden" id="PED_TIPANT" value=""> <br>
                <input type="hidden" id="PED_PREANT" value=""> <br>
                <input type="hidden" id="PED_NUMANT" value=""> <br>
                <input type="hidden" id="PED_FECANT" value=""> <br>
                <input type="hidden" id="PED_VALANT" value=""> <br>
                <input type="hidden" id="PED_AUTCOS" value=""> <br>
                <input type="hidden" id="PED_CONREQ" value=""> <br>
                <input type="hidden" id="PED_SOLANT" value=""> <br>
                <input type="hidden" id="PED_FECCOS" value=""> <br>
                <input type="hidden" id="PED_USUCOS" value=""> <br>
                <input type="hidden" id="PED_USUSOL" value=""> <br>
                <input type="hidden" id="PED_FECSOL" value=""> <br>
                <input type="hidden" id="PED_NUMCON" value=""> <br>
                <input type="hidden" id="PED_CONPRO" value=""> <br>
                <input type="hidden" id="PED_FECORD" value=""> <br>
                <input type="hidden" id="PED_CODICA" value=""> <br>
                </fieldset>

            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
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
                      <input type="hidden" id="med" name="med">
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
          var id='<?php echo $_GET['cot'];?>';
          var lin='<?php echo $_GET['linea'];?>';
          mostrar_cotizacion(id,lin);
        </script>
    </body>
</html>
<div id="modalfom" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buscar Productos en FomPlus <input type="hidden" style="width:100%" id="contador" disabled></h4>
      </div>
      <div class="modal-body">
          <table style="width:100%">
              <tr>
                  <th>REFERENCIA</th>
                  <th>DESCRIPCION</th>
              </tr>
              <tr>
                  <th colspan="2"><input type="text" style="width:100%" id="fom_cod" onkeyup="buscarptfon(1)" placeholder="Buscar por PT ó Descripcion"></th>
                 
              </tr>
              <tbody id="productos_fom">
                  <tr>
                      <td colspan="2">Sin Registros..</td>
                 
              </tr>
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>