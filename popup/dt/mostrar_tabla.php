<?php
include('../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
            if($_GET['item']==''){
                $items = '';
            }else{
                $items = ' and id_p="'.$_GET['item'].'"  ';
            }
            $request=mysqli_query($con,"SELECT count(*) FROM producto where sistemas like '%".$_GET['sis']."%' and  codigo like '%".$_GET['cod']."%' and  producto like '%".$_GET['des']."%' and  linea like '%".$_GET['ref']."%' $items  ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);
            $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
            echo '<tr><td colspan="5">';
            
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
               
                echo '</td></tr>';
          

                        $sql = mysqli_query($con,"SELECT * FROM producto where  sistemas like '%".$_GET['sis']."%' and codigo like '%".$_GET['cod']."%' and  producto like '%".$_GET['des']."%' and  linea like '%".$_GET['ref']."%' $items  ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $nombre= "'".$mostrar['producto']."'";
                                        $codigo= "'".$mostrar['codigo']."'";
                                        $img = '<img src="../../producto/'.$mostrar['ruta'].'" width="50px">';
					echo '<tr>
<td>'.$mostrar['id_p'].'</td><td>'.$mostrar['codigo'].'</td>
<td><a href="#PasarVariable" onclick="pasar_dt('.$codigo.','.$nombre.','.$mostrar['laminas'].')">'.$mostrar['producto'].'</a></td>'
                                                . '<td>'.$mostrar['sistemas'].'</td><td>'.$img.'</td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                
