<?php
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
  ?>
 <script src="../vistas/usuarios/funciones_usuario.js?<?php echo rand(1,100) ?>"></script>
<table>
    <tr>
        <td>Nombre del Usuario</td>
        <td><input type="text" id="nombres" class="form-control"></td>
        <td>Fecha de registro</td>
        <td><input type="date" id="fecha" class="form-control"></td>
    </tr>
</table>

<div id="mostrar_tabla">
  
</div>
 
 <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo usuario</h4>
        </div>
        <div class="modal-body">
            <table>
                 <tr>
                    <td>codigo usuario</td> 
                    <td><input type="text" id="cod" class="form-control" disabled></td>
                </tr>
                <tr>
                    <td>nombre</td>
                    <td><input type="text" id="nombrex" class="form-control"></td>
                </tr>
                <tr>
                    <td>usuario</td> 
                    <td><input type="text" id="usuario" class="form-control"></td>
                </tr>
                <tr>
                    <td>clave<b>*</b></td>
                    <td><input type="password" id="clave" class="form-control"></td>
                </tr>
                 
                <tr>
                    <td>Estado<b>*</b></td>
                    <td>
                        <select id="estado" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>    
                        </select>
                       
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_usuario()">Guardar usuario</button>
            <button type="button" class="btn btn-danger" onclick="limpiar_formulario()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


 <?php   
}else{
    echo '<script>location.reload();</script>';
}
?>


