<?php 
include '../../../modelo/conexioni.php';
include '../../../modelo/consultar_permisos.php';
session_start();
if(isset($_SESSION['k_username'])){
      $ite= $_GET['ite'];
      if($ite==''){
          $it = '';
      }else{
          $it = ' and id_p = '.$ite.' ';
      }
      $codi= $_GET['codi'];
      $desc= $_GET['desc'];
      $refe= $_GET['refe'];
      $line= $_GET['line'];
      $ulti= $_GET['ulti'];
      $modi= $_GET['modi'];
      $page= $_GET['page'];
       $request = mysqli_query($con,"SELECT count(*) FROM producto where "
               . "revisado=0 and linea like '%".$line."%' and codigo like '%".$codi."%' and producto like '%".$desc."%' "
               . " and  fecha_adm like '%".$ulti."%' and modificado like '%".$modi."%' $it ");

           if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
        }else{
	$num_items = 0;
        }
          $rows_by_page = 10;

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
           echo '<tr><td colspan="11">';         
                if($page>1){?>
                        <img src="../imagenes/at1.png"  onclick="mostrar_lis(1)" style="cursor: pointer;">
                        <img src="../imagenes/at2.png"  onclick="mostrar_lis(<?php echo $page - 1;?>)" style="cursor: pointer;">
                <?php
              }else{
                        ?><img src="../imagenes/at1.png"> <img src="../imagenes/at2.png"><?php
                }
               
                ?>
                        (Pagina <input type="text" id="page" value="<?php echo $page;?>" style="width: 30px; height: 20px" disabled> de <?php echo $last_page;?>)
                <?php
               
                if($page<$last_page){?>
                        <img src="../imagenes/sig1.png"  onclick="mostrar_lis(<?php echo $page + 1;?>)" style="cursor: pointer;">
                        <img src="../imagenes/sig2.png" onclick="mostrar_lis(<?php echo $last_page;?>)" style="cursor: pointer;">
                <?php
                }else{
                        ?><img src="../imagenes/sig1.png"> <img src="../imagenes/sig2.png"> <?php
                }
               $limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
                echo 'Cantidad de registro '.$num_items; 
              echo '</td></tr>';
                
    ?> 
   <?php
                
                        
?>                      
                    


 <?php 

$request = mysqli_query($con,"SELECT * FROM producto where  revisado=0 and linea like '%".$line."%' and codigo like '%".$codi."%' and producto like '%".$desc."%' and  fecha_adm like '%".$ulti."%' and modificado like '%".$modi."%' $it order by id_p desc  ".$limit );
	
    while($fila=mysqli_fetch_array($request))
	{  

            

                    $codigo = "'".$fila['codigo']."'";
                        $x = '<a href="#Crear Items" onclick="productos_dos('.$codigo.')">'.$led2.'</a>';
                    
                    $res = 'select count(*) from hojas_rutas where codigo_pro="'.$fila['codigo'].'" ';
                    $f =mysqli_fetch_array(mysqli_query($con,$res));
                    $a = $f['count(*)'];

                    if($a==0){
                        $led = '<img src="../imagenes/warning.png">';
                    }else{
                        $led = '<img src="../imagenes/procesos.png">';
                    }
           
        if($fila['ruta']==''){
            $ima = '<img src="../producto/noimagen.png" style="width:80px">';
        }else{
            $ima = '<img src="../producto/'.$fila['ruta'].'" style="width:80px">';
        }
        $codigo = "'".$fila['codigo']."'";
           echo '<tr>'
        . '<td>'.$fila['id_p'].'</td>'
        . '<td>'.$ima.'</td>'
        . '<td>'.$fila['codigo'].'</td>'
        . '<td>'.$fila['producto'].'</td>'
        . '<td>'.$fila['linea'].'</td>'
   
        . '<td>'.$fila['fecha_adm'].'</td>'
        . '<td>'.$fila['modificado'].'</td>'
        . '<td style="cursor:pointer" onclick="pro_crearrutas('.$codigo.')" data-toggle="modal" data-target="#myModal">'.$led.'</td></tr>';               
        
        }
        
?>


 
<?php  }else {
   
    header("location:../");
    
}  ?>
