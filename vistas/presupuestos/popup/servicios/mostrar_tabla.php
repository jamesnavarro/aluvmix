<?php
include('../../../../modelo/conexioni.php');

if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysqli_query($con,'SELECT id_precios FROM precios_instalaciones where nom_insta like "%'.$_GET['des'].'%"  and gruposistemas like "%'.$_GET['ref'].'%" and sistema_insta="Instalacion"  ');
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
                                    
                                    $sql = mysqli_query($con,'SELECT * FROM precios_instalaciones where nom_insta like "%'.$_GET['des'].'%"  and gruposistemas like "%'.$_GET['ref'].'%" and sistema_insta="Instalacion"  '.$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $codi = "'".trim($mostrar['id_precios'])."'";
                                        $desc = "'".trim($mostrar['nom_insta'])."'";
					echo '<tr>
<td>'.$mostrar['id_precios'].'</td>
<td><a href="#" onclick="pasar('.$codi.','.$desc.','.$mostrar['total_1'].')">'.$mostrar['nom_insta'].'</a></td><td style="text-align:right">'.number_format($mostrar['total_1']).'</td><td>'.$mostrar['gruposistemas'].'</td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...'.($_GET['ref']).'</td></tr>';
			}
                                    
                                    ?>
                              
                        
