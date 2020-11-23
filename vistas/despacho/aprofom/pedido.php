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
        <script src="funciones.js?v=<?php echo rand(1, 999) ?>"></script>
    </head>
    <body>
        <div>
            <h3>Orden de Pedido</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button"  id="Guardar" onclick="save_total();"><img src="../../images/verficar.png" style="height: 32px">1. Aprobar</button>
                   <button type="button"  id="GuardarFom"  onclick="save_fom();"><img src="../../images/save.png">2. Guardar en FomPlus</button>
                   
                   <button  onclick="ImprimirPedido();"><img src="../../images/printer.png" title="Imprimir Registro"> Imprimir</button>
                   <button onclick="anul_p();"><img src="../../images/eliminar.png"  title="Salir del Formulario">Anular</button>
                   <button onclick="salir();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>
<!--                   <button onclick="revertir();"><img src="../../images/up.jpg"  title="Salir del Formulario">Abrir</button> -->
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
                                 <select id="tipo" style="width: 100px">
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
                              <td><input type="text" onchange="validar_tercero(this.value);" id="nombrepro" style="width: 100px" value=""><button onclick="inv_tercero_popup(0);" id="btn_ter">00</button> 
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
                               <td><input type="text" id="sucursal" style="width: 130px" value="" onclick="sucursales()"></td>
                           </tr>  
                           <tr>
                               <td>Almacen:</td> 
                               <td><input type="text" id="codalm" style="width: 100px"  onchange="bus_almacen();" value="">
                                   <button onclick="inv_bodega_popup();" id="btn_bod">00</button> 
                                   <input type="text" id="nomalm" style="width: 250px" disabled></td>
                               
                               <td>Transportador </td>
                               <td><input type="text" id="tran" style="width: 100px" value="0001">
                                   <input type="text" id="nomtran" style="width: 150px" disabled value="LOCAL"> </td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="0" disabled style="width: 100px" ></td>
                        
                           </tr>
                           <tr>
                                
                               <td>Centro de Costo:</td>
                               <td><input type="text" onchange="bus_cencost();" id="cc"  style="width: 100px"  value="<?php echo $centro ?>"><button onclick="inv_centro_costo_popup();" id="btn_cc">00</button>
                                   <input type="text" id="centro" style="width: 250px" disabled  value=""></td>
                               <td>Vendedor id</td>
                               <td><input type="text" id="idven" style="width: 100px" disabled>
                               <input type="text" id="por" style="width: 150px" value="" disabled></td>
                               
                               <td>Consultar en Fom</td>
                               <td></td>
                           </tr>  
                           <tr>
                                
                               <td>Observaciones:</td>
                               <td colspan="7"><input type="text" id="obs"  style="width: 100%"  value=""></td>
                              
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
                   </div>
               </div>
                </div>
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