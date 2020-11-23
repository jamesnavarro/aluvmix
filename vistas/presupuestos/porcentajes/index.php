<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/porcentajes/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Mantenimiento De Porcentajes (Vidrios, Accesorios Y Otros Conceptos)</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
              <h6><B>PORCENTAJES</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_porcentajes()"><h6><B>CREAR PORCENTAJE</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                         <div id="mostrar_tabla">
                         <br><br>
                         <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                        </div>
                        
                </div>
                    </div><br>
               <div id="agregar" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                       <div style="margin-left: 19%; margin-top: 1%;">
                           <label>ID Porc</label>
                           <input type="number" id="id_porc" style="margin-left: 18%; width: 30%" disabled/>
                       </div>
                      <div style="margin-left: 19%; margin-top: 1%;">
                            <label>Nombre linea</label> 
                              <select id="linea" required class="span4" style="margin-left:13%; width: 29%"> 
                                        <option value="Aluminio">Aluminio</option>
                                        <option value="Vidrio">Vidrio</option>
                                        <option value="Acero">Acero</option> 
                                        <option value="Accesorios">Accesorios</option>
                                        <option value="Espaciadores">Espaciadores</option>
                                        <option value="Interlayer">Interlayer</option>
                                 </select>
                        </div>
                              <div style="margin-left: 19%; margin-top: 1%;">
                                  <label>Porcentaje <b>desperdicio</b></label> 
                                  <input type="text" id="por1" style="margin-left: 6%; width: 30%"/>
                              </div>
                         <div style="margin-left: 19%; margin-top: 1%;">
                             <label>Porcentaje <b>ventas</b></label> 
                                  <input type="text" id="por2" style="margin-left: 10%;  width: 30%"/>
                     
                  
                       <div style="margin-left: 31%; margin-top: 1%;">
                           <label>
                                 <button  style="margin-left: 1%; " class="btn btn-lg btn-info" onclick="guardar_porcentaje()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                            </label> 
                            <label>
                                 <button  style="margin-left: 1%; " class="btn btn-lg btn-info" onclick="limpiar_porcentajes()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
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
