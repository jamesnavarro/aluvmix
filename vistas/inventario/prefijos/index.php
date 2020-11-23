<?php
 include('../../../modelo/conexioni.php');
?>
<script src="../vistas/inventario/prefijos/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
    </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_pref();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
                <tr class="bg-info">
                  <th>ID</th> 
                  <th>CODIGO</th>
                  <th>TIPO MOVIMIENTO</th>
                  <th>FUENTE</th>
                  <th>ULTIMO CONSECUTIVO</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
          <tr>
               <td><input type="text" id="cod"  placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
               <td><input type="text" id="des"  placeholder="" class="col-xs-10 col-sm-12"/></td> 
               <td><input type="text" id="resT" placeholder="" class="col-xs-10 col-sm-12"/></td> 
               <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
               <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
            
          </tr>
 <tbody id="mostrar_tabla">    
     </tbody>
     </table>
         </div>
         <div id="lin2" class="tab-pane fade in">
            <div class="modal-header">
              <h4 class="modal-title">Formulario</h4>
            </div>
            <div class="form-horizontal" role="form">
              <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Id</label>
                 <div class="col-sm-9">
                 <input type="text" id="id_pref" placeholder="" class="col-xs-10 col-sm-5" disabled />
                 </div>
              </div>
             <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                 <div class="col-sm-9">
                 <input type="text" id="cod_pref" placeholder="" class="col-xs-10 col-sm-5" />
                 </div>
              </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo de movimiento</label>
                    <div class="col-sm-9">
                    <input type="text" id="tipo_pref" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                  </div>
  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fuente</label>
                    <div class="col-sm-9">
                    <input type="text" id="fuente_pref" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
  </div>
 <div class="form-group">
         <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ultimo consecutivo</label>
         <div class="col-sm-9">
         <input type="text" id="ult_pref" placeholder="" class="col-xs-10 col-sm-5" />
         </div>
 </div>
          
                   
<div class="form-actions">
    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
    <button type="button" class="btn btn-success" onclick="guardar_pref()">Guardar</button>
    <button type="button" class="btn btn-danger" onclick="limpiar_prefi()">Nuevo
 <i data-dismiss="modal"></i></button>
</div>
                     </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





