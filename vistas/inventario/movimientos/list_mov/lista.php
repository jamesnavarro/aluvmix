<?php 
include '../../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $des= $_GET['des'];
    $res=$_GET['res'];
    $tmov=$_GET['tmov'];
    $bdeg= $_GET['bdeg'];
    $desc_m=$_GET['desc_m'];
    $fec=$_GET['fec'];
    $usua_m=$_GET['usua_m'];
    $page= $_GET['page'];
    $pen= $_GET['pen'];
    $cons= $_GET['cons'];
    if($tmov!=''){
        $orden = ' and id_orden='.$tmov.' ';
    }else{
        $orden = '';
    }
    if($cons!=''){
        $conse = ' and rad_fom='.$cons.' ';
    }else{
        $conse = '';
    }
   //codigo_tm!=2006 and  SE QUITO DE LA CONSULTA
            $request = mysqli_query($con,"SELECT count(*) FROM mov_inventario where pendiente='$pen' and codigo_ter like '%".$des."%' and codigo_tm like '%".$res."%' $orden $conse and bod_codigo like '".$bdeg."%' and obs like '%".$desc_m."%' and fecha_pro like '%".$fec."%' and usuario like '%".$usua_m."%' ");

            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 15;
            $last_page = ceil($num_items/$rows_by_page);

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
$request_ac = mysqli_query($con,"SELECT * FROM mov_inventario where  pendiente='$pen' and codigo_ter like '%".$des."%' and codigo_tm like '%".$res."%' $orden $conse and bod_codigo like '".$bdeg."%' and obs like '%".$desc_m."%' and fecha_pro like '%".$fec."%' and usuario like '%".$usua_m."%' order by id_mov DESC  " .$limit. "" );
 $total2=0;
	while($fila=mysqli_fetch_array($request_ac))
	{  
        $ti=mysqli_query($con,"SELECT movimiento FROM tipos_movimientos WHERE codigo_tm='".$fila['codigo_tm']."' LIMIT 1");
        $tip=mysqli_fetch_assoc($ti);
         if ($fila['save_mov']>0) {
             $estado='<font color="green">Guardado</font>';
        }else{
             $estado='<font color="red">En proceso</font>';
        } 
        $cod = "'".$fila['codigo_tm']."'";
        $send=$fila['id_mov'].",'".trim($fila['tipo_movimiento'])."',".$fila['save_mov'];
        if ($fila['bod_destino']=='') {
            $btn ='volver_cargar('.$send.')';
        }else{
            $btn ='volver_cargar_tras('.$send.')';
        }
        $numeroConCeros = str_pad($fila['rad_fom'], 9, "0", STR_PAD_LEFT);
        echo '<tr>'

        . '<td>'.$fila['id_mov'].'</td>'
         . '<td>'.$fila['codigo_ter'].'</td>'
        . '<td>'.$fila['codigo_tm'].'</td>'
        . '<td>'.$fila['id_orden'].'</td>'
        . '<td>'.$numeroConCeros.'</td>'
        . '<td>'.$fila['bod_codigo'].'</td>'
        . '<td>'.$tip['movimiento'].'</td>'
        . '<td>'.$estado.'</td><td>'.$fila['fecha_pro'].'</td><td>'.$fila['usuario'].'</td>'
        . '<td><button onclick="'.$btn.'">Ver</button></td>'
        . '</tr>';
  }
   echo '<tr style="background:#E7E7E7"><td colspan="9">';
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
