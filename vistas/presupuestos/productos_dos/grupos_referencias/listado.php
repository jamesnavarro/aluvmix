<?php
include('../../../../modelo/conexioni.php');

 $page = $_GET['page'];
  $ref = $_GET['ref'];
   $par = $_GET['par'];


$request=mysqli_query($con,'SELECT count(*) FROM productos a,grupos_referencia b  where b.modulo like "%'.$par.'%" and b.sistema="" and a.pro_referencia=b.referencia and concat(a.pro_nombre," ",a.pro_referencia) like "%'.$_GET['nombre'].'%" ');

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

                                    $sql = mysqli_query($con,"SELECT * FROM productos a,grupos_referencia b  where b.modulo like '%".$par."%' and  b.sistema='' and a.pro_referencia=b.referencia and  concat(a.pro_nombre,' ',a.pro_referencia) like '%".$_GET['nombre']."%' ".$limit);
			$item = 0;
		
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                        $cod=$mostrar['pro_referencia'];
                             
                                        
                                        $refe = "'".$mostrar['pro_referencia']."'";
                                        $nombre = "'".$mostrar['pro_nombre']."'";
                                        if($mostrar['modulo']=='Rieles'){
                                            $btn = '<button onclick="addsistema('.$refe.')" data-toggle="modal" data-target="#modalsistema">Sistema</button>';
                                        }else{
                                            $btn = '';
                                        }
					echo '<tr>
                                                <td>'.$mostrar['modulo'].'</td> <td>'.$mostrar['pro_referencia'].'</td>
                                                <td>'.$mostrar['pro_nombre'].'</td><td>'.$mostrar['descuento'].'</td>'
                                                . '<td><input type="button" id="sel'.$mostrar['pro_referencia'].'"  onclick="delref('.$mostrar['id'].')" value="-"> '.$btn.'</td>';
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
			
                                    
                                    ?>
   
                        
