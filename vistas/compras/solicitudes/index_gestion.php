<?php
 session_start();
  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>
<script src="../vistas/compras/solicitudes/funciones.js?<?php echo rand(1,200) ?>"></script>
<div class="panel panel-info">
		<div class="panel-body">
		  
                          <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">
                                      <th>SOLPED</th> 
                                      <th>CONSECUTIVO</th> 
                                      <th>AREA</th>
                                      <th>FECHA REGISTRO</th>
                                      <th>USUARIO</th>
                                      <th>AUTORIZA</th>
                                      <th>APROBADO POR</th>
                                      <th>ESTADO</th>
                                      <th>ORDEN COMPRA.</th>
                                </tr>
                                <tr>
                                      <td><input type="text" id="n_sol" placeholder="" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="text" id="n_con" placeholder="" class="col-xs-10 col-sm-12"/></td>
                                      <td><input type="text" id="area_s" placeholder="" class="col-xs-10 col-sm-12"/></td> 
                                      <td><input type="date" id="fec_s" placeholder="" class="col-xs-10 col-sm-12"/></td> 
                                      <td><input type="text" id="usu_s"  placeholder="" class="col-xs-10 col-sm-12"/></td> 
                                      <td></td> 
                                      <td></td>
                                      
                                      <td>
                                          <select id="est">
                                              <option value="">Todas</option>
                                              <option value="En proceso">En proceso</option>
                                              <option value="aprobado">aprobado</option>
                                              <option value="Anulado">Anulado</option>
                                          </select>
                                      </td>
                                     
                                      <td>
                                          <select id="estord">
                                              <option value="">Todas</option>
                                              <option value="1">Con Orden Compra</option>
                                              <option value="2">Sin Orden</option>
                                          </select>
                                      </td>
                                </tr>
                               <tbody id="mostrar_tabla2">
                                   
                               </tbody>
                            </table>
                            <!-- FIN DE CONTENIDO -->
		</div>
</div>
