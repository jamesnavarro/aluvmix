<?php
date_default_timezone_set("America/Bogota" ) ; 
$hora = date('H:i:s',time() - 3600*date('I'));
$fecha_hoy = date("Y-m-d").' '.$hora;
?>
<!DOCTYPE html>
<html>
<head>
	<title>Planilla Inventario</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../assets/css/jquery.gritter.min.css" />
		<link rel="stylesheet" href="../assets/css/fonts.googleapis.com.css" />
		<link rel="stylesheet" href="../assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		<link rel="stylesheet" href="../assets/css/ace-skins.min.css" />
		<link rel="stylesheet" href="../assets/css/ace-rtl.min.css" />
		<link rel="stylesheet" href="../assets/css/chosen.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="../assets/css/bootstrap-colorpicker.min.css" />
		<link rel="icon" type="image/png" href="../imagenes/aluvmix.png" />
</head>
<body style="background-color: white;">
	
	<center><b>Fecha: <?php echo $fecha_hoy;?></b></center>
	<table class="table  table-bordered table-hover">
			<tr>
			<th>CODIGO</th>
			<th>DESCRIPCION</th>
			<th>STOCK SISTEMA</th>
			<th>STOCK FISICO</th>
		</tr>
		<tbody>
			<?php
			include '../../modelo/conexioni.php';
			$sql=mysqli_query($con, "SELECT p.codigo, p.descripcion, pr.stock_actual FROM productos_var p INNER JOIN pro_stock  pr ON pr.codigo_pro=p.codigo");
			while ($row=mysqli_fetch_assoc($sql)) {
				echo '<tr>';
				echo '<td>'.$row['codigo'].'</td>';
				echo '<td>'.$row['descripcion'].'</td>';
				echo '<td>'.$row['stock_actual'].'</td>';
				echo '<td></td>';
				echo '</tr>';
			}
			?>
		</tbody>
	</table>

<br>
	   <b>__________________________</b><br>
	   <b>FIRMA</b>
<script type="text/javascript">
	window.print();
</script>
</body>
</html>