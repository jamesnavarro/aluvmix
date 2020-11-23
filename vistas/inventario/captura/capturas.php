<?php
include('../../../modelo/conexioni.php');

?>
<script src="../vistas/inventario/captura/funciones.js"></script>

<div>
    
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>ITEM</th> 
        <th>FECHA</th>
        <th>CODIGO</th>
        <th>NOMBRE ALMACEN</th>
        <th>LINEA</th>
        <th>USUARIO</th>
        <th>VER</th>
  </tr>
    <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-4"/></td>
       <td><input type="date" id="fecha_r" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
         <td><input type="text" id="c_bod" placeholder="Codigo" class="col-xs-10 col-sm-4"/></td>
       <td><input type="date" id="nom_alm" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
         <td><input type="text" id="lin_a" placeholder="Codigo" class="col-xs-10 col-sm-4"/></td>
        
    </tr>
    <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
  
         
   
         
         
  
     

      





