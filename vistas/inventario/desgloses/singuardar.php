<?php
   include '../../../modelo/conexionv1.php';
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
            <h3>MATERIALES SIN GUARDAR</h3>
        </div>
        <div class="border">
          
               <div  style="float:left">
                   
<!--                   <button  onclick="Imprimir();"><img src="../../images/printer.png" title="Imprimir Registro"> Imprimir</button>-->
                   <button onclick="salir();"><img src="../../images/salir.png"  title="Salir del Formulario">Salir</button>

                   <span id="e"></span>
               </div>
           
               </div>

      
        <div class="border">
      <div class="form" id="">
                   <?php
                  
       
 
            $table = '<p><center> DESGLOSE DE ALUMINIOS A SOLICITAR  </center></p>';
              $table = $table.'<table class="table table-bordered table-striped table-hover" id="tabla2">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th  width="10%">'.'Item'.'</th>';
              $table = $table.'<th width="10%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="10%">'.'Codigo'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Color'.'</th>';
              $table = $table.'<th width="10%">'.'Medida'.'</th>';
              $table = $table.'<th width="10%">'.'IdCot'.'</th>';
  
              
    
              $table = $table.'</tr>';
              $table = $table.'</thead>';
$reques=mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where a.crear=1 and a.linea in ('Perfileria','Accesorios') and  a.codigo_pro=b.codigo  and cantidad!=0 group by a.referencia, a.perfil order by b.sistema asc  ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = ''; 
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     
                     if($rowp['dado']=='0' || $rowp['dado']==''){
                         $dado = $rowp['referencia'];
                     }else{
                         $dado = $rowp['dado'];
                     }
                     
                 $medres = mysqli_query($con2,"select sum(medida*cantidad) as med from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' and perfil='".$rowp['perfil']."' ");
                 $md = mysqli_fetch_array($medres);
                 
                     $medtotal = $md['med'];
                     $canper = $md['med']/$rowp['perfil'];
                   
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)*$canper;
                     
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area'];
                     }
                     
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                     $resultc = mysqli_query($con2,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysql_fetch_array($resultc);
                     
                     
                     $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($con2,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                    $canpin = ( $areat * ceil($canper) ) / $rendimiento;
                    
                    $costo_total_pintura = $canpin * $vc;
                    
                    $valor_aluminio = $pst * $rowp['costo_fom'];
                    
                    $queryma = mysqli_query($con2,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                     $ref = $rowp['referencia'];
                     $sistema = $rowp['sistema'];
                    if($rowp['linea']=='Accesorios'){
                        $descripcion = $rowp['descripcion'];
                        $codigo = $rowp['codigo'];
                        $color = $rowp['color'];
                     }else{
                            $mystring = $rowp['descripcion'];
                            $findme   = 'MM';
                            $pos = strpos($mystring, $findme);
                            if ($pos === false) {
                                $descripcion = $rowp['descripcion'];
                            } else {
                                $descripcion = substr($rowp['descripcion'],0,-6);
                            }
                           
                           
                            if($rowp['color']=='01'){
                                $crudo = 'ANONIZADO';
                                $codcol = '01';
                            }else{
                                $crudo = 'CRUDO';
                                $codcol = '00';
                            }
                             $codigo = $ref.'-'.$codcol.substr($rowp['perfil'],0,2);
                     }
                    
                    if($contador==1){
                            $table = $table.  '<tr><td colspan="7"> - '.$rowp['sistema'].'-</td>';
                          
                        }
                    if($sistema!=$rowp['sistema']){
                         
                            $table = $table. '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                         
                     }
//                     $consulta=mysql_query($con,"select sum(stock_ubi) as st FROM `relacion_ubicaciones` where bod_codigo='".$_GET['bod']."' and codigo_pro='$codigo' ");
//                     $s = mysqli_fetch_array($consulta);
//                     $stock = $s[0];
//                     if($stock==null){
//                         $st = 0;
//                     }else{
//                         $st = $stock;
//                     }
                    
                     
                     if($rowp['existefom']=='1'){
                         $bcolor='#F4CACA';
                         $ch2 = '';
                     }else{
                         $bcolor='#C5E9C0';
                         $ch2='<input type="checkbox" id="'.$contador.'" name="item2" checked>';
                     }
                     $cod = "'".$codigo."'";
                     
                     $table = $table. '<tr style="background-color:'.$bcolor.'" id="td'.$contador.'" title="'.$rowp['codigo_pro'].'">'
                             . '<td><button onclick="creado('.$cod.','.$rowp['id_cot'].')">'.$contador.' Creado?</button></td>'
                             . '<td>'.$dado.'</td>'
                             . '<td>'.$codigo.'</td>'
                             . '<td>'.$descripcion.' '.$rowp['perfil'].'MM</td>'
                             . '<td>'.$crudo.'</td>'
                             . '<td>'.$rowp['perfil'].'</td>'
                             . '<td>'.$rowp['id_cot'].'</td>';

                 }
            
              $table = $table.'</table>';
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
          mostrar_desglose(id);
         mostrar_obs(id);
        </script>
    </body>
</html>