<?php
	//echo $color_vidrio;
	//echo "<script>alert('" . $ancho_c . "' + ' - ' + '" . $alto_c . "');</script>";
	$linea = 'Vidrio';
	//echo "<script>alert('Entro " . " - " . $_GET['id'] . " - " . $id_referencia . "');</script>";
	if ($_GET['id'] != 0) {
		$id_referencia = $_GET['id'];
	} else {
		$id_referencia = $id_referencia;
	}
	$altura_v_c = $_GET['alto'];
	$alum_por = "SELECT (" . $precio_mp . ") AS p FROM porcentajes WHERE area_por = 'MP' AND grupo = 'Perfileria'";
	$fia = mysqli_fetch_array(mysqli_query($conexion,$alum_por));
	$porca = $fia["p"] / 100;
	$request = mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $id_referencia);
	if ($request) {
		$alb = 0;
		$ta =0;
		while ($row = mysqli_fetch_array($request)) {
			if ($row['signo'] == '+') {
				if ($row['medida_r_a'] == 1) {
					$al = ($altura_ventana + $row["descuento"]) + $row['variable'];
				} else {
					if ($row['medida_r_a'] == 2) {
						$al = ($altura + $row["descuento"]) + $row['variable'];
					} else {
						if ($row['lado'] != "Vertical") {
							$al = ($_GET['ancho'] + $row["descuento"]) + $row['variable'];
						} else {
							$al = ($_GET['alto'] + $row["descuento"]) + $row['variable'];
						}
					}
				}
			} else {
				if ($row['signo'] == '-') {
					if ($row['medida_r_a'] == 1) {
						$al = ($altura_ventana + $row["descuento"]) - $row['variable'];
					} else {
						if ($row['medida_r_a'] == 2) {
							$al = ($altura + $row["descuento"]) - $row['variable'];
						} else {
							if ($row['lado'] != "Vertical") {
								$al = ($_GET['ancho'] + $row["descuento"]) - $row['variable'];
							} else {
								$al = ($_GET['alto'] + $row["descuento"]) - $row['variable'];
							}
						}
					}
				} else {
					if ($row['signo'] == '*') {
						if ($row['medida_r_a'] == 1) {
							$al = ($altura_ventana + $row["descuento"]) * $row['variable'];
						} else {
							if ($row['medida_r_a'] == 2) {
								$al = ($altura + $row["descuento"]) * $row['variable'];
							} else {
								
							}
							if ($row['lado'] != "Vertical") {
								$al = ($_GET['ancho'] + $row["descuento"]) * $row['variable'];
							} else {
								$al = ($_GET['alto']+$row["descuento"])* $row['variable'];
							}
						}
					} else {
						if ($row['signo'] == '/') {
							if ($row['medida_r_a'] == 1) {
								$al = ($altura_ventana + $row["descuento"]) / $row['variable'];
							} else {
								if ($row['medida_r_a'] == 2) {
									$al = ($altura + $row["descuento"]) / $row['variable'];
								} else {
									if ($row['lado'] != "Vertical") {
										$al = ($_GET['ancho'] + $row["descuento"]) / $row['variable'];
									} else {
										$al = ($_GET['alto'] + $row["descuento"]) / $row['variable'];
									}
								}
							}
						}
					}
				}
			}
			if ($linea == 'Fachada') {
				if ($row["lado"] == 'Vertical') {
					if ($ds == '1') {
						$d = $_GET['ancho'] / ($vert + 1);
						$al5 = ($vert);
					} else {
						$d = $vert + 1;
						$al5 = $_GET['ancho'] / ($vert + 1);
					}
					$z = ceil($d);
				} else {
					if ($ds == '1') {
						$d = $_GET['alto'] / ($hori + 1);
						$al5 = ($hori);
					} else {
						$d = $hori + 1;
						$al5 = $_GET['alto'] / ($hori + 1);
					}
					$z = ceil($d);
				}
			} else {
				if ($row['lado'] == "Vertical") {
					$al5 = ($_GET['alto']);
				} else {
					$al5 = ($_GET['ancho']);
				}
				$z = 0;
			}
			$n = 1000;
			if (isset($_GET["d1"])) {
				$s = $_GET["d1"];
			} else {
				$s= 0;
			}
			if ($linea == 'Fachada') {
				$cantid = ceil($z + 1);
				$d = ($cantid * $row["cantidad"]) * $_GET['cant'];
			} else {
				$cantid = ceil($z + $row["cantidad"]);
				$d = ($cantid) * $can;
			}
			$mp = $row["costo_mt"] / $porca;
			$ta = $ta + ($al * $mp * (($d)) / $n);
			$numero = (($d) * $al5) / $row["medida"];
		}
	}
	//echo '$altura_ventana'.$altura_ventana.'<br>';
	//echo '$altura'.$altura.'<br>';
	//echo 'Porcentaje'.$porca.'<br>';
	//echo 'mp'.$mp.'<br>';
	//echo 'numero'.$numero.'<br>';
	//echo '$al5'.$al5.'<br>';
	//echo '$al'.$al.'<br>';
	//echo 'Perfiles'.$ta.'<br>';
	////    PERFILES     ----------------------------------------------<-<-<<<<-<<--<>>>>
	$vidrio_por = "SELECT (" . $precio_mp . ") AS p FROM porcentajes WHERE area_por = 'MP' AND grupo = 'Vidrios'";
	$fip = mysqli_fetch_array(mysqli_query($conexion,$vidrio_por));
	$porcv = $fip["p"] / 100;
	$request_v = mysqli_query($conexion,"SELECT * FROM producto a, producto_rep_vid b, referencias c WHERE b.id_ref_vid = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $id_referencia); 
	if ($request_v) {
		$total_vid = 0;
		$cf = 0;
		$al2 = 0;
		while ($row = mysqli_fetch_array($request_v)) {
			$cf += 1;
			if ($cf!=$modulo) {
				$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $id_vidrio . "'";
				$fi3 = mysqli_fetch_array(mysqli_query($conexion,$s3));
				$costo_vidrio = $fi3["costo_v"] / $porcv;
				$color_v = $fi3["color_v"];
				$traz = $traz_vid;
			} else {
				$s3 = "SELECT * FROM tipo_vidrio WHERE id_vidrio = '" . $id2_vidrio . "'";
				$fi3 = mysqli_fetch_array(mysqli_query($conexion,$s3));
				$costo_vidrio = $fi3["costo_v"] / $porcv;
				$color_v = $fi3["color_v"];
				$traz = $traz_vid2;
			}
			if ($row["ancho_v"] == 0) {
				$alb = $aa;
				if ($row["utilizar"] == 0) {
					$al = 0;
				} else {
					$al = $_GET['anchohid']; //aqui esta el dividendo
				}
			} else {
				$sqlx = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $id_referencia . " AND b.id_r_a = " . $row["ancho_v"] . "");
				$fil_an = mysqli_fetch_array(mysqli_query($conexion,$sqlx));
				$id_p = $fil_an["id_p"];
				if ($fil_an['signo'] == '+') {
					if ($fil_an['medida_r_a'] == 1) {
						$al = ($altura_v_c + $fil_an["descuento"]) + $fil_an['variable'];
					} else {
						if ($fil_an['medida_r_a'] == 2) {
							$al = ($altura + $fil_an["descuento"]) + $fil_an['variable'];
						} else {
							if ($fil_an['lado'] != "Vertical") {
								$al = ($_GET['ancho'] + $fil_an["descuento"]) + $fil_an['variable'];
								$alb = ($aa + $fil_an["descuento"]) + $fil_an['variable'];
							} else {
								$al = ($_GET['alto'] + $fil_an["descuento"]) + $fil_an['variable'];
							}
						}
					}
				} else {
					if ($fil_an['signo'] == '-') {
						if ($fil_an['medida_r_a'] == 1) {
							$al = ($altura_v_c + $fil_an["descuento"]) - $fil_an['variable'];
						} else {
							if ($fil_an['medida_r_a'] == 2) {
								$al = ($altura + $fil_an["descuento"]) - $fil_an['variable'];
							} else {
								if ($fil_an['lado'] != "Vertical") {
									$al = ($_GET['ancho'] + $fil_an["descuento"]) - $fil_an['variable'];
									$alb = ($aa + $fil_an["descuento"]) - $fil_an['variable'];
								} else {
									$al = ($_GET['alto'] + $fil_an["descuento"]) - $fil_an['variable'];
								}
							}
						}
					} else {
						if ($fil_an['signo'] == '*') {
							if ($fil_an['medida_r_a'] == 1) {
								$al = ($altura_v_c + $fil_an["descuento"]) * $fil_an['variable'];
							} else {
								if ($fil_an['medida_r_a'] == 2) {
									$al = ($altura + $fil_an["descuento"]) * $fil_an['variable'];
								} else {
									
								}
								if ($fil_an['lado'] != "Vertical") {
									$al = ($_GET['ancho'] + $fil_an["descuento"]) * $fil_an['variable'];
									$alb = ($aa + $fil_an["descuento"]) * $fil_an['variable'];
								} else {
									$al = ($_GET['alto'] + $fil_an["descuento"]) * $fil_an['variable'];
								}
							}
						} else {
							if ($fil_an['signo'] == '/') {
								if ($fil_an['medida_r_a'] == 1) {
									$al = ($altura_v_c + $fil_an["descuento"]) / $fil_an['variable'];
								} else {
									if ($fil_an['medida_r_a'] == 2) {
										$al = ($altura + $fil_an["descuento"]) / $fil_an['variable'];
									} else {
										if ($fil_an['lado'] != "Vertical") {
											$al = ($_GET['ancho'] + $fil_an["descuento"]) / $fil_an['variable'];
											$alb = ($aa + $fil_an["descuento"]) / $fil_an['variable'];
										} else {
											$al = ($_GET['alto'] + $fil_an["descuento"]) / $fil_an['variable'];
										}
									}
								}
							}
						}
					}
				}
			}
			//if ($fil_an['lado'] == "Vertical") {
				//$al2 = ($_GET['alto'] + $fil_an["descuento"]);
			//} else {
				//$al2 = ($_GET['ancho'] + $fil_an["descuento"]);
				//$al2b = ($aa) + $fil_an['variable'];
			//}
			$tv = $al + $row['var1'];
			$tvb = $alb + $row['var1'];
			if ($row["alto_v"] == 0) {
				$al2 = $_GET['alto'];
				$al2b = $aa;
			} else {
				$sqlw = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $id_referencia . " AND b.id_r_a = " . $row["alto_v"] . "");
				$fil_al = mysqli_fetch_array(mysqli_query($conexion,$sqlw));
				if ($fil_al['signo'] == '+') {
					if ($fil_al['medida_r_a'] == 1) {
						$al2 = ($altura_ventana + $fil_al["descuento"]) + $fil_al['variable'];
					} else {
						if ($fil_al['medida_r_a'] == 2) {
							$al2 = ($altura + $fil_al["descuento"]) + $fil_al['variable'];
						} else {
							if ($fil_al['lado'] != "Vertical") {
								$al2 = ($_GET['ancho'] + $fil_al["descuento"]) + $fil_al['variable'];
								$al2b = ($aa + $fil_al["descuento"]) + $fil_al['variable'];
							} else {
								$al2 = ($_GET['alto'] + $fil_al["descuento"]) + $fil_al['variable'];
							}
						}
					}
				} else {
					if ($fil_al['signo'] == '-') {
						if ($fil_al['medida_r_a'] == 1) {
							$al2 = ($altura_ventana + $fil_al["descuento"]) - $fil_al['variable'];
						} else {
							if ($fil_al['medida_r_a'] == 2) {
								$al2 = ($altura + $fil_al["descuento"]) - $fil_al['variable'];
							} else {
								if ($fil_al['lado'] != "Vertical") {
									$al2 = ($_GET['ancho'] + $fil_al["descuento"]) - $fil_al['variable'];
									$al2b = ($aa + $fil_al["descuento"]) - $fil_al['variable'];
								} else {
									$al2 = ($_GET['alto'] + $fil_al["descuento"]) - $fil_al['variable'];
								}
							}
						}
					} else {
						if ($fil_al['signo'] == '*') {
							if ($fil_al['medida_r_a'] == 1) {
								$al2 = ($altura_ventana + $fil_al["descuento"]) * $fil_al['variable'];
							} else {
								if ($fil_al['medida_r_a'] == 2) {
									$al2 = ($altura + $fil_al["descuento"]) * $fil_al['variable'];
								} else {
									
								}
								if ($fil_al['lado'] != "Vertical") {
									$al2 = ($_GET['ancho'] + $fil_al["descuento"]) * $fil_al['variable'];
									$al2b = ($aa + $fil_al["descuento"]) * $fil_al['variable'];
								} else {
									$al2 = ($_GET['alto'] + $fil_al["descuento"]) * $fil_al['variable'];
								}
							}
						} else {
							if ($fil_al['signo'] == '/') {
								if ($fil_al['medida_r_a'] == 1) {
									$al2 = ($altura_ventana + $fil_al["descuento"]) / $fil_al['variable'];
								} else {
									if ($fil_al['medida_r_a'] == 2) {
										$al2 = ($altura + $fil_al["descuento"]) / $fil_al['variable'];
									} else {
										if ($fil_al['lado'] != "Vertical") {
											$al2 = ($_GET['ancho'] + $fil_al["descuento"]) / $fil_al['variable'];
											$al2b = ($aa + $fil_al["descuento"]) / $fil_al['variable'];
										} else {
											$al2 = ($_GET['alto'] + $fil_al["descuento"]) / $fil_al['variable'];
										}
									}
								}
							}
						}
					}
				}
			}
			//--------------------------------------------------------------------------part 2--------------------------------------------
			if ($row['ancho_v2'] != 0) {
				$sqlx2 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $id_referencia . " AND b.id_r_a = " . $row["ancho_v2"] . "");
				$fil_an2 = mysqli_fetch_array(mysqli_query($conexion,$sqlx2));
				if ($fil_an2['signo'] == '+') {
					if ($fil_an2['medida_r_a'] == 1) {
						$al22 = ($altura_v_c + $fil_an2["descuento"]) + $fil_an2['variable'];
					} else {
						if ($fil_an2['medida_r_a'] == 2) {
							$al22 = ($altura + $fil_an2["descuento"]) + $fil_an2['variable'];
						} else {
							if ($fil_an2['lado'] != "Vertical") {
								$al22 = ($_GET['ancho'] + $fil_an2["descuento"]) + $fil_an2['variable'];
								$al22b = ($aa + $fil_an2["descuento"]) + $fil_an2['variable'];
							} else {
								$al22 = ($_GET['alto'] + $fil_an2["descuento"]) + $fil_an2['variable'];
							}
						}
					}
				} else {
					if ($fil_an2['signo'] == '-') {
						if ($fil_an2['medida_r_a'] == 1) {
							$al22 = ($altura_v_c + $fil_an2["descuento"]) - $fil_an2['variable'];
						} else {
							if ($fil_an2['medida_r_a'] == 2) {
								$al22 = ($altura + $fil_an2["descuento"]) - $fil_an2['variable'];
							} else {
								if ($fil_an2['lado'] != "Vertical") {
									$al22 = ($_GET['ancho'] + $fil_an2["descuento"]) - $fil_an2['variable'];
									$al22b = ($aa + $fil_an2["descuento"]) - $fil_an2['variable'];
								} else {
									$al22 = ($_GET['alto'] + $fil_an2["descuento"]) - $fil_an2['variable'];
								}
							}
						}
					} else {
						if ($fil_an2['signo'] == '*') {
							if ($fil_an2['medida_r_a'] == 1) {
								$al22 = ($altura_v_c + $fil_an2["descuento"]) * $fil_an2['variable'];
							} else {
								if ($fil_an2['medida_r_a'] == 2) {
									$al22 = ($altura + $fil_an2["descuento"]) * $fil_an2['variable'];
								} else{
									
								}
								if ($fil_an2['lado'] != "Vertical") {
									$al22 = ($_GET['ancho'] + $fil_an2["descuento"]) * $fil_an2['variable'];
									$al22b = ($aa + $fil_an2["descuento"]) * $fil_an2['variable'];
								} else {
									$al22 = ($_GET['alto'] + $fil_an2["descuento"]) * $fil_an2['variable'];
								}
							}
						} else {
							if ($fil_an2['signo'] == '/') {
								if ($fil_an2['medida_r_a'] == 1) {
									$al22 = ($altura_v_c + $fil_an2["descuento"]) / $fil_an2['variable'];
								} else {
									if ($fil_an2['medida_r_a'] == 2) {
										$al22 = ($altura + $fil_an2["descuento"]) / $fil_an2['variable'];
									} else {
										if ($fil_an2['lado'] != "Vertical") {
											$al22 = ($_GET['ancho'] + $fil_an2["descuento"]) / $fil_an2['variable'];
											$al22b = ($aa + $fil_an2["descuento"]) / $fil_an2['variable'];
										} else {
											$al22 = ($_GET['alto'] + $fil_an2["descuento"]) / $fil_an2['variable'];
										}
									}
								}
							}
						}
					}
				}
			} else {
				$al22 = 0;
				$al22b = 0;
			}
			if ($row['alto_v2']!=0) {
				$sqlw2 = ("SELECT * FROM producto a, producto_rep_alu b, referencias c WHERE b.id_ref_alum = c.id_referencia AND a.id_p = b.id_p AND a.id_p = " . $id_referencia . " AND b.id_r_a = " . $row["alto_v2"] . "");
				$fil_al2 = mysqli_fetch_array(mysqli_query($conexion,$sqlw2));
				if ($fil_al2['signo'] == '+') {
					if ($fil_al2['medida_r_a'] == 1) {
						$al2x = ($altura_v_c + $fil_al2["descuento"]) + $fil_al2['variable'];
					} else {
						if ($fil_al2['medida_r_a'] == 2) {
							$al2x = ($altura + $fil_al2["descuento"]) + $fil_al2['variable'];
						} else {
							if ($fil_al2['lado'] != "Vertical") {
								$al2x = ($_GET['ancho'] + $fil_al2["descuento"]) + $fil_al2['variable'];
								$al2xb = ($aa + $fil_al2["descuento"]) + $fil_al2['variable'];
							} else {
								$al2x = ($_GET['alto'] + $fil_al2["descuento"]) + $fil_al2['variable'];
							}
						}
					}
				} else {
					if ($fil_al2['signo'] == '-') {
						if ($fil_al2['medida_r_a'] == 1) {
							$al2x = ($altura_v_c + $fil_al2["descuento"]) - $fil_al2['variable'];
						} else {
							if ($fil_al2['medida_r_a'] == 2) {
								$al2x = ($altura + $fil_al2["descuento"]) - $fil_al2['variable'];
							} else {
								if ($fil_al2['lado'] != "Vertical") {
									$al2x = ($_GET['ancho'] + $fil_al2["descuento"]) - $fil_al2['variable'];
									$al2xb = ($aa + $fil_al2["descuento"]) - $fil_al2['variable'];
								} else {
									$al2x = ($_GET['alto'] + $fil_al2["descuento"]) - $fil_al2['variable'];
								}
							}
						}
					} else {
						if ($fil_al2['signo'] == '*') {
							if ($fil_al2['medida_r_a'] == 1) {
								$al2x = ($altura_v_c + $fil_al2["descuento"]) * $fil_al2['variable'];
							} else {
								if ($fil_al2['medida_r_a'] == 2) {
									$al2x = ($altura + $fil_al2["descuento"]) * $fil_al2['variable'];
								} else {
									
								}
								if ($fil_al2['lado'] != "Vertical") {
									$al2x = ($_GET['ancho'] + $fil_al2["descuento"]) * $fil_al2['variable'];
									$al2xb = ($aa + $fil_al2["descuento"]) * $fil_al2['variable'];
								} else {
									$al2x = ($_GET['alto'] + $fil_al2["descuento"]) * $fil_al2['variable'];
								}
							}
						} else {
							if ($fil_al2['signo'] == '/') {
								if ($fil_al2['medida_r_a'] == 1) {
									$al2x = ($altura_v_c + $fil_al2["descuento"]) / $fil_al2['variable'];
								} else {
									if ($fil_al2['medida_r_a'] == 2) {
										$al2x = ($altura + $fil_al2["descuento"]) / $fil_al2['variable'];
									} else {
										if ($fil_al2['lado'] != "Vertical") {
											$al2x = ($_GET['ancho'] + $fil_al2["descuento"]) / $fil_al2['variable'];
											$al2xb = ($aa + $fil_al2["descuento"]) / $fil_al2['variable'];
										} else {
											$al2x = ($_GET['alto'] + $fil_al2["descuento"]) / $fil_al2['variable'];
										}
									}
								}
							}
						}
					}
				}
			} else {
				$al2x = 0;
			}
			$tv = ($al + $row['var1']) / $row['divisor'];
			$tv2 = ($al2 + $row['var2']) / $row['divisor_alto'];
			$tvb = ($alb + $row['var1']) / $row['divisor'];
			//$tv2b = ($al2b + $row['var2']) / $row['divisor_alto'];
			if (isset($al22)) {
				$n = $al22;
				$an2 = $tv - $n;
				$nb = $al22;
				$an2b = $tvb - $nb;
			} else {
				$n = 0;
				$an2 = $tv;
				$an2b = $tvb;
			}
			$nx = $al2x;
			$all = $tv2 - $nx;
			//if ($fil_al['lado'] == "Vertical") {
			//	al3 = ($_GET['alto'] + $fil_al["descuento"]);
			//} else {
			//	$al3 = ($_GET['ancho'] + $fil_al["descuento"]);
			$sqlv = ("SELECT * FROM producto a, cotizaciones c WHERE c.traz_vid = a.id_p AND c.id_cotizacion in (" . $_GET["ord"].")");
			$fila21 = mysqli_fetch_array(mysqli_query($conexion,$sqlv));
			$sqlw = "SELECT MAX(item_unico) FROM orden_detalle WHERE id_op in (" . $_GET["ord"] . ")";
			$filaw = mysqli_fetch_array(mysqli_query($conexion,$sqlw));
			$maxiv = $filaw["MAX(item_unico)"] + 1;
			if ($traz_vid != $id_referencia) {
				$n = 1;
			} else {
				$n = 0;
			}
			//echo "<script>alert('an2 -> '".$an2." -- an2b -> ".$an2b.");</script>";
			if ($traz_vid != $id_referencia) {
				$mt2 = (number_format(round($ancho_c / 1000, 2), 2, ',', '') * number_format(round(($alto_c / 1000), 2), 2, ',', '')) * $_GET["cantidad"];
				$sqlv6 = "INSERT INTO `orden_detalle`(`medida1_producto`,`medida2_producto`,`mt2`,`id_prod_cambio`,`ubic`, `observaciones`, `parte_otro`, `estado_op`, `id_producto`, `relacionado`, `sede_od`, `asignado`,`descripcion`,`codigo`, `item_unico`, `producto_od`, `cantidad`, `cant_ordenada`, `medida1`, `medida2`, `medida3`, `medida4`, `color`,  `id_proceso`,`id_op`,`tipo_items`,`perforacion_item`,`boquete_item`)";
				//$sqlv6.= "VALUES ('".$id_ref_cambio."', '".$ubic."', '".$n."', '1', '".$traz."', '".$_GET["ord"]."', '".$area."', '".$user."','".$obs."','".$codigo."', '".$maxiv."', '".$producto."', '".$tc."', '".$can."', '".$an2."', '".$all."', '".$espesor."', '".$an2b."', '".$color_v."', '".$id_referencia."', '".$_GET["ord"]."')";
				//$sqlv6.= "VALUES ('".$id_ref_cambio."', '".$ubic."', '".$n."', '1', '".$traz."', '".$_GET["ord"]."', '".$area."', '".$user."','".$obs."','".$codigo."', '".$maxiv."', '".$producto."', '".$tc."', '".$can."', '".$an2."', '".$all."', '".$espesor."', '".$an2b."', '".$colors_seconds[$lam]."', '".$id_referencia."', '".$_GET["ord"]."')";
				$sqlv6.= "VALUES ('".$ancho_c."', '".$alto_c."', '".$mt2."', '".$id_ref_cambio."', '".$ubic."', '".$obs."', '".$n."', '1', '".$traz."', '".$_GET["ord"]."', '".$area."', '".$user."','".$obs."','".$codigo."', '".$maxiv."', '".$producto."', '".$tc."', '".$can."', '".$an2."', '".$all."', '".$espesor."', '".$an2b."', '".$colors_seconds[$lam]."', '".$id_referencia."', '".$_GET["ord"]."', '".$tipo_vx."', '".$_GET["per"]."', '".$_GET["boq"]."')";
				mysqli_query($conexion,$sqlv6);
				$sqltv = "SELECT MAX(id_orden_d) FROM orden_detalle";
				$filatv = mysqli_fetch_array(mysqli_query($conexion,$sqltv));
        		$maxv = $filatv["MAX(id_orden_d)"];
				//echo 'orden max'.$maxv.'<br>';
				$n = $_GET["cantidad"];
				$por = 100 / $n;
				$paso = 1;
				for ($x=1; $x<=$n; $x=$x+1) {
					//echo 'item unico'. $maxiv.' cantidad: '.$can.'<br>';
					$producto = 'Especificacion # ' .$maxiv;
					$barras = $maxv . '' . $maxiv;
                                        $y =str_pad($x, 3, "0", STR_PAD_LEFT);
					$it2 = $barras .$y;
					$sql1v = "INSERT INTO `procesos_activos`(`barra_item`, `area_proceso`,  `barra`, `paso`,`id_op`, `id_orden_d`, `item`, `codigo`, `porcentaje`, `hora_in`, fecha_in, `fecha_llegada`, hora_llegada, llegada, usuario, item_child_count)";
					$sql1v.= "VALUES ('".$it2."', 'Vidrio', '".$barras."','".$paso."','".$_GET['op']."', '".$maxv."', '".$x."', '".$codigo.''.$x."', '".$por."', '".date("H:i:s")."', '".date("Y-m-d")."', '".date("Y-m-d")."', '".date("H:i:s")."', '".date("Y-m-d H:i:s")."', '".$user."', '".$item_child_count."')";
					mysqli_query($conexion,$sql1v);
				}
				// fin de codigo -------------------------------------------------------------------------------
				$m2 = ($an2 / 1000) * ($all / 1000);
			}
		}
	}
//echo 'tttt :'.$tv2.'<br>';
//echo 'Vidrios'.$total_vid.'<br>';
     ///    FIN DE VIDRIOS----------------------------------->>>>>>>>>>>>>>