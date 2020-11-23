<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/burros/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_burros();"><h6><B>Crear burro</B></h6></a>
        </li>
 </ul>
 <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
          <div class="table-responsive">
             <br>
                 <table class="table table-hover">
                   <tr class="bg-info">
                   <th>ID</th> 
                   <th>NOMBRE</th>
                   <th>ESTADO</th>
                   <th>Opciones</th>
                   </tr>
             <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" /></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-8" /></td>
        <td>
            <select id="est_b" class="col-xs-10 col-sm-5">
              <option value="">Todos</option>
	      <option value="Ocupado">Ocupado</option>
	      <option value="Desocupado">Desocupado</option> 
            </select>
        </td>
    </tr>
    <tbody id="mostrar_tabla"> 
    </tbody>
</table>                   
       </div>
      </div><br>
          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                       <div class="col-sm-9">
                      <div class="col-sm-9">
                         <input type="text" id="id_bur" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                       </div>
                       </div>
                    </div>
                   <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre del burro</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="descrip_bur" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                         <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                       <select id="esta_b" class="col-xs-10 col-sm-5">
                            <option value="">Todos</option>
			    <option value="Ocupado">Ocupado</option>
			    <option value="Desocupado">Desocupado</option> 
                           
                        </select>
                       </div>
                      </div>
                   </div>
                       <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Planta</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                       <select id="planta_b" class="col-xs-10 col-sm-5">
                            <option value="">Todos</option>
			    <option value="0">Barranquilla</option>
			    <option value="1">Galapa</option> 
                        </select>
                       </div>
                      </div>
                   </div>
                   <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_burros()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_burros()">Nuevo
                      <i data-dismiss="modal"></i></button>
                   </div>
               </div> 
             </div>
          </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





