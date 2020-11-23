<?php
include('../../../modelo/conexioni.php');
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/produccion/hojas/funciones.js?v=1.9"></script>

<div class="tabbable">

 <div class="tab-content">
          <div id="home" class="tab-pane fade in active">
          <div class="table-responsive">
             <br>
             <button class="btn-success" data-toggle="modal" data-target="#modalbuscar">Busqueda avanzada</button>
                 <table class="table table-hover">
                   <tr class="bg-info">
                       <th>ORDEN</th> 
                    <th>ITEM</th> 
                   <th>OPF</th> 
                   <th>PEDIDO</th>
                   <th>CLIENTE</th>
                   <th>REGISTRO</th>
                    <th>COTIZACION</th>
                   <th>OPCIONES</th>
              </tr>
    <tr>
        <td><input type="text" id="ord" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td>
            <select id="tipo" name="tipox" style="width: 100px"  onchange="mostrarOP(1)">
                    <option value="">--Todas--</option>
                    <option value="1">1.-Orden Bquilla</option>
                    <option value="2">2.-Rep Bquilla</option>
                    <option value="3">3.-Op Vidrio Galapa</option>
                    <option value="4">4.-Orden Acero</option>
                    <option value="5">5.-Externa Con Dsc</option>
                    <option value="6">6.-Orden Galapa</option>
                    <option value="7">7.-Rep. Galapa</option>
                    <option value="8">8.-Externa Sin Dsc</option>
                    <option value="9">9.-Ordenes</option>
                    
             </select>
        </td>
        
        <td><input type="text" id="opf" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><input type="text" id="ped" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td>
            <input type="text" id="cli" placeholder="" class="col-xs-10 col-sm-12" />
        </td>
        <td><input type="date" id="fec" placeholder="" class="col-xs-10 col-sm-12" /></td> 
        <td></td>
        <td></td>
  
    </tr>
    <tbody id="mostrar_tabla"> 
    </tbody>
</table>                   
       </div>
      </div><br>
   
          </div>
        </div> 
  <div class="modal fade" id="modalbuscar" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Busqueda Avanzada</h4>
        </div>
        <div class="modal-body">
            <table>
                <tr>
                    <td>Fecha Inicial</td>
                    <td><input type="date" id="bfi" value="<?php echo date("Y-m-01") ?>" class="col-xs-10 col-sm-12" /></td>
                    <td>Fecha final</td>
                    <td><input type="date" id="bff" value="<?php echo date("Y-m-d") ?>" class="col-xs-10 col-sm-12" /></td>
                </tr>
                <tr>
                    <td>Tipo de busqueda</td>
                    <td>
                        <select id="btipo">
                            <option value="1">1. Detallado</option>
                            <option value="2">2. Resumido</option>
                        </select>
                    </td>
                    <td>Tipo de Orden</td>
                    <td>
                        <select id="bord" name="tipox"  onchange="mostrarOP(1)">
                            <option value="">--Todas--</option>
                            <option value="1">1.-Orden Bquilla</option>
                            <option value="2">2.-Rep Bquilla</option>
                            <option value="3">3.-Op Vidrio Galapa</option>
                            <option value="4">4.-Orden Acero</option>
                            <option value="5">5.-Externa Con Dsc</option>
                            <option value="6">6.-Orden Galapa</option>
                            <option value="7">7.-Rep. Galapa</option>
                            <option value="8">8.-Externa Sin Dsc</option>
                            <option value="9">9.-Ordenes</option>
                            
                     </select>
                    </td>
                </tr>
            </table>
            <button type="button" class="btn btn-primary"  onclick="modalbuscar()">Buscar</button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" >Cerrar</button>
        </div>
      </div>
    </div>
  </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Menu de Opciones</h4>
      </div>
      <div class="modal-body">
          <p>Orden Produccion <input type="text" id="op" style="width:80px" disabled>
          <input type="hidden" id="idop" style="width:100px" disabled></p>
<!--          <button onclick="verhoja3()"> <img src="../vistas/images/printer.png"><br>Imprimir Presupuesto</button>-->
           <button onclick="verhoja()"><img src="../vistas/images/printer.png"><br>Imprimir Consumida</button>
           <button onclick="verhoja2()"><img src="../vistas/images/printer.png"><br>Imprimir Presupuesto</button>
           <button onclick="verhoja4()"><img src="../vistas/images/printer.png"><br>Inf. Comparativo</button>
           <button onclick="generarhoja()"><img src="../imagenes/version_1.png"><br>Generar Lista</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

         
          <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>  
  
     

      





