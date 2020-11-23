<?php
	include "../../modelo/conexion.php";
	include "../../modelo/consultar_permisos.php";
        session_start();

		if ($_POST['cot'] != '') {
			$cot = ' AND a.numero_cotizacion = "' . $_POST['cot'] . '" ';
                         $asc = '  a.version ';
		} else {
			$cot = '';
                         $asc = '  a.numero_cotizacion ';
		}
		if ($_POST['nom'] != '') {
			$nom = ' AND CONCAT(b.nom_ter, " ", a.nom_temp) LIKE "%' . $_POST['nom'] . '%" ';
		} else {
			$nom = '';
		}
		if ($_POST['obr'] != '') {
			$obr = ' AND a.obra LIKE "%'.$_POST['obr'].'%" ';
		} else {
			$obr = '';
		}
		if ($_POST['reg'] != '') {
			$reg = ' AND a.registrado = "' . $_POST['reg'] . '" ';
		} else {
			$reg = '';
		}
                if($_SESSION['area']=='Planeacion' || $_SESSION['area']=='Presupuesto' || $_SESSION['k_username']=='TATIANA.JULIAO'|| $_SESSION['admin']=='Si'){
                       if ($_POST['ana'] != '') {
                            $ana = ' AND a.presupuesto = "' . $_POST['ana'] . '" ';
                    } else {
                            $ana = '';	
                    } 
                }else{
                    
                    $ana = ' AND a.presupuesto = "' . $_SESSION['k_username'] . '" ';
                    
                }
                if ($_POST['est'] != '') {
			$est = ' AND a.estado = "' . $_POST['est'] . '" ';
		} else {
			$est = '';
		}
               
	$request = mysql_query('SELECT COUNT(*) FROM cotizacion a, cont_terceros b WHERE a.id_tercero = b.id_ter ' . $cot . $nom . $obr . $reg . $ana . $est );
	if ($request) {
		$request = mysql_fetch_row($request);
		$num_items = $request[0];
	} else {
		$num_items = 0;
	}
	$rows_by_page = 10;
	$last_page = ceil($num_items / $rows_by_page);
	if (isset($_POST['page'])) {
                session_start();
		$page = $_POST['page'];
	} else {
		$page = 1;
	}
	function interval_date($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = "Hace " . floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = "Hace " . floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = "Hace " . floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = "Hace " . floor($diferencia / 86400) . " días";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = "Hace " . floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = "Hace " . floor($diferencia / 31104000) . " años";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
	function interval_date2($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el número entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = floor($diferencia / 86400) . " días";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = floor($diferencia / 31104000) . " años";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
?>
<?php
	$limit = 'LIMIT ' . ($page - 1) * $rows_by_page . ',' . $rows_by_page;
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
?>
<?php
	$request_ac = mysql_query("SELECT * FROM cotizacion a, cont_terceros b
								WHERE a.id_tercero = b.id_ter " . $cot . $nom . $obr . $reg . $ana. $est. "
								ORDER BY $asc DESC " . $limit);
?>
<div>
	<?php   
		if ($request_ac) {
			$table = '<table class="table">';
			$table = $table . '<thead>';
			$table = $table . '<tr class="bg-info">';
			$table = $table . '<th width="5%">' . 'Ver' . '</th>';
			$table = $table . '<th width="5%">' . 'Cotizacion' . '</th>';
//			$table = $table . '<th width="5%">' . 'Documento' . '</th>';
			$table = $table . '<th width="15%">' . 'Cliente' . '</th>';
			$table = $table . '<th width="30%">' . 'Nombre de la Obra' . '</th>';
			$table = $table . '<th width="30%">' . 'Fecha Registro' . '</th>';
			$table = $table . '<th width="40%">' . 'Ultima Modificacion' . '</th>';
//			$table = $table . '<th width="10%">' . 'Ultima Impresion' . '</th>';
			$table = $table . '<th width="10%">' . 'Guardado' . '</th>';
			$table = $table . '<th width="30%">' . 'Tiempo de Cotizacion' . '</th>';
			$table = $table . '<th width="10%">' . 'Responsables' . '</th>';
                        $table = $table . '<th width="10%">' . 'Venta Total Sin IVA' . '</th>';
			$table = $table . '<th class="hidden-phone">' . 'Estado' . '</th>';
			$table = $table . '<th class="hidden-phone">' . 'Copiar' . '</th>';
			$table = $table . '<th class="hidden-phone">' . 'Version' . '</th>';
			$table = $table . '<th class="hidden-phone">' . 'Abrir' . '</th>';
			$table = $table . '</tr>';
			$table = $table . '</thead>';
			$cont = 0;
			while($row = mysql_fetch_array($request_ac)) {
				$cont = $cont + 1;
				$sql = 'SELECT * FROM cont_terceros WHERE id_ter = "' . $row['id_tercero'] . '"';
				$fil = mysql_fetch_array(mysql_query($sql));
				if ($row["nom_temp"] == '') {
					$nombre = $fil["nom_ter"];
					$documento = $fil["cod_ter"];
				} else {
					$nombre = $row["nom_temp"] . '<sup><font color="red">(temp)</font></sup>';
					$documento = $row["cod_temp"];
				}
				if ($row["estado"] == 'Ordenado') {
					$est = '<font color="red">';
					$v = '';
				} else {
					$est = '<font color="blue">';
                                        if($_SESSION['k_username']=='TATIANA.JULIAO'){
                                            $v = '';
                                        }else{
                                            $v = '<button type="button"><img width=20 heigth=20 src="../../imagenes/version.png" /></button>';
                                        }	
				}
				if ($row["copia"] == 0) {
					$c = '';
				} else {
					$c = $row["copia"];
				}
				$tiempo1 = interval_date($row['fecha_modificacion'], $fecha_hoy);
				if ($row["impresion"] == '0000-00-00 00:00:00') {
					$tiempo2 = '<font color="red">' . $row['impresion'] . '</font><br>Sin Imprimir';
				} else {
					$tiempos = interval_date($row['impresion'], $fecha_hoy);
					$tiempo2 = '<font color="green">' . $row['impresion'] . '</font><br>' . $tiempos;
				}
				if ($row["fecha_guardado"] == '0000-00-00 00:00:00') {
					$tiempo3 = '<font color="red">' . $row['fecha_guardado'] . '</font><br>Sin Guardar';
					$led = '<img src="../imagenes/ledrojo.gif" />';
				} else {
					$tiempos3 = interval_date($row['fecha_guardado'], $fecha_hoy);
					$tiempo3 = '<font color="green">' . $row['fecha_guardado'] . '</font><br>' . $tiempos3;
					$led = '<img src="../imagenes/ok.png" />';
				}
				if ($row["fecha_guardado"] == '0000-00-00 00:00:00') {
					$tiempo33 = 'Sin Guardar';
				} else {
					$tiempo33 = interval_date2($row['fecha_reg_c'], $row['fecha_guardado']);
				}
				if ($row['id_cot'] == 'Personal') {
					$link = '<a href="../../vistas/?id=ver_contacto&cod=' . $row['id_cliente'] . '">';
				} else {
					$link = '<a href="../../vistas/?id=ver_empresa&cod=' . $row['id_cliente'] . '">';
				}
				
					$ver = '<img src="../imagenes/view.png" /> Ver';
				
				if ($row["estado"] == 'En proceso') {
                                    if($_SESSION['k_username']=='TATIANA.JULIAO'){
                                        	$copy = '';
                                    }else{
                                        	$copy = '<a title="Copiar Cotizacion" href="../../modelo/copiar_cotizacion.php?cod=' . $row['id_cot'] . '"><button type="button"><img width=20 heigth=20 src="../../imagenes/copy.png" /></button></a>';
                                    }
				} else {
					if ($_SESSION["admin"] == 'Si') {
						$copy = '<a title="Copiar Cotizacion" href="../../modelo/copiar_cotizacion.php?cod=' . $row['id_cot'] . '"><button type="button"><img width=20 heigth=20 src="../../imagenes/copy.png" /></button></a>';
					} else {
						$copy = '';
					}
				}
				if ($row["estado"] == 'Pedido por aprobar') {
					if ($_SESSION['admin'] == 'Si' || $_SESSION["k_username"] == 'marlyp') {
						$open = '<button type="button"><img src="../../imagenes/up.png" /></button>';
					} else {
						$open = '';
					}
				} else {
					$open = '';
				}
//                                $crr = mysql_query("SELECT SUM(cant_restante) FROM cotizaciones WHERE id_cot ='".$row['id_cot']."' ");
//                                $cr = mysql_fetch_array($crr);
//                                $crx = $cr['SUM(cant_restante)'];
//				if ($crx == 0) {
//					$es = '<font color="red">En produccion';
//				} else {
					$es = $est . '' . $row["estado"];
//				}
                                        if($row['linea']=='Vidrio'){
                                            $btnver = '<button type="button" onclick="ver_cotizacion('.$row['id_cot'].');"><img src="../../imagenes/view.png" /> Ver</button>';
                                        }else{
                                            $btnver = '<a href="../../vistas/?id=new_fac&cot=' . $row['id_cot'] . '&cli=' . $row['id_tercero'] . '"><button type="button"><img src="../../imagenes/view.png" /> Ver</button></a>';
                                        }
                                        if($row['tecnica']==''){
                                            $tec = '';
                                        }else{
                                            $tec = '-<font color="purple">'.$row['tecnica'].'</font>';
                                        }
				$table = $table . '<tr>';
				$table = $table . '<td width="5%">'.$btnver.'</td>';
				$table = $table . '<td width="5%">' . $row['numero_cotizacion'] . '.' . $row["version"] .$tec.'</td>';
//				$table = $table . '<td width="5%">' . $documento . '</td>';
				$table = $table . '<td width="15%">' . strtoupper($nombre) . '</td>';
				$table = $table . '<td width="10%">' . strtoupper($row["obra"]) . '<font></td>';
				$table = $table . '<td width="10%">' . $row["fecha_reg_c"] . '<font></td>';
				$table = $table . '<td width="10%">' . $row["fecha_modificacion"] . '<br>' . $tiempo1 . '</a></td>';
//				$table = $table . '<td width="10%">' . $tiempo2 . '</td>';
				$table = $table . '<td width="10%">' . $tiempo3 . '</td>';
				$table = $table . '<td width="10%">' . $led . ' ' . $tiempo33 . '</td>';
				$table = $table . '<td class="hidden-phone">Reg: ' . strtoupper($row["presupuesto"]) . '<br>Asesor: ' . strtoupper($row["registrado"]) . '</td>';
				$table = $table . '<td width="10%" style="text-align:right;">$' . number_format($row["costo_total"]) . '<font></td>';
                                $table = $table . '<td class="hidden-phone">' . $es . '</font></td>';
				$table = $table . '<td class="hidden-phone">' . $copy . '</td>';
				$table = $table . '<td class="hidden-phone"><a title="Sacar Version de  Cotizacion" href="../../modelo/version_cotizacion.php?cod=' . $row['id_cot'] . '">' . $v . '</a></td>';
				$table = $table . '<td class="hidden-phone"><a title="Abrir Cotizacion" href="../../vistas/?id=lista_cot&abrir=' . $row['id_cot'] . '' . '">' . $open . '</a></td>';
				$table = $table . '</tr>';
			}
			$table = $table . '</table>';
			echo $table;
		}
	?>
</div>  ||