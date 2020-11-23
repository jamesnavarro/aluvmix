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
        <script src="../vistas/presupuestos/ventas/funciones.js" type="text/javascript"></script>

        <div class="bordes">
        <fieldset>
            <table class="table  table-bordered table-hover">
                   <tr>
                <td colspan="8"><center></center> 
            <div style="float: left">
                <button onclick="generar();" id="guardar" disabled><img src="../images/disquete.png"> Guardar </button>
                <button onclick="nueva_cotizacion();"><img src="../images/nuevocontacto.png"> Nuevo </button>
                <!--<button onclick=""><img src="../imagenes/cancelar.png"> Cancelar </button>-->
               <button onclick="imprimir();" id="imprimir"><img src="../imagenes/imp.png" style="width: 15px"> Imprimir </button>
               <button onclick="upimg();" id="ediimg"><img src="../images/icn_video.png" style="width: 15px"> Editar Imagen </button>
               
               <button onclick="mostrar_desglose();"> ? </button> |
                
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
<td><input type="text" id="doc" value="" autofocus class="input1"> </td>
<td>Departamento</td>
<td><select name="departamento" id="dep">    
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
<td><input type="text" id="cli" value=""></td>
<td>Ciudad</td>
<td><input type="text" id="ciu" value="" class="input2"></td>
<td nowrap>Servicio Express</td>
<td><select id="ser"  class="input3">
<option value=""></option>
<option value="1">Si</option>
<option value="0">No</option>
</select>
</td>



</tr>
<tr>
<td>Direccion:</td>
<td><input type="text" id="dir" value=""></td>
<td nowrap>Forma de Pago:</td>
<td><input type="text" id="pag" value=""  class="input1"></td>
</tr>
<tr>
<td>Telefonos</td>
<td><input type="text" id="tel" value=""></td>
<td nowrap>Nombre de la Obra</td>
<td colspan="5"><input type="text" id="obra" value="" style="width:100%"></td>

</tr>
<tr>
<td nowrap>Fecha de Registro</td>
<td><input type="date" id="reg" value="<?php echo date("Y-m-d"); ?>" class="input3" disabled></td>
<td nowrap>Fecha de Entrega</td>
<td><input type="date" id="ent" value="" class="input3"></td>
</tr>


<tr>
    <td>Observaciones <button onclick="comentarios()">?</button></td>

<td colspan="6"><textarea id="obs" style="width: 100%"></textarea></td>

</tr>
<tr>
<td>Vendedor</td>
<td><input type="text" id="ase" onclick="window.open('../popup/usuarios/','Buscar','width=800, height=800');" value="<?php echo $_SESSION['k_username']; ?>" class="input3" placeholder="Analista"></td>
<td>Analista</td>
<td><input type="text" id="ana" value="<?php echo $_SESSION['k_username']; ?>" class="input3" disabled>
<td><button id="continuar" disabled onclick="generar();"><img src="../images/ok.png" > Continuar </button></td>
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
                  
            Pelicula Protectora:<select id="pel">
                <option value="No Aplica">No Aplica</option>
                <option value="Una Cara">Una Cara</option>
                <option value="Doble Cara">Doble Cara</option>
            </select>
            Instalacion:<select id="ins">
                <option value="No">No</option>
                <option value="Si">Si</option>
               
            </select> 
           
            <button type="button" id="lista" data-toggle="modal" data-target="#modalplanilla" onclick="validar_vidrios();"><img src="../imagenes/calcular.png" width="15px"> Porcentajes de Desperdicio</button>
            <button type="button" id="lista" onclick="planilla_total();"><img src="../imagenes/calcular.png" width="15px"> Planilla de Costo </button>
            <select id="flinea">
                <?php
                                                 $lineas = mysqli_query($con, "select * from linea");
                                                 while($l = mysqli_fetch_array($lineas)){
                                                     echo '<option value="'.$l[1].'">'.$l[1].'</option>';
                                                 }
                                                 ?>
            </select> <button id="agregar_item" onclick="pre_cotizar('')">Agregar Items</button>
<!--            <button onclick="pre();">up</button>-->
<b>IVA</b><select id="iva" onchange="camiva()">
                <option value="19">19</option>
                <option value="16">16</option>
                <option value="0">0</option>
            </select>
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
                    <th>REP.</th>
                    <th>COPIAR</th>
                    <th>EDIT</th>
                    <th>BORRAR</th>
                   
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
              <button class="btn btn-primary" type="button" id="add_mat" onclick=" limpiaraccesorios();">+ Agregar Accesorios</button> 
              <button class="btn btn-primary" type="button" id="add_per" onclick="limpiarperfiles();">+ Agregar Perfil</button>
              <button class="btn btn-primary" type="button" id="add_ser" onclick="limpiarservicios();">+ Agregar Servicio</button>
              <button type="button" onclick="actual()"  class="btn btn-success"><i class="ace-icon fa fa-refresh"></i></button>
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
<div class="modal fade" id="modalplanilla" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Configuracion de Porcentajes</h5>
        <span id="mensajes"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
        <div>
            <table width="100%">
                
                <tr>
                    <td><label>Desp. de Vidrio: %</label></td>
                    <td><input type="text" class="form-control" id="desperdicio" value="<?php echo $p[0] ?>" style="width: 60px"></td>
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
                    <td><input type="text" class="form-control"  id="utilidad" value="10" style="width: 60px" onchange="sumar_p()"></td>
                </tr>
                
            </table>
        </div>
      </div>
      <div class="modal-footer">
          Porcentaje:<input type="text" class="form-control"  id="tp" value="<?php echo $tp ?>" style="width: 60px">%
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="update_costo(1);update_costo_general()">Actualizar Costos</button>
      </div>
    </div>
  </div>
</div>
        
        <div class="modal fade" id="modalproductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Venta Directa de Accesorios</h5>
        <span id="mensajes"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
       
            <div class="form-row">
            <div class="form-group col-md-3">
                <label>Codigo</label>
                <input type="hidden" id="mat_id" value="" class="form-control"/>
                <input type="text" id="mat_cod" value="" class="form-control" onclick="open_material()"/>
            </div>
                <div class="form-group col-md-7">
                <label>Descripcion</label>
                <input type="text" id="mat_desc" value="" class="form-control" disabled/>
            </div>
                <div class="form-group col-md-2">
                <label>Color</label>
                <input type="text" id="mat_col" value="" class="form-control" disabled/>
            </div>
                
            </div>
          <div class="form-row">
           
                <div class="form-group col-md-3">
                <label>Cantidad</label>
                <input type="text" id="mat_can" value="" class="form-control"/>
            </div>
               <div class="form-group col-md-3">
                <label>Medida</label>
                <input type="text" id="mat_med" value="1" class="form-control"/>
            </div>
               <div class="form-group col-md-3">
                <label>Descuento</label>
                <input type="text" id="mat_des" value="0" class="form-control"/>
            </div>
              <div class="form-group col-md-3">
                <label>Utilidad</label>
                <input type="text" id="mat_uti" value="10" class="form-control"/>
            </div>
             
            </div>
          <div class="form-row">
               <div class="form-group col-md-3">
                <label>Costo Unidad</label>
                <input type="text" id="mat_val" value="" class="form-control" disabled/>
            </div>
              <div class="form-group col-md-3">
                <label>Costo Total</label>
                <input type="text" id="mat_valt" value="" class="form-control" disabled/>
            </div>
              <div class="form-group col-md-3">
                <label>Total + Desp</label>
                <input type="text" id="mat_td" value="" class="form-control" disabled/>
            </div>
              <div class="form-group col-md-3">
                <label>Precio Neto</label>
                <input type="text" id="mat_pt" value="" class="form-control" disabled/>
            </div>
          </div>
           <div class="form-row">
            <div class="form-group col-md-3">
                <label>Linea</label>
                <select id="mat_linea" class="form-control" onchange="desperdicio()">
              
                    <?php
                    $desp2 = mysqli_query($con,"select * from porcentajes where nombre in ('Accesorios') ");
                    $f = mysqli_fetch_array($desp2);
                        echo '<option value="'.$f['nombre'].'">'.$f['nombre'].'</option>';
                    
                    
                    ?>
                </select>
            </div>
                <div class="form-group col-md-3">
                <label>Desperdicio de</label>
                <input type="text" id="mat_desp" value="<?php echo $f['porc_desp'] ?>" class="form-control" disabled/>
            </div>
            <div class="form-group col-md-3">
                <label>Costos Fijos</label>
                <input type="text" id="mat_cf" value="35.268" class="form-control" disabled/>
            </div>
               <div class="form-group col-md-3">
                   <label><b>Precio Total $/.</b></label>
                <input type="text" id="mat_gt" value="" class="form-control" disabled/>
            </div>
            
           
                
            </div>
          
          <div class="form-group">
              
              <textarea id="mat_obs" class="form-control" placeholder="Observaciones"></textarea>
          </div>
          <div class="form-group">
                <label>Agregarlo al Items</label>
                <select id="mat_items" class="form-control">
                    <option value="">Seleccione</option>
                    <?php
                    $desp3 = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$_GET['c']." and estado='Guardado' and id_cot_principal=0  ");
                    while($f = mysqli_fetch_array($desp3)){
                        echo '<option value="'.$f['id_cot_item'].'">'.$f['item'].' | '.$f['descripcion_principal'].' '.$f['ancho'].'x'.$f['alto'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>
      </div>
      <div class="modal-footer">
          <button onclick="planilla2()" class="btn btn-success"> P</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saventa" onclick="add_producto()" disabled>Agregar Producto</button>
      </div>
    </div>
  </div>
</div>
        
        <div class="modal fade" id="modalperfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Venta Directa de Perfiles</h5>
        <span id="mensajes"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
       
            <div class="form-row">
            <div class="form-group col-md-3">
                <label>Codigo</label>
                <input type="hidden" id="mat_id2" value="" class="form-control"/>
                <input type="text" id="mat_cod2" value="" class="form-control" onclick="open_material2()"/>
            </div>
                <div class="form-group col-md-6">
                <label>Descripcion</label>
                <input type="text" id="mat_desc2" value="" class="form-control" disabled/>
            </div>
                <div class="form-group col-md-3">
                <label>Color</label>
              
                <select id="mat_col2"  class="form-control">
                                 <option value="">Seleccione el color</option>
                                 <?php
                                 $result = mysqli_query($con, "select color_a from tipo_aluminio order by color_a asc");
                                 while($r = mysqli_fetch_array($result)){
                                     echo '<option value="'.$r[0].'">'.$r[0].'</option>';
                                 }
                                 ?>
                             </select>
                
            </div>
                
            </div>
          <div class="form-row">
           
                <div class="form-group col-md-3">
                <label>Cantidad</label>
                <input type="text" id="mat_can2" value="" class="form-control"/>
            </div>
               <div class="form-group col-md-3">
                <label>Medida (mm)</label>
                <input type="text" id="mat_med2" value="1" class="form-control"/>
            </div>
               <div class="form-group col-md-3">
                <label>Descuento</label>
                <input type="text" id="mat_des2" value="0" class="form-control"/>
            </div>
              <div class="form-group col-md-3">
                <label>Utilidad</label>
                <input type="text" id="mat_uti2" value="10" class="form-control"/>
            </div>
             
            </div>
          <div class="form-row">
               <div class="form-group col-md-3">
                <label>Costo Unidad</label>
                <input type="text" id="mat_val2" value="" class="form-control" disabled/>
            </div>
              <div class="form-group col-md-3">
                <label>Costo Total</label>
                <input type="text" id="mat_valt2" value="" class="form-control" disabled/>
            </div>
              <div class="form-group col-md-3">
                <label>Valor acabado</label>
                <input type="text" id="mat_aca" value="" class="form-control" disabled/>
            </div>
              
              <div class="form-group col-md-3">
                <label>Crudo + Acabado</label>
                <input type="text" id="mat_pt2" value="" class="form-control" disabled/>
            </div>
          </div>
           <div class="form-row">
            <div class="form-group col-md-3">
                <label>Linea</label>
                <select id="mat_linea2" class="form-control" onchange="desperdicio()">
              
                    <?php
                    $desp3 = mysqli_query($con,"select * from porcentajes where nombre in ('Aluminio') ");
                    $fs = mysqli_fetch_array($desp3);
                        echo '<option value="'.$fs['nombre'].'">'.$fs['nombre'].'</option>';
                    ?>
                </select>
            </div>
                <div class="form-group col-md-3">
                <label>Desperdicio de</label>
                <input type="text" id="mat_desp2" value="<?php echo $fs['porc_desp'] ?>" class="form-control" disabled/>
            </div>
            <div class="form-group col-md-3">
                <label>Total + Desp</label>
                <input type="text" id="mat_td2" value="" class="form-control" disabled/>
            </div>
               <div class="form-group col-md-3">
                   <label><b>Precio Total $/.</b></label>
                <input type="text" id="mat_gt2" value="" class="form-control" disabled/>
            </div>
            
           
                
            </div>
          
          <div class="form-group">
              
              <textarea id="mat_obs2" class="form-control" placeholder="Observaciones"></textarea>
          </div>
          <div class="form-group">
                <label>Agregarlo al Items</label>
                <select id="mat_items2" class="form-control">
                    <option value="">Seleccione</option>
                    <?php
                    $desp4 = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$_GET['c']." and estado='Guardado' and id_cot_principal=0  ");
                    while($f = mysqli_fetch_array($desp4)){
                        echo '<option value="'.$f['id_cot_item'].'">'.$f['item'].' | '.$f['descripcion_principal'].' '.$f['ancho'].'x'.$f['alto'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>
      </div>
      <div class="modal-footer">
          <button onclick="planilla3()" class="btn btn-success"> P</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saventa2" onclick="add_producto2()" disabled>Agregar Producto</button>
      </div>
    </div>
  </div>
</div>
        
        <div class="modal fade" id="modalservicios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Venta de Servicios</h5>
        <span id="mensajes"></span>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
     
       
            <div class="form-row">
            <div class="form-group col-md-3">
                <button type="button" onclick="open_servicios()"><i class="ace-icon glyphicon glyphicon-search"></i> Codigo</button>
                <input type="hidden" id="mat_id3" value="" class="form-control"/>
                <input type="text" id="mat_cod3" value="" class="form-control" />
            </div>
                <div class="form-group col-md-5">
                <label>Descripcion</label>
                <input type="text" id="mat_desc3" value="" class="form-control" />
            </div>
                <div class="form-group col-md-2">
                <label>Valor</label>
                <input type="text" id="mat_precio" value="" class="form-control"/>
            </div>
                <div class="form-group col-md-2">
                <label>Codigo Producto</label>
                <input type="text" id="mat_pro" value="" class="form-control"/>
            </div>
                
            </div>
          <div class="form-row">
           
                <div class="form-group col-md-2">
                <label>Cantidad</label>
                <input type="text" id="mat_can3" value="" class="form-control" onchange="calcular_servicios()"/>
            </div>
               <div class="form-group col-md-2">
                <label>Parafiscales</label>
                <input type="text" id="mat_par" value="44.79" class="form-control" disabled/>
            </div>
               <div class="form-group col-md-2">
                <label>Descuento</label>
                <input type="text" id="mat_des3" value="0" class="form-control" onchange="calcular_servicios()"/>
            </div>
              
               <div class="form-group col-md-3">
                <label>Costo Unidad</label>
                <input type="text" id="mat_val3" value="" class="form-control" disabled/>
            </div>
              <div class="form-group col-md-3">
                <label>Costo Total</label>
                <input type="text" id="mat_valt3" value="" class="form-control" disabled/>
            </div>
             
            </div>

      
          
          <div class="form-group">
              
              <textarea id="mat_obs3" class="form-control" placeholder="Observaciones"></textarea>
          </div>
          <div class="form-group">
                <label>Agregarlo al Items</label>
                <select id="mat_items3" class="form-control">
                    <option value="">Seleccione</option>
                    <?php
                    $desp4 = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$_GET['c']." and estado='Guardado' and id_cot_principal=0  ");
                    while($f = mysqli_fetch_array($desp4)){
                        echo '<option value="'.$f['id_cot_item'].'">'.$f['item'].' | '.$f['descripcion_principal'].' '.$f['ancho'].'x'.$f['alto'].'</option>';
                    }
                    
                    ?>
                </select>
            </div>
      </div>
      <div class="modal-footer">

        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="saventa3" onclick="add_producto3()" disabled>Guardar</button>
      </div>
    </div>
  </div>
</div>
     <div id="ModalCom" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Comentarios del Items <input type="text" id="it" disabled>
            <input type="hidden" id="idcoti"></h4>
      </div>
      <div class="modal-body">
        <table  width="100%">
            <tr>
                <td style="width:100%"><textarea id="com" style="width:100%"  rows=5></textarea></td>
            </tr>
            <tr> 
                 <td><button type="button" class="btn btn-info btn-lg" onclick="salvar_com(1);">Agregar</button></td>
            </tr>
             <tbody id="ver_com">
                
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <div id="modalcomentarios" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Texto para las observaciones</h4>
      </div>
      <div class="modal-body">
        <table  width="100%">
            <tr>
                <td style="width:300px"><textarea id="text_1"  rows=5></textarea></td>
                <td><button type="button" class="btn btn-info btn-lg" onclick="salvar();">Agregar</button></td>
            </tr>
            <tbody id="ver_texto">
                
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<?php } ?>