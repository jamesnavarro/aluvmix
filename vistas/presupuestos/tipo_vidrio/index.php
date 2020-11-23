<?php
include('../../../modelo/conexioni.php');

session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/tipo_vidrio/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_tvidrios)"><h6><B>Crear grupo</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
 <tr class="bg-info">
        <th>ID</th> 
        <th>NOMBRE DE VIDRIO</th>
        <th>ESTADO</th>
        <th>OPCIONES</th>
      
  </tr>
    <tr>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-8" /></td>
        
      
    </tr>
        <tbody id="mostrar_tabla"></tbody>
</table>
                             
       </div>
                    </div><br>

          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_tvidrio" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion del vidrio</label>
                    <div class="col-sm-9">
                     <div class="col-sm-9">
                    <input type="text" id="descrip_vi" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                    </div>
                    </div>
                    </div>
                   
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                        <select id="estado_tvi" class="col-sm-5">
                            <option value="">Seleccione</option>
			    <option value="0">Activo</option>
			    <option value="1">Inactivo</option> 
		        </select>
                    </div>
                    </div>
                 
                       
                    <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                    <button type="button" class="btn btn-success" onclick="guardar_tvidrios()">Guardar</button>
                    <button type="button" class="btn btn-danger" onclick="limpiar_tvidrios()">Nuevo
                    <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
  
         
         <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>   
  
     

      





