<?php // 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $codidv= $_GET['codvidv'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM tipo_vidrio where concat(codigo_vid,' ',color_v) like '%".$codidv."%'");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_vidrio(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_vidrio(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_vidrio(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_vidrio(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?> 
<div class="table-responsive">  
       <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
   <table class="table table-hover">
    <tr class="bg-info">
        <th>ITEMS</th>
        <th>CODIGO</th>
        <th>COLOR DE VIDRIO</th> 
        <th>REFERENCIA</th> 
        <th>ESPESOR</th>
        <th>COSTO x M<sup>2</sup></th>
        <th>OPCIONES</th>
        <th>ESTADO</th>
        <th>MODIFICADO</th>
    </tr>
 <?php 

$query = mysqli_query($con,"SELECT *  FROM tipo_vidrio where concat(codigo_vid,' ',color_v) like '%".$codidv."%' ".$limit );
  $t=0;
	while($fila=mysqli_fetch_array($query))
	{   $t ++;    
            if($_SESSION['k_username']=='admin' || $_SESSION['k_username']=='STEFANNYR' || $_SESSION['k_username']=='TATIANA.JULIAO'){
                if($fila['estado']=='1'){
                    $ch = '<input type="checkbox" id="'.$fila['id_vidrio'].'" checked value="'.$fila['id_vidrio'].'" onclick="est_vid('.$fila['id_vidrio'].',0)">';
                }else{
                    $ch = '<input type="checkbox" id="'.$fila['id_vidrio'].'" value="'.$fila['id_vidrio'].'" onclick="est_vid('.$fila['id_vidrio'].',1)">';
                }
                
            }else{
                $ch='';
            }
            $codigo = "'".$fila['codigo_vid']."'";
        echo '<tr>'
        . '<td>'.$fila['id_vidrio'].'</td>'
        . '<td>'.$fila['codigo_vid'].'</td>'
        . '<td>'.$fila['color_v'].'</td>'
          . '<td>'.$fila['referencia_vid'].'</td>'
        . '<td>'.$fila['espesor_v'].'</td>'
        . '<td>'.$fila['costo_v'].'</td>'
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$codigo.')" > <img src="../imagenes/modificar.png"></button></a>'
        . '<button onclick="borrar('.$fila['id_vidrio'].')" class="glyphicon glyphicon-remove"> </button></td>'
        .'<td>'.$ch.'</td><td id="e'.$fila["id_vidrio"].'">'.$fila['modi'].'</td>';
  }
?>
  </table> 
 </div>
</div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
