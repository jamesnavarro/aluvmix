<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/proc_trabajo/funciones.js"></script>

<div class="tabbable">
<ul class="nav nav-tabs" id="myTab">
	<li class="active" id="marcar1">
	   <a data-toggle="tab" href="#home">
           <h6><B>Lista</B></h6>
           </a>
        </li>
        <li id="marcar2">
           <a data-toggle="tab" href="#agregar" ><h6><B></B></h6></a>
        </li>
 </ul>
 <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
          <div class="table-responsive">
             <br>
                 <table class="table table-hover">
                   <tr class="bg-info">
                   <th>ID</th> 
                   <th>AREA</th>
                     <th>SEDE</th>
                   <th>PUESTO DE TRABAJO</th>
                   <th colspan="6" >VALORES</th>
                   
                   </tr>
             <tr>
        <td><input type="text" id="" placeholder="" class="col-xs-10 col-sm-2" /></td>
        <td><input type="text" id="area_b" placeholder="" class="col-xs-10 col-sm-8" /></td>
       
        <td>
            <select id="sede_b" class="col-xs-10 col-sm-5">
              <option value="">Todos</option>
	      <option value="CALLE 72">Barranquilla</option>
	      <option value="GALAPA">Galapa</option> 
            </select>
        </td>
          <td><input type="text" id="puesto_b" placeholder="" class="col-xs-10 col-sm-8" /></td>
    </tr>
    <tbody id="mostrar_tabla"> 
    </tbody>
</table>                   
       </div>
      </div><br>
          <div id="agregar" class="tab-pane fade in">
                  
             </div>
          </div>
        </div> 
  
         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





