<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/grupo_trabajo/funciones.js?v=1.0"></script>
<div class="page-content">
 <div class="table-responsive"> 
   <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" >
            <b>Grupos de trabajo</b></h2>
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
               <a data-toggle="tab" href="#agregar" onclick="limpiar_doll()"><h6><B>Crear grupo</B></h6></a>
           </li>
        </ul>
     <div class="tab-content">
		<div id="home" class="tab-pane fade in active">
                 <div class="table-responsive">
                   <br>
                   <table class="table table-hover"> 
                           <tr class="bg-info">
        <th>ITEMS</th>
        <th>NOMBRE DEL GRUPO</th> 
        <th>AREA RELACIONADA</th>
        <th>METODO DE PAGO</th>
        <th>FECH REGISTRO</th>
        <th>REGISTRADO POR</th> 
        <th>GRUPO</th>
        <th>EDITAR</th>
        <th>ESTADO</th>
    </tr> 
                              
    <tr>
        <td></td>
        <td><input type="text" id="busgrupo" placeholder="" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="busarea" placeholder="" class="col-xs-10 col-sm-12"/></td>
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
                              <input type="text" id="id_grupo" class="col-sm-5"  disabled/>
                             </div>   
                             </div>
                               <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Nombre del grupo</label>
                             <div class="col-sm-10">
                              <input type="text" id="nombre" class="col-sm-5" />
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Asignar area</label>
                             <div class="col-sm-10">
                                   <select id="area" class="col-sm-5">
                                                     <option value="">Seleccione</option>
                                                       <?php
                                                              
                                                           $consulta= "SELECT * FROM `subproceso`";                     
                                                            $result=  mysqli_query($con2,$consulta);
                                                            while($fila=  mysqli_fetch_array($result)){
                                                            $valor1=$fila['nombre_subpro'];
                                                         
                                                            echo"<option value=".$fila['id_subpro'].">".$valor1."</option>";
                                                            
                                                            }
                                                           
                                                            ?>
                                                   </select>
                             </div>
                             </div>
                            <br>
                            <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Metodo de pago</label>
                             <div class="col-sm-10">
                               <select id="met_pago" class="col-sm-5">
                                          <option value="">Seleccione</option>
                                                       <?php
                                                           $consulta2= "SELECT * FROM `pagos`";                     
                                                           $result2=  mysqli_query($con2,$consulta2);
                                                            while($fila=  mysqli_fetch_array($result2)){
                                                            $valor1=$fila['desc_pago'];
                                                            echo"<option value=".$fila['id_pago'].">".$valor1."</option>";
                                                            }
                                                            
                                                            ?>
                                                   </select>
                             </div>
                             </div>
                              <div class="form-group">
                             <label class="col-sm-2 control-label no-padding-right" for="form-field-1">Estado</label>
                             <div class="col-sm-10">
                              <select id="estado_g" class="col-sm-5">
			    <option value="0">Activo</option>
			    <option value="1">Inactivo</option> 
            </select>
                             </div>
                             </div>
                       
                            </form>
                         </div>
                   
                       <br>
                  
                       <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_grupo()">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_grupo()">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         LIMPIAR
                                 </button>
                            </label> 
                       </div>
                       </div>
                       
                       <br>
                         </div> 
                  
                        </div>
    
    
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
                               $consulta= "SELECT * FROM `usuarios` where area='Produccion' order by nombre asc";                     
                               $result=  mysqli_query($con2,$consulta);
                                 while($fila=  mysqli_fetch_array($result)){
                                 $valor1=$fila['nombre'].' '.$fila['apellido'];
                                 echo"<option value=".$fila['id_user'].">".$valor1."</option>";
                                 }
                               ?>
                            </select></label> 
                        </td>  
                     </tr>
                </table>
        <DIV id="mostrar_grupo">      
        </DIV>
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
     </div>
  
<br>

 </div>

</div>
 </div> 
 
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
