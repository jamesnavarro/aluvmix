<?php
include('../../../../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            $orden = $_GET['orden'];
             $orden = str_pad($orden, 9, "0", STR_PAD_LEFT);
            $rad = $_GET['rad'];
$request=mysqli_query($con,"SELECT count(*) FROM orden_compra a, orden_compra_detalle b  where a.codigo=b.codigo_orden and codigo_orden like '%".$_GET['nombre']."%' and a.ordenfom='$orden' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../../../../images/a1.png"  onclick="MostrarUsuarios2(1)" style="cursor: pointer;">
                        <img src="../../../images/a11.png"  onclick="MostrarUsuarios2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../../../../images/p1.png"  onclick="MostrarUsuarios2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../../../images/p11.png" onclick="MostrarUsuarios2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th><?php echo $orden ?></th>
                                        <th>FECHA</th>
                                        <TH>PRODUCTO</TH>
                                        <TH>COLOR</TH>
                                        <TH>PRECIO</TH>
                                        <TH>CANTIDAD</TH>
                                        <TH>C.P</TH>
                                        <TH>C.AGREGAR</TH>
                                        <TH>OPC</TH>
               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($rad==''){
                                        $disa = 'disabled';
                                    }  else {
                                        $disa = '';
                                    }

                        $sql = mysqli_query($con,"SELECT *,b.codigo FROM orden_compra a, orden_compra_detalle b  where a.codigo=b.codigo_orden and codigo_orden like '%".$_GET['nombre']."%' and a.ordenfom='$orden' ".$limit);
			$item = 0;
                        $bod = '';
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                    if($mostrar['cantidad_pend']==0){
                                        $disable = 'disabled';
                                    }else{
                                        $disable = $disa;
                                    }
                                   $ordens = $mostrar['codigo'];
                                    $bod = "'".$mostrar['bod_codigo']."'";
                                        $precio = $mostrar['precio'];
					echo '<tr><input type="hidden" id="des'.$mostrar['id_oc_de'].'"  value="'.$mostrar['descripcion'].'">
                                            <input type="hidden" id="med'.$mostrar['id_oc_de'].'"  value="'.$mostrar['medida'].'">
                                                <input type="hidden" id="col'.$mostrar['id_oc_de'].'"  value="'.$mostrar['color'].'">
                                                    <input type="hidden" id="bod'.$mostrar['id_oc_de'].'"  value="'.$mostrar['bod_codigo'].'">
                                                        <input type="hidden" id="cod'.$mostrar['id_oc_de'].'"  value="'.$mostrar['codigo'].'">
                                                            <input type="hidden" id="pre'.$mostrar['id_oc_de'].'"  value="'.$precio.'">
                                        <td>'.$mostrar['codigo'].'</td>
                                        <td>'.$mostrar['fecha'].'</td>'
                                        . '<td>'.$mostrar['descripcion'].'</td>'
                                                . '<td>'.$mostrar['color'].'</td>'
                                                 . '<td>'.$precio.'</td>'
                                        . '<td>'.$mostrar['cantidad'].'</td>'
                                        . '<td><input type="text" id="pcant'.$mostrar['id_oc_de'].'" disabled style="width: 70px" value="'.$mostrar['cantidad_pend'].'"></td>'
                                        . '<td><input type="text" id="ncant'.$mostrar['id_oc_de'].'" onchange="veri('.$mostrar['id_oc_de'].')" '.$disa.' style="width: 70px" value="'.$mostrar['cantidad_pend'].'"></td>'
                                        . '<td><input type="checkbox" name="item" id="'.$mostrar['id_oc_de'].'" '.$disable.' style="width: 100px"></td>';}
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    echo '<tr><td colspan="7"></td><td style="text-align:center"><button '.$disa.' onclick="agregar_productos('.$rad.',0)">Recibir</button></td></tr>';
                                    ?>
                                </tbody>
                            </table>
                        
