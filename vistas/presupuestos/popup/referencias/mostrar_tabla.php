<?php
if(isset($_GET['nombre'])){
       include('../../modelo/conexion.php');
        $col = 'and concat(referencia," ",descripcion," ",dado," ",codigo) like "%'.$_GET['nombre'].'%" ';
    }else{
        $col = '';
    }
if(isset($_GET['page'])){
           include('../../modelo/conexion.php');
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
$request=mysqli_query($con,'SELECT count(*) FROM referencias where grupo="Perfileria" '.$col.' ');
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

            
            
                if($page>1){?>
                        <img src="../images/a1.png"  onclick="MostrarEmpleados2(1)" style="cursor: pointer;">
                        <img src="../images/a11.png"  onclick="MostrarEmpleados2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="MostrarEmpleados2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="MostrarEmpleados2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
                            <table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <th>REFERENCIA</th>
                                        <th>DESCRIPCION</th>
                                        <th>DADO</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $sql = mysqli_query($con,"SELECT * FROM `referencias` where grupo='Perfileria'  $col ".$limit);
			$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
					echo '<tr>
<td>'.$mostrar['codigo'].'</td>
<td><a href="../popup/referencias.php?codigo='.$mostrar['id_referencia'].'">'.$mostrar['referencia'].'</a></td>
<td>'.$mostrar['descripcion'].'</td><td>'.$mostrar['dado'].'</td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
