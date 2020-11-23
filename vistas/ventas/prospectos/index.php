<?php
 include('../../../modelo/conexioni.php');
 session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/ventas/prospectos/funciones.js"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_pros();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">
        <th>ID</th> 
        <th>Nombre proyecto</th>
        <th>Contructora/Nit</th>
        <th>Departamento</th>
        <th>Ciudad</th>
        <th>Barrio</th>
        <th>Estado</th>
        <th>Asesor</th>
        <th>Opciones</th>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td><input type="text" id="cod" placeholder="Nombre" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="contructora" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="depar" placeholder="departamento" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="ciu_b" placeholder="ciudad o municipio" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td><select id="res"><option value="">Todos</option><option value="Seleccionado">Seleccionado</option><option value="Descartado">Descartado</option></select></td>
   
         <td>               <select class="col-xs-10 col-sm-5" id="bus_asesor" name="numero" required>
	                <?php
		         if (isset($_GET['cot'])){
		         echo "<option value='" . $reg . "'>" . $reg . "</option>";
		        } else {
		         	echo "<option value=''>Usuarios</option>";
		             }
                            $consulta2= "SELECT * FROM `usuarios` where area='ventas' and estado='Activo' order by nombre";   
                            $result2=  mysqli_query($con,$consulta2); 
                            echo "<option value='ADMIN'>ADMIN</option>";  
                            while($fila=  mysqli_fetch_array($result2)){       
                            $valor3=$fila['usuario'];  
                            $valor4=$fila['nombre'].' '.$fila['apellido'];   
                             echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                            }                                                       
                       ?>       
                     </select></td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
  
         
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">ID</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_pros" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Proyecto</label>
                    <div class="col-sm-9">
                    <input type="text" id="pros_nombre" placeholder="digite el codigo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Constructora</label>
                    <div class="col-sm-9">
                    <input type="text" id="pros_contruc" placeholder="descripcion" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nit</label>
                    <div class="col-sm-9">
                    <input type="text" id="pros_nit" placeholder="" class="col-xs-10 col-sm-3"/>
<!--                    <button type="button" class="btn btn-info col-xs-3 col-sm-2" onclick="buscar_nit()">Nuevo prospecto</button>-->
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Departamento</label>
                    <div class="col-sm-9">
                        <input type="text" id="pros_dep" placeholder="" class="col-xs-10 col-sm-3"/>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ciudad</label>
                    <div class="col-sm-9">
                        <input type="text" id="pros_ciu" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Barrio</label>
                    <div class="col-sm-9">
                    <input type="text" id="pros_barrio" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Telefonos</label>
                    <div class="col-sm-9">
                    <input type="text" id="pros_tel" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fase</label>
                    <div class="col-sm-9">
                    <input type="text" id="pros_fase" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                    </div> 
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                      <select id="pros_estado"  class="col-xs-10 col-sm-5">
                            <option value="Seleccionado">Seleccionado</option>
                            <option value="Descartado">Descartado</option>
                        </select>
                    </div>
                    </div>
                           <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Asignado a :</label>
                    <div class="col-sm-9">
                                 <select class="col-xs-10 col-sm-5" id="usuariov" name="numero" required>
	                <?php
		         if (isset($_GET['cot'])){
		         echo "<option value='" . $reg . "'>" . $reg . "</option>";
		        } else {
		         	echo "<option value=''>Usuarios</option>";
		             }
                            $consulta2= "SELECT * FROM `usuarios` where area='ventas' and estado='Activo' order by nombre";   
                            $result2=  mysqli_query($con,$consulta2); 
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
<!--                          <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Filtrar Estado</label>
                    <div class="col-sm-9">
                      <select id="pros_filtrar"  class="col-xs-10 col-sm-5">
                            <option value=""></option>
                            <option value="0">Si</option>
                            <option value="1">No</option>
                        </select>
                    </div>
                    </div>-->
                    <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_pros()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_pros()">Nuevo<i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                   </div>3
               </div>
        </div> 
 <div class="modal fade" id="" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">AGREGAR</h4>
        </div>
        <div class="modal-body">
            <p>Descripcion</p>
            <input type="hidden"  id="rad_n" class="form-control" disabled value="">
            <input type="hidden"  id="id_rospcp" class="form-control" disabled value="">
            <input type="text"  id="id_prin" class="form-control" disabled value="">
            <input type="hidden" value="<?php echo $_SESSION["k_username"]; ?>" id="regis_se_nu" class="form-control" disabled >
            <input type="hidden"  id="fecha_seg_nu" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled >
            <textarea id="seguim_cot" placeholder="hacer seguimiento a la cotizacion"  style="width:100%; height: 100px; background-color:#c8c6e9 "></textarea>
        </div>
        <div class="modal-footer">
            <button id="btn_guardard" type="button" class="btn btn-primary" onclick="guardar_agregar()">Guardar</button>
            <button id="btn_guardard" type="button" class="btn btn-danger" onclick="limpiar_agregar()">Nuevo</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
       
         
       <?php  }else {
    echo '<script>location.reload();</script>';
}?>    
         
  
     

      





