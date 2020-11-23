<?php
include('../../../modelo/conexioni.php');

session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/cuentas_cobro/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_cuentac();"><h6><B>Crear cuenta de cobro</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
                       <tr>
                         <h3 class="bg-info" style="text-align: center"><B>LISTA CUENTAS DE COBRO</B></h3>
                         </tr>
 <tr class="bg-info">
        <th>ID</th>
        <th>INF CLIENTE</th>
        <th>PUESTO</th>
        <th>OPERACION</th>
        <th>ESTADO</th>
        <th>USUARIO</th>
        <th>FECHA</th> 
        <th>VER</th>
  </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-4" disabled/></td>
        <td><input type="text" id="clien_b" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><select id="ope_b" class="col-xs-10 col-sm-12">
                            <option value="">Todos</option>
			    <option value="CIF">CIF</option>
			    <option value="MAQ">MAQ</option> 
            </select>
        </td>
        <td><select id="esta_b" class="col-xs-10 col-sm-12">
                            <option value="">Todos</option>
			    <option value="En proceso">En proceso</option>
			    <option value="Guardado">Guardado</option> 
            </select>
        </td>
        <td><input type="text" id="usu_b" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><input type="date" id="fec_b" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-10"  disabled/></td>
      
    </tr>
        <tbody id="mostrar_tabla"></tbody>
</table>
                             
       </div>
         </div><br>
          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                     <div class="form-group">
                           <label class="col-sm-3 control-label no-padding-right" for="form-field-2">id</label>
                             <div class="col-sm-9">
                              <input type="text" id="id_cta_c" placeholder="" class="col-xs-10 col-sm-1" disabled />
                             </div>
                    </div>
                   
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2"><b>Cliente</b> <img onclick="bus_cli();" src="images/buscar.png"></label>
                          <div class="col-sm-9">
                              <input type="text" id="doc_cli" onchange="bcar_tercero();" placeholder="" class="col-xs-10 col-sm-2"/>
                              <input type="text" id="cli_nom" placeholder="" class="col-xs-10 col-sm-4" disabled />
                          </div>
                    </div>
                       
                       
                   <div class="form-group">
                       <div class="col-sm-9">
                          <input type="hidden" id="puesto_c" autofocus placeholder="" class="col-xs-4 col-sm-8" style="width: 100%" disabled>
                       </div>
                   </div>
                       
                     
                    <div class="form-group">
                        <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                          <div class="col-sm-9">
                           <input type="text" id="estado_c" placeholder="" class="col-xs-10 col-sm-6" disabled/>
                          </div>
                    </div>
                       
                    <div class="form-group">
                       <div class="col-sm-9">
                          <input type="hidden" id="operacion_c" autofocus placeholder="" class="col-xs-4 col-sm-8" style="width: 100%" disabled>
                        </div>
                    </div>
                     
                    <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                        <div class="col-sm-9">
                             <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="usu_cuenta" placeholder="" class="col-xs-10 col-sm-3" disabled/>
                             <input type="text" value="<?php echo date("Y-m-d"); ?>" id="fecha_cuenta" placeholder="" class="col-xs-10 col-sm-3" disabled />
                         </div>
                    </div>
                       
                    <div class="form-group">
                        <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                        <button type="button" class="btn btn-success" onclick="pdf()"> <img src="../imagenes/print.png" width="20px"/></button>
                        <button type="button" class="btn btn-info" onclick="guardar_cuentac()">Guardar</button>
                        <button type="button" class="btn btn-danger" onclick="limpiar_cuentac()">Nuevo
                        <i data-dismiss="modal"></i></button>
                    </div>
                       
                     <table class="table table-hover">
                         <tr>
                         <h3 class="bg-info" style="text-align: center"><B>INGRESO DE DETALLES</B></h3>
                         </tr>
                         
                          <tr class="bg-info">
                              <th onclick="serv();" >CODIGO <img onclick="serv();" src="../imagenes/zoom.png"></th>
                              <th>DESCRIPCION</th>
                              <th>PUESTO</th>
                              <th>MOVIMIENTO</th>
                              <th>CANTIDAD</th>
                              <th>VALOR_UNIDAD</th>
                              <th>VALOR_TOTAL</th>
                              <th>OPCIONES</th>
                           </tr>
                            <tr>    
                                <th><input type="hidden" id="id_itm" placeholder="" class="col-xs-4 col-sm-4" style="width: 100%" disabled><input type="text" id="dos" autofocus placeholder="" class="col-xs-4 col-sm-4" style="width: 100%" disabled></th>
                                     <th><input type="text" id="tres" autofocus placeholder="" class="col-xs-4 col-sm-8" style="width: 100%" disabled></th>
                                      <th><select id="puesto" class="col-xs-4 col-sm-8">
                                          <option value="">Seleccione</option>
			                  <?php
                                                 $consulta= "SELECT * FROM `puestos_trabajos`";                     
                                                 $result=  mysqli_query($con,$consulta);
                                                  while($fila=  mysqli_fetch_array($result)){
                                                 $valor1=$fila['nombre_puesto'];
                                                  echo"<option value=".$fila['id_puesto'].">".$valor1."</option>";
                                                 }
                                           ?>
                                   
		                </select></th>
                                    <th>
                                        <select id="movimiento" class="col-xs-4 col-sm-10">
                                           <option value="">Seleccione</option>
			                   <option value="CIF">CIF</option>
			                  <option value="MAQ">MAQ</option> 
		                       </select>
                                     </th>
                                     
                                     
                                     <th><input type="text" id="cuatro" autofocus placeholder="" onchange="operacion_item();" class="col-xs-4 col-sm-8" style="width: 100%"></th>
                                     <th style="text-align:right"><input type="text" id="cinco" autofocus placeholder="" class="col-xs-4 col-sm-8" style="width: 100%" disabled></th>
                                     <th><input type="text" id="seis" autofocus placeholder="" class="col-xs-4 col-sm-8" style="width: 100%"></th>
                                     <th nowrap  style="text-align:right"><button type="button" class="btn btn-info" onclick="guardar_item();">Agregar</button></th>
              
                                    </tr>
                                    <tbody id="mostrar_item">
                                    </tbody>
                           
                      
                       </table>  
                       
                       
                    </div>
                
                     
                   </div>
               </div>
        </div> 
  
         
         <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>   
  
     

      





