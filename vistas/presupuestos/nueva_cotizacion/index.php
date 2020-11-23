 <?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/nueva_cotizacion/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue"><b>GENERAR COTIZACION DE PRODUCTOS</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active">
	   <a data-toggle="tab" href="#home">
            <h6><B>DATOS DEL CLIENTE</B></h6>
           </a>
        </li>
           <li>
               <a data-toggle="tab" href="#otros"><h6><B>DATOS DE LA OBRA</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                        <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> <br>
                          <div class="form-group"> 
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-2">Cedula/ Nit</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                              <button onclick="buscar_cli();" class="btn btn-lg btn-success">
	                         <i class="ace-icon fa fa fa-search"></i>
                              </button>
                             </div> 
                              <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Nombre del cliente</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5" />
                             </div> <br>
                             </div>  
                        <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Direccion del cliente</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Nombre del contacto</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <br>
                        </div>  
                             <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Departamento</label>
                             <div class="col-sm-4">
                                   <select id="ciud" onchange="cargarmun();" class="col-sm-5" >
                                  <option value="">Seleccione</option>
                                   <?php
                                    $consulta = mysqli_query($con,"select * FROM `departamentos` group BY nombre_dep");
                                    while($f = mysqli_fetch_array($consulta)){
                                    echo '<option value="'.$f['nombre_dep'].'">'.$f['nombre_dep'].'</option>'; 
                                     }
                                    ?>
                                  </select>
                             </div> 
                              <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Ciudad/ Municipio</label>
                             <div class="col-sm-4">
                               <select id="muni" class="col-sm-5" >
                                  <option value="">Seleccione</option>
                                    <?php
                                    $consulta = mysqli_query($con,"select * FROM `departamentos` group BY nombre_mun"); 
                                     while($f = mysqli_fetch_array($consulta)){
                                     echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                                        }
                                     ?>
                               </select>
                             </div> 
                              <br>
                        </div>  
                             <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Telefonos</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Telefono de contacto</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <br>
                        </div>  
                        <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Email</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Vendedor</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <br>
                        </div>  
                        
                            
                                   <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Iva</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Visita tecnica</label>
                             <div class="col-sm-4">
                               <select name="cars" class="col-sm-5">
			           <option value="SI">SI</option>
			           <option value="NO">NO</option>
		                   </select>
                             </div> 
                              <br>
                        </div>  
                             <div class="bg-info">
                                 <h5><center><b>CLIENTE TEMPORAL</b></center></h5>
	                      </div>
                            
                      <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Cedula/NIT</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <br>
                        </div>   
                        <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Nombre del cliente</label>
                             <div class="col-sm-4">
                              <input type="text" id="id_color" class="col-sm-5"/>
                             </div> 
                              <br>
                        </div> 
                     <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Servicio express</label>
                             <div class="col-sm-4">
                               <select name="cars" class="col-sm-5" >
			           <option value="SI"></option>
			           <option value="NO"></option>
		               </select>
                             </div> 
                              <br>
                        </div> 
                            <div class="form-group"> <br>
                             <label class="col-sm-2 control-label no-padding-rigt" for="form-field-1">Fecha de servicio Express</label>
                             <div class="col-sm-4">
                               <select name="cars" class="col-sm-5" >
			           <option value="SI"></option>
			           <option value="NO"></option>
		               </select>
                             </div> 
                              <br>
                        </div> 
                    </div>
                </div>
                    </div><br>
               <div id="otros" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;">                            
                         <div class="bg-info">
		          <H1><LABEL><B></B></LABEL></H1>
	                  </div>
                        <div style="margin-left: 1%; margin-top: 1%;">
                            <label>Nombre de la obra</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="text" id="form-field-1" style="margin-left: 1%; width: 20%"/>&nbsp; &nbsp;&nbsp; &nbsp;
                            <label>Direccion de la obra</label>
                            <input type="text" id="form-field-1" style="margin-left: 1%; width: 20%"/>
                        </div>
                        <div style="margin-left: 1%; margin-top: 1%;">
                            <label>Telefono</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                            <input type="text" id="form-field-1" style="margin-left: 1%; width: 20%"/>
                        </div>
                            <div style="margin-left: 1%; margin-top: 1%;">
                                  <label>Departamento</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                  <select name="cars" style="margin-left: 2%;width: 20%"  >
			           <option value="SI"></option>
			           <option value="NO"></option>
		                   </select>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                   <label>Ciudad</label>&nbsp;
                                    <select name="cars" style="margin-left: 1%;width: 20%"  >
			           <option value="SI"></option>
			           <option value="NO"></option>
		                   </select>
                            </div>
                           <div style="margin-left: 1%; margin-top: 1%;">
                                 <label>Encargado de la obra</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  
                                 <input type="text" id="form-field-1" style="margin-left: 1%; width: 20%"/>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                                 <label>Observaciones</label> &nbsp;
                                 <textarea id="form-field-1" style="margin-left: 1%; width: 20%"></textarea>
                            </div>
                        <div style="margin-left: 1%; margin-top: 1%;">
                            <label>Analista </label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
                                   <select name="cars" style="margin-left: 2%;width: 20%"  >
			           <option value="SI"></option>
			           <option value="NO"></option>
		                   </select>
                             <button  style="margin-left: 13%; width: 5% " class="btn btn-lg btn-info">
	                     <i class="ace-icon fa "></i>
	                     ?
                             </button>
                             <button  style="margin-left: 1%; width: 10% " class="btn btn-lg btn-info">
	                     <i class="ace-icon fa "></i>
	                     Politicas
                             </button>
                        </div>
                              <div style="margin-left: 1%; margin-top: 1%;">
                                  <label>Validez de oferta</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                  <input type="text" id="form-field-1" style="margin-left: 1%; width: 20%"/>
                              </div>
                         <div style="margin-left: 1%; margin-top: 1%;">
                                  <label>Forma de pago</label> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                  <input type="text" id="form-field-1" style="margin-left: 1%; width: 20%"/>
                         </div>
                       <br>
                         </div> 
                  
                        </div>

<br>
 <button  style="margin-left: 1%; " class="btn btn-lg btn-info">
	<i class="ace-icon fa fa-check "></i>
	 GUARDAR DATOS
</button>
 </div>

</div>
 </div> 
</div>
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         