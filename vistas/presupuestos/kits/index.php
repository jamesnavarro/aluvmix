<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/kits/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
  
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
             <h6><B>LISTA</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_kits()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                       </div>
                        <br>
                                             <table class="table table-hover">
   
    <tr class="bg-info">
        <th>ITEM</th>
        <th>DESCRIPCION KIT</th> 
        <th>CATEGORIA</th> 
        <th>VALOR</th>
        <th>ESTADO</th>
        <th>OPCIONES</th>
    </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-sm-8" disabled/></td>
        <td><input type="text" id="nom" placeholder="" class="col-sm-8"/></td> 
        <td><input type="text" id="categorias" placeholder="" class="col-sm-8"/></td>
        <td><input type="text" id="" placeholder="" class="col-sm-8" disabled/></td>
        <td><select id="est_k" class="col-sm-8"> 
                                            <option value="">Seleccione</option>
                                            <option value="0">Activo</option>
                                            <option value="1">Inactivo</option>
                                        </select></td>
        <td><input type="text" id="" placeholder="" class="col-sm-8" disabled/></td>
    </tr>
    <tbody id="mostrar_tabla">    
    
    </tbody>
</table>  
                        
<!--                         <div id="mostrar_tabla">
                            <br><br>
                            <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                      </div>       -->
                </div>
                    </div><br>
               <div id="agregar" class="tab-pane fade in">
               
                        <div class="col-xs-12">
                            
                            <table style="width:100%">
                                <tr>
                                    <td>Codigo</td>
                                    <td><input type="text" id="codigo" class="col-sm-5" disabled/></td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td><input type="text" id="descripcion" class="col-sm-5" /></td>
                                </tr>
                                <tr>
                                    <td>Modulo</td>
                                    <td>
                                        <select id="modulo" class="col-sm-5">
                                            <option value="">Seleccione</option>
                                            <option value="Cierres">Cierres</option>
                                            <option value="Rodajas">Rodajas</option>
                                            <option value="Brazos">Brazos</option>
                                            <option value="Bisagras">Bisagras</option>
                                        </select>
                                    </td>
                                </tr>
                               
                                <tr>
                                    <td>Valor</td>
                                    <td><input type="hidden" id="sistema" class="col-sm-5" disabled/>
                                        <input type="text" id="valor" class="col-sm-5" disabled/></td>
                                </tr>
                                 <tr>
                                    <td>Estado</td>
                                    <td>
                                        <select id="est_kit" class="col-sm-5">
                                            <option value="">Seleccione</option>
                                            <option value="0">Activo</option>
                                            <option value="1">Inactivo</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                         </div>


                
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_kits()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-danger" onclick="limpiar_kits()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                           <label>
                                 <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#modalinsumos">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         INSUMOS
                                 </button>
                            </label> 
                           <label>
                                 <button class="btn btn-lg btn-success" data-toggle="modal" data-target="#modalsistema">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
                                 SISTEMA
                                 </button>
                            </label> 
                       </div>
              
                  
                         </div> 
                  
                        </div>

 </div>

</div>
</div>  
<div class="modal fade" id="modalinsumos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Registrar Insumos a <span id="titu"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table style="width: 100%">
              <tr>
                  <td>Codigo</td>
                  <td><input type="text" id="cod_pro" class="col-sm-6"/></td>
              </tr>
              <tr>
                  <td>Descripcion</td>
                   <td><input type="text" id="des_pro" class="col-sm-12" disabled/></td>
              </tr>
              <tr>
                  <td>Cantidad</td>
                   <td><input type="text" id="can_pro" class="col-sm-6" /></td>
              </tr>
          </table>
          <table class="table table-hover">
              <tr>
                  <th>CODIGO</th>
                  <th>DESCRIPCION</th>
                  <th>CANTIDAD</th>
                  <th>COSTO</th>
                  <th>BORRAR</th>
              </tr>
              <tbody id="ver_insumos">
                  
              </tbody>
          </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregar_insumos()">Agregar</button>
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
