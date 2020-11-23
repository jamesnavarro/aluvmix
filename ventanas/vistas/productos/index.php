<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
 <script src="../vistas/productos/funciones_productos.js?<?php echo rand(1,100) ?>"></script>
 <div class="container">

<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="descripcion" class="form-control" placeholder="Descripcion"></td>
                    <td><input type="text" id="tipo" class="form-control" placeholder="Tipo"></td>
                    <td><input type="text" id="usuario" class="form-control" placeholder="Usuario"></td>
                    <td><input type="date" id="fecha" class="form-control" placeholder="Fecha de Registro"></td>
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
          <h4 class="modal-title">Nuevo Producto</h4>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>Id del producto</td>
                    <td><input type="text" id="art_idp" class="form-control" disabled></td>
                </tr>
                <tr>
                    <td>Descripción<b>*</b></td>
                    <td><input type="text" id="art_des" class="form-control"></td>
                </tr>
                <tr>
                    <td>Precio<b>*</b></td>
                    <td><input type="text" id="art_pre" class="form-control"></td>
                </tr>
                <tr>
                    <td>Tipo<b>*</b></td>
                    <td>
                        <select id="art_tipo" class="form-control">
                            <option value="">Seleccione</option>
                            <?php
                            $consulta = mysqli_query($con,"select * from tipos where estado=0 ");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['id_tipo'].'">'.$f['nombre_tipo'].'</option>';
                            }
                            ?>      
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Estado<b>*</b></td>
                    <td>
                        <select id="art_est" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>    
                        </select>
                       
                    </td>
                </tr>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_producto()">Guardar Cambios</button>
            <button type="button" class="btn btn-danger" onclick="limpiar_formulario()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

<?php  }else {

    header("location:../index.php");
    
}?>
