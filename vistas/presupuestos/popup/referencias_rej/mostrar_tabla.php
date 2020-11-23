<?php
include('../../../../modelo/conexioni.php');

if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysqli_query($con,'SELECT pro_referencia FROM productos where pro_referencia like "%'.$_GET['ref'].'%"  and pro_nombre like "%'.$_GET['des'].'%"  ');
            if($request){
                    $request = mysqli_num_rows($request);
                    $num_items = $request;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            echo '<tr><td colspan="2">';
            
                if($page>1){?>
                        <img src="../../../images/a1.png"  onclick="MostrarEmpleados2(1)" style="cursor: pointer;">
                        <img src="../../../images/a11.png"  onclick="MostrarEmpleados2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../../../images/p1.png"  onclick="MostrarEmpleados2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../../images/p11.png" onclick="MostrarEmpleados2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../images/nex.png">  <?php
                }
                echo '</td>';
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                         
                                    <?php
                                    
                                    $sql = mysqli_query($con,"SELECT * FROM `productos` where pro_referencia like '%".$_GET['ref']."%'  and pro_nombre like '%".$_GET['des']."%' "
                                            . " ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $codi = "'".trim($mostrar['pro_referencia'])."'";
                                        $desc = "'".trim($mostrar['pro_nombre'])."'";
					echo '<tr>
<td><a href="#" onclick="pasar('.$codi.','.$desc.')">'.$mostrar['pro_referencia'].'</a></td>
<td>'.$mostrar['pro_nombre'].'</td><td style="text-align:right">'.number_format($mostrar['costo_aluminio']).'</td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...'.($_GET['ref']).'</td></tr>';
			}
                                    
                                    ?>
                              
                        
