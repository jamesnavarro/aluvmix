<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="../vistas/presupuestos/colores_ace/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="page-content">
 <div class="table-responsive"> 
  
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
             <h6><B>LISTA</B></h6>
           </a>
        </li>
        <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_ace()"><h6><B>AGREGAR</B></h6></a>
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
        <th>DESCRIPCION</th> 
        <th>ESTADO</th>
        <th>OPCIONES</th>
    </tr>
    <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" disabled/></td>
        <td><input type="text" id="nom" placeholder="" class="col-xs-10 col-sm-8"/></td> 
        <td><input type="text" id="categorias" placeholder="" class="col-xs-10 col-sm-8"/></td>
        
    </tr>
    <tbody id="mostrar_tabla">    
    
    </tbody>
</table>  
                        
<!--                         <div id="mostrar_tabla">
                            <br><br>
                            <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>
                      </div>       -->
                </div>
                    </div><br>
               <div id="agregar" class="tab-pane fade in">
               
                        <div class="col-xs-12">
                            
                            <table style="width:100%">
                                <tr>
                                    <td>ID</td>
                                    <td><input type="text" id="codigo" class="col-sm-5" disabled/></td>
                                </tr>
                                <tr>
                                    <td>Descripcion</td>
                                    <td><input type="text" id="descripcion" class="col-sm-5" /></td>
                                </tr>
                                 <tr>
                                    <td>Estado</td>
                                    <td>
                                        <select id="est_ace" class="col-sm-5">
                                            <option value="">Seleccione</option>
                                            <option value="0">Activo</option>
                                            <option value="1">Inactivo</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <hr>
                         </div>


                
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_ace()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-danger" onclick="limpiar_ace()">
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
