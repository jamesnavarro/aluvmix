<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
    //9488
?>
<script src="../vistas/planeacion/terceros/funciones.js?v=1.7"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" >
            <b>Informacion de terceros</b></h2>
        </div>
   </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
           <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_terp()"><h6><B>Crear Tercero</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                 <div class="table-responsive">
                   <br>
                   <button onclick="validarfull()">Validar</button>
                   <table class="table table-hover"> 
                           <tr class="bg-info">
                               <th>ITEM</th>
                             <th>TIPO DE DOC</th> 
                                 <th>NRO DOCUMENTO</th>
                                 <th>NOMBRE DESCRIPCION</th>
                                 <th>TELEFONO</th>
                                 <th>ESTADO</th>
                                 <th>VALIDA EN FOM</th>
    </tr> 
                              
    <tr>
         <td></td>
         <td></td>
          <td><input type="text" id="busTER" placeholder="" class="col-xs-10 col-sm-12"/></td>
          <td><input type="text" id="busDOC" placeholder="" class="col-xs-10 col-sm-12"/></td>
         <td></td>
    </tr>
                   
    <tbody id="mostrar_tabla"> 
    </tbody>   
                   
   </table>
                   <button onclick="validarfull()">Validar</button>
            
       </div>
                    </div><br>
               <div id="agregar" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <div class="col-xs-12" style="margin-left:6%;">
                            <form class="form-horizontal" role="form">
                                <br>
                            <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1"></label>
                             <div class="col-sm-10">
                                 <input type="hidden" id="id_t" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                                  <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Tipo de documento</label>
                     
                        <div class="col-sm-10">
                                <select id="tipo_doct" class="span4" onchange="mostrarCot()">
                                    <option value="Nit">Nit</option>
                                    <option value="CC">Cedula</option>
                                    <option value="PAS">Pasaporte</option>
                                    <option value="CE">Cedula de extrangeria</option>
                                </select>
                            
                        </div></div>
                       
                                        <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Numero</label>
                             <div class="col-sm-10">
                                 <input type="text" id="num_t" class="col-sm-5"/>
                             </div>   
                             </div>
                             <div class="form-group">
                                   <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Nombre<b>/</b>Razon social</label>
                             <div class="col-sm-10">
                              <input type="text" id="nombre_t" class="col-sm-5"/>
                             </div>
                             </div>
                         
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Direccion</label>
                             <div class="col-sm-10">
                              <input type="text" id="dir_t" class="col-sm-5" />
                             </div>
                             </div>
                                        <div class="form-group" > 
                                            <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Telefono Fax<b>/</b>fijo</label>
                             <div class="col-sm-10">
                                 <input type="text" id="tel_t" class="col-sm-5"/>
                             </div>   
                             </div>
                                        <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Telefono Movil </label>
                             <div class="col-sm-10">
                                 <input type="text" id="movil_t" class="col-sm-5" />
                             </div>   
                             </div>
                 <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Departamento</label>
                                <select id="dep_p" class="col-xs-10 col-sm-5" onchange="cargarmundo();">
                                 <option value="">Seleccione</option>
                                 <?php
                                 $consulta = mysqli_query($con, "select * FROM `departamentos` group BY nombre_dep"); 
                                 while($f = mysqli_fetch_array($consulta)){ 
                                  echo '<option value="'.$f['nombre_dep'].'">'.$f['nombre_dep'].'</option>'; 
                            }
                            ?>
                      </select> 
                             </div>
              <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Ciudad/Municipio</label>
                             <div class="col-sm-10">
                                 <select id="ciu_t" class="col-xs-10 col-sm-5">
                                 <option value="">Seleccione</option>
                                <?php
                                   $consulta = mysqli_query($con, "select * FROM `departamentos` group BY nombre_mun");
                                   while($f = mysqli_fetch_array($consulta)){
                                   echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>'; 
                                   }
                                 ?>
                      </select>
                             </div>   
                             </div>
                                      <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Correco electronico</label>
                             <div class="col-sm-10">
                                 <input type="text" id="correo_t" class="col-sm-5"/>
                             </div>   
                             </div>
                            
                                    <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Estado</label>
                             <div class="col-sm-10">
                                     <select id="est_tp" class="span4" onchange="mostrarCot()">
                                    <option value="0">Activo</option>
                                    <option value="1">Inactivo</option>
                                </select>
                             </div>   
                             </div>
                     
                      
                       
                            </form>
                         </div>
                   
                       <br>
                  
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_terp()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_terp()">
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
 
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
