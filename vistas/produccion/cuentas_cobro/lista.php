<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    
       $clien_b= $_GET['clien_b'];
       $cod= $_GET['cod'];
       $ope_b= $_GET['ope_b'];
       $esta_b= $_GET['esta_b'];
       $usu_b= $_GET['usu_b'];
       $fec_b= $_GET['fec_b'];
       $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT id_cuenta FROM cuenta_cobro  a, puestos_trabajos b  where  a.puesto=b.id_puesto and a.cliente_nombre like '%".$clien_b."%' and b.nombre_puesto like '%".$cod."%' and a.operacion like '%".$ope_b."%' and a.estado like '%".$esta_b."%' and a.por like '%".$usu_b."%' and a.fecha like '%".$fec_b."%'");

            if($request){
                    $req = mysqli_num_rows($request);
                    $num_items = $req;
            }else{
                    $num_items = 0;
            }
            $rows_by_page = 5;
            $last_page = ceil($num_items/$rows_by_page);
            $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
            $request_ac = mysqli_query($con,"SELECT a.id_cuenta, b.nombre_puesto, a.operacion, a.por, a.fecha, a.cliente_nombre, a.cc_cliente, a.estado FROM cuenta_cobro  a, puestos_trabajos b  where  a.puesto=b.id_puesto and a.cliente_nombre like '%".$clien_b."%' and b.nombre_puesto like '%".$cod."%' and a.operacion like '%".$ope_b."%' and a.estado like '%".$esta_b."%' and a.por like '%".
            $usu_b."%' and a.fecha like '%".$fec_b."%' order by id_cuenta desc " .$limit );
            $total2=0;
	     while($fila=mysqli_fetch_array($request_ac))
	        {  

        echo '<tr>'
        . '<td>'.$fila['id_cuenta'].'</td>'
       . '<td nowrap>'.$fila['cliente_nombre'].'<br>'.'<b>CC :  </b>'.$fila['cc_cliente'].'</td>'
       . '<td nowrap>'.$fila['nombre_puesto'].'</td>'
       . '<td>'.$fila['operacion'].'</td>'
       . '<td>'.$fila['estado'].'</td>'
       . '<td>'.$fila['por'].'</td>'
       . '<td>'.$fila['fecha'].'</td>'
       . '<td style="text-align:center"><a data-toggle="tab" href="#agregar"><img src="../imagenes/ojo.png" width="30%" onclick="editar_cuentac('.$fila['id_cuenta'].')"></a>'
       . '</td>';
  }
  
   echo '<tr class="bg-info"><td colspan="8">';
                if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_cuentac(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_cuentac(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_cuentac(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_cuentac(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="images/sig1.png"> <img src="images/sig2.png"> <?php
                }
                
                echo 'Cantidad de registro '.$num_items; 
                echo '</td></tr>';
                 ?>
  
<?php  }else {
   
      echo 'error';
    
}  ?>
