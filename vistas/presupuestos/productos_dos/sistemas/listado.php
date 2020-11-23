<?php
include '../../../../modelo/conexioni.php';

 $page = $_GET['page'];

$request=mysqli_query($con,'SELECT count(*) FROM sistemas where nombre_sistema like "%'.$_GET['nombre'].'%" ');

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
              
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>

                                    <?php

                                    $sql = mysqli_query($con,"SELECT * FROM sistemas where nombre_sistema like '%".$_GET['nombre']."%' ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $nombre = "'".$mostrar['nombre_sistema']."'";
					echo '<tr>
                                                <td>'.$mostrar['id_sistema'].'</td>
                                                <td><a href="#" onclick="pasar_variable('.$nombre.')">'.$mostrar['nombre_sistema'].'</a></td>'
                                                . '<td><button data-toggle="modal" data-target="#exampleModal" onclick="subir('.$mostrar['id_sistema'].','.$nombre.')"> Editar </button></td>';
                                        }
                                        echo '<tr><td  colspan="3">';
                                          if($page>1){?>
                        <img src="../../../../images/a1.png"  onclick="mostrar(1)" style="cursor: pointer;">
                        <img src="../../../../images/a11.png"  onclick="mostrar(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../../../../images/p1.png"  onclick="mostrar(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../../../images/p11.png" onclick="mostrar(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../../../images/nex.png">  <?php
                }
			}else{
				echo '<tr><td colspan="2">No se encontraron registros...'.$_GET['nombre'].'</td></tr>';
			}
                                    
                                    ?>
   
                        
