<?php
include('../../../../modelo/conexioni.php');

 $page = $_GET['page'];
  $ref = $_GET['ref'];
   $par = $_GET['par'];
      if($par=='tipo_riel'){
       $mod = 'Rieles';
   }else{
       $mod = 'Alfajia';
   }

$sql = mysqli_query($con,"SELECT * FROM productos a, grupos_referencia b where a.pro_referencia=b.referencia and concat(a.pro_nombre,' ',a.pro_referencia) like '%".$_GET['nombre']."%' and modulo='$mod' ");
$item = 0;

    $c=0;
        while($mostrar = mysqli_fetch_array($sql)){
            $c +=1;
                $item = $item+1;
                $cod=$mostrar['pro_referencia'];
                

                $refe = "'".$mostrar['pro_referencia']."'";
                $nombre = "'".$mostrar['pro_nombre']."'";
                
                echo '<tr>
                         <td>'.$mostrar['pro_referencia'].'</td>
                        <td>'.$mostrar['pro_nombre'].'</td><td>'.$mostrar['descuento'].'</td>'
                        . '';
                //<td><input type="checkbox" id="sel'.$mostrar['pro_referencia'].'" onclick="pre_addparametrox('.$refe.','.$c.')"></td>
                }
               

                                    
                                    ?>
   
                        
