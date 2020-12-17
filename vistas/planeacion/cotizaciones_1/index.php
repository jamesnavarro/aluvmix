<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/planeacion/cotizaciones/funciones.js?<?php echo rand(1,100) ?>"></script>
<script> 
$(document).ready(function(){
   mostrarCot(1);
})
</script>
 <div class="tab-content">
                    <div class="table-responsive">
                         <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <table class="table">
			<thead>
			<tr class="bg-info">
			<th width="5%">VER</th>
			<th width="5%">COTIZACION</th>
                        <th width="5%">PEDIDO</th>
			<th width="15%">CLIENTES</th>
			<th width="30%" nowrap>NOMBRE DE LA OBRA</th>
			<th width="30%">FECHA REGISTRO</th>
			<th width="5%">ASESOR</th>
			<th width="10%">RESPONSABLE</th>
                        
			<th class="hidden-phone">ESTADO</th>
			</tr>
                        <tr>
                            <td>-</td>
                            <td><input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="####" value="" style="width: 100%"/></td>
                             <td><input type="text" id="ped" autofocus autocomplete="off" class="span12" placeholder="####" value="" style="width: 100%"/></td>
                            <td><input type="text"  autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value="" style="width: 100%"/></td>
                            <td><input type="text"  autocomplete="off" class="span12" id="obr" placeholder="Obra" value="" style="width: 100%"/></td>
                            <td><input type="date"  autocomplete="off"  id="freg" placeholder="" value="" style="width: 100%"/></td>

                            <td>
                                <select id="reg" name="numero" class="span6" style="width: 100%" required>
				<?php
				  echo "<option value=''>Asesores</option>";
                                  $consulta2= "SELECT * FROM `usuarios` where area='Ventas' order by nombre";   
                                  $result2=  mysqli_query($con2,$consulta2);      
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
                                             $result=  mysqli_query($con2, $consulta);    
                                             echo"<option value='ADMIN'>ADMIN</option>";  
                                             while($fila=  mysqli_fetch_array($result)){       
                                             $valor3=$fila['usuario'];  
                                             $valor4=$fila['nombre'].' '.$fila['apellido'];  
                                             echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                        }                                                       
                                    ?>       
                             </select>
                            
                            <input type="hidden" autocomplete="off" class="span12" id="precio" placeholder="" value="" style="width: 100%"/></td>
                            <td>
                                <select id="estado" name="estado" class="span4">
                                          <option value="">Todas</option>
                                          <option value="Pedido por aprobar">por aprobar</option>
                                          <option value="En proceso">En proceso</option>
                                          <option value="Pedido por aprobar">por aprobar</option>
                                          <option value="Aprobado">Aprobado</option>
                                </select>
                            </td>
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