<?php
include('../../../modelo/conexioni.php');
?>
<script src="../vistas/contabilidad/cargo/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Cargos</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_car();" href="#lin2"><h6><B>Crear cargo</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">
        <th>ID</th>
        <th>NOMBRE</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
  </tr>
    <tr>
         <td>
              <input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/>
        </td>
         <td>
              <input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-12"/>
        </td>
          <td>
             <select id="des" class="col-xs-10 col-sm-12">
                             <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>
             </select>
         
        </td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id cargo</label>
                            <div class="col-sm-9">
                            <input type="text" id="id_car" class="col-xs-10 col-sm-5" disabled />
                         </div>
                        </div>  
                       
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre del cargo</label>
                          <div class="col-sm-9">
                         <input type="text" id="nombre_carg" placeholder="escriba su contraseña" class="col-xs-10 col-sm-5" />
                         </div>
                        </div>
                        
                       <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                        <div class="col-sm-9">
                         <select id="estado_carg" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>
                         </select>
                       </div>
                    </div>
                  
                   </div> 
                 
                  <div class="form-actions">
                  <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                  <button type="button" class="btn btn-success" onclick="guardar_car()">Guardar</button>
                  <button type="button" class="btn btn-danger" onclick="limpiar_car()">Nuevo
                  <i data-dismiss="modal"></i></button>
                 </div>
          </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





