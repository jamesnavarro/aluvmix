<?php
 
?>
<script src="../vistas/inventario/bodegas/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_bod();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>CODIGO</th> 
        <th>DESCRIPCION</th>
        <th>NOMBRE RESUMIDO</th>
        <th>SEDE</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
  </tr>
    <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="res" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><select id="est"><option value="">Todos</option><option value="0">Activo</option><option value="1">No activo</option></select></td>
  
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                    <input type="text" id="bod_cod" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre</label>
                    <div class="col-sm-9">
                    <input type="text" id="bod_nomb" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Nombre resumido </label>
                    <div class="col-sm-9">
                    <input type="text" id="bod_resum" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cuenta</label>
                    <div class="col-sm-9">
                    <input type="text" id="bod_cuenta" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cuenta API</label>
                    <div class="col-sm-9">
                    <input type="text" id="ctaapi_bod" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                             <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                      <select id="estado_bod" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">No activo</option>
                        </select>
                    </div>
                    </div>
                  
                    
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ciudad</label>
                    <div class="col-sm-9">
                    <input type="text" id="ciudad_bod" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo ICA</label>
                    <div class="col-sm-9">
                    <input type="text" id="codica_bod" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costos</label>
                    <div class="col-sm-9">
                    <input type="text" id="costos_bod" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo Nit</label>
                    <div class="col-sm-9">
                    <input type="text" id="codnit_bod" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">SEDE</label>
                    <div class="col-sm-9">
                      <select id="sed_bod"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="CALLE 72">CALLE 72</option>
                            <option value="GALAPA">GALAPA</option>
                        </select>
                    </div>
                    </div>
                       
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_bod()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_bod()">Nuevo<i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





