<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){ 
    $bus= $_GET['buscc'];
    $nombr= $_GET['nombb'];
   $page= $_GET['page'];
            $request = mysqli_query($con, "SELECT count(*) FROM costos where categoria_costos like '%".$bus."%' and descripcion like '%".$nombr."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 20;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                         <img src="../images/a1.png" onclick="mostrar_costo(1)" style="cursor: pointer;">
                         <img src="../images/a11.png" onclick="mostrar_costo(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../images/a1.png"> <img src="../images/a11.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../images/p1.png"  onclick="mostrar_costo(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../images/p11.png" onclick="mostrar_costo(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../images/p1.png"> <img src="../images/p11.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?> 
<div class="table-responsive">  
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
  <table class="table table-hover">
    <tr class="bg-info">
        <th>ITEMS</th>
        <th>CATEGORIA</th> 
        <th>DESCRIPCION</th> 
        <th>PORCENTAJE</th> 
        <th>EDITABLE</th>
        <th>COMISION</th>
        <th>PVBI </th>
        <th>% TOTAL </th>
        <th>UTILIDAD</th>
        <th>Mult x Base</th>
        <th>.....OPCIONES</th>
    </tr>
   
    <?php
 
    $query = mysqli_query($con, "SELECT * FROM costos where categoria_costos like '%".$bus."%' and descripcion like '%".$nombr."%' ".$limit );

  
    while ($fila = mysqli_fetch_array($query)){
       
        echo '<tr>' 
        . '<td>'.$fila['id_cos'].'</td>'
        . '<td>'.$fila['categoria_costos'].'</td>'
        . '<td>'.$fila['descripcion'].'</td>'
                . '<td>'.$fila['porcentaje'].'%</td>'
                . '<td>'.$fila['suma_toral'].'</td>'
                . '<td>'.$fila['variableuno'].'</td>'
                . '<td>'.$fila['variabletres'].'</td>'
                . '<td>'.$fila['suma_porcentaje'].'</td>'
                . '<td>'.$fila['variabledos'].'</td>'
                 . '<td>'.$fila['operadordos'].'</td>'
        . '<td><a href="#tab2" data-toggle="tab"><button onclick="editar_costos('.$fila['id_cos'].')"> <img src="../imagenes/modificar.png"> Editar </button></a>'
        . '<button onclick="borrar('.$fila['id_cos'].')"> <img src="../imagenes/borrar.png"> Borrar </button></td>';
    }
    
    ?>
     
  </table> 
</div> 
  </div>
                        
                        
                        
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
