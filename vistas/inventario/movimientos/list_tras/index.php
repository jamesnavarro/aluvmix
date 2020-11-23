<?php
 
?>
<script src="../vistas/inventario/movimientos/list_tras/funciones.js"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">
        <th>ID MOVIMIENTO</th>
        <th>COD MOVIMIENTO</th>
        <th>TIPO MOVIMIENTO</th>
        <th>MOVIMIENTO</th>
        <th>ESTADO</th>
        <th>VER</th>
  </tr>
    <tr>
        <td><input type="hidden" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/>
        <input type="text" id="des" placeholder="radicado de documento" class="col-xs-10 col-sm-12"/></td>
         <td></td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
  
         
          <div id="lin2" class="tab-pane fade in">
                <div class="modal-header">
                  <h4 class="modal-title">FORMULARIO</h4>
                  </div>
               
                   <div class="form-horizontal" role="form">
 
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Descripcion del color </label>
                    <div class="col-sm-9">
                    <input type="text" id="fdes" placeholder="descripcion de la grupo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Nombre resumido </label>
                    <div class="col-sm-9">
                    <input type="text" id="fres" placeholder="descripcion de la grupo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Estado </label>
                    <div class="col-sm-9">
                        <select id="fest">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">No activo</option>
                        </select>
                    </div>
                    </div>
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_lin()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_lin()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





