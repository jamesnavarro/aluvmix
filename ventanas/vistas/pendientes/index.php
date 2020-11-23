<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/pendientes/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="nombre" class="form-control" placeholder="nombre de cliente"></td> 
                 </tr>
            </table>
    <div id="mostrar_tabla">
        <br><br>
        <b><center><img src="../imagenes/load.gif"> Cargando Tabla</center></b>
    </div>
    </div>
</div> 
 <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog  modal-lg">
 
      <div class="modal-content">
 <div class="modal-header-success">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title" style="text-align: center;">
      REGISTRO DE CONTRATOS
      </h4>
 </div> <BR>
        <div class="modal-body">
            <table style="width: 100%">
     <tr  class="bg-info">
                    <td></td>
                    <td></td>
                </tr>
               <tr>
                   <TD></TD>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">#Rad CONTRATO</span>
                            <input type="number" id="id_inf" class="form-control" style="width: 30%" disabled>
                            <span class="input-group-addon">#CONTRATO</span>
                            <input type="number" id="n_cot" class="form-control"> 
                        </div>
                        
                    </td>
                </tr>
                    <tr><td>#Cotizacion</td>
                    <td>  
                        <div class="input-group">
                         <span class="input-group-addon"><button type="button" onclick="buscar_cotizaciones();"><img src="../imagenes/search.png" style="width:12px"></button></span>
                         <input name="remitosucursal" id="nume_cot" type="number" required class="form-control" disabled>
                         <span class="input-group-addon">Version:</span>
                         <input id="version" type="number" required class="form-control"disabled>
                         <span class="input-group-addon">#PEDIDO</span>
                         <input type="number" id="pedido" class="form-control">
                        </div>
                    </td>
                    </tr> 
                
                  <tr>
                      <td>Cliente</td> 
                     <td>
                         <div class="input-group">
                         <span class="input-group-addon"><button type="button" onclick="buscar_cliente();"><img src="../imagenes/search.png" style="width:12px"></button></span>
                         <input type="hidden" id="cliente" class="form-control">
                         <input type="text" id="nombre_cliente" class="form-control" disabled> 
                         </div>
                      </td>
                  </tr>
                  
                 <tr>
                    <td>Nombre De la obra</td>
                    <td><input type="text" id="nom_o" class="form-control"></td>
                </tr>
                <tr>
                    <td>Objeto del contrato</td>
                    <td><input type="text" id="objeto" class="form-control"></td>
                </tr>

                  <tr>
                    <td>Vendedor:</td> 
                     <td>
                         <div class="input-group">
                             <span class="input-group-addon"><button type="button" onclick="buscar_usuario();"><img src="../imagenes/search.png" style="width:12px"></button> </span>
                         <input type="text" id="vende" class="form-control"disabled>
                        </div>
                      </td>
                </tr>
                  <tr>
                    <td>Coordinador de Obra</td>
                    <td>
                        <div class="input-group">
                            <input type="text" id="cor_o" class="form-control">
                            <span class="input-group-addon">Supervisor de la obra:</span>
                            <input type="text" id="supervi" class="form-control">
                        </div>
                        
                    </td>
                </tr>
                  <tr>
                    <td>Nombre del instalador</td>
                    <td><input type="text" id="instal" class="form-control"></td>
                </tr>
                <tr><td>Valor Contrato</td>
                     <td>  
                        <div class="input-group">
                            <input type="number" id="valor" class="form-control">
                            <span class="input-group-addon">Anticipo:</span>
                            <input name="remitosucursal" id="anticipo" type="number" required class="form-control">
                         <span class="input-group-addon">saldo:</span>
                         <input id="saldo" type="number" required class="form-control">
                         
                         <span class="input-group-addon">Estado</span>
                         <select id="estado_c" class="form-control">
                            <option value="NC">NC</option> 
                            <option value="C">C</option>
                             
                         </select>
                       </div>
                       </td>
                 </tr>
                  <tr>
                    <td>Forma de pago</td>
                    <td>
                     <div class="input-group">
                     <input type="text" id="for_pag" class="form-control">
                      <span class="input-group-addon">Fecha de pago:</span>
                      <input type="date" id="fpago" class="form-control">
                     </div> 
                     </td>
                </tr>
                   <tr>
                    <td>Otros</td>
                    <td><input type="text" id="otros" class="form-control"></td>
                </tr>
                  <tr>
                    <td>Se recibe contrato:</td>
                    <td><select id="recibe" class="form-control">
                            <option value="">seleccione</option>
                            <option value="CON FIRMA">CON FIRMA</option>
                            <option value="SIN FIRMA">SIN FIRMA</option>    
                         </select></td>
                </tr>
                
                 <tr>
                    <td>Observaciones:</td>
                    <td><input type="text" id="obser" class="form-control"></td>
                </tr>
                <tr class="bg-info">
                    <td>Registrado por:</td>
                    <td>
                   <div class="input-group">
                    <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="registrado" class="form-control" disabled >
                    <span class="input-group-addon">Fecha de registro</span>
                    <input type="date"  id="fe_registro" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled >
                   </div>
                   </td>
                </tr>
              <tr  class="bg-info">
                    <td></td>
                    <td></td>
                </tr>
            </table>
            
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_pendientes()">Guardar Cambios</button> 
            <button type="button" class="btn btn-danger" onclick="limpiar_pen()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <?php  }else {
 
    echo '<script>location.reload();</script>';  
}?>         