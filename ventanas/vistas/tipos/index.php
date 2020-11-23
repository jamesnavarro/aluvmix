<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
?>
 <script src="../vistas/tipos/funciones_tipos.js?<?php echo rand(1,100) ?>"></script>
 <div class="container">

<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="tipo" class="form-control" placeholder="Tipo"></td> 
                    <td><input type="text" id="estado" class="form-control" placeholder="mostrar estado"></td>  
                </tr>
                 
            </table>
</div> 

            <div id="mostrar_tabla">

            </div>
            
        </div>

  <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog">
  
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Tipo</h4>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>id</td>  
                    <td><input type="text" id="numero" class="form-control"disabled></td>
                </tr>
                <tr>
                    <td>nombre</td>  
                    <td><input type="text" id="nombre" class="form-control"></td>
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
        <button type="button" class="btn btn-primary" onclick="guardar_tipo()">Guardar Cambios</button>
        <button type="button" class="btn btn-danger" onclick="limpiar_formulario()">Nuevo</button> 
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
      </div>
      
    </div>
  </div>

<?php  }else {header("location:../index.php");}?>
 
