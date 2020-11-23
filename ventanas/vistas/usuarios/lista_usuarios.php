<?php 
include '../../modelo/conexioni.php';
session_start(); 
   if(isset($_SESSION['k_username'])){

   if( $_GET['fecha']=='') {
       $fecha="";
   }else {
       $fecha=$_GET['fecha'];
   }
       $page = $_GET['page'];

            $request = mysqli_query($con,"SELECT count(*) FROM usuarios where nombres like '%".$_GET['nombres']."%' and fecha_reg like '%".$fecha."%'") ;
 
            if($request){
                    $req = mysqli_fetch_array($request);
                    $num_items = $req[0];
                    
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 3;
echo $fecha;
            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_usuario(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_usuario(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_usuario(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_usuario(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items;
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"> Nuevo usuarios</button>
                        </div>
<div class="table-responsive">          
  <table class="table">
    <tr>
        <th>nombre</th>
        <th>fecha</th>  
    </tr>
    <?php
  
       $query = mysqli_query($con,"SELECT * FROM usuarios where nombres like '%".$_GET['nombres']."%' and fecha_reg like '".$fecha."%' ".$limit);

  
    while ($fila = mysqli_fetch_array($query))
            {
        echo '<tr>'
        . '<td>'.$fila['nombres'].'</td>'
        . '<td>'.$fila['fecha_reg'].'</td>'
         
        . '<td><button onclick="borrar('.$fila['id_usuario'].')"> <img src="../imagenes/borrar.png"> Borrar </button> '
        . '<button onclick="editar('.$fila['id_usuario'].')"> <img src="../imagenes/modificar.png"> Editar </button></td>';
    }
    
    ?>
</table>
    </div>
<?php  }else {
 
    header("location:../index.php");  
    
}  
?>


     