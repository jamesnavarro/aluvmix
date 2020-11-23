<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/contabilidad/parafiscales_c/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_paraf();"><h6><B>Crear</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
 <tr class="bg-info">
        <th>ID</th> 
        <th>NOMBRE</th>
        <th>INSTALADORES</th>
        <th>FABRICANTES</th>
        <TH>OPCIONES</TH>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-8" /></td>
        <td><input type="text" id="est_b" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input  type="text" id="" placeholder="" class="col-xs-10 col-sm-8"  disabled/></td>
        
      
    </tr>
    <tbody id="mostrar_tabla">    
    <h3 class="bg-info text-center"><B>PARAFISCALES</B></h3>  
    </tbody>
</table>
                             
       </div>
                    </div><br>

          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                       
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                       <div class="col-sm-9">
                         <input type="text" id="id_paraf" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                       </div>
                    </div>
                       
                   <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="descrip_paraf" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                       <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Instalador</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="instala_paraf" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                       <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Fabricante</label>
                      <div class="col-sm-9">
                       <div class="col-sm-9">
                        <input type="text" id="fabri_paraf" placeholder="digite nombre" class="col-xs-10 col-sm-5"/>
                       </div>
                      </div>
                   </div>
                 
                
                   <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_paraf()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_paraf()">Nuevo
                      <i data-dismiss="modal"></i></button>
                   </div>
                 
               </div>
                     
             </div>
          </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





