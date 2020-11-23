<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="ventas/cotizacionesx/funciones.js"></script>
 <div class="tab-content">
  <div class="table-responsive">
     <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
        <table class="table">
		<thead>
		<tr class="bg-info">
			<th width="5%">Ver</th>
			<th width="5%">Cotizacion</th>
			<th width="15%">Cliente</th>
			<th width="30%">Nombre de la Obra</th>
			<th width="30%">Fecha Registro</th>
			<th width="5%">Asesor</th>
			<th width="10%">Responsables</th>
                        <th nowrap>Venta Total Sin IVA</th>
			<th class="hidden-phone">Estado</th>
		</tr>
                        <tr>
                        <td></td>
                        <td><input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="####" value="" style="width: 100%"/></td>
                        <td><input type="text" autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value="" style="width: 100%"/></td>
                        <td><input type="text" autocomplete="off" class="span12" id="obr" placeholder="Obra" value="" style="width: 70%"/></td>
                        <td><input type="date" autocomplete="off"  id="freg" placeholder="" value="" style="width: 70%"/></td>

                        <td>
                        <select id="reg" name="numero" class="span6" style="width: 100%" required>
			    <?php
				echo "<option value=''>Asesores</option>";
                                $consulta2= "SELECT * FROM `usuarios` where area='Ventas' order by nombre";   
                                $result2=  mysqli_query($con,$consulta2);      
                                echo"<option value='ADMIN'>ADMIN</option>";  
                                while($fila=  mysqli_fetch_array($result2)){       
                                $valor3=$fila['usuario'];  
                                $valor4=$fila['nombre'].' '.$fila['apellido'];   
                                echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                }                                                       
                            ?>       
                        </select>
                        </td>
                        <td>
                           <select id="se" name="numero" class="span6" style="width: 100%" required>
				<?php
				     echo "<option value=''>Analistas</option>";
                                     $consulta= "SELECT * FROM `usuarios` where cargo='Presupuesto' order by nombre";   
                                     $result=  mysqli_query($con, $consulta);    
                                     echo"<option value='ADMIN'>ADMIN</option>";  
                                     while($fila=  mysqli_fetch_array($result)){       
                                       $valor3=$fila['usuario'];  
                                       $valor4=$fila['nombre'].' '.$fila['apellido'];  
                                       echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                       }                                                       
                                    ?>       
                                 </select>
                        </td>
                            <td><input type="text" autocomplete="off" class="span12" id="precio" placeholder="" value="" style="width: 100%"/></td>
                            <td>
                                <select id="estado" name="estado" class="span4" required>
                                          <option value="">Estado</option>
                                          <option value="En proceso">En proceso</option>
                                          <option value="Pedido por aprobar">por aprobar</option>
                                          <option value="Aprobado">Aprobado</option>
                                        
                                </select>
                            </td>
<!--  <td> <img src="../images/buscar.png" Style="cursor: pointer" id="buscador"></td>-->
                        </tr>
		
                      <tbody id="cotizacione">
                      </tbody>
                        </table>
		    </div>
           </div>
       </div>

 <?php  }else {
      echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
}?>         