<?php
include('../../../modelo/conexioni.php');
?>
<script src="../vistas/contabilidad/tipo_cta/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Cuentas</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_cta();" href="#lin2"><h6><B>Crear cuentas</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
                <tr class="bg-info">
                  <th>CODIGO</th>
                  <th>DESCRIPCION</th>
                  <th>CUENTA</th>
                  <th>OPCIONES</th>
                 </tr>
    <tr>
         <td>
              <input type="text"  placeholder="" class="col-xs-10 col-sm-12" disabled/>
        </td>
         <td>
             <input type="text" id="cod" onchange="bus_cod();" class="col-xs-10 col-sm-12"/>
        </td>
          <td>
           <input type="text" id="des" placeholder="" class="col-xs-10 col-sm-12"/>
         
        </td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                       
                        <div class="form-group">
                            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">ID</label>
                            <div class="col-sm-9">
                            <input type="text" id="id_cta" class="col-xs-10 col-sm-5" disabled />
                         </div>
                        </div>  
                       
                        <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                          <div class="col-sm-9">
                         <input type="text" id="cod_cta" placeholder="escriba su contraseña" class="col-xs-10 col-sm-5" />
                         </div>
                        </div>
                        
                       <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion de la cuenta</label>
                        <div class="col-sm-9">
                         <input type="text" id="desc_cta" placeholder="escriba su contraseña" class="col-xs-10 col-sm-5" />
                       </div>
                    </div>
                       
                   <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cuenta</label>
                        <div class="col-sm-9">
                         <input type="text" id="cuenta_cta" placeholder="escriba su contraseña" class="col-xs-10 col-sm-5" />
                       </div>
                   </div>
                  
                   </div> 
                 
                  <div class="form-actions">
                  <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                  <button type="button" id="" class="btn btn-success" onclick="guardar_cta()">Guardar</button>
                  <button type="button" class="btn btn-danger" onclick="limpiar_cta()">Nuevo
                  <i data-dismiss="modal"></i></button>
                 </div>
          </div>
  </div>
               </div>
        </div> 
       
         
         
         
  
     

      





