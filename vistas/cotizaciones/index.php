<?php
include '../../../modelo/conexioni.php';
 session_start();
  if(!isset($_SESSION['k_username']))
      { 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>   

<script src="../vistas/compras/cotizaciones/funciones.js?<?php echo rand(1,200) ?>"></script>
<div class="panel panel-info">
		<div class="panel-body">
		  
                          <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">
					<th>COTIZACION</th>
					<th>CLIENTE Y DOCUMENTO</th>
                                        <th>OBRA</th>
					<th>FECH REG</th>
					<th>FECH MOD</th>
					<th>FECH IMP</th>
					<th>GUARDADO</th>
					<th>TIEMPO DE COTIZACION</th>
                                        <th>RESPONSABLES</th>
                                        <TH>VENTA SIN IVA</TH>
                                <TH></TH>
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
	
