<?php
 include('../../../modelo/conexioni.php');
?>
<script src="../vistas/contabilidad/modulos/funciones.js?<?php echo rand(1,100); ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_mod();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">

              <table class="table table-hover">
  <tr class="bg-info">

        <th>ID</th> 
        <th>MENU</th>
        <th>SUB MENU</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
  </tr>
    <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td>
        <td><select id="res"><option value="">Todos</option><option value="0">Activo</option><option value="1">No activo</option></select></td>
  
         <td></td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
  
         
          <div id="lin2" class="tab-pane fade in">
                <div class="modal-header">
                  <h4 class="modal-title">REGISTRO DE MODULOS</h4>
                  </div>
               
                   <div class="form-horizontal" role="form">
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">ID</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_mod" class="col-xs-10 col-sm-5" disabled/>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">MENU PRINCIPAL</label>
                    <div class="col-sm-9">
                    <input type="text" id="mod_nomb" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">SUB MENU</label>
                    <div class="col-sm-9">
                        <select id="submenu"  class="col-xs-10 col-sm-5">
                            <option value="">Seleccione</option>
                            <?php
                               $query = mysqli_query($con, "select * from modulos ");
                               while ($r = mysqli_fetch_array($query)){
                                   echo '<option value="'.$r[1].'">'.$r[1].'</option>';
                               }
                            ?>
                        </select>
                    </div>
                    </div>
            
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                      <select id="estado_mod" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">No activo</option>
                        </select>
                    </div>
                    </div>
                   
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_mod()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_mod()">Nuevo<i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





