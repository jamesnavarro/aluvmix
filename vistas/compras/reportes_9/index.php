<?php
include '../../../modelo/conexioni.php';
 session_start();
  if(!isset($_SESSION['k_username']))
      { 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>
<script src="../vistas/compras/reportes_9/funciones.js?<?php echo rand(1,200) ?>"></script>
<div class="panel panel-info">
		<div class="panel-body"> 
		  
                          <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">
                                        <th>PROVEEDOR</th>
                                        <th>OBSERVACION</th>
					<th>ORDEN</th>
					
                                        <th>DESCRIPCION</th>
                                        <th>DESDE / HASTA</th>
					<th>CANT PED</th>
                                        <th>CANT REC</th>
                                        <th>FACTURA</th>
                                        <th>OPCION</th>
                                </tr>
                                 <tr>
                                      <td><input type="text" id="n_pro" placeholder="" style="width:100%"/></td>
                                      <td><input type="text" id="n_obs" placeholder="" style="width:100%"/></td> 
                                      <td><input type="text" id="n_sol" placeholder="" style="width:100%"/><input type="hidden" id="n_cod" placeholder="" value="9999" disabled style="width:50%"/></td>

                                      <td><input type="text" id="n_des" placeholder="" style="width:89%"/></td>
                                      <td><input type="date" id="n_fech" placeholder="" style="width:46%"/><b>--</b><input type="date" id="h_fech" placeholder="" style="width:46%"/></td> 
                                      
                                      <td>-</td> 
                                      <td>
                                          <select id="pen">
                                              <option value="">Todas</option>
                                          <option value="0">Pendientes</option>
                                          <option value="1">Recibidas</option>
                                          </select>
                                      </td> <td>
                                          <select id="n_fac"> 
                                          <option value="">No Facturada</option>
                                          <option value="1">Facturadas</option>
                                          </select>
                                      </td>
                                      <td><button class="btn btn-inverse" onclick="printer();" ><i class="glyphicon glyphicon-print"></i></button></td> 
                                     
                                </tr>
                               <tbody id="mostrar_tabla2">
                               </tbody>
                            </table>
                          <!-- FIN DE CONTENIDO -->   
		</div>
</div>
	
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Recibir Compra No. <input type="text" class="form-control" id="pedi"></h4>
      </div>
      <div class="modal-body">
          <div class="form-group">
            <label for="email">Factura</label>
            <input type="hidden" class="form-control" id="iddet">
            <input type="text" class="form-control" id="fac">
          </div>
          <div class="form-group">
            <label for="pwd">Cantidad Recibida</label>
            <input type="text" class="form-control" id="rec">
          </div>
          <div class="form-group">
            <label for="pwd">Observaciones</label>
           
            <textarea class="form-control" id="obs"></textarea>
          </div>
          <div class="form-group">
            <label for="pwd">Fecha Recibida</label>
            <input type="date" class="form-control" id="frec">
          </div>
          <button type="submit" class="btn btn-success" onclick="recibiradd()">Recibir</button> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>