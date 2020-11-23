<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/cotizaciones_aprobadas/funciones.js?<?php echo rand(1,100) ?>"></script>
 <div class="tab-content">
                    <div class="table-responsive">
                         <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                          
                            <div style="margin-left: 1%; margin-top: 1%;">
                                <label>
                                    <input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="####" value="" style="margin-left: 1%; width: 7%"/>
                                    <input type="text"  autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value="" style="margin-left: 1%; width: 25%"/>
                                    <input type="text" autocomplete="off" class="span12" id="obr" placeholder="Obra" value="" style="margin-left: 1%; width: 25%"/>
                                 
                                  <select id="se" name="numero" class="span6" style="margin-left: 1%; width: 15%" required>
				    <?php
					if (isset($_GET['cot'])) {
						echo "<option value='" . $reg . "'>" . $reg . "</option>";
					} else {
						echo "<option value=''>Analistas</option>";
					}
                                             $consulta= "SELECT * FROM `usuarios` where cargo='Presupuesto' order by nombre";   
                                             $result=  mysqli_query($con,$consulta);        echo"<option value='ADMIN'>ADMIN</option>";  
                                             while($fila=  mysqli_fetch_array($result)){       
                                             $valor3=$fila['usuario'];  
                                             $valor4=$fila['nombre'].' '.$fila['apellido'];  
                                             echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                        }                                                       
                                    ?>       
                                 </select>
                                    
                               <select id="reg" name="numero" class="span4" style="margin-left: 1%; width: 15%" required>
				<?php
					if (isset($_GET['cot'])) {
						echo "<option value='" . $reg . "'>" . $reg . "</option>";
					} else {
						echo "<option value=''>Asesores</option>";
					}
                                         $consulta2= "SELECT * FROM `usuarios` where area='Ventas' order by nombre";   
                                         $result2=  mysqli_query($con,$consulta2);        echo"<option value='ADMIN'>ADMIN</option>";  
                                         while($fila=  mysqli_fetch_array($result2)){       
                                         $valor3=$fila['usuario'];  
                                         $valor4=$fila['nombre'].' '.$fila['apellido'];   
   
                                         echo"<option value='".$valor3."'>".strtoupper($valor4)."</option>";   
                                         }                                                       
                                         ?>       
                              </select>
                           
                               </label>
                                
                            </div> 
                            <div style="margin-left: 1%; margin-top: 1%;">
                          <label>   
                                     <img src="../images/buscar.png" Style="cursor: pointer" id="buscador">
                                       <select id="estado" name="estado" class="span4" required disabled>
                                          <option value="Aprobado">Aprobado</option>
                                          <option value="">Seleccione Estado</option>
                                          <option value="En proceso">En proceso</option>
                                          <option value="Pedido por aprobar">Pedido por aprobar</option>
                                       </select>
                             
                           </label>
                             </div>
                     <br>
                 <div id="cotizacione"  class="table-responsive">
                     </div>
		    </div>
           </div>
       </div>

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         