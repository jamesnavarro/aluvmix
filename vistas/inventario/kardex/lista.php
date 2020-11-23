<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
   $cod_k= $_GET['cod_k'];
   $ubi_k= $_GET['ubi_k'];
   $usu_k= $_GET['usu_k'];
   $fec_k= $_GET['fec_k'];
   $fec_f= $_GET['fec_f'];
   $bod= $_GET['bod'];
   $tmov_k= $_GET['tmov_k'];
   $color= $_GET['color'];
   if($color==''){
       $col = '';
   }else{
       $col = ' and a.color_ubi = "'.$color.'" ';
   }
   
   $page= $_GET['page'];
            $requestx=mysqli_query($con,"SELECT a.codigo_pro FROM relacion_ubicaciones a, productos_var b where a.bod_codigo='$bod' and a.codigo_pro=b.codigo and a.stock_ubi!=0 and concat(b.descripcion,' ',b.codigo) like '%".$cod_k."%' '$col'  group by a.codigo_pro ");

            if($requestx){
                    $req = mysqli_num_rows($requestx);
                    $num_items = $req;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 10;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_kardex(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_kardex(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig2.png"  onclick="mostrar_kardex(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig1.png" onclick="mostrar_kardex(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro'.$num_items; 
    ?> 
<div class="table-responsive"> 
    <div style="border: 1px solid #307ECC;box-shadow: 0 0 10px #307ECC;"> 
   <table class="table table-hover">
    <tr class="bg-info">
        <th>CODIGO</th>
        <th>DESCRIPCION</th>
        <th>BODEGA</th>
        <th NOWRAP>COSTO</th>
        <th>CANTIDAD</th> 
        <th NOWRAP>ULT. ENT</th>
        <th NOWRAP>ULT. SAL</th>
        <TH NOWRAP>USUARIO</TH>
    </tr>
 <?php 
  $query = mysqli_query($con,"SELECT a.codigo_pro,b.descripcion,a.costo_ultimo,a.color_ubi,b.ancho,b.alto,a.costo_ultimo, sum(stock_ubi) as can,a.fecha_ult_ent,a.fecha_ult_sal,a.bod_codigo,a.ultimo_usuario FROM relacion_ubicaciones a, productos_var b where a.bod_codigo='$bod' '$col' and  a.codigo_pro=b.codigo and a.stock_ubi!=0 and concat(b.descripcion,' ',b.codigo) like '%".$cod_k."%' group by a.codigo_pro ".$limit);
			
//$query = mysqli_query($con,"SELECT *, a.usuario FROM mov_inventario a, mov_detalle_ubi b, productos_var c where a.id_mov=b.id_mov and b.codigo_pro=c.codigo and b.codigo_pro like '%".$cod_k."%' and b.ubicacion like '%".$ubi_k."%' and a.usuario like '%".$usu_k."%' and a.fecha_pro like '%".$fec_k."%' and b.bodega like '%".$bod."%' and a.tipo_movimiento like '%".$tmov_k."%' ".$limit );
  $sum_c=0;
while ($fila = mysqli_fetch_array($query)){
    $sum_c+= $fila['can'];
        echo '<tr>'
        . '<td>'.$fila['codigo_pro'].'</td>'
        . '<td>'.$fila['descripcion'].'</td>' 
       . '<td>'.$fila['bod_codigo'].'</td>'
        . '<td>'.$fila['costo_ultimo'].'</td>' 
        . '<td>'.$fila['can'].'</td>'
        . '<td>'.$fila['fecha_ult_ent'].'</td>'
        . '<td>'.$fila['fecha_ult_sal'].'</td>'
        . '<td>'.$fila['ultimo_usuario'].'</td>';
  }
   echo '<tr class="bg-info">
          <th colspan="4"><label style="float: right"><b>TOTAL CANT</b></label></th>
          <td>'.$sum_c.'</td>
          <th></th>
          <th></th>
          <th></th>
          </tr>';
?>
</table>
 </div>
</div>
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
