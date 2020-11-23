<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/cristales/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue"><b>CRISTALES</b></h2>
        </div>
            </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
             <h6><B>LISTA</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_cris()"><h6><B>AGREGAR</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
                       <div style="margin-left: 1%; margin-top: 1%;">
                         
                       </div>
                        <br>
                        
                       <table class="table table-hover">
   
    <tr class="bg-info">
        <th>ITEM</th>
        <th>CRISTALES</th> 
        <th>AREA</th> 
        <th>OPCIONES</th>
    </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
        <td><input type="text" id="nom" placeholder="" class="col-xs-10 col-sm-8"/></td> 
        <td><input type="text" id="area" placeholder="" class="col-xs-10 col-sm-2"/></td>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
    </tr>
    <tbody id="mostrar_tabla">    
   
    </tbody>
</table>      
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
                              <input type="text" id="id_cris" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Configuracion</label>
                             <div class="col-sm-10">
                              <input type="text" id="descrip_cris" class="col-sm-5" />
                             </div>
                             </div>
                            
                             <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Area</label>
                             <div class="col-sm-10">
                                 <select id="area_cris" class="col-sm-5">
                                                                <option value="">Seleccione</option>
                    <?php
                             $consulta= "SELECT * FROM `puestos_trabajos`";                     
                             $result=  mysqli_query($con,$consulta);
                             while($fila=mysqli_fetch_array($result)){
                             $valor1=$fila['id_puesto'];
                             $valor2=$fila['nombre_puesto'];
                               echo"<option value='".$valor1."'>".$valor2."</option>";
                          }
                    ?>
	     </select>
                             </div>
                             </div>
                            
                            
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Secuencia</label>
                             <div class="col-sm-10">
                              <input type="text" id="secu_cristal" class="col-sm-5" />
                             </div>
                             </div>
                            </form>
                         </div>
                       <div></div>
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_cris()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_cris()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                       </div>
                  
                         </div> 
                  
                        </div>

 </div>
 
</div>  

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
