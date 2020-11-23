<?php
include('../../../modelo/conexioni.php');
session_start();
$usuario = $_SESSION['k_username'];
$empresa = $_SESSION['empresa'];
 $idf=$_GET['idc'];
 $request = mysqli_query($con, "select * from capturas where id_captura='$idf'");
  $fila = mysqli_fetch_array($request);
                     $p[0]=$fila['id_captura'];
                     $p[1]=$fila['fecha_cap']; 
                     $p[2]=$fila['registrado_por']; 
 
?>
<!DOCTYPE html>

<html>
 

<!DOCTYPE html>
 
        <title class="text-center">.</title>
          <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../../../js/jquery.min.js"></script>
        <script src="../../../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/stilo.css">
                <script src="../../../js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
        <script src="../vistas/produccion/puestos/funciones.js"></script>
        <style> 
            table{
                font-size: 10px;
                border: 1px #EFEFEF;
                border-collapse: collapse;
                width: 100%;
            }
        </style>
    </head>
   
    <body onload="window.print();">
    <center>
        <H6>SUBSISTEMA DE INVENTARIO <BR> 
               TEMPLADO S.A.S
            <BR> LIQUIDACION DE INVENTARIO FISICO A <?php echo $p[1]; ?> Por: <?php echo $p[2]; ?></H6>
        <table style="width:98%" BORDER="1">
        
        <tr>
            <TH style="text-align:center">CODIGO</TH>
             <th style="text-align:center">DESCRIPCION</th>         
             <th style="text-align:center" NOWRAP>UNID MEDIDA</th>
             <th style="text-align:center">COLOR</th>
             <th style="text-align:center">MEDIDA</th>
             <th NOWRAP style="text-align:center">CAN SISTEMA</th>
             <th NOWRAP style="text-align:center">CAN FISICO</th>
             <th style="text-align:center">UBICACION</th>
             <TH style="text-align:center">DIFERENCIA</TH>
             <TH style="text-align:center">VLR.UND</TH>
             <TH style="text-align:center">VLR.PARCIAL</TH>
             <TH style="text-align:center">OBS</TH>
        </tr>
        <TR> 
      
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
                    $obs = '';
                     $t_ent +=$costot;
                }
                $cs +=$sto;
                $cf +=$r['cantidad'];
                $vt +=$costot;
                $dife = $r['cantidad']-$sto;
                if(isset($_GET['save'])){
                    mysqli_query($con, "update capturas_items set cantidad_actual='$sto',diferencia='$dife', fecha_liq='".date("Y-m-d")."' where id_ci='".$r['id_ci']."' ");
                }
                
                echo '<tr>'
                        . '<td style="text-align:center">'.$r['codigo'].'</td>'
                        . '<td>'.$r['descripcion'].'</td>'
                        . '<td style="text-align:center">Und</td>'
                        . '<td>'.$r['color'].'</td>'
                        . '<td style="text-align:center">'.$r['ancho'].'</td>'
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
                    . '<td><td style="text-align:right">'.$vt.'</td>'
                    . '<td><td style="text-align:right"></td>';
        ?>
        </tr>
        </table>
    </center>
    </body>
</html>
<?php
 

 

 
 

