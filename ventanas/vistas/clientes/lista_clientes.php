<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $nom= $_GET['nom_ter'];
     $ct= $_GET['doc_ter'];
     $dr= $_GET['dir_ter'];
     $tl= $_GET['telfijo_ter'];
     $page= $_GET['page'];
   
            $request = mysqli_query($con,"SELECT count(*) FROM cont_terceros where nom_ter like '%".$nom."%' and cod_ter like '%".$ct."%' and dir_ter like '%".$dr."%' and telfijo_ter like '%".$tl."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_clientes(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_clientes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_clientes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_clientes(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"> Nuevo cliente</button>
                        </div><br>
<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>nombre</th> 
        <th>tipo</th> 
        <th>documento</th>  
        <th>direccion</th> 
        <th>telefono</th> 
        <th>opciones</th> 
    </tr>
    <?php

    $query = mysqli_query($con,"SELECT * FROM cont_terceros where nom_ter like '%".$nom."%' and cod_ter like '%".$ct."%' and dir_ter like '%".$dr."%' and telfijo_ter like '%".$tl."%'".$limit);
 
  
    while ($fila = mysqli_fetch_array($query)){
        echo '<tr>'
       
        . '<td>'.$fila['nom_ter'].'</td>'
        . '<td>'.$fila['doc_ter'].'</td>'
        . '<td>'.$fila['cod_ter'].'</td>'
        . '<td>'.$fila['dir_ter'].'</td>'
        . '<td>'.$fila['telfijo_ter'].'</td>'
        
        
//        . '<td><button onclick="borrar('.$fila['id_ter'].')"> <img src="../imagenes/borrar.png"> Borrar </button> '
        . '<td><button onclick="editar('.$fila['id_ter'].')"> <img src="../imagenes/modificar.png"> Editar </button></td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
}  ?>

 