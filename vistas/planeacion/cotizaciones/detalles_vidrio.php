<?php
include '../../../modelo/conexionv1.php';
session_start();

    $page= $_GET['page'];
    if($_GET['pag']=='undefined'){
        $pag= 20; 
    }else{
       $pag= $_GET['pag']; 
    }

    //37339372.27119596
    $estado = $_GET['est'];

   $query =mysqli_query($con2,"SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p  AND  c.id_cot = " . $_GET["cot"] . " and c.id_compuesto=0 and c.estado_item='' ORDER BY c.id_cotizacion ASC ".$limit);



  $table = "";
if($query){
	//Por cada resultado pintamos una linea
        $c = 0;
        $ca = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
	while($row=mysqli_fetch_array($query))
	{    
        $c +=1;
        $cont++;
        $cons_vi = mysqli_query($con2,"SELECT color_v,espesor_v FROM tipo_vidrio where id_vidrio IN (".$row['id_vidrio'].",".$row['id_vidrio2'].",".$row['id_vidrio3'].",".$row['id_vidrio4'].",".$row['id_vidrio5'].",".$row['id2_vidrio'].",".$row['id2_vidrio2'].",".$row['id2_vidrio3'].",".$row['id2_vidrio4'].") ");
                 $v1=''; 
                 $esp = '';
                 $colorv='';
                 while($fv1 =mysqli_fetch_array($cons_vi)){
                                    $v1 = $v1.$fv1['color_v'].' ';
                                    $esp = $fv1['espesor_v'].'';
                                    $colorv = substr($fv1['color_v'],4);
                                }
        $valor_c = $row['valor_c'];
        $totalx = $valor_c;
        //$totalx_sinp = $suma_maq_sp + $admin_sinp;
        //$totalxfom = $suma_maq_fom + $admin_fom;
        //$totalxfom_sinp = $suma_maq_fom_sin_p + $admin_fom_sinp;
        //porcentaje de venta P1
        $s3 = "SELECT (".$row['porcentaje'].") as p FROM porcentajes where area_por='Vidrio'";
        $fi3 =mysqli_fetch_array(mysqli_query($con2,$s3));
        $mult= $fi3["p"]/100;
        $a = ($totalx / $mult) + ($row['ajuste']*$row['cantidad_c']);
        $at = ($totalx) + ($row['ajuste']*$row['cantidad_c']);
        $und = ($a / $row['cantidad_c']);
        $adi = $row["adicional_per"] / $row['cantidad_c'];
        $tiva = ($a + $row["adicional_per"]) * 0.19;
        $t = ($a + $row["adicional_per"]) + $tiva;
        $to = $t * ($row['desc']/100);
        $total = $t + $to;
        
        $gtiva += $total;
        $ct += $row['cantidad_c'];
        if($row['estado']!='En proceso'){
           $di = 'disabled';
        }else{
           $di = '';
        }
        if($_GET['ser']=='1'){
           $dix = 'disabled';
        }else{
           $dix = '';
        }
        if($row['per']>0){
           $diper = '';
        }else{
           $diper = 'disabled';
        }
        if($row['per']>5){
           $a_per = $row['per'] - 5;
        }else{
           $a_per = 0;
        }
        if($row['boq']>3){
           $a_boq = $row['boq'] - 3;
        }else{
           $a_boq = 0;
        }
        if($row['boq']>0){
           $diboq = '';
        }else{
           $diboq = 'disabled';
        }
        if($row['id_vidrio2']!=0){
           $text2 = 'text';
           $px='20';
        }else{
           $text2 = 'hidden';
           $px='80';
        }
        if($row['id_vidrio3']!=0){
           $text3 = 'text';
        }else{
           $text3 = 'hidden';
        }
        if($row['id_vidrio4']!=0){
           $text4 = 'text';
        }else{
           $text4 = 'hidden';
        }
        
        $pu = ($a / $row["cantidad_c"]);
        $descpor = $pu * $row["desc"] / 100;
        $pud = $pu + $descpor;
        $descuento_g = ($row["descuento_g"] / 100) * $pud;
        $pudt = ($pud - $descuento_g) + $adi;
        $ptt2 = ($pudt ) * $row["cantidad_c"];
        $gt += $ptt2;
        $ref='';
        if($row["linea_cot"]=='Vidrio' || $row["linea_cot"]=='VIDRIO'){
                if($row["per"]!=0){
                    $dp1 = 'Per:'.$row["per"];
                }else{
                    $dp1 = '';
                }
                if($row["boq"]!=0){
                    $db1 = 'Boq:'.$row["boq"];
                }else{
                    $db1 = '';
                }
               $d1 = $dp1.$db1;
               $colorp = $colorv;
                
            }else{
                $d1 = '';
                $colorp = $row['color_ta'];
                }
                $noti='';
                $noti2='';
                $ref=''.strtoupper($v1).''.strtoupper($row['producto']).'  '.strtoupper($peli).'  '.strtoupper($d1).'  '.strtoupper($obs2).'  '.$noti.''.$noti2.''.$row["descripcion_rollo"].''.$poli.' '.$row['ubicacion_c'];
                $cadena_sin_espacios = preg_replace('/( ){2,}/u',' ',$ref);
                 $contador =  strlen($cadena_sin_espacios);
                $table = $table.'<tr><td><img src="../../../imagenes/buscar.png" onclick="buscarcodfom('.$cont.')"></td><td width="7%">'
                        .''
                        .'<input type="text" id="cod'.$cont.'" value="'.$row['ptfom'].'" onchange="buscarpt('.$cont.')" title="'.$row['codigo'].'" style="width:100%">
                        <input type="hidden"  id="codtem'.$cont.'" value="'.$row['codigo'].'">
                        <input type="hidden"  id="gru'.$cont.'" value="'.$row['grupo'].'">
                        <input type="hidden"  id="cla'.$cont.'" value="'.$row['clase'].'">
                        <input type="hidden"  id="ref'.$cont.'" value="'.$row['refpro'].'"></td>
                        <td width="25%"><textarea id="des'.$cont.'" rows="4" style="width:100%" onkeyup="contar('.$cont.')">'.$cadena_sin_espacios.'</textarea></td>                     
                        <td width="9%"><input type="text"  id="und'.$cont.'" value="94" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="med'.$cont.'" value="'.$row["ancho_c"].'X'.$row["alto_c"].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="col'.$cont.'" onclick="buscarcolor('.$cont.')" value="'.trim($colorp).'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="can'.$cont.'" value="'.$row['cantidad_c'].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="vlr'.$cont.'" value="'.number_format($pudt,0,'','').'"  style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="tot'.$cont.'" value="'.number_format($ptt2,0,'','').'" style="width:100%" disabled>
                        <input type="hidden" id="obs'.$cont.'" value="'.$row['ubicacion_c'].'" style="width:100%">'
                        . '<input type="hidden" id="item'.$cont.'" value="'.$row['id_cotizacion'].'" style="width:100%">'
                        . '<td><input type="checkbox" id="'.$cont.'" name="item" checked onclick="aprobar_items('.$cont.')"><span id="con'.$cont.'">'.$contador.'</span></td></tr>';   
       
	} 
         $cot = $_GET['cot'];
        $query = mysqli_query($con2,"select * from cotizaciones_materiales where id_cotizacion = '".$_GET['cot']."' ");
        
  
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;
            $cont++;
            $nt += $f[12];
            $tt += $f[13];
            $gt += $f[11]*$f[3];
//            $table = $table. '<tr>'
//                    . '<td>'.$c.'</td>'
//                    . '<td>'.$f[15].'</td>'
//                    . '<td>'.$f[14].'</td>'
//                    . '<td>'.$f[9].'</td>'
//                    . '<td><input type="number" id="v_med'.$cont.'" value="'.$f[7].'" style="width:60px" disabled></td>'
//                    . '<td><input type="number" id="v_can'.$cont.'" value="'.$f[3].'" style="width:50px" disabled></td>'
//                    . '<td><input type="number" id="v_und'.$cont.'" value="'.$f[11].'" style="width:80px;text-align:right" disabled></td>'
//                    . '<td><input type="number" id="v_net'.$cont.'" value="'.$f[12].'" style="width:80px;text-align:right" disabled></td>'
//                    . '<td><input type="number" id="v_tot'.$cont.'" value="'.$f[13].'" style="width:80px;text-align:right" disabled></td>'
//                    . '<td><input type="number" id="v_por'.$cont.'" value="'.$f[4].'" style="width:60px;text-align:right"  disabled></td>'
//                    . '<td>-</td>';
            $table = $table.'<tr><td><img src="../../../imagenes/buscar.png" onclick="buscarcodfom('.$cont.')"></td><td width="7%">'
                        .''
                        .'<input type="text" id="cod'.$cont.'" value="" onchange="buscarpt('.$cont.')" title="'.$f[15].'" style="width:100%">
                        <input type="hidden"  id="codtem'.$cont.'" value="'.$f[15].'">
                        <input type="hidden"  id="gru'.$cont.'" value="">
                        <input type="hidden"  id="cla'.$cont.'" value="">
                        <input type="hidden"  id="ref'.$cont.'" value=""></td>
                        <td width="25%"><textarea id="des'.$cont.'" rows="4" style="width:100%" onkeyup="contar('.$cont.')">'.$f[14].'</textarea></td>                     
                        <td width="9%"><input type="text"  id="und'.$cont.'" value="94" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="med'.$cont.'" value="'.$f[7].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="col'.$cont.'" onclick="buscarcolor('.$cont.')" value="'.trim($f[9]).'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="can'.$cont.'" value="'.$f[3].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="vlr'.$cont.'" value="'.number_format($f[11],0,'','').'"  style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="tot'.$cont.'" value="'.number_format($f[12],0,'','').'" style="width:100%" disabled>
                        <input type="hidden" id="obs'.$cont.'" value="" style="width:100%">'
                        . '<input type="hidden" id="item'.$cont.'" value="'.$f[0].'" style="width:100%">'
                        . '<td><input type="checkbox" id="'.$cont.'" name="item" checked disabled><span id="con'.$cont.'">'.$contador.'</span></td></tr>'; 
        }
        
        $query2 = mysqli_query($con2,"SELECT * FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and id_cot_mas=0  ");
        
  
        $nt2 = 0;
        $tt2 = 0;
        while($f = mysqli_fetch_array($query2)){
            $c ++;
            $cont++;
            $nt2 += $f[12];
            $tt2 += $f[13];
            $gt += $f[11]*$f[3];

            $table = $table.'<tr><td><img src="../../../imagenes/buscar.png" onclick="buscarcodfom('.$cont.')"></td><td width="7%">'
                        .''
                        .'<input type="text" id="cod'.$cont.'" value="" onchange="buscarpt('.$cont.')" title="'.$f[15].'" style="width:100%">
                        <input type="hidden"  id="codtem'.$cont.'" value="'.$f[15].'">
                        <input type="hidden"  id="gru'.$cont.'" value="">
                        <input type="hidden"  id="cla'.$cont.'" value="">
                        <input type="hidden"  id="ref'.$cont.'" value=""></td>
                        <td width="25%"><textarea id="des'.$cont.'" rows="4" style="width:100%" onkeyup="contar('.$cont.')">'.$f[14].'</textarea></td>                     
                        <td width="9%"><input type="text"  id="und'.$cont.'" value="94" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="med'.$cont.'" value="'.$f[7].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="col'.$cont.'" onclick="buscarcolor('.$cont.')" value="'.trim($f[9]).'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="can'.$cont.'" value="'.$f[3].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="vlr'.$cont.'" value="'.number_format($f[11],0,'','').'"  style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="tot'.$cont.'" value="'.number_format($f[12],0,'','').'" style="width:100%" disabled>
                        <input type="hidden" id="obs'.$cont.'" value="" style="width:100%">'
                        . '<input type="hidden" id="item'.$cont.'" value="'.$f[0].'" style="width:100%">'
                        . '<td><input type="checkbox" id="'.$cont.'" name="item" checked disabled><span id="con'.$cont.'">'.$contador.'</span></td></tr>'; 
        }
        
        $table = $table.'<tr><td></td><td><input type="text" disabled id="ct" value="'.$c.'" style="width:100%"></td>'
                . '<td>Actualizados: <input type="text" disabled id="cv" value="'.$ca.'" style="width:40px"></td>'
                . '<td colspan="4"></td><td>Valor Total</td>'
                . '<td><input type="text" id="gran_total" disabled value="'.number_format($gt,0,',','.').'" style="width:100%"></td>';

       }
	echo $table;

    

