<?php
include('../../../../modelo/conexion.php');

 $page = $_GET['page'];
  $ref = $_GET['ref'];
   $par = $_GET['par'];

$request=mysqli_query($con,'SELECT count(*) FROM productos where concat(pro_nombre," ",pro_referencia) like "%'.$_GET['nombre'].'%" ');
echo $request;
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

                                    $sql = mysqli_query($con,"SELECT * FROM productos where concat(pro_nombre,' ',pro_referencia) like '%".$_GET['nombre']."%' ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $cod=$mostrar['pro_referencia'];
                                        $ver = mysqli_query($con,"select estado_par,cantidad from productos_parametros where codigo_pro='$cod' and codigo_ref='$ref' and parametro='$par' ");
                                        $v = mysqli_fetch_row($ver);
                                        $c = $v[0];
                                        if($c==0){
                                            $check = '';
                                        }else{
                                            $check = 'checked';
                                        }
                                        
                                        $refe = "'".$mostrar['pro_referencia']."'";
                                        $nombre = "'".$mostrar['pro_nombre']."'";
					echo '<tr>
                                                 <td>'.$mostrar['pro_referencia'].'</td>
                                                <td>'.$mostrar['pro_nombre'].'</td>'
                                                . '<td><input type="text" id="can'.$mostrar['pro_referencia'].'" style="width:40px" value="'.$v[1].'"></td>'
                                                . '<td>'.$mostrar['pro_undmed'].'</td>'
                                                . '<td><input type="checkbox" id="sel'.$mostrar['pro_referencia'].'" '.$check.' onclick="pre_addparametro('.$refe.','.$c.')">'.$c.'</td>';
                                        }
                                        echo '<tr><td  colspan="5">';
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
				echo '<tr><td colspan="5">No se encontraron registros...'.$num_items.'</td></tr>';
			}
                                    
                                    ?>
   
                        
