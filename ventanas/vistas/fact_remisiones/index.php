<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/fact_remisiones/funciones.js?<?php echo rand(1,100) ?>"></script>
<div class="container">
<div class="table-responsive"> 
    
            <table  style="width: 100%">
               
            </table>
    
    <div style="float: right">
        <input type="button" onclick="verfactu()" value="ver remision">
    </div>
    <div id="mostrar_tabla">
        <br><br>
<!--        <b><center><img src="../imagenes/load.gif">Cargando Tabla</center></b>-->
    </div>
    </div>
</div> 
 <div class="modal fade" id="Formularioremisionesfact" role="dialog">
    <div class="modal-dialog">
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FACTURA DE REMISIONES</h4>
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
                        <input type="number" id="npedi_remi_n" class="form-control"> 
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
                        <input type="text" id="ccnit_n" class="form-control">
                         <span class="input-group-addon"></span> 
                        <input type="text" id="nomb_remi_n" class="form-control">
                         <span class="input-group-addon"></span> 
                        <input type="text" id="direremi_n" class="form-control">
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
                        <input type="text" id="tipre_n" class="form-control">
                         <span class="input-group-addon"></span> 
                        <input type="number" id="nremi_n" class="form-control">
                  
                        </div>
                        </td>
                       </tr>
                       
                       <tr><td>ID vendedor</td>
                           <td>
                              <div class="input-group">
                        <input type="number" id="ced_vend_n" class="form-control">
                        <span class="input-group-addon"></span>
                        <input type="number" id="nomb_vende_rem_n" class="form-control">
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
                      
                        <input type="number" id="plazo_n" class="form-control">
                        <span class="input-group-addon">Ord.compra</span>
                        <input type="number" id="ord_compr_n" class="form-control">
                      
                       
                               </div>
                           </td>
                       </tr>
                       <tr><td>%.DPF</td>
                           <td>
                               <div class="input-group">
                                     
                                      <input type="text" id="por_dpf_n" class="form-control">
                                     <span class="input-group-addon">Vence el</span>
                                     <input type="date" id="vence_fech" class="form-control">
                               </div>
                           </td>
                       </tr>
                 
                          <tr><td>Moneda</td>
                           <td>
                              <div class="input-group">
                      
                        <input type="number" id="tip_moneda_n" class="form-control">
                        <span class="input-group-addon">Tasa de cambio</span>
                        <input type="number" id="tasa_camb_n" class="form-control">
                               </div>
                           </td>
                       </tr>
                       <tr><td>%.OPP</td>
                           <td>
                               <div class="input-group">
                                    <input type="text" id="porc_opp_n" class="form-control">
                                    <span class="input-group-addon">Pedido agente</span>
                                    <input type="text" id="agent_ped_n" class="form-control">
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