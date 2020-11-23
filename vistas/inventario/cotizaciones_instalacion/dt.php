<?php
// include 'consultar_item.php';
// include 'consultar_vidrio.php';
$costo_total_item = 0;
$costo_total_item_desp = 0;
 ?>
<?php if(isset($_GET['item'])){  ?>   
<div class="row-fluid"> 
                    </div> 
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
  <form class="span12 widget shadowed dark form-horizontal bordered" action="<?php if(isset($_GET['item'])){echo '../modelo/producto.php?editar='.$_GET['cod'].'';}else{echo '../modelo/producto.php';} ?>" method="post" id="form_validate_html" enctype="multipart/form-data">
                            <header><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
                                <h4 class="title">DT DEL PRODUCTO</h4>
                                
                                
                            </header>
                            <section class="body">
                                <div class="body-inner"> 

                                        <center>   <table class="table table-bordered table-striped table-hover">
                                                <tr>
                                                    <td rowspan="6"><div class="fileupload fileupload-new pull-left" data-provides="fileupload">
                                                
                                               
                                                <div class="fileupload-new thumbnail" style="width: 300px; height: 200px;"><img src="<?php if(isset($_GET['item'])){
                                                    if($ruta==''){echo '../producto/no.jpg';}else{echo '../producto/'.$ruta;}} ?>"></div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="width: 90px; height: 90px;"></div>
                                               
                                             
                                                 
                                             </div></td>
                                                    <td>Linea del Producto</td>
                                                    <td width="30%">
                                                    <?php if(isset($_GET['item'])){echo $linea_cot;} ?>
                                                  <td>Ancho Cotizado (mm)</td>
                                                    <td width="10%"><?php if(isset($_GET['item'])){echo $ancho;}?>
                                                    <?php if($_GET['aa']!=0){
                                                        echo $_GET['aa'];
                                                    } ?>
                                                    </td>
                                                   
                                     </td>
                                                </tr>
                                                <tr>
                                                     <td>Codigo del Producto</td>
                                                    <td><?php if(isset($_GET['item'])){echo $codigo;} ?></td>
                                                   
                                                    <td>Alto Cotizado (mm)</td>
                                                    <td><?php if(isset($_GET['item'])){echo $alto;} ?></td>
                                                </tr>
                                                <tr>
                                                     <td>Nombre del Producto</td>
                                                     <td><?php if(isset($_GET['item'])){echo $producto;} ?></td>
                                                   
                                                    <td>Cantidad cotizada</td>
                                                    <td><?php if(isset($_GET['item'])){echo $cant_item;} ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Color y Espesor del Vidrio</td>
                                                    <td><?php if(isset($_GET['item'])){echo $color_vidrio.'';} ?></td>
                                                   <td>Porcentaje desperdicio</td>
                                                    <td><?php if(isset($_GET['item'])){echo $poralu;} ?> %</td>
                                                </tr>
                                                <tr>
                                                      <td>Altura Cuerpo Fijo ó rejilla</td>
                                                    <td><?php if(isset($_GET['item'])){echo $altura;} ?> mm</td>>
                                                    <td>Altura de Ventana Corrediza</td>
                                                    <td><?php if(isset($_GET['item'])){ echo $altura_v_c;} ?> mm</td>
                                                </tr>
                                                <tr>
                                                    <td>Anchura de Ventana Corrediza</td>
                                                    <td><?php if(isset($_GET['item'])){echo $anchura;} ?> mm</td>
                                                    <td>Anchura de Ventana Corrediza</td>
                                                    <td><?php if(isset($_GET['item'])){ echo $anchura_v_c;} ?> mm</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="4">
                                                        <?php echo 'Item No.: '.$id_referencia.'<br>Id dolar: '.$dolar_actual; ?>
                                                    </td>
                                                </tr>
                                                
                                            </table></center><br></fieldset>                                 
                                           
                                    <!-- Form Action -->
                                    <div class="form-actions">
                                      
                                       
                                    </div><!--/ Form Action -->
                                </div>
                            </section>
                        </form>
                      <!-- START Widget Collapse -->
<?php    

    ?>
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Reparto de Aluminio  | Color: <?php echo $color ?> </h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse2" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                         
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
//123
                if($poralu==0){
                $alum_por = "SELECT (".$por.") as p FROM porcentajes where area_por='MP' and grupo='Perfileria'";
                $po =mysql_fetch_array(mysql_query($alum_por));
                $porca= $po["p"]/100;
                $despalu = 100 - $po["p"];
                }else{
                    $porca= (100-$poralu)/100;
                    $despalu = $poralu;
                }
                if($porvid==0){
                $vidrio_por = "SELECT (".$por.") as p FROM porcentajes where area_por='MP' and grupo='Vidrios'";
                $fip =mysql_fetch_array(mysql_query($vidrio_por));
                $porcv= $fip["p"]/100;
                $despvid = 100-$fip["p"];
                }else{
                    $porcv= (100-$porvid)/100;
                    $despvid = $porvid;
                }
                if($poracc==0){
                $acc_por = "SELECT (".$por.") as p FROM porcentajes where area_por='MP' and grupo='Accesorios'";
                $fipa =mysql_fetch_array(mysql_query($acc_por));
                $porcacc= $fipa["p"]/100;
                 //$porcacc= 0.95; 
                $despacc = 100-$fipa["p"];
                }else{
                    $porcacc= (100-$poracc)/100;
                    $despacc = $poracc;
                }
              
                $porcace= (100-$porace)/100;
                    $despace = $porcace;
                
            
 $request=mysql_query("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
   
     
if($request){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="7%">'.'Referencia'.'</th>';
              $table = $table.'<th width="7%">'.'Cod. Comercial'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
               $table = $table.'<th width="10%">'.'Medida.'.'</th>';
               $table = $table.'<th width="10%">'.'Peso T(Kg).'.'</th>';
               $table = $table.'<th class="hidden-phone">'.'cant. und.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'cant. .'.'</th>';
               $table = $table.'<th width="10%">'.'Valor Ml.'.'</th>';
               $table = $table.'<th width="10%">'.'Crudo.'.'</th>';
               $table = $table.'<th width="10%">'.'Acabado.'.'</th>';
               $table = $table.'<th class="hidden-phone">Crudo+Acab.</th>';
               $table = $table.'<th class="hidden-phone">Desp</th>';
               $table = $table.'<th class="hidden-phone">Total</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
              
              $sql_alf = mysql_query("SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
              $descuento_riel = 0;
              $descuento_alfa = 0;
               $costo_alu = 0;
                $total_alu = 0;
                $costo_ace = 0;
                $total_ace = 0;
                $crudo = 0;
                $pintado=0;
                $peso_perfiles = 0;$peso_acero = 0;
              while($sa = mysql_fetch_array($sql_alf)){
                  if($sa['modulo']=='Rieles'){
                      $descuento_riel = $sa['descuento'];
                  }
                  if($sa['modulo']=='Alfajia'){
                      $descuento_alfa = $sa['descuento'];
                  }
                  $perimetro = $sa['area']/1000;
                  $pst = (($sa['peso'] * $ancho) / 1000);
                  $precio = $sa['costo_mt'];
                   $medida = $ancho; //-$descuento_riel-$descuento_alfa
            $cantidad = $cant_item;
            
            include 'costopintura.php';
                 
            $n=1000;

           
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000;
            $precio_total = $precio * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            
            $costo_alu += $precio_total_acabado;
            $total_alu += $totadesp;
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            
            if($sa['grupo']=='Perfileria Acero'){
                $peso_acero += $pst*$cantidad;
            }else{
                $peso_perfiles += $pst*$cantidad;
            }
           
            
            
                  
                  $table = $table.'<tr><td width="10%" title="">'.$sa['referencia'].'</a></td>
                    <td width="10%">'.$sa['codigo'].'<br>'.$sa['grupo'].'</td>
                    <td width="40%">'.$sa['descripcion'].'<br>Perimetro: '.$perimetro.'mt | Peso :'.$sa['peso'].' Kg.<br>
                        </td>
                    <td width="10%">Horizontal</td>
                    <td width="10%">'.number_format($ancho).' mm<font></a></td>
                    <td class="hidden-phone">'.number_format($pst,2,',','.').'</font></td>
                    <td class="hidden-phone">1</font></td>
                        <td class="hidden-phone">'.$cantidad.'</font></td>
                    <td class="hidden-phone" style="text-align:right">$'.number_format($precio).'</font></td>
                    <td class="hidden-phone" style="text-align:right">$'.number_format($precio_total).'</td>
                    <td class="hidden-phone" style="text-align:right" title="Valor:'.$vc.'">$'.number_format($valor_acabado).'</td>
                    <td class="hidden-phone" style="text-align:right">$'.number_format($precio_total_acabado).'</td>
                    <td class="hidden-phone" style="text-align:right">'.number_format($despalu).'%</td>
                    <td class="hidden-phone" style="text-align:right">$'.number_format($totadesp).'</td>' 
                    . '</tr>';  
              }
  
        
  //Por cada resultado pintamos una linea
       
  while($row=mysql_fetch_array($request))
  {    
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
            $fia =mysql_fetch_array(mysql_query($pdlr));
            $precio_actual= $fia["precio_actual"];
            $perimetro = $row["area"]/1000;
                 
            $nw_medida = $row['medida_r_a'];
            $nw_lado = $row['lado'];
            $nw_var1 = $row['descuento'];
            $nw_ope = $row['signo'];
            $nw_var2 = $row['variable'];
            $nw_cant = $row['cantidad'];
            $nw_div = $row['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
              if($horizontales==0){
                    $hori = 0;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 0;
                }else{
                    $vert = $verticales;
                }

            include 'formula_perfil.php';
            $al = $med_perfil;
            
              if($nw_lado=='Vertical'){
                    $deto = $descuento_riel;
                    $detoa = $descuento_alfa;
                    $canfac = $vert;
                }else{
                    $deto = 0;
                    $detoa = 0;
                    $canfac = $hori;
                }
                if($nw_div=='1'){
                    $canfac = $canfac;
                    $perfac = $canfac.' '.$nw_lado;
                }else{
                    $canfac = 1;
                    $perfac='';
                }
            $medida = $med_perfil-$deto-$detoa;
            $cantidad = $row['cantidad']*$cant_item*$canfac;
            
            include 'costopintura.php';
                 
            $n=1000;
            
            
            $pst = (($row['peso'] * $medida) / 1000)*$cantidad;
            
            if($row['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
            }
            
            $medida = $medida; //-$deto-$detoa
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000; // ?? esto es para sacar la cantidad de perfiles de 6 mt
            $precio_total = $precio_actual * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            $total_perfil_costo += $precio_total;
            $total_perfil_desp += $totadesp;

            $pre_und = $precio_total / $cantidad;
            if($row['grupo']=='Perfileria Acero'){
                $costo_ace += $precio_total_acabado;
                $total_ace += $totadesp;
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
            }
            
            
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            //$peso_perfiles += $pst;
            if($row['grupo']=='Perfileria Acero'){
                $peso_acero += $pst;
            }else{
                $peso_perfiles += $pst;
            }

            $table = $table.'<tr><td width="10%" title="precio:'.$precio_actual.'">'.$row['referencia'].'</a></td>
            <td width="10%">'.$row['codigo'].'<br>'.$row['grupo'].'</td>
            <td width="40%">'.$row['descripcion'].'<br>Perimetro: '.$perimetro.'mt | Peso :'.$row['peso'].' Kg<br><i>'.$row['observacion_alu'].'</i></td>
            <td width="10%">'.$row['lado'].'</a></td>
            <td width="10%">'.number_format($medida).' mm<font></a></td>
            <td class="hidden-phone">'.number_format($pst,2,',','.').'</font></td>'
            . '<td class="hidden-phone">'.($cantidad/$cant_item).'</td><td class="hidden-phone">'.$cantidad.'</td>
            <td class="hidden-phone" style="text-align:right">$'.number_format($precio_actual).'</font></td>
            <td class="hidden-phone" style="text-align:right">$'.number_format($precio_total).'</td>
            <td class="hidden-phone" style="text-align:right" title="Valor Ml pintura'.$vc.' x '.$perimetro.' x '.($medida/1000).' x '.($cantidad / $rendimiento).' , rend: '.$rendimiento.'">$'.number_format($valor_acabado).'</td>
            <td class="hidden-phone" style="text-align:right">$'.number_format($precio_total_acabado).'</td>
            <td class="hidden-phone" style="text-align:right">'.number_format($porcentaje).'%</td>
            <td class="hidden-phone" style="text-align:right">$'.number_format($totadesp).'</td>'
            . '</tr>';   
              } 
             $table = $table.'<tr><td style="text-align:center"><b>TOTALES</b><td>-<td>-<td>-<td>-<td>-<td><td>-<td>-'
         . '<td>'.number_format($crudo).''
         . '<td>'.number_format($pintado).' '
         . '<td style="text-align:right">*'.number_format($costo_alu+$costo_ace).'<td>'
         . '<td style="text-align:right">'.number_format($total_alu+$total_ace).'';
      
  $table = $table.'</table>';
        
  echo $table;
     
} 
$costo_total_item += $costo_alu + $costo_ace;
$costo_total_item_desp += $total_alu+$total_ace;
echo 'Peso total perfiles:'.number_format($peso_perfiles).' Kg';  
echo '<br>Peso total Acero:'.number_format($peso_perfiles).' Kg';  
 ?>
                                </div>
                            </section>
                        </div>

                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">

                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>

                               <!--Modulo de regillas -->
                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Detalles de la ventana con rejillas</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse3" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab12">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 

$request_rej=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
                          
     
if($request_rej){
    echo $color;
        $table = '<table class="table table-bordered table-striped table-hover" id="">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="7%">'.'Referencia'.'</th>';
              $table = $table.'<th width="7%">'.'Cod. Comercial'.'</th>';
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Lado'.'</th>'; 
               $table = $table.'<th width="10%">'.'Medida.'.'</th>';
               $table = $table.'<th width="10%">'.'Peso T(Kg).'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'cant. und.'.'</th>';
               $table = $table.'<th width="10%">'.'Valor Ml.'.'</th>';
               $table = $table.'<th width="10%">'.'Crudo.'.'</th>';
               $table = $table.'<th width="10%">'.'Acabado.'.'</th>';
               $table = $table.'<th class="hidden-phone">Crudo+Acab.</th>';
               $table = $table.'<th class="hidden-phone">Desp</th>';
               $table = $table.'<th class="hidden-phone">Total</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $xx=0; $xxfom=0; 
        $peso_rej=0;
        $total_costo_rej = 0;
        $total_desp_rej = 0;
  while($row=mysql_fetch_array($request_rej))
  {     
             $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysql_fetch_array(mysql_query($pdlr));
             $precio_actual = $fia["precio_actual"];
             
             if($row["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($row["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($row["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($row["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["id_referencia_med"]."");
                $fil_an =mysql_fetch_array(mysql_query($sqlx));
                $id_p= $fil_an["id_p"];

                 $nw_medida = $fil_an['medida_r_a'];
                $nw_lado = $fil_an['lado'];
                $nw_var1 = $fil_an['descuento'];
                $nw_ope = $fil_an['signo'];
                $nw_var2 = $fil_an['variable'];
                $nw_cant = $fil_an['cantidad'];
                $nw_div = $fil_an['division'];
                $altura_v_c = $altura_v_c; // altura ventana corrediza
                $altura = $altura;// altura cuerpo fijo
                $anchura = $anchura; //ancho cuerpo fijo
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;

                include '../vistas/version2/productos/formula_perfil.php';
                $al = $med_perfil;
            }

       $request_vrej=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$row["medida_rej"]." ");
       while($col=mysql_fetch_array($request_vrej))
  {

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysql_fetch_array(mysql_query($sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            $nw_medida = $fil_anrej['medida_r_a'];
            $nw_lado = $fil_anrej['lado'];
            $nw_var1 = $fil_anrej['descuento'];
            $nw_ope = $fil_anrej['signo'];
            $nw_var2 = $fil_anrej['variable'];
            $nw_cant = $fil_anrej['cantidad'];
            $nw_div = $fil_anrej['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $alr = $med_perfil;
            
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $precio_actual / $porca;
         $prejfom = $precio_actual_fom / $porcaB; 
          
         
             if($row["medida_rej"]==0 || $row["medida_rej"]==999994){
                $medrej = ($ancho + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999999){
                $medrej = ($alto + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999998){
                $medrej = ($altura + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999997){
                $medrej = ($altura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $row["varr"]) / $row["en"]; 
            }else{
                if($row["medida_rej"]==999995){
                $medrej = ($anchura + $row["varr"]) / $row["en"]; 
            }else{
                $medrej = ($tvR + $row["varr"]) / $row["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
            $tv2 = ($al / $row['var3']) * $row['multiplo'];
          //parte nueva del cobro del anonisado
//            $perimetro = $row["area"]/1000;
//           if($perimetro=='0'){
//                $valor_acabado = $vc;
//           }else{
//               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
//           }
//           //fin de cobro
//
//            //$numero = ($medrej*$tv2)/$row["medida"];
//             
            
            include 'costopintura.php';
            //$valor_acabado = $valor_acabado*$cant_item;
            $valor_acabado = $vc * $perimetro * ($medrej/1000) * ($tv2 / $rendimiento);
            $valor_acabado = $valor_acabado*$cant_item;
            $pst_rej = (($row['peso'] * ($medrej/1000)))*$tv2*$cant_item;
            $peso_rej = $peso_rej + $pst_rej;
            
            $valor_u = ($precio_actual * $tv2 * ($medrej/1000));
            $valor_t = ($valor_u * $cant_item);
            
            $valor_total_rej = $valor_t  + $valor_acabado;
            
            $valor_tot_desp = $valor_total_rej / $porca;
            
           
            $total_costo_rej += $valor_total_rej;
            $total_desp_rej += $valor_tot_desp;
          
            $table = $table.'<tr><td width="7%" title="'.$row["id_referencia_med"].' '.$al .'/'. $row['var3'].' *'. $row['multiplo'].'">'.$row['referencia'].'</a></td>'
                    . '<td width="7%">'.$row['codigo'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion'].' <br>Perimetro:'.$perimetro.'mt | Peso: '.$row['peso'].' Kg</td>
                     <td width="10%">Horizontal</td>  
                     <td width="10%">'.number_format($medrej).' (mm)</font></td>'
                    . '<td class="hidden-phone">'.number_format($pst_rej,2,',','.').'</font></td>
                   <td class="hidden-phone">'.number_format($tv2).'x'.$cant_item.'</td>'
                    . '<td class="hidden-phone">'.number_format($precio_actual).'</td>'
                    . '<td class="hidden-phone">'.number_format($valor_t).'</font></td>'
                    . '<td class="hidden-phone">'.number_format($valor_acabado).'</font></td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($valor_total_rej).'</td>'
                    .'<td>'.$despalu.'%</td>'
                    . '<td class="hidden-phone"><font color="red">'.number_format($valor_tot_desp).'</td>'
                    . '</tr>';                 
  } 
    $table = $table.'<tr><td>Totales:</td><td colspan="7"></td>'
            . '<td></td>'
            . '<td></td>'
            . '<td>'.number_format($total_costo_rej).'</td>'
            . '<td></td>'
            . '<td>'.number_format($total_desp_rej).'</td>';
  $table = $table.'</table>';
        
  echo $table;
}
$costo_total_item += $total_costo_rej;
$costo_total_item_desp += $total_desp_rej;
 ?></div>
                            </section>
                        </div>


                    </div>
                    <!--/ END Row -->
                                    </div>
                     
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
<!--Fin Modulo de regillas -->
                               
                                  <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Reparto de vidrios</h4>
                                <!-- START Toolbar -->
                             
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse3" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                               
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab5">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php              
   $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
                $fi3 =mysql_fetch_array(mysql_query($s3));
                $costo_vidrio= $fi3["costo_v"]/$porcv;
                
            
$request_v=mysql_query("SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
    
 
if($request_v){

 
  //Por cada resultado pintamos una linea
        $total_vid=0;
        $total_vidsp=0;
        $cu = 0;
        $peso_vid = 0;$ci = 0;
  while($row=mysql_fetch_array($request_v))
  {      
            $ci += 1;
             if($row["ancho_v"]==0){
                
                $alb = $aa;
                if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $ancho;
                 }
            }else{
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysql_fetch_array(mysql_query($sqlx));
            $id_p= $fil_an["id_p"];
            
            $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
 
            }

            if($row["alto_v"]==0){
                $al2= $alto;
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysql_fetch_array(mysql_query($sqlw));
            
            $nw_medida = $fil_al['medida_r_a'];
            $nw_lado = $fil_al['lado'];
            $nw_var1 = $fil_al['descuento'];
            $nw_ope = $fil_al['signo'];
            $nw_var2 = $fil_al['variable'];
            $nw_cant = $fil_al['cantidad'];
            $nw_div = $fil_al['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al2 = $med_perfil;
            }
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysql_fetch_array(mysql_query($sqlx2));
  
            $nw_medida = $fil_an2['medida_r_a'];
            $nw_lado = $fil_an2['lado'];
            $nw_var1 = $fil_an2['descuento'];
            $nw_ope = $fil_an2['signo'];
            $nw_var2 = $fil_an2['variable'];
            $nw_cant = $fil_an2['cantidad'];
            $nw_div = $fil_an2['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al22 = $med_perfil;
            }else{
               
                
                $al22 = 0;
                $al22b = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysql_fetch_array(mysql_query($sqlw2));
            $nw_medida = $fil_al2['medida_r_a'];
            $nw_lado = $fil_al2['lado'];
            $nw_var1 = $fil_al2['descuento'];
            $nw_ope = $fil_al2['signo'];
            $nw_var2 = $fil_al2['variable'];
            $nw_cant = $fil_al2['cantidad'];
            $nw_div = $fil_al2['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al2x = $med_perfil;
            }else{
               $al2xb = 0;
                $al2x = 0;
            }
              $tv = ($al + $row['var1']) / $row['divisor'];
             // descuento o suma del cuerpo fijo
             if($row['cp']=='-1'){
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto'] - $altura; // calcular alto del vidrio
            }elseif($row['cp']=='1'){
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto'] + $altura; // calcular alto del vidrio
            }else{
                $tv2 = ($al2 + $row['var2'] - $al2x)  / $row['divisor_alto']; // calcular alto del vidrio
            }

             $tvb = ($alb + $row['var1']) / $row['divisor'];
//             $tv2b = ($al2b + $row['var2']) / $row['divisor_alto'];
             
            if(isset($al22)){
                $n = $al22;
                $an2 = $tv - $n;
                $an2b = $tvb - $n;
            }else{
                $n = 0;
                $an2 = $tv;
                $an2b = $tvb;
            }
            if($row['cp']==1){
                $cf = $altura;
              
            }else{
                if($row['cp']==-1){
                $cf = - $altura;
              
            }else{
                $cf = 0;
              
            }
              
            }
            if($row['desc']==0){
                $dess = 0;
              
            }else{
                $dess = $alto;
              
            }
            if(isset($al2x)){
                $nx = $al2x;
                $all = $tv2 - $dess;
            }else{
                $nx = 0;
                $all = $tv2 + $cf - $dess;
            }

            $m2 = ($an2/1000)*($all/1000);

              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $cant_item;
    echo '<span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho: '.number_format($an2).' x Alto: '.number_format($all).',   M<sup>2</sup>: '.number_format($metross,2,',','.').' , Total M<sup>2</sup>: '.number_format($metro_t,2,',','.').'</span>';
                if($aa!=0 && $cu==0){echo '<br><span style="color:blue">Medidas de '.$row['descripcion'].' : Ancho Abajo: '.number_format($an2b).' x Alto: '.number_format($all).'</span>';}
         $porc = $porcv;
         $gttotal_costo_vidrio = 0;
         $gttotal_despe_vidrio = 0;
         $gtpeso_vidrio = 0;
         if($traz_vid!=0){
             
                  $idvidrio = $id_vidrio; // espesor del vidrio
                  $idvidrio2 = $id_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include 'trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
  
             
         }
         if($traz_vid2!=0){
                  $idvidrio = $id2_vidrio; // espesor del vidrio
                  $idvidrio2 = $id2_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id2_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id2_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid2;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include 'trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         if($traz_vid3!=0){
                  $idvidrio = $id3_vidrio; // espesor del vidrio
                  $idvidrio2 = $id3_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id3_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id3_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid3;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include 'trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         if($traz_vid4!=0){
                   $idvidrio = $id4_vidrio; // espesor del vidrio
                  $idvidrio2 = $id4_vidrio2; // espesor del vidrio
                  $idvidrio3 = $id4_vidrio3; // espesor del vidrio
                  $idvidrio4 = $id4_vidrio4; // espesor del vidrio
                  $idtraz = $traz_vid4;    // trazabilidad del vidrio
                  $cantidad = $cant_item;
                  $m2 = $metro_t; // metros totales
                  include 'trazabilidad_modulos.php';
                  $gttotal_costo_vidrio += $total_costo_vidrio;
                  $gttotal_despe_vidrio += $total_despe_vidrio;
                  $gtpeso_vidrio += $peso_vidrio;
         }
         

                   $peso_vid = $gtpeso_vidrio;
                   $total_vid +=$gttotal_despe_vidrio;
                   $total_vidsp +=$gttotal_costo_vidrio;
                   $cu = $cu + 1;
          
  } 
//   
//  $table = $table.'</table>';
//   
//  echo $table;
                   
        
}
 ?></div>
                                
                            </section>
</div>
<table  class="table table-bordered table-striped table-hover">
    <tr>  
<?php echo '<td>Total de Costo Vidrio: $'.number_format($total_vidsp).' ';  ?>
<?php echo '<td>Total Costo con desperdicio: $'.number_format($total_vid).' ';  ?>
<tr>  
<?php echo '<td>El peso und del vidrio es: '.number_format($peso_vid/ $cant_item,2,',','.').' Kgs';  ?>
<?php echo '<td>El peso total del vidrio es: '.number_format($peso_vid,2,',','.').' Kgs';  ?>
</table>
<?php 
$costo_total_item += $total_vidsp;
$costo_total_item_desp += $total_vidsp / $porcv;
?>
 </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="row-fluid">
                     
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
<?php

?>

                             <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE ACCESORIOS PARA FABRICACIÓN | Desperdicio de <?php echo $despacc; ?>%</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                           
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab3">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
    $request_acE=mysql_query("SELECT *,c.id_referencia as refer FROM producto a, producto_rep_acc b, referencias c where b.id_ref_acc=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." order by b.para");
  
//    echo'<hr>';
              $table = '<table class="table table-bordered table-striped table-hover" id="">';
              $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Referencia'.'</th>';  
              $table = $table.'<th width="5%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="20%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="5%">'.'color'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Lado'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cantidad'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Para'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. Total.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'$ Fabr..'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Und'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Total'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Und + Desp'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Costo Total+Desp'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        $total2=0;
        $tac = 0;$tacfom = 0;
        $peso_acc=0;
        $costo_total_acc=0;
        $costo_desp_acc = 0;
        
                if($horizontales==0){
                    $hori = 0;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 0;
                }else{
                    $vert = $verticales;
                }

  while($row=mysql_fetch_array($request_acE))
  {      
          $referencia_material = $row['refer']; 
    //--------------------------------------------------------------------
    if($row['can_rej']!=0){
    $request_v2=mysql_query("SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_rej=".$row['can_rej']." ");
while($rowz=mysql_fetch_array($request_v2))
{
 if($rowz["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($rowz["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowz["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowz["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
                $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowz["id_referencia_med"]."");
                $fil_an =mysql_fetch_array(mysql_query($sqlx));
                $id_p= $fil_an["id_p"];
                $nw_medida = $fil_an['medida_r_a'];
                $nw_lado = $fil_an['lado'];
                $nw_var1 = $fil_an['descuento'];
                $nw_ope = $fil_an['signo'];
                $nw_var2 = $fil_an['variable'];
                $nw_cant = $fil_an['cantidad'];
                $nw_div = $fil_an['division'];
                $altura_v_c = $altura_v_c; // altura ventana corrediza
                $altura = $altura;// altura cuerpo fijo
                $anchura = $anchura; //ancho cuerpo fijo
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;
                include '../vistas/version2/productos/formula_perfil.php';
                $al = $med_perfil;
            }
     $cant_rej = (($al / $rowz['var3']) * $rowz['multiplo']);
  
}}else{
            $cant_rej = 1;
        }
             if($row["lado"]=='Vertical'){
                 $canfach = $vert;
                 $ambos_alto = $row["ambos"] * ($alto / 1000)*$vert;
                 $ambos_ancho = 0;
                 
             }else{
                 $canfach = $hori;
                 $ambos_alto = 0;
                 $ambos_ancho = $row["ambos"] * ($ancho / 1000)*$hori;
             }
             if($row["multiplica"]=='Si'){
                 $canfach = $canfach  ;
                 $ambos = $row["ambos"];
             }else{
                 $canfach = 1;
                 $ambos = $row["ambos"];
             }
             //formula para calcular medida fijas
             if($row['fija']==1){ 
                 $res = $row["cantidad_acc"]*($row["med"]/1000); // OK
             }else{
                if($row['calcular']=='ML'){

                  $res = ((($ancho / 1000) * 2)  + (($alto/1000)*2))*$row["cantidad_acc"] + $ambos_alto +$ambos_ancho;
                }else{
                   if($row['calcular']=='M2'){
                         $res = (($ancho / 1000)) * (($alto/1000))* $row["cantidad_acc"]*$canfach;
                   }else{
                    if($row["yes"]=='Si'){
                        if($row["lado"]=='Vertical'){
                            $res = (($row["cantidad_acc"]*$alto) / $row["metro"])*$canfach*$ambos;
                        }else{
                            $res = (($row["cantidad_acc"]*$ancho) / $row["metro"])*$canfach*$ambos;
                        }             
                    }else{
                         $res = $row["cantidad_acc"]*$canfach*$ambos;
                    }            
               }} 
             }//se  quito }
             $taa = $cant_rej * $res;
             if($row["med"]!=1){
                 $m = 1;
                 $f = ($taa*$cant_item);
                 $ft = $f * $row["valor_f"] ;
                 $a = $f * $row["valor_f"] ;
             }else{
                 $m = $row["med"];
                 $f = ''.($taa*$cant_item).' '.$row["calcular"].'';
                 $ft = 'No aplica' ;$a = '' ;
             }
             if($dolar_actual==0){
                $costo = $row["costo_mt"];
            }else{
                 $queryx1 = mysql_query("select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='".$referencia_material."' and b.categoria!='vidrio' ");
                 $Co = mysql_fetch_array($queryx1);
                 $costo = $Co["precio_actual"];
            }
            if($pelicula!='No Aplica' && $row['codigo']=='26044'){ 
            if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; }
            
            $tac = $tac + (($taa * $v) *($costo/$porcacc)*$m*$cant_item + $a);   
            $tacfom = $tacfom + (($taa * $v)*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            (($taa * $v) *($costo/$porcacc)*$m*$cant_item + $a); 
            $taa = $taa * $v;
            echo $pelicula;
            }
            if($row['codigo']!='26044'){ 
            $tac = $tac + ($taa * ($costo/$porcacc) * $m * $cant_item + $a);
            $tacfom = $tacfom + ($taa*($row["costo_fom"]/$porcaccB)*$m*$cant_item + $a);
            
            }
             $pst_acc = (($row['peso'] * $taa));
             $peso_acc = $peso_acc + $pst_acc;
             
             $costo_total_acc +=($taa*($costo)*$m*$cant_item + $a);
             $costo_desp_acc += ($taa*($costo/$porcacc)*$m*$cant_item + $a);
        
if($pelicula!='No Aplica' && $row['codigo']=='26044'){      
$table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
<td width="5%" tittle="'.$referencia_material.'">'.$row['codigo'].' </a></td>
<td width="20%">'.$row['descripcion'].' x '.$canfach.'<br><i>'.$row['observacion_acc'].' $'.$costo.'</i></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.$f.' </font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.number_format($taa,2).''.$row["calcular"].'</td><td class="hidden-phone">'.$ft.'</font></td>
<td class="hidden-phone">$'.number_format($taa*($costo)*$m + $a).'</font></td>
<td class="hidden-phone">$'.number_format($taa*($costo)*$m*$cant_item + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($row["costo_mt"]/$porcacc)*$m*$cant_item + $a).'</font></td>'
. '</tr>';   
      }     
  if($row['codigo']!='26044'){      
$table = $table.'<tr><td width="5%">' .$row['referencia'].'</a></td>
<td width="5%" tittle="'.$referencia_material.'">'.$row['codigo'].'</a></td>
<td width="20%">'.$row['descripcion'].' x '.$canfach.'<br><i>'.$row['observacion_acc'].' $'.$costo.'</i></td>
<td width="5%">'.$row["color_acc"].'<font></a></td>
<td class="hidden-phone">'.$row["lado"].'</font></td>
<td class="hidden-phone">'.number_format($taa,2).' '.$row["calcular"].'</font></td>
<td class="hidden-phone">'.$row["para"].'</font></td>
<td class="hidden-phone">'.number_format($f,2).''.$row["calcular"].'</td><td class="hidden-phone">'.$ft.'</font></td>
<td class="hidden-phone">$'.number_format($taa*($costo)*$m + $a).'</font></td>
<td class="hidden-phone">$'.number_format($taa*($costo)*$m*$cant_item + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($costo/$porcacc)*$m + $a).'</font></td>
<td class="hidden-phone">$<font color="red">'.number_format($taa*($costo/$porcacc)*$m*$cant_item + $a).'</font></td>'
. '</tr>';   
      }   
               
  }
        $request_acE2=mysql_query("SELECT * FROM referencias where id_referencia='".$rollo."' ");
        $total2=$total2;
        $tac = $tac;
        $tacfom = $tacfom;
  while($row = mysql_fetch_array($request_acE2)){
      if($laminas>2){
          $lam = $laminas - 1;
      }else{
          $lam = 1;
      }
      
      $mt2 = (($alto/1000)*($ancho/1000)) * $cantlam;
      
      
      if($dolar_actual==0){
          $costo = $row["costo_mt"];
      }else{
           $queryx = mysql_query("select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.id_referencia='$rollo' and b.categoria!='vidrio' ");
           $o = mysql_fetch_array($queryx);
           $costo = $o["precio_actual"];
      }
      
      $cos_und = $costo * $mt2;
      $cos_tot = $cos_und * $cant_item;
      $vlr_und = $cos_und / $porcacc;
      $vlr_tot = $vlr_und * $cant_item;
      $tac += $vlr_tot;
      
      $cosf_und = $row["costo_fom"] * $mt2;
      $cosf_tot = $cosf_und * $cant_item;
      $vlrf_und = $cosf_und / $porcaccB;
      $vlrf_tot = $vlrf_und * $cant_item;
      $tacfom += $vlrf_tot;
      
      $can_tot = $mt2 * $cant_item;
      
      $costo_total_acc +=($cos_tot);
      $costo_desp_acc += ($vlr_tot);
             
                    $table = $table.'<tr><td width="5%">'.$row['referencia'].'</a></td>
                    <td width="5%">'.$row['codigo'].'</a></td>
                    <td width="20%">'.$row['descripcion'].'</font></td>
                    <td width="5%">'.$row["color_acc"].'<font></a></td>
                    <td class="hidden-phone">'.$row["lado"].'</font></td>
                    <td class="hidden-phone">'.$mt2.' M2</td>
                    <td class="hidden-phone">'.$row["para"].'</font></td>
                    <td class="hidden-phone">'.$can_tot.' M2</font></td><td class="hidden-phone">'.$ft.'</font></td>
                    <td class="hidden-phone">$'.number_format($cos_und).'</font></td>
                    <td class="hidden-phone">$'.number_format($cos_tot).'</font></td>
                    <td class="hidden-phone">$<font color="red">'.number_format($vlr_und).'</font></td>
                    <td class="hidden-phone">$<font color="red">'.number_format($vlr_tot).'</font></td>'
                    . '</tr>';     

  }
  
          $request_kits=mysql_query("SELECT * FROM receta_kits where idkit in ('$cierres','$rodajas','$idespaciador') ");
       
  while($rowt = mysql_fetch_array($request_kits)){
  
       if($rowt["modulo"]=='Cierres'){
          $cankitt = $cancierres;
      }else if($rowt["modulo"]=='Espaciadores'){
          $cankitt = $canespaciador;
      }else{
          $cankitt = $canrodajas;
      }
      $can_tott = $cankitt * $cant_item;
     $modu = $rowt["modulo"];
     
      
                    $table = $table.'<tr style="color:#86BE8C"><td width="5%">'.$rowt['idkit'].'</a></td>
                    <td width="5%">'.$rowt['idkit'].'</a></td>
                    <td width="20%" colspan="3">'.$rowt['descripcion'].'</font></td>
                
                    <td class="hidden-phone">'.$cankitt.' </td>
                    <td class="hidden-phone"> - </td>
                    <td class="hidden-phone">'.$can_tott.' Und</font></td><td class="hidden-phone"> - </td>
                    <td class="hidden-phone">-</td>
                    <td class="hidden-phone">-</font></td>
                    <td class="hidden-phone">-</td>
                    <td class="hidden-phone">-</td>'
                    . '</tr>';  
      $request_kitsi=mysql_query("SELECT * FROM receta_kits_items where idkit in ('".$rowt['idkit']."') ");
       
  while($row = mysql_fetch_array($request_kitsi)){
      
          $cankit = $cankitt*$row["cantidad"];
     
      
      
      if($dolar_actual==0){
          $querypro = mysql_query("select costo_mt from referencias where codigo='".$row['codigo_pro']."'  ");
           $v = mysql_fetch_array($querypro);
          $costo = $v[0];
      }else{
           $queryx = mysql_query("select precio_actual,precio_dolar,precio,id_referencia from dolar_actual a,dolar_relaciones_vidrio b where a.id_actual=b.id_dolar and b.id_dolar='$dolar_actual' and b.cod_ref='".$row['codigo_pro']."' and b.categoria!='vidrio' ");
           $o = mysql_fetch_array($queryx);
           $costo = $o["precio_actual"];
      }
      
      $can_tot = $cankit * $cant_item;
      $cos_und = $costo;
      $cos_tot = $cos_und * $can_tot;
      $vlr_und = $cos_und / $porcacc;
      $vlr_tot = $vlr_und * $can_tot;
      $tac += $vlr_tot;
     
     $costo_total_acc +=($cos_tot);
      $costo_desp_acc += ($vlr_tot);
     
      
                    $table = $table.'<tr><td width="5%">'.$row['codigo_pro'].'</a></td>
                    <td width="5%">'.$row['codigo_pro'].'</a></td>
                    <td width="20%">'.$row['descripcion_pro'].'</font></td>
                    <td width="5%"> - </td>
                    <td class="hidden-phone"> - </td>
                    <td class="hidden-phone">'.$cankit.' </td>
                    <td class="hidden-phone"> - </td>
                    <td class="hidden-phone">'.$can_tot.' Und</font></td><td class="hidden-phone"> - </td>
                    <td class="hidden-phone">$'.number_format($cos_und).'</font></td>
                    <td class="hidden-phone">$'.number_format($cos_tot).'</font></td>
                    <td class="hidden-phone">$<font color="red">'.number_format($vlr_und).'</font></td>
                    <td class="hidden-phone">$<font color="red">'.number_format($vlr_tot).'</font></td>'
                    . '</tr>';  
      
  }              
                    

  }
  
  
  
  $table = $table.'<tr><td>-<td>-<td style="text-align:center"><b>TOTALES=</b>'
          . '<td>-<td>-<td>-<td>-<td>-<td>-<td>-'
          . '<td>'.number_format($tac_p = $tac * $porcacc).'<td>-<td>'.number_format($tac).'';     
  $table = $table.'</table>';
        
  
      
  echo $table;   
echo '<table   class="table table-bordered table-striped table-hover">';
echo '<tr>';
echo '<td>Costo Lista Unidad: $'.number_format($tac * $porcacc / $cant_item).'</font></td>';
echo '<td>Costo Lista Unidad + Desperdicio: $<font color="red">'.number_format($tac / $cant_item).'</font></td>'; 
echo '<td>El peso ud de los insumos es de:'.number_format($peso_acc / $cant_item,3,',','.').' Kgs</td>'; 
echo '<tr>';
echo '<td>Costo Lista Total: $'.number_format($tac_p = $tac * $porcacc).'</font></td>'; 
echo '<td>Costo Lista Total + Desperdicio: $<font color="red">'.number_format($tac).'</font></td>'; 

echo '<td>El peso total de los insumos es de:'.number_format($peso_acc,3,',','.').' Kgs</td>'; 
echo '</table>';



echo '<br>';
echo 'Total de costo accesorios : $'.number_format($tac);
echo '<br>Total de costo + desperdicio accesorios : $'.number_format($tac_p);
 ?>
                            </section>
                        </div>
                        
<?php 
$costo_total_item += $tac_p;
$costo_total_item_desp += $tac;

?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab4">
                                  
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
                           </section></div>&nbsp;
  
                                          <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Mano de Obra por Producto</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
                   
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab7">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
   
$request_maq=mysql_query("SELECT * FROM producto a, producto_rep_mo b, referencia_mo c where b.id_ref_mo=c.id_ref_mo and a.id_p=b.id_p and a.id_p=".$id_referencia);
    
     
if($request_maq){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="10%">'.'referencia'.'</th>';             
              $table = $table.'<th width="40%">'.'Descripcion'.'</th>';
              $table = $table.'<th width="10%">'.'Instalacion ?'.'</th>';
              $table = $table.'<th width="10%">'.'Cobrado por'.'</th>';
                    $table = $table.'<th width="10%">'.'Cantidad.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Und.'.'</th>';
              $table = $table.'<th width="10%">'.'Valor Total.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $totmo=0;
        $tot_fom=0;
        $total_fab = 0;
        $total_ins=0;
        $total_pol = 0;
  while($row=mysql_fetch_array($request_maq))
  {       
            $mt2 = ($alto/1000)*($ancho/1000);
            $mtl = ($ancho/1000);
            if($mt2<1){
                $mt2 = 1;
            }  else {
                $mt2 = $mt2;
            }
            if($install=='Si'){
                
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($cant_item*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mtl*($cant_item*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                }
                if($row['instalacion']=='No'){
             if($row['unidad_cobro']=='M2'){
                    $tarf =  $mt2*($cant_item*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='ML'){
                    $tarf =  $mt2*($cant_item*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Und'){
                    $tarf =  ($cant_item*$row["valor_mo"]);
                   
                }
                if($row['unidad_cobro']=='Kg'){
                    $tarf =  ($cant_item*$row["valor_mo"]);
                    
                }  
                if($row['referencia']!='26002'){ 
                $tot_fom = $tot_fom + $tarf;
                }
                if($pelicula!='No Aplica' && $row['referencia']=='26002'){
                    if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                  $tot_fom = $tot_fom + ($tarf * $v); 
                  $tarf = $tarf * $v;
                  $total_pol = $tarf;
                }
                }
                if($row['referencia']!='26002'){ 
                $totmo = $totmo + $tar;
                }
              
                
            }else{
                if($row['unidad_cobro']=='M2'){
                    $tar =  $mt2*($cant_item*$row["valor_mo"]);
                    $tarf =  $tar;
                }
                if($row['unidad_cobro']=='ML'){
                    $tar =  $mt2*($cant_item*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Und'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['unidad_cobro']=='Kg'){
                    $tar =  ($cant_item*$row["valor_mo"]);
                     $tarf =  $tar;
                }
                if($row['instalacion']=='No'){
             
                if($row['referencia']!='26002'){ 
                $totmo = $totmo + $tar;
                $tot_fom = $tot_fom + $tarf;
                
                }
               
                }else{
                    if($pelicula!='No Aplica' && $row['referencia']=='26002'){ 
                             if($pelicula=="Una Cara"){ $v = 1; }else{ $v = 2; } 
                             $totmo = $totmo + ($tar * $v);
                             $tar = $tar * $v;
                             $total_pol = $tar;
                    }else{
                        $tar = 0;
                    }
                    
                }
            }
            if($row['instalacion']=='No'){
                 $total_fab += $tar;
            }else{
                 if($pelicula=='No Aplica'){
                     if($row['referencia']!='26002'){ 
                         $total_ins += $tar;
                     }
                 }else{
                     if($row['referencia']=='26002'){ 
                         $total_pol += $tar;
                     }else{
                         $total_ins += $tar; 
                     }
                 }
            }
            
              if($row['referencia']!='26002'){ 
            $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
                    . '<td width="10%">'.$cant_item.'<font></a></td>'
                    . '<td width="10%">$ '.$row["valor_mo"].'<font></a></td>
               <td width="10%">$ '.number_format($tar).'<font></a></td></tr>'; 
              }
                   if($pelicula!='No Aplica' && $row['referencia']=='26002'){  
                          $table = $table.'<tr><td width="10%">'.$row['referencia'].'</a></td>'
                    . '<td width="40%">'.$row['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row['instalacion'].'</font></td>'
                    . '<td width="10%">'.$row['unidad_cobro'].'</font></td>'
                    . '<td width="10%">'.$cant_item.'<font></a></td>'
                    . '<td width="10%">$ '.number_format($row["valor_mo"]).'<font></a></td>
               <td width="10%">$ '.number_format($tar).'<font></a></td></tr>'; 
                       
                       
                       
                   }
    
               
  } 
  $table = $table.'</table>';
        
  echo $table;
        
}
 ?>
                                </div>
                            </section>
                        </div>
<?php 
$totmo = $total_ins +$total_pol+$total_fab;
echo '<table class="table table-bordered table-striped table-hover" id="">';
echo '<tr><td>Total en mano de obra '.$totmo.' + parafiscales: $'.number_format($totmo * 1.45);
echo '<tr><td>Total Instalacion'.$total_ins.' ';
echo '<tr><td>Total Instalacion polimax'.$total_pol.' ';
echo '</table>';
$ser = 0;
$costo_total_item += $totmo * 1.45;
$costo_total_item_desp += $totmo * 1.45;
$ser += ($totmo * 1.45);
?>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
              
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section>
</div>
                                 <div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Servicios adicionales</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
              
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab9">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">
                                  
<?php 
$request2=mysql_query("SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cot_mas=".$id_cotizacion." ");
    
if($request2){
//    echo'<hr>';
       $table2 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table2 = $table2.'<thead >';
              $table2 = $table2.'<tr bgcolor="#D1EEF0">';
              $table2 = $table2.'<th width="5%">'.'Items'.'</th>';    
              $table2 = $table2.'<th width="5%">'.'Codigo'.'</th>'; 
              $table2 = $table2.'<th width="40%">'.'Descripcion del servicio'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Referencia'.'</th>';
              $table2 = $table2.'<th width="10%">'.'Pago Ins'.'</th>';   
             
              $table2 = $table2.'<th width="10%">'.'Descuento'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Cantidad'.'</th>'; 
              $table2 = $table2.'<th width="10%">'.'Total Pago'.'</th>'; 
           
              $table2 = $table2.'<th width="10%">'.'Costo Total'.'</th>'; 

              $table2 = $table2.'</tr>';
              $table2 = $table2.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2s=0;
        $to_serv =0;
	while($row2=mysql_fetch_array($request2))
	{    
            
                  
        $pr = (100 - $row2["utilidad"]) / 100;
        $fr = ($row2["precio_servicio"]*$cant_item) ;
        
             $total2s= $total2s +  1;
             $des = ($row2['descuento_serv']/100) * $fr;
             $dd = ($fr + $des) * $row2["cantidad_serv"];
            
             $to_serv = $to_serv + $dd;

            $table2 = $table2.'<tr><td width="5%">'.$total2s.'</a></td><td width="5%">'.$row2['id_ref_mo'].'</font></td>'
                    . '<td width="40%"><a href="../vistas/?id=ver_gastos&cod='.$row2['id_ref_mo'].' ">'.$row2['descripcion_mo'].'</font></td>'
                    . '<td width="10%">'.$row2["referencia"].'</a></td>
               <td width="10%">$'.number_format($fr).'</td>'
                    . '<td width="10%">'.$row2["descuento_serv"].'%</td>'
                    . '<td width="10%">'.$row2["cantidad_serv"].'</td><td width="10%">'.number_format($dd).'</td>'
                         . '<td width="10%">'.number_format(($dd)).'</td></tr>';   
           
		
               
	} 
	$table2 = $table2.'</table>';
        
	echo $table2.'<br><hr>';
         echo '<div align="right"><FONT color="red"><h5>TOTAL SERVICIOS + parafiscales: $'.number_format($to_serv * 1.45).'</h5></FONT></div>';
      
 $costo_total_item += $to_serv;
 $costo_total_item_desp += $to_serv * 1.45;
} 
$ser += ($to_serv * 1.45);
 ?>
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>


                                    </div>
                                    <div class="tab-pane" id="tab10">
                                        <div class="row-fluid">
                        
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>

<div class="row-fluid">
      <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE ELEMETOS ADICIONALES (Materia Prima)</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>     
<?php  

$request_ack=mysql_query("SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_cot=".$id_cotizacion."  ");
     
if($request_ack){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="5%">'.'Codigo'.'</th>'; 
              $table = $table.'<th width="30%">'.'Descripcion'.'</th>';             
              $table = $table.'<th width="5%">'.'Referencia'.'</th>';
               $table = $table.'<th width="5%">'.'Lado'.'</th>';
               $table = $table.'<th width="10%">'.'Cantidad'.'</th>';
               $table = $table.'<th width="10%">'.'Medida'.'</th>';
              $table = $table.'<th width="10%">'.'costo base.'.'</th>';
              $table = $table.'<th width="10%">'.'costo '.$_GET['por'].''.'</th>';
              $table = $table.'<th width="10%">'.'costo total.'.'</th>';
              
              $table = $table.'</tr>';
              $table = $table.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t=0;$total2ak=0;$cb=0;
  while($row=mysql_fetch_array($request_ack))
  {       $t = $t +1;
            
                
                
                if($row["med"]==1){
                    $v = 1 *$cant_item;
                }else{
                    $v = ($row["med"]/1000)*$cant_item;
                }
                if($row["calcular"]=='ML'){
                if($row["lado"]=='Vertical'){
                $mt = ($alto/1000)*($row["metro"]/1000);
                $mte = ($alto/1000)*($row["metro"]/1000);
                }else{
                $mt = ($ancho/1000)*($row["metro"]/1000);
                $mte = ($ancho/1000)*($row["metro"]/1000);
                }
                }else{
                 $mt = $row["cantidad_m"];
                 $mte = $row["cantidad_m"] * $v;
                }
                $pp = $row["costo_mt"]/$porca;
                $total2ak= $total2ak + $mte*$pp;
                $cb += $row["costo_mt"] * $mte;
            $table = $table.'<tr><td width="5%">'.$porca.'</a></td>'
                    . '<td width="5%">'.$row['num_ref'].'</a></td>'
                    . '<td width="30%">'.$row['descripcion'].'</td>'
                    . '<td width="5%">'.$row["codigo"].'<font></a></td>'
                    . '<td width="5%">'.$row["lado"].'<font></a></td>
               <td width="10%">'.$row["cantidad_m"].' '.$row["calcular"].'</font></td><td width="10%"> '.$row["med"].' mm</font></td>'
                    . '<td width="10%">$'.number_format($row["costo_mt"]* $mt).'</font></td>'
                    . '<td width="10%">$'.number_format($pp).'</font></td>'
                    . '<td width="10%">$'.number_format($mte*$pp).'</font></td>'
                    . '</tr>';   
          
    
               
  } 
  $table = $table.'</table>';
        
  echo $table;
}

echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional: $'.number_format($cb).'</h5></FONT></div>';
echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional + Desperdicio: $'.number_format($cbb = $total2ak).'</h5></FONT></div>';
//echo '<div align="right"><FONT color="red"><h5>Costo Total de lista adicional Bogota: $'.number_format($cb*1.1).'</h5></FONT></div>';
$costo_total_item += $cb;
 $costo_total_item_desp += $cbb;    
?>
       
      </div></div>
<div class="row-fluid">
      <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE KIT DE ACCESORIOS</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>     
<?php    

$request4=mysql_query("SELECT * FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_prod_mas=".$id_cotizacion." and b.comp='1'  ");

if($request4){
//    echo'<hr>';
       $table4 = '<table class="table table-bordered table-striped table-hover" id="">';
             $table4 = $table4.'<thead >';
              $table4 = $table4.'<tr bgcolor="#D1EEF0">';
              $table4 = $table4.'<th width="5%">'.'Items'.'</th>';    
              $table4 = $table4.'<th width="10%">'.'Codigo'.'</th>'; 
              $table4 = $table4.'<th width="30%">'.'Descripcion del kit'.'</th>';
              $table4 = $table4.'<th width="10%">'.'Referencia'.'</th>';
              $table4 = $table4.'<th width="5%">'.'Medida'.'</th>';
              $table4 = $table4.'<th width="5%">'.'Costo'.'</th>';  
              $table4 = $table4.'<th width="5%">'.'Costo + P'.'</th>'; 
              $table4 = $table4.'<th width="5%">'.'Descuento'.'</th>'; 
              $table4 = $table4.'<th width="5%">'.'Cantidad'.'</th>'; 
              $table4 = $table4.'<th width="5%">'.'Costo Total'.'</th>'; 
    
              $table4 = $table4.'</tr>';
              $table4 = $table4.'</thead>';
  
        
  //Por cada resultado pintamos una linea
        $t2e=0;
        $to_kk =0;
     
                
            $ksp = 0;    
  while($row21k=mysql_fetch_array($request4))
  {       
  
             $t2e= $t2e + 1;
             
            include '../modelo/suma_kit_1.php';
            
             $desm = ($row21k['desc_k']/100) * ($ktotk);
             $ddm = ($ktotk + $desm) / $porcacc;
             $to_kk = $to_kk + $ddm;
             $ksp += $ktotk;

            $table4 = $table4.'<tr><td width="5%">'.$t2e.'</a></td>'
                    . '<td width="10%">'.$row21k['codigo'].'</font></td>'
                    . '<td width="30%">'.$row21k['producto'].' '.$row21k["linea"].'</font></td>'
                    . '<td width="10%">'.$row21k["referencia_p"].'<font></a></td>
                        <td width="5%">N/A</td>
                        <td width="5%">$'.number_format(($ktotk)).'</td>
                        <td width="5%">$'.number_format(($ktotk)/ $porcacc).'</td>'
                    . '<td width="5%">'.$row21k["desc_k"].'%</td>'
                    . '<td width="5%">'.$row21k["cantidad_k"].'</td>'
                    . '<td width="5%">'.number_format($ddm).'</td>'
                    . '</tr>';   
           
    
               
  } 
  $table4 = $table4.'</table>';
        
  echo $table4;

} 
echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios: $'.number_format($ksp).'</h5></FONT></div>';
echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios + Desperdicio: $'.number_format($to_kk).'</h5></FONT></div>';
//echo '<div align="right"><FONT color="red"><h5>Costo Total de Kit de Accesorios + P: $'.number_format($clb=$ksp*1.1).'</h5></FONT></div>';
$costo_total_item += $ksp;
 $costo_total_item_desp += $to_kk;   
?>
      </div></div>
                           
                           <div class="row-fluid">
      <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">LISTADO DE COMPLEMENTOS</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>     
<?php    

 
   $request2=mysql_query("SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_compuesto = " .$_GET['item']. " ORDER BY c.fila ASC ");
  
  $table = "";

       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr bgcolor="#D1EEF0">';
              $table = $table.'<th>'.'Copy'.'</th>';
              $table = $table.'<th width="2%">'.'Tipo'.'</th>'; 
              $table = $table.'<th width="2%">'.'#'.'</th>'; 
              $table = $table.'<th width="7%">'.'Ref'.'</th>'; 
              $table = $table.'<th width="25%">'.'Producto'.'</th>';
              $table = $table.'<th width="9%">'.'Color Vid.'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Ancho <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Alto <br>(mm)'.'</th>';
              $table = $table.'<th class="hidden-phone">'.'Cant. <br>Total.'.'</th>';
              if($estado=='Aprobado'){$table = $table.'<th class="hidden-phone">'.'Cant. Pendiente'.'</th>';}
              $table = $table.'<th width="15%" style="text-align:center">Valores</th>';
              $table = $table.'<th class="hidden-phone">'.'%.'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysql_fetch_array($request2))
	{    
                $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysql_fetch_array(mysql_query($cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysql_fetch_array(mysql_query($cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysql_fetch_array(mysql_query($cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysql_fetch_array(mysql_query($cons_vir3));
                $cons_vir5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio5']." ";
                $fv5 =mysql_fetch_array(mysql_query($cons_vir5));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysql_fetch_array(mysql_query($cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysql_fetch_array(mysql_query($cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysql_fetch_array(mysql_query($cons_vi4));
                $cons_vi5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio4']." ";
                $fv25 =mysql_fetch_array(mysql_query($cons_vi5));
                
                $s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = '".$row["linea_cot"]."'";
                $fi3 = mysql_fetch_array(mysql_query($s3));
                $mult = $fi3["p"] / 100;
                //SE ADICIONA PORCENTAJES FIJOS DE DESCUENTO
//                                        $por_general = mysql_query("select (" . $row["porcentaje"] . ") FROM porcentaje_general ");
//                                        $pg = mysql_fetch_row($por_general);
//                                        $gen_desc = $pg[0] / 100;
                                        
                                        
            $comp=mysql_query("SELECT count(*) FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm1 = mysql_fetch_array($comp);
            $d = $cm1['count(*)'];
            
            $ac =mysql_query("SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysql_fetch_array($ac);
            $mt = $cm['count(*)'];
            
              $ak =mysql_query("SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$row["id_cotizacion"]." and b.comp='1'  ");
            $ck = mysql_fetch_array($ak);
            $mtk = $ck['count(*)'];
            
            $as =mysql_query("SELECT count(*) FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=".$row["id_cotizacion"]." ");
            $cs = mysql_fetch_array($as);
            $mts = $cs['count(*)'];
            $compu =mysql_query("SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysql_fetch_array($compu)){
        
                 $sx = "SELECT (".$fila["porcentaje_sub"].") as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                $fix =mysql_fetch_array(mysql_query($sx));
                $multx= $fix["p"]/100;
                
          $costo_sp += $fila['valor_sp'];
          $costo_fom_sp += $fila['valor_fom_sp'];
          $costo_mp += $fila['valor_c_sub']/$multx;
          $costo_fom_mp += $fila['valor_fom_sub'];
          
    }
           $t = $d + $mt + $mtk + $mts;

            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           if($row['poralu']!=0){
               $a = $row['precio_item'];
           }else{
                if($row['id_referencia']==1633){
                   $a = $tk;
                }else{
                   $a = ($row["valor_c"] / $mult) + $pad  + $tk;
                }
           }
           
           

            
//            echo ($tk ) .'<br>';
            if($row["linea_cot"]=='Vidrio' || $row["linea_cot"]=='VIDRIO'){$d1 = 'Per:'.$row["per"].'<br>Boq:'.$row["boq"];}else{$d1 = 'Color Alum:'.$row["color_ta"];}
            $cont = $cont + 1;
          
            if($row["cuerpo"]!=0){$m = 'Cuerpo Fijo: '.$row["cuerpo"].' mm';}else{$m = '';}
            // modificar de este lado
                                
            $pu = ($a/$row["cantidad_c"]);
            $descpor = $pu *  $row["desc"]/100;
            $pud = $pu + $descpor;
             $descuento_g = ($row["descuento_g"] / 100) * $pud;
             $pudt = $pud - $descuento_g;
            $ptt = ($pudt) * $row["cantidad_c"];
            $tacot = $tacot + $ptt;
           
                     if($estado=='En proceso'){ 
                         $img_delx ='<input type="checkbox" name="item" id="'.$row["id_cotizacion"].'" value="">';
            if($editar_cot=='Habilitado'){$up = '&up='.$row["id_cotizacion"].'';}else{$up = '';}
            if($eliminar_cot=='Habilitado'){$del = '&del='.$row["id_cotizacion"].'&v='.$cont;}else{$del = '';}
            $img_up = '<button type="button"><img src="../imagenes/modificar.png"></button>'; 
            
            //$img_del ='<button type="button"  onclick="eliminar_prod('.$row['id_cotizacion'].','.$_GET['cot'].','.$_GET['cli'].')"><img src="../imagenes/eliminar.png" style="cursor:pointer"></button>';
            $copiar = '<button type="button" id="'.$row["id_cotizacion"].'" onclick="copiar('.$row["id_cotizacion"].','.$_GET["cot"].','.$_GET["cli"].');"><img src="../imagenes/copiar.png"></button>';
                     }else{
                $up = '';$del = '';$img_up = ''; $img_delx =''; $copiar ='';
            }
         if($crear_ped=='Habilitado'){$add = '';}else{$add = '';}
     $con2= "SELECT * FROM `producto` where id_p=".$row['traz_vid']." ";
$res2=  mysql_query($con2);
while($f8=  mysql_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];
}
if($row['traz_vid2']==0){
    $nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysql_query($con22);
while($f8r=  mysql_fetch_array($res22)){
$idco2=$f8r['id_p'];
$nombr2=$f8r['producto'];
}}
if($row['traz_vid3']==0){
    $nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysql_query($con23);
while($f8=  mysql_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];
}}
if($row['traz_vid4']==0){
    $nombr3='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysql_query($con24);
while($f8=  mysql_fetch_array($res24)){
$idco4=$f8['id_p'];
$nombr4=$f8['producto'];
}}
$v1 = $fv1['color_v'];
if($fv2['color_v']==''){$v2 = '';}else{$v2 = '+'.$fv2['color_v'];}
if($fv3['color_v']==''){$v3 = '';}else{$v3 = '+'.$fv3['color_v'];}
if($fv4['color_v']==''){$v4 = '';}else{$v4 = '+'.$fv4['color_v'];}
if($fv5['color_v']==''){$v5 = '';}else{$v5 = '+'.$fv5['color_v'];}
$v21 = $fv21['color_v'];
if($fv22['color_v']==''){$v22 = '';}else{$v22 = '+'.$fv22['color_v'];}
if($fv23['color_v']==''){$v23 = '';}else{$v23 = '+'.$fv23['color_v'];}
if($fv24['color_v']==''){$v24 = '';}else{$v24 = '+'.$fv24['color_v'];}
if($fv25['color_v']==''){$v25 = '';}else{$v25 = '+'.$fv25['color_v'];}
             $tip =$row['tip']; $tip2 =$row['fila'];
            if($row['id_vidrio']!=0 && $row['id_vidrio2']!=0){
                $vi = $v1.$v2.$v3.$v4.$v5.' - '.$nombr;
            }else{
                if($fv1['espesor_v']!='' && $row['producto']!=$nombr){
                 $vi = $fv1['color_v'].' '.$nombr;
                }else{
                 $vi = $fv1['color_v'];
                }
            }
                      
               if($row['cont_item']!='0'){
                $stilon = 'style="background-color:green;" title="¡Este item tiene notas!" ';
            
             }else{
                $stilon = '';
             
              }
                
            if($row['id2_vidrio']!=0 && $row['id2_vidrio2']!=0){
                $vi2 = $v21.$v22.$v23.$v24.$v25.' - '.$nombr2;
            }else{
                
                 $vi2 = $fv21['color_v'].' - '.$nombr2;
            }
               $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99 ";
            $fila21 =mysql_fetch_array(mysql_query($sql21));
      if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
                if($row['pelicula']=='Una Cara'){
                    $peli = ', + '.$fila21['descripcion_mo'];
                 }else{
                    $peli = ', + '.$fila21['descripcion_mo'].' ambos lados';
                      }
                   }
                 $iva3 = $ptt * ($sel_iva/100);
                 $tota = $ptt + $iva3;
                 $pdlr = "select * from dolares where id_dolar=".$row['id_dolar']."  ";
                 $fia =mysql_fetch_array(mysql_query($pdlr));
                 $precio_actual= $fia["precio_dolar"];
                
                if($row["valor_temp"]==0){
                    $w = '';
                }else{
                     $w = '<img src="../imagenes/warning.png" title="Advertencia tiene Precios ingresado manualmente">';
                }
               
                $ref='';
                $noti='';
                $noti2='';
                if($row['id_referencia']==1633){$ref='<p style="color: red;"><b>HUACAL</b></p>';}else{$ref='<input type="hidden" id="it'.$row["id_cotizacion"].'" value="'.$tip.'"> '.$row['producto'].' '.$peli.', '.$row['observaciones'].', '.$m.','.$d1.', Cierre: '.$row["cierre"].', Inst: '.$row["install"].', Lam: '.$row["laminas"].' '.$noti.''.$noti2.' <br>'.$row["descripcion_rollo"].'<br>Se Cotizó con el Dollar a: $ '.$precio_actual.' '
                        . '<button type="button" '.$stilon.' onclick="com('.$row["id_cotizacion"].')"> <b>?</b> </button> <a href="../vistas/?id=ver_dt&item='.$row["id_cotizacion"].'" target="_blank">DT</a>';}
                if($row['msg']!=''){$noti='<br><b> <font color="red">'.$row['msg'].' </b>';}else{$noti='';}
                if($row['msg2']!=''){$noti2='<br><b> <font color="red">'.$row['msg2'].' </b>';}else{$noti2='';}
                if($estado=='Aprobado'){$pen = '<td class="hidden-phone"><div align="center"><font color="red">'.$row["cant_restante"].'</font></td>';}else{$pen = '';}
                $ver_reportex = '<a href="'.$ver_reporte.'" '.$om.' target="_blank">';
                $table = $table.'<tr>'
. '<td> '.$copiar. ' '.$w.'</td>'
. '<td width="2%">'.$tip.'</td><td width="2%">'.$tip2.'</td>
<td width="7%">'.$row['codigo'].'</font></td>
<td width="25%">'.$ref.'<input type="checkbox" name="item2" id="'.$row["id_cotizacion"].'" value="" checked disabled></td>                     
<td width="9%">'.$vi.'<br>'.$vi2.'</td>
<td class="hidden-phone"><div align="center">'.$row["ancho_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["alto_c"].'</div></td>
<td class="hidden-phone"><div align="center">'.$row["cantidad_c"].'</div></td>'.$pen.'
<td class="hidden-phone"><div align="center"> 
<table style="font-size:13px">
<tr><td><b>Precio Und. $</b></td><td style="text-align:right">'.number_format($pu).'</td>
<tr><td><b>Descuento $</b></td><td style="text-align:right">'.number_format($descpor).'</td>
<tr><td><b>Precio + Desc $</b></td><td style="text-align:right">'.number_format($pudt).'</td>
<tr><td><b>Precio Total $</a></b></td><td style="text-align:right">'.number_format($ptt).'</td>
<tr><td><b>Total+Iva $</b></td>'
                    . '<td style="text-align:right"><font color="red">'.number_format($tota).'</font>
                        <input type="hidden" id="ver'.$row["id_cotizacion"].'" value="'.$rep.'"></td>
</table>
</td>
<td class="hidden-phone">'.number_format($row["desc"],2,',','').'</a></td></tr>';   
       
	} 
	$table = $table.'</table>';
       
	echo $table.'<br><hr>'; 
        
        ///  --------------------------------------------servicios-----------------------------------------

        echo '<hr>';
        if($cont!=0){
     echo '<div align="right"><FONT color="red"><h5>TOTAL COT.: $'.number_format($tacot).'</h5></FONT>'
             . '</div>'
             . '<input type="hidden" id="to" value="'.$tacot.'">';} 
    
    $precio_compuesto = $ptt; 

?>
          <script>
           
              function compuestos(id){
                    
                        $.ajax({
                                post:'GET',
                                data:'iditems='+id+'',
                                url:'../vistas/cotizacion/mostrar_compuestos.php',
                                success:function(a){
                                  
                                   $("#lista_compuesto").html(a);     
                                } 
                            });
                    }
              </script>
         <a href="javascript:void(0)" onclick="compuestos(<?php echo $_GET['item']; ?>)">Mostrar detalles de compuesto</a> 
          <div id="lista_compuesto">
              <?php
//$query_cot = mysql_query("select id_cotizacion,id_compuesto from cotizaciones where id_compuesto='".$_GET['item']."'  ");
//$c = 0;
//while ($cr = mysql_fetch_array($query_cot)){
//   
//    $id_items = $cr[0];
//    $_GET['item'] = $cr[0];
//   //echo $_GET['item'];
//    include 'dt.php';
//    
//}
              ?>
          </div>
      </div></div>
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Costo Detallado</h4>
                                <!-- START Toolbar -->
                                <ul class="toolbar pull-left">
                                    <li><a class="link" data-toggle="collapse1" href="#collapse1"><span class="icon icone-chevron-up"></span></a></li>
                                </ul>
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse1" class="body collapse in">
                                <table>
                                    <tr>
                                        <td><FONT color="red"><h5>Costo Total sin desperdicio</h5></FONT></td>
                                        <td>$ <?php echo number_format($costo_total_item) ?></td>
                                    </tr>
                                    <tr>
                                        <td><FONT color="red"><h5>Costo Total + desperdicio</h5></FONT></td>
                                        <td>$ <?php echo number_format($costo_total_item_desp) ?></td>
                                    </tr>
                                    <tr>
                                        <td><FONT color="red"><h5>Descuento</h5></FONT></td>
                                        <td><?php echo number_format($desc) ?>%</td>
                                    </tr>
                                    <tr>
                                        <td><FONT color="red"><h5>GRAN TOTAL</h5></FONT></td>
                                        <td>
                                            <?php 
                                            include 'calculo_planilla.php';
                                            echo $gt = $precio_compuesto+$precio_venta_total;
                                            ?>
                                        </td>
                                    </tr>
                                </table>                           
       <?php 

}
?> 
<script>
        function planilla(cot,gt,item){
            var t_alu = <?php echo $costo_alu+$total_costo_rej+$cb; ?>;
            var t_vid = <?php echo $total_vidsp; ?>;
            var t_acc = <?php echo $tac_p+$ksp; ?>;
            var t_ace = <?php echo $costo_ace; ?>;
            var t_adi = 0;
            var t_kit = 0;
            var t_mob = <?php echo $total_fab; ?>;
            var t_ins = <?php echo $to_serv + $total_ins; ?>;
            var t_pol = <?php echo $total_pol; ?>;
            var t_and = 0;
            var to_serv = 0;
            var to_mat = 0;
            var to_k = 0;
            var t = <?php echo $costo_total_item; ?>;
            t_kit = parseFloat(t_kit) + parseFloat(to_k);
            t_acc = parseFloat(t_acc) + parseFloat(to_mat);
            t_ins = parseFloat(to_serv) + parseFloat(t_ins);
            var despalu = <?php echo $despalu; ?>;
            var despvid = <?php echo $despvid; ?>;
            var despacc = <?php echo $despacc; ?>;
            var despace = <?php echo $porace; ?>;
            window.open("../vistas/costos/planilla_costo.php?cot="+cot+"&despalu="+despalu+"&despvid="+despvid+"&despacc="+despacc+"&despace="+despace+"&t="+t+"&t_alu="+t_alu+"&t_ace="+t_ace+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_adi="+t_adi+"&t_kit="+t_kit+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol+"&t_and="+t_and+"&gt="+gt+"&item="+item+" ", "Planilla", "width=1000 , height=600 ");
        }    
            </script>
                                        </section>
                        
                            <button onclick="planilla(<?php echo $id_cot ?>,<?php echo $precio_venta_total ?>,<?php echo $id_cotizacion ?>)">Plantilla por items</button>
                        </div>
                    
                    </div>

         
 </section></div>
 <div class="control-group">
                                        <div class="alert">
                                            <button type="button" class="close" data-dismiss="alert"></button>
                                       
                                               </div>
                                    </div>