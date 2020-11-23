<?php
 
?>
<script src="../vistas/inventario/amortiguadores/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">
<ul class="nav nav-tabs" id="myTab">
    <li class="active" id="marca1">
	   <a data-toggle="tab" href="#lin1">
              <h6><B>lista</B></h6>
           </a>
        </li>
        </ul>
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover">
  <tr class="bg-info">

        <th>CODIGO</th> 
        <th>DESCRIPCION</th>
        <th>STOCK ACTUAL</th>
  </tr>
    <tr>
        <td><input type="text" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/></td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
</table>
         </div>
         <div style="width: 100%">
           <b style="color: blue;margin-right: 8%;font-size: 25px;"> Sobre Stock </b><b style="color: green;font-size: 25px;margin-right: 8%;">Stock Maximo </b><b style="color: yellow;font-size: 25px;margin-right: 8%;">Stock Minimo </b><b style="color: red;font-size: 25px;margin-right: 8%;">Stock Seguridad </b>
         </div>
         
         
  
     

      





