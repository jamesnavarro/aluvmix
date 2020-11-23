<?php
include '../../../modelo/conexioni.php';
session_start();
$usuario = $_SESSION['k_username'];
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){

    case 2:
        $request2=mysqli_query($con,'SELECT * FROM producto WHERE codigo="'.$_GET['cod'].'"');
        $row2=mysqli_fetch_array($request2);
        $p = array();
        $p[0] = $row2["id_p"];
          $p[1] = $row2["producto"];
          $p[2] = $row2["codigo"];
          $p[3] = $row2["referencia_p"];
            $cadena_de_texto = $row2["producto"];
            $cadena_per   = 'PERFORACION';
            $per = strrpos($cadena_de_texto, $cadena_per);
            $cadena_boq   = 'BOQUETE';
            $boq = strrpos($cadena_de_texto, $cadena_boq);
            if ($per === false) {
            $pe = 0;
            } else {
            $pe = 1;
            }
            if ($boq === false) {
            $bo = 0;
            } else {
            $bo = 1;
            }
          $p[4] = $pe;
          $p[5] = $bo;
          $p[6] = $row2["laminas"];
        echo json_encode($p);
        exit();
        break;

        case 7:
        $cot = $_GET['cot'];
            //$est = $_GET['est'];
        $result = mysqli_query($con,"SELECT * FROM cotizacion_item d where compuesto=".$cot." and estado='Guardado' and id_cot_principal=0  ");
        $c = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
        while($row = mysqli_fetch_array($result)){
        $c +=1;
        $valor = $row["valor_item"];
        $descpor = $valor * ($row["descuento"] / 100);

        $ptt2 = ($valor +  $descpor);
        $pud = $ptt2 / $row["cantidad"];
        $iva = $ptt2 * ($row["iva"]/100);
        
        $pu = ($ptt2 / $row["cantidad"]);
        
        $total = $ptt2 + $iva;
        $gt += $ptt2;
        $gtiva += $total;
        $ct +=$row['cantidad'];
     
        $di = 'disabled';
     
        ?>
        <tr>
            <td><input type="hidden" id="idtem<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['id_cot_item']; ?>" style="width: 60px">
                <input type="text" <?php echo $di; ?> id="tipo<?php echo $c; ?>" style="text-align: center;width: 40px"  onclick="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" class="input6" value="<?php echo $row['item']; ?>"></td>
            <td><input type="text" id="cod<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['codigo']; ?>" style="width: 60px"></td>
            <td><?php echo $row['descripcion_principal']; ?><input type="hidden" id="des<?php echo $c; ?>" style="width: 300px" disabled value="<?php echo $row['descripcion_principal']; ?>" title="<?php echo $row['descripcion_principal']; ?>"></td>
            <td><input type="text" <?php echo $di; ?>  onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="ancho<?php echo $c; ?>" style="width: 60px" value="<?php echo $row['ancho']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="alto<?php echo $c; ?>" style="width: 60px" value="<?php echo $row['alto']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="per<?php echo $c; ?>" style="width: 40px"  value="<?php echo $row['perforacion']; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)"></td>
            <td><input type="text" <?php echo $di; ?> id="boq<?php echo $c; ?>" style="width: 40px"  value="<?php echo $row['boquete']; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)"></td>
            <td><input type="text" <?php echo $di; ?> onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" style="text-align: center;width: 40px" id="cant<?php echo $c; ?>" class="input6" value="<?php echo $row['cantidad']; ?>"></td>
            <td><input type="text"  id="pud<?php echo $c; ?>"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($pud,2,'.',''); ?>"></td>
            <td><input type="text"  id="ptd<?php echo $c; ?>" name="item" style="width: 80px;text-align: right" disabled value="<?php echo number_format($ptt2,2,'.',''); ?>"></td>
            <td><input type="text"  id="piva<?php echo $c; ?>"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($total,2,'.',''); ?>"></td>
            <td><input type="text" <?php echo $di; ?>  onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="desc<?php echo $c; ?>" style="width: 35px"  value="<?php echo $row['descuento']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="ubc<?php echo $c; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)"  style="width: 50px" value="<?php echo $row['ubicacion']; ?>" title="<?php echo $row['ubicacion']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="obse<?php echo $c; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)"  style="width: 50px" value="<?php echo $row['observacion']; ?>" title="<?php echo $row['observacion']; ?>"></td>
            <td><input type="text" <?php echo $di; ?> id="rep<?php echo $c; ?>" style="width: 20px" value="1"></td>
            <td> 
            <button <?php echo $di; ?> onclick="rep_item(<?php echo $c.','.$row['id_cot_item']; ?>);" id="bot<?php echo $c; ?>" >R</button>
            <td> <button <?php echo $di; ?> onclick="pre_cotizar(<?php echo $row['id_cot_item']; ?>);" id="editar<?php echo $c; ?>" >Up</button></div></td>
        <td><div id="boton<?php echo $c; ?>"><button <?php echo $di; ?> onclick="del_item(<?php echo $c.','.$row['id_cot_item']; ?>);" id="bot<?php echo $c; ?>" >-</button>
        </tr>


        <?php
        }
        ?>
        <tr>
            <th><input type="text" id="ct" style="width: 40px" value="<?php echo $c; ?>" disabled></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Totales:</th>
            <th><input type="text" id="cantotal"  class="input6" disabled value="<?php echo number_format($ct); ?>" style="width: 40px;text-align: right"></th>
            <th></th>
            <th><input type="text" id="subgrantotal"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($gt,2,'.',''); ?>"></th>
            <th><input type="text" id="grantotal"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($gtiva,2,'.',''); ?>"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
        mysqli_query($con,"update cotizacion_item set total_compuestos='$gt' where id_cot_item='$cot' ");
        break;
        case 8:
        $id=$_GET['id'];
            mysqli_query($con,"delete from cotizacion_insumos where id_cot_item='$id' ");
            mysqli_query($con,"delete from cotizacion_item where id_cot_item='$id' ");
            mysqli_query($con,"delete from cotizacion_item where id_cot_principal='$id' ");

        break;
        case 9:
        $id  = $_GET['id'];
        $rep = $_GET['rep'];

        $result = mysqli_query($con,"select * from cotizacion_item where id_cot_item='$id' ");
        $row = mysqli_fetch_array($result);
        for($i=0;$i<$rep;$i++){
         //$ct = $_GET['ct'] + $i;

           mysqli_query($con,"INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`)"
                   . " VALUES ('".$row['id_cot']."','".$row['codigo']."','".$row['descripcion_principal']."','".$row['trazabilidad']."','".$row['descripcion_segunda']."','".$row['ancho']."', '".$row['alto']."','".$row['cantidad']."','".$row['laminas']."','".$row['perforacion']."','".$row['boquete']."','".$row['pelicula']."','".$row['carton']."','".$row['linea_cot']."', '".$row['id_cot_principal']."','".$row['ubicacion']."','".$row['observacion']."', '".$row['item']."','".$row['instalaccion']."','".$row['valor_item']."','".$row['descuento']."','".$row['iva']."','".$row['fecha_registro']."','".$row['usuario']."', '".$row['estado']."', '".$row['por_vid']."', '".$row['por_alu']."', '".$row['por_acc']."')");
           echo  mysqli_error($con);
           $max = mysqli_insert_id($con);
           $idp = $row['id_cot_item'];
           $result2 = mysqli_query($con,"select * from cotizacion_item where id_cot_principal='$idp' ");
           while($f = mysqli_fetch_array($result2)){
               $sql3 = "INSERT INTO `cotizacion_item` (`id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`)";
               $sql3.= "VALUES ('".$f['id_cot']."','".$f['codigo']."','".$f['descripcion_principal']."','".$f['trazabilidad']."','".$f['descripcion_segunda']."','".$f['ancho']."', '".$f['alto']."','".$f['cantidad']."','".$f['laminas']."','".$f['perforacion']."','".$f['boquete']."','".$row['pelicula']."','".$f['carton']."','".$f['linea_cot']."', '".$max."','".$f['ubicacion']."','".$f['observacion']."', '".$f['item']."','".$f['instalaccion']."','".$f['valor_item']."','".$f['descuento']."','".$f['iva']."','".$f['fecha_registro']."','".$f['usuario']."', '".$f['estado']."', '".$f['por_vid']."', '".$f['por_alu']."', '".$f['por_acc']."')";
               mysqli_query($con,$sql3);
               
           }
           $result3 = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$idp' ");
           $totalx = 0;
           while($r = mysqli_fetch_array($result3)){
               mysqli_query($con,"INSERT INTO `cotizacion_insumos` (`extra`,`id_cot`, `codigo`, `id_cot_item`, `cantidad`, `unidad`, `precio_unidad`, `medida`, `color`,`item`) "
                        . "VALUES ('".$r['extra']."','".$r['id_cot']."', '".$r['codigo']."', '".$max."', '".$r['cantidad']."', '".$r['unidad']."', '".$r['precio_unidad']."', '".$r['medida']."', '".$r['color']."','".$r['item']."');");
           }
           
           
           
        }
        


        break;

        case 20:
            $cot = $_GET['cot'];
            $cod = $_GET['cod'];
            $id = $_GET['id'];
            $descri = $_GET['descri'];
            $col = $_GET['col'];
            $med = $_GET['med'];
            $can = $_GET['can'];
            $pre = $_GET['pre'];
            $pre_r = $_GET['pre_r'];
            $neto = $_GET['neto'];
            $tota = $_GET['tota'];
            $des = $_GET['des'];
            $m = $_GET['m'];
            
            $sql = "INSERT INTO `cotizaciones_materiales` (`color_ma`, `med`, `pe`, `id_cotizacion`, `id_material`, `cantidad_mat`, `descuento_mat`, `valor_und`, `valor_neto`, `valor_pagar`, `descripcion_material`, `codigo_material`)";
            $sql.= "VALUES ('".$col."', '".$med."', 'p1','".$cot."', '".$id."', '".$can."', '".$des."', '".$pre_r."', '".$neto."', '".$tota."', '".$descri."', '".$cod."')";
            $ver = mysqli_query($con,$sql, $conexion);
            echo $ver;
            
            
        break;
        case 21:
        $cot = $_GET['cot'];
        $query = mysqli_query($con,"select * from cotizaciones_materiales where id_cotizacion = '$cot' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_row($query)){
            $c ++;
            $nt += $f[12];
            $tt += $f[13];
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$f[15].'</td>'
                    . '<td>'.$f[14].'</td>'
                    . '<td>'.$f[9].'</td>'
                    . '<td><input type="number" id="v_med'.$f[0].'" value="'.$f[7].'" style="width:60px" disabled></td>'
                    . '<td><input type="number" id="v_can'.$f[0].'" value="'.$f[3].'" style="width:50px" disabled></td>'
                    . '<td><input type="number" id="v_und'.$f[0].'" value="'.$f[11].'" style="width:80px;text-align:right" disabled></td>'
                    . '<td><input type="number" id="v_net'.$f[0].'" value="'.$f[12].'" style="width:80px;text-align:right" disabled></td>'
                    . '<td><input type="number" id="v_tot'.$f[0].'" value="'.$f[13].'" style="width:80px;text-align:right" disabled></td>'
                    . '<td><input type="number" id="v_por'.$f[0].'" value="'.$f[4].'" style="width:60px;text-align:right"  disabled></td>'
                    . '<td><button id="btn_del_ven" onclick="del_ventas('.$f[0].')"> - </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nt).'</td>'
                    . '<td style="text-align:right">'.number_format($tt).'</td>'
                    . '<td style="text-align:right"></td>'
                    . '<td></td>';
        break;
    case 22:
        $id = $_GET['id'];
        $query = mysqli_query($con,"delete from cotizaciones_materiales where id_cot_mat = '$id' ");
        echo $query;
        break;
    case 23:
         $id = $_GET['id'];
          $uti = $_GET['uti'];
           $costo = $_GET['cos'];
           $ver = mysqli_query($con,"update referencias set costo_mt='$costo', utilidad='$uti', modificado='".$_SESSION['k_username']."' where id_referencia='$id' ");
           echo $ver;
           break;
    case 24:
        $cod= $_GET['cod'];
        $result = mysqli_query($con,"select a.secuencia,b.nombre_puesto from hojas_rutas a, puestos_trabajos b where a.codigo_pue=b.id_puesto and a.codigo_pro='$cod' ");
        echo '<ul>';
       
        while($r = mysqli_fetch_array($result)){
            echo '<li>'.$r[0].' '.$r[1];
        }
        break;
    case 25:
        $n= $_GET['n'];
        $cod= $_GET['cod'];
        $can= $_GET['can'];
        $desp= $_GET['desp'];
        $dtx= $_GET['dt'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cot = $_GET['cot'];
        $idins = $_GET['idins'];
        $itemid = $_GET['item'];
        $extra = $_GET['extra'];
        $tipo = $_GET['tipo'];
        $porcentaje = (100 - $desp)/100;
        $mt2 = ($ancho/1000) * ($alto/1000) * $can;
        $mt = ((($ancho/1000) + ($alto/1000)) * 2) * $can;
        $medida = $ancho.'x'.$alto;

        $result = mysqli_query($con,"select b.costo_promedio, a.id_pp, a.und_med, a.cantidad,a.parametro from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.codigo_pro='$cod' and a.codigo_ref='$dtx' ");
        $r = mysqli_fetch_array($result);
        $id = $r[1];
        $med = $r[2];
        $canins = $r[3];
        $par = $r[4];

        if($med=='und'){
            $subcan = $can * $canins;
        }else if($med=='m2'){
            $subcan = $canins * $mt2;
        }else if($med=='mt'){
            $subcan = $mt * $canins;
        }else{
            $subcan = $can * $canins;
        }
        $st1 = $r[0] * $subcan;
        $result2 = mysqli_query($con,"select b.costo_promedio, a.id_pp, a.und_med, a.cantidad from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.compuesto='$id' and tipo='Fijo' order by parametro asc ");
        $st = 0;
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
                    //$costo .= $mt.' * ='.$caninscom.'= id'.$id.',,';
                }else{
                    $subcancomp = $can * $caninscom;
                }
                 $su = $sr[0] * $subcancomp;
                $st += $su;
                $costo .= $mt2.' <'.$subcancomp.' X '.$sr[0].' = '.$su.'>';
        }
        if($par=='espaciadores'){
            $item = 'ES'.$n;
        }else{
                $item = 'EN'.$n;
        }
        
        $tod = $st1 + $st ;
        $tod = $tod;//  / $porcentaje
        $toddesp = $tod / $porcentaje;
        $to = $tod / $can;
        if($idins==''){
             mysqli_query($con,"INSERT INTO `cotizacion_insumos` (`porcentaje`,`tipomat`,`extra`,`id_cot`, `codigo`, `id_cot_item`, `cantidad`, `unidad`, `precio_unidad`, `medida`, `color`,`item`) "
                        . "VALUES ('$desp','$tipo','$extra','$cot', '$cod', '$itemid', '$subcan', '$med', '$to', '$medida', '','$item');");
             $idins = mysqli_insert_id($con);
        }else{
            mysqli_query($con,"update cotizacion_insumos set porcentaje='$desp',tipomat='$tipo',codigo='$cod',unidad='$med',cantidad='$subcan', medida='$medida',id_cot_item='$itemid',item='$item',precio_unidad='$to' where id_cot_ins='$idins' ");
            
        }
        $p = array();
        $p[0] = number_format($to,2,'.','');
        $p[1] = number_format($tod,2,'.','');
        $p[2] = $subcan;
        $p[3] = $med;
        $p[4] = 'res 1: '.$st1.' res 2:'.$st.' costo 1:'.$r[0].' costo 2:'.$costo.' SUBCANT: '.$subcan;
        $p[5] = $item;
        $p[6] = $id;
        $p[7] = $idins;
        $p[8] = number_format($toddesp,2,'.','');
        echo json_encode($p);
        break;
    case 26:
        echo $cod = $_GET['codigo'];
        $coditem = $_GET['codigoitem'];
        $item = $_GET['item'];
        $idpp = $_GET['idpp'];
        $query = mysqli_query($con , "select b.costo_promedio, a.id_pp, a.und_med, a.cantidad, a.codigo_pro, b.descripcion from productos_parametros a, productos_var b where a.codigo_pro=b.codigo and a.compuesto='$idpp' and a.tipo='Seleccionable' order by parametro asc ");
        echo '<option value="">Seleccione</option>';
        while($r = mysqli_fetch_array($query)){
            echo '<option value="'.$r['codigo_pro'].'">'.$r['codigo_pro'].' '.$r['descripcion'].'</option>';
        } 
        break;
    case 27:
        $cot = $_GET['cot'];
        $des = $_GET['des'];
        $des0 = $_GET['des0'];
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cant = $_GET['cant'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $pelicula = $_GET['pelicula'];
        $carton = $_GET['carton'];
        $despvid = $_GET['despvid'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        $inst = $_GET['inst'];
        $ubc = $_GET['ubc'];
        $obse = $_GET['obse'];
        $item = $_GET['item'];
        $desc = $_GET['desc'];
        $valor = $_GET['precio'];
        $estado = $_GET['estado'];
        $comision = $_GET['comision'];
        $reposicion = $_GET['reposicion'];
        $imprevisto = $_GET['imprevisto'];
        $utilidad = $_GET['utilidad'];
        
        $anchocfd = $_GET['anchocfd'];
        $altocfs = $_GET['altocfs'];
        $anchocfi = $_GET['anchocfi'];
        $altocfi = $_GET['altocfi'];
        $altorej = $_GET['altorej'];
        
        $rieles = $_GET['rieles'];
        $alfajias = $_GET['alfajias'];
        $rejillas = $_GET['rejillas'];
        $cierres = $_GET['cierres'];
        $rodajas = $_GET['rodajas'];
        $entre_rej = $_GET['entre_rej'];
        
        $brazos = $_GET['brazos'];
        $bisagras = $_GET['bisagras'];
        $can_bis = $_GET['can_bis'];
        
        $linea = $_GET['linea'];
        $color = $_GET['color'];
        $comp = $_GET['comp'];
        $can_cie = $_GET['can_cie'];
        
        $anchototal = $_GET['anchototal'];
        $altototal = $_GET['altototal'];
        
        $can_rod = $_GET['can_rod'];
        $can_bra = $_GET['can_bra'];
        
        $traz1 = $_GET['traz1'];
        $traz2 = $_GET['traz2'];
        $traz3 = $_GET['traz3'];
        $traz4 = $_GET['traz4'];
        
        
 
        if($estado==''){
        mysqli_query($con,"INSERT INTO `cotizacion_item` (`trazvid1`,`trazvid2`,`trazvid3`,`trazvid4`,`can_rodajas`,`can_brazos`,`ancho_total`,`alto_total`,`can_cierres`,`brazos`,`bisagras`,`bisagras_cant`,`compuesto`,`color`,`rieles`,`alfajia`,`rejillas`,`cierres`,`rodajas`,`entre_rej`,`anchocfd`,`altocfs`,`anchocfi`,`altocfi`,`altorej`,`utilidad`, `id_cot`, `codigo`, `descripcion_principal`, `trazabilidad`,`descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`) "
                . "VALUES ('$traz1','$traz2','$traz3','$traz4','$can_rod','$can_bra','$anchototal','$altototal','$can_cie','$brazos','$bisagras','$can_bis','$comp','$color','$rieles','$alfajias','$rejillas','$cierres','$rodajas','$entre_rej','$anchocfd', '$altocfs', '$anchocfi', '$altocfi', '$altorej','$utilidad', '$cot', '$cod', '$des', '$cod', '$des0', '$ancho', '$alto', '$cant', '$lam', '$per', '$boq', '$pelicula', '$carton', '$linea', '0', '$ubc', '$obse', '$item', '$inst', '$valor', '$desc', '19', '$fecha', '$usuario', 'En proceso','$despvid','$despalu','$despacc');");
        $id = mysqli_insert_id($con);
        
        }else{
            mysqli_query($con,"update cotizacion_item set trazvid1='$trazvid1',trazvid2='$trazvid2',trazvid3='$trazvid3',trazvid4='$trazvid4',can_rodajas='$can_rod',can_brazos='$can_bra',ancho_total='$anchototal',alto_total='$altototal',can_cierres='$can_cie',brazos='$brazos',bisagras='$bisagras',bisagras_cant='$can_bis',compuesto='$comp',color='$color', rieles='$rieles',alfajia='$alfajias',rejillas='$rejillas',cierres='$cierres',rodajas='$rodajas',entre_rej='$entre_rej',anchocfd='$anchocfd',altocfs='$altocfs',anchocfi='$anchocfi',altocfi='$altocfi',altorej='$altorej',utilidad='$utilidad', descripcion_principal='$des',descripcion_segunda='$des0',laminas='$lam',cantidad='$cant',valor_item='$valor',por_vid='$despvid',por_alu='$despalu',por_acc='$despacc',instalaccion='$inst',pelicula='$pelicula' where id_cot_item='$item' ");
            $id = $item;
            mysqli_query($con,"delete from cotizacion_item where id_cot_principal='$item' ");
            mysqli_query($con,"delete from cotizacion_insumos where id_cot_item='$item' ");
        }
        
        $p = array();
        $p[0] =  $id;
        $p[1] =  mysqli_error($con);
        echo json_encode($p);
        
        break;
        case 28:
        $cot = $_GET['cot'];
        $des = $_GET['des'];
        $des0 = $_GET['des0'];
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cant = $_GET['cant'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $pelicula = $_GET['pelicula'];
        $carton = $_GET['carton'];
        $despvid = $_GET['despvid'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        $inst = $_GET['inst'];
        $ubc = $_GET['ubc'];
        $obse = $_GET['obse'];
        $item = $_GET['item'];
        $desc = $_GET['desc'];
        $valor = $_GET['precio'];
        $estado = $_GET['estado'];
        $itemv = $_GET['itemv'];
        $idlam = $_GET['idlam'];
        $traz = $_GET['traz'];
        
        $comision = $_GET['comision'];
        $reposicion = $_GET['reposicion'];
        $imprevisto = $_GET['imprevisto'];
        $utilidad = $_GET['utilidad'];
        $mob = $_GET['mob'];
        $idparvid = $_GET['idparvid'];
        $desparvid = $_GET['desparvid'];
        $modulo = $_GET['modulo'];
        
        $traz1 = $_GET['traz1'];
        $traz2 = $_GET['traz2'];
        $traz3 = $_GET['traz3'];
        $traz4 = $_GET['traz4'];
        
        $hor = $_GET['hor'];
        $ver = $_GET['ver'];
        
        if($idlam==''){
        mysqli_query($con,"INSERT INTO `cotizacion_item` (`verticales`,`horizontales`,`trazvid1`,`trazvid2`,`trazvid3`,`trazvid4`,`modulo`,`id_parametro_vidrio`,`hoja_vidrio`,`total_mob`,`id_cot`, `codigo`, `descripcion_principal`,`trazabilidad`, `descripcion_segunda`, `ancho`, `alto`, `cantidad`, `laminas`, `perforacion`, `boquete`, `pelicula`, `carton`, `linea_cot`, `id_cot_principal`, `ubicacion`, `observacion`, `item`, `instalaccion`, `valor_item`, `descuento`, `iva`, `fecha_registro`, `usuario`, `estado`, `por_vid`, `por_alu`, `por_acc`) "
                . "VALUES ('$ver','$hor','$traz1','$traz2','$traz3','$traz4','$modulo' ,'$idparvid' ,'$desparvid','$mob' ,'$cot', '$cod', '$des', '$traz', '$des0', '$ancho', '$alto', '$cant', '$lam', '$per', '$boq', '$pelicula', '$carton', 'Vidrio', '$item', '$ubc', '$obse', '$itemv', '$inst', '$valor', '$desc', '19', '$fecha', '$usuario', 'Guardado','$despvid','$despalu','$despacc');");
        $id = mysqli_insert_id($con);
        $error = mysqli_error($con);
        
        }else{
            mysqli_query($con,"update cotizacion_item set verticales='$ver',horizontales='$hor',trazvid1='$trazvid1',trazvid2='$trazvid2',trazvid3='$trazvid3',trazvid4='$trazvid4', modulo='$modulo' ,id_parametro_vidrio='$idparvid' ,hoja_vidrio='$desparvid' ,codigo='$cod' ,total_mob='$mob' ,trazabilidad='$traz',descripcion_principal='$des',descripcion_segunda='$des0',laminas='$lam',cantidad='$cant',valor_item='$valor',por_vid='$despvid',por_alu='$despalu',por_acc='$despacc' where id_cot_item='$idlam' ");
            $id = $idlam;
            $error = mysqli_error($con);
        }
         mysqli_query($con,"update cotizacion_item set descripcion_principal='$des0' where id_cot_item='$item' ");
        $p = array();
        $p[0] =  $id;
        $p[1] =  $error;
        
        echo json_encode($p);
        
        break;
    case 29:
        $cod = $_GET['dtx'];
        $can = $_GET['can'];
        $result = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$cod' and a.extra='Si' ");
        $total = 0;
        while($r = mysqli_fetch_array($result)){
            $total += ($r['precio_unidad']*$can);
                    echo '<tr>';
                    echo '<td>'.$r['item'].'</td>
                          <td>'.$r['codigo'].'<td>'.$r['descripcion'].'</td>
                          <td>'.$r['cantidad'].'</td>
                          <td>'.$r['unidad'].'</td>
                          <td>'.$r['precio_unidad'].'</td>
                          <td>'.number_format($r['precio_unidad']*$can,2,'.','').' <button onclick="borrar_comp('.$r['id_cot_ins'].')"> - </button></td>';
        }
        echo '<tr><td colspan="5">Total Insumos extras<td><input type="number" id="total_comp" value="'.$total.'" style="width:60px;" disabled>';
        break;
    case 30:
        $id = $_GET['id'];
        mysqli_query($con, "delete from cotizacion_insumos where id_cot_ins='$id' ");
        
        break;
    case 31:
        $cot = $_GET['cot'];
        $des = $_GET['des'];
        $des0 = $_GET['des0'];
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $cant = $_GET['cant'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $pelicula = $_GET['pelicula'];
        $carton = $_GET['carton'];
        $despvid = $_GET['despvid'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        
        $inst = $_GET['inst'];
        $ubc = $_GET['ubc'];
        $obse = $_GET['obse'];
        $item = $_GET['item'];
        $itemx = $_GET['itemx'];
        $desc = $_GET['desc'];
        $despesp = $_GET['despesp'];
        $despint = $_GET['despint'];
        $precio = $_GET['precio'];
        $estado = 'Guardado';
        $utilidad = $_GET['utilidad'];
        
            $anchocfd = $_GET['anchocfd'];
        $altocfs = $_GET['altocfs'];
        $anchocfi = $_GET['anchocfi'];
        $altocfi = $_GET['altocfi'];
        $altorej = $_GET['altorej'];
        
        $anchototal = $_GET['anchototal'];
        $altototal = $_GET['altototal'];
        
        $rieles = $_GET['rieles'];
        $alfajias = $_GET['alfajias'];
        $rejillas = $_GET['rejillas'];
        $cierres = $_GET['cierres'];
        $rodajas = $_GET['rodajas'];
        $entre_rej = $_GET['entre_rej'];
        $color = $_GET['color'];
        $compuesto = $_GET['compuesto'];
        
        $brazos = $_GET['brazos'];
        $bisagras = $_GET['bisagras'];
        $can_bis = $_GET['can_bis'];
        $can_cie = $_GET['can_cie'];
        $can_rod = $_GET['can_rod'];
        $can_bra = $_GET['can_bra'];
        
        $traz1 = $_GET['traz1'];
        $traz2 = $_GET['traz2'];
        $traz3 = $_GET['traz3'];
        $traz4 = $_GET['traz4'];
         $hor = $_GET['hor'];
        $ver = $_GET['ver'];

        $ver = mysqli_query($con,"update cotizacion_item set perforacion='$per',boquete='$boq',verticales='$ver',horizontales='$hor',trazvid1='$traz1',trazvid2='$traz2',trazvid3='$traz3',trazvid4='$traz4',can_rodajas='$can_rod',can_brazos='$can_bra',ancho_total='$anchototal',alto_total='$altototal',can_cierres='$can_cie',brazos='$brazos',bisagras='$bisagras',bisagras_cant='$can_bis',valor_item='$precio', compuesto='$compuesto', color='$color',rieles='$rieles',alfajia='$alfajias',rejillas='$rejillas',cierres='$cierres',rodajas='$rodajas',entre_rej='$entre_rej',anchocfd='$anchocfd',altocfs='$altocfs',anchocfi='$anchocfi',altocfi='$altocfi',altorej='$altorej',utilidad='$utilidad', ancho='$ancho', alto='$alto', por_esp='$despesp' ,por_int='$despint' ,estado='$estado' ,descripcion_principal='$des',descripcion_segunda='$des0',laminas='$lam',cantidad='$cant',por_vid='$despvid',por_alu='$despalu',por_acc='$despacc',item='$itemx',pelicula='$pelicula', instalaccion='$inst'  where id_cot_item='$item' ");
        echo mysqli_error($con).'op'.$precio.'-'.$ver;
        mysqli_query($con,"update cotizacion_item set estado='$estado' where id_cot_principal='$item' ");
        
        break;
    case 32:
        $item = $_GET['item'];
        $result = mysqli_query($con, "select * from cotizacion_item where id_cot_item='$item' ");
        $r = mysqli_fetch_array($result);
        $p = array();
        $p[0] = $r[0];
        $p[1] = $r[1];
        $p[2] = $r[2];
        $p[3] = $r[3];
        $p[4] = $r[4];
        $p[5] = $r[5];
        $p[6] = $r[6];
        $p[7] = $r[7];
        $p[8] = $r[8];
        $p[9] = $r[9];
        $p[10] = $r[10];
        $p[11] = $r[11];
        $p[12] = $r[12];
        $p[13] = $r[13];
        $p[14] = $r[14];
        $p[15] = $r[15];
        $p[16] = $r[16];
        $p[17] = $r[17];
        $p[18] = $r[18];
        $p[19] = $r[19];
        $p[20] = $r[20];
        $p[21] = $r[21];
        $p[22] = $r[22];
        $p[23] = $r[23];
        $p[24] = $r[24];
        $p[25] = $r[25];
        $p[26] = $r[26];
        $p[27] = $r[27];
        $p[28] = $r[28];
        $p[29] = $r[29];
        $p[30] = $r[30];
        $p[31] = $r[31];
        $p[32] = $r[32];
        $p[33] = $r[33];
        $p[34] = $r[34];
        $p[35] = $r[35];
        $p[36] = $r[36];
        $p[37] = $r[37];
        $p[38] = $r[38];
        $p[39] = $r[39];
        $p[40] = $r[40];
        $p[41] = $r[41];
        $p[42] = $r[42];
        $p[43] = $r[43];
        $p[44] = $r[44];
        $p[45] = $r[45];
        $p[46] = $r[46];
        $p[47] = $r[47];
        $p[48] = $r[48];
        $p[49] = $r[49];
        $p[50] = $r[50];
        $p[51] = $r[51];
        $p[52] = $r[52];
        $p[53] = $r[53];
        $p[54] = $r[54];
        $p[55] = $r[55];
        $p[56] = $r[56];
        $p[57] = $r[57];
        $p[58] = $r[58];
        $p[59] = $r[59];
        

        if($r[60]!=''){
                  $p[60]= '<center><img src="../../../archivos/'.$r[60].'" style="width: 50px;"/></center>' ;
              }else{
                  $p[60]= '' ;
              }
        $p[61] = $r[61];
        $p[62] = $r[62];
        $p[63] = $r[63];
        $p[64] = $r[64];
        $p[65] = $r[65];
        $p[66] = $r[66];
        $p[67] = $r[67];
        $p[68] = $r[68];
        $p[69] = $r[69];
        $p[70] = $r[70];
        $p[71] = $r[71];
        $p[72] = $r[72];
        $p[73] = $r[73];
        
        echo json_encode($p);
        
        break;
        case 32.1:
        $item = $_GET['item'];
        $result = mysqli_query($con, "select * from cotizacion_item where id_cot_item='$item' ");
        $r = mysqli_fetch_array($result);
        $p = array();
        $p[0] = $r[46];
        $p[1] = $r[47];
        $p[2] = $r[48];
        $p[3] = $r[49];
        $p[4] = $r[50];
        $p[5] = $r[51];
        
        $p[6] = $r[56];
        $p[7] = $r[57];
        $p[8] = $r[58];
        $p[9] = $r[59];

        echo json_encode($p);
        
        break;
    case 33:
        $idcot = $_GET['idcot'];
        $por_vid=  $_GET['por_vid'];
        $por_alu=  $_GET['por_alu'];
        $por_acc=  $_GET['por_acc'];
        $por_ace=  $_GET['por_ace'];
        $por_esp=  $_GET['por_esp'];
        $por_int=  $_GET['por_int'];
        $utilidad=  $_GET['utilidad'];
        $ver = mysqli_query($con, "update cotizacion set utilidad='$utilidad', desp_vid='$por_vid', desp_alu='$por_alu' , desp_acc='$por_acc' , desp_ace='$por_ace', desp_esp='$por_esp',desp_int='$por_int' where id_cot='$idcot' ");
        echo $ver;
        
        break;
    case 34:
        $idcot  = $_GET['cot'];
        $id_cos = $_GET['id_cos'];
        $item   = $_GET['item'];
        $por   = $_GET['por'];
        $query = mysqli_query($con, "select id_ci from costos_items where id_cot_item='$item' and id_cos='$id_cos' ");
        $c = mysqli_fetch_array($query);
        if(!$c){
            mysqli_query($con, "insert into costos_items (id_cos,id_cot_item,id_cot, porcentaje_item,fecha_registro,por) "
                    . "values ('$id_cos','$item','$idcot','$por','$fecha','$usuario')");
            echo mysqli_error($con);
        }else{
            mysqli_query($con, "update costos_items set porcentaje_item='$por' where id_cot_item='$item' and id_cos='$id_cos' ");
             echo mysqli_error($con);
        }
         echo mysqli_error($con);
         mysqli_query($con, "update cotizacion set planilla='1' where id_cot='$idcot' ");
        break;
    case 35:
        $item = $_GET['item'];
        $uti = $_GET['uti'];
        mysqli_query($con, "update costos_items set utilidad='$uti' where id_cot_item='$item' ");
        mysqli_query($con, "update costos_items set utilidad='$uti' where id_cot_principal='$item' ");
        
        break;
    case 36:
        
        
                $resultado = mysqli_query($con,"select count(*), codigo from cotizacion_item where  id_cot=".$_GET['cot']." and id_cot_principal!=0 group by codigo ");
                $contador=0;
                while($c = mysqli_fetch_row($resultado)){
                    $contador ++;
                    //echo $c[1].' '.$c[0];
                }

                if($contador>1){
                    $disabled = 'disabled';
                    $msg = 'No puedes editar, vidrios diferentes';
                }else{
                    $disabled = '';
                    $msg = '';
                }
                $p = array();
                $p[0] = $disabled;
                $p[1] = $msg;
                echo json_encode($p);
      
        break;
           case 37:
        $cod  = $_GET['cod'];
        $id  = $_GET['id'];
        $result = mysqli_query($con, "select desc_referencia from producto_perfiles where codigo='$cod' and id_p='$id' ");
        $f = mysqli_fetch_array($result);
        if($f[0]){
            echo $f[0];
        }else{
            echo 'N/A';
        }
           
        
        break;
        case 37.1:
         $cod  = $_GET['codigo'];
        $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Rieles' ");
        echo '<ul>';
        while($f = mysqli_fetch_array($result)){
            $des = "'".$f[3]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionar('.$f[0].','.$des.')">  '.$f[3].'</li>';
            }
         $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionar(0,'.$des.')">N/A</li>';
        break;
        case 38:
         $cod  = $_GET['codigo'];
        $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Alfajia' order by desc_referencia asc ");
       echo '<ul>';
        while($f = mysqli_fetch_array($result)){
             $des = "'".$f[3]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionara('.$f[0].','.$des.')">  '.$f[3].'</li>';
            }
            $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionara(0,'.$des.')">N/A</li>';
        
        break;
        case 39:
            $cod = $_GET['codigo'];
       
            $result2 = mysqli_query($con,"select sistemas from producto where codigo='$cod'");
            $r = mysqli_fetch_array($result2);
            $sistema = $r[0];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
            $result = mysqli_query($con, "SELECT * FROM receta_kits a, receta_kits_sistemas b where a.idkit=b.idkit and b.sistema in ($sistema) and a.modulo='Cierres' ");
            $c = 0;
           echo '<ul>';
        while($f = mysqli_fetch_array($result)){
             $des = "'".$f[1]."'";
                echo '<li><input type="text" id="cnt'.$f[0].'" style="width:40px"> x <input type="checkbox" id="riel'.$f[0].'" name="el" onclick="seleccionarc('.$f[0].','.$des.')">  '.$f[1].' </li>';
            }
            $des = "'N/A'";
           echo '<li><input type="checkbox" id="riel0" name="el" onclick="seleccionarc(0,'.$des.')">N/A</li>';

            
        break;
        case 39.1:
            $cod = $_GET['cod'];
        $id = $_GET['id'];
            $result2 = mysqli_query($con,"select sistemas from producto where codigo='$cod'");
            $r = mysqli_fetch_array($result2);
            $sistema = $r[0];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
            
            $result = mysqli_query($con, "SELECT * FROM receta_kits a, receta_kits_sistemas b where a.idkit=b.idkit and b.sistema in ($sistema) and a.idkit in ($id) ");
            $c = 0;
        $no = '';
        while($f = mysqli_fetch_array($result)){
            $no =  $no.', '.$f[1];
        }
    echo $no;
            if($no){
            echo $f[0];
        }else{
            echo 'N/A';
        }
        break;
         case 40:
            $cod = $_GET['codigo'];
            $result2 = mysqli_query($con,"select sistemas from producto where codigo='$cod'");
            $r = mysqli_fetch_array($result2);
            $sistema = $r[0];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
          
            $result = mysqli_query($con, "SELECT * FROM receta_kits a, receta_kits_sistemas b where a.idkit=b.idkit and b.sistema in ($sistema) and a.modulo='Rodajas' ");
            $c = 0;
            echo '<ul>';
            while($f = mysqli_fetch_array($result)){
                $des = "'".$f[1]."'";
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionarro('.$f[0].','.$des.')">'.$f['sistema'].' - '.$f[1].'</li>';
           }
           $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionarro(0,'.$des.')">N/A</li>';
        

            
        break;
        case 40.11:
            $cod = $_GET['cod'];
            $id = $_GET['id'];
            $result2 = mysqli_query($con,"select sistemas from producto where codigo='$cod'");
            $r = mysqli_fetch_array($result2);
            $sistema = $r[0];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
            $result = mysqli_query($con, "SELECT * FROM receta_kits a, receta_kits_sistemas b where a.idkit=b.idkit and b.sistema in ($sistema) and a.idkit='$id' ");
            $c = 0;
            $f = mysqli_fetch_array($result);
            if($f[1]){
            echo $f[1];
        }else{
            echo 'N/A';
        }
 
        break;
                 case 40.1:
            $cod = $_GET['codigo'];
            $result2 = mysqli_query($con,"select sistemas from producto where codigo='$cod'");
            $r = mysqli_fetch_array($result2);
            $sistema = $r[0];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
          
            $result = mysqli_query($con, "SELECT * FROM receta_kits a, receta_kits_sistemas b where a.idkit=b.idkit and b.sistema in ($sistema) and a.modulo='Brazos' ");
            $c = 0;
              echo '<ul>';
            while($f = mysqli_fetch_array($result)){
                $des = "'".$f[1]."'";
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionarbr('.$f[0].','.$des.')"> '.$f['sistema'].' - '.$f[1].'</li>';
           }
           $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionarbr(0,'.$des.')">N/A</li>';
        

            
        break;
      
                 case 40.2:
            $cod = $_GET['codigo'];
            $result2 = mysqli_query($con,"select sistemas from producto where codigo='$cod'");
            $r = mysqli_fetch_array($result2);
            $sistema = $r[0];
            $p = explode(",", $sistema);
            $sistema = "'".$p[0]."','".$p[1]."','".$p[2]."','".$p[3]."','".$p[4]."'";
          
            $result = mysqli_query($con, "SELECT * FROM receta_kits a, receta_kits_sistemas b where a.idkit=b.idkit and b.sistema in ($sistema) and a.modulo='Bisagras' ");
            $c = 0;
               echo '<ul>';
            while($f = mysqli_fetch_array($result)){
                $des = "'".$f[1]."'";
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionarbi('.$f[0].','.$des.')"> '.$f['sistema'].' - '.$f[1].'</li>';
           }
           $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionarbi(0,'.$des.')">N/A</li>';

            
        break;
        case 41:
            $cod = $_GET['codigo'];
     
            $result = mysqli_query($con, "select * from producto_rejillas where codigo='$cod' ");
            echo '<ul>';
        while($f = mysqli_fetch_array($result)){
             $des = "'".$f[3]."'";
                //echo '<option value="'.$f[0].'">'.$f[3].'</option>';
                echo '<li><input type="radio" id="riel'.$f[0].'" name="el" onclick="seleccionarr('.$f[0].','.$des.')">  '.$f[3].'</li>';
            }
           $des = "'N/A'";
           echo '<li><input type="radio" id="riel" name="el" onclick="seleccionarr(0,'.$des.')">N/A</li>';
        break;
        case 41.1:
            $cod = $_GET['cod'];
            $id = $_GET['id'];
            $result = mysqli_query($con, "select * from producto_rejillas where codigo='$cod' and id_pr='$id' ");

        $f = mysqli_fetch_array($result);

        if($f[3]){
            echo $f[3];
        }else{
            echo 'N/A';
        }
    
        break;
    case 42:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $riel = $_GET['riel'];
            $alfa = $_GET['alfa'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
            $cant  =  $_GET['cant'];  
            $desp  =  $_GET['desp'];
            $desptotal = (100-$desp)/100;
            $color = $_GET['color'];
            
            $hor = $_GET['hor'];
            $ver = $_GET['ver'];
            
            $resultd = mysqli_query($con, "SELECT b.descuento FROM producto_perfiles a, grupos_referencia b where a.codigo='$cod' and a.id_p='$riel' and a.referencia=b.referencia ");
            $d = mysqli_fetch_array($resultd);
            $des_riel = $d[0];
            
            $resultda = mysqli_query($con, "SELECT b.descuento FROM producto_perfiles a, grupos_referencia b where a.codigo='$cod' and a.id_p='$alfa' and a.referencia=b.referencia ");
            $da = mysqli_fetch_array($resultda);
            $des_alfa = $da[0];

            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and modulo='Principal' order by lado_ref ");
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
                $division = $f[20];
                include '../productos_dos/formula_perfil.php';
                
                $result2 = mysqli_query($con, "select costo_aluminio,perimetro from productos where pro_referencia = '".$f[2]."' ");
                $p = mysqli_fetch_array($result2);
                $precio = $p[0];
                $perimetro = $p["perimetro"]/1000;
                if($hor==0){
                    $hori = 1;
                }else{
                    $hori = $hor;
                }
                if($ver==0){
                    $vert = 1;
                }else{
                    $vert = $ver;
                }
                if($lado=='Alto'){
                    $deto = $des_riel;
                    $detoa = $des_alfa;
                    $canfac = $vert;
                }else{
                    $deto = 0;
                    $detoa = 0;
                    $canfac = $hori;
                }
                if($division=='Si'){
                    $cantidad = $cantidad*$canfac;
                }else{
                    $cantidad = $cantidad;
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
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td title="Valor Unidad: $'.$pre_und.' ">'.$f[3].' '.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio).'</td>'
                        . '<td style="text-align:right" title="'.$medida.'-'.$deto.'-'.$detoa.'">'.number_format($medida).' mm</td>'
                        . '<td style="text-align:right">'.$cantidad.' Und</td>'
                        . '<td style="text-align:right">'.number_format($medtotal).'mm</td>'
                        . '<td style="text-align:right" title="Color: '.$color.', Perimetro: '.$perimetro.', Valor: $'.$vc.' , Rendimiento:'.$rendimiento.'">$'.number_format($valor_acabado,2).'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio_total).'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio_total_acabado).'</td>'
                        . '<td style="text-align:right">'.number_format($desp).'%</td>'
                        . '<td style="text-align:right">$ '.number_format($totadesp).'</td>';
                
            }
            echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Perfiles Fijos</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_perfil_costo1" value="'.$total_perfil_costo.'" style="width:100%">$ '.number_format($total_perfil_costo).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_perfil1_desp1" value="'.$total_perfil_desp.'" style="width:100%">$ '.number_format($total_perfil_desp).'</td>';

        break;
        case 42.1:
            $cod = $_GET['cod'];
            $idper = $_GET['idper'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
              $cant  =  $_GET['cant'];  
            $desp  =  $_GET['desp'];
            $desptotal = (100-$desp)/100;
            $color = $_GET['color'];
                    
 
            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and id_p='$idper' and modulo='Rieles' order by lado_ref ");
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
                $cantidad_pint = $f[11]*$cant;
                $cadah = $f[15];
                $cadav = $f[14];
                include '../productos_dos/formula_perfil.php';
                
                 $result2 = mysqli_query($con, "select costo_aluminio,perimetro from productos where pro_referencia = '".$f[2]."' ");
                $p = mysqli_fetch_array($result2);
                $precio = $p[0];
                 $perimetro = $p["area"]/1000;
                
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                $precio_total = $precio * ($medtotal/1000);
                
                
                 include 'costopintura.php';
                 $precio_total_acabado = $precio_total + $valor_acabado;
                 $totadesp = $precio_total_acabado/$desptotal;
                 $total_perfil_costo += $precio_total;
                 $total_perfil_desp += $totadesp;
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td>'.$f[3].' '.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio).'</td>'
                        . '<td style="text-align:right">'.number_format($medida).' mm</td>'
                        . '<td style="text-align:right">'.$cantidad.' Und</td>'
                        . '<td style="text-align:right">'.number_format($medtotal).'mm</td>'
                        . '<td style="text-align:right" title="Perimetro: '.$perimetro.', Valor: $'.$vc.' ">$'.number_format($valor_acabado,2).'</td>'
                        
                        . '<td style="text-align:right">$ '.number_format($precio_total).'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio_total_acabado).'</td>'
                        . '<td style="text-align:right">'.number_format($desp).'%</td>'
                        . '<td style="text-align:right">$ '.number_format($totadesp).'</td>';
                
            }
        echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Perfiles Rieles</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_perfil_costo2" value="'.$total_perfil_costo.'" style="width:100%">$ '.number_format($total_perfil_costo).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_perfil1_desp2" value="'.$total_perfil_desp.'" style="width:100%">$ '.number_format($total_perfil_desp).'</td>';
        break;
        case 42.2:
            $cod = $_GET['cod'];
            $idper = $_GET['idper'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi - $rej;
            $altomrej =  $alto - $rej;
              $cant  =  $_GET['cant'];  
            $desp  =  $_GET['desp'];
            $desptotal = (100-$desp)/100;
            $color = $_GET['color'];
                    
 
            $result = mysqli_query($con, "select * from producto_perfiles where codigo='$cod' and id_p='$idper' and modulo='Alfajia' order by lado_ref ");
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
                 $perimetro = $p["area"]/1000;
                
                $medtotal = $medida*$cantidad;
                $perfiles = $medtotal / 6000;
                $precio_total = $precio * ($medtotal/1000);
                
                
                 include 'costopintura.php';
                 $precio_total_acabado = $precio_total + $valor_acabado;
                 $totadesp = $precio_total_acabado/$desptotal;
                 $total_perfil_costo += $precio_total;
                 $total_perfil_desp += $totadesp;
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td>'.$f[3].' '.$f[16].'</td>'
                        . '<td>'.$lado.'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio).'</td>'
                        . '<td style="text-align:right">'.number_format($medida).' mm</td>'
                        . '<td style="text-align:right">'.$cantidad.' Und</td>'
                        . '<td style="text-align:right">'.number_format($medtotal).'mm</td>'
                        . '<td style="text-align:right" title="Perimetro: '.$perimetro.', Valor: $'.$vc.' , Color: '.$color.'">$'.number_format($valor_acabado,2).'</td>'
                        
                        . '<td style="text-align:right">$ '.number_format($precio_total).'</td>'
                        . '<td style="text-align:right">$ '.number_format($precio_total_acabado).'</td>'
                        . '<td style="text-align:right">'.number_format($desp).'%</td>'
                        . '<td style="text-align:right">$ '.number_format($totadesp).'</td>';
                
            }
            echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Perfiles Alfajia</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_perfil_costo3" value="'.$total_perfil_costo.'" style="width:100%">$ '.number_format($total_perfil_costo).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_perfil1_desp3" value="'.$total_perfil_desp.'" style="width:100%">$ '.number_format($total_perfil_desp).'</td>';
        
        break;
    case 43:
        $lam = $_GET['lam'];
        $cod = $_GET['cod'];
        $des = $_GET['des'];
        if(isset($_GET['codv'])){
            $codv = $_GET['codv'];
        }else{
            $codv = '';
        }
        if(isset($_GET['desv'])){
            $desv = $_GET['desv'];
        }else{
            $desv = '';
        }
        $ancho = $_GET['ancho'];
        $alto = $_GET['alto'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $can = $_GET['cant'];
        $inter = $_GET['inter'];
        $espa = $_GET['espa'];
        $desp = $_GET['desp'];
        $despalu = $_GET['despalu'];
        $despacc = $_GET['despacc'];
        $inst = $_GET['inst'];
        $cierres = $_GET['cierres'];
        $rodajas = $_GET['rodajas'];
        $brazos = $_GET['brazos'];
        $bisagras = $_GET['bisagras'];
        $canbis = $_GET['canbis'];
        $cancie = $_GET['cancie'];
        $canrod = $_GET['canrod'];
        $canbra = $_GET['canbra'];

        $mt2 = ($ancho/1000) * ($alto/1000) * $can;
        $mt = ((($ancho/1000) * ($alto/1000)) * 2) * $can;
        $desperdicioacc = (100 - $despacc)/100;
         $codi = $_GET['cod'];
            $result4 = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$cod' and a.insumo='Principal' ");
            $totalacc = 0;
            $total_insumo_costo1 =0;
                $total_insumo_desp1 =0;
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
                 $totacc = $total * $r['costo_promedio'];
                 $input = 'text';
                
                $totacc = $totacc; //  / $porcentaje
                $totalacc += $totacc;
                $totaldesp = $totacc / $desperdicioacc;
                $total_insumo_costo1 +=$totacc;
                $total_insumo_desp1 +=$totaldesp;
                echo '<tr style="hide">'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.'</td>'
                . '<td>'.$r['para'].'</td>'
                . '<td title="costo promedio: '. $r['costo_promedio'].'"><input type="'.$input.'" id="acc_und" value="'.number_format($r['costo_promedio'],2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td><input type="'.$input.'" id="acc_tot" value="'.number_format($totacc,2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td>'.$despacc.'%</td><td style="text-align: right">$'.number_format($totaldesp).'</td>';
            }
            echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Insumos Fijos</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_insumo_costo1" value="'.$total_insumo_costo1.'" style="width:100%">$ '.number_format($total_insumo_costo1).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_insumo_desp1" value="'.$total_insumo_desp1.'" style="width:100%">$ '.number_format($total_insumo_desp1).'</td>';
            
            echo '<tr><td  style="text-align:center;background: #438EB9" colspan="12">Rodajas '.$canrod.'</td></tr>';
            

            $result5 = mysqli_query($con, "SELECT * FROM receta_kits_items a, productos_var b where a.codigo_pro=b.codigo and a.idkit='$rodajas' ");
            $totalacc2 = 0;
            $total_insumo_costo2 = 0;
            $total_insumo_desp2 = 0;
            while($r = mysqli_fetch_array($result5)){
               
                $total = $r['cantidad']*$can*$canrod;
                $totacc = $total * $r['costo_promedio'];
                $input = 'text';
                $porcentaje = (100 - $despacc)/100;
                $totalacc2 += $totacc;
                $totaldesp = $totacc / $desperdicioacc;
                $total_insumo_costo2 +=$totacc;
                $total_insumo_desp2 +=$totaldesp;
                echo '<tr style="hide">'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td> - </td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.'</td>'
                . '<td> - </td>'
                . '<td title="costo promedio: '. $r['costo_promedio'].'"><input type="'.$input.'" id="acc_und" value="'.number_format($r['costo_promedio'],2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td><input type="'.$input.'" id="acc_tot" value="'.number_format($totacc,2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td>'.$despacc.'%</td><td style="text-align: right">$'.number_format($totaldesp).'</td>';
            }
             echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Rodajas</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_insumo_costo2" value="'.$total_insumo_costo2.'" style="width:100%">$ '.number_format($total_insumo_costo2).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_insumo_desp2" value="'.$total_insumo_desp2.'" style="width:100%">$ '.number_format($total_insumo_desp2).'</td>';
             
            
            echo '<tr><td  style="text-align:center;background: #438EB9" colspan="12">Cierres '.$cancie.'</td></tr>';
            $result6 = mysqli_query($con, "SELECT * FROM receta_kits_items a, productos_var b where a.codigo_pro=b.codigo and a.idkit in ($cierres)  ");
            $totalacc6 = 0;
            $total_insumo_costo3 += 0;
            $total_insumo_desp3 += 0;
            $k  = 0;
            $c = 0;
            $mk = 0;
$p = explode(",",$cancie);
            while($r = mysqli_fetch_array($result6)){
                $isd = $r['idkit'];
                if($c==0){
                    $re = mysqli_query($con,"select descripcion from receta_kits where idkit='$isd' ");
                    $ki = mysqli_fetch_array($re);
                    echo '<tr><td colspan="12">'.  ($p[$mk]).'-'.$ki[0].'</td>';
                    $ckit = $p[$mk];
                    $mk++;
                }else{
                    if($k!==$isd){
                        
                        $re = mysqli_query($con,"select descripcion from receta_kits where idkit='$isd' ");
                    $ki = mysqli_fetch_array($re);
                    echo '<tr><td colspan="12">'.  ($p[$mk]).'-'.$ki[0].'</td>';
                    $ckit = $p[$mk];
                        $mk++;
                    }
                }
                $c++;
                $k  = $isd;
                $total = $r['cantidad']*$can*$ckit;
                $totacc = $total * $r['costo_promedio'];
                $input = 'text';
                $porcentaje = (100 - $despacc)/100;
                $totacc = $totacc; //  / $porcentaje
                $totalacc6 += $totacc;
                $totaldesp = $totacc / $desperdicioacc;
                $total_insumo_costo3 +=$totacc;
                $total_insumo_desp3 +=$totaldesp;
                echo '<tr style="hide">'
                . '<td>'.$r['codigo_pro'].'-'.$isd.'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>-</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.($r['cantidad']*$ckit).'</td>'
                . '<td>und</td>'
                . '<td>'.$total.'</td>'
                . '<td>-</td>'
                . '<td title="costo promedio: '. $r['costo_promedio'].'"><input type="'.$input.'" id="acc_und" value="'.number_format($r['costo_promedio'],2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td><input type="'.$input.'" id="acc_tot" value="'.number_format($totacc,2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td>'.$despacc.'%</td><td style="text-align: right">$'.number_format($totaldesp).'</td>';
            }
             echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Cierres</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_insumo_costo3" value="'.$total_insumo_costo3.'" style="width:100%">$ '.number_format($total_insumo_costo3).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_insumo_desp3" value="'.$total_insumo_desp3.'" style="width:100%">$ '.number_format($total_insumo_desp3).'</td>';
        
             echo '<tr><td  style="text-align:center;background: #438EB9" colspan="12">Brazos '.$brazos.'</td></tr>';
            $result7 = mysqli_query($con, "SELECT * FROM receta_kits_items a, productos_var b where a.codigo_pro=b.codigo and a.idkit='$brazos'  ");
            $totalacc7 = 0;
            $total_insumo_costo4 += 0;
            $total_insumo_desp4 += 0;
            while($r = mysqli_fetch_array($result7)){
               $isd = $r['idkit'];
                if($c==0){
                    $re = mysqli_query($con,"select descripcion from receta_kits where idkit='$isd' ");
                    $ki = mysqli_fetch_array($re);
                    echo '<tr><td colspan="12">'.$ki[0].'</td>';
                    $ckit = $p[$mk];
                    $mk++;
                }else{
                    if($k!==$isd){
                        
                        $re = mysqli_query($con,"select descripcion from receta_kits where idkit='$isd' ");
                    $ki = mysqli_fetch_array($re);
                    echo '<tr><td colspan="12">'.$ki[0].'</td>';
                    $ckit = $p[$mk];
                        $mk++;
                    }
                }
                $total = $r['cantidad']*$can*$canbra;
                $totacc = $total * $r['costo_promedio'];
                $input = 'text';
                $porcentaje = (100 - $despacc)/100;
                $totacc = $totacc; //  / $porcentaje
                $totalacc7 += $totacc;
                $totaldesp = $totacc / $desperdicioacc;
                $total_insumo_costo4 +=$totacc;
                $total_insumo_desp4 +=$totaldesp;
                echo '<tr style="hide">'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>-</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>und</td>'
                . '<td>'.$total.'</td>'
                . '<td>-</td>'
                . '<td title="costo promedio: '. $r['costo_promedio'].'"><input type="'.$input.'" id="acc_und" value="'.number_format($r['costo_promedio'],2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td><input type="'.$input.'" id="acc_tot" value="'.number_format($totacc,2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td>'.$despacc.'%</td><td style="text-align: right">$'.number_format($totaldesp).'</td>';
            }
             echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Brazos</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_insumo_costo4" value="'.$total_insumo_costo4.'" style="width:100%">$ '.number_format($total_insumo_costo4).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_insumo_desp4" value="'.$total_insumo_desp4.'" style="width:100%">$ '.number_format($total_insumo_desp4).'</td>';
        
               echo '<tr><td  style="text-align:center;background: #438EB9" colspan="12">Bisagras '.$bisagras.'</td></tr>';
            $result8 = mysqli_query($con, "SELECT * FROM receta_kits_items a, productos_var b where a.codigo_pro=b.codigo and a.idkit='$bisagras'  ");
            $totalacc8 = 0;
            $total_insumo_costo5 += 0;
            $total_insumo_desp5 += 0;
            while($r = mysqli_fetch_array($result8)){
               $isd = $r['idkit'];
                if($c==0){
                    $re = mysqli_query($con,"select descripcion from receta_kits where idkit='$isd' ");
                    $ki = mysqli_fetch_array($re);
                    echo '<tr><td colspan="12">'.$ki[0].'</td>';
                    $ckit = $p[$mk];
                    $mk++;
                }else{
                    if($k!==$isd){
                        
                        $re = mysqli_query($con,"select descripcion from receta_kits where idkit='$isd' ");
                    $ki = mysqli_fetch_array($re);
                    echo '<tr><td colspan="12">'.$ki[0].'</td>';
                    $ckit = $p[$mk];
                        $mk++;
                    }
                }
                $total = $r['cantidad']*$can*$canbis;
                $totacc = $total * $r['costo_promedio'];
                $input = 'text';
                $porcentaje = (100 - $despacc)/100;
                $totacc = $totacc; //  / $porcentaje
                $totalacc8 += $totacc;
                $totaldesp = $totacc / $desperdicioacc;
                $total_insumo_costo5 +=$totacc;
                $total_insumo_desp5 +=$totaldesp;
                echo '<tr style="hide">'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>-</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad']*$canbis.'</td>'
                . '<td>und</td>'
                . '<td>'.$total.'</td>'
                . '<td>-</td>'
                . '<td title="costo promedio: '. $r['costo_promedio'].'"><input type="'.$input.'" id="acc_und" value="'.number_format($r['costo_promedio'],2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td><input type="'.$input.'" id="acc_tot" value="'.number_format($totacc,2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td>'.$despacc.'%</td><td style="text-align: right">$'.number_format($totaldesp).'</td>';
            }
             echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Bisagras</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_insumo_costo5" value="'.$total_insumo_costo5.'" style="width:100%">$ '.number_format($total_insumo_costo5).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_insumo_desp5" value="'.$total_insumo_desp5.'" style="width:100%">$ '.number_format($total_insumo_desp5).'</td>';
        
        break;
        case 44:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $rej  =  $_GET['rej'];
            $ancfd  =  $_GET['ancfd'];
            $ancfi  =  $_GET['ancfi'];
            $alcfs  =  $_GET['alcfs'];
            $alcfi  =  $_GET['alcfi'];
            $anchovc = $ancho - $ancfd -$ancfi;
            $altovc =  $alto - $alcfs- $alcfi-$rej;
            $altorej  =  $_GET['altorej']; 
            $cant  =  $_GET['cant'];  
            $desp  =  $_GET['desp'];
            $desptotal = (100-$desp)/100;
            $color = $_GET['color'];
 
            $result = mysqli_query($con, "select * from producto_rejillas where id_pr='$cod' ");
            $total_perfil_costo = 0;
            $total_perfil_desp = 0;
            while($f = mysqli_fetch_array($result)){
                $rejilla = $f[2];
                $vref1 = $f[4];
                $vope1 = $f[5];
                $vvar1 = $altorej;//toma la medida de la formula de la altura de la rejilla.
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
                echo '<tr>'
                . '<td>'.$f[2].'</td>'
                        . '<td title="'.$formula1.' | '.$formula2.'">'.$f[3].'</td>'
                        . '<td>'.$ancho.'</td>'
                        . '<td>$ '.number_format($precio).'</td>'
                        . '<td>'.number_format($resultadov).' Und</td>'
                        . '<td style="text-align:right">'.$resultadov2.'mm</td>'
                         . '<td style="text-align:right">'.number_format($total_med).'</td>'
                        . '<td style="text-align:right" title="Valor acabado '.$vc.', perimetro: '.$perimetro.', $medida = '.$medida.' ">'.number_format($valor_acabado,2).'</td>'
                       
                        . '<td style="text-align:right">'.number_format($total1,2).'</td>'
                        . '<td style="text-align:right">$'.number_format($precio_total_acabado).'</td>'
                        . '<td style="text-align:right">'.$desp.'%</td>'
                        . '<td style="text-align:right">$'.number_format($totaldesp).'</td>';
                
            }
            echo '<tr>'
            . '<td colspan="9" style="text-align:right">Totales Perfiles Rejillas</td>'
            . '<td  style="text-align:right"><input type="hidden" id="total_perfil_costo4" value="'.$total_perfil_costo.'" style="width:100%">$ '.number_format($total_perfil_costo).'</td>'
            . '<td></td>'
            . '<td style="text-align:right"><input type="hidden" id="total_perfil1_desp4" value="'.$total_perfil_desp.'" style="width:100%">$ '.number_format($total_perfil_desp).'</td>';
            
            
            break;
    case 45:
            $cod = $_GET['cod'];
            $ancho = $_GET['ancho'];
            $alto  =  $_GET['alto'];
            $can = $_GET['cant'];
            
            $mt2 = ($ancho/1000) * ($alto/1000);
            $mt = ((($ancho/1000) * ($alto/1000)) * 2);//por si acaso
        
            $anchocfd  =  $_GET['anchocfd'];
            $altocfs  =  $_GET['altocfs'];
            $anchocfi  =  $_GET['anchocfi'];
            $altocfi  =  $_GET['altocfi'];
            
                if($anchocfd!=0){
                        $mt2_cf = ($alto/1000) * ($anchocfd/1000);
                }
                if($anchocfi!=0){
                        $mt2_cf = ($alto/1000) * ($anchocfi/1000);
                }
                if($altocfs!=0){
                        $mt2_cf = ($ancho/1000) * ($altocfs/1000);
                }
                if($altocfi!=0){
                        $mt2_cf = ($ancho/1000) * ($altocfi/1000);
                }
            
            
            
            $result = mysqli_query($con,"select * from  precios_instalaciones a, producto_instalacion b where a.id_precios=b.id_instalacion and b.codigo= '".$cod."' ");
            $total_instalacion=0;
            $total_instalacion_desp=0;
            $total_fabricacion=0;
            $total_fabricacion_desp=0;
            $total_mano = 0;
            while ($r = mysqli_fetch_array($result)){
                
                
                $calculo = $r['calculo'];
                if($r['rango']=='Principal'){
                    $mt2 = $mt2;
                }else{
                    $mt2 = $mt2_cf;
                }
                
                if($r['calculo']=='und'){
                    $cobro = $r['total_1']*$can;
                }elseif($r['calculo']=='m2'){
                    $cobro = $r['total_1'] * $mt2 * $can;
                }elseif($r['calculo']=='mt'){
                    $cobro = $r['total_1'] * $mt * $can;
                }else{
                    $cobro = $r['total_1']*$can;
                }
                
                
               // $cobro = $r['total_1']*$can;
                
            $totaldesp = $cobro / ((100-$r['parafiscales'])/100);
            if($r['sistema_insta']=='Instalacion'){
                $total_instalacion +=$cobro;
                $total_instalacion_desp +=$totaldesp;
            }else{
                $total_fabricacion +=$cobro;
                $total_fabricacion_desp +=$totaldesp;
            }
                $total_mano +=$totaldesp;
                echo '<tr>'
                        . '<td>'.$r['id_pi'].'</td>'
                        . '<td>'.$r['nom_insta'].'</td>'
                        . '<td>'.$r['sistema_insta'].'</td>'
                        . '<td>'.$r['calculo'].'</td>'
                        . '<td>'.$r['rango'].'</td>'
                        . '<td style="text-align:right">$'.number_format($r['total_1']).'</td>'
                        . '<td style="text-align:right">$'.number_format($cobro).'</td>'
                        . '<td style="text-align:right">'.$r['parafiscales'].'%</td>'
                        . '<td style="text-align:right">$'.number_format($totaldesp).'</td>'
                . '</tr>';
            }
          echo '<tr>'
            . '<td colspan="5" style="text-align:right">Totales de Instalacion</td>'
            . '<td style="text-align:right"><input type="hidden" id="total_instalacion" value="'.$total_instalacion_desp.'" style="width:100%">'
                  . '<input type="text" id="total_fabricacion" value="'.$total_fabricacion.'" style="width:100%"></td>'
                  . '<td></td><td></td>'
                  . '<td style="text-align:right"><input type="hidden" id="total_instalacion_desp" value="'.$total_instalacion_desp.'" style="width:100%">$ '.number_format($total_mano).'</td>'
                  . '<input type="hidden" id="total_fabricacion_desp" value="'.$total_fabricacion_desp.'" style="width:100%">';
        
        
        
        break;
    case 46:
        $item = $_GET['item'];
            $gt = $_GET['gt'];
        mysqli_query($con,"update cotizacion_item set valor_item='$gt' where id_cot_item='$item' ");
        break;
         case 47:
        $cot = $_GET['item'];
        mysqli_query($con,"update cotizacion_item set ruta='' where id_cot_item='$cot'  ");

        break;
    case 48:
        $cod = $_GET['cod'];
        $n = $_GET['n'];
        $result = mysqli_query($con, "select laminas from producto where codigo='$cod' ");
        $r = mysqli_fetch_array($result);

        $lam = $r[0];
        if($lam>1){
            echo $btn = '<button onclick="lam_ventanas('.$n.')">Laminado'.substr($n,0,-2).'</button>';
        }else{
            echo $btn = 'Modulo#'.substr($n,0,-2).'';
        }
        break;
        
        case 49:
        $cot = $_GET['cot'];
        $query = mysqli_query($con,"select * from cotizaciones_servicios  where id_cot_mas = '$cot' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;

           $btn = '<button onclick="ver_servicios('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
           
           
            
            $tu = $f['precio_total']/$f['cantidad_serv'];
            $tom = $f['precio_total'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nt += $tom;
            $tt += $gt;
            if($f['id_cot_mas']=='0'){
                $ico = '';
            } else{
                $ico = '<i class="icon fa-windows"></i>';
            }
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$f['id_servicio'].' '.$ico.'</td>'
                    . '<td>'.$f['descripcion_ser'].'</td>'
                    . '<td>'.$f['cod_ser'].'</td>'
                    . '<td>'.$f['precio_serv'].'</td>'
                    . '<td>'.$f['cantidad_serv'].'</td>'
                    . '<td style="text-align:right">$ '.number_format($f['precio_und'],2).'</td>'
                    . '<td style="text-align:right">$ '.number_format($f['precio_total'],2).'</td>'
                    . '<td><button id="btn_del_ven" onclick="del_servicios('.$f[0].')" class="btn btn-danger"> <i class="ace-icon fa fa-trash-o"></i> </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">$ '.number_format($nt,2).'</td>'
//                    . '<td style="text-align:right"></td>'
//                    . '<td style="text-align:right">'.number_format($tt,2).'</td>'
                    . '<td></td>';
        break;
        
         case 50:
        $cot = $_GET['cot'];
        $query = mysqli_query($con,"select * from cotizaciones_materiales  where id_cot_item = '$cot' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;
            $codigo = $f['codigo_material'];
            if($f['linea']=='Accesorios'){
                 $pro = mysqli_query($con,"select descripcion from productos_var where codigo='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
                 $btn = '<button onclick="ver_ventas('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
            }else{
                 $pro = mysqli_query($con,"select pro_nombre from productos where pro_referencia='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
                 $btn = '<button onclick="ver_perfil('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
            }
           
            
            $tu = $f['valor_pagar']/$f['cantidad_mat'];
            $tom = $f['valor_pagar'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nt += $tom;
            $tt += $gt;
            echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$codigo.'</td>'
                    . '<td>'.$descr.'</td>'
                    . '<td>'.$f['mat_color'].'</td>'
                    . '<td>'.$f['med'].'</td>'
                    . '<td>'.$f['cantidad_mat'].'</td>'
                    . '<td style="text-align:right">$ '.number_format($tu,2).'</td>'
                    . '<td style="text-align:right">$ '.number_format($tom,2).'</td>'
//                    . '<td style="text-align:right">'.number_format($iva,2).'</td>'
//                    . '<td style="text-align:right">'.number_format($gt,2).'</td>'
                    . '<td><button id="btn_del_ven" onclick="del_ventas('.$f[0].')" class="btn btn-danger"> <i class="ace-icon fa fa-trash-o"></i> </button></td>';
        }
        echo '<tr>'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">$ '.number_format($nt,2).'</td>'
//                    . '<td style="text-align:right"></td>'
//                    . '<td style="text-align:right">'.number_format($tt,2).'</td>'
                    . '<td></td>';
        break;
    
}
