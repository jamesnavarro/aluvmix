
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
                    $lin = ' and linea like "%'.$_GET['lin'].'%" ';
            }else{
                    $lin = '';
            }
$request=mysqli_query($con,"SELECT count(*) FROM conf_referencias a, lineas b where a.id_linea_ref=b.id_linea $cod $des $ref $col $med $lin ");
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

                        $sql = mysqli_query($con,"SELECT * FROM conf_referencias a, lineas b where a.id_linea_ref=b.id_linea  $cod $des $ref $col $med $lin ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                         if($mostrar['alto']==0 || $mostrar['alto']==1){
                                            $alto ='';
                                        }else{
                                            
                                            $alto = 'x'.$mostrar['alto'];
                                        }
                                        $nombre= "'".trim($mostrar['descripcion'])."'";
                                        $referencia= "'".$mostrar['referencia']."'";
                                        $color= "'".$mostrar['color']."'";
                                        $medida= "'".$mostrar['ancho'].$alto."'";
                                        $und= "'".$mostrar['und_medida']."'";
                                        
					echo '<tr>
<td>'.$mostrar['codigo'].'</td>
<td><a href="#PasarVariable" onclick="pasar('.$mostrar['codigo'].','.$nombre.','.$referencia.','.$color.','.$medida.','.$mostrar['id_referencia'].','.$und.','.$mostrar['costo_mt'].')">'.$mostrar['descripcion'].'</a></td>'
                                                . '<td>'.$mostrar['referencia'].'</td>'
                                                . '<td>'.$mostrar['color'].'</td>'
                                                . '<td>'.$mostrar['ancho'].$alto.'</td>'
                                                . '<td>'.$mostrar['linea'].'</td>'
                                                . '<td>'.$mostrar['stock_gen'].'</td>'
                                                . '<td><input type="text" id="cantidadx'.$mostrar['id_referencia'].'" style="width:100%" onchange="psc('.$mostrar['id_referencia'].')"></td>'
                                                 . '<td><input type="text" id="ubicacion'.$mostrar['id_referencia'].'" onclick="ubicacion('.$mostrar['id_referencia'].')" style="width:100%" value=""></td>'
                                                . '<td><button onclick="adicionar('.$mostrar['id_referencia'].')" id="addi'.$mostrar['id_referencia'].'">+</button></td>'
                                                 . '<input type="hidden"  id="idr'.$mostrar["id_referencia"].'"  value="'.$mostrar['id_referencia'].'" />'
                                                . '<input type="hidden"  id="des'.$mostrar["id_referencia"].'"  value="'.$mostrar['descripcion'].'" />'
                                                . '<input type="hidden"  id="ref'.$mostrar["id_referencia"].'"  value="'.$mostrar['referencia'].'" />'
                                                . '<input type="hidden"  id="col'.$mostrar["id_referencia"].'"  value="'.$mostrar['color'].'" />'
                                                . '<input type="hidden"  id="med'.$mostrar["id_referencia"].'"  value="'.$mostrar['ancho'].$alto.'" />'
                                                . '<input type="hidden"  id="costo'.$mostrar["id_referencia"].'"  value="'.$mostrar['costo_mt'].'" />'
                                                . '<input type="hidden"  id="unidad'.$mostrar["id_referencia"].'"  value="'.$mostrar['und_medida'].'" /><tr>'; 
                                        
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
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarReferencias(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarReferencias(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                        
                }
                echo 'Cantidad de Registro '.$num_items;
               
                                    ?>
                                    </td></tr>
                            </table>
                        
