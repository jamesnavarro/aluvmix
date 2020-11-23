<?php
?>
<script src="../vistas/contabilidad/cod_contables/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_cod();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
  <tr class="bg-info">

        <th>ID</th> 
        <th>CODIGO</th>
        <th>NOMBRE O DESCRIPCION</th>
        <th nowrap>COD TRIBUTARIO</th>
        <th>ESTADO</th>
        <th>OPCIONES</th>
  </tr>
    <tr>
         <td><input type="text" id="res" placeholder="Descripcion" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><select id="est"><option value="">Todos</option><option value="0">Activo</option><option value="1">No activo</option></select></td>
  
         <td></td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_cod_c" placeholder="digite el codigo" class="col-xs-10 col-sm-5" disabled/>
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                    <input type="text" id="cont_cod" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion Contable</label>
                    <div class="col-sm-9">
                    <input type="text" id="cont_contable" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Descripcion FISCAL</label>
                    <div class="col-sm-9">
                    <input type="text" id="cont_fiscal" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                            <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion NIIF</label>
                    <div class="col-sm-9">
                    <input type="text" id="cont_niif" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                
                             <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Naturaleza</label>
                    <div class="col-sm-9">
                      <select id="cod_naturaleza"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="0">Debito</option>
                            <option value="1">Credito</option>
                             <option value="0">Anexo tercero</option>
                        </select>
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo T.R.M</label>
                    <div class="col-sm-9">
                      <select id="cod_trm"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="0">Ninguno</option>
                        </select>
                    </div>
                    </div>
                                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo tributario</label>
                    <div class="col-sm-9">
                    <input type="text" id="cod_tributario" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                  
                    
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo presupuesto</label>
                    <div class="col-sm-9">
                    <input type="text" id="cod_presupuesto" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                   
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_cod()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_cod()">Nuevo<i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





