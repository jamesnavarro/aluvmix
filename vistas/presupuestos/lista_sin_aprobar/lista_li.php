<?php 
include '../../modelo/conexioni.php';
include '../../modelo/consultar_permisos.php';
session_start();
if(isset($_SESSION['k_username'])){
      $lilis= $_GET['lineb'];
      $buslis= $_GET['buscb'];
      $estlis= $_GET['estb'];
      $deslis= $_GET['desglb'];
      $page= $_GET['page'];
       $request = mysqli_query($con,"SELECT count(*) FROM producto where aprobado=0 order by linea " );

           if($request){
	$request = mysqli_fetch_row($request);
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
 <?php
 if(isset($_POST['buscar'])){
    $request=mysqli_query($con,"SELECT * FROM producto where producto like '%".$_POST['buscar']."%' or codigo like '".$_POST['buscar']."%' or referencia_p like '%".$_POST['buscar']."%'  order by linea ");

}else{
    $request=mysqli_query($con,"SELECT * FROM producto where aprobado=0 order by linea  ");
}  
     
if($request){
 
       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Item'.'</th>';
              $table = $table.'<th width="5%">'.'Codigo'.'</th>';             
              $table = $table.'<th width="30%">'.'Producto'.'</th>';
              $table = $table.'<th  class="hidden-phone">'.'Referencia'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Linea'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Fecha Reg.'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Ultima Modificacion'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Registrado por'.'</th>';
               $table = $table.'<th  class="hidden-phone">'.'Modificado por'.'</th>';
              $table = $table.'<th>'.'Ver'.'</th>';
               $table = $table.'<th>'.'Areas'.'</th>';
                $table = $table.'<th>'.'Comp.'.'</th>';
               $table = $table.'<th>'.'Copiar'.'</th>';
               $table = $table.'<th>'.'Borrar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
              
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{    
            $res2 = 'select count(*) FROM producto a, producto_rep_ad b, referencia_admin c where b.id_ref_ad=c.id_ref_ad and a.id_p=b.id_p and a.id_p='.$row['id_p'].'';
            $f2 =mysqli_fetch_array(mysqli_query($con,$res2));
            $a2 = $f2['count(*)'];
            
            if($a2==0){
                $led2 = '<img src="../imagenes/warning.png">';
            }else{
                $led2 = '<img src="../imagenes/lupa.png" width="20px">';
            }
            
            $request2=mysqli_query($con,'select count(*) FROM producto a, compuestos b where a.id_p=b.id_prod_comp and b.id_prod='.$row['id_p'].' ');
	    if($request2){
	      $request2 = mysqli_fetch_row($request2);
	         $num_items = $request2[0];
              }else{
	         $num_items = 0;
              }
                if($ver_conf == 'Habilitado'){
                    if($row['especial']==1){
                        $x = '<a href="../vistas/?id=add_fac&cod='.$row['id_p'].'">'.$led2.'</a>';
                    }else{
                        $x = '<a href="../vistas/?id=add_cot&cod='.$row['id_p'].'"><button>'.$led2.'</button></a>';
                    } 
                    $res = 'select count(*) from pt_procesos a, subproceso b where a.id_subpro=b.id_subpro and a.id_proceso='.$row['id_p'].' order by a.orden asc ';
                    $f =mysqli_fetch_array(mysqli_query($con,$res));
                    $a = $f['count(*)'];

                    if($a==0){
                        $led = '<button><img src="../imagenes/warning.png"></button>';
                    }else{
                        $led = '<button><img src="../imagenes/procesos.png"></button>';
                    }
                }else{
                    $x = '';
                    $led = '';
                }
                    
            $table = $table.'<tr><td  width="5%">'.$row['id_p'].'</td>'
                    . '<td width="5%">'.$row['codigo'].'</td>'
                    . '<td width="30%">'.$row['producto'].'</td>'
                    . '<td  class="hidden-phone">'.$row["referencia_p"].'</td>'
                    . '<td  class="hidden-phone">'.$row["linea"].'<font></a></td>
                        <td  class="hidden-phone">'.$row["registro"].'<font></a></td>
                            <td  class="hidden-phone">'.$row["fecha_adm"].'<font></a></td>
                                <td  class="hidden-phone">'.$row["registrado_por"].'<font></a></td><td  class="hidden-phone">'.$row["modificado"].'<font></a></td>
               <td>'.$x.'</td>'
                    . '<td class="hidden-phone"><a href="../vistas/?id=procesos&cod='.$row['id_p'].'&linea='.$row["linea"].'">'.$led.'</a></td>'
                    . '<td class="hidden-phone"><a href="../vistas/?id=compuestos&cod='.$row['id_p'].'&linea='.$row["linea"].'"><button><img src="../imagenes/puzzle_3.png">('.$num_items.')</button></a></td>'
                    . '<td class="hidden-phone"><a href="../modelo/copiar_producto.php?cod='.$row['id_p'].'&linea='.$row["linea"].'"><button><img src="../imagenes/copiar.png"></button></a></td>'
                    . '<td><button onclick="borrar('.$row['id_p'].');"><img src="../imagenes/eliminar.png"></button></td></tr>';   
     
	}
        
	$table = $table.'</table>';
        
	echo $table;

 ?>
 </div>
 
<?php  }}else {
   
    header("location:../index.php");
    
}  ?>
