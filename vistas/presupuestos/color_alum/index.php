<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/color_alum/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_col();"><h6><B>Crear</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
     <tr class="bg-info">
        <th>ID</th> 
        <th>COLORES</th>
        <th>COSTO</th>
        <th>VARIABLE</th> 
        <th>CODIGO</th>
        <th>RENDIMIENTO</th>
        <th>OPCIONES</th>
        
     </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
         <td><select id="cod" class="col-sm-5">
                <option value="">Seleccione</option>
                    <?php
                             $consulta= "SELECT * FROM `tipo_aluminio`";                     
                             $result=  mysqli_query($con,$consulta);
                             while($fila=mysqli_fetch_array($result)){
                             $valor1=$fila['color_a'];
                             echo"<option value=".$fila['color_a'].">".$valor1."</option>";
                          }
                    ?>
	     </select>
        </td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
          <td><input type="text" id="est_b" placeholder="" class="col-xs-10 col-sm-8" /></td>
          <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" /></td>
    </tr>
    <tbody id="mostrar_tabla">
          <h3 class="bg-info center"><b>COLORES DE ALUMINIO</b></h3>
    </tbody>
</table>
                             
       </div>
           </div><br>

          <div id="agregar" class="tab-pane fade in">
                   <div class="form-horizontal" role="form">
                       <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Id</label>
                               <div class="col-sm-20">
                                <div class="col-sm-4">
                                   <input type="text" id="id_col" placeholder="" class="col-xs-10 col-sm-12" disabled/>
                                </div>
                               </div>
                        </div>
                       
                   <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="desc_col" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>     
                 <div class="form-group">
                    </div>
                       
                   <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costo</label>
                        <div class="col-sm-20">
                           <div class="col-sm-4">
                              <input type="text" id="costo_col" placeholder="" class="col-xs-10 col-sm-12" />
                           </div>
                        </div>
                   </div>
                       
                  <div class="form-group">
                     <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Variable</label>
                       <div class="col-sm-20">
                         <div class="col-sm-4">
                              <select id="vari_col" class="col-sm-12">
                                   <option value="">Seleccione</option>
	               <option value="Crudo">Crudo</option>
                                  <option value="Anonizado">Anonizado</option>
                                   <option value="Pintura">Pintura</option> 
	          </select>
                         </div>
                       </div>
                  </div>
                       
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Codigo</label>
                    <div class="col-sm-20">
                     <div class="col-sm-4">
                         <input type="text" id="cod_col" placeholder="" class="col-xs-10 col-sm-4"/>
                    </div>
                    </div>
                    </div>
                   
                <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Rendimiento</label>
                    <div class="col-sm-20">
                     <div class="col-sm-4">
                         <input type="text" id="rendi_col" placeholder="" class="col-xs-10 col-sm-4"/>
                    </div>
                    </div>
                    </div>
                       
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Medida Maxima</label>
                    <div class="col-sm-20">
                     <div class="col-sm-4">
                         <input type="text" id="me_max" placeholder="" class="col-xs-10 col-sm-4"/>
                    </div>
                    </div>
                   </div>
                       
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                      <div class="col-sm-9">
                        <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="col_usu" placeholder="" class="col-xs-10 col-sm-3" disabled/>
                        <input type="text" value="<?php echo date("Y-m-d"); ?>" id="col_inst" placeholder="" class="col-xs-10 col-sm-2" disabled />
                      </div>
                    </div>
                       
                    <div class="form-actions">
                      <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_col()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_col()">Nuevo
                    <i data-dismiss="modal"></i></button>
                    </div>
                   </div>
                   </div>
               </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





