<?php
include('../../../modelo/conexioni.php');

?>
<script src="../vistas/inventario/stock/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
           <li id="marca2">
              
           </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
                         <table class="table table-hover">
  <tr class="bg-info">

        <th>CODIGO</th> 
        <th>UBICACION</th>
        <th>STOCK</th>
        <th>FECHA DE MOVIMIENTO</th>
        <th>BODEGA</th>
        <TH>USUARIO</th>
        
  </tr>
  <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="des" placeholder="ubicacion" class="col-xs-10 col-sm-10"/></td> 
        <td>-</td>
        <td><input type="date" id="res" placeholder="fecha" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="bod" placeholder="bodega" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="usu" placeholder="usuario" class="col-xs-10 col-sm-12"/></td>
  </tr>
 <tbody id="mostrar_tabla">
 </tbody>
</table>
         </div>
  
         
               </div>
        </div> 
       
        
         
         
  
     

      





