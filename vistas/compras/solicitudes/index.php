<?php
include '../../../modelo/conexioni.php';
 session_start();
  if(!isset($_SESSION['k_username']))
      { 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>
<script src="../vistas/compras/solicitudes/funciones.js?<?php echo rand(1,1000) ?>"></script>
<div class="panel panel-info"> 
    
		<div class="panel-heading" id="infos"> 
                    <div class="btn-group pull-left">
       
    </div>
<div class="btn-group pull-right">
	<button type="button" class="btn btn-success" onclick="agregapro();"><span class="glyphicon glyphicon-plus"></span> Agregar Producto</button>
</div>
	<h4><i class="glyphicon glyphicon-check"></i> 
           <button class="btn-primary" onclick="tutoria('manual.pdf')">Ayuda</button>
        </h4>
</div>
	<div class="panel-body">
		   <br><br>
                          <!-- CONTENIDO DENTRO DE TABINDEX -->
                             <table class="table table-hover">
                                <tr class="bg-info">
                                    <th>CODIGO</th> 
                                    <th>DESCRIPCION</th>
                                    <th>MEDIDA</th>
                                    <th>COLOR</th>
                                    <th>CANT</th>
                                    <th>Vlr Und</th>
                                    <th>TOTAL</th>
			            <th>OBSERVACIONES</th>
                                    <TH>OPCIONES</TH>  
                                </tr>
                                  <tbody id="mostrar_tabla">
                                  </tbody>
                             </table>
        <!-- FIN DE CONTENIDO -->
</div>
</div>
	<!-- MODAL PARA AGREGAR PRODUCTOS -->
	<div class="modal fade" id="nuevoProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
                              <label for="codigo" class="col-sm-3 control-label"><b>Codigo</b>&nbsp;&nbsp;<img src="../imagenes/zoom.png" width="20px" onclick="agregap();" /></label>
				<div class="col-sm-8">
                                    <input type="text" class="form-control" id="codigo" name="codigo" onchange="buscarcod()" placeholder="Codigo del producto" required>
				</div>
			  </div> 
			  <div class="form-group">
                              <label for="nombre" class="col-sm-3 control-label"><b>Nombre</b></label>
				<div class="col-sm-8">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto">
				</div>
			  </div> 
			  
			  <div class="form-group">
                              <label for="color" class="col-sm-3 control-label"><b>Color</b></label>
				<div class="col-sm-8">
					
                                        <select id="color" class="form-control">
                                            <option value="">Seleccione</option>
                                            <?php
                                            $resu = mysqli_query($con,"select * from colores");
                                            while($r = mysqli_fetch_array($resu)){
                                            echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                            }
                                            ?>
                                        </select>
				</div>
			  </div>

			  <div class="form-group">
                              <label for="color" class="col-sm-3 control-label"><b>Medidas</b></label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="medidas" name="medidas" placeholder="Medidas del producto"  required>		  
				</div>
			  </div>

                        
                        
                         <div class="form-group">
                             <label for="stock" class="col-sm-3 control-label"><b>Unid med</b></label>
				<div class="col-sm-8">
					
                                            <select id="med" class="form-control">
                                                <option value="Und">Und</option>
                                                <option value="Mts">Mts</option>
                                                <option value="Kg">Kg</option>
                                                <option value="M2">M2</option>
                                                <option value="Cm">Cm</option>
                                                <option value="Gl">Gl</option>
                                                <option value="Ml">Ml</option>
                                                <option value="Kl">Kl</option>
                                            </select>		  
				</div>
			  </div>
		
                        
                             <div class="form-group">
                              <label for="stock" class="col-sm-3 control-label"><b>IVA</b></label>
				<div class="col-sm-8">
                                            
                                            <select id="iva" class="form-control">
                                                <option value="true">19</option>
                                                <option value="false">0</option>
                                            </select>
					</div>
			  </div>
                       
                    
<!--                        
                        	  <div class="form-group">
                              <div class="col-sm-12">
					<div class="col-sm-4">
                                            <label for="stock" class="col-sm-3 control-label"><b>Precio</b></label>
                                          <input type="text" min="0" class="form-control" id="precio" name="precio" placeholder="Precio Producto" required>
                                        </div>
					<div class="col-sm-3">
                                            <label for="stock" class="col-sm-3 control-label"><b>Cantidad</b></label>
					  <input type="text" min="0" class="form-control" id="stock" name="stock" placeholder="Cantidad inicial" required >
					</div>
                                  <div class="col-sm-5">
                                            <label for="stock" class="col-sm-6 control-label"><b>Vlr Total</b></label>
					    <input type="number" min="0" class="form-control" id="tot" name="tot" disabled>
					</div>
                                        
                               </div>
			  </div>-->
                
                          <center>
                          <table style="width: 65%">
                            <tr class="bg-info">
                                <td nowrap>
                                   <label><b>Precio</b></label>
                                          <input type="text" min="0" class="form-control" id="precio" name="precio" placeholder="Precio Producto" required> 
                                </td>
                                 <td nowrap>
                                    <label><b>Cantidad</b></label>
					  <input type="text" min="0" class="form-control" id="stock" name="stock" placeholder="Cantidad inicial" required >
                                </td>
                                <td nowrap>
                                    <label><b>Vlr Total</b></label>
					<input type="number" min="0" class="form-control" id="tot" name="tot" disabled>
                                </td>
                            </tr>
                          
                        </table>
                          </center>
                        
<br>
         
                          <div class="form-group">
                              <label for="stock" class="col-sm-3 control-label"><b>Notas</b>:</label>
					<div class="col-sm-8">
                                            <textarea id="obs_sol" class="form-control" ></textarea> 
					</div>
			  </div>

		  </div>
		  <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="entrega()">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_solicitud_c">Guardar Producto</button>
		  </div>
		  </form>
                    
                  
                  </div>
	  </div>
	</div>
	<!-- FIN CREACION DE PRODUCTOS -->

	<!-- DUPLICADO DE MODAL PARA LA EDICION -->
	<div class="modal fade" id="editarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Agregar producto</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editaroProducto" name="editaroProducto">
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-3 control-label">Codigo</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="codigod" name="codigo" placeholder="Codigo del producto" onclick="agregap();" required>
				   <input type="hidden" id="edita" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="nombre" class="col-sm-3 control-label">Nombre</label>
				<div class="col-sm-8">
				<input type="text" class="form-control" id="nombred" name="nombre" placeholder="Nombre del producto" readonly required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="color" class="col-sm-3 control-label">Color</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="colord" name="color" placeholder="Color del Producto" >		  
				</div>
			  </div>

			  <div class="form-group">
				<label for="color" class="col-sm-3 control-label">Medidas</label>
				<div class="col-sm-8">
					<input type="text" class="form-control" id="medidasd" name="medidas" placeholder="Medidas del producto" readonly required>		  
				</div>
			  </div>

			  <div class="form-group">
				<label for="stock" class="col-sm-3 control-label">Precio</label>
				<div class="col-sm-8">
				  <input type="text" min="0" class="form-control" id="preciod" name="preciod" placeholder="Precio Producto" required>
				</div>
			  </div>
			
			<div class="form-group">
				<label for="stock" class="col-sm-3 control-label">Cantidad</label>
				<div class="col-sm-8">
				  <input type="text" min="0" class="form-control" id="stockd" name="stock" placeholder="Cantidad inicial" required  maxlength="8">
				</div>
			</div>
                    <div class="form-group">
					<label for="stock" class="col-sm-3 control-label">Unidad de Medida</label>
					<div class="col-sm-8">
                                            <select id="medd" class="form-control">
                                                <option value="Und">Und</option>
                                                <option value="Mts">Mts</option>
                                                <option value="Kg">Kg</option>
                                                <option value="M2">M2</option>
                                                <option value="Cm">Cm</option>
                                                <option value="Gl">Gl</option>
                                                <option value="Ml">Ml</option>
                                                <option value="Kl">Kl</option>
                                            </select>
					</div>
			 </div>
                        <div class="form-group">
                              <label for="stock" class="col-sm-3 control-label"><b>Notas</b>:</label>
					<div class="col-sm-8">
                                            <textarea id="obs_sol2" class="form-control" ></textarea>
					</div>
			 </div>
			 
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="editable">Editar Producto</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<!-- FIN DUPLICADO -->

	<!-- GUARDAR SOLICITUD DE COMPRA -->
	<div class="modal fade" id="guarda_sol" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Generar Solicitud</h4>
		  </div>
                    <div class="modal-body" id="subida">
			<form class="form-horizontal" method="post" id="guardar_producto" name="guardar_producto">
			<div id="resultados_ajax_productos"></div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Area que Solicita:</label>
				<div class="col-sm-8">
				 <select name="area" id="areax">
                                     <option value="">Seleccione</option>
                                        <?php
                                        $result = mysqli_query($con,"select * from areas ");
                                        while($r = mysqli_fetch_array($result)){
                                            echo '<option value="'.$r[1].'">'.$r[1].'</option>';
                                        }
                                        ?>
				  </select>
				</div>
			  </div>
                        <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Nota Opcional:</label>
				<div class="col-sm-8">
                                    <textarea name="notas" id="notas" class="form-control"></textarea>
				</div> 
			  </div>
			  <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Documento Relacion:</label>
				<div class="col-sm-8">
				 <select name="area" id="relax">
                                     <option value="">Seleccione</option>
				     <option value="Cot">Cotizacion</option>
                                     <option value="Ped">Pedido</option>
                                     <option value="OP">Orden de Produccion</option>
                                     <option value="OR">Orden de Reposicion</option>
                                     <option value="OD">Otro Documento</option>
				  </select> 
				</div>
			  </div>
                        <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Numero: </label>
				<div class="col-sm-8">
				   <input class="form-control" id="numero" type="text" name="numero">
				</div>
			  </div>
			  <div class="form-group">
				<label for="nombre" class="col-sm-4 control-label">Fecha Solicitada:</label>
				<div class="col-sm-8">
				<div class="input-group" style="width: 60%;margin-bottom: 2%;">
                                  <input class="form-control" id="date" type="date" name="fechasol">
                                  <span class="input-group-addon">
                                    <i class="fa fa-calendar bigger-110"></i>
                                  </span>
                                </div>
				</div>
			  </div>
                          <div class="form-group">
				<label for="nombre" class="col-sm-4 control-label">Soporte de Cotizacion:</label>
				<div class="col-sm-8">
				   <div class="input-group" style="width: 60%;margin-bottom: 2%;">
                                   <input class="form-control" id="foto" type="file" name="foto" onchange="subir(0)">
                                </div>
				</div>
			  </div>
                        <div class="form-group">
				<label for="codigo" class="col-sm-4 control-label">Generado por </label>
				<div class="col-sm-8">
				   <input class="form-control" id="generado" type="text" value="<?php echo $_SESSION['k_username'] ?>" disabled>
				</div>
			  </div>
                        <div class="form-group">
				<div class="col-sm-8">
				<div class="input-group" style="width: 60%;margin-bottom: 2%;">
                                  <input class="form-control" id="resu" type="hidden" name="resu">
                                </div>
				</div>
		        </div>
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="generar_solicitud_c">Guardar Solicitud</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<!-- FIN DE GUARDADO -->

<?php include 'scritps.php';?>