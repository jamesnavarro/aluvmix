
<?php
include('../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
     if($_GET['cod']!=''){
                    $cod = ' and codigo='.$_GET['cod'];
            }else{
                    $cod = '';
            } 
                 if($_GET['des']!=''){
                    $des = ' and descripcion like "%'.$_GET['des'].'%" ';
            }else{
                    $des = '';
            }
                 if($_GET['ref']!=''){
                    $ref = ' and referencia like "%'.$_GET['ref'].'%" ';
            }else{
                    $ref = '';
            }
                 if($_GET['col']!=''){
                    $col = ' and color like "%'.$_GET['col'].'%" ';
            }else{
                    $col = '';
            }
                 if($_GET['med']!=''){
                    $med = ' and ancho='.$_GET['med'];
            }else{
                    $med = '';
            }
                 if($_GET['lin']!=''){
                    $lin = ' and b.ubicacion like "%'.$_GET['lin'].'%" ';
            }else{
                    $lin = '';
            }
            if($_GET['ubi']!=''){
                    $ubi = ' and b.nombre like "%'.$_GET['ubi'].'%" ';
            }else{
                    $ubi = '';
            }
            if($_GET['idr']!=''){
                    $colu = ' and b.columna = "'.$_GET['idr'].'" ';
            }else{
                    $colu = '';
            }
            
$request=mysqli_query($con,"SELECT count(*) FROM conf_referencias a, ubicaciones_aluminio b,relacion_ubicaciones c where  c.stock_ubi!=0 and c.ubicacion=b.nombre and a.id_referencia=c.id_referencia and a.stock_gen!=0 $cod $des $ref $col $med $lin $ubi $colu ");
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
                            <table class="table table-bordered table-condensed table-hover">
                               
                                <tbody>
                                    <?php

                        $sql = mysqli_query($con,"SELECT a.descripcion,a.ancho,a.alto,a.codigo,a.referencia,a.color,a.stock_gen,b.nombre,b.ubicacion,b.columna,c.id_ru,c.stock_ubi,c.stock_temporal FROM conf_referencias a, ubicaciones_aluminio b,relacion_ubicaciones c where  c.stock_ubi!=0 and c.ubicacion=b.nombre and a.id_referencia=c.id_referencia and a.stock_gen!=0  $cod $des $ref $col $med $lin $ubi $colu ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $nombre= "'".$mostrar['descripcion']."'";
                                        if($mostrar['alto']==0 || $mostrar['alto']==1){
                                            $alto ='';
                                        }else{
                                            
                                            $alto = 'x'.$mostrar['alto'];
                                        }
                                        
					echo '<tr>
<td>'.$mostrar['codigo'].'</td>
<td>'.$mostrar['descripcion'].'</td>'
                                                . '<td>'.$mostrar['referencia'].'</td>'
                                                . '<td>'.$mostrar['color'].'</td>'
                                                . '<td>'.$mostrar['ancho'].$alto.'</td>'
                                                . '<td>'.$mostrar['ubicacion'].'</td>'
                                                . '<td>'.$mostrar['stock_gen'].'</td>'
                                                . '<td><input type="text" disabled id="stock'.$mostrar['id_ru'].'" style="width:100%" value="'.($mostrar['stock_ubi']-$mostrar['stock_temporal']).'"></td>'
                                                 . '<td>'.$mostrar['columna'].'</td>'
                                                . '<td><input type="text" disabled id="ubicacion'.$mostrar['id_ru'].'" style="width:100%" value="'.$mostrar['nombre'].'"></td>'
                                              
                                                . '</tr>'; 
                                        }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                                <tr><td colspan="6">
                                    <?php
                                    if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarReferencias(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarReferencias(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                        (Pagina <?php echo $page;?><input type="hidden" id="page" value="<?php echo $page;?>"> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarReferencias(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarReferencias(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                        
                }
                echo 'Cantidad de Registro '.$num_items ;
            
               
                                    ?>
                                    </td></tr>
                            </table>
                        
