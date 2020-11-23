<?php
 
?>
<script src="../vistas/inventario/movimiento_fom/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">

        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
              <table class="table table-hover" >
  <tr class="bg-info">
        <th>Documento</th>
        <th>TipMov</th>  
        <th>Almacen</th>
        <th>Orden</th>
        <th>Fecha Doc</th>
        <th>Estado</th>  
        <th>DocMonty</th> 
        <th>Observaciones</th> 
        <th>Usuario</th> 
        <th>Ver</th>
  </tr>
    <tr>
        <td><input type="text" id="doc" placeholder="Numero" class="col-xs-10 col-sm-12"/></td>
        <td><input type="text" id="tip" placeholder="Tipo" value="01" class="col-xs-10 col-sm-12"/></td> 
        <td><input type="text" id="alm" placeholder="Codigo Almacen" class="col-xs-10 col-sm-12" value="0028"/></td> 
        <td></td>
         <td><input type="date" id="fec" placeholder="" class="col-xs-10 col-sm-12" value="<?php echo date("Y-m-d") ?>"/></td> 
      
         <td></td>
         <td></td>
         <td></td><td><button onclick="mostrar_lista(1)">Buscar</button></td>
         <td></td>
    </tr>
 <tbody id="mostrar_tabla">
          
     </tbody>
     <tr><td colspan="8">
                  <img src="images/at2.png"  onclick="paginacion(-1)" style="cursor: pointer;">
                       Pagina: <input type="text" id="page" placeholder="" value="1"  disabled style="width: 30px"/>
                       <img src="images/sig2.png" onclick="paginacion(1)" style="cursor: pointer;">
                       <input type="hidden" id="tamano" placeholder="" value="10"  disabled/>
           </td>
     </tr>
</table>
         </div>
  
         
  
               </div>
        </div> 
       
         
         
         
  
     

      





