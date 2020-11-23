<?php 
include '../../../modelo/conexioni.php';
session_start();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor. cot 65642  1066175625
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>TEMPLADOS SAS</title>
            <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
          <style> 
              table{
                 border-color: #dcdcdc; 
              }
               body {
                font-size: 90%;
              }
          </style>
    </head>
    <body onload="window.print()">
       
         <?php 
$pen= $_GET['pen'];
   $fac= $_GET['fac'];
    if($pen==0){
        $pendientes = ' and cantidad_rec="0" ' ;
    }else if($pen==1){
        $pendientes = ' and cantidad_rec>0 ' ;
    }else{
         $pendientes = ' ' ;
    }
   if($fac==''){
        $fat = ' and factura_pedido="" ' ;
    }else{
        $fat = ' and factura_pedido>0 ' ;
    } 
if($_GET['n_fech']=='' && $_GET['h_fech']==''){
   $fbb ='';
   }else{
   $fbb ='and fecha >= "'.$_GET['n_fech'].'" and fecha <= "'.$_GET['h_fech'].'" ';
   }
$request_ac = mysqli_query($con,"SELECT * FROM orden_compra a,orden_compra_detalle b where a.codigo=b.codigo_orden $pendientes $fat and a.ordenfom like '%".$_GET['sol']."' and a.nom_ter like '%".$_GET['pro']."%'  and b.codigo like '%".$_GET['cod']."%' and b.descripcion like '%".$_GET['des']."%' and a.observaciones_compra like '%".$_GET['n_obs']."%' $fbb order by b.codigo_orden desc " );
$total2=0;

echo "<table border=2>";
echo '<tr>'
 . '<td>PROVEEDOR</td>'
 . '<td>ORDEN</td>'
 . '<td>CODIGO</td>'
 . '<td>DESCRIPCION</td>'
 . '<td>FECHA REGISTRO</td>'
 . '<td>CANT SOL</td>'
 . '<td>CANT PED</td>'
 . '<td>VALOR UNIDAD</td>'
 . '<td>VALOR TOTAL</td>'
 . '</tr>';
   
	while($fila=mysqli_fetch_array($request_ac))
	{  
        echo '<tr>'
                . '<td>'.$fila['nom_ter'].'</td>'
                . '<td>'.$fila['ordenfom'].'</td>'
                . '<td>'.$fila['codigo'].'</td>'
                . '<td>'.$fila['descripcion'].'<br>'.$fila['estado'].' '.$fila['aprobado_por'].'</td>'
                . '<td>'.$fila['mod_fec'].'</td>'  
                . '<td>'.$fila['cantidad'].'</td>'
                . '<td>'.$fila['cantidad_rec'].'</td>'
                . '<td>'.number_format($fila['precio'],0,',','.').'</td>'
                . '<td>'.number_format($fila['cantidad']*$fila['precio'],0,',','.').'</td></tr>';  
  }

?></table>
    </body>
</html>





