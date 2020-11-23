<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/crear_servicios/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Listado De Servicios</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
              <h6><B>SERVICIOS</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_ser()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                           <input type="text" id="nue_ser" class="form-control" placeholder="Referencia">
              
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
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">ID</label>
                             <div class="col-sm-10">
                              <input type="text" id="id_ser" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Descripcion</label>
                             <div class="col-sm-10">
                              <input type="text" id="des_ser" class="col-sm-5" />
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Referencia</label>
                             <div class="col-sm-10">
                              <input type="text" id="ref_ser" class="col-sm-5" />
                             </div>
                             </div>
                              <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Valor</label>
                             <div class="col-sm-10">
                              <input type="text" id="Val_ser" class="col-sm-5" />
                             </div>
                             </div>
                            </form>
                         </div>
                   
                       <br>
                  
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_ser()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_ser()">
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
