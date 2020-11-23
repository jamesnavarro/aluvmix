<?php
session_start();
include '../../../modelo/conexioni.php';
if(isset($_SESSION['k_username'])){
    $desp = mysqli_query($con,"select porc_desp,porc_venta from porcentajes ");
    $p = array();
while($d = mysqli_fetch_row($desp)){
    $p[] = $d[0];
}
?>
        <script src="../vistas/planeacion/ventas/funciones.js" type="text/javascript"></script>

        <div class="bordes">
        <fieldset>
            <table class="table  table-bordered table-hover">
                   <tr>
                <td colspan="8"><center></center> 
            <div style="float: left">
                <span id="aprobar"><button onclick="generar_aprobar();" id="guardar_aprobar" ><img src="../images/autorizacion.png"> Aprobar Cotizacion </button></span>
                <span id="pedido"><button onclick="generar_orden_produccion();" id="guardar_pedido" ><img src="../images/orden_produccion.png"> Generar orden de Produccion </button></span>
                <!--<button onclick=""><img src="../imagenes/cancelar.png"> Cancelar </button>-->
               <button onclick="imprimir();" id="imprimir"><img src="../imagenes/imp.png" style="width: 15px"> Imprimir </button>
               <button onclick="mostrar_desglose();"> ? </button> |
               <span id="num_ped"></span>
            </div><br>
            <div style="float: right;background-color: white;" id="msg"><b>NO HAY REGISTROS</b></div>
        </td>
            </tr>
            </table>
             <div id="accordion" class="accordion-style1 panel-group">
        <div class="panel panel-default">
                <div class="panel-heading">
                        <h4 class="panel-title">
                                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                        <i class="ace-icon fa fa-angle-down bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
                                        &nbsp;Datos Basicos de Cotizacion
                                </a>
                        </h4>
                </div>

                <div class="panel-collapse collapse in" id="collapseOne">
                        <div class="panel-body">
                                 <table id="simple-table" class="table  table-bordered table-hover bg-info">

<tr>
<td colspan="4">
Id: &nbsp; <input type="text" id="idcot" disabled value="" style="width: 60px" > | 
Estado: &nbsp; <input type="text" id="est" value="" style="width: 120px" disabled>
<span id="red"> </span> | Columnas de &nbsp; <input type="number" id="columnas" value="12" style="width: 50px;height:18px">   
<td nowrap><b>Cotizacion No</b></td>
<td nowrap><input type="text" id="cot" value="" style="width:80px" disabled>-<input type="text" id="ver" value="" style="width:40px" disabled></td>

</td>
</tr>
<tr>

<td>Cedula / NIT: <button id="sear" onclick="terceros();"><img src="../imagenes/buscar.png"  style="cursor:pointer;width: 15px;"></button><input type="hidden" id="idc" value="" style="width:20px;"></td>
<td><input type="text" id="doc" value="" autofocus class="input1" disabled> </td>
<td>Departamento</td>
<td><select name="departamento" id="dep" disabled>    
<?php 
echo "<option value=''>..Seleccione </option>"; 
$consulta= "SELECT * FROM `departamentos` group by nombre_dep";   
$result=  mysqli_query($con, $consulta); 
while($fila=  mysqli_fetch_array($result)){       
$valor1=$fila['cod_dep'];  
$valor2=$fila['nombre_dep'];   
echo"<option value='".$valor2."'>".$valor2."</option>";   
}                                                       
?>       
</select>
</td>
<td nowrap>Desc Max:</td>
<?php  if($_SESSION['admin']=='Si'){ $mx = 'text'; }else{ $mx = 'hidden'; } ?>


<td><input type="text" id="max" value="" style="width: 60px" disabled> 
<button onclick="buscar_ced();"><img src="../imagenes/up.png"></button>
<?php  if($_SESSION['admin']=='Si'){ ?>
<button onclick="update_ced();"><img src="../imagenes/add.png" width="15px"></button>
<?php } ?>
</td>


</tr>
<tr>
<td nowrap>Nombre del Cliente</td>
<td><input type="text" id="cli" value="" disabled></td>
<td>Ciudad</td>
<td><input type="text" id="ciu" value="" class="input2" disabled></td>
<td nowrap>Servicio Express</td>
<td><select id="ser"  class="input3" disabled>
<option value=""></option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
</td>



</tr>
<tr>
<td>Direccion:</td>
<td><input type="text" id="dir" value="" disabled></td>
<td nowrap>Forma de Pago:</td>
<td><input type="text" id="pag" value=""  class="input1" disabled> </td>
</tr>
<tr>
<td>Telefonos</td>
<td><input type="text" id="tel" value="" disabled></td>
<td nowrap>Nombre de la Obra</td>
<td colspan="5"><input type="text" id="obra" value="" style="width:100%" disabled></td>

</tr>
<tr>
<td nowrap>Fecha de Registro</td>
<td><input type="date" id="reg" value="<?php echo date("Y-m-d"); ?>" class="input3" disabled></td>
<td nowrap>Fecha de Entrega</td>
<td><input type="date" id="ent" value="" class="input3" disabled></td>
</tr>


<tr>
<td>Observaciones</td>

<td colspan="6"><textarea id="obs" style="width: 100%" disabled></textarea></td>

</tr>
<tr>
<td>Vendedor</td>
<td><input type="text" id="ase" onclick="window.open('../popup/usuarios/','Buscar','width=800, height=800');" value="<?php echo $_SESSION['k_username']; ?>" class="input3" placeholder="Analista" disabled></td>
<td>Analista</td>
<td><input type="text" id="ana" value="<?php echo $_SESSION['k_username']; ?>" class="input3" disabled>
<td></td>
<td colspan="5"> </td>
</table>
                        </div>
                </div>
        </div>

										</div>
       
                <div id="msj"></div>
            </fieldset>
     
        <fieldset>
            <legend>ITEMS COTIZADOS</legend>
                  
          
<BR><DIV></DIV>
<br>
<div  class="datagrid">
    <div id="myWorkContent" class="table-reponsive">
                <table style="width:100%; border-color: #EADBDF;font-size: 10px"  border="1">
                    <tr class="bg-info">
                    <th>ITEM</th>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>VIDRIO.</th>
                    <th>ANCHO</th>
                    <th>ALTO</th>
                    
           
                    <th>CANT</th>
                    <th>PRECIO UNID</th>
                    <th>PRECIO TOTAL</th>
                    <th>TOTAL+IVA</th>
                    <th>(%)</th>
                    <th>UBC.</th>
                    <th>OBS.</th>
                    <th>VER.</th>
           
                   
                </tr>
               
                <tbody id="mostrar_lineas">
                    <tr>
                     <td><input type="text" id="ct" style="width: 40px" value="0" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                   
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
                     <td><input type="text" id="" style="width: 40px" value="" disabled></td>
  
                   </tr>
                </tbody>
            </table>
                </div></div>
        </fieldset>
            <br>
          <fieldset> 
              <legend>VENTA DIRECTA DE PERFILES Y ACCESORIOS
                  
              </legend>
             <div  class="datagrid">
               <div class="table-responsive">
                <table class="table" style="width:100%" >
                   <tr class="bg-info">
                       <th>ITEM</th>
                       <th>CODIGO</th>
                       <th>DESCRIPCION</th>
                       <th>COLOR</th>
                       <th>MEDIDA</th>
                       <th>CANT</th>
                       <th>PREC UND</th>
                       <th>SUBTOTAL</th>
                       <th>OPCIONES</th>
                      </tr>

                <tbody id="mostrar_ventas">
                    <tr>
                        <th><input type="text" id="ctvd" style="width: 40px" value="0" disabled></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                   </tr>
                </tbody>
            </table>
                   <table class="table" style="width:100%" >
                   <tr class="bg-info">
                       <th>ITEM</th>
                       <th>CODIGO</th>
                       <th>DESCRIPCION</th>
                       <th>COD. RELACION</th>
                       <th>VALOR UND</th>
                       <th>CANT</th>
                       <th>PREC UND</th>
                       <th>SUBTOTAL</th>
                       <th>OPCIONES</th>
                      </tr>

                <tbody id="mostrar_servicios">
                    <tr>
                        <th><input type="text" id="ctvd" style="width: 40px" value="0" disabled></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                   </tr>
                </tbody>
            </table>
                </div></div>
        </fieldset>
        </div>
<div class="modal fade" id="modalorden" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Generar Orden de Produccion</h5>
        <span id="mensajes"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div>
            <table width="100%">
                
                <tr>
                    <td><label>Pedido No.</label></td>
                    <td><input type="text" class="form-control" id="pednum" value="" style="width: 150px" disabled></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Orden de Produccion FomPlus</label></td>
                    <td> <input type="text" class="form-control" id="opf" value="" style="width: 150px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Fecha de Orden.</label></td>
                    <td><input type="text" class="form-control" id="fec_ord" disabled value="<?php echo date("Y-m-d H:i:s") ?>" style="width: 150px"></td>
                </tr>
  
            </table>
        </div>
      </div>
      <div class="modal-footer">
         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="generarorden()">Generar Orden</button>
      </div>
    </div>
  </div>
</div>
   
      
<?php } ?>