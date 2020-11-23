<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/conf_pagos/funciones.js"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" >
            <b>Configuracion de pagos</b></h2>
        </div>
   </div>   
<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
           <li id="marcar2">
               <a data-toggle="tab" href="#agregar" onclick="limpiar_conf()"><h6><B>Crear</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                    <div class="table-responsive">
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
                              <input type="text" id="id_conf" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                                    <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Descripcion de pago</label>
                             <div class="col-sm-10">
                              <input type="text" id="des_pago" class="col-sm-5" />
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Descripcion larga</label>
                             <div class="col-sm-10">
                                 <input type="text" id="cod_pag" class="col-sm-5" />
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Pagado por</label>
                             <div class="col-sm-10">
                                <select id="pago_por" class="col-sm-5">
			           <option value="Kg">Kg</option>
			           <option value="M2">M2</option>
                                   <option value="Ml">Ml</option>
			           <option value="Und">Und</option>
		                </select>
                             </div>
                             </div>
                       
                            </form>
                         </div>
                   
                       <br>
                  
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_conf()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_conf()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                       </div>
                       
                       <br>
                         </div> 
                  
                        </div>
    
<!--    
     <div class="modal fade" id="Formulario" role="dialog">
     <div class="modal-dialog modal-lg"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar usuario</h4>
        </div>
            <div class="modal-body">
                <table>
                   
                    <tr>
                        <td>
                            <label> <input type="text" id="numero" style="height: 30px"class="col-sm-2" disabled />
                                <select id="nom_usu" required   class="col-sm-4">
                            <option value="">Seleccione</option>
                             <?php
                               $consulta= "SELECT * FROM `usuarios` where area='Produccion'";                     
                                $result=  mysqli_query($con,$consulta);
                                 while($fila=  mysqli_fetch_array($result)){
                                $valor1=$fila['cedula'].' '.$fila['nombre'].' '.$fila['apellido'];
                                  echo"<option value=".$fila['id_user'].">".$valor1."</option>";
                                  }
                               ?>
                            </select></label> 
                        </td>  
                        </tr>
                  
                
                </table>
                <table>
                    <br>
                    <div>
                      <button class="btn btn-lg btn-success" onclick="guardar_usuario_gr()">
	              <i class="ace-icon fa fa-check "></i>
	               GUARDAR
                       </button>
                      <button class="btn btn-lg btn-danger" onclick="limpiar_usuario()">
	              <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	              LIMPIAR
                      </button>
                    </div>
                </table>
                <br> <br>
                <div id="mostrar_usuarios"></div>
                
            </div>
    
      </div>
    </div>
     </div>-->
    
    
    
    
    
    
    
    

<br>

 </div>

</div>
 </div> 
 
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
