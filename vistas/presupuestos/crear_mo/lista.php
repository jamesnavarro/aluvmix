<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $pr_nuen= $_GET['pr_nue'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM referencia_mo where concat(referencia,' ',descripcion_mo) like '%".$pr_nuen."%'");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_prec(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_prec(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_prec(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_prec(<?php echo $last_page;?>)" style="cursor: pointer;">
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
        <th>Items</th>
        <th>Referencia</th> 
        <th>deescripcion</th>
        <th>Instalacion?</th>
        <th>Cobrado por</th>
        <th>Valor</th>
        <th>Utilidad</th>
        <th>Parafiscales</th>
        <th>administrativo + Utilidad</th>
        <th>OPCIONES</th>
    </tr>
 <?php 

$query = mysqli_query($con,"SELECT *  FROM referencia_mo where concat(referencia,' ',descripcion_mo) like '%".$pr_nuen."%' ".$limit );

  while ($fila = mysqli_fetch_array($query))
         {       
            
            
        $pr = (100 - $fila["utilidad"]) / 100;
        $fr = ($fila["valor_mo"]) / $pr;
        
        echo '<tr>'
        . '<td>'.$fila['id_ref_mo'].'</a></td>'
        . '<td>'.$fila['referencia'].'</a></td>'
        . '<td>'.$fila['descripcion_mo'].'</td>' 
        . '<td>'.$fila['instalacion'].'</font></td>'
        . '<td>'.$fila['unidad_cobro'].'</font></td>'
       . '<td>$'.number_format($fila["valor_mo"]).'<font></a></td>'
        . '<td>'.$fila["utilidad"].'%</a></td>'
        . '<td>'.$fila["parafiscales"].'%</a></td>'
      . '<td>$'.number_format($fr).'<font></a></td>'  
        . '<td><a data-toggle="tab" href="#agregar"><button onclick="editar('.$fila['id_ref_mo'].')" > <img src="../imagenes/modificar.png"></button></a>'
        . '<button onclick="borrar('.$fila['id_ref_mo'].')" class="glyphicon glyphicon-remove"></button></td>';
} 
?>
     
  </table><br>
</div><br>
  </div>
                        
                        
                        
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
