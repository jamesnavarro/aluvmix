<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open tahe template in the editor. cot 65642  1066175625
-->
<?php 
include '../../../modelo/conexioni.php';
session_start();
?>
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
        <br>
         <?php  
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $res=$_GET['res'];
    $usu=$_GET['usu'];
    $bod=$_GET['bod'];
   

$request_ac = mysqli_query($con,"SELECT * FROM relacion_ubicaciones where codigo_pro like '%".$cod."%' and ubicacion like '%".$des."%' and fecha_ult_ent like '%".$res."%' and ultimo_usuario like '%".$usu."%' and bod_codigo like '%".$bod."%' ");
 $total2=0;
echo "<center><table style=width:90% border=3>";
echo '<tr>'
 . '<td>CODIGO</td>'
 . '<td>UBICACION</td>'
 . '<td>STOCK</td>'
 . '<td>FECHA ENTRADA</td>'
 . '<td>BODEGA</td>'
 . '<td>USUARIO</td>'
 . '</tr>';

while($fila=mysqli_fetch_array($request_ac))
{  
 
 echo '<tr>'
        . '<td>'.$fila['codigo_pro'].'</td>'
        . '<td>'.$fila['ubicacion'].'</td>'
        . '<td>'.$fila['stock_ubi'].'</td>'
        . '<td>'.$fila['fecha_ult_ent'].'</td>'
        . '<td>'.$fila['bod_codigo'].'</td>'
        . '<td>'.$fila['ultimo_usuario'].'</td>'
        . '</td>';
  }
 echo "</table>";
?>
    </body>
</html>





