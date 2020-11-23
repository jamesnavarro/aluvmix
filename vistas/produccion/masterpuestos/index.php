<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/masterpuestos/funciones.js?v=<?php echo rand(1,100) ?>"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_Puesto trabajos();"><h6><B>Crear Puesto trabajo</B></h6></a>
        </li>
 </ul>
 <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
          <div class="table-responsive">
             <br>
                 <table class="table table-hover">
                   <tr class="bg-info">
                       
                       <th>SEDE</th>
                       <th>NOMBRE DEL PUESTO</th>
                       <th>M.OBRA</th>
                       <th>UM MO</th>
                       <th>MAQ</th>
                       <th>UM MA</th>
                       <th>CIF</th>
                       <th>UM CF</th>   
                       <th>OPCION</th>
                   </tr>
             <tr>
                 <td>
            <select id="sede" class="col-xs-10 col-sm-5">
              <option value="">Todos</option>
	      <option value="GALAPA">GALAPA</option>
	      <option value="CALLE 72">CALLE 72</option> 
            </select>
        </td>
        <td><input type="text" id="nombre" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
        <td>-</td>
    </tr>
    <tr>
              <td><select id="vsede">
                            <option value="">Seleccione</option>
                            <option value="GALAPA">GALAPA</option>
                            <option value="CALLE 72">CALLE 72</option>
                        </select></td>
                        <td><input type="hidden" id="idpue" style="width:100%"><input type="text" id="vno" style="width:100%"></td>
              <td><input type="text" id="vmo" style="width:100%"></td>
              <td><select id="um1" class="col-xs-2 col-sm-12">
                            <option value="">Seleccione</option>
                            <option value="m2">m2</option>
                            <option value="ml">ml</option>
                            <option value="und">und</option>
                            <option value="hh">hh</option>
                            <option value="kg">kg</option>
                        </select></td>
              <td><input type="text" id="vma" style="width:100%"></td>
              <td><select id="um2" class="col-xs-2 col-sm-12">
                            <option value="">Seleccione</option>
                            <option value="m2">m2</option>
                            <option value="ml">ml</option>
                            <option value="und">und</option>
                            <option value="hh">hh</option>
                            <option value="kg">kg</option>
                        </select></td>
              <td><input type="text" id="vci" style="width:100%"></td>
              <td><select id="um3" class="col-xs-2 col-sm-12">
                            <option value="">Seleccione</option>
                            <option value="m2">m2</option>
                            <option value="ml">ml</option>
                            <option value="und">und</option>
                            <option value="hh">hh</option>
                            <option value="kg">kg</option>
                        </select></td>
                        <td><button onclick="addprecio()">Agregar</button></td>
                        </tr>
    <tbody id="mostrar_tabla"> 
    </tbody>
</table>                   
       </div>
      </div><br>
          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                       <div class="col-sm-9">
                      <div class="col-sm-9">
                         <input type="text" id="id_bur" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                       </div>
                       </div>
                    </div>
                   <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre del Puesto trabajo</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="descrip_bur" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                         <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                       <select id="esta_b" class="col-xs-10 col-sm-5">
                            <option value="">Todos</option>
			    <option value="Ocupado">Ocupado</option>
			    <option value="Desocupado">Desocupado</option> 
                           
                        </select>
                       </div>
                      </div>
                   </div>
                       <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Planta</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                       <select id="planta_b" class="col-xs-10 col-sm-5">
                            <option value="">Todos</option>
			    <option value="0">Barranquilla</option>
			    <option value="1">Galapa</option> 
                        </select>
                       </div>
                      </div>
                   </div>
                   <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_Puesto trabajos()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_Puesto trabajos()">Nuevo
                      <i data-dismiss="modal"></i></button>
                   </div>
               </div> 
             </div>
          </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





