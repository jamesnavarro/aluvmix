<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){

     $nom= $_GET['buscar'];
     $page= $_GET['page'];
    if($_GET['id']!='0'){
        $contacto = ' and id_rel_tercero="'.$_GET['id'].'" ';
    }else{
        $contacto = '';
    }
            $request = mysqli_query($con,"SELECT count(*) FROM sis_contacto where concat(nombre_cont,' ',apellido_cont) like '%".$nom."%'  $contacto  ");

            if($request){
                    $req = mysqli_fetch_row($request);
                    $num_items = $req[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../../imagenes/at1.png"  onclick="mostrar_clientes(1)" style="cursor: pointer;">
                        <img src="../../imagenes/at2.png"  onclick="mostrar_clientes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../../imagenes/at1.png"> <img src="../../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../../imagenes/sig1.png"  onclick="mostrar_clientes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../../imagenes/sig2.png" onclick="mostrar_clientes(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../../imagenes/sig1.png"> <img src="../../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items.' '; 
    ?>

<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
        <th>Nombre </th> 
        <th>Telefono</th>  
    </tr>
    <?php
   
    $query = mysqli_query($con,"SELECT * FROM sis_contacto where concat(nombre_cont,' ',apellido_cont) like '%".$nom."%'  $contacto ".$limit);
  
  
    while ($fila = mysqli_fetch_array($query)){
        $nombre = "'".$fila['nombre_cont']." ".$fila['apellido_cont']."'";
        echo '<tr>'
        . '<td><a href="javascript:void(0);" onclick="seleccionar('.$fila['id_contacto'].','.$nombre.')"> '.$fila['nombre_cont'].' '.$fila['apellido_cont'].'</a></td>'
        . '<td>'.$fila['tel_oficina'].' '.$fila['celular'].'</td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {
 
    header("location:../index.php");
    
}  ?>

 