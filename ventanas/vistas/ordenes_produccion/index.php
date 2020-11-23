<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
 <script src="../vistas/ordenes_produccion/funciones_produccion.js?<?php echo rand(1,100) ?>"></script>
 <div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="coti" class="form-control" placeholder="#cotizacion"></td>
                    <td><input type="text" id="nomobra" class="form-control" placeholder="#nombre de obra"></td>
                    <td><input type="text" id="fomp" class="form-control" placeholder="#OPF"></td>
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
          <h4 class="modal-title">Nueva produccion</h4>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>Numero de orden</td>
                    <td><input type="text" id="id_orden" class="form-control" disabled></td>
                </tr>
                <tr>
                    <td>Numero de cotizacion<b>*</b></td>
                    <td><input type="text" id="íd_cot" class="form-control"></td>
                </tr>
                <tr>
                    <td>Precio<b>*</b></td>
                    <td><input type="text" id="art_pre" class="form-control"></td>
                </tr>
                      <tr>
                    <td>id cliente</td> 
                    <td><select id="cliente" class="form-control">
                      <option value="">Seleccione</option>
                      <?php
                            $consulta = mysqli_query($con,"select * FROM `cont_terceros` group BY nom_ter"); 
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['nom_ter'].'">'.$f['nom_ter'].'</option>'; 
                            }
                            ?>
                      </select></td>
                </tr>
                 <tr>
                    <td>ubicacion<b>*</b></td>
                    <td><input type="text" id="ubicacion" class="form-control"></td>
                </tr>
                   <tr>
                    <td>Nombre de la obra<b>*</b></td>
                    <td><input type="text" id="obra" class="form-control"></td>
                </tr>
                   <tr>
                    <td>Fecha de registro<b>*</b></td>
                    <td><input type="date" id="fecha_reg_c" class="form-control"></td>
                </tr>
                   <tr>
                    <td>fecha de modificacion<b>*</b></td>
                    <td><input type="date" id="fecha_modificacion" class="form-control"></td>
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
                    <tr>
                    <td>Linea<b>*</b></td>
                    <td><input type="date" id="lineajg" class="form-control"></td>
                </tr>
                 <tr>
                    <td>Departamento</td> 
                    <td> <select id="ciudad" class="form-control" onchange="cargarmun();">
                      <option value="">Seleccione</option>
                      <?php
                            $consulta = mysqli_query($con,"select * FROM `departamentos` group BY nombre_dep");
                            while($f = mysqli_fetch_array($consulta)){ 
                                echo '<option value="'.$f['nombre_dep'].'">'.$f['nombre_dep'].'</option>';
                            }
                            ?>
                      </select></td>
                </tr>
                  <tr>
                    <td>ciudad o municipio</td> 
                    <td><select id="municipio" class="form-control">
                      <option value="">Seleccione</option>
                      <?php
                            $consulta = mysqli_query($con,"select * FROM `departamentos` group BY nombre_mun");
                            while($f = mysqli_fetch_array($consulta)){
                                echo '<option value="'.$f['nombre_mun'].'">'.$f['nombre_mun'].'</option>';
                            }
                            ?>
                      </select></td>
                </tr>
                 <tr>
                    <td>Pais</td>  
                    <td><input type="text" id="pais" class="form-control"></td>
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
    echo '<script>location.reload();</script>';
}?>
