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
$est = $_GET['est'];
$item = $_GET['item'];
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
<!--    <th>Per</th>
    <th>Boq</th>
    <th>Cant.</th>
    <th>Ancho</th>-->
    <th>Desp%</th>
    <th>Variables</th>
    <th>Costo Und</th>
    <th>Costo Total</th>
    <th>Total+Desp</th>
    <th>Total</th>
    <th>Opciones</th>
</tr>
<?php 
$gran_total = 0;
$subtotal = 0;
$total_unidad = 0;
$total_mob = 0;
$dpt = 0;
$GTtotal=0;
$TDESP = 0;
if($est!='Guardado'){
    
  for($i=1;$i<=$lam;$i++){
    


    $gran_total += $gt;
    $subtotal += $subtotal2;
    $total_unidad += $unidad;
    if($i==1){
        $dis1 = '';//disabled
    }else{
        $dis1 = '';
    }
    
    ?>

<tr>
    <td><input type="hidden" id="idlam<?php echo $i ?>" value="" style="width:20px" >
        <input type="text" id="item<?php echo $i ?>" value="V<?php echo $i ?>" style="width:40px" ></td>
    <td>
        
        <input type="text" id="codigo<?php echo $i ?>" value="<?php echo $cod ?>" style="width:60px" onclick="get_referencias(<?php echo $i ?>);" <?php echo $dis1 ?>></td>
    <td><input type="text" id="descripcion<?php echo $i ?>" value="<?php echo $des ?>" style="width:230px" disabled></td>
    <td><input type="text" id="codvidrio<?php echo $i ?>" value=""  style="width:70px"  onclick="form_vidrio(<?php echo $i ?>)" ></td>
    <td><input type="text" id="desvidrio<?php echo $i ?>" value="" style="width:140px" disabled></td>
    <input type="hidden" id="per<?php echo $i ?>" value="<?php echo $per ?>" style="width:40px" disabled>
    <input type="hidden" id="boq<?php echo $i ?>" value="<?php echo $boq ?>" style="width:40px" disabled>
    <input type="hidden" id="can<?php echo $i ?>" value="<?php echo $can ?>" style="width:40px" disabled>
    <input type="hidden" id="ancho<?php echo $i ?>" value="<?php echo $ancho ?>" style="width:60px" disabled>
    <input type="text" id="alto<?php echo $i ?>" value="<?php echo $alto ?>" style="width:60px" disabled>
     <td><input type="text" id="desp<?php echo $i ?>" value="<?php echo $desp ?>" onchange="dt_calculo(<?php echo $i ?>)" style="width:40px;text-align: right"></td>
     <td><input type="text" id="tmob<?php echo $i ?>" value="0" style="width:100px;text-align: right">
     <td><input type="text" id="und<?php echo $i ?>" value="0" style="width:80px;text-align: right"></td>
    <td><input type="text" id="tot<?php echo $i ?>"  value="0" style="width:80px;text-align: right"></td>
    <input type="hidden" id="tiva<?php echo $i ?>" value="0" style="width:100px;text-align: right">
    
    <td><input type="text" id="totdes<?php echo $i ?>"  value="0" style="width:80px;text-align: right"></td>
    <td><input type="text" id="gtot<?php echo $i ?>"  value="0" style="width:80px;text-align: right"></td>
    <td>
<!--        <button onclick="traz(<?php echo $i ?>)" data-toggle="modal" data-target="#exampleModalLong">Tr</button>-->
        <button onclick="dt(<?php echo $i ?>)">Dt</button>
        <input type="checkbox" id="<?php echo $i ?>" name="item" value="<?php echo $i ?>" disabled checked>
    </td>
</tr>
<?php 

    } 
}else{  
    
    $query = mysqli_query($con, "select * from cotizacion_item where id_cot_principal='$item' and estado='Guardado' ");
    $i = 0;
    
    while($r = mysqli_fetch_array($query)){
         $i++;
         $valor_und = $r['valor_item'] / $can;
         $gran_total += $r['valor_item'];
         $subtotal += $r['valor_item'];
         $total_mob += $r['total_mob'];
             if($i==1){
        $dis1 = '';
    }else{
        $dis1 = '';
    }
    $desptotal = (100-$r['por_vid'])/100;
    $dp = $r['valor_item'] / $desptotal;
    $dpt += $dp;
    $gtotal = $dp + $r['total_mob'];
    $GTtotal += $gtotal;
    $TDESP += $r['valor_item'];
        ?>

<tr>
    <td><input type="hidden" id="idlam<?php echo $i ?>" value="<?php echo $r['id_cot_item'] ?>" style="width:20px" >
        <input type="text" id="item<?php echo $i ?>" value="V<?php echo $i ?>" style="width:40px" ></td>
    <td>
        <input type="text" id="codigo<?php echo $i ?>" value="<?php echo $r['trazabilidad'] ?>" style="width:60px" onclick="get_referencias(<?php echo $i ?>);" <?php echo $dis1 ?>></td>
    <td><input type="text" id="descripcion<?php echo $i ?>" value="<?php echo $r['descripcion_segunda'] ?>" style="width:230px" disabled></td>
    <td><input type="text" id="codvidrio<?php echo $i ?>" value="<?php echo $r['codigo'] ?>"  style="width:70px"  onclick="form_vidrio(<?php echo $i ?>)" ></td>
    <td><input type="text" id="desvidrio<?php echo $i ?>" value="<?php echo $r['descripcion_principal'] ?>" style="width:140px" disabled></td>
    <input type="hidden" id="per<?php echo $i ?>" value="<?php echo $per ?>" style="width:40px" disabled>
    <input type="hidden" id="boq<?php echo $i ?>" value="<?php echo $boq ?>" style="width:40px" disabled>
    <input type="hidden" id="can<?php echo $i ?>" value="<?php echo $can ?>" style="width:40px" disabled>
    <input type="hidden" id="ancho<?php echo $i ?>" value="<?php echo $ancho ?>" style="width:60px" disabled>
    <input type="hidden" id="alto<?php echo $i ?>" value="<?php echo $alto ?>" style="width:60px" disabled>
     <td><input type="text" id="desp<?php echo $i ?>" value="<?php echo $r['por_vid'] ?>" onchange="dt_calculo(<?php echo $i ?>)" style="width:40px;text-align: right"></td>
    <td><input type="text" id="tmob<?php echo $i ?>" value="<?php echo number_format($r['total_mob'],2,'.','') ?>" style="width:80px;text-align: right">
     <td><input type="text" id="und<?php echo $i ?>" value="<?php echo number_format($valor_und,2,'.','') ?>" style="width:80px;text-align: right"></td>
    <td><input type="text" id="tot<?php echo $i ?>"  value="<?php echo number_format($r['valor_item'],2,'.','') ?>" style="width:80px;text-align: right"></td>
    <input type="hidden" id="tiva<?php echo $i ?>" value="<?php echo number_format($r['valor_item'],2,'.','') ?>" style="width:100px;text-align: right">
    
    <td><input type="text" id="totdes<?php echo $i ?>"  value="<?php echo number_format($dp,2,'.','') ?>" style="width:80px;text-align: right" ></td>
     <td><input type="text" id="gtot<?php echo $i ?>"  value="<?php echo number_format($gtotal,2,'.','') ?>" style="width:80px;text-align: right"></td>
    <td>
<!--        <button onclick="traz(<?php echo $i ?>)" data-toggle="modal" data-target="#exampleModalLong">Tr</button> 714515 + 1805238 = 2519753-->
        <button onclick="dt(<?php echo $i ?>)">Dt</button>
        <input type="checkbox" id="<?php echo $i ?>" name="item" value="<?php echo $i ?>" disabled checked>
    </td>
</tr>
<?php
    }
    
} ?>
<tr>
<td  colspan="6">Totales:</td>
<td>
   <input type="text" value="<?php echo number_format($total_mob,2,'.','') ?>" id="tmob" style="width:80px;text-align: right">
</td>
<td>
   <input type="hidden" value="<?php echo number_format($subtotal,2,'.','') ?>" id="ttot" style="width:80px;text-align: right">
</td>
<td>
   <input type="text" value="<?php echo number_format($TDESP,2,'.','') ?>" id="dtot" style="width:80px;text-align: right">
</td>
<td>
   <input type="text" value="<?php echo number_format($dpt,2,'.','') ?>" id="totdes" style="width:80px;text-align: right">
</td>
<td>
   <input type="text" value="<?php echo number_format($GTtotal,2,'.','') ?>" id="gtot" style="width:80px;text-align: right">
</td>
    <td><button onclick="dt_sumar()">+</button></td>
</tr>
</table>

<table id="simple-table" class="table  table-bordered table-hover">
                 <tr class="bg-info" align="center">
                     <th>Item</th>
                     <th>Codigo</th>
                    <th>Interlayer/espaciadores</th>
                    <th>Cantidad</th>
                    <th>Unidad</th>
                    <th>Desp%</th>
                    <th>Costo Und</th>
                    <th>Costo Total</th>
                    <th>Total+Desp</th>
                    <th>Opciones</th>
                    
    </tr>
   <?php
   $totalx = 0;
   $gtot_desp=0;
   if($est!='Guardado'){
   $lamt = $lam -1;
   for($j=1;$j<=$lamt;$j++){
   ?>
    
    <tr>
        <td>
            <input type="hidden" id="idins<?php echo $j ?>" value="" style="width:20px;" >
            <input type="text" id="iteme<?php echo $j ?>" value="" style="width:40px;" >
        </td>
        <td>
            <input type="text" id="inter<?php echo $j ?>" value="" style="width:80px;" onclick="tabla_espaciadores(<?php echo $j ?>)">
        </td>
        <td>
            <input type="text" id="interdes<?php echo $j ?>" value="" style="width:380px;" disabled>
        </td>
        <td><input type="number" id="mtc_int<?php echo $j ?>" value="" style="width:60px;" disabled></td>
        <td><input type="text" id="med_int<?php echo $j ?>" value="" style="width:60px;" disabled></td>
        <td><input type="number" id="desp_mat<?php echo $j ?>" value="0" style="width:80px;text-align: right"  onchange="precios_interlayer(<?php echo $j ?>)"></td>
        <td><input type="number" id="und_int<?php echo $j ?>" value="0" style="width:80px;text-align: right" disabled></td>
        <td><input type="number" id="tot_int<?php echo $j ?>" value="0" style="width:80px;text-align: right" disabled>
            <input type="hidden" id="idpp<?php echo $j ?>" value="" style="width:80px;text-align: right" disabled>
        </td>
         <td><input type="number" id="tot_desp<?php echo $j ?>" value="0" style="width:80px;text-align: right" disabled></td>
         <td>
              <input type="checkbox" id="<?php echo $j ?>" name="item2" value="<?php echo $j ?>" disabled checked>
              <button onclick="mas_acc(<?php echo $j ?>)"> + </button>
         </td>
    </tr>
   <?php }}else{
       $result = mysqli_query($con,"select * from cotizacion_insumos a, productos_var b where a.codigo=b.codigo and a.id_cot_item='$item' ");
        $j = 0;
        $total = 0;
        while($r = mysqli_fetch_array($result)){
            $j += 1;
            $total += ($r['precio_unidad']*$can);
            if($r['item']=='Si'){
                $btn = '<button onclick="mas_acc('.$r['id_cot_ins'].')"> + </button>';
            }else{
                $btn = '';
            }
            $unidad = $r['precio_unidad'] / $can;
            $tot_desp = $r['precio_unidad'] / ((100-$r['porcentaje'])/100)
            ?>
        <tr>
        <td>
             <input type="text" id="tipomat<?php echo $j ?>" value="<?php echo $r['tipomat']; ?>" style="width:30px;" >
            <input type="hidden" id="idins<?php echo $j ?>" value="<?php echo $r['id_cot_ins']; ?>" style="width:20px;" >
            <input type="hidden" id="iteme<?php echo $j ?>" value="<?php echo $r['id_cot_item']; ?>" style="width:40px;" >
        </td>
        <td>
            <input type="text" id="inter<?php echo $j ?>" value="<?php echo $r['codigo']; ?>" style="width:80px;" onclick="tabla_espaciadores(<?php echo $j ?>)">
        </td>
        <td>
            <input type="text" id="interdes<?php echo $j ?>" value="<?php echo $r['descripcion']; ?>" style="width:100%;" disabled>
        </td>
        <td><input type="number" id="mtc_int<?php echo $j ?>" value="<?php echo $r['cantidad']; ?>" style="width:60px;" disabled></td>
        <td><input type="text" id="med_int<?php echo $j ?>" value="<?php echo $r['unidad']; ?>" style="width:60px;" disabled></td>
        <td><input type="number" id="desp_mat<?php echo $j ?>" value="<?php echo $r['porcentaje']; ?>" style="width:80px;text-align: right" onchange="precios_interlayer(<?php echo $j ?>)"></td>
        <td><input type="number" id="und_int<?php echo $j ?>" value="<?php echo number_format($unidad,2,'.',''); ?>" style="width:80px;text-align: right" disabled></td>
        <td><input type="number" id="tot_int<?php echo $j ?>" value="<?php echo number_format($r['precio_unidad'],2,'.',''); ?>" style="width:80px;text-align: right" disabled>
            <input type="hidden" id="idpp<?php echo $j ?>" value="" style="width:80px;text-align: right" disabled>
        
        </td>
        <td><input type="number" id="tot_desp<?php echo $j ?>" value="<?php echo number_format($tot_desp,2,'.',''); ?>" style="width:80px;text-align: right" disabled></td>
        <td>
            <input type="checkbox" id="<?php echo $j ?>" name="item2" value="<?php echo $j ?>" disabled checked>
            <button onclick="mas_acc(<?php echo $j ?>)"> + </button>
            <button onclick="borrar_comp(<?php echo $r['id_cot_ins'] ?>)"> - </button>
        </td>
    </tr>
    <?php
            $totalx += number_format($r['precio_unidad'],2,'.','');
            $gtot_desp +=  number_format($tot_desp,2,'.','');
        }
       ?>
    
    <?php } ?>
    <tbody id="mostrar_comp_extra">
         <tr>
             <td colspan="7">Total Insumos extras
             <td><input type="number" id="total_comp" value="<?php echo number_format($totalx,2,'.','') ?>" style="width:80px;text-align: right" disabled>
             <td><input type="number" id="total_comp_desp" value="<?php echo number_format($gtot_desp,2,'.','') ?>" style="width:80px;text-align: right" disabled>
             <td>-</td>
                 
    </tbody>
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

    