<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/precios_areas/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Precios Por Areas (Kg, Und, Ml, M2)</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
              <h6><B>PRECIOS</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_prearea()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                           <input type="text" id="prearea" class="form-control" placeholder="Referencia">
              
                       </div>
                        <br>
                        
                        
                         <div id="mostrar_tabla">
        <br><br>
        <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
    </div>       
                </div>
                    </div><br>
                    <div id="agregar" class="tab-pane fade in">
                   <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
                        <div class="col-xs-12" style="margin-left:6%;">
                            <form class="form-horizontal" role="form">
                                <br>
                            <div class="form-group" > 
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">ID</label>
                             <div class="col-sm-10">
                              <input type="text" id="id_prea" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">lINEA</label>
                             <div class="col-sm-10">
                                   <select id="lineaprea" class="col-sm-5" required>
                                        <?php
                                              $consulta= "SELECT * FROM `lineas`";                     
                                              $result=  mysqli_query($con,$consulta);
                                                while($fila=  mysqli_fetch_array($result)){
                                                   $valor1=$fila['linea'];
                                                   $valor3=$fila['linea'];
                                                echo"<option value='".$valor1."'>".$valor3."</option>";
                                                 }
                                                           
                                            ?>
                                              </select>
                             </div> 
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Descripcion de area</label>
                             <div class="col-sm-10">
                                 <input type="text" id="des_prea" class="col-sm-5" placeholder="digite la descripcion del pago"/>
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Asignacion</label>
                             <div class="col-sm-10">
                               <select id="asi_prea" class="col-sm-5">
                                    <option>Seleccione tipo de asiganacion</option>
                                    <option value="0">Manual</option>
                                    <option value="1">Automatica</option>
                                </select>
                             </div>                            
                             </div>
                               <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Precio de fabricacion</label>
                             <div class="col-sm-10">
                                 <input type="text" id="fabi_prea" class="col-sm-5" placeholder="digite el valor"/> 
                             </div>
                             </div>
                               <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Precio de adicional</label>
                             <div class="col-sm-10">
                                 <input type="text" id="adi_prea" class="col-sm-5" placeholder="digite el valor adicional"/> Si tiene algun trabajo adicional
                             </div>
                             </div>
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Unidad de medida</label>
                             <div class="col-sm-10">
                               <select id="med_prea" class="col-sm-5">
                                    <option value="Kg">Kg</option>
                                    <option value="Und">Und</option>
                                    <option value="Ml">Ml</option>
                                     <option value="M2">M2</option>
                                </select>
                             </div>                            
                             </div>
                            </form>
                         </div>
                   
                       <br>
                  
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_prearea()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_prearea()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                       </div>
                       
                       <br>
                         </div> 
                  
                        </div>

<br>

 </div>

</div>
 </div> 
</div>
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
