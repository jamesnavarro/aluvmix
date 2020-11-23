<?php 
include('../../../../modelo/conexionv1.php');
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Detalles de la Orden de Produccion </title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="../js/jquery.js"></script>
<link href="estilo.css" rel="stylesheet">
<script src="../salidas/documentos/funciones.js?<?php echo rand(1,100) ?>"></script>
      
</head>
<body>
    <div>
        <h3>Orden de Produccion</h3>
    </div>

    <input type="text" id="orden"  placeholder="" value="<?php echo $_GET['op'] ?>" style="width: 80px" disabled>
   
    <br>
<div class="datagrid" id="">
     <table class="table table-hover">
                        <tr>
                           <th>ITEMS</th>
                            <th>DESCRIPCION</th>
                            <th>MEDIDAS</th>
                            <th>CANTIDAD</th>
                            <th>VER DT</th>
                        </tr>
                        <tbody id="mostrar_ordenes">
                            <?php
                            
                            $consulta = "SELECT linea_cot, area_proceso, c.porcentaje, cod_traz, per, boq, color_ta, valor_c, precio_adicional, precio_material, c.aprobado, id_cotizacion, cantidad_c, cant_restante, cant_ordenada, medida1, medida2, id_prod_cambio, producto, id_producto, id_vidrio, especial, barra, contador_item, relacionado, e.id_orden_d, orden, tip, barra_item, color, cierre, ubic, c.laminas, modulo, des_ancho, des_alto, id_referencia, traz_vid, traz_vid2, traz_vid3, traz_vid4, ancho_abajo, id_vidrio2, id_vidrio3, id_vidrio4, id_vidrio5, id_vidrio6, id2_vidrio, id2_vidrio2, id2_vidrio3, id2_vidrio4, id2_vidrio5, id3_vidrio, id3_vidrio2, id3_vidrio3, id3_vidrio4, id3_vidrio5, id4_vidrio, id4_vidrio2, id4_vidrio3, id4_vidrio4, id4_vidrio5, cuerpo, hojas, install, porcentaje_mp, verticales, horizontales, d1, duracion, (a.producto) AS producto, c.per, c.boq, c.lado AS lado_cot, c.desc, e.lado as lado
									  FROM producto a, cotizaciones c, orden_detalle e, procesos_activos f
									 WHERE e.relacionado = c.id_cotizacion
									   AND e.anula = '0'
									   AND f.id_orden_d = e.id_orden_d
									   AND e.id_producto = a.id_p
									   AND c.id_referencia = a.id_p
									   AND f.id_op = " . $_GET['op'] . "
									   AND e.parte_otro = 0
									 GROUP BY f.barra
									 ORDER BY f.barra_item";
                             $request = mysqli_query($con2, $consulta);
                            $item = 0;
                            while($row=mysqli_fetch_array($request))
	                    {
                                $item ++;
//                                echo '<tr>'
//                                . '<td>'.$item.'</td>'
//                                . '<td>'.$row['producto'].' '.$row['relacionado'].'</td>'
//                                . '<td>'.$row['medida1'].'x'.$row['medida2'].'</td>'
//                                . '<td>'.$row['cant_ordenada'].'</td>'
//                                . '<td><button onclick="verdt('.$row['relacionado'].')">Ver DT</button></td>';
                                
                                $reques=mysqli_query($con2,"SELECT * FROM cotizaciones where id_cotizacion=".$row['relacionado']."  ");
               $contador=0;
	       while($rowp=mysqli_fetch_array($reques)){
            
           
               $_GET['item']= $rowp["id_cotizacion"];
               include '../cotizacion/consultar_item.php';
            
               echo '<tr style="background:#E4E935">'
                    . '<td>'.$s[0].' '.$tip.'</td><td colspan="13">'.$producto.' | '.$color.' | Cant: '.$cant_item.' </td>'
                    . '';
            $cantidad_pricipal = $cant_item;
                        
            $request=mysqli_query($con2,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
            $descuento_riel = 0;
              $descuento_alfa = 0;
            while($row=mysqlI_fetch_array($request))
            {   
                $contador++;
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
            $fia =mysqli_fetch_array(mysqli_query($con2,$pdlr));
            $precio_actual= $fia["precio_actual"];
            $perimetro = $row["area"]/1000;
                 
            $nw_medida = $row['medida_r_a'];
            $nw_lado = $row['lado'];
            $nw_var1 = $row['descuento'];
            $nw_ope = $row['signo'];
            $nw_var2 = $row['variable'];
            $nw_cant = $row['cantidad'];
            $nw_div = $row['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
              if($horizontales==0){
                    $hori = 0;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 0;
                }else{
                    $vert = $verticales;
                }

            include '../cotizacion/formula_perfil.php';
            $al = $med_perfil;
            
              if($nw_lado=='Vertical'){
                    $deto = $descuento_riel;
                    $detoa = $descuento_alfa;
                    $canfac = $vert;
                }else{
                    $deto = 0;
                    $detoa = 0;
                    $canfac = $hori;
                }
                if($nw_div=='1'){
                    $canfac = $canfac;
                    $perfac = $canfac.' '.$nw_lado;
                }else{
                    $canfac = 1;
                    $perfac='';
                }
            $medida = $med_perfil-$deto-$detoa;
            $cantidad = $row['cantidad']*$cant_item*$canfac;
            
            include '../cotizacion/costopintura.php';
                 
            $n=1000;
            
            
            $pst = (($row['peso'] * $medida) / 1000)*$cantidad;
            
            if($row['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
            }
            
            $medida = $medida; //-$deto-$detoa
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000;
            $precio_total = $precio_actual * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            $total_perfil_costo += $precio_total;
            $total_perfil_desp += $totadesp;

            $pre_und = $precio_total / $cantidad;
            if($row['grupo']=='Perfileria Acero'){
                $costo_ace += $precio_total_acabado;
                $total_ace += $totadesp;
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
            }
            
            
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            //$peso_perfiles += $pst;
            if($row['grupo']=='Perfileria Acero'){
                $peso_acero += $pst;
            }else{
                $peso_perfiles += $pst;
            }
            $result23 = mysqli_query($con2,"select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqlI_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                     $entro = 'perfil no';
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    $entro = 'perfil si';
                 }
                  if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                   $mystring = $row['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $row['descripcion'];
                    } else {
                        $descripcion = substr($row['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
           
            echo '<tr><td width="10%" title="'. $med_perfil.'-'.$deto.'-'.$detoa.'">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$row['codigo'].'"></td>
            <td width="40%">'.$row['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$row['referencia'].'" disabled></td> 
            <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$row['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$row['dado'].'</a></td>
                <td width="10%">'.$row['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
  } 
   
     
         $sql_alf = mysqli_query($con2,"SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
              $descuento_riel = 0;
              $descuento_alfa = 0;
              
              while($sa = mysqli_fetch_array($sql_alf)){
                       $contador++;
                        if($sa['grupo']=='Perfileria Acero'){
                            $peso_acero += $pst*$cantidad;
                        }else{
                            $peso_perfiles += $pst*$cantidad;
                        }
                       if($sa['modulo']=='Rieles'){
                                  $descuento_riel = $sa['descuento'];
                              }
                              if($sa['modulo']=='Alfajia'){
                                  $descuento_alfa = $sa['descuento'];
                              }
                              $perimetro = $sa['area']/1000;
                              $pst = (($sa['peso'] * $ancho) / 1000);
                              $precio = $sa['costo_mt'];
                               $medida = $ancho; //-$descuento_riel-$descuento_alfa
                        $cantidad = $cant_item;
                        

                        include 'costopintura.php';

                        $n=1000;


                        $medtotal = $medida*$cantidad;
                        $perfiles = $medtotal / 6000;
                      if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      $mystring = $sa['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $sa['descripcion'];
                    } else {
                        $descripcion = substr($sa['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 

                      
                        
                        
            echo '<tr><td width="10%" title="">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$sa['codigo'].'"></td>
            
            <td width="40%">'.$sa['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$sa['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$sa['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
           
                  
              }
              $medida =0;
              $request_rej=mysqli_query($con2,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
              while($rowrej=mysqli_fetch_array($request_rej))
  {     
                     $pdlr = "select * from dolar_relaciones where id_referencia=".$rowrej['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysqli_fetch_array(mysqli_query($con2,$pdlr));
             $precio_actual = $fia["precio_actual"];
             
                   if($rowrej["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($rowrej["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowrej["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowrej["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{ 
                $sqlxu=mysqli_query($con2,"SELECT * FROM producto_rep_alu  where id_p=".$id_referencia." and id_r_a='".$rowrej["id_referencia_med"]."' ");
                $fil_antw =mysqli_fetch_array($sqlxu);
                $id_p= $fil_antw["id_p"];

                 $nw_medida = $fil_antw['medida_r_a'];
                $nw_lado = $fil_antw['lado'];
                $nw_var1 = $fil_antw['descuento'];
                $nw_ope = $fil_antw['signo'];
                $nw_var2 = $fil_antw['variable'];
                $nw_cant = $fil_antw['cantidad'];
                $nw_div = $fil_antw['division'];
                $altura_v_c = $altura_v_c; // altura ventana corrediza
                $altura = $altura;// altura cuerpo fijo
                $anchura = $anchura; //ancho cuerpo fijo
                $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
                $ancho = $ancho;
                $alto = $alto;
                $rtt = '"'.$nw_medida.' '.$nw_lado.' '.$nw_ope.'"';
//                if($rowrej["id_referencia_med"]=='20847'){
//                 echo '<script>console.log('.($med_perfil+1).');</script>';
//                }
                include '../../vistas/version2/productos/formula_perfil.php';
                
                $al = $med_perfil;
            }

       $request_vrej=mysqli_query($con2,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$rowrej["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
  {

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($con2,$sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            $nw_medida = $fil_anrej['medida_r_a'];
            $nw_lado = $fil_anrej['lado'];
            $nw_var1 = $fil_anrej['descuento'];
            $nw_ope = $fil_anrej['signo'];
            $nw_var2 = $fil_anrej['variable'];
            $nw_cant = $fil_anrej['cantidad'];
            $nw_div = $fil_anrej['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $alr = $med_perfil;
            
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $precio_actual / $porca;
         $prejfom = $precio_actual_fom / $porcaB; 
          
         
             if($rowrej["medida_rej"]==0 || $rowrej["medida_rej"]==999994){
                $medrej = ($ancho + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999999){
                $medrej = ($alto + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999998){
                $medrej = ($altura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999997){
                $medrej = ($altura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999995){
                $medrej = ($anchura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                $medrej = ($tvR + $rowrej["varr"]) / $rowrej["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
            $tv2 = ($al / $rowrej['var3']) * $rowrej['multiplo'];
          //parte nueva del cobro del anonisado
            $perimetro = $rowrej["area"]/1000;
           if($perimetro=='0'){
                $valor_acabado = $vc;
           }else{
               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
           }
            
            
            $pst_rej = (($rowrej['peso'] * ($medrej/1000)))*$tv2*$cant_item;
            $peso_rej = $peso_rej + $pst_rej;
            $contador++;
            if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      
        
                    $mystring = $rowrej['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowrej['descripcion'];
                    } else {
                        $descripcion = substr($rowrej['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10);    
                    $car = number_format($tv2)*$cant_item;
                    // 9 + 9 = 18
                        
            echo '<tr><td width="10%" title="'.$rowrej["id_referencia_med"].' '.$al .'/'. $rowrej['var3'].' *'. $rowrej['multiplo'].'">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$rowrej['codigo'].'"></td>
            
            <td width="40%">'.$rowrej['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['sistema'].'" disabled></td>
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medrej.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.($car).'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">R'.$contador.' '.$check.'</td>'
            . '</tr>';   
                         
  } 
            $request_aca=mysqli_query($con2,"SELECT * FROM referencia_acce a, referencias b where a.num_ref=b.id_referencia and a.id_cot=".$rowp['id_cotizacion']."  and grupo='Perfileria'   ");
                
	while($rowac=mysqli_fetch_array($request_aca))
	{       $ci++;
          
                //$mult= (100-$porca)/100;
                if($rowac["med"]==1){
                    $v = 1;
                }else{
                    $v = $rowac["med"]/1000;
                }
                if($rowac["calcular"]=='ML'){
                if($rowac["lado"]=='Vertical'){
                    $mt = $rowac["cantidad_m"] * ($rowac["med"]/1000);
                    $mte =  $rowac["cantidad_m"] *($rowac["med"]/1000);
                }else{
                    $mt = $rowac["cantidad_m"] * ($rowac["med"]/1000);
                    $mte = $rowac["cantidad_m"] * ($rowac["med"]/1000);//($ancho/1000)*
                }
                }else{
                    $mt = $rowac["cantidad_m"];
                    $mte = $rowac["cantidad_m"] * $v;
                }
                //$pp = $rowac["costo_mt"]/$mult;
                $valora = $rowac["costo_mt"] * $mte;
                $contador++;
                //$total2= $total2 + ($mte * $pp);
         if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                  $medida = $rowac["med"]*$rowac["cantidad_m"];
                  
                   $result23 = mysqli_query($con2,"select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                     $entro = 'perfil no';
                 }else{
                    //2.paso
                    $canper = ceil($rowac["cantidad_m"] /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    $entro = 'perfil si';
                 }
                 
             echo '<input type="hidden" id="itema'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'

                      . '<input type="hidden" id="cola'.$contador.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="meda'.$contador.'" style="width:60px;text-align:center" value="">'
                      . '<input type="hidden" id="unda'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["cantidad_m"].'">'
                      . '';
                echo '<tr>'
                    . '<td><input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["codigo"].'">*</td>'
                    . '<td>'.$rowac['descripcion'].'</td>'
                        . '<td><input type="text" id="ref'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["referencia"].'"></td>'
                         . '<td><input type="text" id="sis'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["sistema"].'"></td>'
                         . '<td><input type="text" id="col'.$contador.'" style="width:60px;text-align:center" value="'.$codcol.'"></td>'
                    . '<td>'.$rowac["dado"].' </td><td>-</td>'
                        . '<td><input type="text" id="med'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["med"].'"></td>'
                        . '<td>-</td><td> <input type="text" id="und'.$contador.'" style="width:60px;text-align:center" value="'.$rowac["cantidad_m"].'"></td>'
                        . '<td><input type="text" id="medt'.$contador.'" style="width:60px;text-align:center" value="'.$medida.'"></td>'
                    . '<td><input type="text" id="can'.$contador.'" style="width:60px;text-align:center" value="'.$canper.'">'
                        . '<td><input type="text" id="per'.$contador.'" style="width:60px;text-align:center" value="'.$perfil.'">'
                    . '<td>'.$contador.' '.$check.'</td></tr>';   
          
		
               
	} 
            $reques_comp=mysqli_query($con2,"SELECT * FROM cotizaciones where id_compuesto='".$rowp["id_cotizacion"]."' and id_cot=".$_GET["cot"]." and linea_cot not in ('Vidrio','Acero')  ORDER BY fila ASC ");
              
	       while($rowc=mysqli_fetch_array($reques_comp)){
            
           
               $_GET['item']= $rowc["id_cotizacion"];
               include '../cotizacion/consultar_item.php';
               $cant_item = $cant_item *$cantidad_pricipal;
               echo '<tr style="background:#F9FBE2">'
                    . '<td>-Compuesto-</td><td colspan="13">'.$producto.' | '.$color.' | Cant: '.$cant_item.' </td>'
                    . '';
               
                $request=mysqli_query($con2,"SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
            
            while($row=mysqli_fetch_array($request))
            {   
                $contador++;
            $pdlr = "select * from dolar_relaciones where id_referencia=".$row['id_referencia']." and id_dolar=".$dolar."  ";
            $fia =mysqli_fetch_array(mysqli_query($con2,$pdlr));
            $precio_actual= $fia["precio_actual"];
            $perimetro = $row["area"]/1000;
                 
            $nw_medida = $row['medida_r_a'];
            $nw_lado = $row['lado'];
            $nw_var1 = $row['descuento'];
            $nw_ope = $row['signo'];
            $nw_var2 = $row['variable'];
            $nw_cant = $row['cantidad'];
            $nw_div = $row['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;
              if($horizontales==0){
                    $hori = 0;
                }else{
                    $hori = $horizontales;
                }
                if($verticales==0){
                    $vert = 0;
                }else{
                    $vert = $verticales;
                }

            include '../cotizacion/formula_perfil.php';
            $al = $med_perfil;
            
              if($nw_lado=='Vertical'){
                    $deto = $descuento_riel;
                    $detoa = $descuento_alfa;
                    $canfac = $vert;
                }else{
                    $deto = 0;
                    $detoa = 0;
                    $canfac = $hori;
                }
                if($nw_div=='1'){
                    $canfac = $canfac;
                    $perfac = $canfac.' '.$nw_lado;
                }else{
                    $canfac = 1;
                    $perfac='';
                }
            $medida = $med_perfil-$deto-$detoa;
            $cantidad = $row['cantidad']*$cant_item*$canfac;
            
            include '../cotizacion/costopintura.php';
                 
            $n=1000;
            
            
            $pst = (($row['peso'] * $medida) / 1000)*$cantidad;
            
            if($row['grupo']=='Perfileria Acero'){
                $porca = $porcace;
                $porcentaje = $porace;
            }else{
                 $porca = $porca;
                 $porcentaje = $despalu;
            }
            
            $medida = $medida; //-$deto-$detoa
            $medtotal = $medida*$cantidad;
            $perfiles = $medtotal / 6000;
            $precio_total = $precio_actual * ($medtotal/1000);
            
            $precio_total_acabado = $precio_total + $valor_acabado;
            $totadesp = $precio_total_acabado/$porca;
            $total_perfil_costo += $precio_total;
            $total_perfil_desp += $totadesp;

            $pre_und = $precio_total / $cantidad;
            if($row['grupo']=='Perfileria Acero'){
                $costo_ace += $precio_total_acabado;
                $total_ace += $totadesp;
            }else{
                $costo_alu += $precio_total_acabado;
                $total_alu += $totadesp;
            }
            
            
            $crudo += $precio_total;
            $pintado+=$valor_acabado;
            //$peso_perfiles += $pst;
            if($row['grupo']=='Perfileria Acero'){
                $peso_acero += $pst;
            }else{
                $peso_perfiles += $pst;
            }
            $result23 = mysqli_query($con2,"select codigo,medida_max from tipo_aluminio where color_a = '".$color."' ");
                $pc = mysqli_fetch_array($result23);
                $codcol = $pc[0];
                $medmax = $pc[1];
                $per = $medmax / $medida;
                 if($per<1){
                     $per=1;
                     $perfil =  $medmax;
                     $canper = ceil($medida / $medmax);
                 }else{
                    //2.paso
                    $canper = ceil($cantidad /intval($per));
                    //3.paso
                    $perfil = (intval($per) * $medida)+100;
                    $codp = round($perfil,-2);
                    
                 }
                  if($s[0]==0){
                    $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                  }else{
                    $check  = '<img src="../images/autorizacion.png">';
                  }
                   $mystring = $row['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $row['descripcion'];
                    } else {
                        $descripcion = substr($row['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 
           
            echo '<tr><td width="10%" title="">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$row['codigo'].'"></td>
            
            <td width="40%">'.$row['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$row['referencia'].'" disabled></td> 
            <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$row['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$row['dado'].'</a></td>
                <td width="10%">'.$row['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
  } 
   
     
         $sql_alf = mysqli_query($con2,"SELECT * FROM referencias a,grupos_referencia b  where  a.referencia=b.referencia and a.id_referencia in ('$rieles','$alfajia')  ");
           
              while($sa = mysqli_fetch_array($sql_alf)){
                       $contador++;
                        if($sa['grupo']=='Perfileria Acero'){
                            $peso_acero += $pst*$cantidad;
                        }else{
                            $peso_perfiles += $pst*$cantidad;
                        }
                       if($sa['modulo']=='Rieles'){
                                  $descuento_riel = $sa['descuento'];
                              }
                              if($sa['modulo']=='Alfajia'){
                                  $descuento_alfa = $sa['descuento'];
                              }
                              $perimetro = $sa['area']/1000;
                              $pst = (($sa['peso'] * $ancho) / 1000);
                              $precio = $sa['costo_mt'];
                               $medida = $ancho; //-$descuento_riel-$descuento_alfa
                        $cantidad = $cant_item;

                        include 'costopintura.php';

                        $n=1000;


                        $medtotal = $medida*$cantidad;
                        $perfiles = $medtotal / 6000;
                      if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      $mystring = $sa['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $sa['descripcion'];
                    } else {
                        $descripcion = substr($sa['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10); 

                      
                        
                        
            echo '<tr><td width="10%" title="">'
                 . '<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$sa['codigo'].'"></td>
            
            <td width="40%">'.$sa['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$sa['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$sa['sistema'].'" disabled></td>            
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
           
                  
              }
              
              $request_rej=mysqli_query($con2,"SELECT * FROM producto a, producto_rep_rej b, referencias c where b.id_referencia=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia);
              while($rowrej=mysqli_fetch_array($request_rej))
  {     
            $pdlr = "select * from dolar_relaciones where id_referencia=".$rowrej['id_referencia']." and id_dolar=".$dolar."  ";
             $fia =mysqli_fetch_array(mysqli_query($con2,$pdlr));
             $precio_actual = $fia["precio_actual"];
            if($rowrej["id_referencia_med"]=='90001'){
                $al = $altura_v_c;
            }else if($rowrej["id_referencia_med"]=='90002'){
                $al = $altura;
            }else if($rowrej["id_referencia_med"]=='90003'){
                $al = $anchura;
            }else if($rowrej["id_referencia_med"]=='90004'){
                $al = $anchura_v_c;
            }else{
             
          
                 $sqlx=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$rowrej["id_referencia_med"]."");
            $fil_an =mysqli_fetch_array(mysqli_query($con2,$sqlx));
            $id_p= $fil_an["id_p"];
             $nw_medida = $fil_an['medida_r_a'];
            $nw_lado = $fil_an['lado'];
            $nw_var1 = $fil_an['descuento'];
            $nw_ope = $fil_an['signo'];
            $nw_var2 = $fil_an['variable'];
            $nw_cant = $fil_an['cantidad'];
            $nw_div = $fil_an['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $al = $med_perfil;
            }

       $request_vrej=mysqli_query($con2,"SELECT * FROM producto a, producto_rep_vid b, referencias c where b.id_ref_vid=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_v=".$rowrej["medida_rej"]." ");
       while($col=mysqli_fetch_array($request_vrej))
  {

            $sqlxr=("SELECT * FROM producto a, producto_rep_alu b, referencias c where b.id_ref_alum=c.id_referencia and a.id_p=b.id_p and a.id_p=".$id_referencia." and b.id_r_a=".$col["ancho_v"]."");
            $fil_anrej =mysqli_fetch_array(mysqli_query($con2,$sqlxr));
            $id_p= $fil_anrej["id_p"];
            
            $nw_medida = $fil_anrej['medida_r_a'];
            $nw_lado = $fil_anrej['lado'];
            $nw_var1 = $fil_anrej['descuento'];
            $nw_ope = $fil_anrej['signo'];
            $nw_var2 = $fil_anrej['variable'];
            $nw_cant = $fil_anrej['cantidad'];
            $nw_div = $fil_anrej['division'];
            $altura_v_c = $altura_v_c; // altura ventana corrediza
            $altura = $altura;// altura cuerpo fijo
            $anchura = $anchura; //ancho cuerpo fijo
            $anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
            $ancho = $ancho;
            $alto = $alto;

            include '../vistas/version2/productos/formula_perfil.php';
            $alr = $med_perfil;
            
            
            $tvR = $alr + $col['var1'];


         }
         $prej = $precio_actual / $porca;
         $prejfom = $precio_actual_fom / $porcaB; 
          
         
             if($rowrej["medida_rej"]==0 || $rowrej["medida_rej"]==999994){
                $medrej = ($ancho + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999999){
                $medrej = ($alto + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999998){
                $medrej = ($altura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999997){
                $medrej = ($altura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999996){
                $medrej = ($anchura_v_c + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                if($rowrej["medida_rej"]==999995){
                $medrej = ($anchura + $rowrej["varr"]) / $rowrej["en"]; 
            }else{
                $medrej = ($tvR + $rowrej["varr"]) / $rowrej["en"]; 
            }
            }
            }  
            } 
            } 
            }
       
            $al2 = ($alto+$fil_an["descuento"]);
            $tv2 = ($al / $rowrej['var3']) * $rowrej['multiplo'];
          //parte nueva del cobro del anonisado
            $perimetro = $rowrej["area"]/1000;
           if($perimetro=='0'){
                $valor_acabado = $vc;
           }else{
               $valor_acabado = $vc * $perimetro * ($medrej/1000) * $tv2;
           }
            
            
            $pst_rej = (($rowrej['peso'] * ($medrej/1000)))*$tv2*$cant_item;
            $peso_rej = $peso_rej + $pst_rej;
            
            if($s[0]==0){
                        $check = '<input type="checkbox" id="'.$contador.'" name="item" checked>';
                      }else{
                        $check  = '<img src="../images/autorizacion.png">';
                      }

                      
        $contador++;
                    $mystring = $rowrej['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowrej['descripcion'];
                    } else {
                        $descripcion = substr($rowrej['descripcion'],0,-6);
                    }
                    $cadena = $descripcion; 
                    $sistema = intval(preg_replace('/[^0-9]+/', '', $cadena), 10);     
                        
                        
            echo '<tr><td width="10%" title="">'
                 . '*<input type="hidden" id="item'.$contador.'" style="width:60px;text-align:center" value="'.$rowp["id_cotizacion"].'">'
                    . '<input type="hidden" id="tipo'.$contador.'" style="width:60px;text-align:center" value="'.$tip.'">'
                  . '<input type="text" id="cod'.$contador.'" style="width:60px;text-align:center" value="'.$rowrej['codigo'].'"></td>
            
            <td width="40%">'.$rowrej['descripcion'].'</td>
            <td width="10%"><input type="text" id="ref'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['referencia'].'" disabled></td> 
                <td width="10%"><input type="text" id="sis'.$contador.'" style="width:80px;text-align:center" value="'.$rowrej['sistema'].'" disabled></td>
            <td><input type="text" id="col'.$contador.'" style="width:50px;text-align:center" value="'.$codcol.'" ></td>            
            <td width="10%">'.$sa['dado'].'</a></td>
                <td width="10%">'.$sa['lado'].'</a></td>
            <td width="10%"><input type="text" id="med'.$contador.'" style="width:50px;text-align:center" value="'.$medida.'" disabled></td>
            <td>'.number_format($pst,2,',','.').'</font></td>'
            .'<td class="hidden-phone"><input type="text" id="und'.$contador.'" style="width:50px;text-align:center" value="'.$cantidad.'" disabled></td>
                <td width="10%"><input type="text" id="medt'.$contador.'" style="width:50px;text-align:center" value="'.$medtotal.'" disabled></td>
           <td><input type="text" id="can'.$contador.'" style="width:50px;text-align:center" value="'.$canper.'" onchange="modificarcod('.$contador.')"></td>
       
            <td><input type="text" id="per'.$contador.'" style="width:50px;text-align:center" value="'.round($perfil,-2).'" onchange="modificarcod('.$contador.')"></td>
       
            <td id="msg'.$contador.'">'.$contador.' '.$check.'</td>'
            . '</tr>';   
                         
  } 
               
               }
            
        }
    
    	
                            }
                          
                            ?>
                            
                        </tbody>
                    </table>
       </div>     
</body>
</html>
<div class="modal fade" id="inventario_sal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  
                 <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Actualizacion de stock por ubicacion</h4>
                </div>
                  
                <div class="modal-body" style="margin-bottom: 4%;">
                    relacion:<input type="text" id="idre" disabled>
                    <table class="table table-hover">
                        <tr>
                           <th>ITEMS</th>
                            <th>DESCRIPCION</th>
                            <th>MEDIDAS</th>
                            <th>CANTIDAD</th>
                            <th>DT</th>
                        </tr>
                        <tbody id="">
                            
                        </tbody>
                    </table>
                    <hr><br><br>
<!--                  <table class="table table-hover">
                    <tr class="bg-info">
                        <th>CODIGO(PRO)</th> 
                        <th>UBICACION</th>
                        <th>CANTIDAD</th>
                    </tr>
                   <tbody id="mostrar_ubi_pro_sal">
                   </tbody>
            </table>-->
             
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          
                </div>
              </div>
          </div>
      </div>

         

                              
                                