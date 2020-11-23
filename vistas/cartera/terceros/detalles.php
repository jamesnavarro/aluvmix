<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
?>
<!DOCTYPE html>
<html lang="sp">
    <head>

        <title>Modulo de cartera</title>
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
               mostrar_loscontactos();
               mostrar_llamadas();
            });
            </script>
    </head>
 <body>
   <div class="jumbotron text-center">
       <h3>CLIENTE <input type="number" id="id_cliente" value="<?php echo $_GET['id']; ?>" disabled style="width: 100px">
           <br><?php echo $_GET['name'];?></h3>

</div>

<div class="container">

<!--    parte de documentos-->
<h4>

<!--comoienzo de contactos-->
<h4>
    <div class="well well-sm">
        LISTA DE CONTACTOS 
    <div style="float: right">
        <button type="button" class="btn btn-primary btn-xs" onclick="formcontac()">Crear Contacto</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>Id</th> 
        <th>Nombre</th> 
        <th>Telefonos</th> 
        <th>Email</th> 
        <th>Cargo</th> 
        <th>Observaciones</th>  
        <th>Opciones</th>  
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
        <button type="button" class="btn btn-primary btn-xs" onclick="formllamada()">Crear Llamada</button>
    </div>
        </div>
</h4>
  <div class="table-responsive">          
  <table class="table">
    <thead>
      <tr class="bg-info">
        <th>Rad</th>
        <th nowrap>ASunto</th> 
        <th>Contacto</th> 
        <th>Telefono</th> 
        <th>estado</th>
       <th>Respuesta</th> 
        <th nowrap>fecha de inicio</th>  
        <th nowrap>fecha final</th>  
        <th>. .</th> 
      </tr>
    </thead>
    <tbody id="mostrar_llamadas">
      <tr>
          <td colspan="5"> <img src="../../magenes/load.gif">Cargando Tabla</td>
      </tr>
    </tbody>
  </table>
  </div>
<!--fin de actividades-->

 </div>


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
                        <input type="text" id="relacion_con" value="<?php echo $_GET['id']; ?>" class="form-control" disabled>
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
                    <td>Registrado por:</td> 
                    <td> 
                     <div class="input-group">
                         <input  id="asig_nueva" type="text" required class="form-control" value="<?php echo $_SESSION['k_username'] ?>" disabled>
                     </div>
                    </td>
                     </tr>
                
                <tr>
                   <td>aviso?<b>*</b></td>
                    <td><input type="text" id="alarma_nueva" value="Si" class="form-control" disabled></td>
                 </tr>
                
                  <tr>
                    <td>Respuesta de Llamada</td> 
                    <td><textarea id="descrip_nueva" placeholder="Digite la respuesta de la llamada" style="width:100%"></textarea></td>
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
                        <select id="est_llamada_nu" class="form-control" disabled>
                  
                            <option value="Planificada">Planificada</option>
                            <option value="Completada">Completada</option>    
                            <option value="No realizada">No realizada</option>   
                        </select> 
                       </div>
                   </td></tr>
             
                  <tr>
                      <td>Contactos <button type="button" onclick="buscar_contacto(<?php echo $_GET['id'] ?>);"><img src="../../../imagenes/search.png"></button> </td> 
                     <td> 
                         <input type="hidden" id="contacto_lla" class="form-control">
                         <input type="text" id="nombre_contacto_lla" class="form-control" disabled> <!-- adicionado por navabla -->
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
                     <input type="number" id="la_Relacion" value="<?php echo $_GET['id']; ?>" class="form-control" readonly>
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