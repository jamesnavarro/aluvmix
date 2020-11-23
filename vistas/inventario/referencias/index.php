<?php
 include('../../../modelo/conexioni.php');
 session_start();
  if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
?>
<script src="../vistas/inventario/referencias/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable">
                      <ul class="nav nav-tabs" id="myTab">
                          <li class="active">
                          <a data-toggle="tab" href="#messages" aria-expanded="false">
                            <i class="green ace-icon fa fa-plus bigger-120"></i>
                            Productos
                          </a>
                        </li>
                        <li class="">
                          <a data-toggle="tab" href="#home" aria-expanded="true">
                            <i class="green ace-icon fa fa-home bigger-120"></i>
                            Referencias  (Familia)
                          </a>
                        </li>

                        
                      </ul>

                      <div class="tab-content">
                        <div id="home" class="tab-pane fade">
                            <button class="btn btn-success" onclick="agregapro();">
                              <i class="ace-icon fa fa-plus"></i> Agregar Nuevo
                            </button>
                            <br><br>
                          <!-- CONTENIDO DENTRO DE TABINDEX -->
                             <table class="table table-hover">
                                <tr class="bg-info">

                                      <th>CODIGO</th> 
                                      <th>DESCRIPCION</th>
                                      <th>UNIDAD</th>
                                      <th>ESTADO</th>
                                      <th>EDITAR</th>
                                      <th>SUBFAMILIAS</th>
				      <th>DADO</th>
                                </tr>
                                  <tr>
                                      <td><input type="text" id="cod" placeholder="Digite referencia a buscar" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="text" id="des" placeholder="Digite Descripcion" class="col-xs-10 col-sm-12"/></td> 
                                      <td></td> 
                                      <td></td>
                                      <td></td>
                                      <td></td>
				      <td></td>
                                  </tr> 
                               <tbody id="mostrar_tabla">
                               </tbody>
                            </table>
                          <!-- FIN DE CONTENIDO -->
                        </div>
                      <div id="messages" class="tab-pane fade active in">
                        <button class="btn btn-danger" onclick="agregapro2();">
                              <i class="ace-icon fa fa-plus"></i> Agregar Nuevo
                            </button>
                            <br><br>
                            <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">

                                      <th>CODIGO</th> 
				      <th>REFERENCIA</th>
                                      <th>DESCRIPCION</th>
                                      <th>UNIDAD</th>
                                      <th>GRUPO</th>
                                      <th>CLASE</th>
                                      <th>VALOR</th>
                                      <th>ESTADO</th>
                                      <th></th>
                                </tr>
                                  <tr>
                                      <td><input type="text" id="cod2" placeholder="Digite referencia a buscar" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="text" id="ref2" placeholder="Digite Referencia" class="col-xs-10 col-sm-12"/></td> 
			               <td><input type="text" id="des2" placeholder="Digite Descripcion" class="col-xs-10 col-sm-12"/></td> 
                                        
                                        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12"/></td> 
                                         <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-12"/></td> 
                                      <td></td>
                                      <td></td>
                                      <td><select id="est2" class="form-control">
                                              <option value="1">Activos</option>
                                              <option value="0">No Activos</option>
                                          </select></td>
                                      <td></td>
                                  </tr>
                               <tbody id="mostrar_tabla2">
                               </tbody>
                            </table>
                            <!-- FIN DE CONTENIDO -->
                        </div>
                    </div>
                  </div>
                  
<!-- Modal -->
  <div class="modal fade" id="EditarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar producto</h4>
      </div>
      <div class="modal-body">
      
      <div id="resultados_ajax_productos"></div>
        <div class="form-group">
        <label for="codigo" class="col-sm-3 control-label">Referencia</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="refd" name="refd" placeholder="Código del producto" readonly required>
        </div>
        </div>
        
        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nombred" name="nombred" placeholder="Nombre del producto" required maxlength="255" ></input>
          
        </div>
        </div>
        
        <div class="form-group">
        <label for="color" class="col-sm-3 control-label">Und medida</label>
        <div class="col-sm-8">
          <select name="und" id="undd">
            <option> </option>
            <option>UND</option>
            <option>MT</option>
            <option>MT2</option>
            <option>KG</option>
            <option>METROS LINEALES</option>
            <option>LIBRAS</option>
            <option>ROLLO</option>
          </select>   
        </div>
        </div>
        
      <div class="form-group">
        <label for="precio" class="col-sm-3 control-label">Clase</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="clase" name="clased" placeholder="Clase del producto" onclick="clases();" required maxlength="8">
        </div>
      </div>
      
      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Grupo</label>
        <div class="col-sm-8">
          <input type="text" min="0" class="form-control" id="grupo" name="grupod" onclick="grupos();" placeholder="Grupo inicial" required  maxlength="8">
        </div>
      </div>
      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Linea</label>
        <div class="col-sm-8">
          <input type="text" min="0" class="form-control" id="linea" name="linead" onclick="inv_lineas();"  placeholder="Linea inicial" required  maxlength="8">
        </div>
      </div>

       <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Sistema</label>
        <div class="col-sm-8">
          <input type="text" min="0" class="form-control" id="sistema1" name="sistema" onclick="inv_sistema();"  placeholder="Sistema de producto" required  maxlength="8">
        </div>
      </div>

       <input type="hidden" class="form-control" id="userd" name="userd"  value="<?php echo $_SESSION['k_username'];?>">
      
        <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Subir imagen</label>
        <div class="col-sm-8">
          <input id="file_to_upload" type="file" class="form-control" />
        </div>
      </div>

      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">imagen producto</label>
        <div class="col-sm-8">
          <div id="img_pro">
            
          </div>
        </div>
      </div>

      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-danger" id="editar_datos">Editar datos</button>
      </div>

    </div>
    </div>
  </div>
  <!-- FIN EDITAR DATOS MODAL -->
  <div class="modal fade" id="nuevoProducto2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar producto(SubFamilia)</h4>
      </div>
      <div class="modal-body">
   
      <div id="resultados_ajax_productos"></div>
        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Codigo(adicional)</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="codx" name="codx" placeholder="Codigo adicional de producto" required maxlength="255" ></input>
          
        </div>
        </div>
        <div class="form-group">
        <label for="codigo" class="col-sm-3 control-label">Referencia</label>
        <div class="col-sm-8">
          <input type="text" class="auto" id="refx" name="refx" placeholder="Referencia del producto" required>
        </div>
        </div>
      
      

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Descripcion</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nomx" name="nomx" placeholder="Codigo adicional de producto" required maxlength="255" ></input>
          
        </div>
        </div>
      
       <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Clase</label>
        <div class="col-sm-8">
            <select id="clas_n" class="col-sm-5">
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
        <label for="nombre" class="col-sm-3 control-label">Grupo</label>
        <div class="col-sm-8">
            <select id="gru_n" class="col-sm-5">
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
        <label for="nombre" class="col-sm-3 control-label">Tipo Articulo:</label>
        <div class="col-sm-8">
        <select id="artx" name="artx">
          <option> </option>
          <option value="FLOTANTE">FLOTANTE</option>
          <option value="INVENTARIO">INVENTARIO</option>
        </select>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Color</label>
        <div class="col-sm-8">
          <input type="text" class="auto2" id="colx" name="colx" placeholder="Digite Color" required></input>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Ancho</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="anchox" name="anchox" placeholder="Digite Ancho" required></input>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Alto</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="altox" name="altox" placeholder="Digite ALto" required></input>
          
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Espesor</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="espx" name="espx" placeholder="Digite Espesor" required></input>
          
        </div>
        </div>

         <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Area</label>
        <div class="col-sm-8">
          <input type="number" class="form-control" id="arex" name="arex" placeholder="Digite Area" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Peso</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="pesx" name="pesx" placeholder="Digite Peso" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Stock Maximo</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="stc_maxx" name="stc_maxx" placeholder="Digite Stock Maximo" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Stock Minimo</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="stc_minx" name="stc_minx" placeholder="Digite Stock Minimo" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Stock Seguridad</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="stc_segx" name="stc_segx" placeholder="Digite Stock Seguridad" required></input>
        </div>
        </div>

         <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Costo Promedio</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="cosp" name="cosp" placeholder="Costo Promedio" required></input>
        </div>
        </div>

        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Observaciones</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="obsx" name="obsx" placeholder="Obervaciones..." required></input>
        </div>
        </div>

       <input type="hidden" class="form-control" id="userx" name="userx"  value="<?php echo $_SESSION['k_username'];?>">
       <input type="hidden" class="form-control" id="empresax" name="empresax"  value="<?php echo $_SESSION['empresa'];?>">
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="guardar_datos2">Guardar datos</button>
      </div>

    </div>
    </div>
  </div>
  <!-- FIN MODAL PARA SubFamilia -->

  <!--  INSERTAR PRODUCTO  -->
   <div class="modal fade" id="nuevoProductox" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Registro Nueva Referencia</h4>
      </div>
      <div class="modal-body">
     
      <div id="resultados_ajax_productos"></div>
      
       <div class="row">
          <div class="col-x5-6">
              <label for="nombre" class="col-sm-3 control-label">Codigo(adicional) <button onclick="bus_cod_fom()">Fom</button></label>
            <input type="text" class="col-sm-3" onchange="buscar_cod();" id="codxa" name="codxa" placeholder="Codigo adicional de producto" required maxlength="255" >
          </div>
                  
          <div class="col-x5-6">
              <label for="nombre" class="col-sm-1 control-label">Referencia</label> 
            &nbsp;&nbsp;&nbsp;&nbsp; <input type="text" class="col-sm-3" id="refxa" name="refx" placeholder="Referencia del producto" required>
          </div>
       </div> 
     
        
      <br>
      
      
      
        <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Descripcion</label>
            <input type="text" class="col-sm-3" id="nomxa" name="codxa" placeholder="Codigo adicional de producto" required maxlength="255" >
          </div>
                  
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-1 control-label">Clase</label> 
                 <select id="cla_xa" class="col-sm-3">
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
      
      <br>
      
        <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Grupo</label>
                <select id="gru_xa" class="col-sm-3">
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
                  
          <div class="col-x5-6">
             <label nowrap for="nombre" class="col-sm-1 control-label">Articulo</label> 
              <select id="artxa" name="artxa" class="col-sm-3">
          <option> </option>
          <option value="FLOTANTE">FLOTANTE</option>
          <option value="INVENTARIO">INVENTARIO</option>
        </select>
          </div>
       </div> 
      
      <br>
        <div class="row">
        <label for="nombre" class="col-sm-3 control-label">Iva</label>
        <div class="col-sm-7">
        <select id="iva_xa" class="col-sm-2">
            <option value="">?</option>
          <option value="true">SI</option>
          <option value="false">NO</option>
        </select> 
        <label for="nombre" class="col-sm-1 control-label"><b>%</b></label> 
        <input type="text" id="poriva_xa" placeholder="porcentaje" required maxlength="255" class="col-sm-2">
          
        </div>
        </div> 
      <br>
      
       <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Unidad de medida</label>
                <select id="und_xa" class="col-sm-3">
                          <option value="">Seleccione</option>
                           <?php
                                $consulta= "SELECT * FROM `umb`";                     
                                $result=  mysqli_query($con,$consulta);
                                while($fila=mysqli_fetch_array($result)){
                                $valor1=$fila['unidad'];
                                $valor2=$fila['descripcion'];
                               echo"<option value='".$valor1."'>".$valor2."</option>";
                             }
                    ?>
	     </select>
          </div>
       </div>
      
      <br>
        <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Color</label>
            <input type="text" class="col-sm-3" id="colxa" name="codxa" placeholder="" required maxlength="255" >
          </div>   
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-1 control-label">Ancho</label> 
             <input type="text" class="col-sm-3" id="anchoxa" name="refx" placeholder="" required>
          </div>
       </div> 
      <br>
         <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Alto</label>
            <input type="text" class="col-sm-3" id="altoxa" name="codxa" placeholder="" required maxlength="255" >
          </div> 
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-1 control-label">Espesor</label> 
             <input type="text" class="col-sm-3" id="espxa" name="refx" placeholder="" required>
          </div>
       </div> 
      
      <br>
          <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Area</label>
            <input type="text" class="col-sm-3" id="arexa" name="codxa" placeholder="area" required maxlength="255" >
          </div>     
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-1 control-label">Peso</label> 
             <input type="text" class="col-sm-3" id="pesxa" name="refx" placeholder="peso" required>
          </div>
       </div> 
      <br>
       <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Stock Maximo</label>
            <input type="text" class="col-sm-3" id="stc_max" name="codxa" placeholder="stock maximo" required maxlength="255" >
          </div>   
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-1 control-label">Minimo</label> 
             <input type="text" class="col-sm-3" id="stc_min" name="refx" placeholder="stock minimino" required>
          </div>
       </div> 
      <br>
        <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Stock Seguridad</label>
            <input type="text" class="col-sm-3" id="stc_seg" placeholder="stock seguridad" required maxlength="255" >
          </div>     
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-1 control-label">Promedio</label> 
             <input type="text" class="col-sm-3" id="cospa" placeholder="promedio" required>
          </div>
       </div> 
      <br>
      
             <div class="row">
          <div class="col-x5-6">
             <label for="nombre" class="col-sm-3 control-label">Observaciones</label>
             <textarea class="col-sm-7" id="obsxa" name="obsxa" placeholder="Obervaciones..." required /></textarea>
          </div>     
     
       </div> 
      
      

       <input type="hidden" class="form-control" id="userxa" name="userxa"  value="<?php echo $_SESSION['k_username'];?>">
       <input type="hidden" class="form-control" id="empresaxa" name="empresaxa"  value="<?php echo $_SESSION['empresa'];?>">
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="guardar_datosxa">Guardar datos</button>
      </div>

    </div>
    </div>
  </div>



  <!-- INICIO MODAL PARA EDITAR SubFamilia -->
  <div class="modal fade" id="editarProducto2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar Referencia</h4>
      </div>
      <div class="modal-body">
        
              
     
      <div id="resultados_ajax_productos"></div>
      
          <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Referencia</label>
            <input type="text" class="col-sm-3"  id="refxd" name="refx" placeholder="Referencia del producto" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Codigo(adicional)</label> 
             <input type="text" class="col-sm-3" id="codxd" name="codx" placeholder="Codigo adicional de producto" required maxlength="255" ></input>
           <input type="hidden" class="col-sm-3" id="subx">
          </div>
       </div> 
      <br>
          <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Descripcion</label>
            <input type="text" class="col-sm-3"  id="nomxd" name="nomx" placeholder="" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Clase</label> 
             <select id="cla_xd" class="col-sm-3">
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
       
      
      <br>
      
      
      
      
         <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Grupo</label>
           <select id="gru_xd" class="col-sm-3">
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
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Articulo:</label> 
             <select id="artxd" name="artx" class="col-sm-3">
          <option> </option>
          <option value="FLOTANTE">FLOTANTE</option>
          <option value="INVENTARIO">INVENTARIO</option>
        </select>
          </div>
       </div> 
       
      <br>
 
      
          
                <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Iva</label>
             <select id="iv_xd" class="col-sm-3">
            <option>?</option>
          <option value="SI">SI</option>
          <option value="NO">NO</option>
        </select> 
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">%</label> 
               <input type="text" id="poriv_xd" placeholder="porcentaje" required class="col-sm-3">
          </div>
       </div> 
     
      
      <br>
      
     <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Color</label>
            <input type="text" class="col-sm-3"  id="colxd" name="nomx" placeholder="" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label"></label> 
               <button onclick="ver_colores()">Mas colores </button>
          </div>
       </div> 
      <br>
      
      
         <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Ancho</label>
            <input type="text" class="col-sm-3"  id="anchoxd"  placeholder="" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Alto</label> 
              <input type="text" class="col-sm-3"  id="altoxd" placeholder="" required maxlength="255" >
          </div>
       </div> 
      <br>
        
        <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Espesor</label>
            <input type="text" class="col-sm-3"  id="espxd"  placeholder="" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Area</label> 
              <input type="text" class="col-sm-3"  id="arexd" placeholder="" required maxlength="255" >
          </div>
       </div> 
    
      <br>
      
        <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Peso</label>
            <input type="text" class="col-sm-3"  id="pesxd"  placeholder="" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Stock maximo</label> 
              <input type="text" class="col-sm-3"  id="stc_maxxd" placeholder="" required maxlength="255" >
          </div>
       </div> 
      
      <br>
      
         <div class="row">
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-3 control-label">Stock minimo</label>
            <input type="text" class="col-sm-3"  id="stc_minxd"  placeholder="" required maxlength="255" >
          </div>     
          <div class="col-x5-8">
             <label for="nombre" class="col-sm-1 control-label">Stock seguridad</label> 
              <input type="text" class="col-sm-3"  id="stc_segxd" placeholder="" required maxlength="255" >
          </div>
       </div> 

      <br>

        <div class="row">
        <label for="nombre" class="col-sm-3 control-label">Costo Promedio</label>
        <div class="col-sm-8">
          <input type="text" class="col-sm-3"  id="cospxd" name="cospxd" placeholder="Costo Promedio" required></input>
        </div>
        </div>
      <br>
        <div class="row">
        <label for="nombre" class="col-sm-3 control-label">Observaciones</label>
        <div class="col-sm-8">
          <input type="text"class="col-sm-6"  id="obsxd" name="obsx" placeholder="Obervaciones..." required></input>
        </div>
        </div>
      <br>

       <input type="hidden" class="form-control" id="userxd" name="userx"  value="<?php echo $_SESSION['k_username'];?>">
       <input type="hidden" class="form-control" id="empresaxd" name="empresax"  value="<?php echo $_SESSION['empresa'];?>">
      
      
            </div>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="editar_datos2">Guardar datos</button>
      </div>

    </div>
    </div>
  </div>

  <!-- FIN MODAL PARA EDITAR SubFamilia-->
  <!-- INICIO MODAL PARA ADD PRODUCTOS -->
  <div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar producto</h4>
      </div>
      <div class="modal-body">
     
      <div id="resultados_ajax_productos"></div>
        <div class="form-group">
        <label for="codigo" class="col-sm-3 control-label">Referencia</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="ref" name="ref" placeholder="Código del producto" required>
        </div>
        </div>
      
         <div class="form-group">
        <label for="codigo" class="col-sm-3 control-label">Nombre</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
        </div>
        </div>
        
      
        
        <div class="form-group">
        <label for="color" class="col-sm-3 control-label">Und medida</label>
        <div class="col-sm-8">
          <select name="und" id="und">
            <option> </option>
            <option>UND</option>
            <option>MT</option>
            <option>MT2</option>
            <option>KG</option>
            <option>METROS LINEALES</option>
            <option>LIBRAS</option>
            <option>ROLLO</option>
          </select>   
        </div>
        </div>
        
      <div class="form-group">
        <label for="precio" class="col-sm-3 control-label">Clase</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="clase1" name="clase" placeholder="Clase del producto" onclick="clases();" required maxlength="8">
        </div>
      </div>
      
      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Grupo</label>
        <div class="col-sm-8">
          <input type="text" min="0" class="form-control" id="grupo1" name="grupo" onclick="grupos();" placeholder="Grupo inicial" required  maxlength="8">
        </div>
      </div>
      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Linea</label>
        <div class="col-sm-8">
          <input type="text" min="0" class="form-control" id="linea1" name="linea" onclick="inv_lineas();"  placeholder="Linea inicial" required  maxlength="8">
        </div>
      </div>

      <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Sistema</label>
        <div class="col-sm-8">
          <input type="text" min="0" class="form-control" id="sistema" name="sistema" onclick="inv_sistema();"  placeholder="Sistema de producto" required  maxlength="8">
        </div>
      </div>

       <input type="hidden" class="form-control" id="user" name="user"  value="<?php echo $_SESSION['k_username'];?>">

        <div class="form-group">
        <label for="stock" class="col-sm-3 control-label">Subir imagen</label>
        <div class="col-sm-8">
          <input id="file_to_upload2" type="file" class="form-control" />
        </div>
      </div>
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
      </div>

    </div>
    </div>
  </div>

  <!-- INICIO MODAL PARA LA CREACION DE DADOS-->
    <div class="modal fade" id="guadardado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar dados de proveedores</h4>
      </div>
      <div class="modal-body">
      <div class="form-horizontal">
      <div id="resultados_ajax_productos"></div>
        <div class="form-group">
        <label for="codigo" class="col-sm-3 control-label">Referencia Producto</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="refdado" name="refdado" placeholder="Código del producto" readOnly required>
        </div>
        </div>
        <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Proveedor</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="nombrepro" name="nombrepro" placeholder="Seleccione Proveedor" onclick="terceros();" required maxlength="255" ></input>
          <input type="hidden" id="nterc" name="nterc">
        </div>
        </div>
	 <div class="form-group">
        <label for="nombre" class="col-sm-3 control-label">Dado</label>
        <div class="col-sm-8">
          <input type="text" class="form-control" id="valord" name="valord" placeholder="Nombre del producto" required maxlength="255" ></input>
        </div>
        </div>
        <table class="table table-hover">
	<tr class="bg-info">
            <th>REFERENCIA(PRO)</th> 
            <th>PROVEEDOR</th>
            <th>DADO</th>
            <th>ELIMINAR</th>
        </tr>
           <tbody id="mostrar_dados"></tbody>
        </table>
      
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      <button type="submit" class="btn btn-danger" id="guardar_dado">Guardar datos</button>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- FIN DE MODAL PARA LA CREACION DE DADOS -->
<script type="text/javascript">
  function subirArchivo(ref)
    {
      if($("#file_to_upload").val() != "")
      {
        var file_data = $('#file_to_upload').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
          url: '../vistas/inventario/referencias/subirArchivo.php', // apuntamos a script PHP del lado del servidor
          dataType: 'text', // lo que esperamos del script PHP, si hay algo
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
            savename(ref,document.getElementById('file_to_upload').files[0].name);
            // obtener respuesta del servidor aquí
            alert(data);
            $("#file_to_upload").val("");
            $('#nuevoProducto').modal('hide');
            $('#EditarProducto').modal('hide');
            // limpiamos el campo de archivo
          }
        });
      }
      else
      {
        alert("Por favor seleccione el archivo!");
      }
}

function savename(ref,name) {
  $.post("../vistas/inventario/referencias/actuliza_img.php", {"prod":"1","ref":ref,"ruta":name}, function(data){
          if(data.sucess==1){
            alert('Base de datos fue actualizada con ultimos cambios!');
          }
          else{
            alert('Error al intentar guardar imagen!');
          }
      },"json");
}

  function agregapro() {
    document.getElementById('ref').value='';
    document.getElementById('nombre').value='';
    document.getElementById('und').value='';
    document.getElementById('clase').value='';
    document.getElementById('grupo').value='';
    document.getElementById('linea1').value='';
    document.getElementById('sistema').value='';
    $("#nuevoProducto").modal();
}
  function clases(){
      window.open("../vistas/inventario/popup/clases/clases.php", "Seleccionar Clase","width=500px , height=300px");
  }
   function terceros(){
      window.open("../vistas/inventario/popup/terceros/tercero.php", "Seleccionar Tercero","width=500px , height=300px");
  }
  function grupos(){
      window.open("../vistas/inventario/popup/grupos/grupo.php", "Seleccionar Grupo","width=500px , height=300px");
  }
  function inv_lineas(){
      window.open("../vistas/inventario/popup/lineas/linea.php", "Seleccionar Linea","width=500px , height=300px");
  }
function inv_sistema(){
  window.open("../vistas/inventario/popup/sistemas/sistema.php", "Seleccionar Sistema","width=500px , height=300px");
}

$(document).ready(function(){
    $("#guardar_datos").click(function(){
      $.post("../vistas/inventario/referencias/guardapro.php", {"salvar":"1","ref":$("#ref").val(),"nom":$("#nombre").val(),"und":$("#und").val(),"clas":$("#clase1").val(),"grup":$("#grupo1").val(),"lin":$("#linea1").val(),"user":$("#user").val(),"sistema":$("#sistema").val()}, function(data){
          if(data.sucess==1){
            var ref=$("#ref").val();
            mostrar_line(1);
            subirArchivo2(ref);
          }
          else{
            alert('Error al intentar Guardar el producto!');
          }
      },"json");
    })
  });

$(document).ready(function(){
    $("#editar_datos").click(function(){
      $.post("../vistas/inventario/referencias/guardapro.php", {"editar":"1","ref":$("#refd").val(),"nom":$("#nombred").val(),"und":$("#undd").val(),"clas":$("#clase").val(),"grup":$("#grupo").val(),"lin":$("#linea").val(),"user":$("#userd").val(),"sistema":$("#sistema1").val()}, function(data){
          if(data.sucess==1){
            var ref=$("#refd").val();
            mostrar_line(1);
            subirArchivo(ref);
          }
          else{
            alert('Error al intentar Guardar el producto!');
          }
      },"json");
    })
  });


   $(document).ready(function(){
    $("#guardar_dado").click(function(){
		var id=document.getElementById('refdado').value;
      $.post("../vistas/inventario/referencias/guardapro.php", {"dado":"1","ref":$("#refdado").val(),"prove":$("#nombrepro").val(),"valor":$("#valord").val()}, function(data){
          if(data.sucess==1){
            actualiza_dados(id);
          }
          else{
            alert('Error al intentar Guardar el dado!');
          }
      },"json");
    })
  });


  $(document).ready(function(){
    $("#editar_datos2").click(function(){
       $.post("../vistas/inventario/referencias/guardapro2.php", 
       {
           "sub":$("#subx").val(),
           "ref":$("#refxd").val(),
           "cod":$("#codxd").val(),
           "des":$("#nomxd").val(),
           "clas":$("#cla_xd").val(),
           "grup":$("#gru_xd").val(),
           "ivae":$("#iv_xd").val(),
           "poriv":$("#poriv_xd").val(),
           "tip":$("#artxd").val(),
           "col":$("#colxd").val(),
           "anc":$("#anchoxd").val(),
           "alt":$("#altoxd").val(),
           "esp":$("#espxd").val(),
           "are":$("#arexd").val(),
           "pes":$("#pesxd").val(),
           "obs":$("#obsxd").val(),
           "costo":$("#cospxd").val(),
          
           "stc_max":$("#stc_maxxd").val(),
           "stc_min":$("#stc_minxd").val(),
           "stc_seg":$("#stc_segxd").val()},
       function(data){
          if(data.sucess===1){
            mostrar_line2(1);
             $('#editarProducto2').modal('hide');
          }
          else{
            alert('Error al intentar Editar!');
          }
      },"json");
    })
  });

   function agregapro2() {
    document.getElementById('refxa').value='';
    document.getElementById('nomxa').value='';
    document.getElementById('codxd').value='';
    document.getElementById('colxa').value='';
    document.getElementById('anchoxa').value='';
    document.getElementById('altoxa').value='';
    document.getElementById('espxa').value='';
    document.getElementById('arexa').value='';
    document.getElementById('pesxa').value='';
    document.getElementById('obsxa').value='';
    document.getElementById("refxa").readOnly = false;
    $("#nuevoProductox").modal();
    
}

function agregapro21(refv) {
    document.getElementById('refx').value=refv;
	document.getElementById('codx').value=refv;
    document.getElementById("refx").readOnly = true;
    $("#nuevoProducto2").modal();
}

function dado(id){
	 document.getElementById('refdado').value=id;
	 document.getElementById('nombrepro').value='';
	 document.getElementById('valord').value='';
	 $("#mostrar_dados").html(actualiza_dados(id));
	 $("#guadardado").modal();
}


function editar_lin(id) {
    document.getElementById('refd').value=id;
    document.getElementById('nombred').value='';
    document.getElementById('undd').value='';
    document.getElementById('clase').value='';
    document.getElementById('grupo').value='';
    document.getElementById('linea').value='';
    document.getElementById('sistema1').value='';
	$.post("../vistas/inventario/referencias/search.php", {"ref":id,"nom":$("#nombred").val(),"und":$("#undd").val(),"clas":$("#clase").val(),"grup":$("#grupo").val(),"lin":$("#linea").val(),"user":$("#userd").val()}, function(data){
           if(data.sucess==1){
             if(data.nom)
      			 $("#nombred").val(data.nom);
      		   else
      			 $("#nombred").val("error");
      		   if(data.und)
      			 $("#undd").val(data.und);
      		   else
      			 $("#undd").val("error");
      		   if(data.clas)
      			 $("#clase").val(data.clas);
      		   else
      			 $("#clase").val("error");
      		   if(data.grup)
      			 $("#grupo").val(data.grup);
      		   else
      			 $("#grupo").val("error");
      		    if(data.lin)
      			 $("#linea").val(data.lin);
      		   else
      			 $("#linea").val("error");
             if(data.sistema)
             $("#sistema1").val(data.sistema);
             else
             $("#sistema1").val("error");
      			 if(data.ruta)
             document.getElementById('img_pro').innerHTML='<img src="../vistas/inventario/product_images/'+data.ruta+'" alt="Imagen de Producto" width="228">';
             else
             document.getElementById('img_pro').innerHTML='Error';	   
          }
          else{
		  alert('error');
          }
      },"json");
    $("#EditarProducto").modal();
}

function subirArchivo2(ref)
    {

      if($("#file_to_upload2").val() != "")
      {
        var file_data = $('#file_to_upload2').prop('files')[0];
        var form_data = new FormData();
        form_data.append('file', file_data);
        $.ajax({
          url: '../vistas/inventario/referencias/subirArchivo.php', // apuntamos a script PHP del lado del servidor
          dataType: 'text', // lo que esperamos del script PHP, si hay algo
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          type: 'post',
          success: function(data){
            savename(ref,document.getElementById('file_to_upload2').files[0].name);
            // obtener respuesta del servidor aquí
            alert(data);
            $("#file_to_upload2").val("");
            $('#nuevoProducto').modal('hide');
            $('#EditarProducto').modal('hide');
            // limpiamos el campo de archivo
            
          }
        });
      }
      else
      {
        alert("Por favor seleccione el archivo!");
      }
}

function editar_lin22(id) {

    document.getElementById('codxa').value=id;
    buscar_cod();
    $("#nuevoProductox").modal();
}


$(function() {
    $(".auto").autocomplete({
        source: "../vistas/inventario/referencias/search.php",
        minLength: 1
    });                

});
	$(document).ready(function(){
		$( "#refx" ).change(function() {
			 var x=document.getElementById('refx').value;
			document.getElementById('codx').value=x;
		});
	 });
$(function() {
    $(".auto2").autocomplete({
        source: "../vistas/inventario/referencias/color.php",
        minLength: 1
    });                

});

$(document).ready(function(){
    $("#guardar_datos2").click(function(){
      $.post("../vistas/inventario/referencias/guardapro2.php", {
          "refx":$("#refx").val(),
          "nomx":$("#nomx").val(),
          "codx":$("#codx").val(),
          "colx":$("#colx").val(),
          "anchox":$("#anchox").val(),
          "altox":$("#altox").val(),
          "espx":$("#espx").val(),
          "arex":$("#arex").val(),
          "pesx":$("#pesx").val(),
          "obsx":$("#obsx").val(),
          "artx":$("#artx").val(),
          "userx":$("#userx").val(),
          "empresax":$("#empresax").val(),
          "stc_max":$("#stc_maxx").val(),
          "stc_min":$("#stc_minx").val(),
          "stc_seg":$("#stc_segx").val()},
      function(data){
          if(data.sucess===1){
            mostrar_line2(1);
            $('#nuevoProducto2').modal('hide');
            
          }
          else{
            alert('Error al intentar Guardar el producto!');
          }
      },"json");
    })
  });

$(document).ready(function(){
    $("#guardar_datosxa").click(function(){
      $.post("../vistas/inventario/referencias/guardapro2.php",
      {
          "refx":$("#refxa").val(),
          "nomx":$("#nomxa").val(),
          "clax":$("#cla_xa").val(),
          "grux":$("#gru_xa").val(),
          "ivax":$("#iva_xa").val(),
          "porivx":$("#poriva_xa").val(),
          "codx":$("#codxa").val(),
          "colx":$("#colxa").val(),
          "anchox":$("#anchoxa").val(),
          "altox":$("#altoxa").val(),
          "espx":$("#espxa").val(),
          "arex":$("#arexa").val(),
          "pesx":$("#pesxa").val(),
          "obsx":$("#obsxa").val(),
          "artx":$("#artxa").val(),
          "userx":$("#userxa").val(),
          "empresax":$("#empresaxa").val(),
          "stc_max":$("#stc_max").val(),
          "stc_min":$("#stc_min").val(),
          "stc_seg":$("#stc_seg").val(), 
          "und_x":$("#und_xa").val(),
          "costo":$("#cospa").val()},
      
      function(data){
          if(data.sucess==1){
              alert("Se guardo con exito "+data.result);
            mostrar_line2(1);
            $('#nuevoProductox').modal('hide');
          }
          else{
            alert('Error Data: '+ data.result);
          }
      },"json");
    })
  });


</script>
     

      





