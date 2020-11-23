<?php 
include '../../modelo/conexion.php';
include '../../modelo/consultar_permisos.php';
session_start();
if(isset($_SESSION['k_username'])){
      $lilis= $_GET['lineb'];
      $buslis= $_GET['buscb'];
      $estlis= $_GET['estb'];
      $deslis= $_GET['desglb'];
      $page= $_GET['page'];
       $request = mysql_query("SELECT count(*) FROM producto where  estado_producto=0 and  actualizado!=0 and revisado!=0 and linea like '%".$lilis."%' and  concat(producto,' ',codigo,' ',referencia_p)like '%".$buslis."%' and  tipo_vidrio like '%".$estlis."%'");

           if($request){
	$request = mysql_fetch_row($request);
	$num_items = $request[0];
        }else{
	$num_items = 0;
        }
          $rows_by_page = 5;

           $last_page = ceil($num_items/$rows_by_page);

           if(isset($_GET['page'])){
	        $page = $_GET['page'];
             }else{
	        $page = 1;
                }
        
             if(isset($_POST['linea'])){
  
                $lin = '&linea='.$_POST['linea'].'&b='.$_POST['b'].'&rev='.$_POST['rev'].'&des='.$_POST['des'].' ';
              }else{
           if(isset($_GET['linea'])){
    
             $lin = '&linea='.$_GET['linea'].'&b='.$_GET['b'].'&rev='.$_GET['rev'].'&des='.$_GET['des'].' ';
            }else{
             $lin ='';
              }
           }
              
                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_list(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_list(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_list(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_list(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
               $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
                
    ?>                      
                    
<div class="table-responsive">  
   
 <table class="table table-hover">
    <tr class="bg-info">
        <th>Items</th>
        <th>DT</th> 
        <th>DES</th>
        <th>Diseño</th>
         <th>Codigo</th>
         <th>Producto</th>
         <th>Referencia</th>
         <th>Linea</th>
         <th nowrap>Fecha registro</th>
         <th nowrap>Ultima modificacion</th>
         <th nowrap>Registrado por</th>
         <th nowrap>Modificado por</th>
          <th>Ver</th>
         <th>Areas</th>
         <th>Comp</th>
         <th>Copiar</th>
    </tr>
 <?php 

$request = mysql_query("SELECT * FROM producto where  estado_producto=0 and  actualizado!=0 and revisado!=0 and  linea like '%".$lilis."%' and  concat(producto,' ',codigo,' ',referencia_p)like '%".$buslis."%' and  tipo_vidrio like '%".$estlis."%' order by id_p asc ".$limit );
	
    while($fila=mysql_fetch_array($request))
	{  
            $res2 = 'select count(*) FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p='.$fila['id_p'].'';
            $f2 =mysql_fetch_array(mysql_query($res2));
            $a2 = $f2['count(*)'];
            
            if($a2==0){
                $led2 = '<img src="../imagenes/warning.png">';
            }else{
                $led2 = '<img src="../imagenes/ojo.png">';
            }
            
            $request2=mysql_query('select count(*) FROM producto a, compuestos b where a.id_p=b.id_prod_comp and b.id_prod='.$fila['id_p'].' ');
	    if($request2){
	      $request2 = mysql_fetch_row($request2);
	      $num_items = $request2[0];
              }else{
	      $num_items = 0;
              }
                    if($fila['especial']==1){
                        $x = '<a href="../vistas/?id=add_fac&cod='.$fila['id_p'].'">'.$led2.'</a>';
                    }else{
                        $x = '<a href="#" onclick="crear_cot('.$fila['id_p'].')">'.$led2.'</a>';
                    }
                    $res = 'select count(*) from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$fila['id_p'].' order by a.orden asc ';
                    $f =mysql_fetch_array(mysql_query($res));
                    $a = $f['count(*)'];

                    if($a==0){
                        $led = '<img src="../imagenes/warning.png">';
                    }else{
                        $led = '<img src="../imagenes/procesos.png">';
                    }
           
                    if($fila['actualizado']==0){
                        $up = '<img src="../imagenes/stop.png">';
                    }else{
                        $up = '<img src="../imagenes/ok.png">';
                    }
                    if($fila['revisado']==0){
                        $rev = '<img src="../imagenes/stop.png">';
                    }else{
                        $rev = '<img src="../imagenes/ok.png">';
                        }
        
           echo '<tr>'
        . '<td>'.$fila['id_p'].'</td>'
        . '<td>'.$rev.'</td>'
        . '<td>'.$up.'</td>'
        . '<td><img src="../producto/'.$fila['ruta'].'" style="width:80px"></td>'
        . '<td>'.$fila['codigo'].'</td>'
        . '<td>'.$fila['producto'].'</td>'
        . '<td>'.$fila['referencia_p'].'</td>'
        . '<td>'.$fila['linea'].'</td>'
        . '<td>'.$fila['registro'].'</td>'     
        . '<td>'.$fila['fecha_adm'].'</td>'
        . '<td>'.$fila['modificado'].'</td>'
        . '<td>'.$fila['registrado_por'].'</td>'
        . '<td>'.$x.'</td>'
       . '<td class="hidden-phone"><a href="#" onclick="crear_cot('.$fila['id_p'].')">'.$led.'</a></td>'
       . '<td class="hidden-phone"><a href="../vistas/?id=compuestos&cod='.$fila['id_p'].'&linea='.$fila["linea"].'"><img src="../imagenes/puzzle_3.png"></a>('.$num_items.')</td>'
       . '<td class="hidden-phone"><a href="../modelo/copiar_producto.php?cod='.$fila['id_p'].'&linea='.$fila["linea"].'"><img src="../imagenes/copiar.png"></a></td></tr>';               
        
        }
        
?>
</table>
 </div>
 
<?php  }else {
   
    header("location:../index.php");
    
}  ?>
