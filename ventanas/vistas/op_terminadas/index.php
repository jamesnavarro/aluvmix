<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/op_terminadas/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="termi" class="form-control" placeholder="op"></td> 
            </table>
    <div id="mostrar_tabla"></div>
    </div>
</div> 
 <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog">
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva op</h4>
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
                    <td>Asignado a:<button type="button" onclick="buscar_usuario();"><img src="../imagenes/search.png"></button></td> 
                    <td> 

                        <select id="asig" class="form-control" onchange="cargarmun();">
                      <option value="">Seleccione</option>
                      <?php
                            $consulta = mysqli_query($con,"select * FROM `usuarios` group BY usuario");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['usuario'].'">'.$f['nombre'].' '.$f['apellido'].'</option>';
                            }
                            ?>
                      </select>
                    </td>
                </tr>
                
                <tr>
                   <td>aviso?<b>*</b></td>
                    <td>
                        <select id="alarma" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="si">Si</option>
                            <option value="no">No</option>    
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
                            <option value="">Seleccione</option>
                            <option value="entrante">Entrante</option>
                            <option value="saliente">Saliente</option>    
                        </select> 
                  <span class="input-group-addon">Estado de la llamada</span>
                        <select id="est_llamada" class="form-control">
                            <option value="">estado de llamada</option>
                            <option value="planificada">Planificada</option>
                            <option value="completada">Completada</option>    
                            <option value="no realizada">No relizada</option>  
                        </select> 
                       </div> </td></tr>
             
                  <tr>
                      <td>Cliente <button type="button" onclick="buscar_cliente();"><img src="../imagenes/zoom.png"></button> </td> 
                     <td>
                         <input type="hidden" id="cliente" class="form-control">
                         <input type="text" id="nombre_cliente" class="form-control" disabled>
                      </td>
                  </tr>   
              
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_actividad()">Guardar Cambios</button> 
            <button type="button" class="btn btn-danger" onclick="limpiar_act()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
 <?php  }else {

    echo '<script>location.reload();</script>';  
}?>         