<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/precio_instalacion/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_preinst();"><h6><B>Crear</B></h6></a>
       </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
     <tr class="bg-info">
        <th>ID</th> 
        <th>DESCRIPCION</th>
        <th nowrap>TIPO</th>
        <th nowrap>UNID DE MEDIDA</th> 
        <th>V. TOTAL 1</th>
 
        <th>PARAFISCALES</th>
        <th>ESTADO</th>
        <th nowrap>--OPCIONES--</th> 
     </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
        <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td>
        <select id="est_b" class="col-xs-10 col-sm-12">
                              <option value="">Seleccione</option>
                              <option value="Instalacion">Instalacion</option>
                              <option value="Fabricacion">Fabricacion</option>
			          
		              </select>
        </td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         
        
    </tr>
    <tbody id="mostrar_tabla">
          <h3 class="bg-info center"><b>PRECIOS DE INSTALACION Y FABRICACION</b></h3>
    </tbody>
</table>
                             
       </div>
           </div><br>

          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                       <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right" for="form-field-2">COD</label>
                               <div class="col-sm-20">
                                <div class="col-sm-4">
                                   <input type="text" id="cod_inst" placeholder="" class="col-xs-10 col-sm-12" disabled/>
                                </div>
                               </div>
                        </div>
                   <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="desc_inst" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>
                       <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">TIPO</label>
                        <div class="col-sm-20">
                           <div class="col-sm-4">
                              <select id="sis_inst" class="col-sm-9">
                              <option value="">Seleccione</option>
                              <option value="Instalacion">Instalacion</option>
                              <option value="Fabricacion">Fabricacion</option>
			          
		              </select>
                           </div>
                        </div>
                   </div>
                       
                   
                 <div class="form-group">
                    <label nowrap class="col-sm-3 control-label no-padding-right" for="form-field-2">Unid med</label>
                    <div class="col-sm-20">
                        <div class="col-sm-4">
                           <select id="unid_inst" class="col-sm-9">
                              <option value="">Seleccione</option>
			          <?php
                                  $consulta= "SELECT * FROM `umb`";                     
                                  $result=mysqli_query($con,$consulta);
                                  while($fila=  mysqli_fetch_array($result)){
                                  $valor1=$fila['unidad'];
                                  echo"<option value=".$fila['unidad'].">".$valor1."</option>";
                                  }
                                  ?>
		              </select>
                    </div>
                        
                    </div>
                    </div>
                       
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Valor total 1</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="vt1" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             
                               <input type="hidden" id="vt2" placeholder="" class="col-xs-10 col-sm-9"/>
                          </div>
                        </div>
                    </div>
                       
                   <div class="form-group">
<!--                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">% OFICIAL</label>-->
                        <div class="col-sm-20">
                           <div class="col-sm-4">
                              <input type="hidden" id="por_of" placeholder="" class="col-xs-10 col-sm-12" />
                           </div>
                        </div>
                   </div>
                       
                  <div class="form-group">
<!--                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">% AYUDANTE</label>-->
                       <div class="col-sm-20">
                         <div class="col-sm-4">
                           <input type="hidden" id="por_ayu" placeholder="" class="col-xs-10 col-sm-12" />
                         </div>
                       </div>
                  </div>
                       
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Estado</label>
                    <div class="col-sm-20">
                    <div class="col-sm-4">
                       <select id="est_precio" class="col-sm-12">
<!--                         <option value="">Seleccione</option>-->
		         <option value="0">Activo</option>
		         <option value="1">Inactivo</option> 
	               </select>
                    </div>
                    </div>
                 </div>
                       
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Parafiscales</label>
                    <div class="col-sm-20">
                     <div class="col-sm-4">
                         <input type="text" id="parafis_inst" placeholder="" class="col-xs-10 col-sm-4" disabled value="44.79"/><b>&nbsp; %</b>
                    </div>
                    </div>
                
                    </div>
                   
                 
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="inst_usu" placeholder="" class="col-xs-10 col-sm-3" disabled/>
                        <input type="text" value="<?php echo date("Y-m-d"); ?>" id="fech_inst" placeholder="" class="col-xs-10 col-sm-2" disabled />
                      </div>
                    </div>
                       
                    <div class="form-actions">
                      <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_preinst()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_preinst()">Nuevo
                      <i data-dismiss="modal"></i></button>
                      <button type="button" class="btn btn-info" onclick="versistema()">Sistemas</button>
                    </div>
                   </div>
                   </div>
               </div>
        </div> 
  <div class="modal fade" id="modalsistema" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar Sistema</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width: 100%">
              <tr>
                  <td>Codigo</td>
                  <td><input type="text" id="codigo"></td>
              </tr>
               <tr>
                                    <td>Sistema</td>
                                    <td>
                                        <select id="sis" class="col-sm-6">
                                            <option value="">Seleccione</option>
                                            <?php
                                            $result = mysqli_query($con, "select * from sistemas");
                                            while($r = mysqli_fetch_array($result)){
                                                echo '<option value="'.$r[1].'">'.$r[1].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
          </table>
          <hr>
          <table class="table table-hover">
              <tr>
                  <th>CODIGO</th>
                  <th>SISTEMA</th>
                  <th>BORRAR</th>
              </tr>
              <tbody id="ver_sistema">
                  
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregar_sistemas()">Agregar</button>
      </div>
    </div>
  </div>
</div>
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





