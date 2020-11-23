<?php
include('../../modelo/conexion.php');
session_start();
 $request=mysqli_query($con,"SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p AND  c.id_cot = " . $_GET["cot"] . " ORDER BY c.fila ASC ");
  
  $table = "";
if($request){

        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysqli_fetch_array($request))
	{    
                $cons_vi = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio']." ";
                $fv1 =mysqli_fetch_array(mysqli_query($con,$cons_vi));
                $cons_vir = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio2']." ";
                $fv2 =mysqli_fetch_array(mysqli_query($con,$cons_vir));
                $cons_vir2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio3']." ";
                $fv3 =mysqli_fetch_array(mysqli_query($con,$cons_vir2));
                $cons_vir3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio4']." ";
                $fv4 =mysqli_fetch_array(mysqli_query($con,$cons_vir3));
                $cons_vir5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id_vidrio5']." ";
                $fv5 =mysqli_fetch_array(mysqli_query($con,$cons_vir5));
                $cons_vi2 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio']." ";
                $fv21 =mysqli_fetch_array(mysqli_query($con,$cons_vi2));
                $cons_vi3 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio2']." ";
                $fv22 =mysqli_fetch_array(mysqli_query($con,$cons_vi3));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv23 =mysqli_fetch_array(mysqli_query($con,$cons_vi4));
                $cons_vi4 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio3']." ";
                $fv24 =mysqli_fetch_array(mysqli_query($con,$cons_vi4));
                $cons_vi5 = "SELECT * FROM tipo_vidrio where id_vidrio=".$row['id2_vidrio4']." ";
                $fv25 =mysqli_fetch_array(mysqli_query($con,$cons_vi5));
                
				if ($row["linea_cot"] == 'Aluminio') {
					$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Aluminio'";
					$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
					$mult = $fi3["p"] / 100;
				} else {
					if ($row["linea_cot"] == 'Vidrio') {
						$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Vidrio'";
						$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
						$mult = $fi3["p"] / 100;
					} else {
						if ($row["linea_cot"] == 'Fachada') {
							$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Fachada'";
							$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
							$mult = $fi3["p"] / 100;
						} else {
							if ($row["linea_cot"] == 'Divisiones') {
								$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Divisiones'";
								$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
								$mult = $fi3["p"] / 100;
							} else {
								if ($row["linea_cot"] == 'Barandas en Vidrios') {
									$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Barandas en Vidrios'";
									$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
									$mult = $fi3["p"] / 100;
								} else{
									if ($row["linea_cot"] == 'Vidrios Decoracion Jamar') {
										$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Vidrios Decoracion Jamar'";
										$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
										$mult = $fi3["p"] / 100;
									} else {
										if ($row["linea_cot"] == 'Puertas Batiente en Vidrio') {
											$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Puertas Batiente en Vidrio'";
											$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
											$mult = $fi3["p"] / 100;
										} else {
											$s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = 'Acero'";
											$fi3 = mysqli_fetch_array(mysqli_query($con,$s3));
											$mult = $fi3["p"] / 100;
										}
									}
								}
							}
						}
					}
				}
            $comp=mysqli_query($con,"SELECT count(*) FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
            $cm1 = mysqli_fetch_array($comp);
            $d = $cm1['count(*)'];
            
            $ac =mysqli_query($con,"SELECT  count(*) FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.cotizacion=".$_GET['cot']." and a.id_cot=".$row["id_cotizacion"]."  ");
            $cm = mysqli_fetch_array($ac);
            $mt = $cm['count(*)'];
            
              $ak =mysqli_query($con,"SELECT count(*) FROM producto a, cotizaciones_kit b where a.id_p=b.id_producto and b.id_cot=".$_GET['cot']." and b.id_prod_mas=".$row["id_cotizacion"]." and b.comp='1'  ");
            $ck = mysqli_fetch_array($ak);
            $mtk = $ck['count(*)'];
            
            $as =mysqli_query($con,"SELECT count(*) FROM referencia_mo a, cotizaciones_servicios b where a.id_ref_mo=b.id_servicio and b.id_cotizacion=".$_GET['cot']." and b.id_cot_mas=".$row["id_cotizacion"]." ");
            $cs = mysqli_fetch_array($as);
            $mts = $cs['count(*)'];
            $compu =mysqli_query($con,"SELECT * FROM producto a, cotizaciones_sub c where  c.id_referencia_sub=a.id_p and c.id_cot_sub=".$_GET["cot"]." and c.id_producto_cot=".$row["id_cotizacion"]."");
    $costo_sp = 0; $costo_fom_sp=0; 
    $costo_mp = 0;
          $costo_fom_mp = 0;
    while ($fila=mysqli_fetch_array($compu)){
        
                 $sx = "SELECT (".$fila["porcentaje_sub"].") as p FROM porcentajes where area_por='".$fila["linea_cot_sub"]."'";
                $fix =mysqli_fetch_array(mysqli_query($con,$sx));
                $multx= $fix["p"]/100;
                
          $costo_sp += $fila['valor_sp'];
          $costo_fom_sp += $fila['valor_fom_sp'];
          $costo_mp += $fila['valor_c_sub']/$multx;
          $costo_fom_mp += $fila['valor_fom_sub'];
          
    }
           $t = $d + $mt + $mtk + $mts;

            $pad = (($costo_mp* $row["cantidad_c"]));
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           $a = (((($row["valor_c"]))) / $mult) + $pad  + $tk;


            
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
$res2=  mysqli_query($con,$con2);
while($f8=  mysqli_fetch_array($res2)){
$idco=$f8['id_p'];
$nombr=$f8['producto'];
}
if($row['traz_vid2']==0){
    $nombr2='';
}else{
$con22= "SELECT * FROM `producto` where id_p=".$row['traz_vid2']." ";
$res22=  mysqli_query($con,$con22);
while($f8r=  mysqli_fetch_array($res22)){
$idco2=$f8r['id_p'];
$nombr2=$f8r['producto'];
}}
if($row['traz_vid3']==0){
    $nombr3='';
}else{
$con23= "SELECT * FROM `producto` where id_p=".$row['traz_vid3']." ";
$res23=  mysqli_query($con,$con23);
while($f8=  mysqli_fetch_array($res23)){
$idco3=$f8['id_p'];
$nombr3=$f8['producto'];
}}
if($row['traz_vid4']==0){
    $nombr3='';
}else{
$con24= "SELECT * FROM `producto` where id_p=".$row['traz_vid4']." ";
$res24=  mysqli_query($con,$con24);
while($f8=  mysqli_fetch_array($res24)){
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
            if($row['id2_vidrio']!=0 && $row['id2_vidrio2']!=0){
                $vi2 = $v21.$v22.$v23.$v24.$v25.' - '.$nombr2;
            }else{
                
                 $vi2 = $fv21['color_v'].' - '.$nombr2;
            }
               $sql21 = "SELECT * FROM referencia_mo where id_ref_mo=99 ";
            $fila21 =mysqli_fetch_array(mysqli_query($con,$sql21));
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
                $fia =mysqli_fetch_array(mysqli_query($con,$pdlr));
                $precio_actual= $fia["precio_dolar"];
                
                if($row["valor_temp"]==0){
                    $w = '';
                }else{
                     $w = '<img src="../imagenes/warning.png" title="Advertencia tiene Precios ingresado manualmente">';
                }
                 if($row["especial"]==1){
                if($ver_pro=='Habilitado'){
                $ver = '<a href="../vistas/?id=ver_fac&ref='.$row["id_referencia"].'&cot='.$row["id_cotizacion"].'&cli='.$_GET["cli"].'&ped='.$_GET["cot"].'">';
                }
                else{$ver =''; }
                }else{
                    if($ver_pro=='Habilitado'){
                $ver = '<a href="../vistas/?id=ver_pro&l='.$row["imagen"].''
                        . '&mod='.$row["modulo"].'&per='.$row["per"].'&boq='.$row["boq"].'&ref='.$row["id_referencia"].''
                        . '&cot='.$_GET["cot"].'&idcot='.$row["id_cotizacion"].'&tv='.$row["traz_vid"].'&tv2='.$row["traz_vid2"].'&tv3='.$row["traz_vid3"].'&tv4='.$row["traz_vid4"].''
                        . '&aa='.$row["ancho_abajo"].'&ancho='.$row["ancho_c"].'&alto='.$row["alto_c"].''
                        . '&cant='.$row["cantidad_c"].'&vidrio='.$fv1["color_v"].'('.$fv1["espesor_v"].'mm)'
                        . '&id_v='.$row["id_vidrio"].'&id_v2='.$row["id_vidrio2"].'&id_v3='.$row["id_vidrio3"].'&id_v4='.$row["id_vidrio4"].'&id_v5='.$row["id_vidrio5"].'&id_v6='.$row["id_vidrio6"].''
                        . '&id2_v='.$row["id2_vidrio"].'&id2_v2='.$row["id2_vidrio2"].'&id2_v3='.$row["id2_vidrio3"].'&id2_v4='.$row["id2_vidrio4"].'&id2_v5='.$row["id2_vidrio5"].''
                        . '&id3_v='.$row["id3_vidrio"].'&id3_v2='.$row["id3_vidrio2"].'&id3_v3='.$row["id3_vidrio3"].'&id3_v4='.$row["id3_vidrio4"].'&id3_v5='.$row["id3_vidrio5"].''
                        . '&id4_v='.$row["id4_vidrio"].'&id4_v2='.$row["id4_vidrio2"].'&id4_v3='.$row["id4_vidrio3"].'&id4_v4='.$row["id4_vidrio4"].'&id4_v5='.$row["id4_vidrio5"].''
                        . '&cuerpo='.$row["cuerpo"].'&hojas='.$row["hojas"].'&ins='.$row["install"].''
                        . '&por='.$row["porcentaje_mp"].'&por_venta='.$row["porcentaje"].'&v='.$row["verticales"].''
                        . '&h='.$row["horizontales"].'&d1='.$row["d1"].'&dias='.$row["duracion"].'&lado='.$row["lado"].'&unidad='.$pu.'&descuento='.$descpor.'">';
                    
              
                    }
                    else{$ver =''; }
                    }
                IF($row["ruta"]==''){
                $img = '<img src="../../../cotizacion/producto/no.jpg" width="60" heigth="40">';
            }else{
                $img = '<img src="../../../cotizacion/producto/'.$row["ruta"].'" width="60" heigth="40">';
            }
                if($row['msg']!=''){$noti='<br><b> <font color="red">'.$row['msg'].' </b>';}else{$noti='';}
                if($row['msg2']!=''){$noti2='<br><b> <font color="red">'.$row['msg2'].' </b>';}else{$noti2='';}
                if($estado=='Aprobado'){$pen = '<td class="hidden-phone"><div align="center"><font color="red">'.$row["cant_restante"].'</font></td>';}else{$pen = '';}
            $table = $table.'<tr>'
. '<td width="2%">'.$tip.'</td>

<td style="width:150px"> <input type="hidden" id="it'.$row["id_cotizacion"].'" value="'.$tip.'"> '.$ver.''.$row['producto'].' '.$peli.', '.$row['observaciones'].', '.$m.','.$d1.', Cierre: '.$row["cierre"].', Inst: '.$row["install"].', Lam: '.$row["laminas"].' '.$noti.''.$noti2.' <br>Se Cotizó con el Dollar a: $ '.$precio_actual.' </a><button type="button" onclick="com('.$row["id_cotizacion"].')"> ? </button></td>                     
<td class="hidden-phone"><div align="center">'.$row["ubicacion"].'</div></td>
    <td class="hidden-phone"><div align="center">'.$row["alto_c"].'x'.$row["ancho_c"].'</div></td>
        <td class="hidden-phone"><div align="center">'.($row["ancho_c"]/1000*$row["alto_c"]/1000).'M<sup>2</sup></td>
<td class="hidden-phone"><div align="center">'.$row["color_ta"].'</div></td>'
                    . '<td width="9%">'.$vi.'<br>'.$vi2.'</td>
<td class="hidden-phone"><div align="center">'.$img.'</div></td>
<td class="hidden-phone"><div align="center">Und</td>
<td class="hidden-phone"><div align="center">$'.number_format($pu).'</div></td>
<td class="hidden-phone"><div align="center">'.$row["cantidad_c"].'</div></td>'.$pen.'

<td class="hidden-phone"><div align="center">$'.number_format($pudt).'</div></td>
<td class="hidden-phone" ></td>
<td class="hidden-phone" title="'.number_format($tota).'"></td>
<td class="hidden-phone"></td>
    <td class="hidden-phone"></td>
<td class="hidden-phone"></td><td></td></tr>';   



                
	} 
	$table = $table.'';
       }
	echo $table.'';
        

