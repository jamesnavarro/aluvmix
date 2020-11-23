<?php
 include '../../../modelo/conexioni.php';
?>
<script src="../vistas/contabilidad/centrocostos/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_lin();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
        <table class="table table-hover">
  <tr class="bg-info">
        <th>CODIGO</th> 
        <th>DESCRIPCION</th>
        <th>NOMBRE RESUMIDO</th>
        <th>CENTRO DE PRODUCCION</th>
        <th>ESTADO</th>
        <th>ULT MODIFICACION</th>
        <th>POR USUARIO</th>
        <th>EDITAR</th>
  </tr>
    <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="res" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="cp" placeholder="Descripcion" class="col-xs-10 col-sm-12"/></td> 
        <td><select id="est"><option value="">Todos</option><option value="0">Activo</option><option value="1">No activo</option></select></td>
  
         <td></td>
         <td></td>
         <td></td>
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Clase </label>
                    <div class="col-sm-9">
                        <select id="fcla">
                            <option value=""></option>
                           <?php
                           $result = mysqli_query($con, "select * from clases_centros");
                           while ($r = mysqli_fetch_array($result)){
                               echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[1].'</option>';
                           }
                        
                           ?>
                        </select>
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Area </label>
                    <div class="col-sm-9">
                        <select id="fare">
                            <option value="">Seleccione</option>
                            <?php
                            $result = mysqli_query($con, "select * from areascc where are_activo=0");
                            while($r = mysqli_fetch_array($result)){
                                echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[1].'</option>';
                            }
                            
                            ?>
                          
                        </select>
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                        <input type="text" id="fcod" placeholder="digite el codigo" maxlength="8" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Descripcion centro de costo </label>
                    <div class="col-sm-9">
                    <input type="text" id="fdes" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Nombre resumido </label>
                    <div class="col-sm-9">
                    <input type="text" id="fres" placeholder="resumen" class="col-xs-10 col-sm-5" />
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
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"> Centro Produccion </label>
                    <div class="col-sm-9">
                        <select id="fcp">
                            <option value="">Seleccione</option>
                            <?php
                            $result = mysqli_query($con, "select * from centroproduccion where cp_activo=0");
                            while($r = mysqli_fetch_array($result)){
                                echo '<option value="'.$r[0].'">'.$r[0].' - '.$r[1].'</option>';
                            }
                            
                            ?>
                          
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
       
         
         
         
  
     

      





