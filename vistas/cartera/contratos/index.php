<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/cartera/contratos/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>Contratos</B></h6>
           </a>
        </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_pen();" href="#lin2"><h6><B>Crear Contrato</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
            <table class="table table-hover">
                <tr class="bg-info">   
                                <th>Rad.</th>
                                <th>Nombre del Cliente</th>
                                <th nowrap>Nombre de la obra</th>
                                <th>Vendedor</th> 
                                <th nowrap>Inf. del contrato</th>
                                <th nowrap>Fecha de pago</th> 
                                <th>Notas</th> 
                                <th nowrap>Estado</th> 
                                <th>DETALLES</th> 
                </tr>
                <tr>
                <td>
                 <input type="text" id="" class="col-xs-10 col-sm-12"/>
               </td>
               <td>
                   <input type="text" id="nombre" placeholder="nombre del cliente" class="col-xs-10 col-sm-12"/>
               </td>
               <td>
                   <input type="text" id="nomobra" placeholder="nombre de la obra" class="col-xs-10 col-sm-12"/>
               </td>
                 <td>
                    <select id="vennom" class="col-xs-10 col-sm-13">
                       <?php
	 	                  if (isset($_GET['cot'])){
		                  echo "<option value='" . $reg . "'>" . $reg . "</option>";
		                  } else {
		                      echo "<option value=''>Asesores</option>";
		                      }
                                      $consulta2= "SELECT * FROM `usuarios` where area='ventas' and  estado='Activo' order by nombre";   
                                      $result2=  mysqli_query($con, $consulta2); 
                                      echo "<option value='ADMIN'>ADMIN</option>";  
                                      while($fila=  mysqli_fetch_array($result2)){       
                                      $valor3=$fila['usuario'];  
                                      $valor4=$fila['nombre'].' '.$fila['apellido'];   
                                      echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                       }                                                       
                                ?>      
                           
                      </select>
               </td>
               <td>
                     <input type="text" id="numcontra" placeholder="buscar por numero" class="col-xs-10 col-sm-12"/>
               </td>
                 <td>
                 <input type="date" id="fechaval" class="col-xs-10 col-sm-12"/>
               </td>
                 <td>
                     <input type="text" id="" class="col-xs-10 col-sm-12" disabled/>
               </td>
                 <td>
                  <select id="estanom" class="col-xs-10 col-sm-12">
                       <option value="">Seleccione</option>
                      <option value="NC">NC</option> 
                      <option value="C">C</option>
                             
                  </select>
               </td>
                 <td>
                 <input type="text" id="" class="col-xs-10 col-sm-12" disabled/>
               </td>
        
                </tr>
       <tbody id="mostrar_tabla">
       </tbody>
</table>
</div>
          <div id="lin2" class="tab-pane fade in">
              <div class="form-horizontal" role="form">
             <table style="width: 100%">
                 <h4 style="text-align: center;">
                      <b>REGISTRO DE CONTRATO</b>
                 </h4>
                 <br>
               <tr>
                   <TD></TD>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">#Rad CONTRATO</span>
                            <input type="number" id="id_inf" class="form-control" style="width: 30%" disabled>
                            <span class="input-group-addon">#CONTRATO</span>
                            <input type="text" id="n_cot" class="form-control"> 
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
                    <td>Asesor:</td> 
                     <td>
                         <div class="input-group">
                             <span class="input-group-addon"><button type="button" onclick="buscar_usuario();"><img src="../imagenes/search.png" style="width:12px"></button> </span>
                         <input type="text" id="vende" class="form-control" disabled>
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
                    <td>Quien instala</td>
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
                            <option value="">seleccione</option>
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
                <tr>
                    <td>Registrado por:</td>
                    <td>
                   <div class="input-group">
                    <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="registrado" class="form-control" disabled >
                    <span class="input-group-addon">Fecha de registro</span>
                    <input type="date"  id="fe_registro" class="form-control" value="<?php echo date("Y-m-d"); ?>" disabled >
                   </div>
                   </td>
                </tr>
            </table>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_pendientes()">Guardar Cambios</button> 
            <button type="button" class="btn btn-danger" onclick="limpiar_pen()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
               </div>
              </div>
                    </div>
                
                     
                   </div>
       
       
               <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>      
         
  
     

      





