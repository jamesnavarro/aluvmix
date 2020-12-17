<?php
   include '../../../modelo/conexioni.php';
   session_start();
   if(!isset($_SESSION['k_username'])){
       echo '<script>window.close();</script>';
   }
   $userk=$_SESSION['k_username'];
   $date= date("Y-m-d");

?>
<!-- ESTADO EN PROCESO DE CREACION -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Formulario de Registro </title>
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery.gritter.min.css" />
        <link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../../assets/css/chosen.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-colorpicker.min.css" />
        <link href="../../../css/estilo.css" rel="stylesheet">
        <script src="funciones.js?<?php echo rand(1, 999) ?>"></script>
    </head>
    <body>
        <div>
            <h3>DESGLOSE DE MATERIALES ACCESORIOS</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   
<!--                   <button  onclick="Imprimir();"><img src="../../images/printer.png" title="Imprimir Registro"> Imprimir</button>-->
                   <button onclick="salir();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>
                   <button onclick="imprimir_acc();"><img src="../../images/printer.png"  title="Salir del Formulario">PDF</button>
                   <b>Bodega</b><select id="bodega" onchange="mostrar_desglose(<?php echo $_GET['cot'];?>)">
                       <option value="">Seleccione la bodega</option>
                       <?php
                       $query = mysqli_query($con,"select * from bodegas");
                       while($r = mysqli_fetch_array($query)){
                           if($r[0]=='0028'){
                               $sele = 'selected';
                           }else{
                               $sele = '';
                           }
                           echo '<option '.$sele.' value="'.$r[0].'">'.$r[0].' '.$r[1].'</option>';
                       }
                       
                       ?>
                   </select>
                   <input type="text" id="cot" value="<?php echo $_GET['cot'];?>" disabled>
                   <select id="solicitudes" onchange="mostrar_desglose_acc(<?php echo $_GET['cot'];?>)">
                       <option value="0">Sin solicitar</option>
                       <option value="1">Solicitados</option>
                       <option value="2">Todos</option>
                   </select>
                   <input type="text" id="obs" value="" style="width:100%">
                   <span id="e"></span>
               </div>
               <div id="paginacion"  style="float:right">
               </div>

            </div>
        <br><hr>
        <div class="border">
     <button type="button"  id="verificador" onclick="verificartotalacc();"><img src="../../images/ver.png">1. Vericar codigos en fomplus</button>
     <button type="button"  id="stock" onclick="verificartotalstock();" id="stock" disabled><img src="../../images/ver.png">2. Vericar stock de Bodega</button> 
     <button type="button"  id="Guardar" onclick="save_solicitud();" id="Guardar" disabled><img src="../../images/ver.png">3. Generar  PreSolicitud</button> 
                <div class="form" id="">
                   <?php
                  
       
 
            $table = '<p><center> DESGLOSE DE ACCESORIOS A SOLICITAR  </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'Cantidad Requerida'.' </th>';
               $table = $table.'<th class="hidden-phone">'.'Cantidad a Pedir'.' </th>';
               $table = $table.'<th class="hidden-phone">'.'Stock'.' </th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';   
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Tipo (Item)'.'</th>';
              $table = $table.'<th width="10%">'.'Medida'.'</th>';
              $table = $table.'<th width="10%">'.'Dado'.'</th>';

              $table = $table.'</tr>';
              $table = $table.'</thead>';

            
              $table = $table.'<tbody id="mostrar_tabla_acc"></tbody></table>';
              echo $table; 
       ?>
                   
                   
                      
                </div>
     

            <span id="mensaje"></span>
              </div>
              <script src="../../assets/js/jquery-2.1.4.min.js"></script>
              <script src="../../assets/js/bootstrap.min.js"></script>

        <div class="modal fade" id="inventario_sal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Salida de Productos x Ubicacion</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                    relacion:<input type="text" id="idre" disabled>
                    <table class="table table-hover">
                        <tr>
                            <th>CODIGO(PRO)</th> 
                            <th>DESCRIPCION</th>
                            <th>UBICACION</th>
                            <th>CANTIDAD</th>
                            <th>SALIDA</th>
                            <th>OPCIONES</th>
                        </tr>
                        <tbody id="mostrar_cantidad">
                            
                        </tbody>
                    </table>
                    <hr><br><br>
                  <table class="table table-hover">
                    <tr class="bg-info">
                        <th>CODIGO(PRO)</th> 
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                    </tr>
                   <tbody id="mostrar_ubi_pro_sal">
                   </tbody>
            </table><br><br>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
                </div>
              </div>
          </div>
      </div>
      <script type="text/javascript">
          var id='<?php echo $_GET['cot'];?>';
          mostrar_desglose_acc(id);
         mostrar_obs(id);
        </script>
    </body>
</html>