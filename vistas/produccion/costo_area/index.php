<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/publicos/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_public();"><h6><B>Crear</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
 <tr class="bg-info">
        <th>Id</th> 
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Fecha  </th>
        <th>Opciones</th>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-8" /></td>
        <td><input type="text" id="est_b" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input  type="text" id="" placeholder="" class="col-xs-10 col-sm-8"  disabled/></td>
        
      
    </tr>
    <tbody id="mostrar_tabla">    
    <h3 class="bg-info text-center"><B>COSTOS POR AREA</B></h3>  
    </tbody>
</table>
                             
       </div>
                    </div><br>

          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                       
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                       <div class="col-sm-9">
                         <input type="text" id="id_public" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                       </div>
                    </div>
                       
                   <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="descrip_public" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                       
                       
                              <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Sede</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="descrip_public" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                 
                              <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Valmo</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="descrip_public" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                       
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                     <div class="col-sm-9">
                      <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="servi_public" placeholder="digite nombre" class="col-xs-10 col-sm-3" disabled/>
                      <input type="text" value="<?php echo date("Y-m-d"); ?>" id="fech_public" placeholder="digite nombre" class="col-xs-10 col-sm-2" disabled />
                     </div>
                   </div>
                       
                
                   <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_public()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_public()">Nuevo
                      <i data-dismiss="modal"></i></button>
                   </div>
                 
               </div>
                     
             </div>
          </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





