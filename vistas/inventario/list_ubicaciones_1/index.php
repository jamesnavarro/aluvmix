<?php
include('../../../modelo/conexioni.php');

session_start();
if(isset($_SESSION['k_username'])){ 
?>
<script src="../vistas/inventario/list_ubicaciones_1/funciones.js?<?php echo rand(1,100) ?>"></script>

<div class="tabbable" style="margin-bottom: 25px;">

    
    
        <div class="tab-content">
         <div id="lin1" class="tab-pane fade in active">
             
             
 <table class="table table-hover">
  <tr class="bg-info">
        <th>COD BODEGA</th> 
        <th>CODIGO</th>
        <th>COLOR</th>
        <th>MEDIDA</th>
        <th>STOCK</th>
        <th>UBICACION</th>
        <th>ULT MOV.</th>
        <th>ULT USER</th>
        <th>OPCIONES</th>
  </tr>
    <tr>
        <td><input type="text" id="bod_bn" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><input type="text" id="codigo" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td><input type="text" id="color_b" placeholder="" class="col-xs-10 col-sm-12" /></td> 
        <td><input type="text" id="med_b" placeholder="" class="col-xs-10 col-sm-12" /></td> 
        <td><select id="stock"><option value="">Todas</option><option value="1">Con stock</option><option value="0">Sin stock</option>
            <option value="2">Negativos</option></select></td>
        <td><input type="text" id="ubi_b" placeholder="" class="col-xs-10 col-sm-12"/></td>
        <td><input type="date" id="fec_b" placeholder="" class="col-xs-10 col-sm-12" /></td>
        <td></td>
        <td></td>
    </tr>
        <tbody id="mostrar_tabla"></tbody>
</table>
         </div>
       
               </div>
        </div> 
      
         
         
         <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>   
  
<div id="ModalCambiar" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Trasalado entre Ubicaciones <input type="text" class="form-control" id="upid" placeholder="" name="email" disabled></h4>
      </div>
      <div class="modal-body">
          <div class="form-inline">
        <label class="control-label col-sm-2" for="email">Codigo</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="upcod" placeholder="" disabled>
      </div>
        <label class="control-label col-sm-2" for="email">Color</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="upcol" placeholder="" disabled>
      </div>
        <label class="control-label col-sm-2" for="email">Medida</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="upmed" placeholder="" disabled>
      </div>
        <label class="control-label col-sm-2" for="email">Bodega</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="upbod" placeholder="" disabled>
      </div>
        <label class="control-label col-sm-2" for="email">Cantidad</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="upcan" placeholder="" disabled>
      </div>
        <label class="control-label col-sm-2" for="email">Ubicacion</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="upubi" placeholder="" disabled>
      </div>
          </div>
          <br>
          <hr>
          <b>Trasladar a:</b>
          <div class="form-group">
           <label>Cantidad a trasladar</label>
           <input type="text" class="form-control" id="decan" onchange="valcan()">
        </div>
          <div class="form-group">
           <label>Ubicacion Destino</label>
           <input type="text" class="form-control" id="deubi" onclick="buscarubi()">
        </div>
          <?php if($_SESSION['k_username']=='admin'){ ?>
          <div class="form-group">
            <label>Stock Actual en fom plus</label>
            <input type="text" class="form-control" id="stoact">
          </div>
          <?php } ?>
      </div>
      <div class="modal-footer">
          <?php if($_SESSION['k_username']=='admin'){ ?>
         <button type="button" class="btn btn-primary" onclick="bus_cod_fom()">1.Consultar ref en fom</button>
         <button type="button" class="btn btn-primary" onclick="actualizaru()">2.Actualizar</button>
         <?php } ?>
          <button type="button" class="btn btn-primary" onclick="trasladarubi()">Trasladar Cantidad</button>
      </div>
    </div>

  </div>
</div>
<div id="ModalMovimientos" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Historial de Movimentos </h4>
      </div>
      <div class="modal-body">
          <table style="width:100%">
              <tr>
                  <th>DOCUMENTO</th>
                   <th>FECHA REGISTRO</th>
                   <th>UBICACION</th>
                   <th>CANTIDAD</th>
                   <th>TIPO</th>
                   <th>USUARIO</th>
              </tr>
              <tbody id="mostrar_movubi">
                  
              </tbody>
          </table>
         
      </div>
<!--      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="trasladarubi()">Imprimir</button>
      </div>-->
    </div>

  </div>
</div>
      
<div id="ModalCrear" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Actualizacion de cantidades por ubicacion </h4>
      </div>
      <div class="modal-body">
          <table style="width:100%">
              <tr>
                  <td>Codigo</td>
                  <td>
                      <input type="hidden" id="act_idu" disabled>
                      <input type="text" id="act_cod" disabled>
                  </td>
                  <td>Color</td>
                  <td>
                      <input type="text" id="act_col" disabled>
                  </td>
              </tr>
              <tr>
                  <td>Medida</td>
                  <td>
                      <input type="text" id="act_med" disabled>
                  </td>
                  <td>Ubicacion</td>
                  <td>
                      <input type="text" id="act_ubi" disabled>
                  </td>
              </tr>
              <tr>
                  <td>Bodega</td>
                  <td>
                      <input type="text" id="act_bod" disabled>
                  </td>
                  <td>Tipo de Movimiento</td>
                  <td>
                      <select id="act_tipo">
                          <option value="">Seleccione</option>
                          <option value="ENTRADA">ENTRADA</option>
                          <option value="SALIDA">SALIDA</option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>Stock Actual</td>
                  <td>
                      <input type="text" id="can_actual" disabled>
                  </td>
                  <td>Cantidad Actualizar</td>
                  <td>
                      <input type="text" id="can_act">
                  </td>
              </tr>
              <tr>
                  <td></td>
                  <td>
                      
                  </td>
                  <td></td>
                  <td>
                      <button type="button" id="btnsave" onclick="generar()" class="btn-primary">Actualizar</button>
                  </td>
              </tr>
 
          </table>
         
      </div>
<!--      <div class="modal-footer">
          <button type="button" class="btn btn-primary" onclick="trasladarubi()">Imprimir</button>
      </div>-->
    </div>

  </div>
</div>




