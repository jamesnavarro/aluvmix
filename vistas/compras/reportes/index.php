<?php
include '../../../modelo/conexioni.php';
 session_start();
  if(!isset($_SESSION['k_username']))
      { 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
?>   
<?php    
 $request = mysqli_query($con,"SELECT count(*) FROM orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden and a.ordenfom like '%".$_GET['sol']."' and a.nom_ter like '%".$_GET['pro']."%'  and b.codigo like '%".$_GET['cod']."%' and b.descripcion like '%".$_GET['des']."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            //wiston 
            $rows_by_page = 12;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden  and a.ordenfom like '%".$_GET['sol']."' and a.nom_ter like '%".$_GET['pro']."%'  and b.codigo like '%".$_GET['cod']."%' and b.descripcion like '%".$_GET['des']."%' order by b.codigo_orden desc " .$limit );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
                $query = mysqli_query($con, "select mod_fec, b.codigo,ordenfom from orden_compra_detalle a, orden_compra b where a.codigo_orden=b.codigo and a.id_sol='".$fila['id_sol']."' and a.codigo='".$fila['codigo']."' and a.color='".$fila['color']."' and a.medida='".$fila['medida']."'  ");
                $f = mysqli_fetch_array($query);
                $opf = substr($f[2],-5);
                $op = $f[1];
                $queryorden = mysqli_query($con, "select fecha_pro from mov_inventario where id_orden ='$op' or id_orden='$opf'  ");
                $o = mysqli_fetch_array($queryorden);
                if($fila['estado']=='En Proceso'){
                    $tiempos = 'x';
                    $tiempos2 = 'x';
                    $tiempos3 = 'x';
                    $FechaAprobada = '';
                    $FechaOrden = '';
                    $FechaEntrada = '';
                    
                }else{
                    $tiempos = interval_date($fila['date_added'], $fila['fecha_aprobada']);
                    $tiempos2 = interval_date2($fila['date_added'], $f[0]);
                    
                    $FechaAprobada = $fila['fecha_aprobada'];
                    $FechaOrden = $f[0];
                    $FechaEntrada = $o[0];
                    if($o){
                        $tiempos3 = interval_date2($fila['date_added'], $o[0]);
                    }else{
                        $tiempos3 = 'x';
                    }
                }
                
              
                echo '<tr style="background:#'.$color.'">'
                . '<td>'.$fila['nom_ter'].'</td>'
                . '<td nowrap>'.$fila['ordenfom'].'</td>'
                . '<td>'.$fila['codigo'].'</td>'
                . '<td>'.$fila['descripcion'].'<br>'.$fila['estado'].' '.$fila['aprobado_por'].'</td>'
                . '<td>'.$fila['mod_fec'].'</td>'  
                . '<td>'.$fila['cantidad'].'</td>'
                . '<td>'.($fila['cantidad_rec']).'</td>'
                        . '<td>'.number_format($fila['precio'],0,',','.').'</td>'
                        . '<td>'.number_format($fila['cantidad_rec']*$fila['precio'],0,',','.').'</td>'
                        . '<td><button class="btn btn-inverse" onclick="printer('.$fila['codigo'].');" ><i class="glyphicon glyphicon-print"></i></button></td>';
                echo "</tr>";
  }



?>
<script src="../vistas/compras/reportes/funciones.js?<?php echo rand(1,200) ?>"></script>
<div class="panel panel-info">
		<div class="panel-body"> 
		  
                          <!-- CONTENIDO DENTRO DE TABINDEX2 -->
                              <table class="table table-hover">
                                <tr class="bg-info">
                                        <th>PROVEEDOR</th>
                                        <th>OBSERVACION</th>
					<th>ORDEN</th>
					<th>CODIGO</th>
                                        <th>DESCRIPCION</th>
                                        <th>FECHA REGISTRO</th>
					<th>CANT PED</th>
                                        <th>CANT REC</th>
                                        <th>VLR UND</th>
                                        <th>VLR TOTAL</th>
                                </tr>
                                 <tr>
                                      <td><input type="text" id="n_pro" placeholder="" style="width:100%"/></td>
                                      <td><input type="text" id="n_obs" placeholder="" style="width:100%"/></td> 
                                      <td><input type="text" id="n_sol" placeholder="" style="width:100%"/></td>
                                      <td><input type="text" id="n_cod" placeholder="" style="width:100%"/></td>
                                      <td><input type="text" id="n_des" placeholder="" style="width:100%"/></td>
                                      <td><input type="date" id="n_fech" placeholder="" style="width:100%"/></td> 
                                      <td>-</td> 
                                      <td>-</td> 
                                     
                                      <td><button class="btn btn-inverse" onclick="printer();" ><i class="glyphicon glyphicon-print"></i></button></td> 
                                     
                                </tr>
                               <tbody id="mostrar_tabla2">
                               </tbody>
                            </table>
                          <!-- FIN DE CONTENIDO -->   
		</div>
</div>
	
