<?php
session_start();
include '../modelo/conexioni.php';
if(isset($_SESSION['k_username'])){
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
        <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
        <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
        <script src="../js/ajax.js" type="text/javascript"></script>
        <link rel="stylesheet" href="../vistas/ventas/estilo.css">
        <script src="../vistas/ventas/funciones.js" type="text/javascript"></script>
          <script>
  $( function() {
    $( document ).tooltip();
  } );
  </script>
    </head>
    <body <?php if(isset($_GET['c'])){echo 'onload="cargar_cotizacion('.$_GET['c'].')"';} ?>>
        <fieldset>
            <legend>Datos Básicos</legend>
             Id:<input type="text" id="idcot" disabled value="" style="width: 60px" > | 
             Estado:<input type="text" id="est" value="" style="width: 120px" disabled>
             <span id="red"> </span> | Columnas de <input type="number" id="columnas" value="12" style="width: 30px;height:18px">   
                <button onclick="imprimir();" id="imprimir"><img src="../imagenes/imp.png" style="width: 15px"> Imprimir </button> |
        <table>
            <tr>
                <td colspan="8"><center><b>Cotizacion de productos</b></center> 
            <div style="float: left">
                <button onclick="generar();" id="guardar" disabled><img src="../imagenes/disquete.png"> Guardar y Congelar </button>
                <button onclick="nuevo();"><img src="../imagenes/nuevocontacto.png"> Nuevo </button>
          
                
                <button onclick="window.close()"><img src="../imagenes/stop.png"> Salir </button>
               
            </div>
        </td>
            </tr>
            <tr>
               
                <td>Cedula/NIT:<input type="hidden" id="idc" value="" style="width:20px;"></td>
                <td><input type="text" id="doc" value="" autofocus class="input1"> <button id="sear" onclick="terceros();"><img src="../imagenes/buscar.png"  style="cursor:pointer;width: 15px;"></button></td>
                <td>Departamento</td>
                <td><select name="departamento" id="dep">    
                    <?php 
                        echo "<option value=''>..Seleccione </option>"; 
                        $consulta= "SELECT * FROM `departamentos` group by nombre_dep";   
                        $result=  mysqli_query($con,$consulta); 
                        while($fila=  mysqli_fetch_array($result)){       
                        $valor1=$fila['cod_dep'];  
                        $valor2=$fila['nombre_dep'];   
                        echo"<option value='".$valor2."'>".$valor2."</option>";   
                        }                                                       
                    ?>       
    </select></td>
                <td>Desc Max:</td>
                <?php  if($_SESSION['admin']=='Si'){ $mx = 'text'; }else{ $mx = 'hidden'; } ?>
                <td><input type="text" id="max" value="" style="width: 60px" disabled> 
                    <button onclick="buscar_ced();"><img src="../imagenes/up.png"></button>
                    <?php  if($_SESSION['admin']=='Si'){ ?>
                    <button onclick="update_ced();"><img src="../imagenes/add.png" width="15px"></button>
                    <?php } ?>
                </td>
                <td>Cotizacion No.</td>
                <td><input type="text" id="cot" value="" style="width:80px" disabled>-<input type="text" id="ver" value="" style="width:40px" disabled></td>
                <td>Vendedor
            </tr>
            <tr>
                <td>Nombre del Cliente</td>
                <td><input type="text" id="cli" value=""></td>
                <td>Ciudad</td>
                <td><input type="text" id="ciu" value="" class="input2"></td>
                <td>Servicio Express</td>
                <td><select id="ser"  class="input3">
                        <option value=""></option>
                        <option value="1">Si</option>
                        <option value="0">No</option>
                    </select>
                </td>
                <td>Analista</td>
                <td><input type="text" id="ana" value="<?php echo $_SESSION['k_username']; ?>" class="input3" disabled>
                <td><input type="text" id="ase" onclick="window.open('../vistas/asesor.php','Buscar','width=800, height=800');" value="<?php echo $_SESSION['k_username']; ?>" class="input3" placeholder="Analista"></td>
                
            </tr>
            <tr>
                <td>Direccion:</td>
                <td><input type="text" id="dir" value=""></td>
                <td>Forma de Pago:</td>
                <td><input type="text" id="pag" value=""  class="input1"></td>
                <td>Fecha de Registro</td>
                <td><input type="date" id="reg" value="<?php echo date("Y-m-d"); ?>" class="input3" disabled></td>
                <td>Fecha de Entrega</td>
                <td><input type="date" id="ent" value="" class="input3"></td>
               
            </tr>
            <tr>
                <td>Telefonos</td>
                <td><input type="text" id="tel" value=""></td>
                <td>Nombre de la Obra</td>
                <td colspan="5"><input type="text" id="obra" value="" style="width:100%"></td>
               
            </tr>
                 <tr>
                <td>Observaciones</td>
                
               <td colspan="7"><textarea id="obs" style="width: 98%"></textarea></td>
               <td><button id="continuar" disabled onclick="generar();"><img src="../imagenes/ok.png" > Continuar </button></td>
            </tr>
        </table>
            </fieldset>
        <hr>
        <fieldset>
            <legend>Items Cotizados</legend>
            Pelicula Protectora:<select id="pel">
                <option value="No Aplica">No Aplica</option>
                <option value="Una Cara">Una Cara</option>
                <option value="Doble Cara">Doble Cara</option>
            </select>
            Instalacion:<select id="ins">
                <option value="No">No</option>
                <option value="Si">Si</option>
               
            </select> 
            <button type="button" id="porcentaje" onclick="porcentajes_ventas();"><img src="../imagenes/edit_precio.png" width="15px"> Editar Porcentajes</button>
            <button type="button" id="lista" onclick="listado();"><img src="../imagenes/calcular.png" width="15px"> Lista de precios</button> <button onclick="saveitem();" <?php echo $di; ?> id="acte" ><img src="../imagenes/cambiar.png" width="15px"> Guardar Cambios de Items</button>
<!--            <button onclick="pre();">up</button>-->
            <div  class="datagrid">
                <div id="myWorkContent">
                <table>
                <thead>
                <tr>
                    <th>Item</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th width="120px">Color y Espesor</th>
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
                    <th>Opciones</th>
                </tr>
                </thead>
                <tr id="formulario">
                    <input type="hidden" id="ajuste"  style="width: 70px" disabled>
                    <input type="hidden" id="p4"  style="width: 70px" disabled>
                    <input type="hidden" id="p5"  style="width: 70px" disabled>
                    <input type="hidden" id="p6"  style="width: 70px" disabled>
                    <input type="hidden" id="p7"  style="width: 70px" disabled>
                    <td><input type="hidden" id="hoja" class="input6"><button onclick="referencias();"><img src='../imagenes/buscar.png'></button></td>
                    <td><input type="hidden" id="idp" class="input6">
                        <input type="text" id="cod" class="input6"></td>
                    <td><input type="text" id="des" style="width: 150px" disabled title=""></td>
                    <td><div id="vidrios">
                        <input type="hidden" id="idv" style="width: 120px">
                        <input type="text" id="vid" style="width: 80px">

                        <input type="hidden" id="idvh2" style="width: 120px">
                        <input type="hidden" id="vidh2" style="width: 80px">

                        <input type="hidden" id="idvh3" style="width: 120px">
                        <input type="hidden" id="vidh3" style="width: 80px">
    
                        <input type="hidden" id="idvh4" style="width: 120px">
                        <input type="hidden" id="vidh4" style="width: 80px">
                        </div>
                    </td>
                    <td><input type="text" id="ancho" style="width: 40px"></td>
                    <td><input type="text" id="alto" style="width: 40px"></td>
                    
                    <td><input type="number" id="per" style="width: 25px" disabled></td>
                    <td><input type="number" id="boq" style="width: 25px" disabled></td>
                    <td><input type="number" id="cant" class="input6"></td>
                    
                    <td><input type="hidden" id="preund"  style="width: 60px" disabled>
                    <input type="text" id="preund_desc"  style="width: 60px" disabled></td>
                    <td><input type="hidden" id="pretotal"  style="width: 60px" disabled>
                    <input type="text" id="pretotal_desc"  style="width: 60px" disabled></td>
                    <td><input type="text" id="piva" placeholder=""  style="width: 60px" disabled>
                    <input type="hidden" id="pivaOut" placeholder="Precio" style="width: 60px" disabled></td>
                    <td><input type="number" id="desc" style="width: 35px" maxlength="3" value="0"></td>
                    <td><input type="text" id="ubc" style="width: 50px" value=""></td>
                    <td><input type="text" id="obse" style="width: 50px" value=""></td>
                    <td><input type="text" id="rep" style="width: 20px" value="1"></td>
                    <td> <div id="boton"><button onclick="agregar_item();" id="bot" disabled>Agregar</button></div></td>
                    
                </tr>
                <tbody id="mostrar_lineas">
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
                     </tr>
                </tbody>
            </table>
                </div></div>
        </fieldset>

    </body>
</html>
<?php } ?>