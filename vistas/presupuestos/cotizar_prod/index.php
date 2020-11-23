<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/productos_dos/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">

		  
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br>
                            <div class="form-vertical" role="form">
                                <div>
                                 <table>
                                     <tr>
                                         <td>
                                             <input type="hidden" id="id_pro" placeholder="escriba aqui" class="col-xs-6" />
                                        </td>
                                     </tr>
                                    <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Sistema</label>
                                            <input type="number" id="sistema" placeholder="escriba aqui" class="col-xs-6" />
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Ancho General</label>
                                            <input type="number" id="anc_general" placeholder="escriba aqui" class="col-xs-6"/> 
                                        </td>
                                        <td nowrap>
                                            <label class="col-sm-5 control-label no-padding-right"><b>mm</b></label> 
                                            <button style="width: 150px"  class="btn btn-info" onclick="historial()">Hist.modificacion</button> 
                                        </td>
                                        <td rowspan="12">
                                            <label class="col-sm-6 control-label no-padding-right"></label>
                                            <input type="file" id="archivo" placeholder="escriba aqui" class="col-xs-6"/> 
                                        </td>
                                    </tr>
                                  <tr><td nowrap>
                                          <label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Tipo</label>
                                            <input type="number" id="tipo" placeholder="escriba aqui" class="col-xs-6" />
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Alto General</label>
                                            <input type="number" id="alt_gener" placeholder="escriba aqui" class="col-xs-6"/> 
                                        </td>
                                        <td nowrap>
                                            <label class="col-sm-5 control-label no-padding-right"><b>mm</b></label>
                                            <button style="width: 150px"  class="btn btn-info" onclick="activo()">Producto activo</button> 
                                        </td>
                                    </tr>
                                    <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right"> </label>
                                            <input type="number" id="descripcion" placeholder="escriba aqui" class="col-xs-6" />
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Alto de rejilla</label>
                                            <input type="number" id="alt_rejilla" placeholder="escriba aqui" class="col-xs-6"/> 
                                        </td>
                                        <td nowrap>
                                            <label class="col-sm-5 control-label no-padding-right"><b>mm</b></label>
                                            <button style="width: 150px" class="btn btn-success" onclick="estado()"><i class="ace-icon fa fa-check "></i> Aprobado</button> 
                                        </td>
                                    </tr>
                                     <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Referencia</label>
                                            <input type="number" id="referencia" placeholder="escriba aqui" class="col-xs-6" />
                                        </td>
                                    </tr>
                                       <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                 <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Configuracion</label>
                                            <input type="number" id="configuracion" placeholder="escriba aqui" class="col-xs-2" />
                                            <select id="confi_text" class="col-xs-6">
			                      <option value="Corredizas">Corredizas</option>
			                      <option value="1 fija 3 corredizas">1 fija 3 corredizas</option>
                                              <option value="2 fija 2 corredizas">2 fija 2 corredizas</option>
		                            </select>
                                        </td>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Cantidad/text</label>
                                            <input type="number" id="cantidad" placeholder="escriba aqui" class="col-xs-6"/> 
                                        </td>
                                        
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                         <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Tipo vidrio</label>
                                            <input type="number" id="tipo_vid" placeholder="" class="col-xs-6" />
                                        </td>
                                    </tr>
                                    
                                       <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                       <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                       
                                    <tr>
                                        <td>
                                            <label class="col-sm-4 control-label no-padding-right">Espesor de vidrio</label>
                                            <input type="number" id="espesor_vid" placeholder="" class="col-xs-6" />
                                        </td>
                                    </tr>
                                    <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td nowrap>
                                             <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Riel</u></b></label>
                                            <input type="number" id="tipo_riel" placeholder="" class="col-xs-6" /> 
                                        </td>
                                        <td nowrap>
                                            <label class="col-sm-5 control-label no-padding-right">Medidas maximas  </label>
                                            <label class="col-sm-2 control-label no-padding-right"><b>/</b> mm</label>
                                        </td>                                  
                                     </tr>
                                    <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                             <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Alfajia</u></b></label>
                                             <input type="number" id="tipo_alfa" placeholder="" class="col-xs-6" />
                                        </td>
                                           <td>
                                            <label class="col-sm-2 control-label no-padding-right">Ancho</label>
                                            <input type="number" id="ancho_med" placeholder="" class="col-xs-3" />
                                            <input type="text" id="ancho_mm" placeholder="" class="col-xs-2" />
                                        </td>
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                            <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Regilla</u></b></label>
                                            <input type="number" id="tipo_rejilla" placeholder="" class="col-xs-6" />
                                        </td>
                                           <td>
                                            <label class="col-sm-2 control-label no-padding-right">Alto</label>
                                            <input type="number" id="alto_med" placeholder="" class="col-xs-3" />
                                            <input type="text" id="alto_mm" placeholder="" class="col-xs-2" />
                                        </td>
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                            <label class="col-sm-4 control-label no-padding-right"><b><u>Tipo de Cierre</u></b></label>
                                            <input type="number" id="tipo_cie" placeholder="" class="col-xs-6" />
                                        </td>
                                    </tr>
                                      <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                     <tr>
                                         <td>
                                             <label class="col-sm-4 control-label no-padding-right"><b><u># cuerpo fijo</u></b></label>
                                             <input type="text" id="cuerpo_fij" placeholder="escriba aqui" class="col-xs-4" />
                                        </td>
                                         <td>
                                          <button style="width: 110px" class="btn btn-primary" onclick="guardar_prodcdos()"><i class="ace-icon fa fa-check "></i> GUARDAR </button>
                                          <button style="width: 110px" class="btn btn-danger" onclick="limpiar_producdos()"><i class="ace-icon fa fa-close "data-dismiss="modal"></i>CANCELAR</button>
                                        </td>
                                    </tr>
                                         <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr>
                                        <tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr><tr><td nowrap><label class="col-sm-5 control-label no-padding-right"></label> </td> </tr> 
                                  
                                   </table>
                              </div>
                            </div>
    </div>
   
     <div> 
     <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br>
         
      <table>
          <center><h4><b>Reparto de Aluminio</b></h4></center> 
          <h5>Medidas generales (Vent. O Puerta Vent.)</h5>
          <tr>
                <td>
                  <button style="width: 165px"  class="btn btn-info btn-lg" data-toggle="modal" data-target="#Formularioaluminio"><i class="glyphicon glyphicon-plus"></i>Agregar</button>
                </td>
          </tr>
          
      </table><br>
                  <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Tipo de Alf.</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Posicion</th>
                      <th>Long. de corte (mm)</th>
                      <th>Desct.-Altura mm</th>
                      <th>Cant unidad</th>
                      <th>Cant total test</th>
                      <th>Precio total</th>
                 </tr>
               </table>  
     </div>
     </div> 
                                
                            
                                
                                
     <div>
      <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br>
             <center><h4><b>Tipo de Rieles</b></h4></center> 
              <h5>Tipo de rieles.)</h5> 
              <p><button style="width: 110px" class="btn btn-primary" onclick="guardar_cotn()"><i class="ace-icon fa fa-max "></i> Agregar fila </button></p>
              <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Tipo de Riel.</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Posicion</th>
                      <th>Long. de corte (mm)</th>
                      <th>Desct.-Altura mm</th>
                      <th>Cant unidad</th>
                      <th>Cant total test</th>
                      <th>Precio total</th>
                 </tr>
               </table>
     </div>
     </div>
                                
    
      <br><br><br>
      <div>
      <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br> 
             <center><h4><b>Tipo de Alfajia</b></h4></center> 
              <h5>Tipo de Alfajia.) 
              </h5>
              <p><button style="width: 110px" class="btn btn-primary" onclick="guardar_cotn()"><i class="ace-icon fa fa-max "></i> Agregar fila </button></p>
              <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Tipo de Alf.</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Posicion</th>
                      <th>Long. de corte (mm)</th>
                      <th>Desct.-Altura mm</th>
                      <th>Cant unidad</th>
                      <th>Cant total test</th>
                      <th>Precio total</th>
                 </tr>
               </table>                         
      </table>
     </div>
     </div>  
              
      <div>
      <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;" class="col-xs-12"><br> 
             <center><h4><b>Reparto de vidrio</b></h4></center> 
             <table>
                 <tr>
                     <td><label> 1/Cuerpo fijo </label></td>
                     <td>
                     <select name="cars" class="col-xs-10">
			  <option value="SI">Superior</option>
			  <option value="NO">Inferior</option>
                          <option value="SI">Lateral derecha</option>
			  <option value="NO">Lateral izquierda</option>
                      </select>
                  </td>
                  <td><label><b>Ancho C. Fijo</b></label>&nbsp;</td>
                   <td><input type="number" id="c_costo" placeholder="" class="col-xs-6" /></td>
                  
                 </tr>
                 <tr>
                      <td></td>
                      <td></td>
                      <td><label><b>Alto C. Fijo</b></label>&nbsp;</td>
                      <td><input type="number" id="c_costo" placeholder="" class="col-xs-6" /></td>
                 </tr>
             </table>
             
             <br>
             
              <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>Tipo de Alf.</th>
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Posicion</th>
                      <th>Long. de corte (mm)</th>
                      <th>Desct.-Altura mm</th>
                      <th>Cant unidad</th>
                      <th>Cant total test</th>
                      <th>Precio total</th>
                      <th>Editar</th>
                      <th>Eliminar</th>
                 </tr>
               </table>                         
      </table>
     </div>
     </div> 
       
     
      
<br>
      
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
                         <label class="col-sm-6 control-label no-padding-right">Codido perfil</label>
                         <input type="number" id="c_costo" placeholder="" class="col-xs-6" />
                     </td>
                     <td class="bg-success" nowrap><label class="col-sm-2 control-label no-padding-right">VARIABLE ADICIONAL</label></td>
                 </tr>
                  
                <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Referencia</label>
                         <input type="number" id="refe_perfil" placeholder="" class="col-xs-6" />
                     </td>
                     <td nowrap class="bg-success"> <input type="text" id="c_costo" placeholder="" class="col-xs-10" /></td>
                    
                 </tr>
                   
                 <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Descripcion</label>
                         <input type="number" id="descrip_perfil" placeholder="" class="col-xs-6" />
                     </td>
                    <td class="bg-success" nowrap><label class="col-sm-2 control-label no-padding-right">Calcular cant. de perfil en V.</label></td>  
                 </tr>
                 
                   <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Seleccione lado</label>
                             <select id="lado_per" class="col-xs-6">
			  <option value="SI">Ancho</option>
			  <option value="NO">Alto</option>
                      </select>
                     </td>
                     <td nowrap class="bg-success">
                          <select name="med_v" class="col-xs-4">
			  <option value="SI">Ancho</option>
			  <option value="NO">Alto</option>
                      </select>
                         <label class="col-sm-1 control-label no-padding-right"><b>/</b></label>
                         <input type="text" id="n" class="col-xs-2" />
                          <select name="cars" class="col-xs-2">
			  <option value="SI">/</option>
			  <option value="NO">-</option>
                          <option value="SI">+</option>
			  <option value="NO">*</option>
                      </select>
                          <input type="text" id="cifra_uno" placeholder="" class="col-xs-2" />
                     </td>
                     
                 </tr>
                   
                     <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Medidas</label>
                         <input type="number" id="medida_for" placeholder="" class="col-xs-6" />
                     </td>
                      <td class="bg-success" nowrap><label class="col-sm-2 control-label no-padding-right">Calcular cant. de perfil en H.</label></td>
                 </tr>
                   
                   <tr class="bg-info">
                     <td nowrap>
                         <label class="col-sm-6 control-label no-padding-right">Cantidad</label>
                         <input type="number" id="cantidad_for" placeholder="" class="col-xs-6" />
                     </td>
                      <td nowrap class="bg-success">
                          <select name="med_h" class="col-xs-4">
			  <option value="SI">Ancho</option>
			  <option value="NO">Alto</option>
                      </select>
                         <label class="col-sm-1 control-label no-padding-right"><b>/</b></label>
                         <input type="text" id="signo_h" class="col-xs-2" />
                          <select name="cars" class="col-xs-2">
			  <option value="SI">/</option>
			  <option value="NO">-</option>
                          <option value="SI">+</option>
			  <option value="NO">*</option>
                      </select>
                          <input type="text" id="cifra_dos" placeholder="" class="col-xs-2" />
                     </td>
                 </tr> 
                     <tr>
                     <td class="bg-success" nowrap><label class="col-sm-9 control-label no-padding-right">Utilizar formula para el perfil<b>?</b></label>
                        <select name="cars" class="col-xs-3">
			  <option value="NO">No</option>
                          <option value="SI">Si</option>
                      </select>
                     </td>
                      <td class="bg-success" nowrap><label class="col-sm-2 control-label no-padding-right"></label></td>
                 </tr>
            </table> 
            <table>
                <center class="bg-success"><label><b>FORMULA PARA EL PERFIL</b></label></center>
                 <tr>
                     <td nowrap class="bg-success">
                          <select name="cars" class="col-xs-2">
			  <option value="SI">Ancho</option>
			  <option value="NO">Alto</option>
                         </select>
                         <label class="col-sm-1 control-label no-padding-right"><b>/</b></label>
                         <input type="text" id="c_costo" class="col-xs-1" />
                       <select name="cars" class="col-xs-1">
			  <option value="SI">/</option>
			  <option value="NO">-</option>
                          <option value="SI">+</option>
			  <option value="NO">*</option>
                      </select>
                          <input type="text" id="c_costo" placeholder="" class="col-xs-2" />
                           <select name="cars" class="col-xs-1">
			  <option value="SI">/</option>
			  <option value="NO">-</option>
                          <option value="SI">+</option>
			  <option value="NO">*</option>
                      </select>
                       <select name="cars" class="col-xs-1">
			  <option value="NO">Alfajia 11cm</option>
                          <option value="NO">Alfajia 13cm</option>
			  <option value="NO">Alfajia 16cm</option>
                          <option value="NO">Alfajia 22cm</option>
                          <option value="SI">N/A</option>
                      </select>
                      <select name="cars" class="col-xs-1">
			  <option value="NO">-</option>
                          <option value="SI">+</option>
			  <option value="NO">*</option>
                      </select>
                          <select name="cars" class="col-xs-2"> 
			  <option value="NO">Rieles aleta alta</option>
                          <option value="NO">Rieles aleta baja</option>
                          <option value="SI">N/A</option>
                      </select>
                     </td>
                 </tr>
                  
            </table><br>
            <table>
                <tr>
                       <td>
                        <button style="width: 110px" class="btn btn-primary" onclick="guardar_producto()"><i class="ace-icon fa fa-check "></i> GUARDAR </button>
                        <button style="width: 110px" class="btn btn-danger" onclick="limpiar_producto()"><i class="ace-icon fa fa-close "data-dismiss="modal"></i>CANCELAR</button>
                       </td>
                </tr>
            </table>
      
        </div>
           </div>
         </div>
        </div>
      
      </div>
     
 
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
