<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/report_cot_presu/funciones.js"></script>
 <div class="tab-content">
                    <div class="table-responsive">
                         <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                          
                            <div style="margin-left: 1%; margin-top: 1%;">
                                 <select  name="empresa"  class="span8"   id="select2_1">
                                       <option value=''>Seleccione el Usuario</option>
                                               <?php
                                                  require '../modelo/conexioni.php';
                                                  $consulta= "SELECT *, concat(b.nombre, ' ',b.apellido) as nombre_completo FROM cotizacion a, usuarios b where a.grabado=b.usuario group by b.usuario order by nombre";
                                                                                    
                                                  $result=   mysqli_query($con,$consulta);
                                                   while($fila=  mysqli_fetch_array($result)){
                                                   $valor2=$fila['nombre_completo'];
                                                   $valor1=$fila['usuario'];
                                                    echo"<option value=".$valor1.">".$valor2."</option>";
                                                            
                                                 }
                                                 ?>
                                    </select>
                           
                                <label>
                                  <input  name="fecha" type="text" required  id="datepicker1" placeholder="2014-01-30" style="margin-left: 1%; width: 25%"> al <input  name="fecha2" required type="text"  id="datepicker2" placeholder="2014-12-30" style="margin-left: 1%; width: 25%">
                                  <input type="submit" class="btn" name="Buscar" value="Buscar">
                               </label>
                                
                            </div> 
                          
                     <br>
                
		    </div>
           </div>
       </div>

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         