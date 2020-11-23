 <?php 
 include '../../../modelo/conexioni.php';
session_start();
$consultaq = mysql_query("select * from cotizacion where id_cot='".$_GET['cot']."' ");
$row = mysql_fetch_array($consultaq);
$obra = $row['obra'];
$numero = $row['numero_cotizacion'].'. '.$row['version'];
$usuario = $row['presupuesto'];
 ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Planilla de Costo</title>
                <link href="../../../css/estilo.css" rel="stylesheet">
                <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
                <script src="../../../js/jquery.min.js"></script>
                <script src="../../../js/sweetalert.min.js"></script>
                <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
        <script src="funciones.js" type="text/javascript"></script>
    </head>
    <body>
              <table>
                  <label></label>
                  <th><input type="hidden" id="total" value="<?php echo $_GET['t'] ?>"/>
                      <input type="text" id="item" value="<?php echo $_GET['item'] ?>" disabled/>
                      <input type="text" id="cot" value="<?php echo $_GET['cot'] ?>" disabled/>
                      </th>
              </table>  
                       
<?php
$totdesvid = $_GET['totdesvid'];
$total_comp_desp = $_GET['total_comp_desp'];

$total_alum = $_GET['t_alu'];
$total_alum_desp = $total_alum / ((100-$_GET['despalu'])/100);

$tvid = $_GET['t_vid'];

$total_vid = $totdesvid - $tvid;
$suma_acc = $_GET['t_acc'] + $_GET['t_kit'] + $_GET['t_adi'];
$total_acc = $suma_acc / ((100-$_GET['despacc'])/100);

$fabricacion = $_GET['t_mob'];// * 1.45;
$instalacion = $_GET['t_ins'];
$poli = $_GET['t_pol'] * 1.45;
$total_costo = $_GET['total_costo'];

$total_comp = $_GET['total_comp'];
$total_comps = $total_comp_desp - $total_comp;

//con este es N25 base del calculo
$costo_totales = $_GET['t_and'] +  $total_alum_desp + $total_comp_desp +  $totdesvid  + $total_acc + $fabricacion + $instalacion + $poli;

//echo '<br>'.$_GET['t_and'] .'+'. $_GET['t_alu'] .'+'. $total_comp_desp .'+'.  $totdesvid .'+'. $suma_acc .'+'. $total_alum .'+'. $total_acc .'+'. $fabricacion .'+'. $instalacion .'+'. $poli;
?>
  <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
      <b>Cotizacion No. : <?php echo $numero; ?></b>
      <b>Nombre de la Obra : <?php echo $obra; ?></b>
      <b>Usuario. : <?php echo $usuario; ?></b>
      <div style="float: left">
  <table class="table table-bordered">
      <tr><th  bgcolor="#A9D0F5" colspan="5" style="color:black;text-align:left;">Costo de Produccion</th>
      <tr>
          <td>Materia Prima Aluminio</td>
          <td></td>
          <td><input id="mp_aluminio" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_alu'],2,'.','') ?>"/></td>
          <td></td><td><input id="mp_aluminio2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_alu'],2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Materia Prima Vidrio</td>
          <td></td>
          <td><input id="mp_vidrio" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($tvid,2,'.','') ?>"/></td>
          <td></td><td><input id="mp_vidrio2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($tvid,2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Materia Prima Accesorios</td>
          <td></td>
          <td><input id="mp_accesorios" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_acc'],2,'.','') ?>"/></td>
          <td></td><td><input id="mp_accesorios2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_acc'],2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Accesorios Adicionales</td>
          <td></td>
          <td><input id="mp_adicionales" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_adi'],2,'.','') ?>"/></td>
          <td></td><td><input id="mp_adicionales2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_adi']) ?>"/></td>
      </tr>
      <tr>
          <td>Costo de Espaciadores e Interlayer</td>
          <td></td>
          <td><input id="mp_espaciadores"  type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_comp,2,'.','') ?>"/></td>
          <td></td><td><input id="mp_espaciadores2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_comp,2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Kit Adicionales</td>
          <td></td>
          <td><input id="mp_kit" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_kit'],2,'.','') ?>"/></td>
          <td></td><td><input id="mp_kit2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_kit'],2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Costo de Mano de Obra Fabr.</td>
          <td></td>
          <td><input id="mp_fabricacion" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($fabricacion,2,'.','') ?>"/></td>
          <td></td><td><input id="mp_fabricacion2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($fabricacion,2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Costo de Mano de Obra de Inst.</td>
          <td></td>
          <td><input id="mp_instalacion" type="text" onchange="andamio()" style="width:90px;text-align: right" value="<?php echo number_format($instalacion,2,'.','') ?>"/></td>
          <td></td><td><input id="mp_instalacion2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($instalacion,2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Costo Inst. Polimask</td>
          <td></td>
          <td><input id="mp_polimask" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($poli,2,'.','') ?>"/></td>
          <td></td><td><input id="mp_polimask2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($poli,2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Costo de Andamios</td>
          <td></td>
          <td><input id="mp_andamio" onchange="andamio()" type="text" style="width:90px;text-align: right"  value="<?php echo number_format($_GET['t_and'],2,'.','') ?>"/></td>
          <td></td><td><input id="mp_andamio2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['t_and'],2,'.','') ?>"/></td>
      </tr>

      <tr>
          <td>Desperdicio de Aluminio</td>
          <td><input type="text" id="por_alum" name="por"  onchange="calcular();" value="<?php echo ($_GET['despalu']) ?>" disabled  style="width:50px;text-align: right" />%</td>
          <td><input id="desp_alum" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format(($total_alum_desp-$_GET['t_alu']),2,'.','') ?>"/></td>
          <td></td><td><input id="desp_alum2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format(($total_alum_desp-$_GET['t_alu']),2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Desperdicio de Vidrio</td>
          <td><input type="hidden" id="por_vid" name="por"  onchange="calcular();" value="<?php echo ($_GET['desp']) ?>" disabled  style="width:50px;text-align: right" />%</td>
          <td><input id="desp_vidrio" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_vid,2,'.','') ?>"/></td>
          <td></td><td><input id="desp_vidrio2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_vid,2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Desperdicio de Accesorios</td>
          <td><input type="text" id="por_acc" name="por"  onchange="calcular();" value="<?php echo ($_GET['despacc']) ?>" disabled  style="width:50px;text-align: right" />%</td>
          <td><input id="desp_accesorios" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format(($total_acc-$_GET['t_acc']),2,'.','') ?>"/></td>
          <td></td><td><input id="desp_accesorios2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format(($total_acc-$_GET['t_acc']),2,'.','') ?>"/></td>
      </tr>
      <tr>
          <td>Desperdicio de Espaciadores e Interlayer</td>
          <td></td>
          <td><input id="desp_espaciadores" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_comps,2,'.','') ?>"/></td>
          <td></td><td><input id="desp_espaciadores2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total_comps,2,'.','') ?>"/></td>
      </tr>

      <tr   bgcolor="yellow">
          <th>Total Costo de Produccion</th>
          <td onclick="save_utilidad()"></td>
          <td><input id="total_costo_1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($costo_totales,2,'.','') ?>"/></td>
          <td></td>
          <td><input id="total_costo_2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($costo_totales,2,'.','') ?>"/></td>
      </tr>
   
    <?php
 
    $query = mysqli_query($con,"SELECT * FROM costos ");

    $encabezado = '';
    $c = 0;
    $cont=0;
    $porcentajes_totales = 0;
    $td = '';
     $suma_por =0;
     $suma_pvbi = 0;
     $sub_total_base = 0;
     $totales_operador_1 = $costo_totales;
     $por_comisiones = 0;
    while ($fila = mysqli_fetch_array($query)){
        $cont ++;
        //1 . linea de codigo para mostrar el encabezado de la lista
        
        if($encabezado == $fila['categoria_costos']){
            $c = 0; 
        }else{
            if($c==0){
               
                if($cont!=1){
                        
    $total_operador_1 = $costo_totales * ($porcentajes_totales/100);
    $total_operador_2 = $costo_totales * ($porcentajes_totales/100);
    
    $totales_operador_1 += $total_operador_2;
    
                       $td = '<tr><th>TOTALES'
                       . '<td><input id="por_total'.$cont.'" type="text" style="width:50px;text-align: right" disabled value="'.$porcentajes_totales.'"/>'
                       . '<td><input id="sub_total2'.$cont.'" type="text" value="" style="width:90px;text-align: right" disabled/>'
                       . '<td></td><td><input id="sub_total3'.$cont.'" value="" type="text" style="width:90px;text-align: right" disabled/>';
                    $porcentajes_totales = 0;
                }else{
                    $td='';

                } 
                 
               echo $td.'<tr><th  bgcolor="#A9D0F5" colspan="5" style="color:black;text-align:left;">'.$fila['categoria_costos'].'</th>';
               
            }
            
            $c ++;
           
        }
        $idc = $fila['id_cos'];
        $item = $_GET['item'];
        $resul = mysqli_query($con, "select porcentaje_item from costos_items where id_cos='$idc' and id_cot_item='$item' ");
        $r = mysqli_fetch_row($resul);
        if($r){
            $porci = $r[0];
        }else{
            $porci = $fila['porcentaje'];
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
            $no = '+';
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
        }else{
            $p_com = 0;
            $co='';
            $por_comisiones += 0;
        }
        
        $operador_1 = $costo_totales * ($porci/100);
        //fin ----------------------------------------------------------------------precio_base_1
  $precio_base = $costo_totales / ((100-$suma_por) / 100);
$sub_precio_base_2 = $precio_base * 0.1;
$precio_base_2 = $sub_precio_base_2 + $precio_base;

$sub_suma_pvbi = ($suma_pvbi/100) * $precio_base;
$total__pvbi = $sub_suma_pvbi + $precio_base;

$sub_suma_pvbi_2 = ($suma_pvbi/100) * $precio_base;
$total__pvbi_2 = $sub_suma_pvbi_2 + $precio_base_2;

$ganancia_esperada_1 = $precio_base * (0 /100);
$ganancia_esperada_2 = $total__pvbi_2 * ((10/100) + 1);//
        $encabezado = $fila['categoria_costos'];
        echo '<tr>' 
        . '<td><input type="checkbox" id="'.$cont.'" name="item" checked disabled>'.$fila['descripcion'].''
        . '<input type="hidden" id="suma_utilidad'.$cont.'" value="'.$fila['variabledos'].'"/>'
        . '<input type="hidden" id="suma_transporte'.$cont.'" value="'.$fila['variabletres'].'"/>'
        . '<input type="hidden" id="p_comision'.$cont.'" value="'.$fila['variableuno'].'"/>'
        . '<input type="hidden" id="base'.$cont.'" value="'.$fila['operadordos'].'"/></td>'
        . '<td style="text-align:right;"><input type="hidden" id="suma_por'.$cont.'" value="'.$fila['suma_porcentaje'].'"  style="width:30px;text-align: right" '.$disabled.'/>'
        . ' '.$no.' '.$s.''.$x.''.$co.'<input type="text" id="porcen'.$cont.'"  name="por"  onchange="calcular();savecalcular('.$fila['id_cos'].','.$cont.');window.opener.totalizar();" value="'.$porci.'"  style="width:50px;text-align: right" '.$disabled.'/>%</td>' 
        .'<td style="text-align:right;"><input id="operacionuno'.$cont.'" '.$disabled_valor.' onchange="recalcular('.$cont.');" type="text" value="" style="width:90px;text-align: right" /></td>' 
        .'<td></td><td style="text-align:right;"><input id="operaciondos'.$cont.'"  disabled type="text" value="" style="width:90px;text-align: right"/></td>';
    }
 $cont;
    $total_operador_1 = $costo_totales * ($porcentajes_totales/100);
    $total_operador_2 = $costo_totales * ($porcentajes_totales/100);
    echo '<tr><th>TOTALES'
                       . '<td><input type="hidden" id="porcentaje_transporte" value="'.$suma_pvbi.'"/>'
                      . '<input id="por_total'.$cont.'" type="text" style="width:50px;text-align: right" disabled value="'.$porcentajes_totales.'"/>'
                       . '<td><input id="sub_total2'.$cont.'" value=""  type="text" style="width:90px;text-align: right" disabled/>'
                       . '<td></td><td><input id="sub_total3'.$cont.'" value=""  type="text" style="width:90px;text-align: right" disabled/>';
echo '<tr>'
    . '<td>Total Costos Fijos </td>'
        . '<td><input type="text" id="total_costo_fijos_1" value="'.$suma_por.'"  style="width:50px;text-align: right" '.$disabled.'/></td>'
        . '<td></td>'
        . '<td><input type="text" id="total_costo_fijos_2" value="'.$suma_por.'"  style="width:50px;text-align: right" '.$disabled.'/></td>'
        . '<td></td>';
echo '<tr>'
    . '<td>Ganancia esperada</td>'
        . '<td><input type="text" id="ganancia_1" value="0"  onchange="calcular();" style="width:50px;text-align: right" /></td>'
        . '<td><input id="ganancia_esperada_1" type="text" value="'.number_format($ganancia_esperada_1,2,'.','').'" style="width:90px;text-align: right" disabled ></td>'
        . '<td><input type="text" id="ganancia_2" value="'.$_GET['utilidad'].'"  onchange="calcular();save_utilidad()" style="width:50px;text-align: right" /></td>'
        . '<td><input id="ganancia_esperada_2" type="text" value="'.number_format($ganancia_esperada_2,2,'.','').'" style="width:90px;text-align: right" disabled/></td>';
echo '<tr>'
    . '<td>Margen estimado de contribución</td>'
        . '<td><input type="text" id="margen_1" value="'.($suma_por+0).'"  style="width:50px;text-align: right" '.$disabled.'/></td>'
        . '<td></td>'
        . '<td><input type="text" id="margen_2" value="'.($suma_por+10).'"  style="width:50px;text-align: right" '.$disabled.'/></td>'
        . '<td></td>';


    ?>
        <tr   bgcolor="yellow">
          <th colspan="">Precio Base 1</th>
          <td></td>
          <td><input id="precio_base_1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($precio_base,2,'.','') ?>"/></td>
          <td></td>
          <td><input id="precio_base_2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($precio_base_2,2,'.','') ?>"/></td>
      </tr>
              <tr   bgcolor="yellow">
          <th colspan="">Precio de Venta Base Inicial</th>
          <td></td>
          <td><input id="precio_venta_base_1" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total__pvbi,2,'.','') ?>"/></td>
          <td></td>
          <td><input id="precio_venta_base_2" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($total__pvbi_2,2,'.','') ?>"/></td>
      </tr>
            </tr>
              <tr   bgcolor="yellow">
          <th colspan="">Ganancia Real</th>
          <td></td>
          <td></td>
          <td><input id="por_ganancia_real" type="text" style="width:40px;text-align: right" disabled value=""/>%</td>
          <td><input id="Ganancia_real" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
          <tr   bgcolor="yellow">
          <th colspan="">Ajuste de Precio</th>
          <td></td>
          <td></td>
          <td><input id="por_ajuste" type="text" style="width:40px;text-align: right" disabled value=""/>%</td>
          <td><input id="ajuste" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
                <tr   bgcolor="yellow">
          <th colspan="">Comisiones</th>
          <td></td>
          <td></td>
          <td></td>
          <td><input id="comision" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="">Utilidad Neta del Proyecto</th>
          <td></td>
          <td><input id="utilidad_1" type="text" style="width:90px;text-align: right" disabled value=""/></td>
          <td></td>
          <td><input id="utilidad_2" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
      
      <tr   bgcolor="yellow">
          <th colspan="4">Precio de Venta Planilla </th>
          <td><input id="precio_venta" type="hidden" style="width:90px;text-align: right" disabled value=""/>
          <input id="precio_venta_f" type="text" style="width:90px;text-align: right" disabled value=""/>
          </td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="4">Precio de Venta Presupuesto </th>
          <td><input id="pre" type="text" style="width:90px;text-align: right" disabled value="<?php echo number_format($_GET['gt']) ?>"/></td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="4">Diferencia de Precio </th>
          <td><input id="dif" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
      <tr   bgcolor="yellow">
          <th colspan="4">Porcentaje a subir</th>
          <td><input id="subir" type="text" style="width:90px;text-align: right" disabled value=""/></td>
      </tr>
  </table> 
 </div>
      <div style="float: right" id="imp">
<!--          <table>
              <tr>
                  <th>Seleccionar </th>
                  <th>Comision </th>
                  <th>Incremento </th>
              </tr>
              <?php
                $con = mysqli_query($con,"select * from comisiones");
                while($co = mysqli_fetch_array($con)){
                    
                    echo '<tr>'
                    . '<td><input type="radio" id="sel'.$co[1].'" value="'.$co[2].'" name="sel"></td>'
                    . '<td>%<input type="text" id="com'.$co[1].'" value="'.$co[1].'" style="width:40px;text-align: right" disabled></td>'
                    . '<td>%<input type="text" id="inc'.$co[1].'" value="'.$co[2].'" style="width:40px;text-align: right" disabled></td>'
                    . '</tr>';
                }
              ?>
          </table>-->
          
           <button class="btn btn-primary" onclick="calcular();">Calcular</button>
           <button class="btn btn-primary" onclick="calcular();">Ajustar Presupuesto</button>
          <button class="btn btn-primary" onclick="imprimir();">Imprimir</button>
          <button class="btn btn-primary" onclick="window.close();">Salir</button>
          <br>
          <br>
          Comision:    <select id="tabla_comision">
              <?php
              include '../../../modelo/conexioni.php';
              $coms = mysqli_query($con, "select * from comisiones");
              while($cov = mysqli_fetch_array($coms)){
                  echo '<option value="'.$cov[1].'">'.$cov[1].'% + '.$cov[2].'%</option>';
              }
              ?>
          </select>
          <fieldset>
              <legend>Costos</legend>
          <br>
          <table style="width: 100%;text-align: center">
              <tr>
                  <td>Precio de Venta No optima</td><tr>
                  <td>$<input type="text" id="venta" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Precio de Venta Presupuesto</td><tr>
                  <td>$<input type="hidden" id="presupuestox" value="<?php echo $_GET['gt'] ?>"  disabled>
                      <input type="text" id="presupuesto" value="<?php echo number_format($_GET['gt']) ?>" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Diferencia</td><tr>
                  <td>$<input type="text" id="diferencia" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Porcentaje de diferencia</td><tr>
                  <td>%<input type="text" id="por_dif" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
              <tr>
                  <td>Precio de Venta Real</td>
              <tr>
                  <td>$<input type="text" id="venta_final" value="" style="width: 170px;text-align: right;height: 40px;font-size: 1.5em;color: red" disabled></td>
              </tr>
          </table>
          <br>
          <span id="resultado"></span>
          </fieldset>
      </div>
    </body>
</html>
