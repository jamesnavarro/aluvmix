<?php
session_start();
include '../../../modelo/conexioni.php';
if(isset($_SESSION['k_username'])){
    $desp = mysqli_query($con,"select opf from orden_produccion where id_orden='".$_GET['orden']."' ");
$d = mysqli_fetch_row($desp);
    $p[] = $d[0];

?>
        <script src="../vistas/planeacion/ventas/funciones_ordenes.js" type="text/javascript"></script>

        <div class="bordes">
        <fieldset>
            <table class="table  table-bordered table-hover">
                <tr><td><center><b>Orden de Produccion No. <input type="text" value="<?php echo $_GET['orden'] ?>" id="idorden" disabled style="width: 120px">
                    | OPF: <input type="text" value="<?php echo $_GET['opf'] ?>" id="opf" disabled style="width: 120px"></b></center> </td></tr>
                   <tr>
                <td colspan="8">
            <div style="float: left">
                
                <span id="pedido"><button onclick="guardar_ordenes();" id="guardar_orden" ><img src="../images/disquete.png"> Guardar orden de produccion </button></span>
               
               <button onclick="imprimir();" id="imprimir"><img src="../imagenes/imp.png" style="width: 15px"> Imprimir </button>
               
               <button onclick="ver_orden(<?php echo $_GET['orden'] ?>,<?php echo $_GET['c'] ?>);"> Up </button>
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
                <table style="width:100%; border-color: #EADBDF;font-size: 12px"  border="1">
                    <tr class="bg-info">
                    <th>ITEM</th>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>VIDRIO.</th>
                    <th>ANCHO</th>
                    <th>ALTO</th>
                    
           
                    <th>CANT</th>
                    <th>RESTANTE</th>
                    <th>PRECIO UNID</th>
                    <th>PRECIO TOTAL</th>
                    <th>TOTAL+IVA</th>
                    <th>(%)</th>
                    <th>UBC.</th>
                    <th>OBS.</th>
                    <th>VER.</th>
           
                   
                </tr>
               
                <tbody id="mostrar_lineas">
                    
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
<div class="modal fade" id="modalordenitems" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Items a Produccion</h5>
        <span id="mensajes"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div>
            <div id="otros">

                <div class="tab-content">
                   
                    <div id="vid">
                        <table width="100%" border="1" style="" bordercolor="#E2DEDF">
                            <tr>
                                <td><label>ITEMS.</label></td>
                                <td colspan="4"><input type="text" class="form-control" id="f_item" value="" style="width: 100%"></td>
                             </tr> 
                            <tr>
                                <td><label>Ubi.</label></td>
                                <td colspan="4"><input type="text" class="form-control" id="f_ubi" value="" style="width: 100%"></td>
                             </tr>
                             <tr>
                                <td><label>Obs.</label></td>
                                <td colspan="4"><input type="text" class="form-control" id="f_obs" value="" style="width: 100%" ></td>
                             </tr>
                             <tr>
                                <td><label>Producto Principal</label></td>
                                <td colspan="4"><input type="text" class="form-control" id="f_pri" value="" style="width: 100%" ></td>
                             </tr>
                            <tr>
                                <th>Items</th>
                                <th>Descripcion del producto</th>
                                <th>Ancho - Ancho Arriba</th>
                                <th>Alto  - Alto Arriba</th>
                                <th nowrap>Restante</th>
                                <th>Cantidad</th>
                                <th>Agregar</th>
                            </tr>
                            <tbody id="desglose_vidrio">
                                
                            </tbody>
                        </table>
                        
                    </div>
                  </div>
                </div>
           
        </div>
      </div>
      <div class="modal-footer">
         
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onclick="agregaritems()">Agregar Item</button>
      </div>
    </div>
  </div>
</div>
   
      
<?php } ?>