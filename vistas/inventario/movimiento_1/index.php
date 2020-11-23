<?php
 
?>
<script src="../vistas/inventario/movimiento/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_mov();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>CODIGO</th> 
        <th>DESCRIPCION</th>
        <th>IVA</th>
        <th>COD. CONTABLE</th>
        <th>COD. FUENTE</th>
        <th>TIP MOVIMIENTO</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
  </tr>
    <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td></td>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12"/></td> 
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12"/></td> 
          <td><select id="res"  class="col-xs-10 col-sm-7">
                            <option value=""></option>
                            <option value="ENTRADA">ENTRADA</option>
                            <option value="SALIDA">SALIDA</option>
                        </select></td> 
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                    <input type="text" id="mov_cod" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Movimiento</label>
                    <div class="col-sm-9">
                    <input type="text" id="mov_nomb" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Observacion</label>
                    <div class="col-sm-9">
                     <select id="mov_tipo"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="ENTRADA">ENTRADA</option>
                            <option value="SALIDA">SALIDA</option>
                        </select>
                    </div>
                    </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ultimo consecutivo</label>
                    <div class="col-sm-9">
                    <input type="text" id="mov_ultconsec" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                 </div>
                 
                  
                 <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo contable</label>
                    <div class="col-sm-9">
                     <input type="text" id="mov_codcontab" placeholder="" class="col-xs-10 col-sm-2" />&nbsp;
                    <button onclick="buscar_codcon();" class="btn btn-lg btn-success">
	                         <i class="ace-icon fa fa fa-search"></i>
                              </button>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo Fuente</label>
                    <div class="col-sm-9">
                     <input type="text" id="mov_codfuente" placeholder="" class="col-xs-10 col-sm-2" />&nbsp;
                     <button onclick="buscar_codfuente();" class="btn btn-lg btn-success">
	                         <i class="ace-icon fa fa fa-search"></i>
                              </button>
                    </div>
                    </div>
                             <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                      <select id="estado_mov"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="1">Activo</option>
                            <option value="0">No activo</option>
                        </select>
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Activar orden de produccion</label>
                    <div class="col-sm-9">
                      <select id="mov_actprod" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                      </select>
                    </div>
                    </div>
                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Actualizar contabilidad</label>
                    <div class="col-sm-9">
                      <select id="mov_actuconta" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Equivalencia</label>
                    <div class="col-sm-9">
                    <input type="text" id="mov_equivale" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                              <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Centro de costo</label>
                    <div class="col-sm-9">
                      <select id="centro_c" class="col-xs-5 col-sm-2">
                            <option value="">Seleccione</option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                    </div>
                       
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_mov()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_mov()">Nuevo
                         <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





