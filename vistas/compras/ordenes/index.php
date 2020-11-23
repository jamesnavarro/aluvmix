<?php
 session_start();
  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>

<script src="../vistas/compras/ordenes/funciones.js?<?php echo rand(100,200) ?>"></script>

<div class="panel panel-info">
		
		<div class="panel-body">
                          <!-- CONTENIDO DENTRO DE TABINDEX -->
                          <table class="table table-hover" style="width: 97%">
                                <tr class="bg-info">
					<th>No. ORDEN</th>
					<th>No. SOLICITUD</th>
                                                                                                    <th>No. FOM</th>
					<th>NIT</th>
					<th>PROVEEDOR</th>
					<th>FECHA</th>
					<th>ESTADO</th>
					<th>USUARIO</th>
                                                                                                    <th>CORREO</th>
					<th>OPCIONES</th>
                                </tr>
                                  <tr>
                                      <td><input type="text" id="cod" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="text" id="des" class="col-xs-10 col-sm-12"/></td> 
                                      <td><input type="text" id="fom" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="text" id="nit" class="col-xs-10 col-sm-12"/></td> 
                                      <td><input type="text" id="provee" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="date" id="fec" class="col-xs-10 col-sm-12"/></td>
                                      <td>
                                       <select id="est" class="form-control">
                                                 <option value="">Todos</option>
                                                <option value="Completada">Completada</option>
                                                <option value="En Proceso">En Proceso</option> 
                                                <option value="Anulado">Anulado</option>

                                       </select>
                                      </td>
                                       
                                       <td><input type="text" id="usu" class="col-xs-10 col-sm-12"/></td>
                                       <td><input type="text" id="autoriza"  placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
                                       <td><input type="text" id="autoriza"  placeholder="" class="col-xs-10 col-sm-12" disabled/></td> 
                                  </tr>
                               <tbody id="mostrar_tabla">
                               </tbody>
                            </table>
                          <!-- FIN DE CONTENIDO -->   
		</div>
</div>
	<!-- Modal -->
	<div class="modal fade" id="DetalleOrden" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Detalle de la orden | <span id="enca"></span></h4>
		  </div>
                    <div class="modal-body" id="DatosOrden">
			<table class="table table-hover">
                                <tr class="bg-info">
                                      <th>CODIGO</th> 
                                      <th>REFERENCIA</th> 
                                      <th>DESCRIPCION</th>   
                                      <th>COLOR</th>
                                      <th>MEDIDA</th>
                                      <th>CANT</th>
                                      <th>UND</th>
                  	                  <th>PRECIO UND</th>
                                      <th>TOTAL</th>
                                      <th>BORRAR</th>
                                </tr>
                               <tbody id="mostrar_tabla_products">
                               </tbody>
                            </table>
			 
			 
			
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>		
		  </div>
		  </form>
		</div>
	  </div>
	</div>

<script>
	function agregapro() {
		$("#nuevoProducto").modal();
}
</script>