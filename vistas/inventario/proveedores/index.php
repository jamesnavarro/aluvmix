<?php
 include('../../../modelo/conexioni.php');
 session_start();
 if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
?>
<script src="../vistas/inventario/proveedores/funciones.js?<?php echo rand(1,9999) ?>"></script>
<div class="tabbable">


                      <div class="tab-content">

                      <div id="messages" class="tab-pane fade active in">
                          <input type="text" id="buscar" placeholder="" value="" class="form-control"/>
                        <button class="btn btn-danger" onclick="con_fom_cod(1);">
                            
                              <i class="ace-icon fa fa-plus"></i> Buscar
                            </button>
                            <br><br>
                            <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">
                                      <th>NIT</th> 
				      <th>NOMBRE DEL PROVEEDOR</th>
                                      <th>TELEFONO</th>
                                      <th>EMAIL</th>
                    
                                      <th><input type="checkbox" name="item" onclick="marcar(this)"</th>
                                </tr>
                               <tbody id="mostrar_tabla2">
                                   
                               </tbody>
                               <tr><td colspan="4">
                                       <img src="images/at2.png"  onclick="paginacion(-1)" style="cursor: pointer;">
                                       Pagina: <input type="text" id="page" placeholder="" value="1"  disabled style="width: 30px"/>
                                       <img src="images/sig2.png" onclick="paginacion(1)" style="cursor: pointer;">
                                       <input type="hidden" id="tamano" placeholder="" value="10"  disabled/>
                                   </td><td colspan="1"><button onclick="agregar_cod_pro()" class="btn btn-success"> Sincronizar Codigos </button></td></tr>
                            </table>
                            <!-- FIN DE CONTENIDO -->
                        </div>
                    </div>
                  </div>
                  



  <!--  INSERTAR PRODUCTO  -->
   <div class="modal fade" id="nuevoProductox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Mantenimiento de Referencia</h4>
      </div>
      <div class="modal-body">
      <form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
      <div id="resultados_ajax_productos"></div>
       <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Codigo(adicional)</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" onchange="buscar_cod();" id="codxa" name="codxa" placeholder="Codigo adicional de producto" required maxlength="255" ></input>
          
        </div>
        </div>
        <div class="form-group">
        <label for="codigo" class="col-sm-3 control-label">Referencia</label>
        <div class="col-sm-8">
          <input type="text" class="auto" id="refxa" name="refxa" placeholder="Referencia del producto" required>
        </div>
        </div>
        
       

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nomxa" name="nomxa" placeholder="Codigo adicional de producto" required maxlength="255" ></input>
          
        </div>
        </div>
      
       <div class="form-group">
        <label for="precio" class="col-sm-3 control-label">Clase</label>
        <div class="col-sm-8">
               <select id="cla_xa" class="col-sm-7">
                          <option value="">Seleccione</option>
                    <?php
                             $consulta= "SELECT * FROM `clases`";                     
                             $result=  mysqli_query($con,$consulta);
                             while($fila=mysqli_fetch_array($result)){
                             $valor1=$fila['cla_codigo'];
                             $valor2=$fila['cla_nombre'];
                               echo"<option value='".$valor1."'>".$valor2."</option>";
                          }
                    ?>
	     </select>
        </div>
      </div>
      
      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Grupo</label>
        <div class="col-sm-8">
             <select id="gru_xa" class="col-sm-7">
                          <option value="">Seleccione</option>
                    <?php
                             $consulta= "SELECT * FROM `grupos`";                     
                             $result=  mysqli_query($con,$consulta);
                             while($fila=mysqli_fetch_array($result)){
                             $valor1=$fila['gru_codigo'];
                             $valor2=$fila['gru_nombre'];
                               echo"<option value='".$valor1."'>".$valor2."</option>";
                          }
                    ?>
	     </select>
        </div>
      </div>
        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Iva</label>
        <div class="col-sm-7">
        <select id="iva_xa" class="col-sm-3">
            <option>?</option>
          <option value="SI">SI</option>
          <option value="NO">NO</option>
        </select> 
        <label for="nombre" class="col-sm-1 control-label"><b>%</b></label> 
        <input type="text" id="poriva_xa" placeholder="porcentaje" required maxlength="255" class="col-sm-4">
          
        </div>
        </div> 
      

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Tipo Articulo:</label>
        <div class="col-sm-8">
        <select id="artxa" name="artxa" class="col-sm-7">
          <option> </option>
          <option value="FLOTANTE">FLOTANTE</option>
          <option value="INVENTARIO">INVENTARIO</option>
        </select>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Color</label>
        <div class="col-sm-8">
          <input type="text"class="form-control" id="colxa" name="colxa" placeholder="Digite Color" required></input>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Ancho</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="anchoxa" name="anchoxa" placeholder="Digite Ancho" required></input>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Alto</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="altoxa" name="altoxa" placeholder="Digite ALto" required></input>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Espesor</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="espxa" name="espxa" placeholder="Digite Espesor" required></input>
          
        </div>
        </div>

         <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Area</label>
        <div class="col-sm-8">
          <input type="number" class="form-control" id="arexa" name="arexa" placeholder="Digite Area" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Peso</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="pesxa" name="pesxa" placeholder="Digite Peso" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Stock Maximo</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="stc_max" name="stc_max" placeholder="Digite Peso" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Stock Minimo</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="stc_min" name="stc_min" placeholder="Digite Peso" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Stock Seguridad</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="stc_seg" name="stc_seg" placeholder="Digite Peso" required></input>
        </div>
        </div>

         <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Costo Promedio</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="cospa" name="cospa" placeholder="Costo Promedio" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Observaciones</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="obsxa" name="obsxa" placeholder="Obervaciones..." required></input>
        </div>
        </div>

       <input type="hidden" class="form-control" id="userxa" name="userxa"  value="<?php echo $_SESSION['k_username'];?>">
       <input type="hidden" class="form-control" id="empresaxa" name="empresaxa"  value="<?php echo $_SESSION['empresa'];?>">
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="guardar_datosxa">Guardar datos</button>
      </div>
      </form>
    </div>
    </div>
  </div>


     

      





