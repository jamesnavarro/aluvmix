<?php
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
$fecha = date("Y-m-d H:i:s");
switch ($_GET['sw']){
    case 1:
         $request2=mysqli_query($con,'select * from cotizacion a, cont_terceros b WHERE a.id_tercero=b.id_ter and a.id_cot="'.$_GET["cot"].'"');
        $row2=mysqli_fetch_array($request2);
        $p = array();
        $p[0] = $row2["id_ter"];
        $p[1] = $row2["cod_ter"];
        $p[2] = $row2["dir_ter"];
        $p[3] = $row2["telfijo_ter"];
        $p[4] = $row2["telmovil_ter"];
        $p[5] = $row2["correo_ter"];
        $p[6] = $row2["cont_ter"];
        $p[7] = $row2["nom_ter"];
        $p[8] = $row2["ciudad_ter"];
        $p[9] = $row2["municipio_ter"];
        $p[10] = $row2["vendedor"];
        $p[11] = $row2["pvi"];
        $p[12] = $row2["ubicacion"];
        $p[13] = $row2["obra"];
        $p[14] = substr($row2["fecha_reg_c"],0,-9);
        $p[15] = $row2["registrado"];
        $p[16] = $row2["estado"];
        $p[17] = $row2["linea"];
        $p[18] = $row2["tel_responsable"];
        $p[19] = $row2["ciudad"];
        $p[20] = $row2["municipio"];
        $p[21] = $row2["numero_cotizacion"];
        $p[22] = $row2["version"];
        $p[23] = $row2["validez"];
        $p[24] = $row2["express"];
        $p[25] = $row2["fecha_de_entrega"];
        $p[26] = $row2["nota"];
        $p[27] = $row2["presupuesto"];
        $p[28] = $row2["registrado"];
        $p[29] = $row2["desp_vid"];
        $p[30] = $row2["desp_alu"];
        $p[31] = $row2["desp_acc"];
        $p[32] = $row2["desp_ace"];
        $p[33] = $row2["desp_esp"];
        $p[34] = $row2["desp_int"];
        $p[35] = $row2["utilidad"];
        $p[36] = $row2["sel_iva"];
        $p[37] = $row2["orden"];
        $p[38] = $row2["fecha_pedido"];
        $p[39] = $row2["usuario_pedido"];
        
        $request=mysqli_query($con,'select fecha_registro,estado_o,generado_user,opf from orden_produccion WHERE id_orden="'.$_GET["orden"].'"');
        $row=mysqli_fetch_array($request);
        $p[40] = $row["fecha_registro"];
        $p[41] = $row["estado_o"];
        $p[42] = $row["generado_user"];
        $p[43] = $row["opf"];
                
        echo json_encode($p);
        exit();
        
        break;
    case 2:
        $cot = $_GET['cot'];
        $est = $_GET['est'];
        $result = mysqli_query($con,"SELECT * FROM cotizacion_item d where id_cot=".$cot." and estado='Guardado' and id_cot_principal=0 and compuesto=0 ");
        $c = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
        while($row = mysqli_fetch_array($result)){
        $c +=1;
        $valor = $row["valor_item"]+$row["total_compuestos"]+$row["total_material"]+$row["total_ins"]+$row["total_mob"];
        $descpor = $valor * ($row["descuento"] / 100);

        $ptt2 = ($valor +  $descpor);
        $pud = $ptt2 / $row["cantidad"];
        $iva = $ptt2 * ($row["iva"]/100);
        
        $pu = ($ptt2 / $row["cantidad"]);
        
        $total = $ptt2 + $iva;
        $gt += $ptt2;
        $gtiva += $total;
        $ct +=$row['cantidad'];
        if($est=='En proceso'){
            $di = '';
        }else{
            $di = 'disabled';
        }
        $resultv = mysqli_query($con,"SELECT descripcion_principal,descripcion_segunda FROM cotizacion_item  where estado='Guardado' and id_cot_principal='".$row['id_cot_item']."' and compuesto=0 ");
        $vidrio = '';
        while($v = mysqli_fetch_array($resultv)){
            $vidrio = ' '.$v[0].' ';
        }
        if($row['perforacion']==0){
            $per = '';
        }else{
             $per = ', Per:'.$row['perforacion'];
        }
        if($row['boquete']==0){
            $boq = '';
        }else{
             $boq = ', Boq:'.$row['boquete'];
        }
        $descripcion = $row['descripcion_principal'].$per.$boq.', '.$row['observacion'];
        ?>
        <tr>
            <td><input type="hidden" id="idtem<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['id_cot_item']; ?>" style="width: 60px">
                <?php echo $row['item']; ?></td>
            <td><?php echo $row['codigo']; ?><input type="hidden" id="cod<?php echo $c; ?>" disabled class="input6" value="<?php echo $row['codigo']; ?>" style="width: 60px"></td>
            <td><?php echo $descripcion; ?> <button onclick="info(<?php echo $row['id_cot_item']; ?>,'<?php echo $row['item']; ?>','<?php echo $row['nota']; ?>')">!</button><input type="hidden" id="des<?php echo $c; ?>" style="width: 250px" disabled value="<?php echo $row['descripcion_principal']; ?>" title="<?php echo $row['descripcion_principal']; ?>"></td>
            <td><?php echo $vidrio; ?></td>
            <td><?php echo $row['ancho']; ?><input type="hidden" <?php echo $di; ?>  onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="ancho<?php echo $c; ?>" style="width: 60px" value="<?php echo $row['ancho']; ?>" disabled></td>
            <td><?php echo $row['alto']; ?><input type="hidden" <?php echo $di; ?> onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" id="alto<?php echo $c; ?>" style="width: 60px" value="<?php echo $row['alto']; ?>" disabled></td>
            <input type="hidden" <?php echo $di; ?> id="per<?php echo $c; ?>" style="width: 40px"  value="<?php echo $row['perforacion']; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" disabled></td>
            <input type="hidden" <?php echo $di; ?> id="boq<?php echo $c; ?>" style="width: 40px"  value="<?php echo $row['boquete']; ?>" onchange="calcular_item(<?php echo $c; ?>,<?php echo $row['id_cot_item']; ?>,0)" disabled></td>
            <td style="text-align:right"><?php echo number_format($row['cantidad']); ?></td>
            <td style="text-align:right"><?php echo number_format($row['cantidad']-$row['restante']); ?></td>
            <td style="text-align:right"><?php echo number_format($pud); ?></td> 
            <td style="text-align:right"><?php echo number_format($ptt2); ?></td>
            <td style="text-align:right"><?php echo number_format($total); ?></td>
            <td><?php echo $row['descuento']; ?>%</td>
            <td><?php echo $row['ubicacion']; ?></td>
            <td><?php echo $row['observacion']; ?></td>
            
           <td>&nbsp;<button class="btn btn-success glyphicon glyphicon-download" onclick="pasar_items_orden(<?php echo $row['id_cot_item']; ?>,'<?php echo $row['ubicacion']; ?>','<?php echo $row['observacion']; ?>','<?php echo $row['descripcion_principal']; ?>');" id="editar<?php echo $c; ?>" title="Ver Items"></button>
           
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
         
            <th>Totales:</th>
            <th><?php echo number_format($ct); ?><input type="hidden" id="cantotal"  class="input6" disabled value="<?php echo number_format($ct); ?>" style="width: 40px;text-align: right"></th>
            <th></th>
            <th><?php echo number_format($gt); ?><input type="hidden" id="subgrantotal"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($gt,2,'.',''); ?>"></th>
            <th><?php echo number_format($gtiva); ?><input type="hidden" id="grantotal"  style="width: 80px;text-align: right" disabled value="<?php echo number_format($gtiva,2,'.',''); ?>"></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <?php
        
        break;
       case 3:
        $idcot = $_GET['cot'];
        
        $resultp = mysqli_query($con,"select * from cotizacion_item where id_cot_item='$idcot' and linea_cot!='Vidrio'  ");
        
        while($r = mysqli_fetch_array($resultp)){
            echo '<tr>'
                    . '<td><input type="text" id="item'.$r['id_cot_item'].'" disabled value="'.$r['id_cot_item'].'"  style="width:60px" ></td>'
                    . '<td>'.$r['descripcion_principal'].'
                      <input type="hidden" id="producto'.$r['id_cot_item'].'"  value="'.$r['descripcion_principal'].'"  style="width:60px" >
                      <input type="hidden" id="linea'.$r['id_cot_item'].'"  value="'.$r['linea_cot'].'"  style="width:60px" >
                      <input type="hidden" id="per'.$r['id_cot_item'].'"  value="'.$r['perforacion'].'"  style="width:60px" >'
                    . ' <input type="hidden" id="boq'.$r['id_cot_item'].'"  value="'.$r['boquete'].'"  style="width:60px" > </td>'
                    . '<td ondblclick="disancho('.$r['id_cot_item'].')"><input type="text" id="v_ancho'.$r['id_cot_item'].'" value="'.$r['ancho'].'" style="width:60px"><br>'
                    . '<input type="text" id="v_ancho2'.$r['id_cot_item'].'" disabled value="'.$r['ancho'].'"  style="width:60px" ><font color="red"><b>i</b></font></td>'
                    . '<td ondblclick="disalto('.$r['id_cot_item'].')" ><input type="text" id="v_alto'.$r['id_cot_item'].'" value="'.$r['alto'].'" style="width:60px"><br>'
                    . '<input type="text" id="v_alto2'.$r['id_cot_item'].'" value="'.$r['alto'].'" disabled style="width:60px"><font color="red"><b>i</b></font></td>'
                    . '<td style="text-align:center"><input type="text" disabled id="v_restante'.$r['id_cot_item'].'" value="'.($r['cantidad']-$r['restante']).'" style="width:60px"></td>'
                    . '<td style="text-align:center"><input type="text" id="v_cantidad'.$r['id_cot_item'].'" value="'.($r['cantidad']-$r['restante']).'" style="width:60px" onchange="validarc('.$r['id_cot_item'].')"></td>'
                    . '<td><input type="checkbox" id="'.$r['id_cot_item'].'" checked  name="item"></td>';
        }
        
        $result = mysqli_query($con,"select * from cotizacion_item where id_cot_principal='$idcot' ");
        //50041.3
        while($r = mysqli_fetch_array($result)){

            echo '<tr>'
                    . '<td><input type="text" id="item'.$r['id_cot_item'].'" disabled value="'.$r['id_cot_item'].'"  style="width:60px" ></td>'
                    . '<td>'.$r['descripcion_principal'].'<br> '.$r['descripcion_segunda'].'
                       <input type="hidden" id="producto'.$r['id_cot_item'].'"  value="'.$r['descripcion_principal'].' '.$r['descripcion_segunda'].'"  style="width:60px" >
                       <input type="hidden" id="linea'.$r['id_cot_item'].'"  value="'.$r['linea_cot'].'"  style="width:60px" >'
                    . 'Per: <input type="text" id="per'.$r['id_cot_item'].'"  value="'.$r['perforacion'].'"  style="width:60px" >'
                    . 'Boq: <input type="text" id="boq'.$r['id_cot_item'].'"  value="'.$r['boquete'].'"  style="width:60px" ></td>'
                    . '<td ondblclick="disancho('.$r['id_cot_item'].')"><input type="text" id="v_ancho'.$r['id_cot_item'].'" value="'.$r['ancho'].'"  style="width:60px"><br>'
                    . '<input type="text" id="v_ancho2'.$r['id_cot_item'].'" value="'.$r['ancho'].'"  disabled style="width:60px"><font color="red"><b>i</b></font></td>'
                    . '<td ondblclick="disalto('.$r['id_cot_item'].')" ><input type="text" id="v_alto'.$r['id_cot_item'].'" value="'.$r['alto'].'" style="width:60px"><br>'
                    . '<input type="text" id="v_alto2'.$r['id_cot_item'].'" value="'.$r['alto'].'"  ondblclick="disalto('.$r['id_cot_item'].')" disabled style="width:60px"><font color="red"><b>i</b></font></td>'
                    . '<td style="text-align:center"><input type="text" disabled id="v_restante'.$r['id_cot_item'].'" value="'.($r['cantidad']-$r['restante']).'" style="width:60px"></td>'
                    . '<td style="text-align:center"><input type="text" id="v_cantidad'.$r['id_cot_item'].'" value="'.($r['cantidad']-$r['restante']).'" style="width:60px"  onchange="validarc('.$r['id_cot_item'].')"></td>'
                    . '<td><input type="checkbox" id="'.$r['id_cot_item'].'" checked name="item"></td>';
        }
        
        break;
    case 4:
        $item_pri = $_GET['item_pri'];
        $ubi = $_GET['ubi'];
        $obs = $_GET['obs'];
        $pri = $_GET['pri'];
        $idcot = $_GET['cot'];
        $orden = $_GET['orden'];
        $item = $_GET['item'];
        $per = $_GET['per'];
        $boq = $_GET['boq'];
        $ancho = $_GET['ancho'];
        $ancho2 = $_GET['ancho2'];
        $alto = $_GET['alto'];
        $alto2 = $_GET['alto'];
        $cantidad = $_GET['cantidad'];
        $producto = $_GET['producto'];
        $linea = $_GET['linea'];

        for($i=1;$i<=$cantidad;$i++){
            //echo $i.'-';
            $cadena = $producto; 
            if($linea=='Vidrio'){
                $espesor = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
            }else{
                $espesor = 0; 
            }
           
            $num = str_pad($i, 4, "0", STR_PAD_LEFT);
            $cbarra = $item.$num;
            mysqli_query($con,"insert into `orden_items` (`id_orden`, `id_cot`, `item`, `codigobarra`, `descripcion_pri`, `producto`, `ubicacion`, `observacion`, `cantidad`, `contador`, `ancho1`, `ancho2`, `alto1`, `alto2`, `espesor`, `perforacion`, `boquete`, `estado`, `id_reposicion`, `fecha_registro`, `id_area`, `paso`, `id_burro`, `id_usuario`, `item_pri`, `fecha_llegada`, `linea`)
                                                   VALUES ('$orden', '$idcot', '$item', '$cbarra', '$pri','$producto', '$ubi', '$obs', '$cantidad', '$i', '$ancho', '$ancho2', '$alto', '$alto2', '$espesor', '$per', '$boq', '0', '0', '".date("Y-m-d H:i:s")."', '1', '1', '1', '0', '$item_pri', '0000-00-00 00:00:00', '$linea') ");
            echo mysqli_error($con).$cbarra;
                                                }
            mysqli_query($con,"update cotizacion_item set restante=restante+'$cantidad' where id_cot_item='$item' ");

        break;
}
}

