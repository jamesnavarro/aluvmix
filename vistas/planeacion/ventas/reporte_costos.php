<?php 
if(isset($_GET['d'])){
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=ReporteDeCosto.xls");
}

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Reporte de Costos</title>
    <script src="../../../js/jquery.min.js"></script>
    <script src="../../../js/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
    <style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 12px; font-weight: bold; border-left: 0px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 2px solid #E1EEF4;font-size: 12px;border-bottom: 2px solid #E1EEF4;font-weight: normal; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; } </style>
    <script> 
        function planilla(cot,gt){
//            var t_alu = $("#t_alu").val();
//            var t_vid = $("#t_vid").val();
//            var t_acc = $("#t_acc").val();
//            var t_esp = $("#t_esp").val();
//            var t_int = $("#t_int").val();
//            var t_mob = $("#t_mob").val();
//            var t_int = $("#t_int").val();
//            var t_pol = $("#t_pol").val();
//            var t_and = $("#t_and").val();
//            var to_serv = $("#to_serv").val();
//            var to_mat = $("#to_mat").val();
//            var to_k = $("#to_k").val();
//            var t = $("#totales").val();
//            t_kit = parseFloat(to_k);
//            t_acc = parseFloat(t_acc); //  + parseFloat(to_mat)
//            t_ins = parseFloat(to_serv) + parseFloat(t_ins);
//            window.open("../costos/planilla_costo.php?cot="+cot+"&t="+t+"&t_alu="+t_alu+"\
//    &t_vid="+t_vid+"&t_acc="+t_acc+"&t_esp="+t_esp+"&t_int="+t_int+"&t_mob="+t_mob+"\
//&t_ins="+t_ins+"&t_pol="+t_pol+"&t_and="+t_and+"&gt="+gt+" ", "Planilla", "width=1000 , height=600 ");
//        
     var t_alu = $("#t_alu").val();
     var t_vid = $("#t_vid").val();
     var t_acc = $("#t_acc").val();
     var t_mob = $("#t_mob").val();
     var t_ins = 0;
     var t_pol = $("#t_pol").val();

     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_alu").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val();
     var totdesvid = $("#desperdiciovid").val();
     var utilidad = $("#utilidad").val();
     var total_comp_desp = parseFloat($("#desperdicioesp").val()) + parseFloat($("#desperdicioint").val());
     var total_comp = parseFloat($("#t_esp").val()) + parseFloat($("#t_int").val());
     
     var item = 0;
     //var cot = $("#cot").val();
     
     window.open("../costos/planilla_costo.php?item="+item+"&utilidad="+utilidad+"&cot="+cot+"&gt="+gt+"&total_comp="+total_comp+"&totdesvid="+totdesvid+"&total_comp_desp="+total_comp_desp+"&desp="+desp+"&despalu="+despalu+"&despacc="+despacc+"&despace="+despace+"&t_alu="+t_alu+"&t_vid="+t_vid+"&t_acc="+t_acc+"&t_mob="+t_mob+"&t_ins="+t_ins+"&t_pol="+t_pol,"Planilla","width=1200,height=800");

    }
    function update_desperdicio(){
     var cot = <?php echo $_GET['idcot'] ?>;
     var desp = $("#desperdicio").val();
     var despalu = $("#desperdicio_alu").val();
     var despacc = $("#desperdicio_acc").val();
     var despace = $("#desperdicio_ace").val();
     var despesp = $("#desperdicio_esp").val();
     var despint = $("#desperdicio_int").val();
     var utilidad = $("#utilidad").val();
     

          window.opener.$("#desperdicio").val(desp);
     window.opener.$("#desperdicio_alu").val(despalu);
     window.opener.$("#desperdicio_acc").val(despacc);
     window.opener.$("#desperdicio_ace").val(despace);
     window.opener.$("#desperdicio_esp").val(despesp);
     window.opener.$("#desperdicio_int").val(despint);
     
     
     var t_vid = $("#t_vid").val();
     var t_alu = $("#t_alu").val();
     var t_acc = $("#t_acc").val();
     var t_esp = $("#t_esp").val();
     var t_int = $("#t_int").val();
     
     
     $.ajax({
         type:'GET',
         data:'idcot='+cot+'&utilidad='+utilidad+'&por_vid='+desp+'&por_alu='+despalu+'&por_acc='+despacc+'&por_ace='+despace+'&despesp='+despesp+'&por_int='+despint+'&sw=33',
         url:'acciones.php',
         success: function(res){
             console.log(res);
                var dest_vid = t_vid / ((100-parseInt(desp))/100);
                var dest_alu = t_alu / ((100-parseInt(despalu))/100);
                var dest_acc = t_acc / ((100-parseInt(despacc))/100);
                var dest_ace = 0 / ((100-parseInt(despace))/100);
                var dest_esp = t_esp / ((100-parseInt(despesp))/100);
                var dest_int = t_int / ((100-parseInt(despint))/100);
             
             $("#desperdiciovid").val(dest_vid);
             $("#desperdicioalu").val(dest_alu);
             $("#desperdicioacc").val(dest_acc);
             $("#desperdicioace").val(dest_ace);
             $("#desperdicioesp").val(dest_esp);
             $("#desperdicioint").val(dest_int);
             

//     
             window.opener.update_costo(1);
     
             
         }
     });

    }
        </script>

    </head>
    <body>
        <?php
             require '../../../modelo/conexioni.php';
             $query = mysqli_query($con,"select planilla,desp_vid,desp_alu,desp_acc,desp_ace,desp_esp,desp_int,utilidad from cotizacion where id_cot='".$_GET['idcot']."' ");
                $p = mysqli_fetch_row($query);
                if($p[0]>0){
                    $dis = 'disabled';
                    $msg = '<b>No puedes editar los porcentajes de la planilla</b>';
                }else{
                    $dis = '';
                    $msg = '';
                }
                $result =  mysqli_query($con, "select count(*) from cotizacion_item where  id_cot=".$_GET['idcot']." and id_cot_principal!=0 ");
                $r = mysqli_fetch_row($result);
                //echo $r[0];
                $resultado = mysqli_query($con,"select count(*), codigo from cotizacion_item where  id_cot=".$_GET['idcot']." and id_cot_principal!=0 group by codigo ");
                $contador=0;
                while($c = mysqli_fetch_row($resultado)){
                    $contador ++;
                    //echo $c[1].' '.$c[0];
                }
                    $disabled = 'disabled';
             
        ?>        
        <div class="datagrid">
            <span id="btn"> 
                <button onclick="window.print()">Imprimir Pdf</button> 
                | <a href="<?php echo $_SERVER["REQUEST_URI"].'&d'; ?>"><button>Descargar Excel</button></a>
                
            </span>
        <table>
            <thead>
            <tr>
                <th>Items</th>
                <th>Descripcion</th>
                <th>Costo Aluminio</th>
                <th>Peso Aluminio</th>
                <th>Costo Vidrios</th>
                <th>Peso Vidrio</th>
                <th>Costo Accesorios</th>
                <th>Peso Acces.</th>
                <th>Costo Espaciadores</th>
                <th>Costo Interlayer</th>
                <th>Costo Mano de Obra</th>
                <th>Costo de Instalacion</th>
                <th>Instalacion Polimask</th>
                <th>Costo Andamios</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $request=mysqli_query($con, "SELECT * FROM cotizacion_item d where id_cot=".$_GET['idcot']." and estado='Guardado' and id_cot_principal=0 ");
                $t_alu = 0;
                $t_vid = 0;
                $t_acc = 0;
                $t_adi = 0;
                $t_kit = 0;
                $t_mob = 0;
                $t_ins = 0;
                $t_pol = 0;
                $t_and = 0;
                $p_alu = 0;
                $p_vid = 0;
                $p_acc = 0;
                
                while($row=mysqli_fetch_array($request))
	        {
                    $cod = $row['codigo'];
                    $can = $row['cantidad'];
                    $mt = (($row['ancho']/1000) + ($row['alto']/1000))*$can*2; 
                    $mt2 = ($row['ancho']/1000) * ($row['alto']/1000)*$can;
                    $result4 = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$cod' ");
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
                        //$porcentaje = (100 - $despacc)/100;
                        $totacc = $totacc; //  / $porcentaje
                        $totalacc += $totacc;
       
                     }
                     
            $result5 = mysqli_query($con,"select codigo,descripcion,costo_promedio from productos_var  where codigo='26044' ");
            $rp = mysqli_fetch_array($result5);
            $pel = $row['pelicula'];
            if($pel=='No Aplica'){
                 $topel = 0;
            }else if($pel=='Una Cara'){
                 $topel = $rp['costo_promedio']*$mt2;
            }else if($pel=='Dos Cara'){
                 $topel = $rp['costo_promedio']*$mt2*2;
            }
                 $topel = $topel; //  / $porcentaje
            
                    echo '<tr>';
                    echo '<td>'.$row['item'].'</td>';
                    echo '<td>'.$row['descripcion_principal'].'</td>';
                    $a[0] = 0;
                    echo '<td style="text-align:right">'.number_format($a[0],2,',','').'</td><td style="text-align:right">'.number_format($a[2]).'</td>';
                    $query_vid = mysqli_query($con, "select ifnull(sum(valor_item),0) from cotizacion_item where id_cot_principal='".$row['id_cot_item']."' ");
                    $v = mysqli_fetch_row($query_vid);
                    echo '<td style="text-align:right">'.number_format(($v[0]),2,',','').'</td><td style="text-align:right">'.number_format($v[2]).'</td>';
                    $query_acc = mysqli_query($con, "select ifnull(sum(precio_unidad),0) from cotizacion_insumos  where id_cot_item='".$row['id_cot_item']."' and tipomat='accesorios' ");
                    $ac = mysqli_fetch_row($query_acc);
                    echo '<td style="text-align:right">'.number_format($ac[0],2,',','').'</td>';
                    $query_esp = mysqli_query($con, "select ifnull(sum(precio_unidad),0) from cotizacion_insumos  where id_cot_item='".$row['id_cot_item']."' and tipomat='espaciadores' ");
                    $es = mysqli_fetch_row($query_esp);
                    echo '<td style="text-align:right">'.number_format($totalacc,2,',','').'</td><td style="text-align:right">'.number_format($es[0]).'</td>';
                    $query_int = mysqli_query($con, "select ifnull(sum(precio_unidad),0) from cotizacion_insumos  where id_cot_item='".$row['id_cot_item']."' and tipomat='interlayer' ");
                    $in = mysqli_fetch_row($query_int);
                    echo '<td style="text-align:right">'.number_format($in[0],2,',','').'</td>';
                    $query_mo = mysqli_query($con, "select ifnull(sum(total_mob),0) from cotizacion_item where id_cot_principal='".$row['id_cot_item']."' ");
                    $mo = mysqli_fetch_row($query_mo);
                    echo '<td style="text-align:right">'.number_format($mo[0],2,',','').'</td>';
                    $query_in = mysqli_query($con, "select ifnull(sum(total_int),0) from cotizacion_item where id_cot_principal='".$row['id_cot_item']."' ");
                    $i = mysqli_fetch_row($query_in);
                    echo '<td style="text-align:right">'.number_format($i[0],2,',','').'</td>';
                 
                    echo '<td style="text-align:right">'.number_format($topel,2,',','').'</td>';
                    $query_an = mysqli_query($con,"select ifnull(sum(costo_totales),0),porcentajes from costo_totales where id_cot=".$_GET["cot"]." and id_cotizaciones='".$row['id_cotizacion']."' and tipo_costo in ('Andamios') ");
                    $an = mysqli_fetch_row($query_an);
                    echo '<td style="text-align:right">'.number_format($an[0],2,',','').'</td>';
                    
                    $t_alu += $a[0];
                    $t_vid += ($v[0]);
                    $t_acc += $ac[0];
                    $t_esp += $es[0];
                    $t_int += $in[0];
                    $t_mob += $mo[0];
                    $t_ins += $i[0];
                    $t_pol += $topel;
                    $t_and += $an[0];
                    $p_alu += $a[2];
                    $p_vid += ($v[2]);
                    $p_acc += $ac[2]+$ad[2];
        
                }
            ?>
                    <tr>
                        <td colspan="2">Totales</td>
                        <td style="text-align:right"><?php echo number_format($t_alu,2,',','') ?><input type="hidden" id="t_alu" value="<?php echo ($t_alu) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($p_alu) ?><input type="hidden" id="p_alu" value="<?php echo ($p_alu) ?>"> Kg </td>
                        <td style="text-align:right"><?php echo number_format($t_vid,2,',','') ?><input type="hidden" id="t_vid" value="<?php echo ($t_vid) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($p_vid) ?><input type="hidden" id="p_vid" value="<?php echo ($p_vid) ?>"> Kg </td>
                        <td style="text-align:right"><?php echo number_format($t_acc,2,',','') ?><input type="hidden" id="t_acc" value="<?php echo ($t_acc) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($p_acc,2,',','') ?><input type="hidden" id="p_acc" value="<?php echo ($p_acc) ?>"> Kg </td>
                        <td style="text-align:right"><?php echo number_format($t_esp,2,',','') ?><input type="hidden" id="t_esp" value="<?php echo ($t_esp) ?>"></td>         
                        <td style="text-align:right"><?php echo number_format($t_int,2,',','') ?><input type="hidden" id="t_int" value="<?php echo ($t_int) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_mob,2,',','') ?><input type="hidden" id="t_mob" value="<?php echo ($t_mob) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_ins,2,',','') ?><input type="hidden" id="t_ins" value="<?php echo ($t_ins) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_pol,2,',','') ?><input type="hidden" id="t_pol" value="<?php echo ($t_pol) ?>"></td>
                        <td style="text-align:right"><?php echo number_format($t_and,2,',','') ?><input type="hidden" id="t_and" value="<?php echo ($t_and) ?>"></td>
                        
                    <tr>
                        <tr>
                        <td colspan="13">Total Costo Directo
                            <button onclick="planilla(<?php echo $_GET['idcot']; ?>,<?php echo $_GET['gt']; ?>)" <?php echo $dis; ?>>Planilla de Costo</button>
                            <?php echo $msg; ?>
                        </td>
                        <td style="text-align:right">
                            <?php echo number_format($t_and+$t_pol+$t_alu+$t_ins+$t_vid+$t_acc+$t_adi+$t_kit+$t_mob,2,',','') ?>
                            <input type="hidden" id="totales" value="<?php echo ($t_and+$t_pol+$t_alu+$t_ins+$t_vid+$t_acc+$t_adi+$t_kit+$t_mob) ?>">
                        </td>
                    <tr>
                        <td colspan="13">Peso Total 
                        </td>
                        <td style="text-align:right">
                            <?php echo number_format($p_alu+$p_vid+$p_acc) ?>
                            <input type="hidden" id="totales" value="<?php echo ($p_alu+$p_vid+$p_acc) ?>">Kg
                        </td>
                        </tbody>

        </table>
            <?php
//                $desp = mysqli_query($con,"select porc_desp,porc_venta from porcentajes ");
//$p = array();
//while($d = mysqli_fetch_row($desp)){
//    $p[] = $d[0];
//}
$dest_vid = $t_vid / ((100-$p[1])/100);
$dest_alu = $t_alu / ((100-$p[2])/100);
$dest_acc = $t_acc / ((100-$p[3])/100);
$dest_ace = 0 / ((100-$p[4])/100);
$dest_esp = $t_esp / ((100-$p[5])/100);
$dest_int = $t_int / ((100-$p[6])/100);

            ?>
             <table width="100%">
                <tr>
                    <td><label>Desp. de Vidrio: %</label></td>
                    <td><input type="text" <?php echo $disabled; ?> id="desperdicio" value="<?php echo $p[1] ?>" style="width: 60px" onchange="update_desperdicio()"></td>
                    <td><input type="text" disabled class="form-control" id="desperdiciovid" value="<?php echo $dest_vid ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp. de Aluminio: %</label></td>
                    <td> <input type="text" <?php echo $disabled; ?> class="form-control" id="desperdicio_alu" value="<?php echo $p[2] ?>" style="width: 60px" onchange="update_desperdicio()"></td>
                    <td><input type="text" disabled class="form-control" id="desperdicioalu" value="<?php echo $dest_alu ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp. de Accesorios: %</label></td>
                    <td><input type="text" <?php echo $disabled; ?> class="form-control" id="desperdicio_acc" value="<?php echo $p[3] ?>" style="width: 60px" onchange="update_desperdicio()"></td>
                    <td><input type="text" disabled class="form-control" id="desperdicioacc" value="<?php echo $dest_acc?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text"  class="col-form-label">Desp. de Acero: %</label></td>
                    <td><input type="text" <?php echo $disabled; ?> class="form-control"  id="desperdicio_ace" value="<?php echo $p[4] ?>" style="width: 60px" onchange="update_desperdicio()"></td>
                    <td><input type="text" disabled class="form-control" id="desperdicioace" value="<?php echo $dest_ace ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label>Desp Espaciadores : %</label></td>
                    <td><input type="text" <?php echo $disabled; ?> class="form-control" id="desperdicio_esp" value="<?php echo $p[5] ?>" style="width: 60px"  onchange="update_desperdicio()"></td>
                    <td><input type="text" disabled class="form-control" id="desperdicioesp" value="<?php echo $dest_esp ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Desp Interlayer : %</label></td>
                    <td> <input type="text" <?php echo $disabled; ?> class="form-control" id="desperdicio_int" value="<?php echo $p[6] ?>" style="width: 60px"  onchange="update_desperdicio()"></td>
                    <td><input type="text" disabled class="form-control" id="desperdicioint" value="<?php echo $dest_int ?>" style="width: 60px"></td>
                </tr>
                <tr>
                    <td><label for="message-text" class="col-form-label">Utilidad : %</label></td>
                    <td> <input type="text"  <?php echo $disabled; ?> class="form-control" id="utilidad" value="<?php echo $p[7] ?>" style="width: 60px"  onchange="update_desperdicio()"></td>
                    <td></td>
                </tr>
            </table>
       
            </div>
    </body>
</html>


