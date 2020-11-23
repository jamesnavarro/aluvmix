<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
            $id=$_GET['id'];
            $query = mysqli_query($con,"select *,a.vendedor from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion  and a.id_inf='$id' ");
            $fila = mysqli_fetch_array($query);
            $p[0]=$fila['id_inf'];
            $p[1]=$fila['nombre_obra'];
            $p[2]=$fila['nom_ter']; 
            $p[3]=$fila['obj_contra'];
            $p[4]=$fila['vendedor'];
            $p[5]=$fila['cor_obra'];
            $p[6]=$fila['sup_obra'];
            $p[7]=$fila['instalacion']; 
            $p[8]=$fila['numero_cotizacion'];
            $p[9]=$fila['valor_cont'];
            $p[10]=$fila['val_antici'];
            $p[11]=$fila['saldo'];
            $p[12]=$fila['for_pag'];
            $p[13]=$fila['otros'];
            $p[14]=$fila['recibe_cont'];
            $p[15]=$fila['num_pedido'];
            $p[16]=$fila['version'];
            $p[17]=$fila['fecha_pago'];
            $p[18]=$fila['observaciones'];
            $p[19]=$fila['estado_cont'];
            $p[20]=$fila['id_ter']; 
            $p[21]=$fila['num_pedido']; 
            $p[22]=$fila['registrado_por']; 
            $p[23]=$fila['fecha_registro_obrac'];
            $p[24]=$fila['limite_pago_c'];
            if(isset($_GET['descargar'])){
            $filename = $_GET['descargar'];
             // Ahora guardamos otra variable con la ruta del archivo
             $file = "../../archivos/".$filename;
             // Aquí, establecemos la cabecera del documento
             header("Content-Description: Descargar imagen");
             header("Content-Disposition: attachment; filename=$filename");
             header("Content-Type: application/force-download");
             header("Content-Length: " . filesize($file));
             header("Content-Transfer-Encoding: binary");
             readfile($file);
              return;
    }
    
?>
<!DOCTYPE html>
<html lang="sp">
    <head>

        <title>Modulo de Cartera</title>
          <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../../../js/jquery.min.js"></script>
        <script src="../../../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/stilo.css">
                <script src="../../../js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
        <script src="funciones.js"></script>
        <script>
            $(document).ready(function(){
               mostrar_documentos(); 
               mostrar_loscontactos();
               mostrar_llamadas();
               mostrar_cotizaciones_cont();
               mostrar_nueva_fact();
            });
            </script>
    </head>
 <body>
   <div class="jumbotron text-center">
  <h1><?php echo $p[1]; ?></h1>
  <p><?php echo $p[2]; ?></p> 
  <P>#CONTRATO <?php echo $p[8]; ?></P>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-6">
        <div class="alert alert-info">
            <strong>Obj. Contrato:</strong><?php echo $p[3]; ?>
        </div>
      <p><b>Vendedor : </b><?php echo $p[4]; ?></p>
      <p><b>Cordinador de Obra:</b> <?php echo $p[5]; ?></p>
      <p><b>Supervisor de Obra:</b> <?php echo $p[6]; ?></p>
      <p><b>Instaladores:</b> <?php echo $p[7]; ?></p>
      <p><b>Registrado por:</b> <?php echo $p[22]; ?></p>
    </div>
    <div class="col-sm-3">
        
      <?php if($p[14]=='CON FIRMA'){ ?>
      <div class="alert alert-success">
            <strong> <?php echo $p[14]; ?> </strong> 
      </div>
      <?php }ELSE{ ?>
      <div class="alert alert-danger">
            <strong> <?php echo $p[14]; ?> </strong> 
      </div>
      
      <?php } ?>
        <p><b>Fecha Registro: </b><?php echo $p[23]; ?></p>
      <p><b>Radicado No.:</b> <input type="text" id="radicado_doc" value="<?php echo $id; ?>" style="width:80px"></p>
      <p><b>Cotizacion No.:</b><?php echo $p[8].'.'.$p[16]; ?></p>
      <p><b>Pedido No.:</b><?php echo $p[21]; ?></p>
    </div>
    <div class="col-sm-3">
        
              <?php if($p[19]=='C'){ ?>
      <div class="alert alert-success">
            <strong> CANCELADO </strong> 
      </div>
      <?php }ELSE{ ?>
      <div class="alert alert-danger">
            <strong> NO CANCELADO </strong> 
      </div>
      <p><b>Fecha Cobro: </b><?php echo $p[17]; ?></p>
      <?php } ?>
        <p><b>Forma Pago: </b><?php echo $p[12]; ?></p>
      <p><b>Valor Total: </b>$ <?php echo number_format($p[9]); ?></p>
      <p><b>Anticipo ...:</b> $ <?php echo number_format($p[10]); ?></p>
      <p><b>Saldo........: </b>$ <?php echo number_format($p[11]); ?></p>
      <input type="hidden" id="saldo_total" value="<?php echo $p[11]; ?>">
         </div>
      
    </div>
      <div class="row">
          <div class="col-sm-12">
              <p><b>Observaciones:</b> <br><?php echo $p[18]; ?></p>
         </div>
      </div>
    <hr> 
<!--    parte de documentos-->
<h4>
    <div class="well well-sm">
       DOCUMENTOS DEL CONTRATO 
    
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formdoc()">Ingresar Documento</button>
    </div>
       </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>RAD</th>
        <th>TIPO DE DOCUMENTO</th>
        <th>OBSERVACIONES</th>
        <th>FECHA REGISTRO</th>
        <th>REGISTRADO POR </th>
        <th>ADJUNTO </th>
        <th>OPCIONES</th>
      </tr>
    </thead>
    <tbody id="mostrar_documentos">
      <tr>
          <td colspan="5"> Cargando tabla...</td>
      </tr>
    </tbody>
  </table>
  </div>
<!-- fin modulo de archivo-->
<hr>

<!--comoienzo de contactos-->
<h4>
    <div class="well well-sm">
        CONTACTOS DE ESTA OBRA
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formcontac()">Ingresar Contacto</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>ID</th> 
        <th>NOMBRE</th> 
        <th>TELEFONO</th> 
        <th>EMAIL</th> 
        <th>CARGO</th> 
        <th>OBSERVACIONES</th>  
        <th>OPCIONES</th>  
      </tr>
    </thead>
    <tbody id="mostrar_loscontactos">
      <tr>
          <td colspan="5"> Cargando tabla...</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de contactos -->

<!--comoienzo de actividades-->
<h4><div class="well well-sm">AGENDA DE LLAMADAS
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formllamada()">Ingresar Llamada</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>RAD</th>
        <th>DESCRIPCION</th> 
        <th>NOMBRE DEL CONTACTO</th> 
        <th>TELEFONO</th> 
        <th>ESTADO</th> 
        <th>FECHA DE INICIO</th>  
        <th>FECHA FINAL</th>  
        <th>.........</th> 
      </tr>
    </thead>
    <tbody id="mostrar_llamadas">
      <tr>
          <td colspan="5"> <img src="../../../imagenes/load.gif"> Cargando Tabla</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de actividades-->

<!--comienzo de cotizaciones-->
<h4>
    <div class="well well-sm">
        CITIZACIONES APROBADAS
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formcotizacion()">Ingresar Cotizacion</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>No COTIZACION</th> 
        <th>REGISTRADO POR</th> 
        <th>VENDEDOR</th> 
        <th>ESTADO</th> 
        <th>FECHA DE REGISTRO</th> 
        <th>VENTA TOTAL SIN IVA</th>  
        <th>OPCIONES</th>  
      </tr>
    </thead>
    <tbody id="mostrar_cotizacion">
      <tr>
          <td colspan="5"> Cargando tabla...</td>
      </tr>
    </tbody>
  </table>
      <br>
      <hr>
      
  </div>
 <div class="well well-sm">
     DETALLES DE LA COTIZACION <span id="cotizacion_numero"></span>
<!--    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formcotizacion()">Ingresar Cotizacion</button>
    </div>-->
        </div>
<div class="table-responsive">
<table class="table">
    <thead>
      <tr class="bg-info">
        <th>TIPO</th> 
        <th style="width:150px">DESCRIPCION</th> 
        <th>UBICACION</th> 
        <th>MEDIDAS</th> 
        <th>AREA M2 </th>
        <th>ALUMINIO</th>
        <th>VIDRIO</th>
        <th>DISEÑO</th>
        <th>UNID</th>  
        <th>VALOR UNID</th> 
        <th>CANTIDAD</th> 
        <th>VALOR TOTAL</th> 
        <th>TOTAL EN PRODUCCION</th> 
        <th>TOTAL EN PISO</th>
        <th>TOTAL DESPACHO</th>
        <th>TOTAL INSTALADO</th>
        <th>PENDIENTE X INSTALAR</th>
        <th>ACTA DE ENTREGA</th>
        <th> </th>
      </tr>
    </thead>
    <tbody id="mostrar_resumen">
      <tr>
          <td colspan="5"> Cargando tabla...</td>
      </tr>
    </tbody>
  </table>
</div>
<!--fin de cotizaciones -->

<!--comienzo de ordenes de produccion-->
<h4>
    <div class="well well-sm">
        ORDENES DE PRODUCCION
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formcotizacion()">Consultar OP</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>No. OP</th> 
        <th>OP FOM</th> 
        <th>FECHA REGISTRO</th> 
        <th>CANT PRODUCTOS</th> 
        <th>ESTADO</th> 
        <th>OPCIONES</th>  
      </tr>
    </thead>
    <tbody id="mostrar_op">
      <tr>
          <td colspan="5"> En Construccion...</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de contactos -->

<!--comienzo de ordenes de produccion-->
<h4>
    <div class="well well-sm">
        FACTURAS PENDIENTES POR COBRAR 
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formpendnue()">Crear Facturas</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>REMISIONES</th> 
        <th>No.FACTURA</th> 
        <th>FECHA REGISTRO</th> 
        <th>FECHA PAGO</th>
        <th>VALOR A CANCELAR</th> 
        <th>ESTADO</th> 
        <th>.....</th> 
      </tr>
    </thead>
    <tbody id="mostrar_nueva_fact">
      <tr>
          <td colspan="5"> Cargando tabla...</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de contactos -->

<!--comienzo de ordenes de produccion-->
<h4>
    <div class="well well-sm">
        RETEGARANTIAS PENDIENTES POR COBRAR 
     </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>REMISIONES</th> 
        <th>No.FACTURA</th> 
        <th>FECHA DE REGISTRO</th> 
        <th>FACTURADO POR</th> 
        <th>RETEGARANTIA</th> 
        <th>COBRADO POR</th> 
        <th>ESTADO</th>
       <th>....</th> 
      </tr>
    </thead>
    <tbody id="mostrar_retegarantias">
      <tr>
          <td colspan="5"> Cargando tabla...</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de contactos -->

<!--comienzo de ordenes de produccion-->
<h4>
    <div class="well well-sm">
        PRODUCTOS INSTALADOS
    <div style="float: right">
        <button type="button" class="btn btn-danger btn-xs" onclick="formcotizacion()">Reporte de Items</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>ITEM</th> 
        <th>DESCRIPCION DEL PRODUCTO</th> 
        <th>CANTIDAD INSTALADA</th> 
        <th>VALOR PAGADO</th> 
        <th>INSTALADOR</th> 
        <th>Opciones</th>  
      </tr>
    </thead>
    <tbody id="mostrar_instaladas">
      <tr>
          <td colspan="5"> En Construccion...</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de contactos -->

 </div>
     
<!--     formulario de documentos-->
    <div class="modal fade" id="Modaldoc" role="dialog">
    <div class="modal-dialog">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">REGISTRO DE DOCUMENTO</h4>
        </div>
       <div class="table-responsive">
           <form id="subida">
         <table class="table">
             <tr><td></td>
             <td>
                 <div class="input-group">
                     <span class="input-group-addon">#Radicado</span>
                     <input type="number" id="consecutivo" name="consecutivo" class="form-control" readonly>
                     <span class="input-group-addon">ID contrato</span>
                     <input type="number" id="idcontra"  name="idcontra" value="<?php echo $_GET['id']; ?>" class="form-control" readonly>
                 </div>
             </td>
             </tr>
             <tr>
             <td>Tipo de Documento</td>
             <td>
                 <select id="tipo_doc" name="tipo_doc" class="form-control">
                            <option value="">SELECCIONE</option>
                            <option value="Contrato">Contrato</option>
                            <option value="Polizas">Polizas</option>  
                            <option value="Planos">Planos</option>
                            <option value="Otros">Otros</option>
                 </select>
             </td>
             </tr>
             <tr>
                 <td>Observaciones</td>
                 <td>
                     <textarea id="sugeren" name="sugeren" style="width:100%"></textarea>
                 </td>
             </tr>
             <tr>
                 <td>Archivo</td>
                 <td><input type="file" name="archivo" id="archivo" class="form-control"  accept=".jpeg,.png,.pdf,.jpg"></td>
             </tr>
             
                <tr>
                    <td>Registrado por:</td>
                    <td>
                   <div class="input-group">
                    <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="regis_arc" name="regis_arc" class="form-control" readonly >
                    <span class="input-group-addon">Fecha de registro</span>
                    <input type="text"  id="fecha_doc" name="fecha_doc" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly >
                   </div>
                   </td>
                </tr>
     
         </table>
               
            <div class="modal-footer">
                <span id="imagenes"></span>
                <button type="submit" class="btn btn-primary" id="cargar">Guardar Cambios</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
               </form>
           </div>
         </div>
       </div>
    </div>
<!--fin formulario del documento-->

<!--Formulario de actividades-->
 <div class="modal fade" id="FormularioAgenda" role="dialog">
    <div class="modal-dialog">
 
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nueva Actividad</h4>
        </div>
        <div class="modal-body">
            <table>
                <tr><td></td>
                   <td>
                        <div class="input-group">
                        <span class="input-group-addon">#Rad actividad</span>
                        <input type="text" id="id_a_nuevo" class="form-control" disabled> 
                        <span class="input-group-addon">#Relacion</span>
                        <input type="text" id="relacion_con" value="<?php echo $p[20]; ?>" class="form-control" disabled>
                        </div>
                   </td>
                </tr>
                <tr>
                    <td>Asunto</td>
                    <td><input type="text" id="motivo_nue" class="form-control"></td>
                </tr>
                <tr><td>Fecha De Inicio</td>
                    <td>  
                      <div class="input-group">
                        <input name="remitosucursal" id="fec_ini_nueva" type="date" required class="form-control">
                        <span class="input-group-addon">Hora</span>
                        <input name="remitonumero" id="hra_nueva" type="time" required class="form-control">
              
                      </div>
                    </td>
                    </tr> 
                    <tr>
                    <td>Asignado a:</td> 
                    <td> 
                     <div class="input-group">
                         <span class="input-group-addon"><button type="button" onclick="buscar_usuario_ag();"><img src="../../../imagenes/search.png"></button></span>
                         <input  id="asig_nueva" type="text" required class="form-control" value="<?php echo $_SESSION['k_username'] ?> ">
                     </div>
                    </td>
                </tr>
                
                <tr>
                   <td>aviso?<b>*</b></td>
                    <td><input type="text" id="alarma_nueva" value="Si" class="form-control" disabled></td>
                 </tr>
                
                  <tr>
                    <td>Descripcion</td> 
                    <td><textarea id="descrip_nueva" placeholder="motivo de llamada" onchange="valida_descrip();" style="width:100%"></textarea></td>
                  </tr>
                  
                 <tr>
                   <td>llamada?<b>*</b></td>
                   <td> 
                       <div class="input-group">
                        <select id="tip_llamada_nue" class="form-control">
                            <option value="Saliente" selected>Saliente</option> 
                            <option value="Entrante" >Entrante</option>
                               
                        </select> 
                  <span class="input-group-addon">Estado de la llamada</span>
                        <select id="est_llamada_nu" class="form-control">
                            <option value=""></option>
                            <option value="Planificada">Planificada</option>
                            <option value="Completada">Completada</option>    
                            <option value="No realizada">No realizada</option>   
                        </select> 
                       </div> </td></tr>
             
                  
                       <tr>
                    <td>Contacto</td> 
                    <td> 
                     <div class="input-group">
                         <span class="input-group-addon"><button type="button" onclick="buscar_contacto(<?php echo $p[20] ?>);"><img src="../../../imagenes/search.png"></button> </span>
                         <input type="hidden" id="contacto_lla" class="form-control">
                         <input type="text" id="nombre_contacto_lla" class="form-control" disabled>
                     </div>
                    </td>
                </tr>
                  
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="bac_guardar">Guardar Cambios</button> 
            <button type="button" class="btn btn-danger" onclick="limpiar_nuacti()">Nuevo</button> 
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<!--fin de  formulario de actividades-->


<!--FORMULARIO DE CONTACTOS-->
<div class="modal fade" id="Modalcont" role="dialog">
    <div class="modal-dialog">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">REGISTRO DE CONTACTOS</h4>
        </div>
       <div class="table-responsive">

               <table class="table">
               <tr>
                   <td></td>
                    <td>
                    <div class="input-group">
                     <span class="input-group-addon">#Rad contacto</span>
                     <input type="number" id="consecu_contacto"  class="form-control" readonly>
                     <span class="input-group-addon">relacionado con</span>
                     <input type="number" id="la_Relacion" value="<?php echo $p[20]; ?>" class="form-control" readonly>
                    </div> 
                    </td>
                </tr>
                 <tr>
                     <td>Nombre Completo</td>
                     <td>
                     <input type="text" id="nom_contact" class="form-control">
                     </td>
                 </tr>
                 <tr>
                     <td></td>
                    <td>
                      <div class="input-group">
                      <span class="input-group-addon">Telefono:</span>
                      <input type="number" id="tel_contact" value=" " class="form-control">
                      <span class="input-group-addon">Email</span>
                      <input type="text" id="mail_contac" class="form-control" onchange="caracteresCorreoValido();">
                     </div>
                    </td>
                </tr>
                <tr>
                    <td>Cargo:</td>
                   <td>
                     <input type="text" id="cargo_contact" value=" " class="form-control">
                   </td>
                </tr>
                <tr>
                    <td>Sugerencia</td>
                    <td>
                       <textarea id="sug_contact" style="width:100%"></textarea>
                    </td>
                 </tr>
                <tr>
                    <td></td>
                     <td>
                       <div class="input-group">
                       <span class="input-group-addon">Registrado por: </span>
                       <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="regis_contac" class="form-control" readonly >
                       <span class="input-group-addon">Fecha de registro</span>
                       <input type="text"  id="fecha_reg_contac" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly >
                       </div>
                     </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                      <div class="modal-footer">
                      <span id="imagenes"></span>
                      <button type="button" class="btn btn-primary" id="btn_guardar">Guardar Cambios</button> 
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </td>
                </tr>
                </table>

           </div>
         </div>
       </div>
    </div>
<!--- FIN DE FORMULARIO CONTACTOS>----->

<!--FORMULARIO DE COTIZACIONES-->
<div class="modal fade" id="ModalCotizacion" role="dialog">
    <div class="modal-dialog modal-sm">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">REGISTRO DE COTIZACIONES</h4>
        </div>
       <div class="table-responsive">

               <table class="table">
                 <tr>
                     <td>Cotizacion No.</td>
                     <td>
                     <input type="text" id="cot" class="form-control">
                     </td>
                 </tr>
                 <tr>
                     <td>Version</td>
                     <td>
                     <input type="text" id="ver" class="form-control">
                     </td>
                 </tr>
                </table>
                 <div class="modal-footer">
                      <span id="imagenes"></span>
                      <button type="button" class="btn btn-primary" id="btn_guardar_cot">Agregar</button> 
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
           </div>
         </div>
       </div>
    </div>
<!--- FIN DE FORMULARIO CONTACTOS>----->

<!---FORMULARIO FACTURAS PENDIENTES POR COBRAR------>

<div class="modal fade" id="Modalpendnue" role="dialog">
    <div class="modal-dialog">
   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>FACTURAS POR COBRAR</b></h4>
        </div>
       <div class="table-responsive">
               <table class="table">
                   <tr>
                    <td>
                    <div class="input-group">
                        <span class="input-group-addon"><p class="text-danger"><b>#RAD fact</b></p></span>
                     <input type="number" id="conse_nuevafact" class="form-control" readonly> 
                     <span class="input-group-addon">#FACT FP</span>
                     <input type="text" id="fomplus_n" class="form-control">
                     <input type="hidden" id="id_tercero_f" value="<?php echo $p[20]; ?>" class="form-control" disabled>
                    
                    
                    </div> 
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">    
                        <span class="input-group-addon">#Pedido.......</span>
                         <input type="number" id="pedi_fact"class="form-control">
                          <span class="input-group-addon">#Remision</span>
                     <input type="number" id="remi_fact" class="form-control">
                        </div>
                    </td>
                </tr>
               
                
                <tr>
                    <td>
                        <div class="input-group">
                       <span class="input-group-addon">Valor.Total...</span>
                       <input type="number" id="val_t_fac" class="form-control" placeholder="$">
                        </div>
                    </td>
                </tr>
                 <tr class="bg-info">
                     <td><h4><b>OPERACIONES</b></h4></td>
                </tr>
 
                 <tr>
                    <td>
                      <div class="input-group">
                      <span class="input-group-addon"><b>Retefuente</b>.....</span>
                      <input type="text" id="porc_rete_f" class="form-control" placeholder="%" style="width:60px">
                      <span class="input-group-addon"><b>=</b></span>
                      <input type="number" id="rete_fact" class="form-control">
                      <span class="input-group-addon"><b>Rete.ICA</b></span>
                       <input type="text" id="porc_rica_f" class="form-control" placeholder="%" style="width:60px">
                       <span class="input-group-addon"><b>=</b></span>
                       <input type="number" id="rete_ica_f" class="form-control">
                     </div>
                    </td>
                </tr>
                <tr>
                   
                    <td>
                        <div class="input-group">
                        <span class="input-group-addon"><b>Rete IVA</b>.........</span>
                        <input type="text" id="porc_riva" class="form-control" placeholder="%" style="width:60px"> 
                        <span class="input-group-addon"><b>=</b></span>
                        <input type="number" id="rete_iva_f" class="form-control"> 
                        <span class="input-group-addon"><b>Cant Despachado</b></span>
                        <input type="number" id="cant_desp" class="form-control">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>  
                      <div class="input-group">
                       <span class="input-group-addon"><b>$Retegarantia</b></span>
                       <input type="text" id="porc_re_garan" class="form-control" placeholder="%" style="width:60px">
                       <span class="input-group-addon"><b>=</b></span>
                       <input type="number" id="valor_reteg_f" class="form-control">
                       <span class="input-group-addon"><b>Otros descuentos</b></span>
                       <input type="text" id="otros_Des_f" class="form-control">
                       </div>
                    </td>
                 </tr> 
                 <tr class="bg-info">
                 <td></td>
                 </tr>
                <tr>
                    <td>
                        <div class="input-group">
                        <span class="input-group-addon">Observaciones</span>
                       <textarea id="obser_nuefac" style="width:100%"></textarea>
                       </div>
                    </td>
                 </tr>
                  <tr>
                    <td>
                        <div class="input-group">
                         <span class="input-group-addon">Estado............</span>
                         <select id="est_nuev_f" class="form-control">
                            <option value="">Seleccione</option>
                            <option value="Cancelado">Cancelado</option>
                            <option value="No cancelado">No cancelado</option>    
                         </select> 
                          <span class="input-group-addon">Dia de pago</span>
                         <input type="date" id="dia_pag" class="form-control">
                        </div>
                    </td>
                 </tr>
                  <tr>
                     <td>
                       <div class="input-group">
                       <span class="input-group-addon">Registrado por: </span>
                       <input type="text" value="<?php echo $_SESSION["k_username"]; ?>" id="reg_nue_fac" class="form-control" readonly >
                       <span class="input-group-addon">Fecha de registro</span>
                       <input type="text"  id="fech_nuev_fac" class="form-control" value="<?php echo date("Y-m-d"); ?>" readonly >
                       </div>
                     </td>
                </tr>
                <tr>
                    <td>
                      <div class="modal-footer">
                      <span id="imagenes"></span>
                      <button type="button" class="btn btn-primary" id="nuefact_guardar">Guardar Cambios</button> 
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </td>
                </tr>
                </table>
           </div>
         </div>
       </div>
    </div>


 </body>
</html>
               <?php  }else {

    echo '<script>location.reload();</script>';
    
}?>   