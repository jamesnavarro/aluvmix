<?php
include('../../../modelo/conexioni.php');
?>
<script src="../vistas/inventario/conf_clasificaciones/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_clasif();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>ITEM</th> 
        <th>ESTANTE</th>
        <th>OPCIONES</th>
       
  </tr>
    <tr>
        <td><input type="text" id="item" placeholder="item" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="estant" placeholder="nombre" class="col-xs-10 col-sm-12"/></td> 
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">ID</label>
                    <div class="col-sm-9">
                        <input type="text" id="id_estan"  placeholder="id" class="col-xs-10 col-sm-5" disabled />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Estante</label>
                    <div class="col-sm-9">
                    <input type="text" id="estante_f" placeholder="descripcion de la linea" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    </div>
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_clasif()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_clasif()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
        
         
         
  
     

      





