<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
     $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) from cont_codigos_contables ");
            if($request){
                    $req = mysqli_fetch_row($request);
                    $num_items = $req[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 15;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../images/at1.png"  onclick="mostrar_codigos(1)" style="cursor: pointer;">
                        <img src="../../images/at2.png"  onclick="mostrar_codigos(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../../images/at1.png"> <img src="../../images/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 40px; height: 30px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../images/sig1.png"  onclick="mostrar_codigos(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/sig2.png" onclick="mostrar_codigos(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/sig1.png"> <img src="../../images/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>

<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>Codigo</th> 
        <th>Descripcion</th>  
    </tr>
    <?php
   
    $query = mysqli_query($con,"SELECT * from cont_codigos_contables ".$limit);
    while ($fila = mysqli_fetch_array($query)){
        $nombre = "'".$fila['nom_cod_cont']."'";
        echo '<tr>'
        . '<td><a href="javascript:void(0);" onclick="seleccionar('.$fila['cod_cod_cont'].','.$nombre.')"> '.$fila['cod_cod_cont'].'<td> '.$fila['nom_cod_cont'].'</a></td>'
        ;
    }
    
    ?>
</table>
    </div>
<?php  }else {
 
    header("location:../index.php");
    
}  ?>

 