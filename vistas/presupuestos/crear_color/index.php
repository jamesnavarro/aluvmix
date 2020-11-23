<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/crear_color/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Colores Del Aluminio</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active"  id="marcar1">
	   <a data-toggle="tab" href="#home">
              <h6><B>LISTA</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_color()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                           <input type="text" id="precolor" class="form-control" placeholder="color de aluminio">
              
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
                       <form class="form-horizontal" role="form">
                           <div class="col-xs-12" style="margin-left:6%;">
                                <br>
                            <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">ID</label>
                             <div class="col-sm-10">
                              <input type="text" id="id_color" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Color de aluminio</label>
                             <div class="col-sm-10">
                                  <input type="text" id="color_alumi" class="col-sm-5"/>
                             </div> 
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Costo de aluminio</label>
                             <div class="col-sm-10">
                                 <input type="number" id="cost_alumi" class="col-sm-5" placeholder="$"/>
                             </div>
                             </div>
                            <br>                        
                             </div>
                            </form>
                       <br>
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_color()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_color()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                         </div>
                        <br>
                       </div>
                       
                       <br>
                         </div> 
                  
                        </div>

<br>
<br>

 </div>

</div>


 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
