<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
     $nombre= $_GET['nomb'];
     $nomobr= $_GET['nomobraa'];
     $vende= $_GET['vennomm'];
     $numer= $_GET['numcontran']; 
     $fecha= $_GET['fechavaln'];
     $estado= $_GET['estanomn'];
     $page= $_GET['page'];
     if($estado==''){
             $est='';
         }else {
             $est=" and a.estado_cont = '".$estado."'";
         }
            $request=mysqli_query($con,"SELECT count(*) from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion and a.version=c.version and a.nombre_cliente like '%".$nombre."%' and a.nombre_obra like '%".$nomobr."%' and a.vendedor like '%".$vende."%' and a.numero_contrato like '%".$numer."%' and a.fecha_pago like '%".$fecha."%' $est ");

            $req = mysqli_fetch_row($request);
            $num_items = $req[0];
            
            $rows_by_page = 7;
            $last_page = ceil($num_items/$rows_by_page);
            
            $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page; 
            $request_ac = mysqli_query($con, "SELECT * ,a.vendedor from informacion_obras a, cont_terceros b, cotizacion c where a.id_ter = b.id_ter and a.numero_cot = c.numero_cotizacion and a.version=c.version and a.nombre_cliente like '%".$nombre."%' and a.nombre_obra like '%".$nomobr."%' and a.vendedor like '%".$vende."%' and a.numero_contrato like '%".$numer."%' and a.fecha_pago like '%".$fecha."%' $est order by id_inf desc " .$limit );
           
         $cancecont = 0; $nocance = 0;
           while ($fila = mysqli_fetch_array($request_ac)){
              if($fila['estado_cont']=='NC'){
                 $stilos = 'style="background-color:#428bca;" ';
                 $nocance += 1; 
              }else{
                  $stilos = 'style="background-color:green;" ';
                  $cancecont += 1;
               }
        
         echo '<tr>'
        . '<td>'.$fila['id_inf'].'</td>'
        . '<td  width="20%">'.$fila['nom_ter'].'</td>'
        . '<td width="20%">'.$fila['nombre_obra'].'</td>'
        . '<td>'.$fila['vendedor'].'</td>'
        . '<td nowrap>'.'<b> #Cont: </b>'.$fila['numero_contrato'].'<br>'.'<b>valor: $ </b>'.$fila['valor_cont'].'<br>'.'<b>Anticipo: $ </b>'.$fila['val_antici'].'<br>'.'<b>pendiente: $ </b>'.$fila['saldo'].'</td>'
        . '<td>'.$fila['fecha_pago'].'</td>'
        . '<td>'.$fila['observaciones'].'</td>'
        . '<td '.$stilos.'> '.$fila['estado_cont'].'</td>'
        . '<td nowrap><button onclick="car_detalles('.$fila['id_inf'].')" class="glyphicon glyphicon-list-alt"></button><a data-toggle="tab" href="#lin2"><button onclick="editar_pendientes('.$fila['id_inf'].')" class="glyphicon glyphicon-pencil"></button></a><button onclick="pdf('.$fila['id_inf'].')"><img src="../imagenes/print.png" width="10px"/></button></td>';
}
              echo '<tr><td colspan="6">';
              if($page>1){?>
                        <img src="images/at1.png"  onclick="mostrar_pendientes(1)" style="cursor: pointer;">
                        <img src="images/at2.png"  onclick="mostrar_pendientes(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="images/at1.png"> <img src="images/at2.png"><?php
                }
               
                ?>
                        (<b>Pagina</b> <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled><b>de</b><?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="images/sig1.png"  onclick="mostrar_pendientes(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="images/sig2.png" onclick="mostrar_pendientes(<?php echo $last_page;?>)" style="cursor: pointer;">
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
 