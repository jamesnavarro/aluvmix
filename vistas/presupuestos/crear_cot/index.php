<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/crear_cot/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Crear producto</b></h2>
        </div>
   </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	 <li class="active">
	   <a data-toggle="tab" href="#editar">
              <h6><B>Editar</B></h6>
           </a>
         </li>
          <li>
               <a data-toggle="tab" href="#reparto">
                   <h6><B>Reparto Aluminio</B></h6>
               </a>
          </li>
          <li>
	      <a data-toggle="tab" href="#vidrios">
              <h6><B>Reparto Vidrios</B></h6>
              </a>
          </li>
           <li>
               <a data-toggle="tab" href="#detalle">
                   <h6><B>Ventana con rejillas</B></h6>
               </a>
           </li>
           <li>
	      <a data-toggle="tab" href="#acesorios">
              <h6><B>Accesorios fabricar o instalar</B></h6>
               </a>
           </li>
       
           <li>
               <a data-toggle="tab" href="#mano"><h6><B>Mano de obra por producto</B></h6></a>
           </li>
           <li>
	      <a data-toggle="tab" href="#admini">
              <h6><B>Gastos administrativos y utilidad</B></h6>
               </a>
           </li>
        </ul>
    
     <div class="tab-content">
		<div id="editar" class="tab-pane fade in active">
                    <div class="">
                      <div class="row">
                          
	              <div class="col-xs-12">	
                        <h1 class="header smaller lighter blue"><b>DATOS BASICOS</b> 
                            
                            <div style="float: right">
                                 <button id="btn_apro"></button>
                                 <button id="btn_ok"></button> 
                                 <button id="btn_aproba"></button> 
                                 <button id="btn_rev"></button> 
                                 <button id="btn_actua"></button>
                                 
                            </div>  </h1>
                        <div></div>
                      </div>
                       <div style="border: 1px solid #307ECC;box-shadow: 0 0 5px #307ECC;"> 
                        <div class="col-xs-18">
                            <div class="form-horizontal" role="form">
                                <br>
                                 <div class="form-group">
                                  <div class="col-sm-6">
                                  <label class="col-sm-6 control-label" style="text-align:left" for="form-field-1"><b>Diseno de la derecha</b></label>
                                        
                                    <div class="col-sm-8" id="imag_u"></div> <div></div>
                                    <div class="col-sm-8">
                                    <input type="file" id="derecha" class="col-sm-12"/>
                                    </div>
                                  </div>
                                 <div class="col-sm-6">
                                     <label class="col-sm-6 control-label" style="text-align:left" for="form-field-1"><b>Diseno de la izquierda</b></label>
                                     <div class="col-sm-8" id="imag_d"></div> <div></div>
                                       <div class="col-sm-8">
                                             <input type="file" id="izquierda" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                  </div>
                                 </div>
                                <div class="form-group">
                                      <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">ID</label>
                                         <div class="col-sm-10">
                                             <input type="number" id="id_pronue" class="col-sm-10" disabled />
                                         </div>
                                  </div>
                                     <div class="col-sm-6">
                                          <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Linea</label>
                                             <div class="col-sm-10">
                                             <select id="lineaprod" class="col-sm-10">
                                                              <option value=''>.:Seleccione la linea:.</option>
                                                                 <?php 
                                                                   echo '<option value="'.$id_l.'">'.$nombre.'</option>';
                                                                   $resl ="select * from lineas";
                                                                   $r = mysqli_query($con,$resl);
                                                                    while($fila=  mysqli_fetch_array($r)){
                                                                            $valor1=$fila['id_linea'];
                                                                            $valor3=$fila['linea'];
                                                                            echo"<option value='".$valor3."'>".$valor3."</option>";
                                                                            }
                                                                   ?>
                                             </select>          
                                             </div>   
                                  </div>
                                </div>
                              
                                <div class="form-group">
                                  <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Codigo</label>
                                         <div class="col-sm-10">
                                         <input type="text" id="codnupro" class="col-sm-12"/>
                                         </div>
                                  </div>
                                 <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Ancho</label>
                                         <div class="col-sm-10">
                                             <input type="text" id="ancnup" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                  </div>
                              </div>
                                 <div class="form-group">
               
                                 <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Nombre</label>
                                         <div class="col-sm-10">
                                             <input type="text" id="nom_pronue" class="col-sm-12" />
                                         </div>
                                  </div>
                                     
                                  <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Alto</label>
                                         <div class="col-sm-10">
                                         <input type="text" id="alt_nuep" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                  </div>
                              </div>
                              <div class="form-group">
               
                                 <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Referencia</label>
                                         <div class="col-sm-10">
                                             <input type="text" id="ref_pronue" class="col-sm-12" />
                                         </div>
                                  </div>
                                  <div class="col-sm-6">
                                      <label class="col-sm-2 control-label no-padding-right" for="form-field-1">kit <b>?</b></label>
                                         <div class="col-sm-10">
                                         <select id="kit_nue" class="col-sm-12" style="width:80px">
                                           <option value="0">No</option>
                                           <option value="1">Si</option>
                                          </select>
                                         </div>
                                  </div>
                              </div>
                               <div class="form-group">
               
                                 <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Perforaciones</label>
                                         <div class="col-sm-10">
                                             <input type="text" id="perfo_pronue" class="col-sm-12" />
                                         </div>
                                  </div>
                                  <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Boquetes</label>
                                         <div class="col-sm-10">
                                         <input type="text" id="boque_nuep" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                  </div>
                              </div>
                              <div class="form-group">
                                 <div class="col-sm-6">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1">Altura Cuerpo Fijo o Rejilla (mm)</label>
                                         <div class="col-sm-3">
                                             <input type="text" id="alcu_pronue" class="col-sm-12" />
                                         </div>
                                  </div> 
                                  <div class="col-sm-6">
                                         <label class="col-sm-6 control-label no-padding-right" for="form-field-1">Altura Ventana Corrediza</label>
                                         <div class="col-sm-2">
                                         <input type="text" id="alven_nuep" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><b>#Modulo</b></label>
                                          <div class="col-sm-2">
                                         <input type="text" id="modn_nuep" class="col-sm-12"/>
                                         </div>
                                         </div>
                                    </div> 
                                 <div class="form-group">
                                        <div class="col-sm-6">
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Ancho C.F</label>
                                         <div class="col-sm-10">
                                             <input type="text" id="ancf_pronue" class="col-sm-12" />
                                         </div>
                                  </div>
                                  <div class="col-sm-6">
                                         <label class="col-sm-6 control-label no-padding-right" for="form-field-1">Altura Ventana Corrediza</label>
                                         <div class="col-sm-2">
                                         <input type="text" id="alvendos_nuep" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                         <label class="col-sm-2 control-label no-padding-right" for="form-field-1"><b>#Laminas</b></label>
                                          <div class="col-sm-2">
                                         <input type="text" id="lami_nuep" class="col-sm-12"/>
                                         </div>
                                  </div>
                                 </div>
                                  <div class="form-group">
                                        <div class="col-sm-6">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1">Ancho Maximo</label>
                                         <div class="col-sm-3">
                                             <input type="text" id="ancmax_pronue" class="col-sm-12" />
                                         </div>
                                  </div>
                                  <div class="col-sm-6">
                                         <label class="col-sm-6 control-label no-padding-right" for="form-field-1">Alto maximo</label>
                                         <div class="col-sm-6">
                                         <input type="text" id="altmax_nuep" class="col-sm-12" placeholder="(mm)"/>
                                         </div>
                                  </div>
                                 </div>
                                
                                
                                     <div class="form-group">
                                        <div class="col-sm-2">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1"></label>
                                         <div class="col-sm-3">
                                             <input type="hidden" id="id_ok" class="col-sm-12" />
                                         </div>
                                         </div>
                                         
                                          <div class="col-sm-2">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1"></label>
                                         <div class="col-sm-3">
                                             <input type="hidden" id="apro_id" class="col-sm-12" />
                                         </div>
                                         </div>
                                         
                                            <div class="col-sm-2">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1"></label>
                                         <div class="col-sm-3">
                                             <input type="hidden" id="aprobado_id" class="col-sm-12" />
                                         </div>
                                         </div>
                                             <div class="col-sm-2">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1"></label>
                                         <div class="col-sm-3">
                                             <input type="hidden" id="id_revi" class="col-sm-12" />
                                         </div>
                                         </div>
                                         <div class="col-sm-2">
                                         <label class="col-sm-9 control-label no-padding-right" for="form-field-1"></label>
                                         <div class="col-sm-3">
                                             <input type="hidden" id="id_actu" class="col-sm-12" />
                                         </div>
                                         </div>
                                  
                                 </div>
                                
                                <br>
                                 <div class="form-group">
                                     <div class="col-sm-6">
                                        <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                                        <div class="col-sm-10">
                                          <button class="btn btn-primary" onclick="guardar_cotn()"><i class="ace-icon fa fa-check "></i> GUARDAR </button>
                                          <button class="btn btn-danger" onclick="limpiar_cotn()"><i class="ace-icon fa fa-close "data-dismiss="modal"></i>LIMPIAR</button>
                                        </div>  
                                  </div>
                                </div>       
                                 
                              </div>
                                
                                
                            </div>
                        </div>
                       </div>
                        
                    </div>
                         </div>  
               <div id="reparto" class="tab-pane fade in">
                    <div class="tabbable">
                   <ul class="nav nav-tabs" id="myTab">
	            <li id="marcar1">
	              <a data-toggle="tab" href="#perfi">
                       <h6><B>perfiles</B></h6>
                      </a>     
                    </li>
                    <li id="marcar2">
	                <a data-toggle="tab" href="#desg">
                          <h6><B>Desglose de aluminio</B></h6>
                         </a>     
                     </li>
                   </ul>
                   <div class="tab-content">
                       <div id="perfi" class="tab-pane fade in ">
                           <div class="table-responsive">                        
                             <div id="mostrar_tabla">
                                <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                             </div>
                               
                               
                           </div>
                       </div>
                       
                        <div id="desg" class="tab-pane fade in ">
                           <div class="table-responsive">
                               
                               
                               
                           </div>
                       </div>
                       
                   </div>
               </div>
                  </div> 
         
           <div id="vidrios" class="tab-pane fade in">
               <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
	            <li id="marcar1">
	              <a data-toggle="tab" href="#vidi">
                       <h6><B>Vidrios</B></h6>
                      </a>     
                    </li>
                    <li id="marcar2">
	                <a data-toggle="tab" href="#agrevi">
                          <h6><B>Agregar vidrios</B></h6>
                         </a>     
                     </li>
                   </ul>
                   <div class="tab-content">
                       <div id="vidi" class="tab-pane fade in ">
                           <div class="table-responsive">                        
                             <div id="mostrar_tabla">
                                <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                             </div>
                               
                               
                           </div>
                       </div>
                       
                        <div id="agrevi" class="tab-pane fade in ">
                           <div class="table-responsive">
                               
                               
                               
                           </div>
                       </div>
                   </div>
                   
               </div>
            </div>
           <div id="detalle" class="tab-pane fade in">
                 <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
	            <li id="marcar1">
	              <a data-toggle="tab" href="#reji">
                       <h6><B>Rejillas</B></h6>
                      </a>     
                    </li>
                    <li id="marcar2">
	                <a data-toggle="tab" href="#agrereji">
                          <h6><B>Agregar Rejilla</B></h6>
                         </a>     
                     </li>
                   </ul>
                   <div class="tab-content">
                       <div id="reji" class="tab-pane fade in ">
                           <div class="table-responsive">                        
                             <div id="mostrar_tabla">
                                <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                             </div>
                               
                               
                           </div>
                       </div>
                       
                        <div id="agrereji" class="tab-pane fade in ">
                           <div class="table-responsive">
                               
                               
                               
                           </div>
                       </div>
                   </div>
                   
               </div>
              
          </div>
         <div id="acesorios" class="tab-pane fade in">
                 <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
	            <li id="marcar1">
	              <a data-toggle="tab" href="#aceso">
                       <h6><B>Accesorios</B></h6>
                      </a>     
                    </li>
                    <li id="marcar2">
	                <a data-toggle="tab" href="#agreaces">
                          <h6><B>Agregar Accesorio</B></h6>
                         </a>     
                     </li>
                   </ul>
                   <div class="tab-content">
                       <div id="aceso" class="tab-pane fade in ">
                           <div class="table-responsive">                        
                             <div id="mostrar_tabla">
                                <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                             </div>
                               
                               
                           </div>
                       </div>
                       
                        <div id="agreaces" class="tab-pane fade in ">
                           <div class="table-responsive">
                               
                               
                               
                           </div>
                       </div>
                   </div>
                   
               </div>
              
          </div>
         
         
          <div id="mano" class="tab-pane fade in">
               <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
	            <li id="marcar1">
	              <a data-toggle="tab" href="#descrip">
                       <h6><B>Descripcion</B></h6>
                      </a>     
                    </li>
                    <li id="marcar2">
	                <a data-toggle="tab" href="#agre">
                          <h6><B>Agregar</B></h6>
                         </a>     
                     </li>
                   </ul>
                   <div class="tab-content">
                       <div id="descrip" class="tab-pane fade in ">
                           <div class="table-responsive">                        
                             <div id="mostrar_tabla">
                                <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                             </div>
                               
                               
                           </div>
                       </div>
                       
                        <div id="agre" class="tab-pane fade in ">
                           <div class="table-responsive">
                               
                               
                               
                           </div>
                       </div>
                   </div>
                   
               </div>
          </div>
           <div id="admini" class="tab-pane fade in">
               <div class="tabbable">
                    <ul class="nav nav-tabs" id="myTab">
	            <li id="marcar1">
	              <a data-toggle="tab" href="#desadmin">
                       <h6><B>Descripcion</B></h6>
                      </a>     
                    </li>
                    <li id="marcar2">
	                <a data-toggle="tab" href="#agreadmi">
                          <h6><B>Agregar</B></h6>
                         </a>     
                     </li>
                   </ul>
                   <div class="tab-content">
                       <div id="desadmin" class="tab-pane fade in ">
                           <div class="table-responsive">                        
                             <div id="mostrar_tabla">
                                <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                             </div>
                               
                               
                           </div>
                       </div>
                       
                        <div id="agreadmi" class="tab-pane fade in ">
                           <div class="table-responsive">
                               
                               
                               
                           </div>
                       </div>
                   </div>
                   
               </div>
         </div>
         
         
    </div>

<br>

 </div>

</div>
 </div> 

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
