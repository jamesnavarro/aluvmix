<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
     $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) from cont_fuentes ");
            if($request){
                    $req = mysqli_fetch_row($request);
                    $num_items = $req[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 15;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../images/at1.png"  onclick="mostrar_fuentes(1)" style="cursor: pointer;">
                        <img src="../../images/at2.png"  onclick="mostrar_fuentes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../../images/at1.png"> <img src="../../images/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 40px; height: 30px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../images/sig1.png"  onclick="mostrar_fuentes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../images/sig2.png" onclick="mostrar_fuentes(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../images/sig1.png"> <img src="../../images/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>

<div class="table-responsive">          
  <table class="table table-hover">
    <tr class="bg-info">
        <th>Codigo</th> 
        <th>Descripcion</th>  
    </tr>
    <?php
   
    $query = mysqli_query($con,"SELECT * from cont_fuentes ".$limit);
    while ($fila = mysqli_fetch_array($query)){
        $nombre = "'".$fila['nom_fuente']."'";
        $ncod = "'".$fila['cod_fuente']."'";
        echo '<tr>'
        . '<td><a href="javascript:void(0);" onclick="seleccionar('.$ncod.','.$nombre.')"> '.$fila['cod_fuente'].'<td> '.$fila['nom_fuente'].'</a></td>'
        ;
    }
    
    ?>
</table>
    </div>
<?php  }else {
 
    header("location:../index.php");
    
}  ?>

 