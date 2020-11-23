<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
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
        <title>LIQUIDACION DE INVENTARIO</title>
           <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../../../js/jquery.js"></script>
<script src="funciones.js"></script>
<link href="estilo.css" rel="stylesheet">
<style>
    .bg{
        background-color: white;
        font-size: 12px;
    }
    .table{
        border: 1px #EFEFEF;
        border-collapse: collapse;
        width: 100%;
    }
</style>
    </head>
    <body>
        <DIV class="bg">
        <table class="table" border="1">
                      
                         
                          <tr class="bg-info">
                         
                              <th onclick="productos();">CODIGO </th>
                              <th>DESCRIPCION</th>         
                              <th NOWRAP>UNID MEDIDA</th>
                              <th>COLOR</th>
                              <th>MEDIDA</th>
                              <th>CAN SISTEMA</th>
                              <th>CAN FISICO</th>
                              <th>UBICACION</th>
                              <TH>DIFERENCIA</TH>
                              <TH>VLR.UND</TH>
                              <TH>VLR.PARCIAL</TH>
                              <TH>OBS</TH>
                           </tr>
                  
                                    <tbody>
                                          <?php
         $idc=$_GET['idc'];
            $result = mysqli_query($con, "select * from capturas_items a, productos_var b where a.pro_codigo=b.codigo and a.id_captura='$idc' order by diferencia asc ");
            $cs=0;
            $cf=0;
            $vt=0;
            $dft = 0;
            $sw=0;
            $sw_aju=0;
            $t_ent = 0;
            $t_sal = 0;
            while($r = mysqli_fetch_array($result)){
                $ubi = $r['ubicacion'];
                $cod = $r['pro_codigo'];
                $bod = $r['bod_codigo'];
                $costo = $r['costo_promedio'];
                if($r['fecha_ajuste']!=='0000-00-00'){
                    $sw_aju=1;
                }
                $query = mysqli_query($con, "SELECT stock_ubi FROM `relacion_ubicaciones` where ubicacion='$ubi' and codigo_pro='$cod' and bod_codigo='$bod' ");
                    $st = mysqli_fetch_array($query);
                if($r['fecha_liq']!=='0000-00-00 00:00:00'){
                    $sw=1;
                    $sto = $r['cantidad_actual'];
                }else{
                     $sto = $st['stock_ubi'];
                }
                $dif =  abs($r['cantidad']-$sto);
                $costot = $costo * $dif;
                if(($r['cantidad']-$sto)<0){
                    $obs = 'Falta';
                    $dft += $dif;
                    $t_sal +=$costot;
                }else{
                    $obs = 'Sobrante';
                     $t_ent +=$costot;
                }
                $cs +=$sto;
                $cf +=$r['cantidad'];
                $vt +=$costot;
                $dife = $r['cantidad']-$sto;
                if(isset($_GET['save'])){
                    mysqli_query($con, "update capturas_items set cantidad_actual='$sto',diferencia='$dife', fecha_liq='".date("Y-m-d")."' where id_ci='".$r['id_ci']."' ");
                }
                
                if($r['capcolor']==''){
                    $colo = $r['color'];
                }else{
                    $colo = $r['capcolor'];
                }
                echo '<tr>'
                        . '<td>'.$r['codigo'].'</td>'
                        . '<td>'.$r['descripcion'].'</td>'
                        . '<td>Und</td>'
                        . '<td>'.$colo.'</td>'
                        . '<td>'.$r['ancho'].'</td>'
                        . '<td style="text-align:right">'.number_format($sto,2).'</td>'
                        . '<td  style="text-align:right">'.$r['cantidad'].'</td>'
                        . '<td style="text-align:center">'.$r['ubicacion'].'</td>'
                        . '<td style="text-align:right">'.number_format($dif,2).'</td>'
                        . '<td style="text-align:right">'.number_format($costo,2).'</td>'
                        . '<td style="text-align:right">'.number_format($costot,2).'</td>'
                        . '<td>'.$obs.'</td>';
            }
            echo '<tr><td colspan="5"></td><td style="text-align:right">'.$cs.'</td>'
                    . '<td style="text-align:right">'.$cf.'</td>'
                    . '<td><td style="text-align:right">'.$dft.'</td>'
                    . '<td><td style="text-align:right">'.$vt.'</td>';
        ?>
                                    </tbody>
                           
                      
                       </table>
            <?php  if(isset($_GET['save'])){
      echo '<script lanquage="javascript">alert("Se ha guardado el stock actual.");location.href="../captura/liq.php?idc='.$_GET['idc'].' "</script>';
                
            }else if($sw==0){  ?>
            <a href="../captura/liq.php?idc=<?php echo $_GET['idc'] ?>&save">Guardar Liquidacion</a>
            <?php }else if($sw_aju==0){ ?>
            <button id="actualizar" onclick="actualizarinv()">Actualizar Inventario</button>
            <?php }else{ echo 'Captura completada 100%';} ?>
            </DIV>
      
    </body>
</html>
