<?php
include('../../../../../modelo/conexioni.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
                ?>
                  <table class="table table-bordered table-condensed table-hover">
                   <thead>
                     <tr>
                        <th>CODIGO</th>
                        <th>COLOR</th>
                        <th>CANTIDAD</th>
                     </tr>
                  <tbody>
                <?php

                        $sql = mysqli_query($con,"SELECT *, sum(stock_ubi) as can from relacion_ubicaciones where codigo_pro='".$_GET['nombre']."' group by color_ubi ");
			//$sql = mysqli_query($con,"SELECT * FROM productos_var where concat(descripcion,' ',codigo) like '%".$_GET['nombre']."%'".$limit);
                        $item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
                    $stc=0;

					$item = $item+1;
                                      echo '<tr>
                                              <td>'.$mostrar['codigo_pro'].'</td>
                                              <td>'.$mostrar['color_ubi'].'</td>'
                                            . '<td>'.$mostrar['can'].'</td>'; }
			}else{
				echo '<tr><td colspan="5">No se encontro</td></tr>';
			}
                                    
                                    ?>
                                </tbody>
                            </table>
                        
