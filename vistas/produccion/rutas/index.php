<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>

<script src="produccion/rutas/funciones.js"></script>
<div class="page-content">
    <div class="row">
	<div class="col-xs-12">	
            <h2 class="header smaller lighter blue" ><b>Listado de Hojas de Rutas</b></h2>
        </div>
   </div>   
    <div class="table-responsive">
      
             <div>       
          
 <table class="table table-hover">
    <tr class="bg-info">
        <th>Items</th>
        <th>Diseño</th>
         <th>Codigo</th>
         <th>Producto</th>
         <th>Linea</th>
         <th nowrap>Ultima modificacion</th>
         <th nowrap>Modificado por</th>
         <th>Rutas</th>

    </tr>
    <tr>
        <td><input type="text" id="ite" style="width: 100%"></td>
        <td><input type="text" id="" style="width: 100%" disabled></td>
         <td><input type="text" id="codi" style="width: 100%"></td>
         <td><input type="text" id="desc" style="width: 100%"></td>
         <input type="hidden" id="refe" style="width: 100%">
         <td><input type="text" id="line" style="width: 100%"></td>
         <td nowrap><input type="text" id="ulti" style="width: 100%"></td>
         <td nowrap><input type="text" id="modi" style="width: 100%"></td>
          <td>-</td>


    </tr>
      <tbody id="mostrar_listado_p">
               
      </tbody> 
        
 </table>
      </div>
     
     
     
 </div>
    </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Asignacion de Hoja de Rutas</h4>
      </div>
      <div class="modal-body">
          <table>
              <tr>
                  <td>Codigo Producto</td>
                  <td><input type="text" disabled id="producto"></td>
              </tr>
              <tr>
                  <td>Puesto de Trabajo</td>
                  <td>
                      <select id="puesto">
                          <option value="">Seleccione</option>
                      
                      <?php
                      $result = mysqli_query($con, "select id_puesto, nombre_puesto from puestos_trabajos where estado=0 ");
                      while($r = mysqli_fetch_array($result)){
                          echo ' <option value="'.$r['0'].'">'.$r['1'].'</option>';
                      }
                      
                      ?>
                      </select> <button class="btn-primary" onclick="pro_addpuesto()"> + </button>
                  </td>
              </tr>
          </table>
          <hr>
          <div id="mostrar_rutasx">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         
