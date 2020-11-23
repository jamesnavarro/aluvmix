<?php 
include '../../../modelo/conexioni.php';
session_start();
   $cod_k= $_GET['id'];
   $ubi_k= $_GET['ubi_k'];
   $usu_k= $_GET['usu_k'];
   $fec_k= $_GET['fec_k'];
   $bod= $_GET['bod'];
   $tmov_k= $_GET['tmov_k'];     
    $fec_f= $_GET['fec_f'].' 23:59:00';
    $color= $_GET['color'];
?>
<!DOCTYPE html>
<html lang="sp">
    <head>

        <title class="text-center">GENERADOR DE KARDEX DE ALUVMIX</title>
          <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
        <script src="../../../js/jquery.min.js"></script>
        <script src="../../../bootstrap-3.3.7/dist/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../../css/stilo.css">
                <script src="../../../js/sweetalert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../../../js/sweetalert.css">
        <script src="../vistas/produccion/puestos/funciones.js"></script>

    </head>
     
    <body>
        <div class="jumbotron text-center">
            <H2><b>REPORTE DE KARDEX POR UBICACION
               <P>Templados S.A.S</P>
               <h5><b>NIT</b> 800112904-6</h5>
        
</div>
    <center><table style="width:98%" BORDER="1">
        
        <tr>
          
            <th style="text-align:center"><h4><b>BODEGA</b></h4></th>
            <TH style="text-align:center"><h4><b>No.DOC.</b></h4></TH>
            <TH style="text-align:center"><h4><b>COD.MOV</b></h4></TH>
            <TH style="text-align:center"><h4><b>CONCEPTO</b></h4></TH>
            <TH style="text-align:center"><h4><b>INV.INICIAL</b></h4></TH>
            <TH style="text-align:center"><h4><b>ENTRADA</b></h4></TH>
            <TH style="text-align:center"><h4><b>SALIDA</b></h4></TH>
            <TH style="text-align:center"><h4><b>STOCK</b></h4></TH>
            <TH style="text-align:center"><h4><b>UBICACION</b></h4></TH>
            <TH style="text-align:center"><h4><b>FECHA</b></h4></TH>
            <TH style="text-align:center"><h4><b>USUARIO</b></h4></TH>
        </tr>
        
        <TR>
       
        <?php 
        if($color==''){
            $colr = '';
        }else{
            $colr = ' and b.color_du = "'.$color.'" ';
        }
           $query = mysqli_query($con,"SELECT *, a.usuario FROM mov_inventario a, mov_detalle_ubi b, productos_var c where a.id_mov=b.id_mov and b.codigo_pro=c.codigo and b.codigo_pro like '%".$cod_k."%' and b.ubicacion like '%".$ubi_k."%' and a.usuario like '%".$usu_k."%' and a.fecha_pro between '$fec_k' and '$fec_f' and b.bodega like '%".$bod."%' and a.tipo_movimiento like '%".$tmov_k."%'  order by b.codigo_pro, b.ubicacion, b.fecha_ult_com asc ");
           $total2=0;
           $saldo_inicial=0;
           $cont = 0;
           $Tentrada = 0;
           $Tsalida = 0;
           $stock = 0;
           $des = '';
           $ubi='';
           $c = 0;
	  while($fila=mysqli_fetch_array($query))        
	 {  
              $QUERY = mysqli_query($con,"select movimiento from tipos_movimientos where codigo_tm='".$fila['codigo_tm']."' ");
              $tm = mysqli_fetch_row($QUERY);
              $mo = $tm[0];
              
              $cont += 1;
          
           if($cont==1){
               $saldo_inicial = $fila['saldo_ubicacion'];
           }
           $stock = $saldo;

           $total2 +=$fila['cantidad_mov'];
           
            if($cont==1){
                echo '<tr style="background-color:#efefef">'
                . '<td style="text-align:center"></td>'
                        . '<td colspan="7">'.$fila['codigo_pro'].' '.$fila['descripcion'].' '.$fila['color_du'].'</td><td colspan="3"></td>';
            }else{
                 if($des!=$fila['codigo_pro'].$fila['color_du']){
                    
                      
                    
                     echo '<tr style="background-color:#FDEBD0">
                <td colspan="4"><label style="float: right"><b><B>TOTAL</B></b></label></td>
                <td style="text-align:right">'.number_format($saldo_inicial).'</td>
                <td style="text-align:right">'.number_format($Tentrada).'</td>
                <td style="text-align:right">'.number_format($Tsalida).'</td>
                <td style="text-align:right">'.number_format(($Tentrada-$Tsalida)).'</td>
                <td>Cantidad de Items</td>
                <td style="text-align:center">'.$c.'</td><td></td>
                </tr>';
                     
                echo '<tr style="background-color:#efefef">'
                . '<td style="text-align:center"></td>'
                . '<td colspan="7">'.$fila['codigo_pro'].' '.$fila['descripcion'].' '.$fila['color'].'</td></td><td colspan="3"></td>';
                    $c =0;
                    $Tsalida = 0;
                    $Tentrada = 0;
                  $saldo_inicial=0;
                }else{
                    
                }
                    
            }
             if($fila['tipo_movimiento']=='ENTRADA'){
               $saldo = $fila['cantidad_mov'] + $fila['saldo_ubicacion'];
               $entrada = $fila['cantidad_mov'];
               $Tentrada += $fila['cantidad_mov'];
           }else{
               
                $entrada = 0;
           }
           if($fila['tipo_movimiento']=='SALIDA'){
               $saldo =  $fila['saldo_ubicacion']-$fila['cantidad_mov'];
               $salida = $fila['cantidad_mov'];
               $Tsalida += $fila['cantidad_mov'];
           }else{
              
                $salida = 0;
           }
            $c ++;
           
             echo '<tr>'
     
              . '<td style="text-align:center">'.$fila['codigo_pro'].'</td>'
                                   . '<td style="text-align:center">'.$fila['id_mov'].'</td>'
                     . '<td style="text-align:center">'.$fila['codigo_tm'].'</td>'
              . '<td style="text-align:left">'.$mo.'</td>'
              . '<td style="text-align:right">'.number_format($fila['saldo_ubicacion']).'</td>'
              . '<td style="text-align:right">'.number_format($entrada).'</td>' 
              . '<td style="text-align:right">'.number_format($salida).'</td>'
              . '<td style="text-align:right">'.$saldo.'</td>'
              
              . '<td style="text-align:center">'.$fila['ubicacion'].'</td>'
              . '<td style="text-align:center">'.$fila['fecha_pro'].'</td>'
              . '<td style="text-align:center">'.$fila['usuario'].'</td>';
             
             $des = $fila['codigo_pro'].$fila['color_du'];
             $ubi = $fila['ubicacion'];
            }
            echo '<tr style="background-color:#FDEBD0">
            <td colspan="4"><label style="float: right"><b><B>TOTAL</B></b></label></td>
            <td style="text-align:right">'.number_format($saldo_inicial).'</td>
                <td style="text-align:right">'.number_format($Tentrada).'</td>
                <td style="text-align:right">'.number_format($Tsalida).'</td>
                <td style="text-align:right">'.number_format(($Tentrada-$Tsalida)).'</td>
                <td></td>
                <td>Cantidad de Items</td>
                <td style="text-align:center">'.$c.'</td>
            </tr>';
        
        
        ?>
        </TR>
       
            </table></center>
        
<!--        <BR><BR><BR>
       
        <DIV>
            <DIV style="float: left">
                <h5>_____________________<br>ELABORADO POR <BR> <?php echo $p[7]; ?><br>Fecha <?php echo date('Y-m-d H:s:i')?></h5>
            </DIV>
            <DIV style="float: right">
                <h5>_____________________<br>RECIBIDO POR</h5>  
            </DIV>
        </DIV>
        
        <div><p></p></div>-->
  
        
        
 </body>
</html>
