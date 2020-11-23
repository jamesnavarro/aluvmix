<?php
 
?>
<script src="../vistas/inventario/movimientos/list_mov/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">

        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             <input type="hidden" id="pen"  value="<?php echo $_GET['pend'] ?>" class="col-xs-10 col-sm-12"/>
              <table class="table table-hover">
  <tr class="bg-info">
        <TH>ID</TH>
        <th>PROVEEDOR</th>
        <th>COD MOV</th>
        <th nowrap>O.C</th>
        <th nowrap>DOCUMENTO</th>
        <th>BODEGA</th>
        <th NOWRAP>CONCEPTO</th>
        <th>ESTADO</th>
        <th NOWRAP>FEC REGISTRO</th>
        <th NOWRAP>QUIEN REGISTRA</th>
        <th>OPCIONES</th>
  </tr>
    <tr>
         <td></td>
          <td><input type="text" id="des" class="col-xs-10 col-sm-12"/></td>
          <td><input type="text" id="res" class="col-xs-10 col-sm-12"/></td>
          <td><input type="text" id="tmov" class="col-xs-10 col-sm-12"/></td>
          <td><input type="text" id="cons" class="col-xs-10 col-sm-12"/></td> 
          <td><input type="text" id="bdeg" class="col-xs-10 col-sm-12"/></td> 
          <td><input type="text" id="desc_m"  class="col-xs-10 col-sm-12"/></td> 
          <td><input type="text" id=""  class="col-xs-10 col-sm-12" disabled/></td>
          <td><input type="date" id="fec"  class="col-xs-10 col-sm-12"/></td> 
          <td><input type="text" id="usua_m"  class="col-xs-10 col-sm-12"/></td> 
          <td>----</td> 
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
       
         
         
         
  
     

      





