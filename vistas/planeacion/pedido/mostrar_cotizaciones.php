<?php
	include "../../../modelo/conexioni.php";
        session_start();
        $fecha_hoy = date("Y-m-d H:i:s");
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
                if ($_POST['freg'] != '') {
			$freg = ' AND a.fecha_reg_c LIKE "' . $_POST['freg'] . '%" ';
		} else {
			$freg = '';
		}
                if ($_POST['pre'] != '') {
			$pre = ' AND a.costo_total >= "' . $_POST['pre'] . '" ';
		} else {
			$pre = '';
		}
               
	$request = mysqli_query($con,'SELECT COUNT(*) FROM cotizacion a, cont_terceros b WHERE a.id_tercero = b.id_ter '. $pre . $freg . $cot . $nom . $obr . $reg . $ana . $est );
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
	function interval_date($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas  3146644438
		//floor devuelve el n�mero entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = "Hace " . floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = "Hace " . floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = "Hace " . floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = "Hace " . floor($diferencia / 86400) . " d�as";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = "Hace " . floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = "Hace " . floor($diferencia / 31104000) . " a�os";
		} else {
			$tiempo = "Error";
		}
		return $tiempo;
	}
	function interval_date2($init, $finish) {
		//formateamos las fechas a segundos tipo 1374998435
		$diferencia = strtotime($finish) - strtotime($init);
		//comprobamos el tiempo que ha pasado en segundos entre las dos fechas
		//floor devuelve el n�mero entero anterior, si es 5.7 devuelve 5
		if ($diferencia < 60) {
			$tiempo = floor($diferencia) . " segundos";
		} else if ($diferencia > 60 && $diferencia < 3600) {
			$tiempo = floor($diferencia / 60) . " minutos'";
		} else if ($diferencia > 3600 && $diferencia < 86400) {
			$tiempo = floor($diferencia / 3600) . " horas";
		} else if ($diferencia > 86400 && $diferencia < 2592000) {
			$tiempo = floor($diferencia / 86400) . " d�as";
		} else if ($diferencia > 2592000 && $diferencia < 31104000) {
			$tiempo = floor($diferencia / 2592000) . " meses";
		} else if ($diferencia > 31104000) {
			$tiempo = floor($diferencia / 31104000) . " a�os";
		} else {
			$tiempo = "Error";
		}
		  return $tiempo;
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
	$request_ac = mysqli_query($con,"SELECT * FROM cotizacion a, cont_terceros b
								WHERE a.id_tercero = b.id_ter " . $pre . $freg . $cot . $nom . $obr . $reg . $ana. $est. "
								ORDER BY $asc DESC " . $limit);
  
		if ($request_ac) {
			$table = '';
			$cont = 0;
			while($row = mysqli_fetch_array($request_ac)) {
			$cont = $cont + 1;
			$sql = 'SELECT nom_ter,cod_ter FROM cont_terceros WHERE id_ter = "' . $row['id_tercero'] . '"';
			$fil = mysqli_fetch_array(mysqli_query($con,$sql));
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
                                  $v = '<button type="button" onclick="version_cotizacion('.$row['id_cot'].')"><img width=20 heigth=20 src="../images/old_versions.png" /></button>';
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
                                        	$copy = '<button type="button"  onclick="copiar_cotizacion(' . $row['id_cot'] . ')"><img width=20 heigth=20 src="../images/copy.png" /></button>';
                                    }
				} else {
					if ($_SESSION["admin"] == 'Si') {
						$copy = '<button type="button"  onclick="copiar_cotizacion(' . $row['id_cot'] . ')"><img width=20 heigth=20 src="../images/copy.png" /></button>';
					} else {
						$copy = '';
					}
				}
				if ($row["estado"] == 'Pedido por aprobar') {
					if ($_SESSION['admin'] == 'Si' || $_SESSION["k_username"] == 'marlyp') {
						$open = '<button type="button" onclick="abrir_cotizacion(' . $row['id_cot'] . ')"><img src="../images/open.png" /></button>';
					} else {
						$open = '';
					}
				} else {
					$open = '';
				}
                                if($row['seguimiento']=='0'){
                                              $stilo = ' style="background-color:red;" ';
                                          }else{
                                               $stilo = ' style="background-color:green;" '; // LAS COTIZACIONES MAYORES A 5 MILLONES DE PESOS  LLEVAN SEGUIMIENTOS DESDE LA COTIZACION
        
                                }
                                if($_SESSION['k_username']=='TATIANA.JULIAO' || $_SESSION['k_username']=='admin'){
                                        if($row["costo_total"]>=6000000){
                                            	$sg = '<button '.$stilo.' onclick="seguir('.$row['id_cot'].');" type="button">seguimiento</button>';
					
                                        }else{
                                            $sg = '';
                                        }
					} else {
						$sg = '';
					}
//                                $crr = mysqli_query($con,"SELECT SUM(cant_restante) FROM cotizaciones WHERE id_cot ='".$row['id_cot']."' ");
//                                $cr = mysqli_fetch_array($crr);
//                                $crx = $cr['SUM(cant_restante)'];
//				  if ($crx == 0) {
//					$es = '<font color="red">En produccion';
//				  }else
//				  {
					$es = $est . '' . $row["estado"];
//				  }
                                        
                                        $btnver = '<button type="button" onclick="ver_cotizacion_pla('.$row['id_cot'].');"><img src="../images/view.png" width="15px"/> '.$row['orden'].' </button>';
                                        
                               if($row['tecnica']==''){
                                  $tec = '';
                                  }
                                  else{
                                       $tec = '-<font color="purple">'.$row['tecnica'].'</font>';
                               }
				$table = $table . '<tr>';
				$table = $table . '<td width="5%">'.$btnver.'</td>';
				$table = $table . '<td width="5%">' . $row['numero_cotizacion'] . '.' . $row["version"] .$tec.'</td>';
//				$table = $table . '<td width="5%">' . $documento . '</td>';
				$table = $table . '<td width="15%">' . strtoupper($nombre) . '<br>' . $led . ' ' . $tiempo33 . '</td>';
				$table = $table . '<td width="10%">' . strtoupper($row["obra"]) . '<font></td>';
				$table = $table . '<td width="10%">Reg :<b>' . $row["fecha_reg_c"] . '</b><br>Mod :' . $row["fecha_modificacion"] . '<br>Apro:'.$tiempo3.'</td>';
                                $table = $table . '<td class="hidden-phone">' . strtoupper($row["registrado"]) . '</td>';
				$table = $table . '<td width="10%">' . strtoupper($row["presupuesto"]) . '</td>';
				$table = $table . '<td width="10%" style="text-align:right;">$' . number_format($row["costo_total"]) . '<br>'.$sg.'</td>';
                                $table = $table . '<td class="hidden-phone">' . $es . '</font></td>';
				$table = $table . '</tr>';
			        }
	
			        echo $table;
		}
	?>
