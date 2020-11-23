<?php
include('../../modelo/conexioni.php');
if(isset($_GET['page'])){
     $cod = $_GET['cod'];
     $des = $_GET['des'];
     $page = $_GET['page'];
      }else{
         $page = 1;
         }
          $request=mysqli_query($con,"SELECT count(*) FROM cont_codigos_contables where cod_cod_cont like '%".$cod."%' and nom_cod_cont like '%".$des."%'");

          if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
           }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../images/a1.png"  onclick="Mostrarcontablesf2(1)" style="cursor: pointer;">
                        <img src="../../images/a11.png"  onclick="Mostrarcontablesf2(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/ant.png"><?php
                }
                ?>
                (Pagina <?php echo $page;?> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../../images/p1.png"  onclick="Mostrarcontablesf2(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/p11.png" onclick="Mostrarcontablesf2(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                ?><img src="../../images/nex.png">  <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                ?>
     
            <?php

              $sql = mysqli_query($con,"SELECT * FROM cont_codigos_contables where cod_cod_cont like '%".$cod."%' and nom_cod_cont like '%".$des."%'".$limit);
		$item = 0;
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
				$item = $item+1;
                                $nombre= "'".$mostrar['nom_cod_cont']."'";
                                $codigo= "'".$mostrar['cod_cod_cont']."'";
				echo '<tr>
<td>'.$mostrar['cod_cod_cont'].'</td>
<td><a href="#PasarVariable" onclick="pasar3('.$codigo.','.$nombre.')">'.$mostrar['nom_cod_cont'].'</a></td>'; }
	}else{
	echo '<tr><td colspan="5">No se encontraron registros...</td></tr>';
}
?>
</tbody>
      </table>
                        
