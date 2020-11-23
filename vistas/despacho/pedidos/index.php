<?php
?>
<script src="../vistas/despacho/pedidos/funciones.js?<?php echo rand(1,100) ?>"></script>
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
        <th>ITEMS</th> 
        <th>PEDIDO</th>
       
  </tr>
  <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
    
    </tr>
 <tbody id="mostrar_tabla"></tbody>
</table>
</div>
            
<div id="lin2" class="tab-pane fade in">
   <div class="form-horizontal" role="form">
      <div class="form-group">
           <label class="col-sm-3 control-label no-padding-right" for="form-field-2">ID</label>
            <div class="col-sm-9">
              <input type="text" id="id_tip" placeholder="digite el codigo" class="col-xs-10 col-sm-5"disabled />
             </div>
      </div>
<div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Identificacion</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="numero" class="col-xs-5 col-sm-2" />
                     <input type="text" id="nom_cxp" placeholder="nombre" class="col-xs-5 col-sm-2" />
                      <input type="text" id="nom_cxp" placeholder="apellido" class="col-xs-5 col-sm-2" />
                    </div>
  </div>
       <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Num de remision</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Asesor</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Plazo</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ord de compra</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
           <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">% DPF</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
                <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fecha Vencimiento</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
       <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Moneda</label>
            <div class="col-sm-9">
                  <select id="reteica_cxp"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="pesos">Pesos</option>
                            <option value=""></option>
                        </select>
                    </div>
  </div>
       
      <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tasa de cambio</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
                 <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">% DPP</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>      
             <div class="form-group">
            <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Pedido agente</label>
            <div class="col-sm-9">
                    <input type="text" id="nom_cxp" placeholder="" class="col-xs-10 col-sm-5" />
              </div>
  </div>
 
                   
      <div class="form-actions">
                  <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                  <button type="button" class="btn btn-success" onclick="guardar_ped()">Guardar</button>
                  <button type="button" class="btn btn-danger" onclick="limpiar_cxp()">Nuevo
                  <i data-dismiss="modal"></i></button>
      </div>
      </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





