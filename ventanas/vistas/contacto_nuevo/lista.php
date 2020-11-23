<?php 
include '../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    
     $nomn= $_GET['nom_conc'];
     $page= $_GET['page'];
     
     $request = mysqli_query($con,"SELECT count(*) FROM sis_contacto where nombre_cont like '%".$nomn."%' ");

            if($request){
                    $req = mysqli_fetch_row($request);
                    $num_items = $req[0];
            }else{
                    $num_items = 0;
            }

            $rows_by_page = 8;

            $last_page = ceil($num_items/$rows_by_page);

                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_contacto_nuevo(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_contacto_nuevo(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_contacto_nuevo(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_contacto_nuevo(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
                $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
    ?>
                        <div style="float: right">
                            <button onclick="nuevo()"><img src="../imagenes/contac.png" width="23px" height="23px"><b>NUEVO CONTACTO</b></button>
                        </div><br>
<div class="table-responsive">          
  <table class="table">
    <tr class="bg-info">
      <th>id contacto</th> 
        <th>Nombre del Contacto</th> 
        <th>Telefonos</th> 
        <th>Email</th> 
        <th>Cargo</th> 
        <th>Observaciones</th>  
      
        <th>Opciones</th>  
    </tr>
    <?php

    $query = mysqli_query($con,"SELECT * FROM sis_contacto where nombre_cont like '%".$nomn."%' order by id_contacto desc " .$limit);
     
    while ($fila = mysqli_fetch_array($query)){
       
        echo '<tr>' 
       . '<td>'.$fila['id_contacto'].'</td>'
       . '<td>'.$fila['nombre_cont'].' '.$fila['apellido_cont'].'</td>'
       . '<td>'.$fila['celular'].'</td>'
      . '<td><a href="mailto:'.$fila['email1'].'">'.$fila['email1'].'</a></td>'
       . '<td>'.$fila['area_user'].'</td>'
       . '<td>'.$fila['notas'].'</td>'
      
       . '<td> <button onclick="editar_loscontactosn('.$fila['id_contacto'].')" class="glyphicon glyphicon-pencil"> </button>'
       . '<button onclick="borrar('.$fila['id_contacto'].')" class="glyphicon glyphicon-remove"> </button></td>';
    
    }
    
    ?>
</table>
    </div>
<?php  }else {

    header("location:../index.php");
    
}  ?>

 