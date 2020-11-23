<?php 
include '../../../modelo/conexioni.php';
session_start();
if(isset($_SESSION['k_username'])){
	if(isset($_POST['id_mov']) and $_POST['id_mov']!=0 and $_POST['id_mov']!=''){
	$query=mysqli_query($con,"SELECT * FROM mov_inventario a,cont_terceros b WHERE a.codigo_ter=b.cod_ter and a.id_mov='".$_POST['id_mov']."'");
	if($rw=mysqli_fetch_assoc($query)){
		$name=$rw['nom_ter'];
		$Fecha=$rw['fecha_pro'];
		$tipo=$rw['tipo_movimiento'];
		$codt=$rw['codigo_ter'];
		$ref=$rw['id_orden'];
                $obs=$rw['obs'];  
                $ccosto=$rw['cen_codigo'];
                $sed=$rw['sede']; 
		$bog=$rw['bod_codigo'];    
                $fom= str_pad($rw['rad_fom'], 9, "0", STR_PAD_LEFT);
		$nbog='';
		$sear=mysqli_query($con,"SELECT bod_nombre FROM bodegas WHERE bod_codigo='$bog'");
		if($row=mysqli_fetch_assoc($sear)){
			$nbog=$row['bod_nombre'];
		}
                if($tipo=='SALIDA'){
                    $documento = 'O';
                }else{
                    $documento = 'O.C';
                }
	}

?>
<!DOCTYPE html>
<html>
<head>
    <title>.</title>

	<link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery-ui.custom.min.css" />
        <link rel="stylesheet" href="../../assets/css/jquery.gritter.min.css" />
        <link rel="stylesheet" href="../../assets/css/fonts.googleapis.com.css" />
        <link rel="stylesheet" href="../../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <link rel="stylesheet" href="../../assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="../../assets/css/ace-rtl.min.css" />
        <link rel="stylesheet" href="../../assets/css/chosen.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datepicker3.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-timepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/daterangepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-datetimepicker.min.css" />
        <link rel="stylesheet" href="../../assets/css/bootstrap-colorpicker.min.css" />
</head>
<body style="background-color: white;">
    <center>TEMPLADO S.A.S</center>
<center>800112904-6</center>
<center>Calle 72 # 65-228 TEL: 3530218-3600178</center>
<center>BARRANQUILLA - COLOMBIA</center>                           <div align="right"> <b>Documento No. <?php echo $fom;?></b></div>
<br>
    <div style="width: 50%; float: left">
        <table style="width:100%">
            <tr>
                <td><label>No movimiento:</label></td>
                  <td style="text-align: left"><?php echo $_POST['id_mov'];?> 
                </td>
            </tr>
              <tr>
                <td><label>Tercero:</label></td>
                  <td style="text-align: left"><?php echo $name;?> 
                </td>
            </tr>
            <tr>
              <td><label>Fecha:</label></td>
                  <td style="text-align: left"><?php echo $Fecha;?> 
                </td> 
            </tr>
          
                 <tr>
              <td><label>Codigo Bodega:</label></td>
                  <td style="text-align: left"><?php echo $bog;?> 
                </td> 
            </tr>
        </table>
        
    </div>
       <div style="width: 50%; float: left">
           <table style="width: 100%">
                     <tr>
              <td><label>Tipo Mov:</label></td>
                  <td style="text-align: left"><?php echo $tipo;?> 
                </td> 
            </tr>
                              <tr>
              <td><label>Cod. Tercero:</label></td>
                  <td style="text-align: left"><?php echo $codt;?> 
                </td> 
            </tr>
                           <tr>
              <td><label>Orden No.:</label></td>
                  <td style="text-align: left"><?php echo $ref;?> 
                </td> 
            </tr>
                          <tr>
              <td><label>Bodega:</label></td>
                  <td style="text-align: left"><?php echo $nbog;?> 
                </td> 
            </tr>
           </table>
       </div>  <br> <br>

	
<div style="width: 100%;">
    <br>
	<table class="table table-hover" >
            <br>
		<tr class="bg-info">
		<th nowrap>COD</th>
		<th>DESCRIPCION</th>
                <th>MEDIDA</th>
                <TH>COLOR</TH>
                <TH>UBICACION</TH>
		<th>CANTIDAD</th>
                <TH NOWRAP>VLR UNIDAD</TH>
		<th NOWRAP>VLR TOTAL</th>
                        
	<tbody id="mostrar_tabla">
                        
		 		<?php     
		 			$id_mov=$_POST['id_mov'];
		 			$sql=mysqli_query($con,"SELECT a.costo_ult_com,costo_ult_sal,valor_unidad, color, b.medida, a.cantidad_mov, ubicacion, codigo_pro,b.desc_prod FROM mov_detalle_ubi a,mov_detalle b WHERE a.id_ref_mov=b.id_ref_mov and a.id_mov='$id_mov'");
		 			
                                        $sumat=0;
                                        $sumac=0;
                                        while ($row=mysqli_fetch_assoc($sql)) {
		 				 
                                            $totals=$row['cantidad_mov']*$row['valor_unidad'];
                                            $sumat +=$totals;
                                            $sumac += $row['cantidad'];
		 			    echo '<tr>';
		 			    echo '<td>'.$row['codigo_pro'].'</td>';
		 			    echo '<td NOWRAP>'.$row['desc_prod'].'</td>';
                                            echo '<td style="text-align: center">'.$row['medida'].'</td>';
                                            echo '<td>'.$row['color'].'</td>';
		 			    echo '<td style="text-align: center">'.$row['ubicacion'].'</td>';
                                            echo '<td style="text-align: right">'.number_format($row['cantidad_mov'],2).'</td>';
                                            echo '<td style="text-align: right">'.number_format($row['valor_unidad'],2).'</td>'; 
                                            echo '<td style="text-align: right">'.number_format($totals,2).'</td>'; 
		 			    echo '</tr>';
		 			}
                                        $iva = $sumat*0.19;
                                        $tot = $sumaT+  $iva;
                                        echo '<tr>';
                                        echo '<td colspan="5" style="text-align: right"><b>TOTALES $</b></td>';
                                        echo '<td style="text-align: right">'.number_format($sumac,2).'</td>';
                                        echo '<td></td>';
                                        echo '<td style="text-align: right">'.number_format(($sumat-$iva),2).'</td>';
                                        
                                        echo '<tr>';
                                        echo '<td colspan="5" style="text-align: right"><b>IVA $</b></td>';
                                        echo '<td style="text-align: right"></td>';
                                        echo '<td></td>';
                                        echo '<td style="text-align: right">'.number_format($iva,2).'</td>';
                                        
                                        echo '<tr>';
                                        echo '<td colspan="5" style="text-align: right"><b>GRAN TOTAL $</b></td>';
                                        echo '<td style="text-align: right"></td>';
                                        echo '<td></td>';
                                        echo '<td style="text-align: right">'.number_format($sumat,2).'</td>';
		 		?>
		    </tbody>
                    
	</table>
</div>
    <br><br> <br><br> <br><br>
    <h5>COSTO #: &nbsp; <?php echo $ccosto;?></h5> 
    <h5>PLANTA : &nbsp; <?php echo $sed;?></h5> 
    <h5>OBSERV : &nbsp; <?php echo $obs;?></h5> 
          <br><br>
          <DIV class="">
            <DIV style="float: left">
                <h5>_____________________<br>FIRMA ACEPTADA <br>Por: &nbsp; <?php echo ($_SESSION['k_username']); ?></h5>
            </DIV>
            <DIV style="float: right">
                <h5>______________________<br>RECIBI CONFORME</h5>  
            </DIV>
        </DIV>
<script type="text/javascript"> 
	window.print();
</script>

</body>


</html>
<?php
	}
}
?>