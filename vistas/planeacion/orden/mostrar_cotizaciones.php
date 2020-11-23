<?php
	include "../../../modelo/conexioni.php";
        session_start();
        $fecha_hoy = date("Y-m-d H:i:s");
        $orden = $_POST['orden'];
        $opf = $_POST['opf'];
        $cot = $_POST['cot'];
        $doc = $_POST['doc'];
        $cli = $_POST['nom'];
        $obr = $_POST['obr'];
        $reg = $_POST['reg'];
        $est = $_POST['est'];
        if($est!=''){
            $b_est = " and a.estado_o='$est' "; 
        }else{
            $b_est = ''; 
        }
        
        if($orden!=''){
            $b_ord = " and a.id_orden='$orden' "; 
        }else{
            $b_ord = ''; 
        }
        if($opf!=''){
            $b_opf = " and a.opf='$opf' "; 
        }else{
            $b_opf = ''; 
        }
        if($cot!=''){
            $b_cot = " and b.numero_cotizacion='$cot' "; 
        }else{
            $b_cot = ''; 
        }
        if($doc!=''){
            $b_doc = " and c.cod_ter='$doc' "; 
        }else{
            $b_doc = ''; 
        }
        if($cli!=''){
            $b_cli = " and c.nom_ter like '%".$cli."%' "; 
        }else{
            $b_cli = ''; 
        }
        if($obr!=''){
            $b_obr = " and b.obra like '%".$obr."%' "; 
        }else{
            $b_obr = ''; 
        }
        if($reg!=''){
            $b_reg = " and a.fecha_registro like '".$reg."%' "; 
        }else{
            $b_reg = ''; 
        }

               
	$request = mysqli_query($con,"SELECT count(a.id_orden) FROM orden_produccion a, cotizacion b, cont_terceros c where a.id_cot=b.id_cot and b.id_tercero=c.id_ter $b_ord $b_opf $b_cot $b_doc $b_cli $b_obr $b_reg $b_est ");
	if ($request) {
		$request = mysqli_fetch_row($request);
		$num_items = $request[0];
	} else {
		$num_items = 0;
	}
	$rows_by_page = 10;
	$last_page = ceil($num_items / $rows_by_page);
	if (isset($_POST['page'])) {
		$page = $_POST['page'];
	} else {
		$page = 1;
	}
?>
<?php
	$limit = 'LIMIT ' . ($page - 1) * $rows_by_page . ',' . $rows_by_page;
        echo '<tr><td colspan="12">';
	if ($page > 1) { ?>
		<a href="#" onclick="mostrarCot(1)"><img src="../images/a1.png"></a>
		<a href="#" onclick="mostrarCot(<?php echo $page - 1; ?>)"><img src="../images/a11.png"></a>
<?php
	} else { ?>
		<img src="../images/ant.png">
<?php
	}
?>
	(Pagina  <?php echo $page; ?> de <?php echo $last_page; ?>)
<?php
	if ($page < $last_page) { ?>
		<a href="#" onclick="mostrarCot(<?php echo $page + 1; ?>)"><img src="../images/p1.png"></a>
		<a href="#" onclick="mostrarCot(<?php echo $last_page ?>)"><img src="../images/p11.png"></a>
<?php
	} else { ?>
		<img src="../images/nex.png">
<?php
	}  echo 'Cantidad de registro: <b>'.$num_items.'</b> |  Area de '.$_SESSION['area'];
        echo '</td></tr>';
	$request_ac = mysqli_query($con,"SELECT * FROM orden_produccion a, cotizacion b, cont_terceros c where a.id_cot=b.id_cot and b.id_tercero=c.id_ter $b_ord $b_opf $b_cot $b_doc $b_cli $b_obr $b_reg $b_est order by a.id_orden desc " . $limit);
  
		if ($request_ac) {
			$table = '';
			$cont = 0;
			while($row = mysqli_fetch_array($request_ac)) {
			$cont = $cont + 1;
			
			$btnver = '<button onclick="ver_orden('.$row['id_orden'].','.$row['id_cot'].')">'.$row['id_orden'].'</button>';
			$table = $table . '<tr>';
			$table = $table . '<td width="5%">'.$btnver.'</td>';
			$table = $table . '<td width="5%">'.$row['opf'].'</td>';
			$table = $table . '<td width="15%">'.$row['numero_cotizacion'].'.'.$row['version'].'</td>';
			$table = $table . '<td width="10%">'.$row['doc_ter'].':'.$row['cod_ter'].'</td>';
                        $table = $table . '<td class="hidden-phone">'.$row['nom_ter'].'</td>';
			$table = $table . '<td width="10%">'.$row['obra'].'</td>';
			$table = $table . '<td width="10%">'.$row['fecha_registro'].'</td>';
                        $table = $table . '<td class="hidden-phone">'.$row['estado_o'].'</font></td>';
			$table = $table . '</tr>';
			}
	                echo $table;
		}
	?>
