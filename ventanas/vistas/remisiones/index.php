<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/remisiones/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
    
            <table  style="width: 100%">
               
            </table>
    
    <div style="float: right">
        <input type="button" onclick="verremi()" value="ver factura">
    </div>
    <div id="mostrar_tabla">
        <br><br>
<!--        <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>-->
    </div>
</div>
</div> 
 <div class="modal fade" id="Formularioremisiones" role="dialog">
    <div class="modal-dialog">
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Remisiones de pedido</h4>
        </div>
          
         <div class="modal-body">
            <table>
                 <tr>
                   <td></td>
                    <td>
                        <div class="input-group">
                        <span class="input-group-addon">Tipo<b>*</b></span> 
                        <select id="tiporemi" class="form-control">
                          <option value="Si">Pedido</option>
                          <option value="No">Cotización</option> 
                          <option value="Si">Consignación</option>
                          <option value="No">Pedido EXT</option>
                          <option value="Si">Pedido SUC</option>
                          <option value="No">Exportación</option>
                        </select> 
                        <span class="input-group-addon">No Pedido</span>   
                        <input type="number" id="npedi_remi" class="form-control"> 
                        </div>
                    </td>
                  </tr>
                  
                <tr class="bg-info">
                         <th COLSPAN="3" style="text-align: center">.      .</th>
                         </tr>
                <tr>
                    <td>Identificación</td>
                    <td>
                      <div class="input-group">
                      <input type="text" id="ccnit" class="form-control">
                      <span class="input-group-addon"></span> 
                      <input type="text" id="nomb_remi" class="form-control">
                      <span class="input-group-addon"></span> 
                      <input type="text" id="direremi" class="form-control">
                      </div>
                    </td>
                </tr>
               
                     <tr class="bg-info">
                          <th COLSPAN="3" style="text-align: center">DATOS BASICOS</th>
                     </tr>
                     <tr class="bg-info">
                          <th COLSPAN="3" style="text-align: center">------------------------------------------------------------------------------------------------------------------------</th>
                     </tr>
                     
                        <tr>
                             <td>No.Remision</td>
                             <td>
                               <div class="input-group">
                               <input type="text" id="tipre" class="form-control">
                               <span class="input-group-addon"></span> 
                               <input type="number" id="nremi" class="form-control">
                               </div>
                             </td>
                        </tr>
                       
                        <tr>
                               <td>ID vendedor</td>
                               <td>
                                 <div class="input-group">
                                 <input type="number" id="ced_vend" class="form-control">
                                 <span class="input-group-addon"></span>
                                 <input type="number" id="nomb_vende_rem" class="form-control">
                                 </div>
                               </td>
                        </tr>
                        
                         <tr class="bg-info">
                          <th COLSPAN="3" style="text-align: center">.        .</th>
                         </tr>
                       
                        <tr>
                           <td>Plazo</td>
                           <td>
                              <div class="input-group">
                              <input type="number" id="plazo" class="form-control">
                              <span class="input-group-addon">Ord.compra</span>
                              <input type="number" id="ord_compr" class="form-control">
                              </div>
                           </td>
                        </tr>
                        
                       <tr>
                           <td>%.DPF</td>
                           <td>
                               <div class="input-group">
                               <input type="text" id="por_dpf" class="form-control">
                               <span class="input-group-addon">Vence el</span>
                               <input type="date" id="vence_fech" class="form-control">
                               </div>
                           </td>
                       </tr>
                 
                      <tr>
                          <td>Moneda</td>
                          <td>
                            <div class="input-group">
                            <input type="number" id="tip_moneda" class="form-control">
                            <span class="input-group-addon">Tasa de cambio</span>
                            <input type="number" id="tasa_camb" class="form-control">
                            </div>
                          </td>
                       </tr>
                       <tr>
                           <td>%.OPP</td>
                           <td> 
                              <div class="input-group">
                               <input type="text" id="porc_opp" class="form-control">
                               <span class="input-group-addon">Pedido agente</span>
                               <input type="text" id="agent_ped" class="form-control">
                               </div>
                           </td>
                       </tr>
                       
                    <tr class="bg-info">
                          <th COLSPAN="3" style="text-align: center">------------------------------------------------------------------------------------------------------------------------</th>
                    </tr>
            </table>
            <div class="modal-footer">
                 <button type="button" class="btn btn-primary" onclick="guardar_actividad()">Factura</button> 
                 <button type="button" class="btn btn-default" data-dismiss="modal">Totales</button>
            </div>
        </div>
      </div>
    </div>
  </div>


 <?php  }else {
    echo '<script>location.reload();</script>';  
}?>         