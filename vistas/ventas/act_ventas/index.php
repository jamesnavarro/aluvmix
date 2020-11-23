<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/ventas/act_ventas/funciones.js"></script>
<div>
       <div class="tab-content"> 
            <table class="table table-hover responsive">
                   <tr class="bg-info">
                        <th nowrap>Nombre del cliente</th>
                        <th nowrap>Motivo de llamada</th> 
                        <th nowrap>Nombre del Contacto</th>  
                        <th>Respuesta</th>
                        <th>Estado</th> 
                        <th>Fecha de inicio</th> 
                        <th>Usuario</th>  
                    </tr> 
                    <tr class="bg-info">
                        <td><input type="text" id="clienteb" class="col-xs-6 col-sm-8" placeholder=""></td> 
                        <td><input type="text" id="" class="col-xs-6 col-sm-8" placeholder="" disabled></td> 
                        <td><input type="text" id="nombre" class="col-xs-6 col-sm-8" placeholder=""></td>
                        <td><input type="text" id="" class="col-xs-6 col-sm-8" placeholder="" ></td>
                        <td>
                           <select id="esta" class="form-control">
                             <option value="Planificada">Planificada</option>
                             <option value="Completada">Completada</option>
                             <option value="">Todas</option>
                           </select>
                        </td> 
                        <td><input type="date" id="finicio" class="col-xs-6 col-sm-8" placeholder="inicio" value="<?php echo date("Y-m-d") ?>">  </td> 
                    <td>
                        <select class="col-xs-6 col-sm-8" id="usuarioc" name="numero" required>
	                <?php
		         if (isset($_GET['cot'])){
		         echo "<option value='" . $reg . "'>" . $reg . "</option>";
		        } else {
		         	echo "<option value=''>Usuarios</option>";
		             }
                            $consulta2= "SELECT * FROM `usuarios` where area='cartera' and estado='Activo' order by nombre";   
                            $result2=  mysqli_query($con,$consulta2); 
                            echo "<option value='ADMIN'>ADMIN</option>";  
                            while($fila=  mysqli_fetch_array($result2)){       
                            $valor3=$fila['usuario'];  
                            $valor4=$fila['nombre'].' '.$fila['apellido'];   
                             echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                            }                                                       
                       ?>       
                     </select>
                   </td>
                </tr>
               <tbody id="mostrar_tabla">
                  <br>
                  <div> <button type="button" class="btn btn-primary" onclick="editar_act(0);"><img src="../imagenes/call.png" width="15px" height="15px">&nbsp; Nueva </button></div>
                  <br>
            </tbody> 
</table>
             <br>
</div>
    <br>
        <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Llamada</h4>
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
                    <td>Asignado a:</td> 
                    <td> 
                        <input type="text" value="<?php echo $_SESSION["k_username"]; ?>"  id="asig" class="form-control"> 
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
                   <td>llamada?<b>*</b></td>
                   <td> 
                       <div class="input-group">
                        <select id="tip_llamada" class="form-control">
                            <option value="Entrante">Entrante</option>
                            <option value="Saliente">Saliente</option>    
                        </select> 
                        <span class="input-group-addon">Estado de la llamada</span>
                        <select id="est_llamada" class="form-control">
                            <option value="Planificada">Planificada</option>
                            <option value="Completada">Completada</option>   
                        </select> 
                       </div>
                   </td>
                 </tr> 
                  <tr>
                      <td>Coctacto</td> 
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
                  <tr>
                    <td>seguimiento de llamada</td> 
                    <td><textarea id="descrip" placeholder="seguimiento de llamadas"  style="width:100%"></textarea></td>
                  </tr>
            </table>
        </div>
        <div class="modal-footer">
            <span id="reprogramar"></span><button type="button" class="btn btn-primary" onclick="guardar_actividad()">Guardar Cambios</button> 
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div> 
    </div>
  </div>              
 </div>
<br>  
<?php  }else {
    echo '<script>location.reload();</script>';
}?>      
         
  
     

      





