<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/servicios/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_servi();"><h6><B>Crear</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
 <tr class="bg-info">
        <th>Id</th> 
        <th>Descripcion</th>
        <th>Valor unidad</th>
        <th>Estado</th>
        <th>Fecha</th>
        <th>Usuario</th>
        <th>Opciones</th>
 
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-8" /></td>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
        <td><select id="est_b" class="col-sm-5">
                   <option value="">Seleccione</option>
		   <option value="0">Activo</option>
		   <option value="1">Inactivo</option> 
	     </select>
        
        
        </td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input  type="text"   id="" placeholder="" class="col-xs-10 col-sm-8"  disabled/></td>
        
      
    </tr>
    <tbody id="mostrar_tabla">
        
    <h2 class="bg-info center"><B>LISTA DE SERVICIOS</B></h2>
        
        
    </tbody>
</table>
                             
       </div>
                    </div><br>

          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_servi" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                    </div>
                    </div>
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion del vidrio</label>
                    <div class="col-sm-9">
                     <div class="col-sm-9">
                    <input type="text" id="descrip_servi" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                    </div>
                    </div>
                    </div>
                        <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Valor Unidad</label>
                    <div class="col-sm-9">
                     <div class="col-sm-9">
                    <input type="text" id="valor_u" placeholder="digite nombre" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                    </div>
                   
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-9">
                        <select id="estado_servi" class="col-sm-5">
			    <option value="0">Activo</option>
			    <option value="1">Inactivo</option> 
		        </select>
                    </div>
                    </div>
                       
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                    <div class="col-sm-9">
                    <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="servi_usu" placeholder="digite nombre" class="col-xs-10 col-sm-3" disabled/>
                    <input type="text" value="<?php echo date("Y-m-d"); ?>" id="fech_servi" placeholder="digite nombre" class="col-xs-10 col-sm-2" disabled />
                    </div>
                    </div>
                       
                
            
                    <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                    <button type="button" class="btn btn-success" onclick="guardar_servi()">Guardar</button>
                    <button type="button" class="btn btn-danger" onclick="limpiar_servi()">Nuevo
                    <i data-dismiss="modal"></i></button>
                    </div>
                 
                   </div>
                     
                   </div>
               </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





