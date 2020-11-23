<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/presupuestos/mod_sistemas/funciones.js?<?php echo rand(1,100) ?>"></script>
<style>
    .content-box-blue {
background-color: #d8ecf7;
border: 1px solid #afcde3;
height: 200px;
width: 200px;

}
</style>
<div class="page-content">
 <div class="modal fade" id="Formulariosistema" role="dialog">
    <div class="modal-dialog"> 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Actividad</h4>
        </div>
          
        <div class="modal-body">
                                 <table>
                                     <tr>
                                         <td>
                                             <label class="col-sm-4 control-label no-padding-right">Id</label>
                                             <input type="text" id="id_sistema" class="col-xs-6" disabled/>
                                        </td>
                                        
                                        
                                     </tr>
                                     <tr>
                                        <td>
                                             <label class="col-sm-4 control-label no-padding-right">Nombre</label>
                                             <input type="text" id="nombre" placeholder="Codigo" class="col-xs-6"/>
                                        </td> 
                                     </tr>
                           
                          
                                    
                                     
                                   </table>
                  <div style="margin-left:24%;">
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="guardar_sist();">
	                         <i class="ace-icon fa fa-check "></i>
	                         GUARDAR
                                 </button>
                           </label> &nbsp;
                           <label>
                                 <button class="btn btn-lg btn-info" onclick="limpiar_modsis();">
	                         <i class="ace-icon fa fa-close "data-dismiss="modal"></i>
	                         NUEVO
                                 </button>
                            </label> 
                       </div>
                              </div>
                            </div>
       </div>
 </div>
           </div>
 
      
      </div>
 
        <table>
            <tr> <td><button style="width: 165px "  class="btn btn-info btn-lg" data-toggle="modal" data-target="#Formulariosistema" onclick="limpiar_slineas();"><i class="glyphicon glyphicon-plus" ></i>Agregar</button>
        </table>
      <br>
    <div id="mostrar_tabla">
       
    </div>
       
     
 
 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
