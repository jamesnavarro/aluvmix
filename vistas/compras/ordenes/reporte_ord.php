<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
         
    </head>
    <body style="background: white;" onload="window.print();">
    <center>
        <table id="dynamic-table" style="width: 100%;font-size: 9px">
            <tr class="bg-info">
               
                <th>ORDEN </th>
                 <th>No SOL &nbsp;</th>
                 <th>No FOM &nbsp;</th>
                 <TH>NIT &nbsp;</TH>
                 <TH>PROVEEDOR&nbsp;</TH>
                 <TH>PRODUCTO;</TH>
                 <TH>FECHA&nbsp;</TH>
                 <TH>ESTADO&nbsp;</TH>
                 <TH>USUARIO&nbsp;</TH>  
            </tr><tr></tr><tr></tr>
     
        <?php  
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
    $cod= $_GET['cod'];
    $des= $_GET['des'];
    $nit= $_GET['nit'];
    $provee= $_GET['provee'];
    $fec= $_GET['fec'];
    $est= $_GET['est'];
    $page= $_GET['page'];
    $usu= $_GET['usu'];
    $fom= $_GET['fom'];   
       
            $request_ac = mysqli_query($con,"SELECT * FROM orden_compra a, orden_compra_detalle b where a.codigo=b.codigo_orden and a.ordenfom like '%".$fom."%' and a.usuario like '%".$usu."%' and a.codigo like '%".$cod."%' and a.id_sol like '%".$des."%' and a.cod_ter like '%".$nit."%' and a.nom_ter like '%".$provee."%' and a.fecha like '%".$fec."%' and a.estado like '%".$est."%' and a.id_sol!=0 ".'Order by a.fecha DESC ' );
            $total2=0;
             while($fila=mysqli_fetch_array($request_ac))
{  
 if ($fila['estado']== 'En Proceso') {
         $estado='blue';
     }else if ($fila['estado']== 'Anulado') {
        $estado='red';
     }else{
         $estado='green';
     }
     if ($fila['enviado']== 0) {
         $send = '<font color="red">Sin enviar</font>';
     }else{
          $send = '<font color="green">Enviado</font>';
     }
     $cod = "'".trim($fila['id_sol'])."'".','."'".trim($fila['codigo'])."'";
     
        echo '<tr>'
        . '<td>'.$fila['codigo'].'</td>'
	. '<td>'.$fila['id_sol'].'</td>'
        . '<td>'.$fila['ordenfom'].'</td>'
        . '<td>'.$fila['cod_ter'].'</td>'
        . '<td>'.$fila['nom_ter'].'</td>'
        . '<td>'.substr($fila['descripcion'],0,54).'</td>'
        . '<td>'.$fila['fecha'].'</td>'
        . '<td><font color="'.$estado.'">'.$fila['estado'].'</font></td>'
        . '<td>'.$fila['usuario'].'</td>'
        . '</tr>';
  }
?>

<?php }else {
      echo 'error';
}?>
          </table></center>
    </body>
</html>
