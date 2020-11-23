<!DOCTYPE html>
<?php
	include '../../../modelo/conexioni.php';
	$sqld = "UPDATE  `cotizacion` SET `impresion` = '" . $fecha_hoy . "' WHERE `id_cot` = '" . $_GET['cot'] . "'";
	mysqli_query($con,$sqld);
	if (isset($_GET['cot'])) {

        $strConsulta3 = "select * from cotizacion  where id_cot='" . $_GET['cot'] . "'";
        $pacientes3 = mysqli_query($con,$strConsulta3);
        $fila3 = mysqli_fetch_array($pacientes3);
        $sel_iva = $fila3['sel_iva'];

        $strConsulta3 = "select * from cont_terceros  where id_ter=" . $fila3['id_tercero'] . "";
        $empresat = mysqli_query($con,$strConsulta3);
        $filae = mysqli_fetch_array($empresat);
        $nombre = $filae['nom_ter'];
        $documento = $filae['cod_ter'];
        $telefono = $filae['telfijo_ter'];
        $direccion = $filae['dir_ter'];



        if ($fila3['orden'] == '0') {
            $abc = 'COTIZACION No. : ';
            $num = $fila3['numero_cotizacion'] . '- V.' . $fila3['version'];
        } else {
            $abc = 'PEDIDO No. :';
            $num = $fila3['orden'];
        }

    $str = "select estado from cotizacion  where id_cot='" . $_GET['cot'] . "'";
                    $pac = mysqli_query($con,$str);
                    $fx = mysqli_fetch_row($pac);
                    $pr = $fx[0];
                    
                   
                            
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <title>DETALLES DE LA COTIZACIÓN No. <?php echo $num ?></title>
            <style type="text/css">

                footer {
                    position: relative;
                    /* Altura total del footer en px con valor negativo */
                    margin-top: 1px;
                    /* Altura del footer en px. Se han restado los 5px del margen
                       superior mas los 5px del margen inferior
                    */
                    height: 1px; 
                    padding:5px 0px;
                    clear: both;
                    background: #fff;
                    text-align: center;

                    font-family: Arial;
                    font-size: 7px; 
                    color: #000000; 
                }

                /* Esta clase define la anchura del contenido y la posicion centrada 
                   El contenido queda centrado y limitado, pero la cabecera y el pie
                   llegan hasta los limites del navegador.
                */
                .define {
                    width:960px;
                    margin:0 auto;
                }
                @media all {
                    div.saltopagina{
                        display: none;
                    }
                }

                @media print{
                    div.saltopagina{ 
                        display:block; 
                        page-break-before:always;
                    }
                }
                .estilo1 { 
                    font-family: Arial;
                    font-size: 8px; 
                    color: #000000; 
                } 
                td.estilo1 {
                    border:hidden;
                }
                table.estilo1 {
                    border: 1px solid #000000;
                }
                table.estilo2 {
                    border: 0.4px solid #000000;
                    border-top: 1px solid transparent;
                    border-collapse: collapse;
                }
                i { 
                    font-family: Arial;
                    font-size: 7px; 
                    color: #000000; 
                }
                .estilo2 { 
                    font-family: Arial; 
                    font-size: 14px; 
                    color: #000000; 
                } 

                th.estilo2 {
                    font-size: 10px; 
                }
                #piedepagina{
                    width:800px; 
                    position: absolute;
                    bottom: 0 !important;
                    bottom: -1px;
                }
            </style>
        </head>
        <body  <?php if($pr=='En proceso'){  ?>style="background-image: url('../images/sin.png');background-repeat: no-repeat;background-size: 480px;background-position-x: 400px;background-position-y: 250px" <?php } ?> >
<!--          onload="window.print()"-->

            <?php

            function tabla() {
               include '../../../modelo/conexioni.php';
                date_default_timezone_set("America/Bogota");
                $hora = date('h:i:s', time() - 3600 * date('I'));

                    $strConsulta3 = "select * from cotizacion  where id_cot='" . $_GET['cot'] . "'";
                    $pacientes3 = mysqli_query($con,$strConsulta3);
                    $fila3 = mysqli_fetch_array($pacientes3);
                     $sel_iva = $fila3['sel_iva'];
                    if ($fila3['nom_temp'] == '') {
                        $strConsulta3 = "select * from cont_terceros  where id_ter=" . $fila3['id_tercero'] . "";
                        $empresat = mysqli_query($con,$strConsulta3);
                        $fila6 = mysqli_fetch_array($empresat);
                        $nombre = $fila6['nom_ter'];
                        $documento = $fila6['cod_ter'];
                        $telefono = $fila6['telfijo_ter'];
                        $direccion = $fila6['dir_ter'];
                    } else {
                        $nombre = $fila3['nom_temp'];
                        $documento = $fila3['cod_temp'];
                    }
                    if ($fila3['orden'] == '0') {
                        $abc = 'COT. No. : ';
                        $num = $fila3['numero_cotizacion'] . '- V.' . $fila3['version'];
                    } else {
                        $abc = 'PED No. :';
                        $num = $fila3['orden'];
                    }

                ?>         
                <table class="estilo1" border="0"  cellpadding="0" cellspacing="0">
                    <tr>
                        <td rowspan="9"  style="margin: 15px;padding: 15px;color:white" width="50%">

                                <img src="../../../imagenes/logo3.png" width="200" height="80">

                        </td>
                        <th ALIGN=left style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                        <th ALIGN=left style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                    </tr>
                    <tr>

                        <th ALIGN=left>CLIENTE:</th>
                        <td width="25%"><?php echo $nombre; ?></td>

                        <th ALIGN=left><?php echo $abc; ?></th>
                        <td width="25%"><?php echo $num; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>C.C ó NIT:</th>
                        <td width="20%"><?php echo $documento; ?></td>
                        <th ALIGN=left>CONTACTO:</th>
                        <td width="15%"><?php echo $fila3['responsable']; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>OBRA:</th>
                        <td width="20%"><?php echo $fila3['obra']; ?></td>
                        <th ALIGN=left>ASESOR:</th>
                        <td width="15%"><?php echo $fila3['registrado']; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>DIRECCION:</th>
                        <td width="20%"><?php echo $fila3['ubicacion']; ?></td>
                        <th ALIGN=left>VALIDEZ:</th>
                        <td width="15%"><?php echo $fila3['validez']; ?></td>

                    </tr>
                    <tr>
                        <th ALIGN=left>TELEFONO:</th>
                        <td width="25%"><?php echo $fila3['tel_responsable']; ?></td>
                        <th ALIGN=left>PAGO:</th>
                        <td><?php echo $fila3['pago']; ?></td>
                    </tr>
                    <tr>
                        <th ALIGN=left>IMPRESION: </th><td><?php echo date('Y-m-d') . ' ' . $hora; ?></td>

                        <th ALIGN=left>REGISTRO:</th>
                        <td><?php echo $fila3['fecha_reg_c'] . ' por: ' . $fila3['grabado']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php ?> </td>
                    </tr>
                    <tr>
                        <th ALIGN=left>CIUDAD: </th><td><?php echo $fila3['municipio'] . ' - ' . $fila3['ciudad']; ?></td>

                        <th ALIGN=left></th>
                        <td> </td>
                    </tr>
                    <tr>

                        <th ALIGN=left  style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                        <th ALIGN=left style="color:white">.</th>
                        <td width="25%" style="color:white">.</td>

                    </tr>
                </table>

            <?php } ?>       




            <?php
            //Por cada resultado pintamos una linea
            $total2 = 0;
            $tad = 0;
			$des = 0;//Codigo Adicionado (Jaime)
            $cont = 0;
            $es2 = 0;
            $pag = 0;
            $a1 = 0 * $_GET['col'];
            $a2 = 1 * $_GET['col'];
            $a3 = 2 * $_GET['col'];
            $a4 = 3 * $_GET['col'];
            $aa5 = 4 * $_GET['col'];
            $aa6 = 5 * $_GET['col'];
            $aa7 = 6 * $_GET['col'];
            $aa8 = 7 * $_GET['col'];
            $aa9 = 8 * $_GET['col'];
            $aa10 = 9 * $_GET['col'];
            $aa11 = 10 * $_GET['col'];
            $aa12 = 11 * $_GET['col'];
            $aa13 = 12 * $_GET['col'];
            $aa14 = 13 * $_GET['col'];
            $aa15 = 14 * $_GET['col'];
            $aa16 = 15 * $_GET['col'];
            $aa17 = 16 * $_GET['col'];
            $aa18 = 17 * $_GET['col'];
            $aa19 = 18 * $_GET['col'];
            $aa20 = 19 * $_GET['col'];
            $aa21 = 20 * $_GET['col'];
            $aa22 = 21 * $_GET['col'];
            $aa23 = 22 * $_GET['col'];
            $aa24 = 23 * $_GET['col'];
            $aa25 = 24 * $_GET['col'];
            $aa26 = 25 * $_GET['col'];
            $aa27 = 26 * $_GET['col'];
            $aa28 = 27 * $_GET['col'];
            $aa29 = 28 * $_GET['col'];
            $aa30 = 29 * $_GET['col'];
            $aa31 = 30 * $_GET['col'];
            $aa32 = 31 * $_GET['col'];
            $aa33 = 32 * $_GET['col'];
            $aa34 = 33 * $_GET['col'];
            $aa35 = 34 * $_GET['col'];
            $aa36 = 35 * $_GET['col'];
            $aa37 = 36 * $_GET['col'];
             $request = mysqli_query($con,"select *, a.ruta as imc, b.ruta as imp from cotizacion_item a, producto b where a.codigo=b.codigo and a.id_cot='".$_GET['cot']."' and a.estado='Guardado' and a.id_cot_principal=0 and compuesto=0");
            while ($row = mysqli_fetch_array($request)) {

                if ($cont == $a1 || $cont == $a2 || $cont == $a3 || $cont == $a4 || $cont == $aa5 || $cont == $aa6 || $cont == $aa7 || $cont == $aa8 || $cont == $aa9 || $cont == $aa10 || $cont == $aa11 ||
                        $cont == $aa12 || $cont == $aa13 || $cont == $aa14 || $cont == $aa15 || $cont == $aa16 || $cont == $aa17 || $cont == $aa18 || $cont == $aa19 || $cont == $aa20 || $cont == $aa21 ||
                        $cont == $aa22 || $cont == $aa23 || $cont == $aa24 || $cont == $aa25 || $cont == $aa26 || $cont == $aa27 || $cont == $aa28 || $cont == $aa29 || $cont == $aa30 || $cont == $aa31 || $cont == $aa32 || $cont == $aa33 || $cont == $aa34 || $cont == $aa35 || $cont == $aa36 || $cont == $aa37) {
                    $pag +=1;
//                  echo '<fieldset style="height:670px;">';
                    
                    
                    tabla();

					$table3 = '<table border="1"  class="estilo2" width="100%">';
					$table3 = $table3 .'<thead >';
					$table3 = $table3 .'<tr BGCOLOR="#13173B">';
					$table3 = $table3 .'<th width="4%" style="font-size:8px; color:white">' . 'TIPO'.'</h6></th>';
					$table3 = $table3 .'<th width="23%" style="font-size:8px; color:white">' . 'DESCRIPCION' . '</th>';
					$table3 = $table3 .'<th width="8%" style="font-size:8px; color:white">' . 'UBICACION' . '</th>';
					$table3 = $table3 .'<th width="8%" style="font-size:8px; color:white">' . 'VIDRIO' . '</th>';
					$table3 = $table3 .'<th  width="8%" style="font-size:8px; color:white">' . 'ANCHO X ALTO' . '</th>';
					$table3 = $table3 .'<th  width="5%" style="font-size:8px; color:white">' . 'AREA M2' . '</th>';
                                        $table3 = $table3 .'<th  width="26%" style="font-size:8px; color:white">' . 'DISEÑO' . '</th>';
					$table3 = $table3 .'<th  width="3%" style="font-size:8px; color:white">' . 'UND.' . '</th>';
					$table3 = $table3 .'<th  width="10%" style="font-size:8px; color:white">' . 'VLR. UND.' . '</th>';
					$table3 = $table3 .'<th  width="15%" style="font-size:8px; color:white">' . 'VLR. TOTAL' . '</th>';
					$table3 = $table3 . '</tr>';
					$table3 = $table3 . '</thead>';
                } else {
                    $table3 = '<table   border="1"  class="estilo2" width="100%">';
                }

                
               
                if ($row['observaciones'] == '') {
                    $obs = '';
                    if ($row['linea_cot'] == 'Vidrio') {
                        $esp = '<font color="white">espacios en blanco de la cotizacion y en blanco</font>';
                    } else {
                        $esp = '';
                    }
                } else {
                    $obs = ', ' . $row['observaciones'];
                    $esp = '';
                }
                if ($row['observacion'] == '') {
                    $obs2 = '';
                } else {
                    $obs2 = '<br>OBSERVACIONES: ' . $row['observacion'];
                }
                IF ($row["imc"] == '') {
                        $img3 = '<img src="../../../producto/' . $row["imp"] . '" width="60" heigth="40">';
                    } else {
                        $img3 = '<img src="../../../archivos/' . $row["imc"] . '" width="60" heigth="40">';
                    }

                $ptt2 = $row['valor_item'];
                $descuento = $row['valor_item'] * ($row['descuento']/100);
                $subtotal = $ptt2+$descuento;
                $pudt = $subtotal / $row["cantidad"];
                $tad = $tad + $subtotal;
                $med = $row['ancho'].'x'.$row['alto'];
                $mt2  = ($row['ancho']/1000) * ($row['alto']/1000) * $row["cantidad"];
                $vidrios_query = mysqli_query($con, "select descripcion_principal,descripcion_segunda from cotizacion_item where id_cot_principal='".$row["id_cot_item"]."' and estado='Guardado' group by codigo ");
                $desvid = '';
                while($vi = mysqli_fetch_row($vidrios_query)){
                    $desvid = $desvid.$vi[1].' '.$vi[0].'<br>';
                }
                
    $table3 = $table3.'<tr>'
                    . '<td width="4%"  height="20" style="font-size:8px"><p align="center">'.$row['item'].'</p></td>          
                       <td width="23%" style="font-size:8px"><p align="justify">  '.strtoupper($row['descripcion_principal']).' '.$esp.' '.strtoupper($obs).' '.strtoupper($v).' '.strtoupper($peli).'  '.strtoupper($d1).'  '.strtoupper($obs2).' </p></td>
                       <td width="8%" style="font-size:8px"><p align="center">'.$row["ubicacion"].'</p></h6></td>'
                    . '<td width="8%" style="font-size:8px"><p align="center">'.$desvid.'</p></td>             
                       <td  width="8%" style="font-size:8px"><p align="center">'.$med.'</p></td>'
                    . '<td  width="5%" style="font-size:8px"><p align="center">'.number_format($mt2,2,',','.').'</p></td>'
                    . '<td  width="26%"><p align="center">'.$img3.'</p></td>
                       <td  width="3%" style="font-size:8px"><p align="center">'.$row["cantidad"].' </p></h6></td>
                       <td  width="10%" style="font-size:8px"><p align="center">$'.number_format($pudt).'</p></td>
                       <td  width="15%" style="font-size:8px"><p align="center">$'.number_format($subtotal).'</p></td></tr></div>';   
           $table3 = $table3.'</table>';

                echo $table3;

                $cont = $cont + 1;
				//echo $_GET['total_item'];
                 $r2 = mysqli_query($con,"SELECT count(*) FROM cotizaciones_servicios  where id_cotizacion=" . $_GET['cot'] . " and id_cot_mas=0");
                    $c21 = mysqli_fetch_array($r2);
                    //echo mysqli_error($con);
                    $csv2 = $c21['count(*)'];
                    $r3 = mysqli_query($con,"SELECT count(*) FROM cotizaciones_materiales  where id_cotizacion=" . $_GET['cot'] . " ");
                    $c31 = mysqli_fetch_array($r3);
                    $ccv2 = $c31['count(*)'];
                    $ft2 = $csv2 + $ccv2;
                if ($cont == $_GET['total_item']) {
//Codigo Agregado (Jaime)
                   
                 
                    

                    $fila3['desc_general'];
                    $ff = $tad;
                    $des = ($fila3['desc_general'] / 100) * $ff;
                    $iva = ($ff - $des) * ($sel_iva/100);
                    echo '<i>Nota: ' .$fila3['nota'] . '</i><br>';
                    if ($ft2 == 0) {
                        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format(($tad) - $des) . '</td></tr>'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">IVA '.$sel_iva.'%: $<td  align="right" width="100px" style="font-size:80%;color:white;">' . number_format($iva) . '</td></tr>'
                        . '</table><br><br>';
                        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format(($ff + $iva) - $des) . '</td></tr>'
                        . '</table><br>';
                    } else {
                        echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                        . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL REF.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format(($tad) - $des) . '</td></tr>'
                        . '</table><br>';
                    }
                }
                if ($cont == $a1 || $cont == $a2 || $cont == $a3 || $cont == $a4 || $cont == $aa5 || $cont == $aa6 || $cont == $aa7 || $cont == $aa8 || $cont == $aa9 || $cont == $aa10 || $cont == $aa11 ||
                        $cont == $aa12 || $cont == $aa13 || $cont == $aa14 || $cont == $aa15 || $cont == $aa16 || $cont == $aa17 || $cont == $aa18 || $cont == $aa19 || $cont == $aa20 || $cont == $aa21 ||
                        $cont == $aa22 || $cont == $aa23 || $cont == $aa24 || $cont == $aa25 || $cont == $aa26 || $cont == $aa27 || $cont == $aa28 || $cont == $aa29 || $cont == $aa30 || $cont == $aa31 || $cont == $aa32 || $cont == $aa33 || $cont == $aa34 || $cont == $aa35 || $cont == $aa36 || $cont == $aa37) {
                    echo '<div class="saltopagina"></div>';
                }
            }

//-----------------------------------------servicios-----------------------------------------------

            if ($ft2 != 0) {
                echo '<div class="saltopagina"></div>';
                tabla();
            }
                $to_serv = 0;
                $to_mat = 0;
                $to_k = 0;
                   
                 if($ccv2!=0){
                ?> 
<table border="1"  class="estilo2" width="100%" style="font-size:8px; color:white">
    <thead>
                   <tr BGCOLOR="#13173B">
                       <th>ITEM</th>
                       <th>CODIGO</th>
                       <th>DESCRIPCION MATERIAL</th>
                       <th>COLOR</th>
                       <th>MEDIDA</th>
                       <th>CANT</th>
                       <th>PREC UND</th>
                       <th>SUBTOTAL</th>
            
                      </tr>
</thead>


<?php
                        $cot = $_GET['cot'];
        $query = mysqli_query($con,"select * from cotizaciones_materiales  where id_cotizacion = '".$_GET['cot']."' ");
        $c = 0;
        $nt = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query)){
            $c ++;
            $codigo = $f['codigo_material'];
            if($f['linea']=='Accesorios'){
                 $pro = mysqli_query($con,"select descripcion from productos_var where codigo='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
                 $btn = '<button onclick="ver_ventas('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
            }else{
                 $pro = mysqli_query($con,"select pro_nombre from productos where pro_referencia='$codigo' ");
                 $p = mysqli_fetch_array($pro);
                 $descr = $p[0];
                 $btn = '<button onclick="ver_perfil('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
            }
           
            
            $tu = $f['valor_pagar']/$f['cantidad_mat'];
            $tom = $f['valor_pagar'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nt += $tom;
            $tt += $gt;
            echo '<tr style="font-size:8px; color:black">'
                    . '<td>'.$c.'</td>'
                    . '<td>'.$codigo.'</td>'
                    . '<td>'.$descr.'</td>'
                    . '<td>'.$f['mat_color'].'</td>'
                    . '<td>'.$f['med'].'</td>'
                    . '<td>'.$f['cantidad_mat'].'</td>'
                    . '<td style="text-align:right">'.number_format($tu).'</td>'
                    . '<td style="text-align:right">'.number_format($tom).'</td>';
        }
        echo '<tr style="font-size:8px; color:black">'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nt).'</td>';
                 ?> </table> <?php }else{ $nt=0; } 
               
                 if($csv2!=0){
                 ?>
<BR>
<table border="1"  class="estilo2" width="100%" style="font-size:8px; color:white">
                   <thead>
                       <tr BGCOLOR="#13173B">
                       <th>ITEM</th>
                       <th>CODIGO</th>
                       <th>DESCRIPCION SERVICIO</th>
                       <th>COD. RELACION</th>
                       <th>VALOR UND</th>
                       <th>CANT</th>
                       <th>PREC UND</th>
                       <th>SUBTOTAL</th>
                
                      </tr>
                       </thead>
 <?php
//---------------------------------fin kit---------------------------------------------
       
        $query3 = mysqli_query($con,"select * from cotizaciones_servicios  where id_cotizacion = '".$_GET['cot']."' ");
        $cs = 0;
        $nts = 0;
        $tt = 0;
        while($f = mysqli_fetch_array($query3)){
            $cs ++;

           $btn = '<button onclick="ver_servicios('.$f[0].')" class="btn btn-info"><i class="ace-icon fa fa-pencil align-top bigger-125"></i></button>';
           
           
            
            $tu = $f['precio_total']/$f['cantidad_serv'];
            $tom = $f['precio_total'];
            $iva = $tom * 0.19;
            $gt = $tom + $iva;
            $nts += $tom;
            $tt += $gt;
            echo '<tr style="font-size:8px; color:black">'
                    . '<td>'.$cs.'</td>'
                    . '<td>'.$f['id_servicio'].'</td>'
                    . '<td>'.$f['descripcion_ser'].'</td>'
                    . '<td>'.$f['cod_ser'].'</td>'
                    . '<td>'.$f['precio_serv'].'</td>'
                    . '<td>'.$f['cantidad_serv'].'</td>'
                    . '<td style="text-align:right">'.number_format($f['precio_und']).'</td>'
                    . '<td style="text-align:right">'.number_format($f['precio_total']).'</td>';
        }
        echo '<tr style="font-size:8px; color:black">'
                    . '<td>'.$c.'</td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right"></td>'
                    . '<td style="text-align:right">'.number_format($nts).'</td>';
                 ?> </table> <?php }else{
                     $nts = 0;
                 }

            $ff = $nt + $nts  + (($tad) - $des);
            $iva = $ff * ($sel_iva/100);
            if ($ft2 != 0) {
            	echo "<br>";
				echo "<br>";
				echo "<br>";
				echo "<br>";
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">SUB TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($ff) . '</td></tr>'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">IVA '.$sel_iva.'%: $<td  align="right" width="100px" style="font-size:80%;color:white;">' . number_format($iva) . '</td></tr>'
                . ''
                . '</table><br><br>';
                echo '<table  align="right" class="estilo2" border="1"  cellpadding="0" cellspacing="0">'
                . '<tr BGCOLOR="#13173B"><td style="font-size:80%;color:white;" width="180px" align="right">TOTAL.: $<td align="right" width="100px" style="font-size:80%;color:white;">' . number_format($ff + $iva) . '</td></tr>'
                . '</table><br>';
            }


            echo '<div class="saltopagina"></div>';
        }
         $query = mysqli_query($con,"select texto_pol from politicas where id_pol=1 ");
                    $p = mysqli_fetch_row($query);
         $textos = $p[0];
        echo '<div class="saltopagina"></div>';
        tabla();
        echo '<p align="justify" style="font-size:9px">' . $textos . '</p><br><br>';
        echo '_______________________________  ' . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . '_______________________________<br> ';
        echo 'Firma del Asesor &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Firma cliente<br>';
        echo 'C.C.';
        $pag2 = $pag + 1;

        echo '<br><br><footer>
        <div class="define">
            <p>TEMPLADO S.A CALLE 72 No 65-228, TEL 3530218, 3537791. FAX 3600173<br>BARRANQUILLA-COLOMBIA<br>www.templadosa.com - cotizacion@templadosa.com<br>Pág ' . $pag2 . '</p>
        </div>
    </footer>';
        ?>
        <h5></h5>&nbsp;

    </body>
</html>