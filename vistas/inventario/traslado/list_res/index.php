<?php
 
?>
<script src="../vistas/inventario/movimientos/list_res/funciones.js?<?php echo rand(1,100) ?>"></script>
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
                          <th>BODEGA</th>
                          <th>OBRA</th>
                          <th>ESTADO</th>
                          <th>REPORTE</th>
                    </tr>
                    <tr>
                          <td><input type="hidden" id="cod" placeholder="Codigo" class="col-xs-10 col-sm-12"/>
                          <input type="text" id="des" placeholder="Bodega de obra" class="col-xs-10 col-sm-12"/></td>
                          <td><input type="text" id="res" placeholder="Nombre de la obra" class="col-xs-10 col-sm-12"/></td> 
                          <td></td>
                          <td></td>
                    </tr>
                    <tbody id="mostrar_tabla"></tbody>
              </table>
         </div>
  </div>
</div> 
       
         
         
         
  
     

      





