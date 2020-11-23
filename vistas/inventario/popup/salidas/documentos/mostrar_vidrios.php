<?php
include('../../../../../modelo/conexionv1.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
             $tipo = $_GET['tipo'];
              $sql1 = mysqli_query($con2,"SELECT * FROM orden_produccion  where opf='".$_GET['orden']."' ");//  and estado_o='En produccion'
              $r = mysqli_fetch_array($sql1);
              $idcot = $r['ref'];
              $orden = $_GET['orden'];
             $orden = str_pad($orden, 9, "0", STR_PAD_LEFT); 
            $rad = $_GET['rad'];
            echo '<input type="text" id="idcot"  value="'.$idcot.'" disabled style="width: 70px">';
                ?>
<table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <TH>PRODUCTO</TH>
                                        <TH>MEDIDA</TH>
                                        <TH>COLOR</TH>
                                        <TH>COSTO</TH>
                                        <TH>CANT.</TH>
                                        <TH>SALDO</TH>
                                        <TH>C.DESP</TH>
                                        <TH>STOCK</TH>
                                        <TH>OPC</TH>
               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($rad==''){
                                        $disa = 'disabled';
                                    }  else {
                                        $disa = '';
                                    }
                         
                             $sqlp = mysqli_query($con2,"SELECT * FROM cotizaciones where id_cot=".$idcot."  and id_vidrio!=0 ORDER BY id_vidrio   ");
                             $idproducto=0;
                             $item=0;
                             $metros_totales=0;
                             $saldos_totales=0;
                             $desc_vidrio='';
                             $idt_referencia=0;
                             $pro=0;
                             while($fila21 = mysqli_fetch_array($sqlp)){
                                 $linea_cot= $fila21["linea_cot"];
                                    $id_referencia= $fila21["id_referencia"];
                                    $id_cotizacion= $fila21["id_cotizacion"];
                                    $id_cot= $fila21["id_cot"];
                                    $producto= $fila21["producto"];
                                    $codigo= $fila21["codigo"];
                                    $id_vidrio= $fila21["id_vidrio"];
                                    $id_vidrio2= $fila21["id_vidrio2"];
                                    $id_vidrio3= $fila21["id_vidrio3"];
                                    $id_vidrio4= $fila21["id_vidrio4"];
                                    $id_vidrio5= $fila21["id_vidrio5"];
                                    $id_vidrio6= $fila21["id_vidrio6"];
                                    $pelicula= $fila21["pelicula"];

                                    $id2_vidrio= $fila21["id2_vidrio"];
                                    $id2_vidrio2= $fila21["id2_vidrio2"];
                                    $id2_vidrio3= $fila21["id2_vidrio3"];
                                    $id2_vidrio4= $fila21["id2_vidrio4"];
                                    $id2_vidrio5= $fila21["id2_vidrio5"];

                                    $id3_vidrio= $fila21["id3_vidrio"];
                                    $id3_vidrio2= $fila21["id3_vidrio2"];
                                    $id3_vidrio3= $fila21["id3_vidrio3"];
                                    $id3_vidrio4= $fila21["id3_vidrio4"];
                                    $id3_vidrio5= $fila21["id3_vidrio5"];

                                    $id4_vidrio= $fila21["id4_vidrio"];
                                    $id4_vidrio2= $fila21["id4_vidrio2"];
                                    $id4_vidrio3= $fila21["id4_vidrio3"];
                                    $id4_vidrio4= $fila21["id4_vidrio4"];
                                    $id4_vidrio5= $fila21["id4_vidrio5"];
                                    $lado= $fila21["imagen"];

                                    $laminas= $fila21["laminas"];
                                    $laminas2= $fila21["laminas2"];
                                    $laminas3= $fila21["laminas3"];
                                    $laminas4= $fila21["laminas4"];

                                    $traz_vid= $fila21["traz_vid"];
                                    $traz_vid2= $fila21["traz_vid2"];
                                    $traz_vid3= $fila21["traz_vid3"];
                                    $traz_vid4= $fila21["traz_vid4"];

                                    $termo1= $fila21["termovid1"];
                                    $termo2= $fila21["termovid2"];
                                    $termo3= $fila21["termovid3"];
                                    $termo4= $fila21["termovid4"];

                                    $ancho= $fila21["ancho_c"];
                                    $aa= $fila21["ancho_abajo"];
                                    $alto= $fila21["alto_c"];
                                    $ancho_temp= $fila21["ancho_temp"];
                                    $alto_temp= $fila21["alto_temp"];
                                    $cant_item= $fila21["cantidad_c"];
                                    $color= $fila21["color_ta"];
                                    $altura= $fila21["cuerpo"];
                                    $altura_v_c =  $alto - $altura;
                                    $anchura = $fila21["lado"];
                                    $anchura_v_c = $ancho - $anchura;
                                    $tip= $fila21["tip"];
                                    $hoja= $fila21["hojas"];
                                    $modulo= $fila21["modulo"];
                                    $verticales= $fila21["verticales"];
                                    $horizontales= $fila21["horizontales"]; 
                                    $ancho_maximo= $fila21["ancho_maximo"];
                                    $alto_maximo= $fila21["alto_maximo"];
                                    $cantlam= $fila21["cantlam"];
                                    $poralu = $fila21["poralu"];
                                    $porvid = $fila21["porvid"];
                                    $poracc = $fila21["poracc"];
                                    $porace = $fila21["porace"];
                                    $dolar_actual = $fila21["id_dolar_actual"];
                                    
                                    $sql=mysqli_query($con2, "SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
  
                        
                                
                                $bod = '';
                                 
                                        while($row = mysqli_fetch_array($sql)){
                                                
                                                
                                                if($row["ancho_v"]==0){
                
                $alb = $aa;
                if($row["utilizar"]==0){
                     $al= 0;
                 }else{
                     $al= $ancho;
                 }
            }else{
            $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($con2,$sqlx));
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

                    if($nw_medida=='0'){

                     if($nw_lado=='Vertical'){
                        $medida = $alto;
                     }else{
                        $medida = $ancho;
                     }
                 }else{
                     if($nw_medida=='1'){
                          $medida = $altura_v_c;
                     }else if($nw_medida=='2'){
                          $medida = $altura;
                     }else if($nw_medida=='3'){
                          $medida = $anchura;
                     }else if($nw_medida=='4'){ 
                          $medida = $anchura_v_c;
                     }else if($nw_medida=='976'){
                          $medida = $ancho; // resolver
                     }else{
                          $medida = $ancho; // resolver
                     }
                 }
                 if($nw_ope=='+'){
                     $med_perfil = $medida + $nw_var1 + $nw_var2;
                 }else if($nw_ope=='-'){
                      $med_perfil = $medida + $nw_var1 - $nw_var2;
                 }else if($nw_ope=='*'){
                      $med_perfil = ($medida + $nw_var1) * $nw_var2;
                 }else{
                      $med_perfil = ($medida + $nw_var1) / $nw_var2;
                 }
         
            $al = $med_perfil;
 
            }

            if($row["alto_v"]==0){
                $al2= $alto;
                $al2b = $aa;
            }else{
            
            $tv = $al + $row['var1'];
             $sqlw=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["alto_v"]."");
            $fil_al =mysqli_fetch_array(mysqli_query($con2,$sqlw));
            
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

                            if($nw_medida=='0'){

                        if($nw_lado=='Vertical'){
                           $medida = $alto;
                        }else{
                           $medida = $ancho;
                        }
                    }else{
                        if($nw_medida=='1'){
                             $medida = $altura_v_c;
                        }else if($nw_medida=='2'){
                             $medida = $altura;
                        }else if($nw_medida=='3'){
                             $medida = $anchura;
                        }else if($nw_medida=='4'){ 
                             $medida = $anchura_v_c;
                        }else if($nw_medida=='976'){
                             $medida = $ancho; // resolver
                        }else{
                             $medida = $ancho; // resolver
                        }
                    }
                    if($nw_ope=='+'){
                        $med_perfil = $medida + $nw_var1 + $nw_var2;
                    }else if($nw_ope=='-'){
                         $med_perfil = $medida + $nw_var1 - $nw_var2;
                    }else if($nw_ope=='*'){
                         $med_perfil = ($medida + $nw_var1) * $nw_var2;
                    }else{
                         $med_perfil = ($medida + $nw_var1) / $nw_var2;
                    }
            $al2 = $med_perfil;
            }
            //--------------------------------------------------------------------------part 2--------------------------------------------
            
                        if($row['ancho_v2']!=0){
                     $sqlx2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["ancho_v2"]."");
            $fil_an2 =mysqli_fetch_array(mysqli_query($con2,$sqlx2));
  
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

                                if($nw_medida=='0'){

                            if($nw_lado=='Vertical'){
                               $medida = $alto;
                            }else{
                               $medida = $ancho;
                            }
                        }else{
                            if($nw_medida=='1'){
                                 $medida = $altura_v_c;
                            }else if($nw_medida=='2'){
                                 $medida = $altura;
                            }else if($nw_medida=='3'){
                                 $medida = $anchura;
                            }else if($nw_medida=='4'){ 
                                 $medida = $anchura_v_c;
                            }else if($nw_medida=='976'){
                                 $medida = $ancho; // resolver
                            }else{
                                 $medida = $ancho; // resolver
                            }
                        }
                        if($nw_ope=='+'){
                            $med_perfil = $medida + $nw_var1 + $nw_var2;
                        }else if($nw_ope=='-'){
                             $med_perfil = $medida + $nw_var1 - $nw_var2;
                        }else if($nw_ope=='*'){
                             $med_perfil = ($medida + $nw_var1) * $nw_var2;
                        }else{
                             $med_perfil = ($medida + $nw_var1) / $nw_var2;
                        }
            $al22 = $med_perfil;
            }else{
               
                
                $al22 = 0;
                $al22b = 0;
            }
            
           
            if($row['alto_v2']!=0){
             $sqlw2=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$row["alto_v2"]."");
             $fil_al2 =mysqli_fetch_array(mysqli_query($con2,$sqlw2));
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

                 if($nw_medida=='0'){

                    if($nw_lado=='Vertical'){
                       $medida = $alto;
                    }else{
                       $medida = $ancho;
                    }
                }else{
                    if($nw_medida=='1'){
                         $medida = $altura_v_c;
                    }else if($nw_medida=='2'){
                         $medida = $altura;
                    }else if($nw_medida=='3'){
                         $medida = $anchura;
                    }else if($nw_medida=='4'){ 
                         $medida = $anchura_v_c;
                    }else if($nw_medida=='976'){
                         $medida = $ancho; // resolver
                    }else{
                         $medida = $ancho; // resolver
                    }
                }
                if($nw_ope=='+'){
                    $med_perfil = $medida + $nw_var1 + $nw_var2;
                }else if($nw_ope=='-'){
                     $med_perfil = $medida + $nw_var1 - $nw_var2;
                }else if($nw_ope=='*'){
                     $med_perfil = ($medida + $nw_var1) * $nw_var2;
                }else{
                     $med_perfil = ($medida + $nw_var1) / $nw_var2;
                }
            $al2x = $med_perfil;
            }else{
               $al2xb = 0;
                $al2x = 0;
            }
              $tv = ($al + $row['var1']) / $row['divisor'];
             $tv2 = ($al2 + $row['var2']- $al2x) / $row['divisor_alto'];
             

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
            $s3 = "SELECT * FROM tipo_vidrio where id_vidrio='".$id_vidrio."'";
                $fi3 =mysqli_fetch_array(mysqli_query($con2,$s3));
                $color= $fi3['color_v'];

            $m2 = ($an2/1000)*($all/1000);

              $metross = ($an2/1000) * ($all/1000);
              $metro_t = $metross * $cant_item;
              if($item>0){
                if($idproducto!=$id_vidrio){
                    // consulta de cantidades despachadas
                    
                        $consulta2 =mysqli_query($con2,"select despachado from control_despacho where id_cot='$idcot' and cod_producto='$idproducto' ");
                        $c = mysqli_fetch_array($consulta2);
                        $saldo = $c[0];
                    
                    
                    $saldototal = $metros_totales - $saldo;
                    //echo '<tr><td colspan="3">Total por '.$desc_vidrio.' Id: '.$idproducto.'</td><td colspan="4">'.number_format($metros_totales).' Mt2</td>';
                    echo '<tr>
                                <td><input type="text" id="cod'.$idproducto.'"  value="'.$codproducto.'"  style="width: 70px"  onchange="buscarcod('.$idproducto.')"></td>'
                              . '<td style="width: 200px"><input type="text" id="des'.$idproducto.'" disabled  value="'.$desc_vidrio.'" style="width:100%"></td>'
                              . '<td><input type="text" id="med'.$idproducto.'"  value="" style="width:70px"></td>'
                              . '<td><input type="text" id="col'.$idproducto.'"  value="'.$row['color'].'" style="width: 70px"></td>'
                            . '<td><input type="text" id="pre'.$idproducto.'"  value="'.$precio.'" disabled style="width: 70px">'
                              . '<td>'.number_format($metros_totales,2).' Mt2</td>'
                              . '<td><input type="text" id="pcant'.$idproducto.'" disabled style="width: 60px" value="'.number_format($saldototal,2).'"></td>'
                              . '<td><input type="text" id="ncant'.$idproducto.'" onchange="veri('.$idproducto.')" '.$disa.' style="width: 60px" value=""></td>'
                            . '<td><input type="text" id="sto'.$idproducto.'"  value="" disabled style="width: 70px">'
                              . '<td><button id="'.$idproducto.'" disabled onclick="agregarpro('.$idproducto.')">Agregar</button></td>';

                    
                    $metros_totales=0;
                }
                }
              
                $espesor= $fi3['espesor_v'];
                $moneda= $fi3['moneda'];
                
                $codproducto= $fi3['codigo_vid'];
                
                
                
                $item = $item+1;
                $metros_totales +=$metro_t;

                                                
                                                  $idproducto=$fila21["id_vidrio"];
                                                  $pro=$codproducto;
                                                  $desc_vidrio = $color;
                                }
                              
                             }
                             // consulta de cantidades despachadas
                    $consulta =mysqli_query($con2,"select count(despachado) from control_despacho where id_cot='$idcot' and cod_producto='$idproducto' ");
                    $c = mysqli_fetch_array($consulta);
                    if($c[0]==0){
                        
                        $saldo = 0;
                    }else{
                        $consulta2 =mysqli_query($con2,"select despachado from control_despacho where id_cot='$idcot' and cod_producto='$idproducto' ");
                        $c = mysqli_fetch_array($consulta2);
                        $saldo = $c[0];
                    }
                    
                    $saldototal = $metros_totales - $saldo;
                    
                              //echo '<tr><td colspan="3">Total por '.$desc_vidrio.' Id: '.$idproducto.'</td><td colspan="4">'.number_format($metros_totales).' Mt2</td>';
                              echo '<tr>
                                <td><input type="text" id="cod'.$idproducto.'"  value="'.$codproducto.'"  style="width: 70px" onchange="buscarcod('.$idproducto.')"></td>'
                              . '<td style="width: 200px"><input type="text" id="des'.$idproducto.'" disabled  value="'.$desc_vidrio.'" style="width:100%"></td>'
                              . '<td><input type="text" id="med'.$idproducto.'"  value="" style="width:70px"></td>'
                              . '<td><input type="text" id="col'.$idproducto.'"  value="'.$row['color'].'" style="width: 70px"></td>'
                            . '<td><input type="text" id="pre'.$idproducto.'"  value="'.$precio.'" disabled style="width: 70px">'
                              . '<td>'.number_format($metros_totales,2).' Mt2</td>'
                              . '<td><input type="text" id="pcant'.$idproducto.'" disabled style="width: 60px" value="'.number_format($saldototal,2).'"></td>'
                              . '<td><input type="text" id="ncant'.$idproducto.'" onchange="veri('.$idproducto.')" '.$disa.' style="width: 60px" value=""></td>'
                                      . '<td><input type="text" id="sto'.$idproducto.'"  value="" disabled style="width: 70px">'
                              . '<td><button id="'.$idproducto.'" disabled onclick="agregarpro('.$idproducto.')">Agregar</button></td>';

                                    ?>
                                </tbody>
                            </table>
                        
