<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/crear_mo/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Lista De Precio Por Mano De Obra</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
              <h6><B>LISTA</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_prec()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                           <input type="text" id="nue_pr" class="form-control" placeholder="Referencia">
              
                       </div>
                        <br>
                        
                        
                         <div id="mostrar_tabla">
        <br><br>
        <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
    </div>       
                </div>
                    </div><br>
               <div id="agregar" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <div class="col-xs-12" style="margin-left:6%;">
                            <form class="form-horizontal" role="form">
                            <br>
                            <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">ID PRECIO</label>
                             <div class="col-sm-10">
                             <input type="text" id="id_pr" class="col-sm-5"  disabled/>
                             </div>   
                            </div>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Referencia</label>
                             <div class="col-sm-10">
                             <input type="text" id="refer_n" class="col-sm-5" />
                             </div> 
                            </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Descripcion</label>
                             <div class="col-sm-10">
                             <input type="text" id="descrip_n" class="col-sm-5" />
                             </div>
                            </div>
                            <br>
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Es una instalacion?</label>
                             <div class="col-sm-10">
                                <select id="es_ins" class="col-sm-5" required>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                                </select>
                             </div>
                             </div>
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">forma de cobro?</label>
                             <div class="col-sm-10">
                                <select id="for_cob" class="col-sm-5" required>
                                  <option value="Und">Und</option>
                                  <option value="M2">M2</option>
                                  <option value="ML">ML</option>
                                  <option value="KG">KG</option>
                                </select>
                             </div>
                             </div>
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Utilidad por servicio</label>
                             <div class="col-sm-10">
                                 <input type="text" id="uti_serv" class="col-sm-5" /><b>%</b>
                             </div>
                             </div>
                            </form>
                         </div>
                       <div></div>
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_prec()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_prec()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                       </div>
                       
                       <br>
                         </div> 
                  
                        </div>

<br>

 </div>

</div>
</div>  
    
    <br>
    <script src="../vistas/crear_mo/funciones_euipo.js"></script>
    <div class="page-content">
 <div class="table-responsive"> 
     <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Maquinas Y Equipos</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar3">
	   <a data-toggle="tab" href="#nhome">
              <h6><B>LISTA</B></h6>
           </a>
        </li>
        <li id="marcar4">
               <a data-toggle="tab" href="#nagregar" onclick="limpiar_equipo()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="nhome" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                           <input type="text" id="nue_equi" class="form-control" placeholder="Referencia">
              
                       </div>
                        <br>
                        
                        
                         <div id="mostrar_tabla_e">
        <br><br>
        <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
    </div>       
                </div>
                    </div><br>
               <div id="nagregar" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <div class="col-xs-12" style="margin-left:6%;">
                            <form class="form-horizontal" role="form">
                            <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">ID</label>
                             <div class="col-sm-10">
                              <input type="text" id="id_equi" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Referencia</label>
                             <div class="col-sm-10">
                              <input type="text" id="refer_equi" class="col-sm-5" />
                             </div> 
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Descripcion</label>
                             <div class="col-sm-10">
                              <input type="text" id="descrip_equipo" class="col-sm-5" />
                             </div>
                             </div>
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Valor equipo</label>
                             <div class="col-sm-10">
                              <input type="text" id="valor_equipo" class="col-sm-5" />
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Calcular por</label>
                             <div class="col-sm-10">
                                <select id="calcular" class="col-sm-5" required>
                                          <option value="Porcentaje">Porcentaje</option>
                                          <option value="Unidad">Unidad</option>
                               </select>
                             </div>
                             </div>
                                <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Cobro por dias?</label>
                             <div class="col-sm-10">
                                <select id="dias_equi" class="col-sm-5" required>
                                          <option value="No">No</option>
                                          <option value="Si">Si</option>
                                          
                                </select>
                             </div>
                             </div>
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1"># Dias</label>
                             <div class="col-sm-10">
                                 <input type="text" id="num_dias" class="col-sm-5" />
                             </div>
                             </div>
                            </form>
                         </div>
                       <div></div>
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_equipo()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_equipo()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                       </div>
                       
                       <br>
                         </div> 
                  
                        </div>

<br>

 </div>

</div>
    

    
 </div> 
</div>
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
