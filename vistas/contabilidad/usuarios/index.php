<?php
include('../../../modelo/conexion.php');
?>
<script src="../vistas/contabilidad/usuarios/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Usuarios</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_usu();" href="#lin2"><h6><B>Crear Usuario</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
  <tr class="bg-info">
        <th>ID</th>
        <th>USUARIO</th> 
        <th>USUARIO FOM</th> 
        <th>NOMBRE</th>
        <th>APELLIDO</th>
        <th>CORREO</th>
        <th>TELEFONO</th>
        <th>ESTADO</th>
        <th>EDITAR</th>
        <th>ROLES</th>
  </tr>
    <tr>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
         <td><input type="text" id="cod" placeholder="usuario" class="col-xs-10 col-sm-12"/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td><input type="text" id="des" placeholder="Nombre" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="res" autocomplete="off" placeholder="Apellido" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="" class="col-xs-10 col-sm-12"disabled/></td>
        <td><input type="text" id="tipod" name="TEL" autocomplete="off" placeholder="telefono" disabled class="col-xs-10 col-sm-12"/></td>
        <td><select id="est" class="col-xs-10 col-sm-12">
                   <option value="">Todos</option>
                   <option value="Activo" selected>Activo</option>
                   <option value="No Activo">Inactivo</option>
        </select></td>
         <TD></TD>
    </tr>
 <tbody id="mostrar_tabla">
 </tbody>
</table>
</div>
    <div id="lin2" class="tab-pane fade in">
    <div class="form-horizontal" role="form">
      <div class="form-group">
          <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id usuario</label>
          <div class="col-sm-9">
          <input type="text" id="id_usuario" class="col-xs-10 col-sm-5" disabled />
       </div>
      </div>
           <div class="form-group">
             <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Usuario</label>
              <div class="col-sm-9">
                <input type="text" id="nombre_user" placeholder="digite numero" class="col-xs-10 col-sm-2" />
                <input style="COLOR: #212fff; BACKGROUND-COLOR: #c3daf2" type="password" id="contraseña_user"  class="col-xs-10 col-sm-3" />
              </div>
           </div>
               <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Usuario FOM</label>
                    <div class="col-sm-9">
                    <input type="text" id="user_fom" placeholder="fomplus" class="col-xs-10 col-sm-5" />
                    </div>
               </div>
                          
               <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cedula</label>
                    <div class="col-sm-9">
                    <input type="text" id="numcedula_user" placeholder="escriba su contraseña" class="col-xs-10 col-sm-5" />
                    </div>
              </div>
                        
             <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre</label>
                    <div class="col-sm-9">
                    <input type="text" id="nomcompleto_user" placeholder="nombre" class="col-xs-10 col-sm-5" />
                    </div>
             </div>
                       
              <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Apellido</label>
                       <div class="col-sm-9">
                       <input type="text" id="apellido_user" placeholder="apellidos" class="col-xs-10 col-sm-5" />
                       </div>
             </div>
            <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Tipo de sangre</label>
                      <div class="col-sm-9">
                       <input type="text" id="sangre_user" placeholder="" class="col-xs-10 col-sm-5" />
                      </div>
           </div>
           <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Telefono</label>
                     <div class="col-sm-9">
                     <input type="text" id="telefono_user" placeholder="" class="col-xs-10 col-sm-5" />
                     </div>
            </div>
             <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Celular</label>
                      <div class="col-sm-9">
                      <input type="text" id="movil_user" placeholder="" class="col-xs-10 col-sm-5" />
                      </div>
             </div>
                          
             <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Correo electronico</label>
                    <div class="col-sm-9">
                     <input type="text" id="correo_user" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
             </div>
                        
                 <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Direccion</label>
                    <div class="col-sm-9">
                        <input type="text" id="direccion_user" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                  </div>
                       
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo de barra</label>
                    <div class="col-sm-9">
                    <input type="text" id="codbarra_user" placeholder="digite numero" class="col-xs-10 col-sm-5" />
                    </div>
                   </div>
                
                 
                   <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Administrador</label>
                     <div class="col-sm-9">
                       <select id="administrador_user" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                      </div>
                    </div>
                  
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                   <select id="estado_user" class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="Activo">Activo</option>
                            <option value="No Activo">Inactivo</option>
                        </select>
                    </div>
                    </div>
               
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Pais</label>
                    <div class="col-sm-9">
                        <input type="text" id="pais_user" placeholder="" value="Colombia" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 
                 
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Departamento</label>
                    <div class="col-sm-9">
                    <select id="user_dep" class="col-xs-10 col-sm-5" onchange="cargarmund();">
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
                   <select id="user_muni" class="col-xs-10 col-sm-5">
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
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Empresa</label>
                    <div class="col-sm-9">
                    
                    <select id="empresa_user" class="col-xs-10 col-sm-5">  
                   
                    <?php      
                        $result=  mysqli_query($con,"SELECT * FROM inf_empresa ");                                
                            while($fila=  mysqli_fetch_array($result)){                 
                            $valor1=$fila['id_emp'];      
                            $valor2=$fila['nombre'];      
                            echo"<option value='".$valor2."'>".$valor2."</option>";   
                        }                                                            
                    ?>                                                
                    </select> 
                        
                    </div>
                    </div>
                           <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Area</label>
                    <div class="col-sm-9">
                          <select id="area_user" class="col-xs-10 col-sm-5">
                               <option value="">Seleccione el Area</option>
                                <?php 
                                      $resultt=  mysqli_query($con,"SELECT * FROM areas ");                                
                                      while($fila=  mysqli_fetch_array($resultt)){ 
                                           $valor3=$fila['id']; 
                                            $valor4=$fila['area'];   
                                       echo"<option value='".$valor4."'>".strtoupper($valor4)."</option>";   
                                       }                                                       
                                ?>    
                           </select>
                    </div>
                    </div> 
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cargo</label>
                    <div class="col-sm-9">
                    <select id="cargo_usu" class="col-xs-10 col-sm-5">
                         <option value="">seleccione el Cargos</option>
                              <?php 
                                      $resulttt=  mysqli_query($con,"SELECT * FROM cargos ");                                
                                      while($fila=  mysqli_fetch_array($resulttt)){ 
                                           $valor5=$fila['id_cargo']; 
                                           $valor6=$fila['nom_cargo'];   
                                       echo"<option value='".$valor6."'>".strtoupper($valor6)."</option>";   
                                       }                                                       
                                ?>      
                           
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Rol</label>
                        <div class="col-sm-9">
                         <input type="text" id="rol_user" placeholder="" class="col-xs-10 col-sm-5" />
                        </div>
                    </div>
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Sede</label>
                    <div class="col-sm-9">
                        <input type="text" id="sede_user" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                 
                     <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ruta</label>
                       <div class="col-sm-9">
                       <input type="text" id="ruta_user" placeholder="" class="col-xs-10 col-sm-5" />
                       </div>
                    </div>
                    
                     <div class="form-actions">
                            <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                            <button type="button" class="btn btn-success" onclick="guardar_usu()">Guardar</button>
                            <button type="button" class="btn btn-danger" onclick="limpiar_usu()">Nuevo
                            <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                   </div>
               </div>
        </div> 
       
         
          <div class="modal fade" id="modalrol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><b>Configuracion de Roles</b></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body" >
        <table id="" class="table table-striped table-bordered">
		  <thead>
			 <tr>
			 <th width="1%">#</th>
			 <th class="text-nowrap">MENU</th>
                            <th class="text-nowrap">SUBMENU</th>
                            <th width="1%">ACCESO</th>                                
			</tr>
		</thead>
             <tbody id="ver_roles">
                                                   
	</tbody>
	</table>
        </div>
      <div class="modal-footer">
          <input type="hidden" id="nitf"> <span id="estados"></span>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
         
  
     

      





