<?php
include('../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            $request=mysqli_query($con,"SELECT count(*)FROM empleados where EMP_CEDULA like '%".$_GET['cod']."%' and  EMP_NOMBRE like '%".$_GET['des']."%' and EMP_CARGO like '%".$_GET['crg']."%'  and EMP_ESTADO=0");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../images/a1.png"  onclick="MostrarUsuarios2(1)" style="cursor: pointer;">
                        <img src="../../images/a11.png"  onclick="MostrarUsuarios2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../../images/p1.png"  onclick="MostrarUsuarios2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/p11.png" onclick="MostrarUsuarios2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/nex.png">  <?php
                }
    
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
     
                                    <?php

                        $sql = mysqli_query($con,"SELECT * FROM empleados where EMP_CEDULA like '%".$_GET['cod']."%' and  EMP_NOMBRE like '%".$_GET['des']."%' and EMP_CARGO like '%".$_GET['crg']."%'  and EMP_ESTADO=0 ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $codigo= "'".$mostrar['EMP_CEDULA']."'";
                                        $nombre= "'".$mostrar['EMP_NOMBRE']."'";
                                        $carg= "'".$mostrar['EMP_CARGO']."'";
                                        $salar= $mostrar['EMP_SALACT']*30;
                                      
					echo '<tr>
                                <td>'.$mostrar['EMP_CEDULA'].'</td>
                                <td><a href="#PasarVariable" onclick="pasar2('.$codigo.','.$nombre.','.$carg.','.$salar.')">'.$mostrar['EMP_NOMBRE'].'</a></td><td>'.$mostrar['EMP_CARGO'].'</td>
                                    '; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                ?>
                                </tbody>
                            </table>
                        
