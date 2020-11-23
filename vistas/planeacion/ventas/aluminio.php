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
<!--                        <link href="../../../css/estilo.css" rel="stylesheet">-->
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
                <link rel="stylesheet" href="stilo.css" />

        <script src="funciones_aluminio.js" type="text/javascript"></script>
        <style>
    .content-box-blue {
        padding-left: 10px;
        background-color: #d8ecf7;
        border: 1px solid #afcde3;
        height: 200px;
        width: 200px;
}
</style>
    </head>
    <body class="bordes" onload="DatosBasicos();openCity(event, 'Formulario')">
        <div class="tab">
  <button class="tablinks" onclick="openCity(event, 'Formulario')">Formulario</button>
  <button class="tablinks" onclick="openCity(event, 'dt')" >Descripcion Tecnica</button>
  <button class="tablinks" onclick="openCity(event, 'otros')" >Compuestos ()</button>
  <button onclick="window.opener.DatosBasicos();">*</button>
</div>
        <div id="Formulario" class="tabcontent active">
        <fieldset>
            <legend>Cotizacion No. <input type="text" id="cot" value="" disabled style="width: 100px">
                <input type="hidden" id="idcot" value="" disabled style="width: 100px">
                <button id="save" onclick="totalizar_aluminio();totalizar();congelar_item();">Guardar</button>
                             <button onclick="nuevo_aluminio()">Nuevo</button>
                             <button onclick="window.close();">Salir</button>
                           
            </legend>
            <div class="form-group-sm">
                <table style="width: 100%">
                    <tr>
                        <td><b>Items:</b></td>
                         <td><input type="text" id="item" value="" disabled style="width: 100px"></td>
                         <td></td>
                         <td></td>
                         <td id="label-compuesto"><b>Compuesto</b></td>
                         <td><input type="text" id="compuesto" value="" disabled style="width: 40px"></td>
                         <td colspan="8">
                             <div style="float: left" id="btncompuesto">
                                 <button onclick="AddCompuesto()">Agregar Compuestos</button>
                                 
                             </div>
                             <div style="float: right">
                                 <b>Estado:</b> <input type="text" id="estado" value="" style="width:100px" disabled>
                                 
                             </div>
                             
                         </td>
                         <td rowspan="14" id="">
                             <div id="imagen"  class="content-box-blue">
                          
                          </div>
                             <div style="padding-left:10px;padding-top:10px;padding-right:10px;">
                             <table style="background-color:#d8ecf7">
                                        <tr>
                                            <td><b>Total Costo:</b></td>
                                            <td><input type="text" id="totalcosto" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>SubTotal:</b></td>
                                            <td><input type="text" id="subtotal" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>Descuento </b><span id="descu"></span></td>
                                            <td></span> <input type="text" id="tdescuento" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b>SubTotal 2:</b></td>
                                            <td><input type="text" id="subtotal2" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b></b></td>
                                            <td><input type="hidden" id="iva" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><button onclick="planilla()">P</button> <button onclick="totalizar_aluminio();totalizar()">Total :</button> </td>
                                            <td><input type="text" id="gran_total" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                        <tr>
                                            <td><b> </b></td>
                                            <td><input type="hidden" id="total_planilla" style="width:100px;text-align: right" disabled></td>
                                        </tr>
                                    </table>
                                 </div> 
                         </td>

                     </tr>
                     <tr>
                         <td><b>Linea :</b></td>
                         <td><input type="text" id="linea" value="<?php echo $_GET['linea'] ?>" disabled style="width: 100px"></td>
                         <td><b>Codigo :</b></td>
                         <td><input type="text" id="codigo0" value="" onclick="get_referencias(0);" style="width:100px"></td>
                         <td><b>Descripcion :</b></td>
                         <td colspan="9"> <input type="text" id="descripcion0" value="" style="width:100%" disabled></td>

                     </tr>
                     <tr>
                         <td><b>Ancho Maximo</b></td>
                         <td><input type="text" id="ancho_max" value="" style="width:100px" disabled></td>
                         <td><b>Alto Maximo</b></td>
                         <td><input type="text" id="alto_max" value="" style="width:100px" disabled></td>
                         <td><b>Laminas</b></td>
                         <td><input type="text" id="lam" value="" style="width:50px" disabled></td>
                         <td><b>Perforaciones</b></td>
                         <td><input type="text" id="per" value="" style="width:40px" disabled></td>
                         <td><b>Boquetes</b></td>
                         <td><input type="text" id="boq" value="" style="width:40px" disabled></td>
                         <td><b>Interlayer</b></td>
                         <td><input type="text" id="interlayer" value="" style="width:40px" disabled></td>
                         <td><b>Espaciadores</b></td>
                         <td><input type="text" id="espaciadores" value="" style="width:40px" disabled></td>
                     </tr>
                     <tr>
                         <td><b>Ancho</b></td>
                         <td><input type="text" id="ancho" value="" style="width:100px" onchange="update_costo_por_item()"></td>
                         <td><b>Alto</b></td>
                         <td><input type="text" id="alto" value="" style="width:100px"  onchange="update_costo_por_item()"></td>
                         <td><b>Cantidad</b></td>
                         <td><input type="text" id="cantidad" value="" style="width:50px"  onchange="update_costo_por_item()"></td>
                         <td><b>Pel.Protectora</b></td>
                         <td>
                             <select id="pelicula" style="width:60px">
                                 <option value="No Aplica">No Aplica</option>
                                 <option value="Una Cara">Una Cara</option>
                                 <option value="Dos Cara">Dos Cara</option>
                             </select>
                         </td>
                         <td><b>Carton</b></td>
                         <td>
                             <select id="carton" style="width:60px">
                                 <option value="No Aplica">No Aplica</option>
                                 <option value="Una Cara">Una Cara</option>
                                 <option value="Dos Cara">Dos Cara</option>
                             </select>
                         </td>
                         <td><b>Descuento</b></td>
                         <td>
                             <input type="text" id="descuento" value="<?php echo $_GET['max'] ?>" style="width:40px" disabled> 
                         </td>
                         
                         <td><b>Tipo</b></td>
                         <td>
                             <input type="text" id="tipos" placeholder="V-01" style="width:60px">
                         </td>
                     </tr>
                     <tr>
                         <td><b>Ancho CF Der.</b></td>
                         <td><input type="text" id="anchocfd" value="" style="width:100px" onchange="update_costo_por_item()" disabled></td>
                         <td><b>Alto CF Sup.</b></td>
                         <td><input type="text" id="altocfs" value="" style="width:100px"  onchange="update_costo_por_item()" disabled></td>
                         <td><b>Modulos</b></td>
                         <td><input type="text" id="modulos" value="" style="width:40px"  disabled></td>
                         <td><b>Perforaciones</b></td>
                         <td><input type="text" id="perforacion" value="" style="width:40px" ></td>
                         <td><b>Boquetes</b></td>
                         <td><input type="text" id="boquetes" value="" style="width:40px" ></td>
                         <td><b>Instalacion</b></td>
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
                         <td><b>Ancho CF Izq. </b></td>
                         <td><input type="text" id="anchocfi" value="" style="width:100px" onchange="update_costo_por_item()" disabled></td>
                         <td><b>Alto CF Inf.</b></td>
                         <td><input type="text" id="altocfi" value="" style="width:100px"  onchange="update_costo_por_item()" disabled></td>
                         <td><b>Rejilla</b></td>
                         <td><input type="text" id="altorej" value="" style="width:50px"  onchange="update_costo_por_item()" disabled></td>
                         <td><b>Color Alum</b></td>
                         <td colspan="4">
                             <select id="color" style="width:200px">
                                 <option value="">Seleccione el color</option>
                                 <?php
                                 $result = mysqli_query($con, "select color_a from tipo_aluminio order by color_a asc");
                                 while($r = mysqli_fetch_array($result)){
                                     echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                 }
                                 ?>
                             </select>
                         </td>
              
                         <td></td>
                         <td></td>
                         <td><input type="hidden" id="cierre" value="" style="width:50px" disabled>
                             <input type="hidden" id="riel" value="" style="width:50px" disabled>
                             <input type="hidden" id="rodaja" value="" style="width:50px" disabled>
                             <input type="hidden" id="alfajia" value="" style="width:50px" disabled>
                         <input type="hidden" id="rejilla" value="" style="width:50px" disabled></td>
                     </tr>
                     <tr>

                         <td><b>Descripcion final</b></td>
                         <td colspan="13">
                             
                             <textarea  id="descripcion_final" style="width:100%"></textarea>
                         </td>
                        
                     </tr>
                     <tr>
                         <td><b>Ubicacion</b></td>
                         <td colspan="3"><input type="text" id="ubicacion" value="" style="width:100%" ></td>
                         <td><b>Observacion</b></td>
                         <td colspan="7"><input type="text" id="observacion" value="" style="width:100%" ></td>
                         <td><b>Laminas</b></td>
                         <td><input type="text" id="laminas" value="1" style="width:40px" ></td>
                     </tr>
                     <tr>
                         <td><b>Rieles</b></td>
                         <td colspan="9">
<!--                             <select id="rieles" style="width:300px">
                                
                                 <option value="0">N/A</option>
                             </select>-->
                             <input type="hidden" id="rieles">
                             <input type="text" id="rieles_new" placeholder="Click aqui" onclick="rieles('rieles')">
                         </td>
                         <td><b>Cod Vid# 1</b></td>
                         <td><input type="text" id="codigo100" value="" style="width:60px" disabled onclick="">
                         <input type="hidden" id="descripcion100" value="" style="width:60px" disabled></td>
                         <td><b>Espesor 1</b></td>
                         <td><input type="text" id="codvidrio100" value="" style="width:60px" disabled onclick="form_vidrio(100)">
                         <input type="hidden" id="desvidrio100" value="" style="width:60px"></td>
                         
                         
                         <tr>
                         <td><b>Alfajias</b></td>
                         <td colspan="9">
<!--                             <select id="alfajias" style="width:300px">
                              
                                 <option value="0">N/A</option>
                             </select>-->
                             <input type="hidden" id="alfajias">
                             <input type="text" id="alfajias_new" placeholder="Click aqui" onclick="alfajias('alfajias')">
                         </td>
                         <td><b>Cod Vid# 2</b></td>
                         <td><input type="text" id="codigo200" value="" style="width:60px" disabled onclick="get_referencias(200);">
                         <input type="hidden" id="descripcion200" value="" style="width:60px" disabled></td>
                         <td><b>Espesor 2</b></td>
                         <td><input type="text" id="codvidrio200" value="" style="width:60px" disabled onclick="form_vidrio(200)">
                         <input type="hidden" id="desvidrio200" value="" style="width:60px"></td>
                         <tr>
                         <td><b>Rejillas</b></td>
                         <td colspan="9">
                             <input type="hidden" id="rejillas">
                             <input type="text" id="rejillas_new" placeholder="Click aqui" onclick="rejillas('rejillas')"> / 
                             <input type="text" id="entre_rej" style="width:50px" disabled> Medida entre rejillas
                         </td>
                         <td><b>Cod Vid# 3</b></td>
                         <td><input type="text" id="codigo300" value="" style="width:60px" disabled onclick="get_referencias(300);">
                         <input type="hidden" id="descripcion300" value="" style="width:60px" disabled></td>
                         <td><b>Espesor 3</b></td>
                         <td><input type="text" id="codvidrio300" value="" style="width:60px" disabled onclick="form_vidrio(300)">
                         <input type="hidden" id="desvidrio300" value="" style="width:60px"></td>
                         <tr>
                         <td><b>Cierres</b></td>
                         <td colspan="9">
                             <input type="hidden" id="cierres">
                             <input type="text" id="cierres_new" placeholder="Click aqui" onclick="cierres('cierres')"> x 
                             <input type="text" id="can_cie" style="width:50px" disabled>
                         </td>
                         <td><b>Cod Vid# 4</b></td>
                         <td><input type="text" id="codigo400" value="" style="width:60px" disabled onclick="get_referencias(400);">
                         <input type="hidden" id="descripcion400" value="" style="width:60px" disabled></td>
                         <td><b>Espesor 4</b></td>
                         <td><input type="text" id="codvidrio400" value="" style="width:60px" disabled onclick="form_vidrio(400)">
                         <input type="hidden" id="desvidrio400" value="" style="width:60px"></td>
                         <tr>
                         <td><b>Rodajas</b></td>
                         <td colspan="9">
                              <input type="hidden" id="rodajas">
                             <input type="text" id="rodajas_new" placeholder="Click aqui" onclick="rodajas('rodajas')"> 
                            
                         </td>
                         <td></td>
                     </tr>
                     <tr>
                         <td><b>Brazos</b></td>
                         <td colspan="9">
                             <input type="hidden" id="brazos">
                             <input type="text" id="brazos_new" placeholder="Click aqui" onclick="brazos('brazos')"> 
                         </td>
                         <td></td>
                     </tr>
                     <tr>
                         <td><b>Bisagras</b></td>
                         <td colspan="9">
                             
                             <input type="hidden" id="bisagras">
                             <input type="text" id="bisagras_new" placeholder="Click aqui" onclick="bisagras('bisagras')"> 
                            x <input type="text" id="can_bis" style="width:50px" disabled>
                             
                         </td>
                         <td></td>
                     </tr>
                 </table>
                
                
            </div>
           
        </fieldset>
       
        <fieldset>
            <legend>Totales</legend>
            <div id="" style="float: right">
                 
            </div>
        </fieldset>
            
            </div>
        <div id="dt" class="tabcontent">
           <fieldset>
            <legend>DT</legend>
               <table id="simple-table" class="table  table-bordered table-hover">
                      <tr>
                           <th style="text-align:center;background: #438EB9" colspan="12">Principales</th>
                      </tr>
                      <tr class="bg-info" align="center">

                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Precio</th>
                      <th>Medida</th>
                      <th>Cant</th>
                      <th>Medida</th>
                      <th>Acabado</th>
                      
                      <th>Crudo.</th>
                      <th>Crudo+Acab.</th>
                      <th>Desp%.</th>
                      <th>Total.</th>
<!--                        <th>Editar</th>
                      <th>Eliminar</th>-->
                 </tr>
                 <tbody id="formperfiles">
                     
                 </tbody>
                 <tr><th  style="text-align:center;background: #438EB9" colspan="12">Rieles</th></tr>
                 <tbody id="formperfiles_riel">
                     
                 </tbody>
                  <tr><th  style="text-align:center;background: #438EB9" colspan="12">Alfajias</th></tr>
                 <tbody id="formperfiles_alfa">
                     
                 </tbody>
               </table> 
             <table id="simple-table" class="table  table-bordered table-hover">
                 <tr><th  style="text-align:center;background: #438EB9" colspan="12">Rejillas</th></tr>
            <tr class="bg-info" align="center">
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Precio</th>
                      <th>Cant. Rejillas</th>
                      <th>Medida</th>
                      
                      <th>Medida T.</th>
                      <th>Acabado</th>
                      <th>Crudo.</th>
                      <th>Crudo+Acab.</th>
                      <th>Desp%.</th>
                      <th>Total.</th>

                 </tr>
                 <tbody id="MostrarRejillas">
                     
                 </tbody>
               </table> 
           <div style="text-align:center;background: #438EB9">Reparto de Vidrios</div>
                   
                <div id="formlaminas">

                </div>
                
            
<!--            insumos *********************** -->
                      <table id="simple-table" class="table  table-bordered table-hover">
                          <tr>
                           <th style="text-align:center;background: #438EB9" colspan="12">Reparto de Materiales</th>
                      </tr>
                 <tr class="bg-info" align="center">
                      <th>Referencia</th>
                      <th>Descripcion</th>
                      <th>Lado</th>
                      <th>Color</th>
                      <th>Cantidad</th>
                       <th>Calculo x</th>
                       <th>Cant. Total</th>
                      <th>Tipo</th>
                      <th>Precio Und</th>
                      <th>Precio Total</th>
                      <th>Desp%</th>
                      <th>G.Total</th>
                 </tr>
                 
            <tbody id="forminsumos">
                
            </tbody
<!--            <tbody id="formrodajas">
                
            </tbody>
            <tbody id="formcierres">
                
            </tbody-->
                      </table>

 <table id="simple-table" class="table  table-bordered table-hover">
       <tr><th  style="text-align:center;background: #438EB9" colspan="9">Mano de Obra</th></tr>
                  <tr class="bg-info" align="center">
             
                      <th>Codigo</th>
                      <th>Descripcion</th>
                      <th>Tipo</th>
                      <th>Calculo por </th>
                      <th>Rango </th>
                      <th>Valor </th>
                      <th>Valor a pagar </th>
                      <th>Parafiscales </th>
                      <th>Total </th>
                 </tr>
                 <tbody id="mostrar_instalacion">
                     
                 </tbody>
               </table>
        </fieldset>
        </div>
        <div id="otros" class="tabcontent">
            <fieldset>
                <legend>LISTA DE COMPUESTOS</legend>
                
                <table style="width:100%">
                <thead>
                <tr bgcolor="#438EB9" border="1">
                    <th>Item</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Ancho</th>
                    <th>Alto</th>
                    <th>Per.</th>
                    <th>Boq.</th>
                    <th>Cant</th>
                    <th>Precio Und</th>
                    <th>Precio Total</th>
                    <th>Total+Iva</th>
                    <th>(%)</th>
                    <th>Ubc.</th>
                    <th>Obs.</th>
                    <th>Rep.</th>
                     <th>Rep</th>
                    <th>Edit</th>
                    <th>Borrar</th>
                   
                </tr>
                </thead>
                <tbody id="mostrar_lineas_comp">
                    <tr>
                    <th><input type="text" id="ct" style="width: 40px" value="0" disabled></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th> </th>
                    <th> </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                </tbody>
            </table>
            </fieldset>
            
        </div>
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
   
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="limpiar_form_extra()">Close</button>
          <button type="button" class="btn btn-danger"  onclick="limpiar_form_extra()">Nuevo</button>
        <button type="button" class="btn btn-primary" onclick="salvar_compuesto()">Guadar Cambios</button>
      </div>
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
<script>
function openCity(evt, cityName) {
    var item = $("#item").val();
    
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>

 <div class="modal" id="modalselect">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Seleccione el items <span id="titu"></span></h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="mostrar_select">
          <p>Cargando datos...</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>