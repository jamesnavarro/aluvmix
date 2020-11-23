<?php
include('../../../modelo/conexioni.php');
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

$mt2 = ($ancho/1000) * ($alto/1000) * $can;
$mt = ((($ancho/1000) * ($alto/1000)) * 2) * $can;
?>
          <table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                      <th>REFERENCIA</th>
                      <th>DESCRIPCION</th>
                      <th>LADO</th>
                      <th>COLOR</th>
                      <th>CANTIDAD</th>
                       <th>CALCULO X</th>
                       <th>CANT TOTAL</th>
                      <th>TIPO</th>
                      <th>PRECIO UNID</th>
                      <th>PRECIO TOTAL</th>
                 </tr>
<?php
        $codi = $_GET['cod'];
            $result4 = mysqli_query($con, "select * FROM recetas a, productos_var b WHERE a.codigo_pro=b.codigo and a.modulo='Accesorios' AND a.codigo_ref='$cod' and a.insumo='Principal' ");
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
                $porcentaje = (100 - $despacc)/100;
                $totacc = $totacc; //  / $porcentaje
                $totalacc += $totacc;
                $tund = $totacc / $can;
                echo '<tr style="hide">'
                . '<td>'.$r['codigo_pro'].'</td>'
                . '<td>'.$r['descripcion'].'</td>'
                . '<td>'.$r['lado'].'</td>'
                . '<td>'.$r['color'].'</td>'
                . '<td>'.$r['cantidad'].'</td>'
                . '<td>'.$r['calcular'].'</td>'
                . '<td>'.$total.'</td>'
                . '<td>'.$r['para'].'</td>'
                . '<td><input type="'.$input.'" id="acc_und" value="'.number_format($tund,2,'.','').'" style="width:100px;text-align: right" disabled></td>'
                . '<td><input type="'.$input.'" id="acc_tot" value="'.number_format($totacc,2,'.','').'" style="width:100px;text-align: right" disabled></td>';
            }
?>
                 <tr>
                     <td colspan="9">Totales</td>
                     <td><input type="text" id="tacc" value="<?php echo number_format($totalacc,2,'.','') ?>" style="width:100px;text-align: right" disabled></td>
                 </tr>
               </table> 
