<?php
include '../../../modelo/conexioni.php';
 session_start();
  if(!isset($_SESSION['k_username']))
      { 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
      }
?>   

<script src="../vistas/compras/gestion_time/funciones.js?<?php echo rand(1,200) ?>"></script>
<div class="panel panel-info">
		<div class="panel-body"> 
		  
                          <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">
					<th>No.SOL</th>
					<th>CODIGO</th>
                                        <th>DESCRIPCION</th>
                                        <th>FECHA REGISTRO</th>
					<th>FECHA APROB</th>
                                        <th>DIAS</th>
					<th>FECHA OC</th>
					<th>DIAS</th>
					<th>FECHA ENTRADA</th>
                                        <th>DIAS</th>
                                </tr>
                                 <tr>
                                      <td><input type="text" id="n_sol" placeholder="" style="width:100%"/></td>
                                      <td><input type="text" id="n_are" placeholder="" style="width:100%"/></td>
                                      <td><input type="text" id="n_des" placeholder="" style="width:100%"/></td>
                                      <td>-</td> 
                                      <td>-</td> 
                                      <td>-</td> 
                                      <td>-</td> 
                                      <td>-</td>   
                                      <td>-</td>
                                      <td>-</td>
                                </tr>
                               <tbody id="mostrar_tabla2">
                               </tbody>
                            </table>
                          <!-- FIN DE CONTENIDO -->   
		</div>
</div>
	
