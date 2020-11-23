<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/actividades/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="nombre" class="form-control" placeholder="Nombre de contacto"></td> 
                    <td> <select id="esta" class="form-control">
                            
                            <option value="Planificada">Planificada</option>
                            <option value="Completada">Completada</option>    
                            <option value="No realizada">No realizada</option> 
                            <option value="">Todas</option>
                        </select> </td> 
                    <td><input type="date" id="finicio"class="form-control" placeholder="inicio" value="<?php echo date("Y-m-d") ?>"></td> 
                    <td><input type="hidden" id="ffinal" class="form-control" placeholder="Nombre de la Obra"></td> 
            </table>
   
    <div id="mostrar_tabla">
        <br><br>
        <b><center><img src="../imagenes/load.gif"> Cargando Tabla</center></b>
    </div>
    </div>
</div> 
 <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog">
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Actividad</h4>
        </div>
          
        <div class="modal-body">
            <table>
                 <tr>
                    <td>Radicado</td>
                    <td><input type="text" id="id_a" class="form-control" disabled></td>
                </tr>
                <tr>
                    <td>Asunto</td>
                    <td><input type="text" id="motivo" class="form-control"></td>
                </tr>
                <tr><td>Fecha De Inicio</td>
                    <td>  
                      <div class="input-group">
                        <input name="remitosucursal" id="fec_ini" type="date" required class="form-control">
                        <span class="input-group-addon">Hora</span>
                        <input name="remitonumero" id="hra" type="time" required class="form-control">
              
                      </div>
                    </td>
                    </tr> 
                    <tr>
                    <td>Asignado a</td> 
                    <td> 
                        <div class="input-group">
                            <span class="input-group-addon">
                            <button type="button" onclick="buscar_usuario();"><img src="../imagenes/search.png" width="15px" height="15px"></button></span>
                            <input type="text" id="asig" class="form-control" disabled>
                        </div>
                        </td>
                    </td>
                </tr>
                
                <tr>
                   <td>aviso?<b>*</b></td>
                    <td>
                        <select id="alarma" class="form-control">
                            <option value="Si">Si</option>
                            <option value="No">No</option>    
                        </select> 
                    </td>
                 </tr>
                
                  <tr>
                    <td>Descripcion</td> 
                    <td><textarea id="descrip" placeholder="motivo de llamada" style="width:100%"></textarea></td>
                  </tr>
                  
                 <tr>
                   <td>llamada?<b>*</b></td>
                   <td>  <div class="input-group">
                        <select id="tip_llamada" class="form-control">
                            <option value="Entrante">Entrante</option>
                            <option value="Saliente">Saliente</option>    
                        </select> 
                  <span class="input-group-addon">Estado de la llamada</span>
                        <select id="est_llamada" class="form-control">
                            <option value="Planificada">Planificada</option>
                            <option value="Completada">Completada</option>    
                            <option value="No realizada">No realizada</option>  
                        </select> 
                       </div> </td></tr>
             
                  <tr>
                      <td>Cliente  </td> 
                     <td>
                         <div class="input-group">
                             <span class="input-group-addon">
                                 <button type="button" onclick="buscar_contacto(0);"><img src="../imagenes/search.png" width="15px" height="15px"></button>
                             </span>
                             <input type="hidden" id="cliente" class="form-control">
                             <input type="text" id="nombre_cliente" class="form-control" disabled width="100%"> <!-- adicionado por navabla -->
                         </div>
                         
                         
                      </td>
                  </tr>  
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_actividad()">Guardar Cambios</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         