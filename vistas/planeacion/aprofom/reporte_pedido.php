<?php
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reporte_pedido.xls"');
header('Cache-Control: max-age=0');

	include "../../../modelo/conexionv1.php";
        session_start();
        $fecha_hoy = date("Y-m-d H:i:s");
		if ($_GET['cot'] != '') {
			$cot = ' AND a.numero_cotizacion = "' . $_GET['cot'] . '" ';
                         $asc = '  a.version ';
		} else {
			$cot = '';
                         $asc = '  a.numero_cotizacion ';
		}
		if ($_GET['nom'] != '') {
			$nom = ' AND CONCAT(b.nom_ter, " ", a.nom_temp) LIKE "%' . $_GET['nom'] . '%" ';
		} else {
			$nom = '';
		}
		if ($_GET['obr'] != '') {
			$obr = ' AND a.obra LIKE "%'.$_GET['obr'].'%" ';
		} else {
			$obr = '';
		}
		if ($_GET['reg'] != '') {
			$reg = ' AND a.registrado = "' . $_GET['reg'] . '" ';
		} else {
			$reg = '';
		}
                if ($_GET['ped'] != '') {
			$pedi = ' AND a.pedido like "%' . $_GET['ped'] . '" ';
		} else {
			$pedi = '';
		}
                if($_SESSION['area']=='Planeacion' || $_SESSION['area']=='Presupuesto' || $_SESSION['k_username']=='TATIANA.JULIAO'|| $_SESSION['admin']=='Si'){
                       if ($_GET['ana'] != '') {
                            $ana = ' AND a.presupuesto = "' . $_GET['ana'] . '" ';
                    } else {
                            $ana = '';	
                    } 
                }else{
                    $ana = ' AND a.presupuesto = "' . $_SESSION['k_username'] . '" ';
                }
                if ($_GET['est'] != '') {
			$est = ' AND a.estado = "' . $_GET['est'] . '" ';
		} else {
			$est = '';
		}
                if ($_GET['freg'] != '' && $_GET['fregf'] != '') {
			$freg = ' AND a.ped_fechapedido >= "'.$_GET['freg'].'" AND a.ped_fechapedido <= "'.$_GET['fregf'].'" ';
		} else {
			$freg = '';
		}
                if ($_GET['pre'] != '') {
			$pre = ' AND a.costo_total >= "' . $_GET['pre'] . '" ';
		} else {
			$pre = '';
		}

        echo '<table class="table">
			<thead>
			<tr class="bg-info">
			<th width="5%">COTIZACION</th>
                        <th width="5%">PEDIDO</th>
			<th width="15%">CLIENTES</th>
			<th width="30%" nowrap>NOMBRE DE LA OBRA</th>
			<th width="30%">FECHA REGISTRO</th>
                        <th width="30%">FECHA MODIFICACION</th>
                        <th width="30%">FECHA APROBADO</th>
			<th width="5%">GENERADO</th>
			<th width="10%">ESTADO</th>
			<th class="hidden-phone">OBSERVACIONES</th>
                        <th class="hidden-phone">COD-VENDEDOR</th>
                        <th class="hidden-phone">SEDE</th>
                         <th class="hidden-phone">SUCURSAL</th>
                          <th class="hidden-phone">BODEGA</th>
                           <th class="hidden-phone">CENTRO COSTO</th>
			</tr>';
  
	$request_ac = mysqli_query($con2,"SELECT * FROM cotizacion a, cont_terceros b
                                          WHERE a.id_tercero = b.id_ter and a.pedido!='' " . $pre . $freg . $cot . $nom . $obr . $reg . $ana. $est. $pedi."
                                          ORDER BY pedido DESC " );
  
		if ($request_ac) {
			$table = '';
			$cont = 0;
			while($row = mysqli_fetch_array($request_ac)) {
			$cont = $cont + 1;
			$sql = 'SELECT nom_ter,cod_ter FROM cont_terceros WHERE id_ter = "' . $row['id_tercero'] . '"';
			$fil = mysqli_fetch_array(mysqli_query($con2,$sql));
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
                                  $v = '';
                                  }	
				}
				if ($row["copia"] == 0) {
					$c = '';
				} else {
					$c = $row["copia"];
				}
				
				
				
					
				
				if ($row["estado"] == 'En proceso') {
                                   
				} else {
					
				}
				if ($row["estado"] == 'Pedido por aprobar') {
					if ($_SESSION['admin'] == 'Si' || $_SESSION["k_username"] == 'marlyp') {
						$open = '';
					} else {
						$open = '';
					}
				} else {
					$open = '';
				}
                                if($row['seguimiento']=='0'){
                                              $stilo = ' style="background-color:red;" ';
                                          }else{
                                               $stilo = ' style="background-color:green;" ';
        
                                }
                                if($_SESSION['k_username']=='TATIANA.JULIAO' || $_SESSION['k_username']=='admin'){
                                        if($row["costo_total"]>=6000000){
                                            	$sg = '';
					
                                        }else{
                                            $sg = '';
                                        }
					} else {
						$sg = '';
					}

					$es = $est . '' . $row["estado"];

                                        $linea="'".$row['linea']."'";
                                        if($row['pedido']==''){
                                           
                                            
                                        }else{
                                            $pedi = $row['tipopedido'].$row['pedido'];
                                        }
                                        if($row['tecnica']==''){
                                            $tec = '';
                                        }
                                        else{
                                            $tec = '-<font color="purple">'.$row['tecnica'].'</font>';
                                            }
                                            
                               
                                            
           
				$table = $table . '<tr>';
				
				$table = $table . '<td width="5%">' . $row['numero_cotizacion'] . '.' . $row["version"] .$tec.'</td>';
				$table = $table . '<td width="5%">' . $row['tipopedido'].$row['pedido'] . '</td>';
				$table = $table . '<td width="15%">' . strtoupper($nombre) . '<br> </td>';
				$table = $table . '<td width="10%">' . strtoupper($row["obra"]) . '<font></td>';
				$table = $table . '<td width="10%"><b>' . $row["fecha_reg_c"] . '</b><td width="10%">' . $row["fecha_modificacion"] . '<td width="10%">' . $row["ped_fechapedido"] . '</td>';
                                $table = $table . '<td class="hidden-phone"><b>' . ($row["ped_registrado"]) . '</td>';
				$table = $table . '<td width="10%">' . strtoupper($row["estado"]) . '</td>';
//				$table = $table . '<td width="10%" style="text-align:right;">$' . number_format($row["costo_total"]) . '<br>'.$sg.'</td>';
                                $table = $table . '<td class="hidden-phone">'.$row['ped_obs'].'</td>';
                                $table = $table . '<td class="hidden-phone">'.$row['ped_vendedor'].'</td>';
                                $table = $table . '<td class="hidden-phone">'.$row['ped_municipio'].'</td>';
                                $table = $table . '<td class="hidden-phone">'.$row['ped_sucursal'].'</td>';
                                $table = $table . '<td class="hidden-phone">'.$row['ped_alm'].'</td>';
                                $table = $table . '<td class="hidden-phone">'.$row['ped_centro'].'</td>';
	
				$table = $table . '</tr>';
			        }
	
			        echo $table;
		}
	?>
 </table>