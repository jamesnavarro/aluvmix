<?php
include('../../../modelo/conexioni.php');
?>
<script src="../vistas/contabilidad/empleados/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Empleados</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_emp();" href="#lin2"><h6><B>Crear empleados</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>TIP DOCUMENTO</th> 
        <th>NUMERO</th>
        <th>NOMBRE DEL EMPLEADOR</th>
        <th>TELEFONO</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
  </tr>
    <tr>
         <td>
            <select id="tipod">
               <option value="">Todos</option>
               <option value="CC">CC</option>
               <option value="Pasaporte">Pasaporte</option>
               <option value="CE">CE</option>
               <option value="NIT">NIT</option>
            </select>
        </td>
        <td><input type="text" id="cod" placeholder="Numero" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="Nombre" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id=" " placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
        <td>
            <select id="res">
                <option value="">Todos</option>
                <option value="0">Activo</option>
                <option value="1">No activo</option>
            </select>
        </td>
         
   
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo de documento</label>
                    <div class="col-sm-9">
                     <select id="tipodoc_emp" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="CC">CC</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="CE">Cedula de extrangeria</option>
                            <option value="NIT">Nit</option>
                        </select>
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Identificacion</label>
                    <div class="col-sm-9">
                    <input type="text" id="identifi_emp" placeholder="digite numero" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-9">
                    <input type="text" id="codigo_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre completo</label>
                    <div class="col-sm-9">
                    <input type="text" id="nombre_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 
                  
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Direccion</label>
                    <div class="col-sm-9">
                     <input type="text" id="direcc_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                           <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Telefono</label>
                    <div class="col-sm-9">
                     <input type="text" id="telefono_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                          <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Celular</label>
                    <div class="col-sm-9">
                     <input type="text" id="movil_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Correo electronico</label>
                    <div class="col-sm-9">
                        <input type="text" id="correo_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costos</label>
                    <div class="col-sm-9">
                        <input type="text" id="costoa_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
               
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cargo</label>
                    <div class="col-sm-9">
                        <input type="text" id="cargo_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 
                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Salario Actual</label>
                    <div class="col-sm-9">
                        <input type="text" id="salaactu_emp" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                     <select id="estado_emp" class="col-xs-10 col-sm-3">
                            <option value=""></option>
                            <option value="0">activo</option>
                            <option value="1">inactivo</option>
                        </select>
                    </div>
                
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Departamento</label>
                    <div class="col-sm-9">
                    <select id="emp_dep" class="col-xs-10 col-sm-5" onchange="cargarmund();">
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
                   <select id="emp_muni" class="col-xs-10 col-sm-5">
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fecha de Ingreso</label>
                  <div class="col-sm-9">
                      <input type="date" id="registro_emp" value="<?php echo date("Y-m-d"); ?>" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                  
                         <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fecha de Nacimiento</label>
                  <div class="col-sm-9">
                      <input type="date" id="modificacion_emp" value="<?php echo date("Y-m-d"); ?>" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                  
               
                     
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_emp()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_emp()">Nuevo
                         <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                
                     
                   </div>
               </div>
        </div> 

       
         
         
         
  
     

      





