<?php
include('../../../modelo/conexioni.php');
?>
<script src="../vistas/cartera/proveedores/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Usuarios</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_ter();" href="#lin2"><h6><B>Crear Proveedor</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">   
 <table class="table table-hover">
  <tr class="bg-info">
        <th nowrap>TIPO DOC</th> 
        <th>NUMERO DOC</th>
        <th>NOMBRE CLIENTE</th>
        <th>TELEFONO</th>
        <th>EMAIL</th> 
        <th>OPCIONES</th>
  </tr>
    <tr>
        
        
          <td>
            <select id="tipod">
               <option value="">Todos</option>
               <option value="CC">CC</option>
               <option value="NIT">NIT</option>
               <option value="CE">CE</option>
                <option value="Pasaporte">Pasaporte</option>
            </select>
        </td>
         <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="res" placeholder="" class="col-xs-2 col-sm-12" disabled/></td> 
        <td><input type="text" placeholder="" class="col-xs-10 col-sm-12"/><input type="hidden" id="est" placeholder="" class="col-xs-10 col-sm-10"  disabled/></td>
        <td></td> 
        
    </tr>
 <tbody id="mostrar_tabla">
     </tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Identificacion</label>
                    <div class="col-sm-9">
                    <input type="text" id="ter_identifi" placeholder="digite numero" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                          <div class="form-group">
                          <label class="col-sm-3 control-label no-padding-right" for="form-field-2"><b>Tipo de cliente</b></label>
                    <div class="col-sm-9">
                          <select id="tipo_cliente" class="col-xs-10 col-sm-3">
                          <option value="Cliente">Cliente</option>
                          <option value="Proveedor">Proveedor</option>
                          </select>
                    </div>
                    </div>
                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo de documento</label>
                    <div class="col-sm-9">
                     <select id="ter_tipo" class="col-xs-10 col-sm-3">
                            <option value="CC">Cedula de ciudadania</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="CE">Cedula de extrangeria</option>
                            <option value="NIT">Nit</option>
                        </select>
                    </div>
                    </div>
                  
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo de verificacion</label>
                    <div class="col-sm-9">
                    <input type="text" id="ter_codverif" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre  razon social</label>
                    <div class="col-sm-9">
                    <input type="text" id="ter_nombre" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       
                    
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Direccion</label>
                    <div class="col-sm-9">
                    <input type="text" id="ter_direccion" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Telefono fijo <b>/</b>fax</label>
                    <div class="col-sm-9">
                     <input type="text" id="ter_telefono" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                          <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Celular</label>
                    <div class="col-sm-9">
                     <input type="text" id="ter_movil" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Departamento</label>
                    <div class="col-sm-9">
                    <select id="ter_dep"  class="col-xs-10 col-sm-3" onchange="cargarmund();">
                      <option value="">Seleccione</option>
                           <?php
                            $consulta = mysqli_query($con, "select * FROM `departamentos` group BY nombre_dep"); 
                            while($f = mysqli_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_dep'].'">'.$f['nombre_dep'].'</option>'; 
                            }
                            ?>
                      </select>
                    </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ciudad o municipio</label>
                    <div class="col-sm-9">
                   <select id="ter_muni" class="col-xs-10 col-sm-3">
                      <option value="">Seleccione</option>
                      <?php
                            $consulta = mysqli_query($con, "select * FROM `departamentos` group BY nombre_mun");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>'; 
                            }
                      ?>
                      </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Pais</label>
                    <div class="col-sm-9">
                        <input type="text" id="ter_pais" value="Colombia" placeholder="Colombia" class="col-xs-10 col-sm-5" disabled/>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fecha de nacimiento</label>
                    <div class="col-sm-9">
                      <input type="date" id="ter_fnacido" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Correo electronico</label>
                    <div class="col-sm-9">
                        <input type="text" id="ter_correo" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Contacto</label>
                    <div class="col-sm-9">
                      <input type="text" id="ter_contacto" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descuento Aluminio</label>
                    <div class="col-sm-9">
                      <input type="text" id="ter_desalum" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descuento Vidrio</label>
                    <div class="col-sm-9">
                      <input type="text" id="ter_desvidrio" placeholder="" class="col-xs-10 col-sm-5"/>
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descuento Acero</label>
                    <div class="col-sm-9">
                      <input type="text" id="ter_desacero" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado?</label>
                    <div class="col-sm-9">
                         <select id="ter_estado" class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cliente especial?</label>
                    <div class="col-sm-9">
                         <select id="ter_cliespecial"  class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">Si</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    </div>   
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Retefuente?</label>
                    <div class="col-sm-9">
                         <select id="ter_retefuente" class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">Si</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    </div>   
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Rete <b>ICA</b>?</label>
                    <div class="col-sm-9">
                          <select id="ter_reteica"  class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">Si</option>
                            <option value="1">No</option>
                          </select>
                    </div>
                    </div>
                     <div class="form-group">
                         <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Retencion <b>IVA</b>?</label>
                    <div class="col-sm-9">
                          <select id="ter_reteiva"  class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">Si</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    </div>
                     <div class="form-group">
                         <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Retencion <b>CREE</b></label>
                    <div class="col-sm-9">
                          <select id="ter_retcree"  class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">Si</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    </div>
                         <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right" for="form-field-2"><b>Asesor</b></label>
                    <div class="col-sm-9">
                          <select id="ter_asesor"  class="col-xs-10 col-sm-3">
                              <?php
	 	                     if (isset($_GET['cot'])){
		                     echo "<option value='" . $reg . "'>" . $reg . "</option>";
		                    } else {
		                	echo "<option value=''>Asesores</option>";
		                      }
                                      $consulta2= "SELECT * FROM `usuarios` where area='Ventas' and estado='Activo' order by nombre";   
                                      $result2=  mysqli_query($con, $consulta2); 
                                      echo "<option value='ADMIN'>ADMIN</option>";  
                                      while($fila=  mysqli_fetch_array($result2)){       
                                      $valor3=$fila['usuario'];  
                                      $valor4=$fila['nombre'].' '.$fila['apellido'];   
                                       echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                       }                                                       
                                ?>                                 
                        </select>
                    </div>
                    </div>
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                     <button type="button" class="btn btn-success" onclick="guardar_ter()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_ter()">Nuevo
                         <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





