<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/contacto_nuevo/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="nombre" class="form-control" placeholder="nombre del contacto"></td> 
            </table>
    <div id="mostrar_tabla">  </div>
    </div>
</div> 
 

 <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">NUEVO CONTACTO</h4>
        </div>
       <div class="table-responsive">

               <table class="table">
                    <tr  class="bg-info">
                    <td></td>
                    <td></td>
                </tr>
               <tr>
                   <td></td>
                    <td>
                    <div class="input-group">
                     <span class="input-group-addon"><p class="text-danger">#RAD CONTACTO</p></span>
                     <input type="number" id="consecu_contact_nu"  class="form-control" style="width:60px" readonly>
                    </div> 
                    </td>
             
                </tr>
              
                 <tr>
                     <td>Nombre Completo</td>
                     <td>
                     <input type="text" id="nom_contact_nue" class="form-control">
                     </td>
                 </tr>
                 <tr>
                     <td></td>
                    <td>
                      <div class="input-group">
                      <span class="input-group-addon"><img src="../imagenes/call.png" width="30px" height="23px"></span>
                      <input type="number" id="tel_contact_nue" class="form-control">
                      <span class="input-group-addon"><img src="../imagenes/email.png" width="30px" height="23px"></span>
                      <input type="text" id="mail_contac_nue" class="form-control" onchange="caracteresCorreoValido();" placeholder="ejemplo@gmail.com">
                     </div>
                    </td>
                </tr>
                <tr>
                    <td>Cargo:</td>
                   <td>
                     <input type="text" id="cargo_contact_nu" value=" " class="form-control">
                   </td>
                </tr>
                <tr>
                    <td>Sugerencia</td>
                    <td>
                       <textarea id="sug_contact_nue" style="width:100%"></textarea>
                    </td>
                 </tr>
                  <tr>
                     <td>Relacionado con Cliente</td> 
                     <td>
                         <div class="input-group">
                             <span class="input-group-addon">
                                 <button type="button" onclick="buscar_clientes(0);"><img src="../imagenes/search.png" width="15px" height="15px"></button>
                             </span>
                             <input type="hidden" id="cliente" class="form-control">
                             <input type="text" id="nombre_cliente" class="form-control" disabled width="100%"> <!-- adicionado por navabla -->
                         </div>
                      </td>
                  </tr>  
                 <tr class="bg-info">
                    <td>Registrado por</td>
                    <td>
                   <div class="input-group">
                    <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="regis_contac_nue" class="form-control" disabled >
                    <span class="input-group-addon">Fecha de registro</span>
                    <input type="date"  id="fecha_reg_contac_nue" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled >
                   </div>
                   </td>
                </tr>
                      <tr  class="bg-info">
                    <td></td>
                    <td></td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                      <div class="modal-footer">
                      <span id="imagenes"></span>
                      <button type="button" class="btn btn-primary" id="guardar_contacto_nuevo">Guardar Cambios</button> 
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </td>
                </tr>
                </table>

           </div>
         </div>
       </div>

    </div>
 
 <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>         