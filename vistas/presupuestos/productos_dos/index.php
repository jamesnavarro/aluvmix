<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/productos_dos/funciones.js?<?php echo rand(1,100) ?>"></script>
<style>
    .content-box-blue {
background-color: #d8ecf7;
border: 1px solid #afcde3;
height: 200px;
width: 200px;
}
textarea {
	resize: none;
        height: 100px;
}
.traza{
    font-size: 10px;
    font-weight: 700;
    
}
</style>
<div class="page-content">	 
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br>
                            <div class="form-vertical" role="form">
                                <div>
                                 <table>
                                     <tr>
                                         
                                        <td>
                                           
                                            <label class="col-sm-4 control-label no-padding-right">Referencia</label>
                                             <input type="text" id="codigo" onchange="verificar_codigo()" placeholder="Codigo" class="col-xs-6"/>
                                             <img src="../images/buscar.png" onclick="pre_referencias()" style="cursor:pointer">
                                             
                                        </td>
                                        <td><input type="text" id="id_pro" placeholder="id" class="col-xs-6" disabled/>  <button onclick=" pre_recargar()"> *</button> </td>
                                    
                                        <td colspan="1"><b>Msj:</b><span id="verificar" ></span>
                                        
                                        </td>
                                        <td>
                                           
                                        </td>
                                     </tr>
                                     <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Linea</label>
                                             
                                             <select id="linea">
                                                 <option value="">Seleccione linea</option>
                                                 <?php
                                                 $lineas = mysqli_query($con, "select * from linea");
                                                 while($l = mysqli_fetch_array($lineas)){
                                                     echo '<option value="'.$l[1].'">'.$l[1].'</option>';
                                                 }
                                                 ?>
                                                
                                               
                                            </select>
                                        </td>
                                        
                                        <td colspan="3">
                                          
                                            <textarea id="descripcion" placeholder="Descripcion del producto" class="col-xs-12"></textarea>   
                                            <button onclick="mostrar_trazabilidad();" class="btn btn-primary" data-toggle="modal" data-target="#modalnombres" > ! </button>
                                        </td>
                                        
                                     </tr>
                                    <tr>
                                        <td>
                                             <label class="col-sm-4 control-label no-padding-right"></label>
                                             <input type="hidden" id="referencia" placeholder="Seleccione Referencia" class="col-xs-6"/>
                                        </td>
                                        
                                        
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Ancho General</label>
                                            <input type="number" id="anc_general" placeholder="mm" class="col-xs-6"/> 
                                        </td>
                                        <td nowrap>
                                         
                                            
                                        </td>
                                        <td rowspan="25">
                                            <form id="subida">
                                                <input type="hidden" id="idp" name="idp"/> 
                                            <input type="file" id="foto" name="foto" accept=".jpeg,.png,./rar,.zip,.jpg" disabled/> 
                                            <br>
                                            <input type="submit" value="Subir Imagen" id="loadi" disabled/><br>
                                            <span id="msg"></span>
                                            </form>
                                    <center>
                                            <div id="imagen"  class="content-box-blue">
                                                <img src="../producto/100744.png" width="200px">
                                                
                                            </div>
                                        
                                        <fieldset>
                                                <legend>Solo vidrio</legend>
                                        <table>
                                        <tr>
                                            <td>Lleva Perforaciones</td>
                                            <td>
                                            <select id="per" class="col-xs-6">
                                                 <option value="No">No</option>
                                                 <option value="Si">Si</option>
                                             </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lleva Boquetes</td>
                                            <td>
                                            <select id="boq" class="col-xs-6">
                                                 <option value="No">No</option>
                                                 <option value="Si">Si</option>
                                             </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Max Laminas</td>
                                            <td><input type="number" id="lam" placeholder="" class="col-xs-6" value="0"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Espaciadores</td>
                                            <td>
                                           
                                            <select id="espaciadores" class="col-xs-6">
                                                 <option value="">Seleccione</option><option value="No">No</option>
                                                 <option value="Si">Si</option>
                                            </select>
<!--                                                <button onclick="pre_complementos('espaciadores')"><img src="../imagenes/pop.png"></button>-->
                                        </td>
                                        </tr>
                                        <tr>
                                            <td>Interlayer</td>
                                            <td>
                                            
                                            <select id="interlayer" class="col-xs-6">
                                                 <option value="">Seleccione</option><option value="No">No</option>
                                                 <option value="Si">Si</option>
                                            </select> 
<!--                                                <button onclick="pre_complementos('interlayer')"><img src="../imagenes/pop.png"></button>-->
                                        </td>
                                        </tr>
                                           
                                    </table>
                                        </fieldset>
                                    </center>
                                  
                                    
                                        </td>
                                        
                                    </tr>
                                  <tr><td nowrap>
                                          <label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                        
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Sistema</label>
                                            <input type="text" id="sistema" placeholder="Sistemas" class="col-xs-5"/> <button onclick="addsistema()" class="btn btn-primary"  data-toggle="modal" data-target="#modalsistemas">+</button> 
                                            
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Alto General</label>
                                            <input type="number" id="alt_gener" placeholder="mm" class="col-xs-6"/> 
                                        </td>
                                        <td nowrap>
                                            
                                            
                                        </td>
                                    </tr>
                                    <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                            <label class="col-sm-4 control-label no-padding-right">Tipo</label>
                                            <input type="text" id="tipo" placeholder="escriba aqui" class="col-xs-6" onclick="tipos()"/>
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Alto de rejilla</label>
                                            <input type="number" id="alt_rejilla" placeholder="escriba aqui" class="col-xs-6"/> 
                                        </td>
                                        <td nowrap>
                                            
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                       <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                 <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Configuracion</label>
                                            <input type="number" id="hojas" placeholder="Hojas" class="col-xs-2" />
                                            <input type="text" id="configuracion" placeholder="Configuracion" class="col-xs-4" onclick="hojas()"/>
                                        </td>
                                        <td>
                                           <label class="col-sm-4 control-label no-padding-right">Ancho Max</label>
                                              <input type="number" id="ancho_max" placeholder="" class="col-xs-3" />
                                        </td>
                                        
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                         <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Tipo vidrio</label>
                                            <input type="number" id="tipo_vid" placeholder="" class="col-xs-6" />
<!--                                            <select id='' class="col-xs-6">
                                                <option value="">N/A</option>
                                                <option value="CRUDO">CRUDO</option>
                                                <option value="">TEMPLADO</option>
                                                <option value="">LAMINADO</option>
                                            </select>-->
                                            
                                        </td>
                                         <td nowrap>
                                               <label class="col-sm-4 control-label no-padding-right">Alto Max</label>
                                            <input type="number" id="alto_max" placeholder="" class="col-xs-3" />
                                          
                                           </td> 
                                    </tr>

                                       <tr>
                                           <td nowrap>
                                               <label class="col-sm-5 control-label no-padding-right"></label> 
                                           </td>
                                       </tr>
                                       
                                    <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Espesor de vidrio</label>
                                            <input type="number" id="espesor_vid" placeholder="" class="col-xs-6" onclick="espesores()"/>
                                        </td>
                                        <td nowrap>
                                               <label class="col-sm-4 control-label no-padding-right"><b><u># Modulos</u></b></label>
                                             <input type="number" id="cuerpo_fij" placeholder="" class="col-xs-6"/>
                                             
                                        </td> 
                                    </tr>

                                     <tr>
                                         <td nowrap>
                                             <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Riel</u></b></label>
                                             
<!--                                             <select id="tipo_riel" class="col-xs-6">
                                                 <option value="">Seleccione</option>
                                                 <option value="No">No</option>
                                                 <option value="Si">Si</option>
                                             </select>-->
                                             <input type="checkbox" id="tipo_riel" class="" onclick="addriel()">
                                            <button onclick="pre_complementos('tipo_riel')"><img src="../imagenes/pop.png"></button>
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Ancho CF Der.</label>
                                            <input type="number" id="ancho_cf_der" placeholder="" class="col-xs-3" />
                                           </td>                                
                                     </tr>
                                    <tr>
                                        <td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                             <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Alfajia</u></b></label>
                                             

                                             <input type="checkbox" id="tipo_alfa" class="" onclick="addalfajia()">
                                             <button onclick="pre_complementos('tipo_alfa')"><img src="../imagenes/pop.png"></button>
                                        </td>
                                           <td>
                                            <label class="col-sm-4 control-label no-padding-right">Ancho CF Izq.</label>
                                            <input type="number" id="ancho_cf_izq" placeholder="" class="col-xs-3" />
                                        </td>
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                            <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Rejilla</u></b></label>
                                            
                                            <input type="checkbox" id="tipo_rejilla" class="">                       
                                        </td>
                                           <td> 
                                               <label class="col-sm-4 control-label no-padding-right">Alto CF Sup.</label>
                                            <input type="number" id="alto_cf_sup" placeholder="" class="col-xs-3" />
                                           
                                           </td>
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                            <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Cierre</u></b></label>  
                                             <table>
                                                 <tr>
                                                     <td> <input type="checkbox" id="tipo_cie" class=""> <button onclick="pre_complementos_kit('tipo_cie')"><img src="../imagenes/pop.png"></button></td>
                                                     <td>Cant:</td>
                                                     <td><input type="number" id="can_cie" placeholder="" class="col-xs-3" /></td>
                                     
                                                 </tr>
                                             </table>
                                        </td>
                                        <td> 
                                               <label class="col-sm-4 control-label no-padding-right">Alto CF Inf.</label>
                                               <input type="number" id="alto_cf_inf" placeholder="" class="col-xs-3" />
                                           
                                           </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Rodaja</u></b></label>
                                            
                                           
                                            
                                            <table>
                                                 <tr>
                                                     <td><input type="checkbox" id="tipo_rod" class=""> <button onclick="pre_complementos_kit('tipo_rod')"><img src="../imagenes/pop.png"></button></td>
                                                     <td>Cant:</td>
                                                     <td><input type="number" id="can_rod" placeholder="" class="col-xs-3" /> </td>
                                                 </tr>
                                             </table>
                                         </td>
                                    
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Bisagras</u></b></label>
                                            <input type="checkbox" id="tipo_bis" class="">
                                             <button onclick="pre_complementos_kit('tipo_bis')"><img src="../imagenes/pop.png"></button>
  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Brazos</u></b></label>
                                             <table>
                                                 <tr>
                                                     <td><input type="checkbox" id="tipo_bra" class=""> <button onclick="pre_complementos_kit('tipo_bra')"><img src="../imagenes/pop.png"></button></td>
                                                     <td>Cant:</td>
                                                     <td><input type="number" id="can_bra" placeholder="" class="col-xs-3" /></td>
                                                 </tr>
                                             </table>
                                         </td>
                                    
                                        <td>
                                           
                                            
                                        </td>
                                    </tr>
                                      <tr>
                                          <td>
                                              <label class="col-sm-5 control-label no-padding-right"><b>Obervaciones x presupuesto</b></label>
                                              <textarea id="obser" style="width:100%"></textarea>
                                          </td> 
                                        
                                          <td>
                                               <label class="col-sm-5 control-label no-padding-right">Aprobado por</label>
                                              <input type="text" id="aprobadopor" class="" disabled>
                                                      
                                          </td>
                                      </tr>
                                      <tr>
                                          <td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> 
                                      </tr>

                                         <tr>
                                             <td colspan="4">
                                                  <button style="width: 110px" class="btn btn-primary" onclick="guardar_producto()"><i class="ace-icon fa fa-check "></i> Guardar </button>
                                          <button style="width: 110px" class="btn btn-danger" onclick="limpiar_cotn()"><i class="ace-icon fa fa-close "data-dismiss="modal"></i>Nuevo</button>
                                          <button style="width: 150px"  class="btn btn-info" onclick="historial()">Hist.modificacion</button> 
                              <span id="btn_ok"> </span>
                                          <span id="btn_estado"> </span>
                                          <span id="btn_aprobado"> </span>
                                         
                                              
                                         
                                       
                                             </td> 
                                         </tr>
                                         <tr>
                                             <td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td>
                                         </tr>
                                         
                                        <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr> 
                                  
                                   </table>
                              </div>
                            </div>
    </div>
   
     <div> 
     <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br>
         
      <table>
          <center><h4><b>Reparto de Aluminio</b></h4></center> 
          <tr>
                <td>
                    <button style="width: 165px"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#Formularioaluminio" onclick="limpiar_perfil()"><i class="glyphicon glyphicon-plus"></i>Agregar</button>
                    <button onclick=" pre_recargar()"> *</button>
                </td>
          </tr>
          
      </table><br>
                  <table id="simple-table" class="table  table-bordered table-hover">
                      <tr>
                           <th style="text-align:center" colspan="13">Principales</th>
                      </tr>
                      <tr class="bg-info" align="center">

                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Descripcion opcional</th>
                      <th>Lado</th>
                      <th>Formula</th>
                      <th>Piezas</th>
                      <th>Medida</th>
                      <th>Cant</th>          
                      <th>Medida</th>
                      <th nowrap>Peso Total</th>
                      <th nowrap>Valor Total</th>
                      <th>Editar</th>
                      <th>Elim</th>
                 </tr>
                 <tbody id="MostrarPerfil">
                     
                 </tbody>
               </table>  
      <hr>
      <div id="modulo_rieles">
       <table id="simple-table" class="table  table-bordered table-hover">
            <tr>
                           <th style="text-align:center" colspan="13">Rieles</th>
                      </tr>
                 <tr class="bg-info" align="center">

                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Descripcion opcional</th>
                      <th>Lado</th>
                      <th>Formula</th>
                      <th>Piezas</th>
                      <th>Medida</th>
                      <th>Cant</th>
                      <th>Medida</th>
                      <th nowrap>Peso Total</th>
                      <th nowrap>Valor Total</th>
                        <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
                 <tbody id="MostrarRieles">
                     
                 </tbody>
               </table> 
          </div>
            <hr>
      <div id="modulo_alfajia">
       <table id="simple-table" class="table  table-bordered table-hover">
            <tr>
                           <th style="text-align:center" colspan="13">Alfajias</th>
                      </tr>      
           <tr class="bg-info" align="center">

                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Descripcion opcional</th>
                      <th>Lado</th>
                      <th>Formula</th>
                      <th>Piezas</th>
                      <th>Medida</th>
                      <th>Cant</th>
                      <th>Medida</th>
                      <th nowrap>Peso Total</th>
                      <th nowrap>Valor Total</th>
                        <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
                 <tbody id="MostrarAlfajia">
                     
                 </tbody>
               </table>
      </div>
     </div>
     </div> 
                        
     <div>
          <div id="modulo_rejilla">
      <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br>
             <center><h4><b>Reparto de Rejillas</b></h4></center> 
              <p><button  style="width: 165px"  class="btn btn-info btn-lg" onclick="limpiar_rejilla()"  data-toggle="modal" data-target="#ModalRejillas"><i class="glyphicon glyphicon-plus"></i> Agregar </button></p>
                <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Formula Can</th>
                      <th>Cant. Rejillas</th>
                      <th>Formula Med</th>
                      <th>Medida</th>
                      <th>Perfiles</th>
                      <th>Medida</th>
                      <th>Total</th> 
                      <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
                 <tbody id="MostrarRejillas">
                     
                 </tbody>
               </table> 
     </div>
              </div>
     </div>
                                
    
      <br><br><br>
              
      <div>
          <br>
      <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br> 
             <center><h4><b>Reparto de vidrio</b></h4></center> 
   
              <p>
                  <button  style="width: 165px"  class="btn btn-info btn-lg" onclick="limpiar_vidrios()"  data-toggle="modal" data-target="#modalvidrios"><i class="glyphicon glyphicon-plus"></i> Agregar </button>
                  <button onclick=" pre_recargar()"> *</button>
              </p>
             <br>
             
              <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Item</th>
                      <th>Descripcion</th>
                      <th>Formula 1</th>
                      <th>Ancho (mm)</th>
                      <th>Formula 2</th>
                      <th>Alto (mm)</th>
                      <th>Cant total</th>
                      <th>Modulo</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
                 <tbody id="MostrarVidrios">
                     
                 </tbody>
               </table>                         
      </table>
 
             <center><h4><b>Espaciadores e Interlayer (Seleccionables)</b></h4></center> 

              <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Tipo.</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Cantidad</th>
                      <th>Calcular X</th>
                      <th>Costo</th>
                      <th>Compuestos</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
                 <tr class="bg-info" align="center">
                     <th>
                         <select id="ftipo">
                             <option value="">Seleccione</option>
                             <option value="espaciadores">espaciadores</option>
                             <option value="interlayer">interlayer</option>
                        <!--<option value="tipo_alfa">tipo_alfa</option>
                             <option value="tipo_cie">tipo_cie</option>
                             <option value="tipo_riel">tipo_riel</option>-->
                         </select>
                     </th>
                     <th><input id="frefe" type="text" style="width:100%" ></th>
                      <th><input id="fdesc" type="text" disabled style="width:100%"></th>
                      <th><input id="fcant" type="text" style="width:100%"></th>
                      <th>
                              <select  class="form-control" id="funid">
                                  <option value="">Seleccione</option>
                                  <?php
                                      $colores = mysqli_query($con, "select * from umb");
                                      while ($row = mysqli_fetch_array($colores)) {
                                          echo '<option value="'.$row[0].'">'.$row[0].'</option>';
                                      }
                                  ?>
                              </select>
                      </th>
                      <th>--</th>
                      <th>--</th>
                      <th>--</th>
                      <th><button onclick="pre_addsel()">Agregar</button></th>
                 </tr>
                 <tbody id="mostrar_parametros1">
                     
                 </tbody>
               </table>                         
      </table>
     </div>
          
                <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br> 
             <center><h4><b>Lista de Insumos</b></h4></center> 
              <p><button style="width: 110px" class="btn btn-primary" data-toggle="modal" data-target="#modalaccesorios"> Agregar fila </button>
              <button onclick=" pre_recargar()"> *</button> </p>
              <table id="simple-table" class="table  table-bordered table-hover">
                 <tr>
                           <th style="text-align:center" colspan="10">Insumos Fijos</th>
                      </tr>  
                  <tr class="bg-info" align="center">
             
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Color</th>
                      <th>Cantidad</th>
                       <th>Und Medida</th>
                       <th>Cant. Total</th>
                       <th nowrap>Costo total</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                 </tr>
                 <tbody id="mostrar_parametrosacc">
                     
                 </tbody>
               </table>       
              <hr>
              <div id="modulo_cierre">
               <table id="simple-table" class="table  table-bordered table-hover">
                 <tr>
                           <th style="text-align:center" colspan="10">Cierres</th>
                      </tr>  
                  <tr class="bg-info" align="center">
             
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Color</th>
                      <th>Cantidad</th>
                       <th>Und Medida</th>
                       <th>Cant. Total</th>
                      <th nowrap>Costo total</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                 </tr>
                 <tbody id="mostrar_cierres">
                     
                 </tbody>
               </table>
              </div>
              <div id="modulo_rodajas">
              <hr>
               <table id="simple-table" class="table  table-bordered table-hover">
                 <tr>
                           <th style="text-align:center" colspan="10">Rodajas</th>
                      </tr>  
                  <tr class="bg-info" align="center">
             
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Color</th>
                      <th>Cantidad</th>
                       <th>Und Medida</th>
                       <th>Cant. Total</th>
                       <th nowrap>Costo total</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                 </tr>
                 <tbody id="mostrar_rodajas">
                     
                 </tbody>
               </table>
              </div>
               <div id="modulo_brazos">
              <hr>
               <table id="simple-table" class="table  table-bordered table-hover">
                 <tr>
                           <th style="text-align:center" colspan="10">Brazos</th>
                      </tr>  
                  <tr class="bg-info" align="center">
             
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Color</th>
                      <th>Cantidad</th>
                       <th>Und Medida</th>
                       <th>Cant. Total</th>
                       <th nowrap>Costo total</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                 </tr>
                 <tbody id="mostrar_brazos">
                     
                 </tbody>
               </table>
              </div>
               <div id="modulo_bisagras">
              <hr>
               <table id="simple-table" class="table  table-bordered table-hover">
                 <tr>
                           <th style="text-align:center" colspan="10">Bisagras</th>
                   </tr>  
                  <tr class="bg-info" align="center">
             
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Color</th>
                      <th>Cantidad</th>
                       <th>Und Medida</th>
                       <th>Cant. Total</th>
                       <th nowrap>Costo total</th>
                      <th>Tipo</th>
                      <th>Opciones</th>
                 </tr>
                 <tbody id="mostrar_bisagras">
                     
                 </tbody>
               </table>
              </div>
 
     </div>
          <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br> 
             <center><h4><b>Mano de obra de Instalacion</b></h4></center> 
             <p><button style="width: 110px" class="btn btn-primary" data-toggle="modal" data-target="#modalmano" onclick="cargar_select_instalacion();limpiar_fab();"> Agregar fila </button>
              <button onclick=" pre_recargar()"> *</button> </p>
              <table id="simple-table" class="table  table-bordered table-hover">
                  <tr class="bg-info" align="center">
             
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Calculo por </th>
                      <th>Modulo </th>
                      <th>Tipo </th>
                      <th>Valor  </th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
                 <tbody id="mostrar_instalacion">
                     
                 </tbody>
               </table>
          </div>
         
          
     </div> 
       
     
      
<br>
<div class="modal fade" id="modalmano" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de mano de obra Instalación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width:100%">
              <tr>
                  <td>Id</td>
                  <td><input type="text" id="fab_id" class="form-control" disabled></td>
              </tr>
              <tr>
                  <td>Codigo</td>
                  <td>
                      <select id="fab_cod" onchange="cargar_valores_instalacion()">
                          <option value="">Seleccione</option>
  
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>Unidad de medida</td>
                  <td>
                      <input type="text" id="fab_umb" class="form-control" disabled>
                  </td>
              </tr>
              <tr>
                  <td>Valor 1</td>
                  <td><input type="text" id="fab_val1" class="form-control" onclick="" disabled></td>
              </tr>
              <tr>
                  <td>Valor fuera rango</td>
                  <td><input type="text" id="fab_val2" class="form-control" onclick="" disabled></td>
              </tr>
              <tr>
                  <td></td>
                  <td>
                      <input type="hidden" id="fab_hoja" class="form-control" onclick="">
                  </td>
              </tr>
              <tr>
                  <td>Modulo</td>
                  <td>
                      <select id="fab_rango">
                          <option value="">Seleccione</option>
                          <option value="Principal">Principal</option>
                          <option value="CF">CF</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td><input type="hidden" id="fab_lado" class="form-control" onclick=""></td>
              </tr>
              
          </table>
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="pre_addfab()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

      
   <div class="modal fade" id="Formularioaluminio" role="dialog" >
    <div class="modal-dialog modal-lg"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>AGREGAR ALUMINIO</b></h4>
        </div>
          
        <div class="modal-body">
            <table style="width:100%" class="table  table-bordered table-hover">
                   <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Buscar Referencia </label>
                         <button onclick="pre_BuscarReferencias('Aluminio')">Buscar</button>
                     </td>
                     <td class="bg-success" nowrap>
                         <label class="col-sm-2 control-label no-padding-right">ID perfil</label>
                         <input type="text" id="id_perfil" placeholder="" class="col-xs-2" disabled/>
                        
                     </td>
                 </tr>
                  
                <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Referencia</label>
                         <input type="text" id="alu_ref" placeholder="" class="col-xs-6" />
                     </td>
                     <td nowrap class="bg-success"> <input type="text" id="alu_des" placeholder="Descripcion del perfil" class="col-xs-10" disabled/></td>
                    
                 </tr>
                   
                                      <tr>
                     <td class="bg-success" nowrap><label class="col-sm-9 control-label no-padding-right">Utilizar formula para el perfil<b>?</b></label>
                         <select name="cars" id="alu_formula" class="col-xs-3">
			  <option value="No">No</option>
                          <option value="Si">Si</option>
                      </select>
                     </td>
                      <td class="bg-success" nowrap> <input type="text" id="alu_des_opc" placeholder="Descripcion Opcional del perfil" class="col-xs-10" /></td>
                 </tr>
                 
                   <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Seleccione lado</label>
                             <select id="lado_per" class="col-xs-6">
                                 <option value="">Seleccione</option>
			         <option value="Ancho">Ancho</option>
			         <option value="Alto">Alto</option>
                                 <option value="Longitud">Longitud</option>
                             </select>
                     </td>
                     <td nowrap class="bg-success">
<!--                           <input type="text" id="alu_perfil" class="col-xs-2" style="width: 100px;" />-->
                         <select name="cars" class="col-xs-3" id="alu_perfil" style="width: 130px;" onchange="medidas_perfiles()" disabled>
                               <option value="">Seleccione</option>
<!--			       <option value="Ancho">Ancho</option>
			       <option value="Alto">Alto</option>
                               <option value="Anchocfd">Ancho cf der</option>
                               <option value="Anchocfi">Ancho cf izq</option>
                               <option value="Anchovc">Ancho Ventana Corrediza</option>
                               <option value="Altocfs">Alto cf sup</option>
                               <option value="Altocfi">Alto cf inf</option>
                               <option value="Altorej">Alto Rejilla</option>
                               <option value="Altovc">Alto Ventana Corrediza</option>-->

                      </select>
                         <input type="text" id="cifra0" class="col-xs-2" style="width: 70px;"  disabled/>
                           <select name="cars" class="col-xs-2" id="operador1" onchange="medidas_perfiles()" style="width: 60px;" disabled>
           
			       <option value="/">/</option>
			       <option value="-">-</option>
                               <option value="+">+</option>
			       <option value="*">*</option>
                      </select>
                         <input type="text" id="cifra1" class="col-xs-2" value="1"  onchange="medidas_perfiles()" style="width: 50px;"  disabled/>
                          <select name="cars" class="col-xs-2" id="operador2" onchange="medidas_perfiles()" style="width: 60px;" disabled>
                              <option value="-">-</option>
			      <option value="/">/</option>
			      
                              <option value="+">+</option>
			      <option value="*">*</option>
                      </select>
                         <input type="text" id="cifra2" value="0"  onchange="medidas_perfiles()" class="col-xs-2" style="width: 50px;"  disabled/>
                         
                          <input type="text" id=""  onclick="medidas_perfiles()" value="=" class="col-xs-2"  style="width: 20px;" />
                          <input type="text" id="cifrat0" class="col-xs-2"  style="width: 60px;"  disabled/>
                     </td>
                     
                 </tr>
                   
                     <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Cantidad</label>
                         <input type="number" id="cantidad_perfil" placeholder="" class="col-xs-6" />
                     </td>
                     <td class="bg-success" nowrap>
                         <label class="col-sm-3 control-label no-padding-right">perfil para cotizar</label>
                         <select id="alu_dim" class="col-xs-3">
                                 <option value="Fijo">Fijo</option>
			         <option value="Dinamico">Dinamico</option>
			       
                         </select>
                          <label class="col-sm-3 control-label no-padding-right">Perfiles</label>
                         <select id="alu_mod" class="col-xs-3">
                                 <option value="Principal">Principal</option>
			         <option value="Rieles">Rieles</option>
                                 <option value="Alfajia">Alfajia</option>
			       
                         </select>
                     </td>
                 </tr>
                 <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Medidas</label>
                         <input type="number" id="medida_fija" placeholder="" class="col-xs-6" />
                     </td>
                     <td class="bg-success" nowrap>
                         <label class="col-sm-3 control-label no-padding-right">Cada Horizontal</label>
                         <input type="text" id="cadah" onchange="calcular_piezas();" class="col-xs-2" style="width: 70px;" disabled/>
                         
                         <label class="col-sm-2 control-label no-padding-right">Cant Vert</label>
                         <input type="text" id="canv" class="col-xs-2" style="width: 70px;" disabled/>
                     </td>
                 </tr>
                  <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Calcular Piezas</label>
                         <select id="piezas" class="col-xs-6">
                                 <option value="">Seleccione</option>
			         <option value="No">No</option>
			         <option value="Si">Si</option>
                               
                             </select>
                     </td>
                     <td class="bg-success" nowrap>
                         <label class="col-sm-3 control-label no-padding-right">Cada Vertical</label>
                         <input type="text" id="cadav" onchange="calcular_piezas();" class="col-xs-2" style="width: 70px;" disabled/>
                         <label class="col-sm-2 control-label no-padding-right">Cant Hori</label>
                         <input type="text" id="canh" class="col-xs-2" style="width: 70px;" disabled/>
                         <label class="col-sm-2 control-label no-padding-right">Total</label>
                         <input type="text" id="total_piezas" class="col-xs-2" style="width: 70px;" disabled/>
                       
                     </td>
                 </tr>
                 <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Por Divisiones</label>
                         <select id="alu_div" class="col-xs-6">
                                 <option value="">Seleccione</option>
			         <option value="No">No</option>
			         <option value="Si">Si</option>
                               
                             </select>
                     </td>
                     <td>Esta variable es para multiplicar por Horizontales o Verticales.</td>
                 </tr>

            </table> 

            <br>
            <table>
                <tr>
                       <td>
                        <button style="width: 110px" class="btn btn-primary" onclick="guardar_perfil()"><i class="ace-icon fa fa-check "></i> GUARDAR </button>
                        <button style="width: 110px" class="btn btn-secondary" onclick="limpiar_perfil()"><i class="ace-icon fa fa-close "data-dismiss="modal"></i>NUEVO</button>
                        <button type="button" class="btn btn-danger" class="close" data-dismiss="modal">CERRAR</button>
                       </td>
                </tr>
            </table>
      
        </div>
           </div>
         </div>
        </div>
<div class="modal fade" id="modalespaciadores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Compuestos de espaciadores /Interlayer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table>
              <tr>
                  <td>Relacionado</td>
                  <td><input type="text" id="esp_id" class="form-control" disabled></td>
                  <td>Calcular por</td>
                  <td><input type="text" id="esp_cal" class="form-control" disabled></td>
                  <td>Tipo</td>
                  <td>
                      <select id="esp_tipo">
                          <option value="Fijo">Fijo</option>
                          <option value="Seleccionable">Seleccionable</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>Codigo</td>
                  <td><input type="text" id="esp_cod" class="form-control" onclick=""></td>
                  <td>Descripcion</td>
                  <td><input type="text" id="esp_des" class="form-control" disabled></td>
                  <td>Cantidad</td>
                  <td><input type="text" id="esp_can" class="form-control"></td>
              </tr>
          </table>
          <div id="esp_compuestos">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="pre_addselcom()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalaccesorios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Insumos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Codigo</label>
      <input type="text" class="form-control" id="acc_cod" placeholder="Codigo" onclick="pre_materiales()">
    </div>
    <div class="form-group col-md-9">
      <label for="inputPassword4">Descripcion</label>
      <input type="text" class="form-control" id="acc_des" placeholder="Descripcion" disabled>
    </div>
  </div>
   <div class="form-row">
      <div class="form-group col-md-3">
              <label for="inputAddress">Lado</label>
          <select  class="form-control" id="acc_lado" title="">
          <option value="">Seleccione</option>
          <option value="Vertical">Vertical</option>
          <option value="Horizontal">Horizontal</option>
          <option value="Profundida">Profundida</option>
      </select>
      </div>
      <div class="form-group col-md-3">
          <label for="inputAddress">Para</label>
          <select  class="form-control" id="acc_para" title="">
          <option value="">Seleccione</option>
          <option value="Fabricacion">Fabricacion</option>
          <option value="Instalacion">Instalacion</option>
      </select>
      </div>
             <div class="form-group col-md-3">
              <label for="inputAddress">Configuracion</label>
          <select  class="form-control" id="acc_conf" title="">
          <option value="Fijo">Fijo</option>
          <option value="Dinamico">Dinamico</option>

      </select>
      </div>
      <div class="form-group col-md-3">
          <label for="inputAddress">Insumo </label>
          <select  class="form-control" id="acc_mod" disabled>
          <option value="Principal">Principal</option>
          <option value="Cierres">Cierres</option>
          <option value="Rodajas">Rodajas</option>
          <option value="Brazos">Brazos</option>
          <option value="Bisagras">Bisagras</option>
      </select>
      </div>

  </div>
          <div class="form-row">
    <div class="form-group col-md-3">
      <label for="inputEmail4">Cantidad</label>
      <input type="text" class="form-control" id="acc_can" placeholder="Cantidad" onchange="cantidad_insumos();">
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Calcular</label>
      <select  class="form-control" id="acc_cal"  onchange="mostrar_med_rej()">
          <option value="">Seleccione</option>
          <?php
              $colores = mysqli_query($con, "select * from umb");
              while ($row = mysqli_fetch_array($colores)) {
                  if($row[0]=='und'){
                      $sel = 'selected';
                  }else{
                      $sel = '';
                  }
                  echo '<option value="'.$row[0].'" '.$sel.'>'.$row[0].'</option>';
              }
          ?>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Distancia</label>
      <select  class="form-control" id="acc_dis" title="Seleccione si para la distribuccion de accesorios por medida">
          <option value="">Seleccione</option>
          <option value="Si">Si</option>
          <option value="No" selected>No</option>
      </select>
    </div>
    <div class="form-group col-md-3">
      <label for="inputPassword4">Por cada</label>
      <input type="text" class="form-control" id="acc_cada" placeholder="0" disabled  onchange="mostrar_med_rej()">
    </div>
     
  </div>


  <div class="form-group">
      <div class="form-group col-md-4">
              <label for="inputAddress">Cant.Insumos X Rejillas</label>
          <select  class="form-control" id="acc_rej" onchange="mostrar_med_rej()">
              <option value="1">1</option>
          </select>     
      </div>
      <div class="form-group col-md-4">
              <label for="inputAddress">Cantidad de Rejillas</label>
              <input type="text" class="form-control" id="acc_med_rej" value="1" disabled>
      </div>
      <div class="form-group col-md-4">
              <label for="inputAddress">Cantidad Total</label>
              <input type="text" class="form-control" id="acc_ct" placeholder="" disabled>
      </div>


  </div>
          <div class="form-group">
    <label for="inputAddress">Id Insumo</label>
       <input type="text" class="form-control" id="idacc" placeholder="" value="" disabled>
  </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-secondary" onclick="pre_limpiaeracc()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="pre_addaccesorios('Accesorios')">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalvidrios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registro de Vidrios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">

      <label for="inputEmail4">Seleccione el tipo de vidrio</label>
      <select id="ref_vidrio"  class="form-control">
          <option value="">Seleccione</option>
          <?php
          $query = mysqli_query($con,"select * from configuracion_vidrios where estado=0");
          while($r = mysqli_fetch_array($query)){
              echo '<option value="'.$r[1].'">'.$r[1].'</option>';
          }
          
          ?>
       </select>


  </div>
                    <div class="form-group">

      <label for="inputEmail4">Medida Horizontal de la ventana</label>
      <hr>
  


  </div>
          <div class="form-row">
    <div class="form-group col-md-5">

        <select  class="form-control" id="vid_ref1">
                <option value="">Seleccione</option>
            </select>
    </div>
              <div class="form-group col-md-1">
        <input type="text" class="form-control" id="med1" placeholder="" value="" disabled>
    </div>
    <div class="form-group col-md-1">

      <select  class="form-control" id="vid_ope1">
          <option value="/">/</option>
          <option value="-">-</option>
          <option value="+">+</option>
          <option value="*">*</option>
          
      </select>
    </div>
    <div class="form-group col-md-1">
        <input type="text" class="form-control" id="vid_var1" placeholder="" value="">
    </div>
       <div class="form-group col-md-1">

      <select  class="form-control" id="vid_ope2">
          <option value="-">-</option>
          <option value="+">+</option>
          <option value="*">*</option>
          <option value="/">/</option>
      </select>
    </div>
                  <div class="form-group col-md-1">
        <input type="text" class="form-control" id="vid_var2" placeholder="" value="">
    </div>
               <div class="form-group col-md-1">
        <button class=""  onclick="medida_vidrio()">=</button>
    </div>
               <div class="form-group col-md-1">
        <input type="text" class="form-control" id="vid_med1" placeholder="" value="">
    </div>
     
  </div>
                    <div class="form-group">

      <label for="inputEmail4">Medida Vertical de la ventana</label>
      <hr>
  


  </div>
          <div class="form-row">
    <div class="form-group col-md-5">

            <select  class="form-control" id="vid_ref3">
                <option value="">Seleccione</option>
            </select>
    </div>
              <div class="form-group col-md-1">
        <input type="text" class="form-control" id="med2" placeholder="" value="" disabled>
    </div>
    <div class="form-group col-md-1">

      <select  class="form-control" id="vid_ope3">
          <option value="/">/</option>
          <option value="-">-</option>
          <option value="+">+</option>
          <option value="*">*</option>
          
      </select>
    </div>

    <div class="form-group col-md-1">
        <input type="text" class="form-control" id="vid_var3" placeholder="" value="">
    </div>
       <div class="form-group col-md-1">

      <select  class="form-control" id="vid_ope4">
          <option value="-">-</option>
          <option value="+">+</option>
          <option value="*">*</option>
          <option value="/">/</option>
      </select>
    </div>
                  <div class="form-group col-md-1">
        <input type="text" class="form-control" id="vid_var4" placeholder="" value="">
    </div>
    <div class="form-group col-md-1">
         <button  onclick="medida_vidrio()">=</button>
    </div>
               <div class="form-group col-md-1">
        <input type="text" class="form-control" id="vid_med2" placeholder="" value="">
    </div>
     
  </div>
          <div class="form-row">
    <div class="form-group col-md-6">

    <label for="inputAddress">Cantidad</label>
          <input type="text" class="form-control" id="vid_can" placeholder="" value="">
  </div>
              
          <div class="form-group col-md-6">
    <label for="inputAddress">Pertenece al Modulo</label>
          <input type="text" class="form-control" id="vid_mod" placeholder="" value="">
  </div>
      </div>
          <div class="form-group">
           
                  <input type="text" class="form-control" id="vid_id" placeholder="" value="" disabled>
               
              </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-danger" onclick="pre_limvidrio()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="pre_addvidrio()">Guardar Vidrio</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="ModalRejillas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Formulario de Rejillas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width:100%">
                <tr>
                    <td>Id</td>
                    <td><input type="text" id="idrefe" disabled value="" style="width: 50px;"></td>
                <tr>
                    
                    <td><button onclick="pre_BuscarReferenciasRej('Aluminio')">Referencia</button> </td>
                    <td colspan="8"><input type="text" id="rej_ref" disabled style="width: 100px;">
                        </td>
                   <tr>
                    <td>Descripcion</td>
                    <td colspan="8"><input type="text" id="rej_des" disabled style="width: 100%;"></td>

                <tr>
                    <td>Calcular Cant. de Rejillas</td>
                    <td> 
                        
                        <select name="perfil_med" id="rej_ref1"  style="width: 100%;" required>
                            <option value="">Seleccione</option>        
                        </select> 
                        <td>
                              <input type="number" name="var3" id="rej_med1" value="" disabled style="width: 60px;">
                   <td>
                              <select  class="form-control" id="rej_ope1" style="width: 60px;">
                                  <option value="/">/</option>
                                  <option value="-">-</option>
                                  <option value="+">+</option>
                                  <option value="*">*</option>
                              </select>
                       <td>
                              <input type="number" name="var3" id="rej_var1" value="1" style="width: 60px;">
                       <td>
                              <select  class="form-control" id="rej_ope2" style="width: 60px;">
                                  <option value="-">-</option>
                                  <option value="+">+</option>
                                  <option value="/">/</option>
                                  <option value="*">*</option>
                              </select>
                       <td>
                              <input type="number" name="multiplo"  id="rej_var2" value="1" style="width: 60px;"></td>
                        <td>
                            <button   class="form-control" onclick="medida_rejilla()">=</button>
                        <td>
                              <input type="number" name="var3" id="rej_res1" value="" disabled style="width: 60px;" > 
                        </tr>
                        <tr>
                            <td>Medida del perfil (mm)</td>
                            <td>
                                <select name="med_rej" id="rej_ref2" style="width: 100%;">
                                                 <option value="">Seleccione</option> 
                                </select>
                                <td>
                              <input type="number" name="var3" id="rej_med2" value="" disabled style="width: 60px;">
                                <td>
                                <select  class="form-control" id="rej_ope3" style="width: 60px;">
                                  <option value="/">/</option>
                                    <option value="-">-</option>
                                  <option value="+">+</option>
                                  
                                  <option value="*">*</option>

                              </select>
                            <td>
                        <input type="number" name="varr" id="rej_var3" value="1" style="width:60px;"> 
                        <td>
                        <select  class="form-control" id="rej_ope4" style="width: 60px;">
                            <option value="-">-</option>      
                            <option value="/">/</option>                  
                                  <option value="+">+</option>
                                  <option value="*">*</option>
                              </select>
                            <td>
                        <input type="number" name="en" id="rej_var4" value="1" style="width: 60px;"></td>
                            <td>
                                <button   class="form-control" onclick="medida_rejilla()">=</button>
                            <td>
                              <input type="number" name="var3" id="rej_res2" value="" disabled style="width: 60px;" >
                 </tr>
              </table>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="LimpiarRejilla()">Close</button>
        <button type="button" class="btn btn-danger" onclick="limpiar_rejillas()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="SaveRejillas()">Guardar Rejilla</button>
      </div>
    </div>
  </div>
</div>    

<div class="modal fade" id="modalnombres" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Creacion de nombre y trazabilidad</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <textarea id="creado" class="col-xs-12"></textarea>
          <table style="width:100%">
              <tr>
                  <td>
                      <table class="traza">
                                    <?php
                                    $res = mysqli_query($con, "select * from cristales ");
                                    $c = 0;
                                    while($r = mysqli_fetch_row($res)){
                                        $c ++;
                                        $numero = 2;
//                                        if($c%$numero==0){
//                                            $tr= '<tr>';
//                                        }else{
//                                            if($c==1){
//                                                $tr= '<tr>';
//                                            }else{
//                                                 $tr= '';
//                                            }   
//                                        }
                                        $no = "'".$r[1]."'";
                                        echo $tr.'<tr><td><input type="checkbox" id="cristal'.$r[0].'" onclick="crear('.$r[0].','.$no.','.$r[2].')"></td><td>'.$r[1].'</td>';

                                    }
                                    ?>
                </table>
                  </td>
                  <td>
                      <table style="width:100%" class="traza">
                          <tr>
                        
                              <th>trazabilidad</th>
                              <th>secuencia</th>
                          </tr>
                          <tbody id="mostrar_trazabilidad">
                              
                          </tbody>
                      </table>
                  </td>
              </tr>
          </table>
          
          
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addtrazabilidad()">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalsistemas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Sistemas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="form-group">
               <select id="sistemamas" class="col-xs-6" >
                                             <option value="">Seleccione</option>
                                      <?php
                                      $consulta2= "SELECT * FROM `sistemas`";                     
                                      $result2=  mysqli_query($con,$consulta2);
                                      while($fila=mysqli_fetch_array($result2)){
                                      $valor1=$fila['nombre_sistema'];
                                      echo"<option value=".$fila['nombre_sistema'].">".$valor1."</option>";
                                      }
                                      ?>
	                                  </select> 
          </div>
           
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="addsis()">Agregar</button>
      </div>
    </div>
  </div>
</div>

      </div>
 
 
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
