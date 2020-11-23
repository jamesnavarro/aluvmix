<?php
include('../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            $request=mysqli_query($con,"SELECT count(*)FROM servicios_c where descripcion_s like '%".$_GET['cod']."%' and  valor_unidad like '%".$_GET['des']."%' and estado like '%".$_GET['crg']."%'  and quien_registra=0");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../images/a1.png"  onclick="Mostrarserv_b(1)" style="cursor: pointer;">
                        <img src="../../images/a11.png"  onclick="Mostrarserv_b(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../../images/p1.png"  onclick="Mostrarserv_b(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/p11.png" onclick="Mostrarserv_b(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/nex.png">  <?php
                }
    
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
     
                                    <?php

                        $sql = mysqli_query($con,"SELECT *FROM servicios_c where descripcion_s like '%".$_GET['cod']."%' and  valor_unidad like '%".$_GET['des']."%' and estado like '%".$_GET['crg']."%' and quien_registra=0 ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                       
                                        $codigo= "'".$mostrar['id']."'";
                                        $nombre= "'".$mostrar['descripcion_s']."'";
                                        $carg= "'".$mostrar['valor_unidad']."'";
//                                        $salar= $mostrar['EMP_SALACT']*30;
                                      
					echo '<tr>
                                <td>'.$mostrar['id'].'</td>
                                <td><a href="#PasarVariable" onclick="pasar2('.$codigo.','.$nombre.','.$carg.')">'.$mostrar['descripcion_s'].'</a></td><td>'.$mostrar['valor_unidad'].'</td>
                                    '; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                ?>
                                </tbody>
                            </table>
                        
