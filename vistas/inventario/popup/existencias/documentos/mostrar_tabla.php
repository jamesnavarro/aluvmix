<?php
include('../../../../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            $bod = $_GET['bod'];
$request=mysqli_query($con,"SELECT codigo_pro FROM relacion_ubicaciones a, productos_var b where a.codigo_pro=b.codigo and a.codigo_pro like '%".$_GET['nombre']."%'  and  bod_codigo like '%".$bod."%' and stock_ubi > 0 ");
            if($request){
                    $req = mysqli_num_rows($request);
                    $num_items = $req;
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
                        <th>PRODUCTO</th>
                        <th>COLOR</th>
                        <th>MEDIDA</th>
                        <th>CANTIDAD</th>
                        <th>STOCK</th>
                        <th>UBI.</th>
                        <th>OPCION</th>
                     </tr>
                  <tbody>
                <?php

                        $sql = mysqli_query($con,"SELECT * FROM relacion_ubicaciones a, productos_var b where a.codigo_pro=b.codigo and a.codigo_pro like '%".$_GET['nombre']."%'  and  bod_codigo like '%".$bod."%' and stock_ubi > 0  ".$limit);
			//$sql = mysqli_query($con,"SELECT * FROM productos_var where concat(descripcion,' ',codigo) like '%".$_GET['nombre']."%'".$limit);
                        $item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
                    $stc=0;//
                    $var = str_replace('"', 'P ', $mostrar['descripcion']);  
					$item = $item+1;
                                        $codigo= "'".$mostrar['codigo_pro']."'";
					echo '<tr>
                                                   <td><input type="text" id="cod'.$item.'"  value="'.$mostrar['codigo_pro'].'" style="width:100px"></td>
                                                   <td><input type="text" id="des'.$item.'" disabled value="'.$mostrar['descripcion'].'" style="width:100%"></td>'
                                                . '<td><input type="text" id="col'.$item.'" disabled value="'.$mostrar['color_ubi'].'"  style="width:80px"></td>'
                                                . '<td><input type="text" id="med'.$item.'" disabled value="'.$mostrar['medida'].'"  style="width:40px"></td>'
                                                . '<td><input type="text" id="cant'.$item.'" style="width: 40px" value=""></td>'
                                                . '<td><input type="text" id="sto'.$item.'"  value="'.$mostrar['stock_ubi'].'" disabled style="width: 70px">'
                                                . '<input type="hidden" id="pre'.$item.'"  value="'.$mostrar['costo_promedio'].'" disabled style="width: 70px"></td>'
                                                . '<td><input type="text" id="ubi'.$item.'"  value="'.$mostrar['ubicacion'].'" disabled style="width: 70px"></td>'
                                                . '<td><button id="'.$item.'"  onclick="agregarproductos('.$item.')">Agregar</button>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
