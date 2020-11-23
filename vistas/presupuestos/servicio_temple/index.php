<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/servicio_temple/funciones.js"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
        <h2 class="header smaller lighter blue" ><b>Parametros de servicios de temple</b></h2>
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
        <a data-toggle="tab" href="#agregar" onclick="limpiar_temple()()"><h6><B>CREAR SERVICIO</B></h6></a>
        </li>
</ul>
     <div class="tab-content">
	<div id="home" class="tab-pane fade in active">
         <div class="table-responsive">
                    <div style="margin-left: 1%; margin-top: 1%;">
                    <input type="number" id="nue_espe" class="form-control" placeholder="espesor">
                    </div>
                    <br>    
                   <div id="mostrar_tabla">
                    <br><br>
                    <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                   </div> 
        </div>
        </div>
            <br>
            <div id="agregar" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                   <div style="margin-left: 19%; margin-top: 1%;">
                       <label>ID TEMPLE</label>
                       <input type="number" id="id_tem" style="margin-left: 10%; width: 30%" disabled/>
                   </div>
                   <div style="margin-left: 19%; margin-top: 1%;">
                       <label>Espesor em (mm)</label> 
                       <input type="number" id="espes" style="margin-left: 5%; width: 30%"/>
                   </div>
                   <div style="margin-left: 19%; margin-top: 1%;">
                       <label>Costo de temple</label> 
                       <input type="text" id="cos_tem" style="margin-left: 6%; width: 30%"/>
                   </div>
                   <br>
                   <br>
                   <div style="margin-left: 31%; margin-top: 1%;">
                       <label>
                       <button  style="margin-left: 1%; " class="btn btn-lg btn-info" onclick="guardar_temple()">
	               <i class="ace-icon fa fa-check "></i>
	               GUARDAR
                       </button>
                       </label> 
                       <label>
                       <button  style="margin-left: 1%; " class="btn btn-lg btn-info" onclick="limpiar_temple()">
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
