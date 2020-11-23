<?php 
include '../../../modelo/conexionv1.php';
session_start();
if(isset($_SESSION['k_username'])){
 
   $page= $_GET['page'];
            $request = mysqli_query($con2,"SELECT * FROM pagos ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;

            $last_page = ceil($num_items/$rows_by_page);

                 if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_conf(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_conf(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_conf(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_conf(<?php echo $last_page;?>)" style="cursor: pointer;">
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
        <th>Codigo de pago</th> 
        <th>Descripcion larga</th>
        <th>Por</th>
        <th>Rangos creados</th>
        <th>Ult Modificacio</th> 
        <th>Mod. por</th>
        <th>Rangos</th>
        <th>Editar</th>
        <th>Estado</th>
    </tr>
 <?php 

$request_ac = mysqli_query($con2,"SELECT * FROM pagos ");
if($request_ac){
 $t=0;
while($fila=mysqli_fetch_array($request_ac))
  {
    $im = '<img src="../imagenes/ok.png">';$e = 'yes';
    $add='<img src="../imagenes/empleado.png">';
    $up='<img src="../imagenes/modificar.png">';
     
      $t = $t +1;
      $rangos = mysqli_query($con2,"select * from pagos_rangos where id_pago=".$fila['id_pago']." ");
      $ran = '';
      while($r = mysqli_fetch_array($rangos)){
           $ran .= $r['inicial'].' al '.$r['final'].', Of: $'.$r['precio_oficial'].', Ayud: $'.$r['precio_ayud'].'<br>';
           }
	 
        echo '<tr>'
        . '<td>'.$t.'</td>'
        . '<td>'.$fila['desc_pago'].'</td>'
        . '<td>'.$fila['observacion'].'</td>'
        . '<td>'.$fila['tipo'].'</td>'
        . '<td>'.$ran.'</td>'
        . '<td>'.$fila['fecha_g'].'</td>'
        . '<td>'.$fila['registro_p'].'</td>'
        . '<td><img src="../images/empleado.png" data-toggle="modal" data-target="#Formulario" onclick="rangos('.$fila['id_pago'].')"></td>'
        . '<td><a data-toggle="tab" href="#agregar"><img onclick="editar_pagos('.$fila['id_pago'].')" src="images/modificar.png"></a></td>'
        . '<td><a href="../vistas/?id=pagos&'.$e.'='.$fila['id_pago'].'">'.$im.'</a></td></tr>';   
  }
?>
</table>
 </div>
</div>

                        <?php  } ?>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
