<?php
 include('../../../modelo/conexioni.php');
?>
<script src="../vistas/inventario/ubicaciones/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
    </li>
           <li id="marca2">
               <a data-toggle="tab" onclick="limpiar_ubi();" href="#lin2"><h6><B>Agregar</B></h6></a>
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
              <table class="table table-hover">
                <tr class="bg-info">
                  <th>ID</th> 
                  <th>COLUMNA</th>
                  <th>UBICACIONES</th>
                  <th>SEDE</th>
                  <th>CENTRO</th>
                  <th>MODIFICADO</th>
                  <th>USUARIO</th>
                  <th>EDITAR</th>
                </tr>
          <tr>
               <td><input type="text" id="cod"  placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
               <td><input type="text" id="des"  placeholder="" class="col-xs-10 col-sm-12"/></td> 
               <td><input type="text" id="resT" placeholder="" class="col-xs-10 col-sm-12"/></td> 
               <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td>
               <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
               <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
               <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
          </tr>
 <tbody id="mostrar_tabla">    
     </tbody>
     </table>
         </div>
         <div id="lin2" class="tab-pane fade in">
            <div class="modal-header">
              <h4 class="modal-title">Formulario</h4>
            </div>
            <div class="form-horizontal" role="form">
              <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Id</label>
                 <div class="col-sm-9">
                 <input type="text" id="id_ubi" placeholder="" class="col-xs-10 col-sm-5" disabled />
                 </div>
              </div>
              <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Columna</label>
                 <div class="col-sm-9">
                 <select id="colum_ubi">
                   <option value=""></option>
                     <?php
                       $result = mysqli_query($con, "select columna from ubicaciones group by columna order by columna asc");
                       while ($r = mysqli_fetch_array($result)){
                       echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                       }
                     ?>
                 </select>
                 </div>
                </div>
                  <div class="form-group">
                    <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Ubicacion</label>
                    <div class="col-sm-9">
                    <input type="text" id="ubica_ubi" placeholder="" class="col-xs-10 col-sm-5" />
                    </div>
                  </div>
                   <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Centro de produccion</label>
                 <div class="col-sm-9">
                           <select id="cen_ubi" class="col-sm-5">
                          <option value="">Seleccione</option>
                    <?php
                             $consulta= "SELECT * FROM `centroproduccion`";                     
                             $result=  mysqli_query($con,$consulta);
                             while($fila=mysqli_fetch_array($result)){
                             $valor1=$fila['cp_codigo'];
                             $valor2=$fila['cp_nombre'];
                               echo"<option value='".$valor1."'>".$valor2."</option>";
                          }
                    ?>
	     </select>
                 </div> </div>
                         <div class="form-group">
                 <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Sede</label>
                 <div class="col-sm-9">
                           <select id="sed_ubi" class="col-sm-5">
                            <option value="">Seleccione</option>
                            <option value="CALLE 72">CALLE 72</option>
                            <option value="GALAPA">GALAPA</option>
                        </select>
                    </div>
                    </div>
          
                   
                   <div class="form-actions">
                     <label class="col-sm-5 control-label no-padding-right" for="form-field-2"> </label>
                     <button type="button" class="btn btn-success" onclick="guardar_ubi()">Guardar</button>
                     <button type="button" class="btn btn-danger" onclick="limpiar_ubi()">Nuevo
                      <i data-dismiss="modal"></i></button>
                   </div>
                     </div>
                
                     
                   </div>
               </div>
        </div> 
       
         
         
         
  
     

      





