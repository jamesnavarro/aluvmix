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

   $query =mysqli_query($con2,"SELECT * FROM producto a, cotizaciones c WHERE c.id_referencia = a.id_p  AND  c.id_cot = " . $_GET["cot"] . " and c.id_compuesto=0 ORDER BY c.fila ASC ".$limit);



  $table = "";
if($query){

 
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
        $tacot =0;
        $cont =0;
	while($row=mysqli_fetch_array($query))
	{    


            $pad = 0; // SE QUITO LAS CONSULTAS DE LOS COMPUESTOS DELMONTY 1 
           $tk = ($row["precio_material"])* $row["cantidad_c"];
           if($row['poralu']!=0){
               $a = $row['precio_item'];
               $version = '<b>Cotizador V 2.0</b>';
           }else{
               $s3 = "SELECT (" . $row["porcentaje"] . ") AS p FROM porcentajes WHERE area_por = '".$row["linea_cot"]."'";
                $fi3 = mysqli_fetch_array(mysqli_query($con2,$s3));
                $mult = $fi3["p"] / 100;
                if($row['id_referencia']==1633){
                   $a = $tk;
                }else{
                   $a = ($row["valor_c"] / $mult) + $pad  + $tk;
                }
                $version = '<b>Cotizador V 1.0</b>';
           }

//            echo ($tk ) .'';
            
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
            $up = '&up='.$row["id_cotizacion"].'';
            if($eliminar_cot=='Habilitado'){$del = '&del='.$row["id_cotizacion"].'&v='.$cont;}else{$del = '';}
            $img_up = '<button type="button"><img src="../imagenes/modificar.png"></button>'; 
            
            //$img_del ='<button type="button"  onclick="eliminar_prod('.$row['id_cotizacion'].','.$_GET['cot'].','.$_GET['cli'].')"><img src="../imagenes/eliminar.png" style="cursor:pointer"></button>';
            $copiar = '<button type="button" id="'.$row["id_cotizacion"].'" onclick="copiar('.$row["id_cotizacion"].','.$_GET["cot"].','.$_GET["cli"].');"><img src="../imagenes/copiar.png"></button>';
                     }else{
                $up = '';$del = '';$img_up = ''; $img_delx =''; $copiar ='';
            }
         if($crear_ped=='Habilitado'){$add = '';}else{$add = '';}
                $con233= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid']." ";
                $res2=  mysqli_query($con2,$con233);
                while($f8=  mysqli_fetch_array($res2)){
                $idco=$f8['id_p'];
                $nombr=$f8['producto'];
                }
                if($row['traz_vid2']==0){
                    $nombr2='';
                }else{
                $con22= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid2']." ";
                $res22=  mysqli_query($con2,$con22);
                while($f8r=  mysqli_fetch_array($res22)){
                $idco2=$f8r['id_p'];
                $nombr2=$f8r['producto'];
                }}
                if($row['traz_vid3']==0){
                    $nombr3='';
                }else{
                $con23= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid3']." ";
                $res23=  mysqli_query($con2,$con23);
                while($f8=  mysqli_fetch_array($res23)){
                $idco3=$f8['id_p'];
                $nombr3=$f8['producto'];
                }}
                if($row['traz_vid4']==0){
                    $nombr3='';
                }else{
                $con24= "SELECT id_p,producto FROM `producto` where id_p=".$row['traz_vid4']." ";
                $res24=  mysqli_query($con2,$con24);
                while($f8=  mysqli_fetch_array($res24)){
                $idco4=$f8['id_p'];
                $nombr4=$f8['producto'];
                }}
                
                 $cons_vi = mysqli_query($con2,"SELECT color_v,espesor_v FROM tipo_vidrio where id_vidrio IN (".$row['id_vidrio'].",".$row['id_vidrio2'].",".$row['id_vidrio3'].",".$row['id_vidrio4'].",".$row['id_vidrio5'].",".$row['id2_vidrio'].",".$row['id2_vidrio2'].",".$row['id2_vidrio3'].",".$row['id2_vidrio4'].") ");
                 $v1=''; 
                 $esp = '';
                 $colorv='';
                 while($fv1 =mysqli_fetch_array($cons_vi)){
                                    $v1 = $v1.$fv1['color_v'].'+';
                                    $esp = $fv1['espesor_v'].'';
                                    $colorv = substr($fv1['color_v'],4);
                                }

             $tip =$row['tip']; $tip2 =$row['fila'];
            if($row['id_vidrio']!=0 && $row['id_vidrio2']!=0){
                $vi = $v1.' - '.$nombr;
            }else{
                if($esp!='' && $row['producto']!=$nombr){
                 $vi = $v1.' '.$nombr;
                }else{
                 $vi = $v1;
                }
            }
                      
               if($row['cont_item']!='0'){
                $stilon = 'style="background-color:green;" title="¡Este item tiene notas!" ';
            
             }else{
                $stilon = '';
             
              }
                

               
      if($row['pelicula']=='No Aplica'){
                $peli = '';
            }else{
               
                $pp = mysqli_query($con2,"SELECT descripcion_mo FROM referencia_mo where id_ref_mo=99 ");
                  $f = mysqli_fetch_array($pp);
                    if($row['pelicula']=='Una Cara'){
                        $peli = ', '.$f['descripcion_mo'];
                     }else{
                       $peli = ', '.$f['descripcion_mo'].' ambos lados';
                      }
                   }
                  
                if($row['verpoli']=='1'){
                    $poli = 'Incluye Poliuretano';
                }  else {
                    $poli = '';
                }
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
                
                 $iva3 = $ptt * ($sel_iva/100);
                 $tota = $ptt + $iva3;
                 
                $ref='';
                $noti='';
                $noti2='';
                $ref=' '.strtoupper($row['producto']).' '.strtoupper($vi).' '.strtoupper($peli).'  '.strtoupper($d1).'  '.strtoupper($obs2).'  '.$noti.''.$noti2.''.$row["descripcion_rollo"].''.$poli.' ';
               $preund = $tota / $row['cantidad_c'];
               $gt +=$tota;
               $cadena_sin_espacios = preg_replace('/( ){2,}/u',' ',$ref);
                $table = $table.'<tr><td><img src="../../../imagenes/buscar.png" onclick="buscarcodfom('.$cont.')"></td><td width="7%">'
                        .'<input type="checkbox" id="'.$cont.'" name="item" checked disabled>'
                        .'<input type="text" id="cod'.$cont.'" value="'.$row['ptfom'].'" onchange="buscarpt('.$cont.')" title="'.$row['codigo'].'" style="width:100%">
                        <input type="hidden"  id="codtem'.$cont.'" value="'.$row['codigo'].'">
                        <input type="hidden"  id="gru'.$cont.'" value="'.$row['grupo'].'">
                        <input type="hidden"  id="cla'.$cont.'" value="'.$row['clase'].'">
                        <input type="hidden"  id="ref'.$cont.'" value="'.$row['refpro'].'"></td>
                        <td width="25%"><textarea  id="des'.$cont.'" rows="2" style="width:100%">'.$cadena_sin_espacios.'</textarea></td>                     
                        <td width="9%"><input type="text"  id="und'.$cont.'" value="Und" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="med'.$cont.'" value="'.$row["ancho_c"].'X'.$row["alto_c"].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="col'.$cont.'" value="'.$colorp.'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="can'.$cont.'" value="'.$row['cantidad_c'].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="vlr'.$cont.'" value="'.number_format($preund,2,',','.').'" disabled style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="tot'.$cont.'" value="'.number_format($tota,2,',','.').'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="obs'.$cont.'" value="'.$row['observaciones'].'" style="width:100%">'
                        . '<input type="hidden" id="item'.$cont.'" value="'.$row['id_cotizacion'].'" style="width:100%"></td></tr>';   
       
	} 
        $table = $table.'<tr><td></td><td colspan="6"></td><td>Valor Total:</td><td><input type="text" id="gran_total" value="'.number_format($gt,2,',','.').'" style="width:100%"></td>';

       }
	echo $table;

    

