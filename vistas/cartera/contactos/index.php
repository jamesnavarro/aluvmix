<?php
include('../../../modelo/conexioni.php');

session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/cartera/contactos/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Contactos</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_cont();" href="#lin2"><h6><B>Crear contactos</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
 <table class="table table-hover">
  <tr class="bg-info">
        <th>ID</th> 
        <th>NOMBRE DEL CONTACTO</th>
        <th>TELEFONOS</th>
        <th>EMAIL</th>
        <th>CARGO</th> 
        <th>NOTAS</th> 
        <th>OPCIONES</th>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td><input type="text" id="cod" placeholder="Numero" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="" placeholder="Nombre" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
    </tr>
        <tbody id="mostrar_tabla"></tbody>
</table>
         </div>
          <div id="lin2" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                    <div class="col-sm-9">
                    <input type="text" id="id_cont" placeholder="digite nombre" class="col-xs-10 col-sm-5" disabled />
                    </div>
                    </div>
                        
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Nombre Completo</label>
                    <div class="col-sm-9">
                    <input type="text" id="cont_nombre" placeholder="digite nombre" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       
                    <div class="form-group">
                       <label class="col-sm-3 control-label no-padding-right" for="form-field-2"><img src="../imagenes/call.png" width="20px"></label>
                       <div class="col-sm-9">
                           <input type="text" id="tel_cont" placeholder="telefono o movil" class="col-xs-5 col-sm-5" />
                       </div>
                    </div>
                       
                       
                   <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2"><img src="../imagenes/email.png" width="20px"></label>
                       <div class="col-sm-9">
                       <input type="text" id="email_cont" placeholder="ejemplo@gmail.com" class="col-xs-5 col-sm-5" />
                       </div>
                    </div>
                       
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Cargo</label>
                    <div class="col-sm-9">
                    <input type="text" id="carg_carg" placeholder="Cargo" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Sugerencia</label>
                    <div class="col-sm-9">
                    <input type="text" id="suger_cont" placeholder="Sugerencia" class="col-xs-10 col-sm-5" />
                    </div>
                    </div>
                       
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">A que cliente pertenece<b>?</b> <img onclick="buscarcliente();"  src="../images/buscar.png" width="20px"></label>
                    <div class="col-sm-9">
                        <input type="hidden" id="cedula" placeholder="" class="col-xs-10 col-sm-2" />
                      <input type="text" id="cliente" placeholder="" class="col-xs-10 col-sm-3" />
                    </div>
                    </div>
                       
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                    <div class="col-sm-9">
                    <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="usu_creo" placeholder="digite nombre" class="col-xs-10 col-sm-3" disabled/>
                    <input type="text" value="<?php echo date("Y-m-d"); ?>" id="fecha_creo" placeholder="digite nombre" class="col-xs-10 col-sm-2" disabled />
                    </div>
                    </div>
                       
                    <div class="form-actions">
                    <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                    <button type="button" class="btn btn-success" onclick="guardar_cont()">Guardar</button>
                    <button type="button" class="btn btn-danger" onclick="limpiar_cont()">Nuevo
                    <i data-dismiss="modal"></i></button>
                    </div>
                    </div>
                   </div>
               </div>
        </div> 
      
         
         
         <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>   
  
     

      





