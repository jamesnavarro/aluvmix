<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/clientes/funciones_clientes.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
            <table  style="width: 100%">
                <tr>
                    <td><input type="text" id="clientes" class="form-control" placeholder="Clientes"></td> 
                    <td><input type="text" id="documento" class="form-control" placeholder="Documento"></td> 
                    <td><input type="text" id="direccion" class="form-control" placeholder="Direccion"></td> 
                    <td><input type="text" id="telefono" class="form-control" placeholder="Telefono"></td> 
         
            </table>
    <div id="mostrar_tabla">  </div>
    </div>
</div> 
 

 <div class="modal fade" id="FormularioProducto" role="dialog">
    <div class="modal-dialog">
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nuevo Cliente</h4>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>Id Cliente</td>
                    <td><input type="text" id="id_ter" class="form-control" disabled></td>
                </tr>
                 
                  <tr>
                    <td>nombre</td>  
                    <td><input type="text" id="nomb" class="form-control"></td>
                </tr>
                     <tr>
                    <td>tipo de documento<b>*</b></td>
                    <td>
                        <select id="ccn" class="form-control">
                            <option value="seleccione">seleccione</option>
                            <option value="NIT">NIT</option>
                            <option value="CC">CC</option>    
                        </select>
                      
                    </td>
                </tr>
                  <tr>
                    <td>numero de documento</td>  
                    <td><input type="number" id="numero" class="form-control"></td>
                </tr>
 
                  <tr>
                    <td>codigo de verificacion</td> 
                    <td><input type="number" id="verifi" class="form-control" autofocus></td>
                    
                </tr>
                 <tr>
                    <td>Direccion</td> 
                    <td><input type="text" id="dire" class="form-control"></td>
                </tr>
                 <tr>
                    <td>telefono</td>  
                    <td><input type="number" id="tele" class="form-control"></td>
                </tr>
                 <tr>
                    <td>Movil</td>  
                    <td><input type="number" id="mov" class="form-control"></td>
                </tr>
               
                  <tr>
                    <td>Departamento</td> 
                    <td> <select id="ciud" class="form-control" onchange="cargarmun();">
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
                    <td><select id="muni" class="form-control">
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
                 <tr>
                    <td>Fecha</td> 
                    <td><input type="date" id="fecha" class="form-control"></td>
                </tr>
                 <tr>
                    <td>correo</td> 
                    <td><input type="text" id="email" class="form-control" onchange="caracteresCorreoValido();"></td>
                 </tr>
                 <tr>
                    <td>contador</td> 
                    <td><input type="text" id="conta" class="form-control"></td>
                </tr>
               
                <tr>
                    <td>Estado<b>*</b></td>
                    <td>
                        <select id="stado" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="0">Activo</option>
                            <option value="1">Inactivo</option>    
                        </select>
                   
                    </td>
                </tr>
          
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="guardar_clientes()">Guardar Cambios</button>
            <button type="button" class="btn btn-danger" onclick="limpiar_formulario()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
     
 
  </div>
 <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>         