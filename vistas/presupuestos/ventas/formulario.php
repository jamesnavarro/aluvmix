<?php
session_start();
if(!isset($_SESSION['k_username'])){
    echo '<script>window.close();</script>';
}
include '../../../modelo/conexioni.php';
$desp = mysqli_query($con,"select porc_desp,porc_venta from porcentajes ");
$p = array();
while($d = mysqli_fetch_row($desp)){
    $p[] = $d[0];
}
 $result3 = mysqli_query($con ,"select * from  referencia_admin where estado='Activo' ");
                $tp = 0;
                while($r = mysqli_fetch_array($result3)){
                    $tp += $r[3];
                    $a[] = $r[3];
               }
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <head>
        <meta charset="UTF-8">
        <title>Modulo de Ventas</title>
                        <link href="../../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">

        <script src="funciones.js?<?php echo rand(1,100) ?>" type="text/javascript"></script>
    </head>
    <body class="bordes" onload="DatosBasicos()">
        <fieldset>
            <legend>Cotizacion No. <input type="text" id="cot" value="<?php echo $_GET['cot'] ?>" disabled style="width: 100px">
                <button id="save" onclick="congelar_item()" class="btn btn-success">Guardar</button>
                             <button onclick="limpiar_form()" class="btn btn-info">Nuevo</button>
                             <button onclick="window.close();" class="btn btn-danger">Salir</button>
            </legend>
            <div class="form-group-sm">
                <table style="width: 100%"  class="bg-info" border="1" bordercolor="#B9BBB7">
                    <tr>
                         <td>Items:</td>
                         <td><input type="text" id="item" value="" disabled style="width: 100px"></td>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td colspan="9">
                             <div style="float: right">
                                 Estado: <input type="text" id="estado" value="" style="width:100px" disabled>
                                 
                             </div>
                             
                         </td>

                     </tr>
                     <tr>
                         <td>Linea :</td>
                         <td><input type="text" id="linea" value="<?php echo $_GET['linea'] ?>" disabled style="width: 100px"></td>
                         <td>Codigo :</td>
                         <td><input type="text" id="codigo0" value="" onclick="get_referencias(0);" style="width:100px"></td>
                         <td>Descripcion :</td>
                         <td colspan="9"> <input type="text" id="descripcion0" value="" style="width:100%" disabled></td>

                     </tr>
                     <tr>
                         <td>Ancho Maximo</td>
                         <td><input type="text" id="ancho_max" value="" style="width:100px" disabled></td>
                         <td>Alto Maximo</td>
                         <td><input type="text" id="alto_max" value="" style="width:100px" disabled></td>
                         <td>Laminado Max</td>
                         <td><input type="text" id="lam" value="" style="width:50px" disabled></td>
                         <td>Perforaciones</td>
                         <td><input type="text" id="per" value="" style="width:40px" disabled></td>
                         <td>Boquetes</td>
                         <td><input type="text" id="boq" value="" style="width:40px" disabled></td>
                         <td>Interlayer</td>
                         <td><input type="text" id="interlayer" value="" style="width:40px" disabled></td>
                         <td>Espaciadores</td>
                         <td><input type="text" id="espaciadores" value="" style="width:40px" disabled></td>
                     </tr>
                     <tr>
                         <td></td>
                         <td></td>
                         <td></td>
                         <td>
                            
                         </td>
                         <td></td>
                         <td></td>
                         <td>Pel.Protectora</td>
                         <td>
                             <select id="pelicula" style="width:60px">
                                 <option value="No Aplica">No Aplica</option>
                                 <option value="Una Cara">Una Cara</option>
                                 <option value="Dos Cara">Dos Cara</option>
                             </select>
                         </td>
                         <td>Carton</td>
                         <td>
                             <select id="carton" style="width:60px">
                                 <option value="No Aplica">No Aplica</option>
                                 <option value="Una Cara">Una Cara</option>
                                 <option value="Dos Cara">Dos Cara</option>
                             </select>
                         </td>
                         <td>Descuento</td>
                         <td>
                             <input type="text" id="descuento" value="<?php echo $_GET['max'] ?>" style="width:40px" disabled> 
                         </td>
                         
                         <td>Tipo</td>
                         <td>
                             <input type="text" id="tipos" placeholder="V-01" style="width:60px">
                         </td>
                     </tr>
                     <tr>
                         <td>Ancho</td>
                         <td><input type="text" id="ancho" value="" style="width:100px" onchange="update_costo_por_item()"></td>
                         <td>Alto</td>
                         <td><input type="text" id="alto" value="" style="width:100px"  onchange="update_costo_por_item()"></td>
                         <td>Cantidad</td>
                         <td><input type="text" id="cantidad" value="" style="width:50px"  onchange="update_costo_por_item()"></td>
                         <td>Perforaciones</td>
                         <td><input type="text" id="perforacion" value="" style="width:40px" ></td>
                         <td>Boquetes</td>
                         <td><input type="text" id="boquetes" value="" style="width:40px" ></td>
                         <td>Instalacion</td>
                         <td>
                             <select id="instalacion" style="width:60px">
                                 <option value="No">No</option>
                                 <option value="Si">Si</option>
                             </select>
                         </td>
                         <td><button onclick="" data-toggle="modal" data-target="#modalplanilla">Porcentajes</button></td>
                         <td></td>
                         
                     </tr>
                     <tr>

                         <td>Descripcion final</td>
                         <td colspan="13"><input type="text" id="descripcion_final" value="" style="width:100%" ></td>
                        
                     </tr>
                     <tr>
                         <td>Ubicacion</td>
                         <td colspan="3"><input type="text" id="ubicacion" value="" style="width:100%" ></td>
                         <td>Observacion</td>
                         <td colspan="7"><input type="text" id="observacion" value="" style="width:100%" ></td>
                         <td>Laminas</td>
                         <td><input type="text" id="laminas" value="" style="width:40px" ></td>
                     </tr>
                     
                 </table>
                
                
            </div>
           
            
        </fieldset>
        <fieldset>
            <legend>Laminas</legend>
            <div id="formlaminas">
                
            </div>
            <div id="forminsumos">
                
            </div>
        </fieldset>
        <fieldset>
            <legend>Totales</legend>
            <div id="" style="float: right">
                <table>
                    <tr>
                        <td>Total Costo:</td>
                        <td><input type="text" id="totalcosto" style="width:100px;text-align: right" disabled></td>
                    </tr>
                    <tr>
                        <td>SubTotal:</td>
                        <td><input type="text" id="subtotal" style="width:100px;text-align: right" disabled></td>
                    </tr>
                    <tr>
                        <td>Descuento <span id="descu"></span></td>
                        <td></span> <input type="text" id="tdescuento" style="width:100px;text-align: right" disabled></td>
                    </tr>
                    <tr>
                        <td>SubTotal 2:</td>
                        <td><input type="text" id="subtotal2" style="width:100px;text-align: right" disabled></td>
                    </tr>
                    <tr>
                        <td>Iva 19 % </td>
                        <td><input type="text" id="iva" style="width:100px;text-align: right" disabled></td>
                    </tr>
                    <tr>
                        <td><button onclick="planilla()">Planilla :</button> <button onclick="totalizar()">Total :</button> </td>
                        <td><input type="text" id="gran_total" style="width:100px;text-align: right" disabled></td>
                    </tr>
                    <tr>
                        <td>Total PLanilla </td>
                        <td><input type="text" id="total_planilla" style="width:100px;text-align: right" disabled></td>
                    </tr>
                </table>   
            </div>
        </fieldset>
        <hr>
                Configuracion:
                <span id="costos"></span>
                   <script src="../../assets/js/bootstrap.min.js"></script>
                <script src="../../assets/js/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../../assets/js/bootstrap.min.js"></script>
		<script src="../../assets/js/ace-elements.min.js"></script>
		<script src="../../assets/js/ace.min.js"></script>
		<script type="text/javascript" src="../../assets/js/jquery-ui.min.js"></script>
		<script src="../../assets/js/jquery-ui.custom.min.js"></script>
		<script src="../../assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../../assets/js/bootbox.js"></script>
		<script src="../../assets/js/jquery.easypiechart.min.js"></script>
		<script src="../../assets/js/jquery.gritter.min.js"></script>
		<script src="../../assets/js/spin.js"></script>   
    </body>
</html>
 <div class="modal fade" id="modalmasacc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Espaciadores/interlayer extras</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <table>
              <tr>
                  <td>Id</td>
                  <td><input type="text" id="idins"></td>
              </tr>
              <tr>
                  <td>Item</td>
                  <td><input type="text" id="extra_item"></td>
              </tr>
              <tr>
                  <td>Codigo Principal</td>
                  <td><input type="text" id="extra_codigo"></td>
              </tr>
              <tr>
                  <td>Codigo a agregar</td>
                  <td>
                      <select id="extra_comp" onchange="agregar_compuesto()">
                          <option value="">Seleccione</option>
                      </select>
                  </td>
              </tr> 
              <tr>
                  <td>Cantidad</td>
                  <td><input type="text" id="mtc_int_comp"></td>
              </tr>
              <tr>
                  <td>Unidad</td>
                  <td><input type="text" id="med_int_comp"></td>
              </tr>
              <tr>
                  <td>Precio Und</td>
                  <td><input type="text" id="precio_unidad"></td>
              </tr>
              <tr>
                  <td>Precio Total</td>
                  <td><input type="text" id="precio_total"></td>
              </tr>
          </table>
          <p id="mostrar_compuestos">
              
          </p>
        ...
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiar_form_extra()">Close</button>
          <button type="button" class="btn btn-danger"  onclick="limpiar_form_extra()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="salvar_compuesto()">Guadar Cambios</button>
      </div>
    </div>
  </div>
</div>
<!-- modal de porcentajes -->
<div class="modal fade" id="modalplanilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuracion de Porcentajes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <form>
            <table width="100%">
                
                <tr>
                    <td><label>Desp. de Vidrio: %</label></td>
                    <td><input type="text" class="form-control" id="desperdicio" value="<?php echo $p[0] ?>" style="width: 60px"></td>
                    <td rowspan="8">
                        <div style="float: center">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Subtotal</label>
                            <input type="text" class="form-control" id="gran_subtotal" style="text-align: right" disabled>
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput">Descuento</label>
                            <input type="text" class="form-control" id="gran_descuento"  style="text-align: right" disabled>
                          </div>
                          <div class="form-group">
                            <label for="formGroupExampleInput2">Iva 19%</label>
                            <input type="text" class="form-control" id="gran_iva" style="text-align: right" disabled>
                          </div>
                            <div class="form-group">
                            <label for="formGroupExampleInput2">Total a Pagar</label>
                            <input type="text" class="form-control" id="gran_totalpagar" style="text-align: right" disabled>
                          </div>
                            </div>
                    </td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp. de Aluminio: %</label></td>
                    <td> <input type="text" class="form-control" id="desperdicio_al" value="<?php echo $p[1] ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp. de Accesorios: %</label></td>
                    <td><input type="text" class="form-control" id="desperdicio_acc" value="<?php echo $p[3] ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp. de Acero: %</label></td>
                    <td><input type="text" class="form-control"  id="desperdicio_ace" value="<?php echo $p[2] ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label>Desp Espaciadores : %</label></td>
                    <td><input type="text" class="form-control" id="desperdicio_esp" value="<?php echo $p[4] ?>" style="width: 60px" onchange="sumar_p()"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp Interlayer : %</label></td>
                    <td> <input type="text" class="form-control" id="desperdicio_int" value="<?php echo $p[5] ?>" style="width: 60px" onchange="sumar_p()"></td>
                </tr>
<!--                <tr>
                    <td><label for="message-text" class="col-form-label">IMPREVISTO : %</label></td>
                    <td><input type="text" class="form-control" id="imprevisto" value="<?php echo $a[2] ?>" style="width: 60px" onchange="sumar_p()"></td>
                </tr>-->
                <tr>
                    <td><label for="message-text" class="col-form-label">UTILIDAD : %</label></td>
                    <td><input type="text" class="form-control"  id="utilidad" value="15" style="width: 60px" onchange="sumar_p()"></td>
                </tr>
                
            </table>
        </form>
      </div>
      <div class="modal-footer">
          Porcentaje:<input type="text" class="form-control"  id="tp" value="<?php echo $tp ?>" style="width: 60px">%
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update_costo_por_item()">Actualizar Costos</button>
      </div>
    </div>
  </div>
</div>