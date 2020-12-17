<?php
   //include '../../../modelo/conexioni.php';
   //include('../../../modelo/roles_user.php');
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
            <h3>ORDEN DE PRODUCCION <?php echo $_GET['num'] ?></h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button"  id="Guardar" class="btn-info" onclick="save_total();"><img src="../../images/save.png"> Guardar y mandar a produccir</button> 
                
                   <button  onclick="openop();"><img src="../../images/modificar.png" style="width:30px"> Abrir OP</button>
                   
                   <button onclick="anularop();"><img src="../../images/warning.png"  style="width:30px">Anular OP</button> 
                   <?php if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='aguerrero'|| $_SESSION['k_username']=='AGUERRERO'){
                                    ?>
                   <button onclick="medidas()" title="Autorizadores: AGUERRERO, ADMIN"><img src="../../images/open.png" style="width:30px"> Autorizar Medidas</button>
                                <?php } ?>
                   <button onclick="window.close();"><img src="../../images/salir.png" > Salir</button>
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
                                 <select id="typo" style="width: 100px" disabled>
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
                               <input type="text" id="compra" disabled style="width: 100px" onchange="ordenes()" autofocus><button onclick="comp_popup();" id="btnn_mov">00</button></td>
                               <td><?php if($_GET['tipo']=='ENTRADA'){ echo 'Remision N°.';}else{    echo 'No. Pedido'; } ?></td>
                               <td><input type="text" id="factura" style="width: 100px" disabled></td>
                               <td><input type="text" id="cedula" value="" disabled style="width: 130px" placeholder="NIT "></td>
                           </tr>
                           <tr>
                         
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width:250px" value="" disabled> <span id="ebs"></span></td>
                               <td>Radicado Orden Monty
                                   
                               </td>
                               <td><input type="text" id="rad" style="width: 100px" value="" disabled><input type="hidden" id="radicado" style="width: 80px" disabled>
                               </td>
                                <td><input type="text" id="idcot" style="width: 60px" disabled>
                                    <input type="text" id="idorden" style="width: 60px" disabled>
                               </td>
                           </tr>
 
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" disabled style="width: 100%" ></td>
                           </tr>
                           
                          
                           <tr>
                                
                              <td>Tercero</td>
                              <td><input type="text" onchange="bus_ter();" disabled id="nombrepro" style="width: 100px" value="800112904-6"><button onclick="inv_tercero_popup();" id="btn_ter">00</button> 
                               <input type="text" id="nterc" style="width: 250px" disabled value="TEMPLADO S A"></td>
                 
                               
                               <td>Registrado Por:</td>
                               <td><input type="text" id="por" style="width: 80px" value="" disabled></td>
                               <td>
                                   <select id="est" disabled>
                                       <option value="0">En proceso</option>
                                       <option value="1">En produccion</option>
                                       <option value="2">Anulado</option>
                                   </select></td>
                           </tr>  
                          
                       </table>
                       <table width="100%">
                           <tr  class="bg-primary">
                               <th style="width: 70px">PT</th>
                               <th style="width: 90px">CODIGO</th>
                               <th>DESCRIPCION</th>
                               <th style="width: 150px">COLOR</th>
                               <th style="width: 50px">PER</th>
                               <th style="width: 50px">BOQ</th>
                               <th style="width: 90px">MEDIDA</th>
                               <th style="width: 50px">UNDMED</th>
                               <th style="width: 70px">CAN PED</th>
                               
                               <th style="width:70px">CAN PRO</th>
                               <th style="width: 70px">CAN PEN</th>
             
                               <th>AÑADIR</th>
                           </tr>
                        
                          <tbody id="mostrar_moviemientos">
                          </tbody>
                          <tr>
                              <td colspan="11"><div class="alert alert-success" role="alert">
  Sticker Generado
</div> <span id="msj"></span></td>
                          </tr>
                          
                       </table>
                           <hr>
                           <div align="right">
                             
                               <button  onclick="stiker_all()"><img src="../../images/barcode.png" style="width:20px">COP Primarios</button>
                               <button  onclick="stiker_all2()"><img src="../../images/barcode.png" style="width:20px">COP Secundario</button>
                                                           <button  onclick="stiker_all_usd()"><img src="../../images/barcode.png" style="width:20px">USD Primarios</button>
                                                         <!--    <button style="cursor:not-allowed;" disabled onclick="stiker_all2(<?php echo $_GET['op'].','.$_GET["cot"].','.$opf.','.$reposicion; ?>)"><img src="../imagenes/print.png">Imprimir Stikers Segundarios</button>-->
                               <button id="eliminar" onclick="anularpri()"><img src="../../images/delect.png" >Eliminar Principal</button> &nbsp;
<!--                                                            <button style="cursor:not-allowed;" disabled id="eliminarv" style="float:right"><img src="../../../images/cancelar.png">Eliminar Segundarios</button>-->
                           </div>
                           <table class="table table-hover">
                        <tr class="bg-primary">
                          <th>ITEM</th> 
                          <th>DISEÑO</th> 
                          <th>TIPO</th> 
                          <th>DESCRIPCION</th>
                          <th>UBICACION</th>
                          <th>PER</th>
                          <th>BOQ</th>
                          <th>ANCHO DEL PRODUCTO</th>
                          <th>ALTO DEL PRODUCTO</th>
                          <th>ESP</th>
                          <th>CAN</th>
                          <th>STK</th>
                          <th><input name="selectAll" onchange="selectAll(0,this)" type="checkbox">Anular</th>
                        </tr>
                        <tbody id="mostrar_ingresados">
                            
                        </tbody>
            </table>
                   </div>
               </div>
                </div>
                </fieldset>

            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>
        
       
      <div class="modal fade" id="ModalSticker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Generar Sticker PT <input type="text" id="pt" name="codid" readonly required  style="width: 70px"> Item: <input type="text" id="tip"  style="width: 70px" name="codid" ></h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Diseño</label>
                    <div class="col-sm-8">
                         <input type="text" class="auto" id="id_r"  placeholder="Referencia del producto" readonly required>
                      <input type="text" class="auto" id="ord" name="cod" placeholder="Referencia del producto" readonly required>
                      <input type="hidden" class="auto" id="caja" >
                      <select id="lado">
                          <option value="Derecho">Derecho</option>
                          <option value="Izquierdo">Izquierdo</option>
                          <option value="N/A">No Aplica</option>
                      </select>
                      
                    </div>
                  </div>
                   <div class="form-group">
                        <label for="codigo" class="col-sm-3 control-label">Ubic| Obs</label>
                    <div class="col-sm-8">
                        <input type="text"   id="obs1" name="des" placeholder="Ubicacion">
                      <input type="text" id="obs2" name="colo" placeholder="Observaciones 2">
                    </div>
                  </div>
                    <div class="form-group">
                        <label for="codigo" class="col-sm-3 control-label">Per | Boq</label>
                    <div class="col-sm-8">
                        <input type="text"   id="per" name="des" >
                        <input type="text" id="boq" name="colo" placeholder="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Ancho</label>
                    <div class="col-sm-8">
                        <input type="text" class="auto" id="ancho1" style="width: 70px">
                      <input type="text" class="hidden" id="anchohid">
                      <input type="text" class="hidden" id="anchocomp">
                      i<input type="text" class="auto" id="anchod" value="0"  style="width: 70px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Alto</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="alto1" style="width: 70px">
              
                      <input type="hidden" class="auto" id="altohid">
                      i<input type="text" class="auto" id="altod" value="0"  style="width: 70px">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Cantidad</label>
                    <div class="col-sm-8">
                        <input type="text" class="auto" id="cant" name="cant">
                        <input type="hidden" class="auto" id="cantid" name="cant">
                      
                    </div>
                  </div>
                  <br><br>
                  
                  

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="addstk" onclick="add_orden()">Crear Sticker</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
          </div>
      </div>
        
        <div class="modal fade" id="ModalDescomponer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Descomponer Vidrios</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                    relacion:<input type="text" id="idre" disabled>
                    <table class="table table-hover">
                        <tr>
                            <th>CODIGO(PRO)</th> 
                            <th>DESCRIPCION</th>
                            <th>COLOR</th>
                            <th>UBICACION</th>
                            <th>Ancho</th>
                            <th>Alto</th>
                            <th>M2</th>
                            <th>CANT</th>
                            <th>Mas</th>

                        </tr>
                        <tbody id="mostrar_cantidad">
                            
                        </tbody>
                    </table>
                    <hr><br><br>
                 
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
                </div>
              </div>
          </div>
      </div>
      <script type="text/javascript">
          var mov='<?php echo $_GET['tipo'];?>';
          var num='<?php echo $_GET['num'];?>';
           consultar_enc(mov,num);
         
        </script>
    </body>
</html>