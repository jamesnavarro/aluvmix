<?php 
include '../../../modelo/conexioni.php';
session_start();
$id = $_GET['id'];
           $query = mysqli_query($con,"SELECT a.*, b.nombre, b.apellido"
                . " FROM solicitudes_new a, usuarios b where a.user_id=b.id_user and a.id_sol='$id' ");
                 $fila = mysqli_fetch_array($query);
                     $p[0]=$fila['id_sol'];
                     $p[1]=$fila['fecha_reg'];
                     $p[2]=$fila['user_id']; 
                     $p[3]=$fila['estado'];
                     $p[4]=$fila['area_reg'];
                     $p[5]=$fila['fecha_solicitada'];
                     $p[6]=$fila['cod_empresa'];
                     $p[7]=$fila['aprobado_por'];
                     $p[8]=$fila['pre_aprobado']; 
                     $p[9]=$fila['obs_solicitud'];
                     $p[10]=$fila['relacion'];
                     $p[11]=$fila['numero'];
                     $p[12]=$fila['observacion'];
                     $p[13]=$fila['nombre'];
                     $p[14]=$fila['apellido'];
                     $p[15]=$fila['cosecutivo'];
                     $co = substr($fila['area_reg'],0, 4);
?>
<!DOCTYPE html>
<html lang="sp">
    <head>
        <title class="text-center">ALUVMIX</title>
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="../../../bootstrap-3.3.7/dist/css/bootstrap.min.css">
          <style> 
              table{
                 border-color: #dcdcdc;
                  
              }
              body {
                font-size: 94%;
              }
          </style>
    </head>
     
    <body onload="window.print()">
        <header><center><h4><B>TEMPLADOS S.A.S</B>
                 <BR></h4><H5>NIT<B>800112904-6</B>
                 </H5></center></header>
        <BR>
    <center>
        <table style="width: 98%">
            <tr>
                <th>Cosecutivo No.</th>
                <th><?php echo strtoupper($co).'-'.$fila['cosecutivo']; ?></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th>Numero de Solicitud</th>
                <th><?php echo $fila['id_sol']; ?></th>
                <th>Solicitado por:</th>
                <th><?php echo $fila['nombre'].'&nbsp;'.$fila['apellido']; ?></th>
            </tr>
            <tr>
                <th>Fecha de registro</th>
                <th><?php echo $fila['fecha_reg']; ?></th>
                <th>Estado:</th>
                <th><?php echo $fila['estado']; ?></th>
            </tr>
                <tr>
                <th>Area</th>
                <th><?php echo $fila['area_reg']; ?></th>
                <th>Aprobado por:</th>
                <th><?php echo $fila['aprobado_por']; ?></th>
            </tr>
            <tr>
                <th>Fecha de entrega</th>
                <th><?php echo $fila['fecha_solicitada']; ?></th>
                <th>Autoriza:</th>
                <th><?php echo $fila['pre_aprobado']; ?></th>
            </tr>
                          
        </table>
        </center>
        <br>
        <table>
             <tr>
                 <th>&nbsp;
                     Observaciones</th>
                 <th> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; 
                     <?php echo $fila['obs_solicitud']; ?></th>
            </tr>
        </table>
        <br><br>
    <center>
        <table style="width:98%" BORDER="1">
        <tr>
            <TH>&nbsp;COD</TH>
            <TH>&nbsp;REF</TH>
            <TH>&nbsp;DESCRIPCION</TH>
            <th>&nbsp;COLOR</th>
            <th>&nbsp;MEDIDA</th>
            <TH>&nbsp;CANTIDAD&nbsp;</TH>
            <th nowrap>&nbsp;PRECIO UNID</th>
            <th style="text-align:center">&nbsp;TOTAL</th>
            <th style="text-align:center">&nbsp;OBSERVACIONES</th>
        </tr>
        <tbody>
        <?php 
        $result = mysqli_query($con,"select * from solicitudes_item where id_sol='".$_GET['id']."' ");
        $total2=0;
        while($fila = mysqli_fetch_array($result)){
            $total2+=($fila['precio']*($fila['cantidad']-$fila['cantidad_pen'])); 
            $var=$fila['observacion'];
            $codigo=$fila['codigo'];
            $resux = mysqli_query($con,"select referencia from productos_var where codigo='$codigo' ");
            $r = mysqli_fetch_array($resux);
            $re = mysqli_error($con);
            $ref = $r['referencia'];
            echo '<tr>';
            echo '<td>'.$fila['codigo'].'</td>';
            echo '<td>'.$ref.'</td>';
            echo '<td>'.$fila['descripcion'].'</td>';
            echo '<td>'.$fila['color'].'</td>';
            echo '<td>'.$fila['medida'].'</td>';
            echo '<td style="text-align:center">'.($fila['cantidad']-$fila['cantidad_pen']).'</td>';
            echo '<td style="text-align:right">'.number_format($fila['precio'],2).'</td>';
            echo '<td style="text-align:right">$'.number_format($fila['precio']*($fila['cantidad']-$fila['cantidad_pen']),2).'</td>'
            . '<td>'.$fila['observacion'].'</td>';
        }
        '<br>';
         echo '<tr>
          <th nowrap colspan="7"><label style="float: right"><b>VALOR TOTAL</b></label></th> 
          <th>$'.number_format($total2,2).'</th><th>
          </tr>';
          echo '<tr>
              <th colspan="9">Nota &nbsp; &nbsp;'.($var).'</th>
         </tr>';
        ?>
          
        </tbody>
       
            </table>
    </center>
        <br><br>
        <BR>
        <DIV>
            <DIV style="float: left">
              <br>Impreso <?php echo date('Y-m-d H:s:i')?>
            </DIV>
        </DIV>
        <div><p></p></div>
      
 </body>
</html>
