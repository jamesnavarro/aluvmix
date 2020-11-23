<?php
include('../../../modelo/conexioni.php');
$lam = $_GET['lam'];
$cod = $_GET['cod'];
echo $cod_pri = $_GET['cod_pri'];
$des = $_GET['des'];
if(isset($_GET['codv'])){
    $codv = $_GET['codv'];
}else{
    $codv = '';
}
ECHO $codv;
if(isset($_GET['desv'])){
    $desv = $_GET['desv'];
}else{
    $desv = '';
}
if(isset($_GET['cod'])){
    $codtra = $_GET['cod'];
}else{
    $codtra = '';
}
if(isset($_GET['descripcion'])){
    $descripcion = $_GET['descripcion'];
}else{
    $descripcion = '';
}

//<br /><b>Warning</b>:  A non-numeric value encountered in <b>C:\xampp\htdocs\aluvmix\vistas\presupuestos\ventas\calculo_costo_alu.php</b> on line <b>9</b><br /><br /><b>Warning</b>:  A non-numeric value encountered in <b>C:\xampp\htdocs\aluvmix\vistas\presupuestos\ventas\calculo_costo_alu.php</b> on line <b>19</b><br />
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
$est = $_GET['est'];
$item = $_GET['item'];
$rej  =  $_GET['rej'];
$ancfd  =  $_GET['ancfd'];
$ancfi  =  $_GET['ancfi'];
$alcfs  =  $_GET['alcfs'];
$alcfi  =  $_GET['alcfi'];
$anchovc = $ancho - $ancfd -$ancfi;
$altovc =  $alto - $alcfs- $alcfi;
$altomrej =  $alto - $rej;
$alfa  =  $_GET['alfa'];
$resultda = mysqli_query($con, "SELECT b.descuento FROM producto_perfiles a, grupos_referencia b where a.codigo='$cod_pri' and a.id_p='$alfa' and a.referencia=b.referencia ");
$da = mysqli_fetch_array($resultda);
$des_alfa = $da[0];
mysqli_query($con, "delete from  cotizacion_item where id_cot_principal='$item' ");
        
$mt2 = ($ancho/1000) * ($alto/1000) * $can;
$mt = ((($ancho/1000) * ($alto/1000)) * 2) * $can;
            if($inter=='Si'){
                $disabled = '';
            }else{
                $disabled = 'disabled';
            }
            if($espa=='Si'){
                $disabled2 = '';
            }else{
                $disabled2 = 'disabled';
            }
?>
<table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                     <th>Vidrio</th>
                    <th>Codigo</th>
                    <th>Descripcion</th>
                    <th>Cod.Vidrio</th>
                    <th>Descripcion Vidrio</th>
                    <th>Ancho.</th>
                    <th>Alto</th>
</tr>
<?php 
$gran_total = 0;
$subtotal = 0;
$total_unidad = 0;
$total_mob = 0;
$dpt = 0;
$GTtotal=0;
$TDESP = 0;

    $i = 1000;
    $medida_ancho = array();
    $medida_alto = array();
 $result = mysqli_query($con, "select * from  producto_vidrios where codigo='$cod_pri' ");
            while($f = mysqli_fetch_array($result)){
               
                echo '<tr><td colspan="3">'.$f['ref_vidrio'].'</td>';
                $vidrio = $f[2];
                $vref1 = $f[3];
                $vope1 = $f[4];
                $vvar1 = $f[5];
                $vope2 = $f[6];
                $vvar2 = $f[7];
                
                $vref2 = $f[8];
                $vope3 = $f[9];
                $vvar3 = $f[10];
                $vope4 = $f[11];
                $vvar4 = $f[12];

                $cantidad = $f[13];
                include 'formula_vidrios.php';
                $formula1 = number_format($variablev,2).$f[4].$f[5].$f[6].$f[7];
                $formula2 = number_format($variablev2,2).$f[9].$f[10].$f[11].$f[12];
                

    //$gran_total += $gt;
    //$subtotal += $subtotal2;
    //$total_unidad += $unidad;
    if($i==1){
        $dis1 = '';//disabled
    }else{
        $dis1 = '';
    }
    $medida_ancho[] = $resultadov;
    $medida_alto[] = $resultadov2;
    for($j=0;$j<$lam;$j++){
        $i++;
        ?>
<tr>
    <td title="<?php echo $formula1 ?> | <?php echo $formula2 ?>"><input type="checkbox" id="<?php echo $i ?>" name="item" value="<?php echo $i ?>" disabled checked>
        <input type="hidden" id="idmodulo<?php echo $i ?>" value="<?php echo $f[14] ?>" style="width:20px" >
        <input type="hidden" id="idlam<?php echo $i ?>" value="" style="width:20px" >
        <input type="text" id="item<?php echo $i ?>" value="V<?php echo $i-1000 ?>" style="width:40px" >
        <input type="hidden" id="idparvid<?php echo $i ?>" value="<?php echo $f[0] ?>">
        <input type="hidden" id="desparvid<?php echo $i ?>" value="<?php echo $f[2] ?>">
    </td>
    <td>
        
        <input type="text" id="codigo<?php echo $i ?>" value="<?php echo $codtra ?>" style="width:60px" onclick="get_referencias(<?php echo $i ?>);" <?php echo $dis1 ?>></td>
    <td><input type="text" id="descripcion<?php echo $i ?>" value="<?php echo $descripcion ?>" style="width:150px" disabled></td>
    <td><input type="text" id="codvidrio<?php echo $i ?>" value="<?php echo $_GET['vid'] ?>"  style="width:70px"  onclick="form_vidrio(<?php echo $i ?>)" ></td>
    <td><input type="text" id="desvidrio<?php echo $i ?>" value="<?php echo $_GET['vidnom'] ?>" style="width:140px" disabled></td>
    <input type="hidden" id="per<?php echo $i ?>" value="<?php echo $per ?>" style="width:40px" disabled>
    <input type="hidden" id="boq<?php echo $i ?>" value="<?php echo $boq ?>" style="width:40px" disabled>
    <input type="hidden" id="can<?php echo $i ?>" value="<?php echo $can ?>" style="width:40px" disabled>
    <td><input type="text" id="ancho<?php echo $i ?>" value="<?php echo $resultadov ?>" style="width:60px" disabled>
    <td><input type="text" id="alto<?php echo $i ?>" value="<?php echo ($resultadov2-$des_alfa) ?>" style="width:60px" disabled>
    <input type="hidden" id="desp<?php echo $i ?>" value="<?php echo $desp ?>" onchange="dt_calculo(<?php echo $i ?>)" style="width:40px;text-align: right">
    <input type="hidden" id="tmob<?php echo $i ?>" value="0" style="width:100px;text-align: right" disabled>
     <input type="hidden" id="und<?php echo $i ?>" value="0" style="width:80px;text-align: right" disabled>
    <input type="hidden" id="tot<?php echo $i ?>"  value="0" style="width:80px;text-align: right" disabled>
    <input type="hidden" id="tiva<?php echo $i ?>" value="0" style="width:100px;text-align: right" disabled>
    <input type="hidden" id="totdes<?php echo $i ?>"  value="0" style="width:80px;text-align: right" disabled>
    <input type="hidden" id="gtot<?php echo $i ?>"  value="0" style="width:80px;text-align: right" disabled onclick="dt(<?php echo $i ?>)">

</tr>
<?php
// $i +=1;
    }

    } 
    
 ?>
</table>
<?php 
$query3 = mysqli_query($con, "select * from  producto_vidrios where codigo='$cod_pri' ");
$fr = 0;
$rt=0;
while($e = mysqli_fetch_array($query3)){
     $vidrio = $f[2];
              $an = $medida_ancho[$rt];
              $al = $medida_alto[$rt];
              $rt +=1;
                ?>
<table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                     <th>Item</th>
                     <th>Codigo</th>
                    <th>Interlayer/espaciadores <?php echo $hoja[$fr] ?></th>
                    <th>Cantidad</th>
                    <th>Unidad</th>     
                    <th>Desp %</th> 
    </tr>
   <?php
   $totalx = 0;
   $gtot_desp=0;
    $fr += 1;
   $lamt = $lam - 1;
   for($j=0;$j<$lamt;$j++){
       $k = $j;
       $j = $fr.$j;
             $cantida = ((($e['alto']-$des_alfa) + $e['ancho'])*2)/1000;  
   ?>
    
       <tr>
        <td>
            <input type="hidden" id="idins<?php echo $j ?>" value="" style="width:20px;" >
            <input type="text" id="iteme<?php echo $j ?>" value="" style="width:40px;" >
        </td>
        <td>
            <input type="text" id="inter<?php echo $j ?>" value="" style="width:80px;" onclick="tabla_espaciadores2(<?php echo $j ?>)">
        </td>
        <td>
            <input type="text" id="interdes<?php echo $j ?>" value="" style="width:380px;" disabled>
        </td>
        <td><input type="number" id="mtc_int<?php echo $j ?>" value="" style="width:60px;" disabled></td>
        <td><input type="text" id="med_int<?php echo $j ?>" value="" style="width:60px;" disabled></td>
        <td><input type="number" id="desp_mat<?php echo $j ?>" value="0" style="width:80px;text-align: right"  onchange="precios_interlayer(<?php echo $j ?>)">
        <input type="checkbox" id="<?php echo $j ?>" name="item2" value="<?php echo $j ?>" disabled checked></td>
            <input type="hidden" id="und_int<?php echo $j ?>" value="0" style="width:80px;text-align: right" disabled></td>
            <input type="hidden" id="tot_int<?php echo $j ?>" value="0" style="width:80px;text-align: right" disabled>
            <input type="hidden" id="idpp<?php echo $j ?>" value="" style="width:80px;text-align: right" disabled>
            <input type="hidden" id="tot_desp<?php echo $j ?>" value="0" style="width:80px;text-align: right" disabled></td>
            
<!--            <button onclick="mas_acc(<?php echo $j ?>)"> + </button>-->
            <input type="hidden" id="anchoi<?php echo $j ?>" value="<?php echo $an ?>" style="width:60px" disabled>
            <input type="hidden" id="altoi<?php echo $j ?>" value="<?php echo ($al-$des_alfa) ?>" style="width:60px" disabled>
         </td>
    </tr>
   <?php }

       ?>
    
    <?php  ?>

    <tr>
        <input type="hidden" value="<?php echo $lamt ?>" id="totalesp" disabled>
        <td colspan="10" class="bg-info" align="center">PELICULA PROTECTORA</td>
        
    </tr>
    <?php
    $pel = $_GET['pelicula'];
           if($pel=='No Aplica'){
                $style = 'display: none;';
            }else {
                 $style = '';
            }
            $result = mysqli_query($con,"select codigo,descripcion,costo_promedio from productos_var  where codigo='26044' ");
            $r = mysqli_fetch_array($result);
            //echo '<option value="'.$r['codigo'].'">'.$r['codigo'].' - '.$r['descripcion'].'</option>';
            
            if($pel=='No Aplica'){
                $top = 0;
            }else if($pel=='Una Cara'){
                 $top = $r['costo_promedio']*$mt2;
            }else if($pel=='Dos Cara'){
                 $top = $r['costo_promedio']*$mt2*2;
            }
            $porcentaje = (100 - $despacc)/100;
            $top = $top; //  / $porcentaje
            $dtop = $top /$porcentaje;
                ?>
        <tr id="result_tr" style="<?php echo $style; ?>">
            <td></td>
            <td><input type="text" id="peli" value="<?php echo $r['codigo'] ?>" style="width:80px;" disabled></td>
        <td>
            <input type="text" id="dpeli" value="<?php echo $r['descripcion'] ?>" style="width:100%;" disabled>
        </td>
        <td><input type="number" id="mtc_peli" value="<?php echo $mt2 ?>" style="width:60px;" disabled></td>
         <td><input type="text" id="med_peli" value="m2" style="width:60px;" disabled></td>
         <td><input type="number" id="des_peli" value="<?php echo $despacc ?>" style="width:80px;text-align: right" disabled=""></td>
        <td><input type="number" id="und_peli" value="<?php echo $r['costo_promedio'] ?>" style="width:80px;text-align: right" disabled></td>
        <td><input type="number" id="tot_peli" value="<?php echo number_format($top,2,'.','') ?>" style="width:80px;text-align: right" disabled>
        
        </td>
        <td><input type="number" id="tot_peli_desp" value="<?php echo number_format($dtop,2,'.','') ?>" style="width:80px;text-align: right" disabled>
       
        </td>
        <td> <input type="checkbox" id="" name="item4" value="" disabled checked></td>
    </tr>
    
</table>
<?php } ?>
    