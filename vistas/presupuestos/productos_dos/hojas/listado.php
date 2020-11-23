<?php
include '../../../../modelo/conexioni.php';

 $page = $_GET['page'];

$request=mysqli_query($con,'SELECT count(*) FROM hojas where descripcion like "%'.$_GET['nombre'].'%" and hoja="'.$_GET['hoja'].'" ');

            if($request){
                    $reque = mysqli_fetch_row($request);
                    $num_items = $reque[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
              
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>

                                    <?php

                                    $sql = mysqli_query($con,"SELECT * FROM hojas where descripcion like '%".$_GET['nombre']."%' and hoja='".$_GET['hoja']."' ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $nombre = "'".$mostrar['descripcion']."'";
					echo '<tr>
                                                <td>'.$mostrar['id_hoja'].'</td>
                                                    <td>'.$mostrar['hoja'].'</td>
                                                <td><a href="#" onclick="pasar_variable('.$nombre.')">'.$mostrar['descripcion'].'</a></td>'
                                                . '<td><button data-toggle="modal" data-target="#exampleModal" onclick="subir('.$mostrar['id_hoja'].','.$mostrar['hoja'].','.$nombre.')"> Editar </button></td>';
                                        }
                                        echo '<tr><td  colspan="4">';
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
				echo '<tr><td colspan="4">No se encontraron registros...'.$_GET['nombre'].'</td></tr>';
			}
                                    
                                    ?>
   
                        
