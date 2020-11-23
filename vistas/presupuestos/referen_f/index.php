<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/referen_f/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" onclick="limpiar_reff();"><h6><B>Agregar nuevo perfil</B></h6></a>
           </li>
 </ul>
 <div class="tab-content">
            	<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <br>
                 <table class="table table-hover">
     <tr class="bg-info">
                <th>SISTEMA</th> 
                <th>REFERENCIA</th>
                <th>DESCRIPCION</th>
                <th>PESO</th>
                <th>PERIMETRO</th>
                <th nowrap>PERIMETRO T</th>
                <th nowrap>COSTO ALUMINIO CRUDO</th>
                <th>OPCIONES</th> 
        
     </tr>
     <tr>  
        <td><select id="sistema" class="col-sm-12">
                                <option value="">Seleccione </option>
                                      <?php 
                                      $consulta2= "SELECT * FROM `sistemas`";                     
                                      $result2=  mysqli_query($con,$consulta2);
                                      while($fila=mysqli_fetch_array($result2)){
                                      $valor1= "'".$fila['nombre_sistema']."'";
                                      //echo "<option value='".$valor1."'>".$valor1."</option>";
                                      echo '<option value="'.$fila['nombre_sistema'].'">'.$fila['nombre_sistema'].'</option>';
                                      }
                                      ?>
	                    </select></td>
         <td><input type="text" id="cod" placeholder="" class="col-xs-10 col-sm-12" />
        </td>
      
         <td><input type="text" id="est_b" placeholder="" class="col-xs-10 col-sm-12"/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-8" disabled/></td>
    </tr>
    <tbody id="mostrar_tabla">
          <h3 class="bg-info center"><b>REFERENCIAS DE PERFILES</b></h3>
    </tbody>
</table>
                             
       </div>
           </div><br>

          <div id="agregar" class="tab-pane fade in">
              
                   <div class="form-horizontal" role="form">
                       <div class="form-group">
                             <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Referencia</label>
                               <div class="col-sm-20">
                                <div class="col-sm-4">
                                   <input type="text" onchange="bcar_ref();" id="referen_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                                </div>
                               </div>
                        </div>
                       
                   <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Descripcion</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="desc_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>
                          <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Sistema</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             
                             <select id="sist_pre" class="col-sm-5">
                                <option value="">Seleccione</option>
                                   <?php
                                      $consulta= "SELECT * FROM `sistemas`";                     
                                      $result=  mysqli_query($con,$consulta);
                                      while($fila=mysqli_fetch_array($result)){
                                      $valor1=$fila['nombre_sistema'];
                                      echo"<option value=".$fila['nombre_sistema'].">".$valor1."</option>";
                                      }
                                   ?>
	                    </select>
                          </div>
                       </div>
                    </div>
                            <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Peso</label>
                        <div class="col-sm-20">
                           <div class="col-sm-4">
                              <input type="text" id="pes_pre" placeholder="" class="col-xs-10 col-sm-12" />
                           </div>
                        </div>
                   </div>
               
               
                             <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Perimetro</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="perime_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>
                       
                             <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Perimetro T</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="perit_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>
                     <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Costo aluminio crudo</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="costalum_pre" placeholder="" class="col-xs-10 col-sm-12" disabled/>
                          </div>
                       </div>
                    </div>
<!--                             <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Dado alumina</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="dadoaulu_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>
                             <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Dado indalum</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="dadoinda_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>
                       
                             <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Dado Aluica</label>
                       <div class="col-sm-20">
                          <div class="col-sm-4">
                             <input type="text" id="dadoauluic_pre" placeholder="" class="col-xs-10 col-sm-12"/>
                          </div>
                       </div>
                    </div>-->
                       
                    <div class="form-group">
                      <label class="col-sm-3 control-label no-padding-right" for="form-field-2"></label>
                      <div class="col-sm-9">
                          <input type="hidden" value="<?php echo $_SESSION["k_username"]; ?>" id="reff_usu" placeholder="" class="col-xs-10 col-sm-3" disabled/>
                          <input type="hidden" value="<?php echo date("Y-m-d"); ?>" id="reff_inst" placeholder="" class="col-xs-10 col-sm-2" disabled />
                      </div>
                    </div>
                       
                    <div class="form-actions">
                      <label class="col-sm-5 control-label no-padding-right" for="form-field-2"></label>
                      <button type="button" class="btn btn-success" onclick="guardar_refer()">Guardar</button>
                      <button type="button" class="btn btn-danger" onclick="limpiar_reff()">Nuevo
                      <i data-dismiss="modal"></i></button>
                    </div>
                   </div>
                   </div>
               </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





