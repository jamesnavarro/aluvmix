<?php
include '../../../modelo/conexioni.php';
session_start();
$result = mysqli_query($con,"select * from prospecto where id_prospecto=".$_GET['id']."  ");
$r = mysqli_fetch_array($result);
if(isset($_GET['archivo'])){
$filename = $_GET['archivo'];
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../../archivos/".$filename;
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
    }
    if(isset($_GET['archivo_cot'])){
$filename = $_GET['archivo_cot'];
 // Ahora guardamos otra variable con la ruta del archivo
 $file = "../../cotizaciones/".$filename;
 // Aquí, establecemos la cabecera del documento
 header("Content-Description: Descargar imagen");
 header("Content-Disposition: attachment; filename=$filename");
 header("Content-Type: application/force-download");
 header("Content-Length: " . filesize($file));
 header("Content-Transfer-Encoding: binary");
 readfile($file);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $r[8]; ?></title>
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
   

    <link rel="stylesheet" href="../../../css/style.css"> 
    <script src="../../../js/jquery.js" type="text/javascript"></script>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <script src="funciones_ventana.js" type="text/javascript"></script>
    </head>
       <div class="modal fade" id="myModalvisita" role="dialog">
         <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registrar Visita x</b></h4>
            </div>
            <div class="modal-body">
            <fieldset>
			<table class="tbl-registro" width="100%">
                          <tr>
                    	<td>Id: </td>
                        <td><input type="text" class="form-control" id="id"  value="" disabled/></td>
                        
                        <tr>
                    	<td>Nombre del Asunto: </td>
                        <td><input type="text" class="form-control" id="asunto"  value="" /></td>
                	<tr>
                    	<td>Lugar: </td>
                        <td><input type="text" class="form-control" id="lugar"  value="" /></td>
                        <tr>
                    	<td>Fecha de Inicio: </td>
                        <td><input type="date"  id="fi"  value="" style="width: 125px"/> <input type="time"  id="hi"  value="" style="width: 120px" max="22:30:00" min="06:00:00" step="any"/></td>
                        <tr>
                    	<td>Fecha Final: </td>
                        <td><input type="date" id="ff"  value=""  style="width: 125px"/> <input type="time"  id="hf"  value="" style="width: 120px" max="22:30:00" min="06:00:00" step="any"/></td>
                            <tr>
                    	<td>Tipo: </td>
                        <td><select class="form-control" id="tipo">
                                <option value="Visita">Visita</option>
                                <option value="Reunion">Reunion</option>
                                 <option value="Tarea">Tarea</option>
                                  <option value="Llamada">Llamada</option>
                            </select></td>
                        <tr>
                    	<td>Estado: </td>
                        <td><select class="form-control" id="estado">
                                <option value="Planificada">Planificada</option>
                                <option value="Completada">Completada</option>
                                <option value="Anulada">Anulada</option>
                            </select></td>
                        <tr>
                            <td>Contacto</td>
                            <td><select id="con"  class="form-control">
                          <option value="">Seleccione el contacto</option>
                      <?php
                         $conta = mysqli_query($con,"select * from sis_contacto where id_obra='".$_GET['id']."' ");
                         while($b = mysqli_fetch_array($conta)){
                             echo '<option value="'.$b[0].'">'.$b[1].' '.$b[2].'</option>';
                         }
                      ?>
                      </select></td>
                        </tr>
                            <tr>
                    	<td>Observaciones: </td>
                        <td><textarea class="form-control" id="obs2"></textarea> </td>
                        
                </table>
                </fieldset>
                <div id="mensaje"></div>
                
                <br />
                <div id="contenidoRegistro"></div>
                <div class="modal-footer"><span id="pa"></span>
                    <button type="button" class="btn btn-primary" onclick="limpiar();" >Nuevo</button>	
                <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Cerrar</button>	
                <input type="button" onclick="add_visita()" id="visitas" class="btn btn-success" value="Registrar" />
                </div>
            </div>
          </div>
        </div>
  </div>          
    <body>
        <div class="row-fluid">
                           <section class="body">

                                <div class="body-inner">

                        <div class="span12 widget dark stacked">

                            <header>

                                <h4 class="title"><?php echo $r[8]; ?></h4>
                                <input type="hidden" id="id_obra" value="<?php echo $_GET['id']; ?>">
                                <!-- START Toolbar -->

                                <ul class="toolbar pull-left">

                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>

                                </ul>
                            </header>

                            <section id="collapse1" class="body collapse in">

                                <div class="body-inner">

 <br>
                            <div class="tabbable" style="margin-bottom: 25px;">

                                <div class="tab-content">

                                    <div class="" id="tab1">
                    <div class="row-fluid">
                        <div class="span12 widget lime">
                            <section class="body">
                                <table class="table table-bordered table-striped table-hover" id="">
                                    <tr>
                                        <th style="text-align: center;background: #C6C6C6" colspan="6">DATOS DE LA OBRA :<?php echo $_SESSION['k_username'] ?></th>
                                       
                                        
                                    </tr>  
                                    <tr>
                                        <th style="text-align: right;">Nombre del Proyecto:</th>
                                        <td colspan="4"><?php echo $r[8] ?></td>
                                        
                                    </tr>   
                                    <tr>
                                        <th style="text-align: right">Empresa: </th>
                                        <td><?php echo $r[9] ?></td>
                                        <th style="text-align: right">Telefono:</th>
                                        <td><?php echo $r[10] ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right">Telefono:</th>
                                        <td><?php echo $r[12] ?></td>
                                    
                                        <th style="text-align: right">Region:</th>
                                        <td><?php echo $r[2] ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right">Ciudad:</th>
                                        <td><?php echo $r[3] ?></td>
                                        <th style="text-align: right">Zona:</th>
                                        <td><?php echo $r[4] ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right">Direccion:</th>
                                        <td><?php echo $r[11] ?></td>
                                        <th style="text-align: right">Barrio:</th>
                                        <td><?php echo $r[7] ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right">Estrato:</th>
                                        <td><?php echo $r[5] ?></td>
                           
                                        <th style="text-align: right">Tipo de Proyecto:</th>
                                        <td><?php echo $r[19] ?></td>
                                   </tr>
                                    <tr>
                                        <th style="text-align: right">Fase del Proyecto:</th>
                                        <td><?php echo $r[20] ?></td>
                                        <th style="text-align: right">Estado:</th>
                                        <td><?php echo $r[21] ?></td>
                                    </tr>
                                    <tr>
                                        <th style="text-align: right">Asesor asignado:</th>
                                        <td><?php echo $r[22] ?></td>
                                        <th style="text-align: right">Fecha Asignacion:</th>
                                        <td><?php echo $r[23] ?></td>
                                   </tr>
                                    <tr>
                                        <th style="text-align: right">Modificado Por:</th>
                                        <td><?php echo $r[24] ?></td>
                                        <td colspan="2"><b><font color="red"><?php
                                        if($r[25]==''){
                                            echo '<button onclick="des();"> Descartar</button>';
                                        }else{
                                           echo $r[25];
                                        }
                                                ?></font></b> 
                                            
                                            <button onclick="nuevo(<?php echo $_GET['id']; ?>);">Editar Prospecto</button>
                                            
                                         <button onclick="window.close();">Salir</button></td>
                                    </tr>
                                   <tr>
                                        <th style="text-align: right">Estado Comercial:</th>
                                        <td><?php echo $r[32] ?></td>
                                        <th style="text-align: right">Nombre del Constructor:</th>
                                        <td><?php echo $r[14] ?></td>
                                   </tr>
                                   <tr>
                                        <th style="text-align: right">Evaluación</th>
                                        <td><select id="punto" style="width:40px">
                                                        <option value="5" <?php if($r[33]=='5'){echo 'selected';}  ?>>5</option>
                                                        <option value="4" <?php if($r[33]=='4'){echo 'selected';}  ?>>4</option>
                                                        <option value="3" <?php if($r[33]=='3'){echo 'selected';}  ?>>3</option>
                                                        <option value="2" <?php if($r[33]=='2'){echo 'selected';}  ?>>2</option>
                                                        <option value="1" <?php if($r[33]=='1'){echo 'selected';}  ?>>1</option>
                                            </select></td>
                                    
                                            <td colspan="2"><textarea cols="3" class="form-control" id="obs" placeholder="Observaciones"><?php echo $r[34] ?></textarea></td>
                                   </tr>
                                </table>
                            </section>
                        </div>
                        
                    </div>
                                    </div>
                                    <br>
<!--                                    <br>Contactos -->
                                    <div class="" id="tab1">
                    <div class="row-fluid">
                        <div class="span12 widget lime">
                            <section class="body" id="mostrar_contactos">
                                
                            </section>
                        </div>  
                    </div>
                                    </div><br>
<!--visitas-->
                         <div class="" id="tab2">
                    <div class="row-fluid">
                        <div class="span12 widget lime">
                            <section class="body" id="mostrar_visitas">
                                
                            </section>
                        </div>
                        
                    </div>
                                    </div>
<!-- necesidades -->
<br><hr>
<!--         <div class="" id="tab2">
                    <div class="row-fluid">
                        <div class="span12 widget lime">
                            <section class="body" id="mostrar_necesidades">
                                
                            </section>
                        </div>
                        
                    </div>
                                    </div>-->
<!--Cotizaciones --->

         <div class="" id="tab2">
                    <div class="row-fluid">
                        <div class="span12 widget lime">
                            <section class="body" id="mostrar_cotizaciones">
                                
                            </section>
                        </div>
                        
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
                            </section>
        
        </div>
        <div class="my-module">
<!--             <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
              <h4 class="modal-title" id="myModalLabel"><b>Registrar Contacto</b></h4>
            </div>
            <div class="modal-body">
            <fieldset>
				<table class="tbl-registro" width="100%">
                                    <tr>
                    	<td>Id Prospecto: </td>
                        <td><input type="text" class="form-control" id="idp"  value="" disabled/>
                        <input type="hidden" class="form-control" id="idc"  value="" disabled/></td>
                        
                        <tr>
                    	<td>Nombre del Contacto: </td>
                        <td><input type="text" class="form-control" id="nom"  value="" /></td>
                	<tr>
                    	<td>Telefono: </td>
                        <td><input type="text" class="form-control" id="tel"  value="" /></td>
                        <tr>
                    	<td>Cargo: </td>
                        <td><input type="text" class="form-control" id="cargo"  value="" /></td>
                        <tr>
                    	<td>Area: </td>
                        <td><input type="text" class="form-control" width="20%" id="area"  value="" /></td>
                            <tr>
                    	<td>Email: </td>
                        <td><input type="text" class="form-control" width="20%" id="email"  placeholder=""  /></td>
                            <tr>
                    	<td>Observaciones: </td>
                        <td><textarea class="form-control" id="obs"></textarea> </td>
                        
                </table>
                </fieldset>
                <div id="mensaje"></div>
                
                <br />
                <div id="contenidoRegistro"></div>
                <div class="modal-footer"><span id="pa"></span>
                    <button type="button" class="btn btn-primary" onclick="limpiar();" >Nuevo</button>	
                <button type="button" class="btn btn-danger"  data-dismiss="modal" aria-hidden="true">Cerrar</button>	
                <input type="button" onclick="add_contacto()" id="btn" class="btn btn-success" value="Registrar" />
                </div>
            </div>
          </div>
        </div>
  </div>-->
      
        </div>

    </body>
</html>
