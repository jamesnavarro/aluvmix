<?php
include '../../../modelo/conexioni.php';
$codigo = $_GET['cod'];
$item = $_GET['item'];
$itemv = $_GET['itemv'];
$can= $_GET['cant'];
$per= $_GET['per'];
$boq= $_GET['boq'];
$ancho= $_GET['ancho'];
$alto=  $_GET['alto'];
$ubc=  $_GET['ubc'];
$obse=  $_GET['obse'];
$descuento=  $_GET['desc'];
$por_vid=  $_GET['por_vid'];
$por_alu=  $_GET['por_alu'];
$por_acc=  $_GET['por_acc'];
$por_ace=  $_GET['por_ace'];
$por_esp=  $_GET['por_esp'];
$por_int=  $_GET['por_int'];
$pel=  $_GET['pel'];
$ins=  $_GET['ins'];
$gen=  $_GET['gen'];  //define si se edita el desperdicio en general o desde la misma lista
$mt2 = ($ancho/1000) * ($alto/1000)*$can; 
$mt = (($ancho/1000) + ($alto/1000))*$can*2;
$medida = $ancho.'x'.$alto;
$utilidad_gen=  $_GET['utilidad'];
 $query = mysqli_query($con, "select * from cotizacion_item where id_cot_principal='$item' and estado='Guardado' ");

    $i = 0;
    $gran_total1 = 0;
    $total_vidrio = 0;
    $manoobra = 0;
    $idcot=0;
    $total_vidrio_desp = 0;
    while($rg = mysqli_fetch_array($query)){
        
        $codv = $rg['codigo'];
        $codt = $rg['trazabilidad'];
        $idcotitem = $rg['id_cot_item'];
        $idcot = $rg['id_cot'];
        if($gen==0){
           $por_vid = $rg['por_vid'];
        }else{
            $por_vid = $por_vid;
        }
        $result_vidrio = mysqli_query($con, "select costo_v, descripcion_inventario,espesor_v from tipo_vidrio where codigo_vid='$codv' ");
        $cv = mysqli_fetch_array($result_vidrio);
       
        $peso = $mt2*2.5*$cv[2];
        $cost = $mt2*$cv[0];
       
        $result = mysqli_query($con,"select a.secuencia,b.nombre_puesto,b.id_puesto from hojas_rutas a, puestos_trabajos b where a.codigo_pue=b.id_puesto and a.codigo_pro='$codt' ");
        $total_vidrio = 0;
        while($r = mysqli_fetch_array($result)){
        //    echo '<li>'.$r[0].' '.$r[1];
            $idpuesto=$r[2];
                    $result_act = mysqli_query($con, "select a.act_codigo,a.valor_std,b.act_umb,b.act_nombre, b.parafiscales from puesto_actividades a, clases_actividad b where a.act_codigo=b.act_codigo and a.id_puesto='$idpuesto'  ");
                    $total1 = 0;
                    $total_vidrio += $total1;

                    while ($r = mysqli_fetch_array($result_act)){
                        //$codigo = "'".$r[0]."'";
                       if($r[2]=='m2'){
                            $st = $mt2 * $r[1];
                        }else if($r[2]=='mt'){
                            $st = $mt * $r[1];
                        }else if($r[2]=='und'){
                            $st = $can * $r[1];
                        }else if($r[2]=='kg'){
                            $st = $r[1] * $peso;
                        }else{
                            $st = $can * $r[1];
                        }
                        $parafiscales = ($r[4]/100) * $st;
                        $st = $st + $parafiscales;
                        $total_vidrio += $st;
                    }

        } 
        $manoobra += $total_vidrio;
        $subtotal1 = $cost;
        $porcentaje = (100 - $por_vid)/100;
        $total_vidrio_desp += $cost / $porcentaje;
        $utilidad = (100 - 10)/100;
        $subtotal2 = $subtotal1; // / $porcentaje
        $subtotal2;
        $subtotal3 = $subtotal2 + $total_vidrio; //  / $utilidad;
        $unidad = $subtotal2 / $can;
        $iva = $subtotal2 * 0.19;
        $gt = $subtotal2 + $iva;
        
        $gran_total1 += $subtotal2;
        
         //actualizacion del item principal
         mysqli_query($con, "update cotizacion_item set total_mob='$total_vidrio', ancho='$ancho', alto='$alto', cantidad='$can',perforacion='$per',boquete='$boq',pelicula='$pel',instalaccion='$ins',valor_item='".ceil($subtotal2)."', descuento='$descuento',por_vid='$por_vid',por_alu='$por_alu',por_acc='$por_acc',por_esp='$por_esp',por_int='$por_int', observacion='$obse',ubicacion='$ubc', utilidad='$utilidad_gen'  where id_cot_item='$idcotitem' ");
        //fin de actualizacion


    }
     $error = '';
     $error = $error.'Total vidrio: '.$gran_total1.'<br>';
     $error = $error.'Total mano de obra: '.$total_vidrio.'<br>';
        $result1 = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$item' ");
       $porcentaje = (100 - $por_acc)/100;
        $total2 = 0;
        $total_espa_desp = 0;
        while($rx = mysqli_fetch_array($result1)){
            $codpro = $rx['codigo'];
            $idins = $rx['id_cot_ins'];
            $tipomat = $rx['tipomat'];
            $por_int = $rx['porcentaje'];
    
            $result = mysqli_query($con,"select b.costo_promedio, a.id_pp, a.und_med, a.cantidad,a.parametro from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.codigo_pro='$codpro' and a.codigo_ref='$codigo' ");
            $ry = mysqli_fetch_array($result);
            mysqli_error($con);
            $id = $ry[1];
            $med = $ry[2];
            $canins = $ry[3];
            $par = $ry[4];
            if($med=='und'){
               $subcan = $can * $canins;
            }else if($med=='m2'){
                $subcan = $canins * $mt2;
            }else if($med=='mt'){
                $subcan = $mt * $canins;
            }else{
                $subcan = $can * $canins;
            }
            $st1 = $ry[0] * $subcan;
            //$error = $error.'cant insumos: '.$subcan.'-';
            //insumos fijos de los espaciadores
            $result2 = mysqli_query($con,"select b.costo_promedio, a.id_pp, a.und_med, a.cantidad, a.parametro from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.compuesto='$id' and tipo='Fijo' order by parametro asc ");
            //$result2 = mysqli_query($con,"select b.costo_promedio, a.id_cot, a.und_med, a.cantidad, a.parametro from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$item' ");
            $st2 = 0;
            $costo = '';
            while($sr = mysqli_fetch_array($result2)){

                    $medcom = $sr[2];
                    $caninscom = $sr[3];
                    if($medcom=='und'){
                        $subcancomp = $can * $caninscom;
                    }else if($medcom=='m2'){
                        $subcancomp = $caninscom * $mt2;
                    }else if($medcom=='mt'){
                        $subcancomp = $mt * $caninscom;
                    }else{
                        $subcancomp = $can * $caninscom;
                    }
                     $costo .= ' <'.$sr[0].'>';
                     $subcancomp;
                    $st2 += $sr[0] * $subcancomp;
            }
 
            $st2;
            $error = $error.'cant insumos: '.$tod = $st1 + $st2;
           
            //$tod = $tod; //total de insumos  / $porcentaje
            $to = $tod / $can;
            $total2 += $tod;

                $pormat = $por_int;
                $porcentaje_espa = (100 - $por_int)/100;
                $total_espa_desp += $tod / $porcentaje_espa;

            //$error = $error.'espaciadores }='.$tod.' , ';
            //actualizacion de insumos
             mysqli_query($con,"update cotizacion_insumos set cantidad='$subcan', medida='$medida', precio_unidad='$tod',porcentaje='$pormat' where id_cot_ins='$idins' ");
           
            
           
       }
       $error = $error.'total espa: '.$total2.'-';
       $codi = $_GET['cod'];
            $result4 = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$codigo' ");
           $totalacc = 0;
            while($r = mysqli_fetch_array($result4)){
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
                if($r['para']=='Instalacion'){
                    if($inst=='Si'){
                         $totacc = $total * $r['costo_promedio'];
                         $input = 'text';
                    }else{
                        $totacc = 0;
                        $input = 'hidden';
                    }
                }else{
                    $totacc = $total * $r['costo_promedio'];
                    $input = 'text';
                }
                $porcentaje = (100 - $por_acc)/100;
                $totacc = $totacc; //  / $porcentaje
                $totalacc += $totacc;
                $tund = $totacc / $can;

            }
            $error = $error.'acce :'.$totalacc.'-';
            //pelicula protectora
       
            $result = mysqli_query($con,"select codigo,descripcion,costo_promedio from productos_var  where codigo='26044' ");
            $rz = mysqli_fetch_array($result);
            
            $pel = $_GET['pel'];
            if($pel=='No Aplica'){
                $top = 0;
            }else if($pel=='Una Cara'){
                 $top = $rz['costo_promedio']*$mt2;
            }else if($pel=='Doble Cara'){
                 $top = $rz['costo_promedio']*$mt2*2;
            }
            //$porcentaje3 = (100 - $por_acc)/100;
                $top = $top; //  / $porcentaje3
           
            
     
       
$gran_total1=$gran_total1- $manoobra; //total de vidrios
$total2; // total de insumos
$totalacc; //total de accesorios
$GT = $gran_total1+$total2+$totalacc+$top;
$error = $error.'Gran: '.$GT;



$_GET['t_alu'] = 0;
$_GET['t_and'] = 0;
$_GET['t_pol'] = 0;
$_GET['t_ins'] = 0;
$_GET['t_mob'] = $manoobra;

$error = $error.'desperdicio vidrio '.$desp = ((100-$por_vid)/100 ).' | '; 
$despalu = (100-$por_alu)/100; 
$despacc = (100-$por_acc)/100; 
$despace = (100-$por_ace)/100; 

$total_alum = ($_GET['t_alu'] / $despalu ) - $_GET['t_alu'];
$total_vid = ($gran_total1 / $desp ) - $gran_total1;
$suma_acc = $totalacc+$top+$total2; // suma  de accesorios
$total_acc = $suma_acc;

$fabricacion = $_GET['t_mob'];// * 1.45
$instalacion = $_GET['t_ins'] * 1.45;
$poli = $_GET['t_pol'] * 1.45;
//con este es N25 base del calculo
$error = $error.'Total costo:'.$total_costo = $_GET['t_and'] +  $_GET['t_alu'] + $total_espa_desp  + $total_alum + $total_vidrio_desp  + $fabricacion + $instalacion + $poli;
$_GET['t_and'].' +'.  $_GET['t_alu'] .' +'.  $total_espa_desp .'+'.  $total_alum .' +'.  $total_vidrio_desp .' + fab: '.  $fabricacion .' +'.  $instalacion .' +'.  $poli;
//$a1 = parseInt(($alu / ((100-parseInt($p_alu))/100))-parseInt($alu));

 
    $query2 = mysqli_query($con,"SELECT * FROM costos ");

    $encabezado = '';
    $c = 0;
    $cont=0;
    $porcentajes_totales = 0;
    $td = '';
     $suma_por =0;
     $suma_pvbi = 0;
     $sub_total_base = 0;
     $totales_operador_1 = $total_costo;
     $por_comisiones = 0;
     $total_transporte = 0;
     $total_utilidad = 0;
     $suma_comision = 0;
     $repo = 0;
     $comi = 0;
    while ($fila = mysqli_fetch_array($query2)){
        $cont ++;
        //1 . linea de codigo para mostrar el encabezado de la lista
        $t = ($precio_base * por)/100;
        
        $idc = $fila['id_cos'];
        $item = $_GET['item'];
        $resul = mysqli_query($con, "select porcentaje_item from costos_items where id_cos='$idc' and id_cot_item='$item' ");
        $r = mysqli_fetch_row($resul);
        if($r){
            $porci = $r[0];
        }else{
            $porci = $fila['porcentaje'];
        }
        if ($idc== 8){
            $repo = $porci;
        }
        if ( $fila['variabletres']== 'Si'){
            $total_transporte += $porci/100;
        }else{
            $total_transporte +=0;
        }
        
        if ( $fila['variabledos']== 'Si'){
            $total_utilidad += $porci/100;
        }else{
            $total_utilidad +=0;
        }
        
        if($encabezado == $fila['categoria_costos']){
            $c = 0; 
        }else{
            if($c==0){
               
                if($cont!=1){
                        
    $total_operador_1 = $total_costo * ($porcentajes_totales/100);
    $total_operador_2 = $total_costo * ($porcentajes_totales/100);
    
    $totales_operador_1 += $total_operador_2;
    
                  $porcentajes_totales = 0;
                }else{
                    $td='';
                } 
            }
            
            $c ++;
           
        }
        $porcentajes_totales += $porci;
        //1. ____----------------------------------------------------
        //esta linea de codigo es para habilitar y deshabilitar las cajas de textos
        if ( $fila['suma_toral']== 'No'){
            $disabled='disabled';
        }else{
            $disabled='';
        }
        if ( $fila['edita_valor']== 'No'){
            $disabled_valor='disabled';
        }else{
            $disabled_valor='';
        }
        if ( $fila['variabledos']== 'No'){
            $x='x';
        }else{
            $x='';
        }
        if ( $fila['suma_porcentaje']== 'Si'){
            $no = '*';
            $suma_por +=$porci;
        }else{
            $suma_por +=0;
            $no = '';
        }
         $costo_pviv = $costo_totales * $porci;
         if ( $fila['variabletres']== 'Si'){
            $s='>';
            $suma_pvbi += $porci;
           
            $sub_total_base += $costo_pviv;
        }else{
            $s='';
            $suma_pvbi += 0;
            $sub_total_base += 0;
        }
        if ( $fila['variableuno']== 'Si'){
            $co='c';
            $p_com = ($porci/100) * 1.1;
            $por_comisiones += $p_com;
            $suma_comision += $porci;
        }else{
            $p_com = 0;
            $co='';
            $por_comisiones += 0;
            $suma_comision += 0;
        }
        if ( $fila['categoria_costos']== 'Comisiones'){
             $comi += $porci;
         }else{
             $comi += 0;
         }
        
        $operador_1 = $total_costo * ($porci/100);
        //fin ----------------------------------------------------------------------precio_base_1
  $precio_base = $total_costo / ((100-$suma_por) / 100);
$sub_precio_base_2 = $precio_base * 0.1;
$precio_base_2 = $sub_precio_base_2 + $precio_base;

$sub_suma_pvbi = ($suma_pvbi/100) * $precio_base;
$total__pvbi = $sub_suma_pvbi + $precio_base;

$sub_suma_pvbi_2 = ($suma_pvbi/100) * $precio_base;
$total__pvbi_2 = $sub_suma_pvbi_2 + $precio_base_2;

$ganancia_esperada_1 = $precio_base * (0 /100);
$ganancia_esperada_2 = $total__pvbi_2 * (($utilidad_gen/100) + 1);
$encabezado = $fila['categoria_costos'];

    }
    
    $ganancia_2 = ($utilidad_gen / 100);
$precio_base =  $total_costo / ((100 - $suma_por)/100) ;  //precio base 1
$precio_base_2 = $precio_base * $ganancia_2;
$precio_base_2 = $precio_base + $precio_base_2;

//nueva formula 2018-------------------------------------------------------------

$rep = $precio_base * ($repo/100); //    var rep = base * (repo/100);
$costo = $precio_base + $rep; //    var costo = parseFloat(base) + parseFloat(rep);
$port = 1 - ((1-($comi/100)) / (($utilidad_gen/100)+1));//    var por = 1 - ((1-(comi/100)) / ((util/100)+1));
$precio = $costo / (1 - $port);//    var precio = costo / (1 - parseFloat(por));



//fin nueva formula----------------------------------------------------

 $pvbi_1 = ($precio_base * ($total_transporte)) + $precio_base;
 $pvbi_2 = ($precio_base * ($total_transporte)) + $precio_base_2 ;
 $total_utilidad =   ($precio_base *  $total_utilidad);  
 $utilidad_neta = $precio_base_2 - $total_costo - $total_utilidad;  // Utilidad Neta del Proyecto

 $gan_2 = $pvbi_2 * $ganancia_2;
 $com = $precio_base_2 * ($suma_comision/100);
 $id=$suma_comision;
 $query4 = mysqli_query($con,"SELECT incremento FROM comisiones where comision<'$id' order by id_comision desc limit 1"); //consultA modificada por navabla
 $fila = mysqli_fetch_array($query4);
 $inc = $fila['incremento']/100; 
 
 $t_ganancia = ($pvbi_2 * $inc) + ($gan_2);
 $ajuste_precio = $t_ganancia - $utilidad_neta;
 $precio_venta_total = ($pvbi_2) + ($com) + ($ajuste_precio);
 
$precio_venta_total = $precio;  // se agrego esta linea por motivo de la nueva formula
 number_format($precio_venta_total,2,'.','');
$de = ($precio_venta_total * ($descuento/100));


$ggt = $precio_venta_total + $de;
$iva = $ggt * 0.19;
$to = $ggt + $iva;
$tound = $ggt / $can;
 //actualizacion del item principal
 mysqli_query($con, "update cotizacion_item set item='$itemv',ancho='$ancho', alto='$alto', cantidad='$can',perforacion='$per',boquete='$boq',pelicula='$pel',instalaccion='$ins',valor_item='$precio_venta_total', descuento='$descuento',por_esp='$por_esp',por_int='$por_int',por_vid='$por_vid',por_alu='$por_alu',por_acc='$por_acc', observacion='$obse',ubicacion='$ubc'  where id_cot_item='$item' ");
mysqli_error($con);

 mysqli_query($con, "update cotizacion set desp_vid='$por_vid' , desp_alu='$por_alu' , desp_acc='$por_acc' , desp_ace='$por_ace', desp_esp='$por_esp',desp_int='$por_int' where id_cot='$idcot' ");
        echo mysqli_error($con);
 //fin de actualizacion
        
        

 $p = array();
$p[0] = number_format($tound,2,'.','');
$p[1] = number_format($ggt,2,'.','');
$p[2] = number_format($to,2,'.','');
$p[3] = $error;
echo json_encode($p);

