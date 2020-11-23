<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/listad/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
    <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Listado de producos sin revisar</b></h2>
        </div>
   </div>   
    <div class="table-responsive"> <br>
      
             <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;">       
                 <br>
                      <div class="form-group" > 
                             <div class="col-sm-30">
                                 <label>  
                      <select id="linea" class="col-sm-12">
                                              <option value=''>.:Seleccione la linea:.</option>
                                                 <?php
                                                   require '../../modelo/conexioni.php';
                                                   $consulta= "SELECT * FROM `lineas`";                     
                                                   $result=  mysqli_query($con,$consulta);
                                                   while($fila=  mysqli_fetch_array($result)){
                                                   $valor1=$fila['linea'];
                                                   $valor3=$fila['linea'];
                                                   echo"<option value='".$valor1."'>".$valor3."</option>";
                                                   }
                                                   ?>
                                                   <option value="MP">Materia Prima</option>
                                     </select>
                                 </label>
                                 <label><input type="text" id="bus" class="col-sm-12" placeholder="Codigo, Descripcion Referenciaeferencia"/></label>
                                 <label>
                                     <select id="estad" class="col-sm-10" required>
                                          <option value="">Revisado?</option>
                                          <option value="1">Actualizado</option>
                                          <option value="0">Sin actualizar</option>
                                       </select>
                                 </label>
                                   <label>
                                     <select id="desg" class="col-sm-12" required>
                                          <option value="">Desglose?</option>
                                          <option value="1">Si</option>
                                          <option value="0">No</option>
                                       </select>
                                 </label>
                                
                            
                             </div> 
                             </div>
                     <br>
       

                  

 <div id="mostrar_tabla">
        </div> 
      </div>
     
     
     
 </div>
    </div>

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
