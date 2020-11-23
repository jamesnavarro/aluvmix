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
            <h3>DOCUMENTO DE <?php echo $_GET['tipo'] ?></h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   <button type="button"  id="Guardar" onclick="save_total();"><img src="../../images/save.png"> Guardar</button> 
                   <button onclick="inv_orden_compra('<?php echo $_GET['tipo'] ?>');"><img src="../../images/nuevo.png"   title="Nuevo Registro"> Nuevo</button>
                   <button  onclick="Imprimir();"><img src="../../images/printer.png" title="Imprimir Registro"> Imprimir</button>
                   <button onclick="window.close();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>
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
                               <td>Tipo Movimiento:</td>
                               <td><input type="text" onchange="busca_mov();" disabled id="doc" style="width: 100px" value="<?php echo $tipomov ?>"><button onclick="inv_ti_mov_popup();" id="btn_mov">00</button>
                                   <input type="text" id="ndoc" style="width: 250px" disabled  value="<?php echo $namemov ?>"></td>
                               <td>Fecha</td>
                               <td><input type="text" id="FecReg" style="width:250px" value="" disabled> <span id="ebs"></span></td>
                               <td>Radicado
                                   <?php 
                                       //if($acces_user[33]=='1'){
                                       if($_SESSION['k_username']=='admin'){
                                       ?>
                                   <button onclick="verificaritem()" id="btnfom">F</button>
                                  
                                   <?php } ?>
                               </td>
                               <td><input type="text" id="rad" style="width: 100px" value="<?php echo $_POST['id'];?>" disabled><input type="hidden" id="radicado" style="width: 80px" disabled></td>
                           </tr>
                           <tr>
                               <td>Centro de Costo:</td>
                               <td><input type="text" onchange="bus_cencost();" disabled id="cc"  style="width: 100px"  value="<?php echo $centro ?>"><button onclick="inv_centro_costo_popup();" id="btn_cc">00</button> <input type="text" id="centro" style="width: 250px" disabled  value="<?php echo $namecentro ?>"></td>
                               <td>SEDE</td>
                               <td><input type="text" id="sede" style="width: 100px" disabled></td>
                               <td><font color="red">Documento Fom</font></td>
                               <td><input type="text" id="docfom" disabled style="width: 100px" ></td>
                           </tr>
                           <tr>
                               <td>Observaciones</td>
                               <td colspan="5"><input type="text" id="obs" disabled style="width: 100%" ></td>
                           </tr>
                           
                           <tr>
                               <td>Bodega:</td> 
                               <td><input type="hidden" id="almori" style="width: 100px" value="<?php echo $_SESSION['alm'] ?>">
                                   <input type="text" onchange="bus_bodega();" id="loc" style="width: 100px"><button onclick="inv_bodega_popup();" id="btn_bod">00</button>  <input type="text" id="nloc" style="width: 250px" disabled></td>
                               
                               <td>Valor Total </td>
                               <td><input type="number" id="totalx" disabled style="width: 100px" ></td>
                               <td>Estado</td>
                               <td><input type="text" id="est" value="0" disabled style="width: 30px" > <input type="text" id="estado" value="En proceso" disabled style="width: 100px" ></td>
                        
                           </tr>
                           <tr>
                                
                              <td>Tercero</td>
                              <td><input type="text" onchange="bus_ter();" disabled id="nombrepro" style="width: 100px" value="800112904-6"><button onclick="inv_tercero_popup();" id="btn_ter">00</button> 
                               <input type="text" id="nterc" style="width: 250px" disabled value="TEMPLADO S A"></td>
                               
                               <td>Diferencia</td>
                               <td><input type="number" id="diferencia" style="width: 100px" disabled></td>
                               
                               <td>Registrado Por:</td>
                               <td><input type="text" id="por" style="width: 80px" value="" disabled></td>
                           </tr>  
                           <tr>
                              <td>Puesto Trabajo</td>
                                      <td>
                                          <select id="puesto" onclick="pla_aprofom()">
                                              <option value="0">Seleccione*</option>
                                              <?php
                                                include '../../../modelo/conexion.php';
                                                $query = mysqli_query($conexion,"select * from puestos  ");
                                                while ($row = mysqli_fetch_array($query)) {
                                                    echo '<option value="'.$row[0].'">'.$row[0].' - '.$row[3].' '.$row['sede'].'</option>';  
                                                }
                                                ?>
                                  </select></td>   
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
             
                               <th style="width: 70px">CANTIDAD</th>
                               
                               <th style="width:100px">PRECIO UNID</th>
                               <th style="width: 100px">TOTAL</th>
                               <th title="Cantidades pendientes por ubicacion" style="width: 80px">PendUbic</th>
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
        
       
      <div class="modal fade" id="inventario_send" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Salida de Productos x Ubicacion</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                  <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Codigo</label>
                    <div class="col-sm-8">
                      <input type="text" class="auto" id="cod" name="cod" placeholder="Referencia del producto" readonly required>
                      <input type="text" id="codid" name="codid" readonly required>
                    </div>
                  </div><br><br>
                   <div class="form-group">
                    <label for="codigo" class="col-sm-3 control-label">Descripcion</label>
                    <div class="col-sm-8">
                      <input type="text"   id="descri" name="des" placeholder="Nombre producto" readonly required>
                      <input type="hidden" id="med" name="med">
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
                  
                  <table class="table table-hover">
                    <tr class="bg-info">
                      <th>CODIGO(PRO)</th> 
                      <th>COLOR</th>
                      <th>UBICACION</th>
                      <th>CAN DISPONIBLE</th>
                      <th>CAN INGRESAR</th>
                      <th>Agregar</th>
                    </tr>
                        <tbody id="mostrar_ubi_pro">
                        </tbody>
            </table><br><br>
            <b>PRODUCTOS INGRESADOS</b>
            <table class="table table-hover">
                
                    <tr class="bg-info">
                        <th>CODIGO(PRO)</th> 
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                    </tr>
                   <tbody id="mostrar_ingresado">
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
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>  Agregar Productos a Inventario x ubicacion</h4>
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
          var mov='<?php echo $_GET['mov'];?>';
          var num='<?php echo $_GET['num'];?>';
           consultar_enc(mov,num);
         
        </script>
    </body>
</html>