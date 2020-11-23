<?php
include '../../../modelo/conexioni.php';
session_start();
$usuario = $_SESSION['k_username'];
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:
        $cot = $_GET['cot'];
        $ref = $_GET['ref'];
        $tipo = $_GET['tipo'];
        $med = $_GET['med'];
        $cod  =  $_GET['cod'];
        $can  =  $_GET['can'];
        $item  =  $_GET['item'];
        $col  =  $_GET['col'];
        $result = mysqli_query($con,"select count(id_desglose) from desgloses where codigo_pro='$cod' and id_cot='$cot' and id_cot_item='$item' ");
        $r = mysqli_fetch_row($result);
        if($r[0]==0){
                  mysqli_query($con,"insert into desgloses (id_cot,id_cot_item,referencia,codigo_pro,cantidad,medida,color,tipo,linea,fecha_re,usuario)"
                . " values ('$cot','$item','$ref','$cod','$can','$med','$col','$tipo','Aluminio','$fecha','$usuario')");
   
        }else{
                  mysqli_query($con,"update desgloses set cantidad=cantidad+'$can' where codigo_pro='$cod' and id_cot='$cot' and id_cot_item='$item'  ");
        }
        echo mysqli_error($con);

   break;
   case 1.1:
        $cot = $_GET['cot'];
        $ref = $_GET['ref'];
        $tipo = $_GET['tipo'];
        $para = $_GET['para'];
        $cod  =  $_GET['cod'];
        $can  =  $_GET['can'];
        $item  =  $_GET['item'];
        $col  =  $_GET['col'];
        $result = mysqli_query($con,"select count(id_desglose) from desgloses where codigo_pro='$cod' and id_cot='$cot' and id_cot_item='$item' ");
        $r = mysqli_fetch_row($result);
        if($r[0]==0){
                  mysqli_query($con,"insert into desgloses (id_cot,id_cot_item,referencia,codigo_pro,cantidad,medida,color,tipo,linea,fecha_re,usuario,fabricacion)"
                . " values ('$cot','$item','$ref','$cod','$can','1','$col','$tipo','Accesorios','$fecha','$usuario','$para')");
   
        }else{
                  mysqli_query($con,"update desgloses set cantidad=cantidad+'$can' where codigo_pro='$cod' and id_cot='$cot' and id_cot_item='$item'  ");
        }
        echo mysqli_error($con);

   break;
   case 1.2:
        $cot = $_GET['cot'];
        $ref = $_GET['ref'];
        $tipo = $_GET['tipo'];
        $med = $_GET['med'];
        $cod  =  $_GET['cod'];
        $can  =  $_GET['can'];
        $item  =  $_GET['item'];
        $col  =  $_GET['col'];
        $result = mysqli_query($con,"select count(id_desglose) from desgloses where codigo_pro='$cod' and id_cot='$cot' and id_cot_item='$item' ");
        $r = mysqli_fetch_row($result);
        if($r[0]==0){
                  mysqli_query($con,"insert into desgloses (id_cot,id_cot_item,referencia,codigo_pro,cantidad,medida,color,tipo,linea,fecha_re,usuario,fabricacion)"
                . " values ('$cot','$item','$ref','$cod','$can','$med','$col','$tipo','Vidrios','$fecha','$usuario','')");
   
        }else{
                  mysqli_query($con,"update desgloses set cantidad=cantidad+'$can' where codigo_pro='$cod' and id_cot='$cot' and id_cot_item='$item'  ");
        }
        echo mysqli_error($con);

   break;
    case 2:
         $cot = $_GET['cot'];
        $bus_ref = $_GET['ref'];
        $bus_descr = $_GET['descr'];
        $bus_perfil = $_GET['perfil'];
         $resultg = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$cot." and estado='Guardado' and id_cot_principal=0 ");
        $ctt = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
        $medgtotal = 0;
        $valref = '';
        $contador=0;
        
        $resultdes = mysqli_query($con,"select referencia from desgloses where id_cot='$cot' group by referencia ");
        $referencias ='';
        while($r = mysqli_fetch_row($resultdes)){
            $referencias = $referencias."'".$r[0]."'".',';
        }
        $referencias = $referencias."''";
        while($row = mysqli_fetch_array($resultg)){
            $ctt += 1;
            $cod = $row['codigo'];
            $compuesto = $row['compuesto'];
            $ancho = $row['ancho'];
            $riel = $row['rieles'];
            $alfa = $row['alfajia'];
            $alto  =  $row['alto'];
            $rej  =  $row['altorej'];
            $ancfd  =  $row['anchocfd'];
            $ancfi  =  $row['anchocfi'];
            $alcfs  =  $row['altocfs'];
            $alcfi  =  $row['altocfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
            $cant  =  $row['cantidad'];  
            $desp  =  $row['por_alu'];
            $cod_rieles  =  $row['rieles'];
            $cod_alfajia  =  $row['alfajia'];
            $cod_rejillas = $row['rejillas'];
            $altorej = $row['altorej'];
            $entrerej = $row['entre_rej'];
            $desptotal = (100-$desp)/100;
            $color = $row['color'];
            $result23 = mysqli_query($con, "select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
            if($compuesto==0){
                $sty = '#efefef';
            }else{
                $sty = '#E4E935';
            }
            echo '<tr style="background: '.$sty.'"><td>'.$ctt.'</td><td colspan="11">'.$row['item'].' | '.$cod.' | '.$row['descripcion_principal'].' | '.$ancho.'X'.$alto.'  Cantidad: '.$cant.' | Color: '.$color.'</td>';
             $result = mysqli_query($con, "select * from producto_perfiles where referencia like '%".$bus_ref."%' and desc_referencia like '%".$bus_descr."%' and codigo='$cod' and modulo='Principal' order by lado_ref ");
            $total_perfil_costo = 0;
            $total_perfil_desp = 0;
            while($f = mysqli_fetch_array($result)){
                $formula = $f[4];
                $lado_per = $f[6];
                $ope1 = $f[7];
                $var1 = $f[8];
                $ope2 = $f[9];
                $var2 = $f[10];
                $lado = $f[5];
                $medida = $f[12];
                $piezas = $f[13];
                $cantidad = $f[11]*$cant;
                $cadah = $f[15];
                $cadav = $f[14];
                include '../productos_dos/formula_perfil.php';
                
                $result2 = mysqli_query($con, "select costo_aluminio,perimetro from productos where pro_referencia = '".$f[2]."' ");
                $p = mysqli_fetch_array($result2);
                $precio = $p[0];
                $perimetro = $p["perimetro"]/1000;
                if($lado=='Alto'){
                    $deto = $des_riel;
                    $detoa = $des_alfa;
                }else{
                    $deto = 0;
                    $detoa = 0;
                }
                $medida = $medida-$deto-$detoa;
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                $precio_total = $precio * ($medtotal/1000);
                
               
                 include 'costopintura.php';
                 $precio_total_acabado = $precio_total + $valor_acabado;
                 $totadesp = $precio_total_acabado/$desptotal;
                 $total_perfil_costo += $precio_total;
                 $total_perfil_desp += $totadesp;
                 
                 $pre_und = $precio_total / $cantidad;
                 $perfil_opt =   $medtotal / $bus_perfil;
                 //1. paso
                 $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    
                 }
                 $codgeneral = $f[2].'-'.$codcol.substr($codp, 0,-2);
                $medgtotal += (($medida+100)*$cantidad);
                $valref = $f[2];
                $contador +=1;
                //-telecomunicaciones 
                echo '<tr>'
                . '<td><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$f[2].'" disabled></td>'
                        . '<td title="Valor Unidad: $'.$pre_und.' ">'.$f[3].' '.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td style="text-align:right"><input type="text" id="cod'.$contador.'" style="width:100px;text-align:center" value="'.($codgeneral).'"></td>'
                        . '<td style="text-align:right">'.number_format($medida).' mm</td>'
                        . '<td style="text-align:right">'.$cantidad.' Und</td>'
                        . '<td style="text-align:right">'.number_format($medtotal).'mm</td>'
                        . '<td><input type="hidden" id="col'.$contador.'" style="width:40px;text-align:center" value="'.$codcol.'">'
                        . '<input type="hidden" id="tipo'.$contador.'" style="width:40px;text-align:center" value="'.$row['item'].'">'
                        . '<input type="hidden" id="item'.$contador.'" style="width:40px;text-align:center" value="'.$row['id_cot_item'].'">'.$perfqil.'</td>'
                        . '<td><input type="text" id="can'.$contador.'" style="width:40px;text-align:center" value="'.ceil($canper).'"> Und</td>'
                        . '<td><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')">'
                        . ' <input type="checkbox" id="'.$contador.'" name="item" checked> '.$contador.'</td>';
            }
            //rieles y alfajias
            $resulta = mysqli_query($con, "select * from producto_perfiles where  referencia like '%".$bus_ref."%' and referencia not in ($referencias)  and desc_referencia like '%".$bus_descr."%' and codigo='$cod' and id_p in ('$cod_alfajia','$cod_rieles') and modulo in ('Rieles','Alfajia') order by lado_ref ");

            while($f = mysqli_fetch_array($resulta)){
                $formula = $f[4];
                $lado_per = $f[6];
                $ope1 = $f[7];
                $var1 = $f[8];
                $ope2 = $f[9];
                $var2 = $f[10];
                $lado = $f[5];
                $medida = $f[12];
                $piezas = $f[13];
                $cantidad = $f[11]*$cant;
                $cadah = $f[15];
                $cadav = $f[14];
                include '../productos_dos/formula_perfil.php';
                
                $result2 = mysqli_query($con, "select costo_aluminio,perimetro from productos where pro_referencia = '".$f[2]."' ");
                $p = mysqli_fetch_array($result2);
                $precio = $p[0];
                $perimetro = $p["perimetro"]/1000;
                if($lado=='Alto'){
                    $deto = $des_riel;
                    $detoa = $des_alfa;
                }else{
                    $deto = 0;
                    $detoa = 0;
                }
                $medida = $medida-$deto-$detoa;
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                $precio_total = $precio * ($medtotal/1000);
                
               
                 include 'costopintura.php';
                 $precio_total_acabado = $precio_total + $valor_acabado;
                 $totadesp = $precio_total_acabado/$desptotal;
                 $total_perfil_costo += $precio_total;
                 $total_perfil_desp += $totadesp;
                 
                 $pre_und = $precio_total / $cantidad;
                 $perfil_opt =   $medtotal / $bus_perfil;
                 //1. paso
                 $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    
                 }
                 $codgeneral = $f[2].'-'.$codcol.substr($codp, 0,-2);
                $medgtotal += (($medida+100)*$cantidad);
                $valref = $f[2];
                $contador +=1;
                echo '<tr>'
                . '<td><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$f[2].'" disabled></td>'
                        . '<td title="Valor Unidad: $'.$pre_und.' ">'.$f[3].' '.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td style="text-align:right"><input type="text" id="cod'.$contador.'" style="width:100px;text-align:center" value="'.($codgeneral).'"></td>'
                        . '<td style="text-align:right">'.number_format($medida).' mm</td>'
                        . '<td style="text-align:right">'.$cantidad.' Und</td>'
                        . '<td style="text-align:right">'.number_format($medtotal).'mm</td>'
                        . '<td><input type="hidden" id="col'.$contador.'" style="width:40px;text-align:center" value="'.$codcol.'">'
                        . '<input type="hidden" id="tipo'.$contador.'" style="width:40px;text-align:center" value="'.$row['item'].'">'
                        . '<input type="hidden" id="item'.$contador.'" style="width:40px;text-align:center" value="'.$row['id_cot_item'].'">'.$perfil.'</td>'
                        . '<td><input type="text" id="can'.$contador.'" style="width:40px;text-align:center" value="'.ceil($canper).'"> Und</td>'
                        . '<td><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"> '
                        . ' <input type="checkbox" id="'.$contador.'" name="item" checked> '.$contador.'</td>';
            }
            
            //rejillas
            $resultr = mysqli_query($con, "select * from producto_rejillas  where rej_ref like '%".$bus_ref."%' id_pr='$cod_rejillas' ");

            while($f = mysqli_fetch_array($resultr)){
                $rejilla = $f[2];
                $vref1 = $f[4];
                $vope1 = $f[5];
                $vvar1 = $entrerej;//toma la medida de la formula de la altura de la rejilla.
                $vope2 = $f[7];
                $vvar2 = $f[8];
                
                $vref2 = $f[9];
                $vope3 = $f[10];
                $vvar3 = $f[11];
                $vope4 = $f[12];
                $vvar4 = $f[13];

                //$cantidad = $f[13];

                include '../productos_dos/formula_rejillas.php';
                $formula1 = number_format($variablev,2).$f[5].$vvar1.$f[7].$f[8];
                $formula2 = number_format($variablev2,2).$f[10].$f[11].$f[12].$f[13];
                
                $result2 = mysqli_query($con, "select costo_aluminio,perimetro from productos where pro_referencia = '".$f[2]."' ");
                $p = mysqli_fetch_array($result2);
                $precio = $p[0];
                $perimetro = $p["perimetro"]/1000;
                $resultadov = $resultadov *$cant;
                $perfiles = ($resultadov * $resultadov2)/ 6000;
                $total_med = $resultadov * $resultadov2;
                $medida = $resultadov2;
                $cantidad = $resultadov;
                include 'costopintura.php';
                //
                
                $total1 = $precio * ($total_med/1000);
                $precio_total_acabado = $total1 + $valor_acabado;
                $totaldesp = $precio_total_acabado / $desptotal;
                $total_perfil_costo += $precio_total_acabado;
                $total_perfil_desp += $totaldesp;
                $contador +=1;
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    
                 }
                $codgeneral = $f[2].'-'.$codcol.substr($codp, 0,-2);
                echo '<tr>'
                . '<td><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$f[2].'" disabled></td>'
                        . '<td title="'.$formula1.' | '.$formula2.'">'.$f[3].'</td>'
                        . '<td>Ancho</td>'
                        . '<td style="text-align:right"><input type="text" id="cod'.$contador.'" style="width:100px;text-align:center" value="'.($codgeneral).'"></td>'
                        
                        . '<td style="text-align:right">'.$resultadov2.' mm</td>'
                        . '<td style="text-align:right">'.number_format($resultadov).' Und</td>'
                         . '<td style="text-align:right">'.number_format($total_med).'mm</td>'
                        . '<td style="text-align:center" ><input type="hidden" id="tipo'.$contador.'" style="width:40px;text-align:center" value="'.$row['item'].'">'
                        . '<input type="hidden" id="col'.$contador.'" style="width:40px;text-align:center" value="'.$codcol.'">'
                        . '<input type="hidden" id="item'.$contador.'" style="width:40px;text-align:center" value="'.$row['id_cot_item'].'">'.($perfil).'</td>'
                       
                        . '<td><input type="text" id="can'.$contador.'" style="width:40px;text-align:center" value="'.ceil($canper).'"> Und</td></td>'
                        . '<td><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')">'
                        . ' <input type="checkbox" id="'.$contador.'" name="item" checked> '.$contador.'</td>';
                
            }
            
        }
        if($valref==$bus_ref){
            $dis = '';
        }else{
            $dis = 'disabled';
        }
         $codgeneral = $bus_ref.'-'.$codcol.substr($bus_perfil, 0,-2);
                 $per = $medmax / $medgtotal;
                 $perfil = (intval($per) * $medgtotal)+100;
                 $ref = "'".$bus_ref."'";
        echo '<tr><td colspan="5" style="text-align:right">Total: '.$bus_ref.'</td>'
                . '<td>'.$codgeneral.'</td>'
                . '<td style="text-align:right">'.$medgtotal.'</td>'
                . '<td>'.$bus_perfil.'</td><td>'.ceil($medgtotal/$bus_perfil).'</td>'
                . '<td><button onclick="adddesg('.$cot.')" '.$dis.' class="btn btn-success">Agregar</button></td>';
        break;
    case 3:
        $idcot = $_GET['cot'];

        $resultdes = mysqli_query($con,"select * from desgloses where id_cot='$idcot' and linea='Aluminio' order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultdes)){
            $c++;
            if($r['linea']=='Aluminio'){
               $nombres = mysqli_query($con,"select pro_nombre from productos where pro_referencia='".$r['referencia']."' ");
               $n = mysqli_fetch_array($nombres);
               $descripcion = $n['pro_nombre'];
            }else{
                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
                 $descripcion = $n['descripcion'];
            }
            
            echo '<tr>'
            . '<td>'.$c.'</td>'
            . '<td>'.$r['tipo'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].' Und</td>'
            . '<td>'.$r['medida'].' mm</td>';
        }

        break;
        case 3.1:
        $idcot = $_GET['cot'];
        $resultvid = mysqli_query($con,"select * from desgloses where id_cot='$idcot' and linea='Vidrios' order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultvid)){
            $c++;

                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
                 $descripcion = $n['descripcion'];
 
            
            echo '<tr>'
            . '<td>'.$c.'</td>'
            . '<td>'.$r['tipo'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].' Mt<sup>2</sup></td>'
            . '<td>'.$r['medida'].'</td>';
        }
        break;
        case 3.2:
        $idcot = $_GET['cot'];
        $resultmat = mysqli_query($con,"select * from desgloses where id_cot='$idcot' and linea='Accesorios' order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultmat)){
            $c++;
            if($r['linea']=='Aluminio'){
               $nombres = mysqli_query($con,"select pro_nombre from productos where pro_referencia='".$r['referencia']."' ");
               $n = mysqli_fetch_array($nombres);
               $descripcion = $n['pro_nombre'];
            }else{
                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
                 $descripcion = $n['descripcion'];
            }
            
            echo '<tr>'
            . '<td>'.$c.'</td>'
            . '<td>'.$r['tipo'].'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].' Und</td>'
            . '<td>-</td>';
        }

        break;
    case 4:
        $cot = $_GET['cot'];
         $resultg = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$cot." and estado='Guardado' and id_cot_principal=0 ");
         $contador = 1000;
         $can_total=0;
         while($row = mysqli_fetch_array($resultg)){
            $ctt += 1;
            $cod = $row['codigo'];
            $compuesto = $row['compuesto'];
            $ancho = $row['ancho'];
            $riel = $row['rieles'];
            $alfa = $row['alfajia'];
            $alto  =  $row['alto'];
            $rej  =  $row['altorej'];
            $ancfd  =  $row['anchocfd'];
            $ancfi  =  $row['anchocfi'];
            $alcfs  =  $row['altocfs'];
            $alcfi  =  $row['altocfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
            $cant  =  $row['cantidad'];  
            $desp  =  $row['por_alu'];
            $cod_rieles  =  $row['rieles'];
            $cod_alfajia  =  $row['alfajia'];
            $cod_rejillas = $row['rejillas'];
            $altorej = $row['altorej'];
            $entrerej = $row['entre_rej'];
            $desptotal = (100-$desp)/100;
            $color = $row['color'];
            $result23 = mysqli_query($con, "select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
            if($compuesto==0){
                $sty = '#efefef';
            }else{
                $sty = '#E4E935';
            }
            $mt2 = ($ancho/1000) * ($alto/1000) * $cant;
            $mt = ((($ancho/1000) * ($alto/1000)) * 2) * $cant;
        
            echo '<tr style="background: '.$sty.'"><td>'.$ctt.'</td><td colspan="11">'.$row['item'].' | '.$cod.' | '.$row['descripcion_principal'].' | '.$ancho.'X'.$alto.'  Cantidad: '.$cant.' | Color: '.$color.'</td>';
            $result4 = mysqli_query($con, "select *, sum(a.cantidad) as cantidad FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$cod' and a.insumo='Principal' group by codigo_pro,para  ");
            $totalacc = 0;
            $total_insumo_costo1 =0;
                $total_insumo_desp1 =0;
                $can = $cant;
            while($r = mysqli_fetch_array($result4)){
                $contador++;
                if($r['calcular']=='und'){
                     $total = $r['cantidad']*$can;
                }elseif ($r['calcular']=='mt') {
                     if($r['yes']=='Si'){
                         $st = $mt / ($r['metro']/1000);
                     }else{
                         $st = $mt;
                     }
                     $total = $st*$r['cantidad'];
                }elseif ($r['calcular']=='m2') {
                     $total = ($mt2)*$r['cantidad'];
                }else{
                     $total = $r['cantidad']*$can;
                }
                 $totacc = $total * $r['costo_promedio'];
                 $input = 'text';
                
                $totacc = $totacc; //  / $porcentaje
                $totalacc += $totacc;
                $totaldesp = $totacc / $desperdicioacc;
                $total_insumo_costo1 +=$totacc;
                $total_insumo_desp1 +=$totaldesp;
                $can_total += $total;
                echo '<tr style="hide">'
                . '<td><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$r['referencia'].'" disabled></td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['color'].'<input type="hidden" id="col'.$contador.'" style="width:40px;text-align:center" value="'.$r['color'].'">'
                . '<input type="hidden" id="tipo'.$contador.'" style="width:40px;text-align:center" value="'.$row['item'].'">'
                . '<input type="hidden" id="item'.$contador.'" style="width:40px;text-align:center" value="'.$row['id_cot_item'].'"></td>'
                . '<td><input type="text" id="cod'.$contador.'" style="width:100px;text-align:center" value="'.$r['codigo_pro'].'" disabled></td>'
                . '<td>'.$r['cantidad'].' '.$r['calcular'].'</td>'
                . '<td><input type="text" id="para'.$contador.'" style="width:100px;text-align:center" value="'.$r['para'].'" disabled></td>'
              
                . '<td><input type="'.$input.'" id="can'.$contador.'" value="'.number_format($total,2,'.','').'" style="width:60px;text-align: right" disabled> Und</td>'
                . '<td style="text-align: center"><input type="checkbox" id="'.$contador.'" name="itemmat" checked> '.($contador-1000).'</td>';
            }
            
         }
              echo '<tr><td colspan="3" style="text-align:right">Total:</td>'
                . '<td></td>'
                . '<td></td>'
                . '<td></td><td style="text-align:right">'.$can_total.'</td>'
                . '<td><button onclick="adddesgmat('.$cot.')"  class="btn btn-success">Agregar Acc</button></td>';
              
              $resultgv = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$cot." and estado='Guardado' and id_cot_principal!=0 group by id_cot_principal, codigo ");

         while($row = mysqli_fetch_array($resultgv)){
            $ctt += 1;
            $cod = $row['codigo'];
            $compuesto = $row['compuesto'];
            $ancho = $row['ancho'];
            $riel = $row['rieles'];
            $alfa = $row['alfajia'];
            $alto  =  $row['alto'];
            $rej  =  $row['altorej'];
            $ancfd  =  $row['anchocfd'];
            $ancfi  =  $row['anchocfi'];
            $alcfs  =  $row['altocfs'];
            $alcfi  =  $row['altocfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
            $cant  =  $row['cantidad'];  
            $desp  =  $row['por_alu'];
            $cod_rieles  =  $row['rieles'];
            $cod_alfajia  =  $row['alfajia'];
            $cod_rejillas = $row['rejillas'];
            $altorej = $row['altorej'];
            $entrerej = $row['entre_rej'];
            $desptotal = (100-$desp)/100;
            $color = $row['color'];
            $contador ++;
            $resultper = mysqli_query($con,"SELECT ancho,alto,cantidad FROM cotizacion_item d where  id_cot_item='".$row['id_cot_principal']."'  ");
             $f = mysqli_fetch_array($resultper);
             
             $cadena = $row[3]; 
             $resultado = intval(preg_replace('/[^0-9]+/', '', $cadena), 10);
             $area_t = (($f[0]*$f[1])*($row[8]*$f[2]))/1000000;
             $color  = $row[3];
             $col = explode(" ", $color);

            echo '<tr>'
                . '<td><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$col[0].'" disabled></td>'
                        . '<td>'.$row[3].'  </td>'
                        . '<td>'.$col[1].'</td>'
                      . '<td style="text-align:right"><input type="text" id="cod'.$contador.'" style="width:80px;text-align:center" value="'.$row[2].'"></td>'
                        . '<td style="text-align:right">'.($row[8]*$f[2]).' Und</td>'
                       
                        . '<td style="text-align:center" ><input type="text" id="med'.$contador.'" style="width:80px;text-align:center" value="'.$f[0].'x'.$f[1].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:40px;text-align:center" value="'.$row['item'].'">'
                        . '<input type="hidden" id="col'.$contador.'" style="width:40px;text-align:center" value="'.$col[1].'">'
                        . '<input type="hidden" id="item'.$contador.'" style="width:40px;text-align:center" value="'.$row['id_cot_principal'].'">'.($perfil).'</td>'
                       
                        . '<td><input type="text" id="can'.$contador.'" style="width:60px;text-align:center" value="'.$area_t.'"> Mt<sup>2</sup></td></td>'
                        . '<td style="text-align:center"><input type="checkbox" id="'.$contador.'" name="itemv" checked> '.($contador-1000).'</td>';
            
            
         }
         echo '<tr><td colspan="3" style="text-align:right">Total:</td>'
                . '<td></td>'
                . '<td></td>'
                . '<td></td><td style="text-align:right">'.$can_totalv.'</td>'
                . '<td><button onclick="adddesgvid('.$cot.')"  class="btn btn-success">Agregar Vid</button></td>';
        break;
        case 5:
        $cot = $_GET['cot'];
         $resultg = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$cot." and estado='Guardado' and id_cot_principal!=0 ");
         $contador = 1000;
         $can_total=0;
         while($row = mysqli_fetch_array($resultg)){
            $ctt += 1;
            $cod = $row['codigo'];
            $compuesto = $row['compuesto'];
            $ancho = $row['ancho'];
            $riel = $row['rieles'];
            $alfa = $row['alfajia'];
            $alto  =  $row['alto'];
            $rej  =  $row['altorej'];
            $ancfd  =  $row['anchocfd'];
            $ancfi  =  $row['anchocfi'];
            $alcfs  =  $row['altocfs'];
            $alcfi  =  $row['altocfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
            $cant  =  $row['cantidad'];  
            $desp  =  $row['por_alu'];
            $cod_rieles  =  $row['rieles'];
            $cod_alfajia  =  $row['alfajia'];
            $cod_rejillas = $row['rejillas'];
            $altorej = $row['altorej'];
            $entrerej = $row['entre_rej'];
            $desptotal = (100-$desp)/100;
            $color = $row['color'];
            
            echo '<tr>'
                . '<td><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$f[2].'" disabled></td>'
                        . '<td title="'.$formula1.' | '.$formula2.'">'.$f[3].'</td>'
                        . '<td>Ancho</td>'
                        . '<td style="text-align:right"><input type="text" id="cod'.$contador.'" style="width:100px;text-align:center" value="'.($codgeneral).'"></td>'
                        
                        . '<td style="text-align:right">'.$resultadov2.' mm</td>'
                        . '<td style="text-align:right">'.number_format($resultadov).' Und</td>'
                         . '<td style="text-align:right">'.number_format($total_med).'mm</td>'
                        . '<td style="text-align:center" ><input type="hidden" id="tipo'.$contador.'" style="width:40px;text-align:center" value="'.$row['item'].'">'
                        . '<input type="hidden" id="col'.$contador.'" style="width:40px;text-align:center" value="'.$codcol.'">'
                        . '<input type="hidden" id="item'.$contador.'" style="width:40px;text-align:center" value="'.$row['id_cot_item'].'">'.($perfil).'</td>'
                       
                        . '<td><input type="text" id="can'.$contador.'" style="width:40px;text-align:center" value="'.ceil($canper).'"> Und</td></td>'
                        . '<td><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')">'
                        . ' <input type="checkbox" id="'.$contador.'" name="item" checked> '.$contador.'</td>';
            
            
         }
         
         break;
             case 6:
        $idcot = $_GET['cot'];
        //$resultdes = mysqli_query($con,"select * from desgloses a LEFT JOIN productos b ON a.referencia=b.pro_referencia and a.id_cot='$idcot' and a.linea='Aluminio' order by a.id_cot_item ");
       echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE PERFILES</center> <button class="btn btn-info"><a href="importar.php?idc='.$idcot.'&exportar"> <i class="fa fa-file-excel-o"></i> Exportar excel </a></button></td>';
        $resultdes = mysqli_query($con,"select *, sum(cantidad) as cantidad from desgloses where id_cot='$idcot' and linea='Aluminio' group by codigo_pro order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultdes)){
            $c++;
            if($r['linea']=='Aluminio'){
               $nombres = mysqli_query($con,"select pro_nombre from productos where pro_referencia='".$r['referencia']."' ");
               $n = mysqli_fetch_array($nombres);
               $descripcion = $n['pro_nombre'];
            }else{
                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
                 $descripcion = $n['descripcion'];
            }
            
            echo '<tr>'
            . '<td>'.$c.'</td>'
            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].' Und</td>'
            . '<td>'.$r['medida'].' mm</td>';
        }
        echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE ACCESORIOS</center></td>';
        $resultmat = mysqli_query($con,"select *, sum(cantidad) as cantidad from desgloses where id_cot='$idcot' and linea='Accesorios' group by codigo_pro order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultmat)){
            $c++;
            if($r['linea']=='Aluminio'){
               $nombres = mysqli_query($con,"select pro_nombre from productos where pro_referencia='".$r['referencia']."' ");
               $n = mysqli_fetch_array($nombres);
               $descripcion = $n['pro_nombre'];
            }else{
                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
                 $descripcion = $n['descripcion'];
            }
            
            echo '<tr>'
            . '<td>'.$c.'</td>'

            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].' Und</td>'
            . '<td>-</td>';
        }
        echo '<tr style="background:#efefef"><td colspan="8" ><center>LISTA DE VIDRIOS</center></td>';
        $resultvid = mysqli_query($con,"select *, sum(cantidad) as cantidad from desgloses where id_cot='$idcot' and linea='Vidrios' group by codigo_pro order by  id_cot_item ");
        $c =0;
        while($r = mysqli_fetch_array($resultvid)){
            $c++;

                $nombres = mysqli_query($con,"select descripcion from productos_var where codigo='".$r['codigo_pro']."' ");
                $n = mysqli_fetch_array($nombres);
            $descripcion = $n['descripcion'];
 
            
            echo '<tr>'
            . '<td>'.$c.'</td>'

            . '<td>'.$r['codigo_pro'].'</td>'
            . '<td>'.$r['referencia'].'</td>'
            . '<td>'.$descripcion.'</td>'
            . '<td>'.$r['color'].'</td>'
            . '<td>'.$r['cantidad'].' Mt<sup>2</sup></td>'
            . '<td>'.$r['medida'].'</td>';
        }
        break;
 
        
        
        
}


