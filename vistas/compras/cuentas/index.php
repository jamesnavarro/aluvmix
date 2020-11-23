<?php
?>
<script src="../vistas/compras/cuentas/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_cxp();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
  <tr class="bg-info">
        <th>CODIGO</th> 
        <th>NOMBRE</th>
        <th>CUENTA</th>
        <th>&nbsp;&nbsp;&nbsp;&nbsp; % RET</th>
        <TH>% IVA</TH>
        <TH>% ICA</TH>
        <TH>OPCIONES</TH>
  </tr>
  <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td></td>
        <td><input type="text" id="res" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td></td>
    </tr>
 <tbody id="mostrar_tabla"></tbody>
</table>
</div>
            
<div id="lin2" class="tab-pane fade in">
   <div class="form-horizontal" role="form">
      <div class="form-group">
           <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
            <div class="col-sm-9">
              <input type="text" id="cod_cxp" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
             </div>
      </div>
<div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cuenta</label>
                    <div class="col-sm-9">
                    <input type="text" id="cta_cxp" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
<div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Retefuente</label>
                    <div class="col-sm-9">
                     <select id="rete_cxp"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
  </div>
                 
 <div class="form-group">
           <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Rete iva</label>
           <div class="col-sm-9">
           <select id="reteiva_cxp"  class="col-xs-10 col-sm-5">
                   <option value=""></option>
                   <option value="1">Si</option>
                   <option value="0">No</option>
           </select>
           </div>
</div>
  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Rete ica</label>
                    <div class="col-sm-9">
                     <select id="reteica_cxp"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                 </div>
                       
      <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Porsentaje retefuente</label>
             <div class="col-sm-9">
              <input type="text" id="porc_rete" placeholder="" class="col-xs-10 col-sm-5" />
             </div>
       </div>
                       
      <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Porcentaje IVA</label>
             <div class="col-sm-9">
               <input type="text" id="por_iva" placeholder="" class="col-xs-10 col-sm-5" />
             </div>
      </div>
                       
      <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Porcentaje ICA</label>
                  <div class="col-sm-9">
                  <input type="text" id="por_ica" placeholder="" class="col-xs-10 col-sm-5" />
                  </div>
      </div>
                       
      <div class="form-group">
                  <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Base</label>
                  <div class="col-sm-9">
                  <input type="text" id="base_cxp" placeholder="" class="col-xs-10 col-sm-5" />
                  </div>
      </div>
                   
      <div class="form-actions">
                  <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                  <button type="button" class="btn btn-success" onclick="guardar_cxp()">Guardar</button>
                  <button type="button" class="btn btn-danger" onclick="limpiar_cxp()">Nuevo
                  <i data-dismiss="modal"></i></button>
      </div>
      </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





