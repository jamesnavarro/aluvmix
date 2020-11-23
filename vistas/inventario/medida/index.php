<?php
include('../../../modelo/conexioni.php');
?>

<script src="../vistas/inventario/medida/funciones.js?<?php echo rand(1,100) ?>"></script>


<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
     </li>
     <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_medida();" href="#lin2"><h6><B>Agregar</B></h6></a>
     </li>
     </ul>
       <div class="tab-content">
       <div id="lin1" class="tab-pane fade in active">
  <table class="table table-hover">
       <tr class="bg-info">
         <th>CODIGO</th> 
         <th>DESCRIPCION</th>
         <th>NOMBRE RESUMIDO</th>
         <th>TIP MEDIDA</th>
         <th>ESTADO</th>
         <TH>OPCIONES</TH>
        </tr>
       <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="res" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><select id="est"><option value="">Todos</option><option value="1">Activo</option><option value="0">No activo</option></select></td>
        

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
                    <input type="text" id="fcod" onchange="inv_buscar_medida();" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Descripcion </label>
                    <div class="col-sm-9">
                    <input type="text" id="fdes" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Nombre resumido </label>
                    <div class="col-sm-9">
                    <input type="text" id="fres" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Medida Horizontal</label>
                    <div class="col-sm-9">
                    <input type="text" id="fmedh" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Medida Vertical</label>
                    <div class="col-sm-9">
                    <input type="text" id="fmedv" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                            <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Separacion(m)</label>
                    <div class="col-sm-9">
                    <input type="text" id="fsepa" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo de medida</label>
                    <div class="col-sm-9">
                      <select id="ftipom">
                            <option value=""></option>
                            <option value="Compuesta">Compuesta</option>
                            <option value="Ninguna">Ninguna</option>
                        </select>
                    </div>
                    </div>
                    
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Estado </label>
                    <div class="col-sm-9">
                        <select id="fest">
                            <option value=""></option>
                            <option value="1">Activo</option>
                            <option value="0">No activo</option>
                        </select>
                    </div>
                    </div>
                     <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_medida()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_medida()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                    </div>                
                   </div>
               </div>
        </div> 
       
        
         
         
  
     

      





