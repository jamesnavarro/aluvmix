<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
     $numced= $_GET['nom'];
     $estado= $_GET['estad'];
     $fechini= $_GET['ini'];
     $obra= $_GET['fin'];
     $usu= $_GET['fusuarioc'];
     $clie= $_GET['cli'];
     $page= $_GET['page'];
            $request = mysqli_query($con,"SELECT count(*) from actividad a, sis_contacto b, cont_terceros c where a.id_contacto=b.id_contacto and a.id_tercero=c.id_ter and a.estado like '%".$estado."%' and b.nombre_cont like '%".$numced."%' and a.StartTime like '".$fechini."%' and a.user like '".$usu."%' and c.nom_ter like '".$clie."%' ");
            if($request){
                    $request = mysqli_fetch_row($request);
                    $num_items = $request[0];
            }else{
                    $num_items = 0;
            }  
             $rows_by_page = 7;
             $last_page = ceil($num_items/$rows_by_page);
             $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
             $query = mysqli_query($con,"SELECT a.estado, a.id_seleccionado, a.reg_user, a.Id, a.Subject, a.prioridad,a.Description,a.StartTime,a.id_tercero,b.tel_oficina,b.celular, b.nombre_cont, b.email1,c.nom_ter"
             . " from actividad a, sis_contacto b, cont_terceros c "
             . "where a.id_contacto=b.id_contacto and a.id_tercero=c.id_ter and a.estado like '%".$estado."%' and b.nombre_cont like '%".$numced."%' and a.StartTime like '".$fechini."%' and a.user like '".$usu."%' and c.nom_ter like '%".$clie."%' ".$limit);
   
    $com = 0; $plan = 0;
    while ($fila = mysqli_fetch_array($query))
     {
        if($fila['estado']=='Planificada'){
            $stilo = ' style="background-color:red;" ';
            $plan += 1; 
        }else{
             $stilo = ' style="background-color:green;" ';
             $com += 1;
        }
        if($fila['id_seleccionado']!='0'){
            $query2 = mysqli_query($con,"select nombre_obra from informacion_obras where id_inf='".$fila['id_seleccionado']."' ");
            $c = mysqli_fetch_assoc($query2);
            $ob = $c['nombre_obra'];
            $btn = '<img style="cursor:pointer" onclick="detalles('.$fila['id_seleccionado'].')" src="../imagenes/nuevocontacto.png">';
        }else{
            $ob = 'No registrada';
            $btn = '';
        }
        if ($_SESSION['k_username']== $fila['reg_user']){
            $boton=' <img style="cursor:pointer" onclick="editar_act('.$fila['Id'].')" src="../imagenes/modificar.png">';
        }else{
             $boton='';
        }
        $nom = "'".$fila['nom_ter']."'";
        echo '<tr>'
        . '<td>'.$fila['nom_ter'].'<br><b>Obra: </b>'.$ob.'<br><button onclick="programar('.$fila['id_tercero'].','.$nom.')"><img src="../imagenes/call.png" width="15px">Hist</button>'.$boton.$btn.'</td>'
        . '<td>'.$fila['Subject'].'<br><b>Reg</b>: '.$fila['reg_user'].'</td>'
        . '<td>'.$fila['nombre_cont'].'<br>tel:'.$fila['tel_oficina'].' '.$fila['celular'].'<br><a href="mailto:'.$fila['email1'].'">'.$fila['email1'].'</a></td>'
        . '<td><textarea disabled title="'.$fila['Description'].'">'.$fila['Description'].'</textarea></td>'  
        . '<td '.$stilo.'>'.$fila['estado'].'</td>'  
        . '<td>'.$fila['StartTime'].'</td>'
        . '<td>'.$fila['reg_user'].'</td>'; 
    } 
         echo '<tr><td colspan="9">';   
                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_actividades(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_actividades(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                  ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_actividades(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_actividades(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                echo 'Cantidad de Llamadas Totales:   '.$num_items; 
                 echo '</td></tr>';
             
    ?>
    <?php
    echo 'Llamadas Pendientes : <font color="red"> <b>'.$plan.'</b> </font>'
    ?> <br>
    <?php
    echo 'Llamadas completadas : <font color="green"> <b>'.$com.'</b> </font>'
    ?>
   
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
