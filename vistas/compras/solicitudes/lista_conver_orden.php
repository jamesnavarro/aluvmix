<?php 
include '../../../modelo/conexioni.php';
include '../../../modelo/roles_user.php';
session_start();
if(isset($_SESSION['k_username'])){
   $sql=mysqli_query($con,"SELECT * FROM solicitudes_item WHERE id_sol='".$_POST['ids']."'");
   $c = 0;
   $valor='';
   $Gtotal=0;
   $ca = 0;
   while($row=mysqli_fetch_array($sql)){
       $ca++;
   	$orden=mysqli_query($con,"SELECT sum(cantidad),id_oc_de,codigo_orden FROM orden_compra_detalle WHERE solicitud='".$row['solicitud']."' and codigo_orden=0 and id_sol='".$_POST['ids']."'");
   	$total=mysqli_fetch_assoc($orden);
        $c += $total['sum(cantidad)'];
        if($acces_user[28]=='1'){
            $btn = '<button onclick="crearitemc('.$row['solicitud'].','.$row['id_sol'].');" style="margin-right: 10%;"><img src="images/add.png"></button>';
        }else{
            $btn = '';
        }
        if($total['id_oc_de']>0){
            if($row['cantidad']!=0){
               $btc = '<input type="checkbox" id="'.$total['id_oc_de'].'" name="item" onclick="vali('.$total['id_oc_de'].')">';
            }else{
                $btc = '<font color="red">Anulada</font>';
           }
            $div = '<button title="Dividir items" onclick="duplicar('.$row['solicitud'].','.$row['cantidad'].')">D</button>';
            $mod = 'editarsol';
        }else{
           
            $queryfom = mysqli_query($con,"select ordenfom from orden_compra a,orden_compra_detalle b  where a.codigo=b.codigo_orden and b.solicitud = '".$row['solicitud']."' ");
            $f = mysqli_fetch_array($queryfom);
            $btc = '';
            $div = '';
            $mod = '';
        }
        $catpro = ($row['cantidad']-$row['cantidad_pen']);
        if($catpro>0){
            $btn = $btn.$btc;
        }
        $codigo=$row['codigo'];
        $Gtotal += (($row['cantidad']-$row['cantidad_pen'])*$row['precio']);
        $Gt = (($row['cantidad']-$row['cantidad_pen'])*$row['precio']);
        $resux = mysqli_query($con,"select referencia from productos_var where codigo='$codigo' ");
        $r = mysqli_fetch_array($resux);
        $re = mysqli_error($con);
        $ref = $r['referencia'];
        if($row['umod']!=''){
            $fmod = 'Mod: '.$row['fmod'].' por '.$row['umod'];
        }else{
            $fmod = '';
        }
        $cod = "'".$row['codigo']."'";
        $verpro = '<a href="#" onclick="verpro('.$cod.')">?</a>';
        
        $queryfom3 = mysqli_query($con,"select ordenfom from orden_compra a,orden_compra_detalle b  where a.codigo=b.codigo_orden and b.solicitud = '".$row['solicitud']."' ");
        $fr = mysqli_fetch_array($queryfom3);
        $btcult = $fr[0];
            
   	if($row['cantidad_pen']==0){ 
   		$valor .= '<tr>'.
			'<td style="color: blue;" title="'.$row['solicitud'].'"><b>'.$row['codigo'].' <img src="images/pencil_small.png" width="27px" onclick="upcodigo('.$row['solicitud'].')"></td>'.
                        '<td>'.$ref.'</td>'.
			'<td style="color: red;"> <b>'.$row['descripcion'].' '.$div.' <br><i style="size:10px">'.$fmod.'</i></td>'.
                        '<td style="color: red;"><b>'.$row['color'].'</td>'.
                        '<td style="color: red;"><b>'.$row['medida'].'</td>'.
			'<td style="color: red;" id="col_col'.$row['solicitud'].'" ondblclick="'.$mod.'('.$row['solicitud'].','.$row['cantidad'].')"><b>'.$row['cantidad'].' </td>'.
                        '<td style="color: red;"><b><input type="text" id="und'.$row['solicitud'].'" value="'.$row['undmed'].'" style="width:50px" disabled></td>'.
                        '<td style="color: red;"><input type="text" id="pre'.$row['solicitud'].'" value="'.$row['precio'].'" style="width:60px"  onchange="upprecio('.$row['solicitud'].','.$row['id_sol'].')"></td>'.
			'<td><input type="text" value="Envio Total" readonly  style="width:40px"></td>'.
			'<td><input type="text" id="creal'.$row['solicitud'].'" value="'.$row['cantidad_pen'].'" readonly  style="width:40px"></td>'.
			'<td><input type="text" id="tamaño'.$row['solicitud'].'" value="'.($row['cantidad']-$row['cantidad_pen']).'" readonly  style="width:40px"></td>'.
			'<td>'.  number_format($Gt).'</td>'.
                        '<td>'. $row['observacion'].'</td>'.
			'<td id="columna'.$row['id_oc_de'].'">'.$btc.' '.$btcult.' '.$verpro.'</td>'.
		        '</tr>';
   	}else{
   		$valor .= '<tr>'.
			'<td style="color: blue;" title="'.$row['solicitud'].'"><b>'.$row['codigo'].' <img src="images/pencil_small.png" width="20px" onclick="upcodigo('.$row['solicitud'].')"></td>'. 
                        '<td style="color: blue;">'.$ref.'</td>'.
			'<td style="color: red;"><b>'.$row['descripcion'].' '.$div.'<br><i style="size:10px">'.$fmod.'</i></td>'.
                        '<td style="color: red;"><b>'.$row['color'].'</td>'.
                        '<td style="color: red;"><b>'.$row['medida'].'</td>'.
			'<td style="color: red;" id="col_col'.$row['solicitud'].'" ondblclick="'.$mod.'('.$row['solicitud'].','.$row['cantidad'].')"><b>'.$row['cantidad'].'</td>'.
                        '<td style="color: red;"><input type="text" id="und'.$row['solicitud'].'" value="'.$row['undmed'].'" style="width:50px" disabled></td>'.
                        '<td style="color: red;"><input type="text" id="pre'.$row['solicitud'].'" value="'.$row['precio'].'"  style="width:60px" onchange="upprecio('.$row['solicitud'].','.$row['id_sol'].')"></td>'.
			'<td><input type="text" id="cnew'.$row['solicitud'].'" onkeyup="verifica('.$row['solicitud'].');"  style="width:40px"></td>'.
			'<td><input type="text" id="creal'.$row['solicitud'].'" value="'.$row['cantidad_pen'].'" readonly  style="width:40px"></td>'.
			'<td><input type="text" id="tamaño'.$row['solicitud'].'" value="'.($row['cantidad']-$row['cantidad_pen']).'" readonly  style="width:40px"</td>'.
			 '<td>'. $row['observacion'].'</td>'.
                        '<td>'.number_format($Gt).'</td>'.
			'<td>'.$btn.' '.$btcult.' '.$verpro.'</td>'.
		 '</tr>';
   	}
       
   }
   $valor .= '<tr><td colspan="7">Cantidad de Items: '.$ca.'</td>'
           . '<td colspan="2">Items Seleccionados: <input type="text" id="itemsel" value="0" disabled  style="width:40px"></td>'
           . '<td><input type="text" id="ct" value="'.$c.'" disabled style="width:80px"></td>'
           . '<td>'.  number_format($Gtotal).'</td>';
    echo $valor;
}
?>
