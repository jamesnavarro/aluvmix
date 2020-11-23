<?php 
include '../../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $des= $_GET['des'];
    $est=$_GET['est'];
    $res=$_GET['res'];
   $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) FROM reservas_obras group by bod_codigo having bod_codigo like '%".$des."%' and obra like '%".$res."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT *, SUM(cantidad), SUM(vig_ajuste) FROM reservas_obras group by bod_codigo having bod_codigo like '%".$des."%' and obra like '%".$res."%' " .$limit. "" );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
        $estado='';
        if(intval($fila['SUM(cantidad)'])==intval($fila['SUM(vig_ajuste)'])){
            $estado='<b style="color: blue;">Normal</b>';
        }else{
            $resta=intval($fila['SUM(vig_ajuste)'])-intval($fila['SUM(cantidad)']);
            $estado='<b style="color: red;">Se ajusto '.$resta.'</b>';
        }
        
        echo '<tr>'
        . '<td>'.$fila['bod_codigo'].'</td>'
        . '<td>'.$fila['obra'].'</td>'
        . '<td>'.$estado.'</td>'
        . '<td><button style="margin-right: 6%;color: blue;font-weight: bold;" onclick="diagnostico('.$fila['bod_codigo'].');">Reporte</button><button style="color: red;font-weight: bold;" onclick="diagnostico_pdf('.$fila['bod_codigo'].');">pdf</button></td>'
        . '</tr>';
  }
   echo '<tr><td colspan="5">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_line(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_line(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_line(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_line(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                
                echo 'Cantidad de registro '.$num_items; 
                 echo '</td></tr>';
?>
 </div>
</div>
<?php  }else {
   
      echo 'error';
    
}  ?>
