<?php
include('../../../../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysqli_query($con,"SELECT count(*) FROM productos_var where concat(descripcion,' ',codigo) like '%".$_GET['nombre']."%' and referencia like '%".$_GET['referencia']."%' and color like '%".$_GET['color']."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../../../images/a1.png"  onclick="MostrarUsuarios2(1)" style="cursor: pointer;">
                        <img src="../../../images/a11.png" onclick="MostrarUsuarios2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                    <img src="../../../images/p1.png"  onclick="MostrarUsuarios2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                    <img src="../../../images/p11.png" onclick="MostrarUsuarios2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                  <table class="table table-bordered table-condensed table-hover">
                   <thead>
                     <tr>
                        <th>CODIGO</th>
                        <th>DESCRIPCION</th>
                        <TH>COLOR</TH>
                        <th>MEDIDA</th>
                        <th>CANTIDAD</th>
                        <th>UBICACION</th>
                        <th>AGREGAR</th>
                     </tr>
                  <tbody>
                <?php

                        $sql = mysqli_query($con,"SELECT * FROM productos_var where concat(descripcion,' ',codigo) like '%".$_GET['nombre']."%'  and referencia like '%".$_GET['referencia']."%' and color like '%".$_GET['color']."%' ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
                    $stc=0;
                    $query=mysqli_query($con,"SELECT stock_actual, stock_res FROM `pro_stock` WHERE codigo_pro='".$mostrar['codigo']."'");
                    if(mysqli_num_rows($query)>0){
                        $res=mysqli_fetch_assoc($query);
                        $stc=(intval($res['stock_actual'])-intval($res['stock_res']));
                    }
					$item = $item+1;
                                        $codigo= "'".$mostrar['codigo']."'";
                                        $ub = "'".$mostrar['codigo']."'";
					echo '<tr>
<td>'.$mostrar['codigo'].'</td>
    
<td>'.$mostrar['descripcion'].'</td>'
                                                . '<td><input type="text" disabled value="'.$mostrar['color'].'" id="col'.$mostrar['codigo'].'"  style="width:80px"> <img src="../../../../imagenes/buscar.png" onclick="buscarcolor('.$codigo.')"  data-toggle="modal" data-target="#myModal" style="height:15px"> </td>'
                                                . '<td>'.$mostrar['ancho'].'</td>'
                                                . '<td><input type="text" class="form-control" id="can'.$mostrar['codigo'].'" style="width:60px">'
                                                . '<td><input type="text" class="form-control" id="ubi'.$mostrar['codigo'].'" style="width:60px" onclick="ubi('.$ub.')">'
                                                . '<td><button type="button" class="btn btn-danger" onclick="guardar_item_cap('.$codigo.')">AGREGAR</button></td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
