
<?php
include '../../../modelo/conexioni.php';
 session_start();
  if(!isset($_SESSION['k_username'])){  
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>
<script src="../vistas/compras/gestion_time/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="panel panel-info"> 
    <span id="listo"></span> | 
    <button onclick="AnularSol()" class="btn btn-info btn-sm" id="anular"><i class="ace-icon fa fa-eraser"></i>Anular Solicitud</button>
<button type="button" class="btn btn-info btn-sm" onclick="pdf()"> <img src="../imagenes/print.png" width="15px"/></button>
		<div class="panel-body">
      <div class="container" >
          <div id="contex">
              <input type="hidden" id="solicitd">
              <input type="hidden" id="idorden" placeholder="" class="col-xs-10 col-sm-9" disabled />
            <div style="width: 40%;float: left;">
            <b>No. Solicitud: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="nsol"></label></b><br>
            <b>No. Consecutivo: <label style="color: red;margin-left: 2%;font-weight: bold;" id="ncon"></label></b><br>
            <b>Fecha de creación: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="fecc"></label></b><br>
            <b>Area: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="areas"></label></b><br>
            <b>Fecha de entrega: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="fece"></label></b><br>
            <b>Relacion: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="rel"></label></b><br>
            </div>
          <div style="width: 40%;float: left;">
            <b>Creado por: <label style="color: #438EB9;margin-left: 2%;font-weight: bold;" id="crp"></label></b><br>
            <b>Estado: <input type="text" id="est" disabled><br>
            <b>Aprobado por: <label style="color: red;margin-left: 2%;font-weight: bold;" id="aprove"></label></b><br>
            <b>Autoriza: <select id="por">
                                            <option value="">Seleccione</option>
                                            <?php
                                            $resu = mysqli_query($con,"select * from usuarios where estado='Activo' and usuario in ('Jpardey','LPARDEY','STEPHANIE PARDEY','grueda','LCORDERO','AALVAREZ','MGUTIERREZ','OMAR.VILLA','JFERRER','jorge.hurtado','melida.m','carlos.s') ");
                                            while($r = mysqli_fetch_array($resu)){
                                                echo '<option value="'.$r[1].'">'.$r[7].' '.$r[8].'</option>';
                                            }
                                            
                                            ?> 
                                        </select></b>
            <br>
            <span id="archivo"></span>
            <b></b>
            
          </div>
          </div>
          
            <div style="width: 20%;float: left;">
              <div id="wait"></div>
             
              
            </div>
          
          <div style="width: 100%;float: left;">
              <br><hr>
               <b>Notas: <label style="color: red;margin-left: 2%;font-weight: bold;" id="nota"></label></b><br>
          </div>
              
        </div>
		   <br><br>
                          <!-- CONTENIDO DENTRO DE TABINDEX -->
                             <table class="table table-hover">
                                <tr class="bg-info">
                                      <th>CODIGO</th>
                                      <th>REFERENCIA</th>
                                      <th>DESCRIPCION</th> 
                                      <th>COLOR</th>
                                      <th>MEDIDA</th>
                                      <th>CANT</th>
                                      <th>UNMED</th>
                                      <th>PRECIO</th>
                                      <th>C. APR</th>
                                      <th>C. PEN</th>
                                      <th>C PRO.</th>
                  		      <th>TOTAL</th>
                                      <th>OBS</th>
                  	              <th></th>
                                </tr>
                               <tbody id="mostrar_tabla_generacion">
                                   
                               </tbody>
                            </table>
                          <!-- FIN DE CONTENIDO -->
		</div>
</div>

<!--- MODAL PARA AGREGAR ORDENES DE COMPRA GENERADAS POR PAQUETES DE PRODUCTOS -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4  style="color: blue;"><b>GENERAR ORDEN DE COMPRA</b></h4><br>
        </div>
                  <div class="modal-body">
                   <div class="form-horizontal" role="form">
                       <ul class="nav nav-tabs" id="myTab">
                          <li class="active">
                          <a data-toggle="tab" href="#home" aria-expanded="false">
                            <i class="green ace-icon fa fa-plus bigger-120"></i>
                            Datos Basicos
                          </a>
                        </li>
                        <li class="">
                          <a data-toggle="tab" href="#basico" aria-expanded="true">
                            <i class="green ace-icon fa fa-home bigger-120"></i>
                            Otros Datos
                          </a>
                        </li>
                      </ul>
                       <div class="tab-content">
                           <div id="home" class="tab-pane fade active in">
                               <div class="form-group">
                                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">ID</label>
                                         <div class="col-sm-9">
                                           <input type="text" id="ordenc" placeholder="" class="col-xs-10 col-sm-9" disabled />
                                         </div>
                                      </div>

                                     <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>

                                         <div class="col-sm-9">
                                          <input type="hidden" id="ordenfom" placeholder="" class="col-xs-10 col-sm-9" disabled/>
                                         </div>

                                     </div>

                                          <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Proveedor</label>

                                         <div class="col-sm-9">
                                          <input type="text" id="nombrepro" onclick="obtener();" class="col-xs-10 col-sm-2"/>
                                           <input type="text" id="nterc" placeholder="" class="col-xs-10 col-sm-7" disabled />
                                         </div>

                                     </div>
                                          <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Bodega</label>
                                         <div class="col-sm-9">
                                             <input type="text" name="bodega" id="loc" onclick="bodega();" class="col-xs-10 col-sm-2"/>
                                          <input type="text" id="nloc" placeholder="" class="col-xs-10 col-sm-7" disabled/>
<!--                                          <input type="hidden" id="sede" placeholder="" class="col-xs-10 col-sm-7" disabled/>-->
                                         </div>
                                     </div>
                                <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Direccion de envio</label>
                                         <div class="col-sm-9">
                                          
                                          <input type="text" id="sede" placeholder="" class="col-xs-10 col-sm-7" disabled/>
                                         </div>
                                       
                                     </div>
                               <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">IVA ?</label>
                                         <div class="col-sm-9">
<!--                                          <select id="siva" class="col-xs-10 col-sm-3">
                                              <option value="19">IVA 19%</option>
                                              <option value="0">IVA 0</option>
                                              <option value="5">IVA 5%</option>
                                          </select>-->
                                             <input type="text" id="siva" placeholder="" class="col-xs-10 col-sm-3" disabled value=""/>
                                         </div>
                                       
                                     </div>
                                      <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Centro de costo</label>
                                         <div class="col-sm-9">
                                             <input type="text" name="bodega" id="cencosto" onclick="centrob();" class="col-xs-10 col-sm-2" value="00030001"/>
                                          <input type="text" id="nomcos" placeholder="" class="col-xs-10 col-sm-7" disabled value="PLANTA BQUILLA"/>
                                         </div>
                                     </div>


                                 <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Observaciones</label>
                                         <div class="col-sm-9">
                                         <textarea id="observ" placeholder=""  class="col-xs-10 col-sm-9"></textarea>
                                         </div>
                                 </div>      
                           </div>
               
                           <div id="basico" class="tab-pane fade">
                               <div class="form-group">
                                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo de Cuentas</label>
                                         <div class="col-sm-9">
                                             <input type="text" name="bodega" id="codcue" onclick="buscartc();" class="col-xs-10 col-sm-2" value="01"/>
                                             <input type="text" id="nomcue" placeholder="" class="col-xs-10 col-sm-7" disabled value="MATERIAS PRIMAS"/>
                                         </div>
                                </div>
                                <div class="form-group">
                                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Anticipo</label>
                                          <div class="col-sm-9">
                                             <input type="text" name="ant" id="ant" placeholder="" value="0" class="col-xs-10 col-sm-9"/>
                                          </div>
                                </div>

                               <div class="form-group">
                                         <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fecha de anticipo</label>
                                          <div class="col-sm-9">
                                              <input type="date" id="fechan" class="col-xs-10 col-sm-5" value="<?php echo date("Y-m-d") ?>"/>
                                          </div>
                               </div>
                           </div>
                           </div>
                    
                       
                        <div id="request"></div>
                        <div class="modal-footer">
                             <button class="btn btn-info" id="guar_orden_co">
                             <i class="ace-icon fa fa-save bigger-130"></i>
                             Guardar
                             </button>
                        </div>
               </div>    
             </div>
      </div>
    </div>
  </div>

<div class="modal fade" id="modalpro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Compra a ultimo Proveedor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" id="mostrarpro">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
  <script>
     function entrega() {
         var cant = $("#itemsel").val();
         if(cant=='0'){
             alert("¡Selecciona por lo menos un items!");
             return false;
         }
      $("#sede").val('');
      $("#nombrepro").val('');
      $("#nterc").val('');
      $("#loc").val('');
      //$("#ant").val('');
      //$("#fechan").val('');
      $("#request").html('');
      var est = $("#est").val();
//      if(est!=='aprobado'){
          $("#myModal").modal();
//      }
     }
     
     function bodega() {
      window.open('../vistas/inventario/popup/bodegas/bodega.php?compras=1', 'Agregar Bodega', "width=1000, height=500");
     }

     function obtener() {
      window.open('../vistas/inventario/popup/proveedores/tercero.php', 'Agregar Proveedor', "width=1000, height=500");
     }
     
        function centrob() {
      window.open('../vistas/inventario/popup/centrocosto_cos/centro_costo.php', 'Agregar Bodega', "width=1000, height=500");
     }
     
     
      function buscartc() {
      window.open('../vistas/inventario/popup/tipoct/t_cta.php', 'Agregar cuenta', "width=600, height=397");
     }
     
    </script>

<!-- FIN ORDENES DE COMPRA -->
<?php include 'scritps.php';?>
