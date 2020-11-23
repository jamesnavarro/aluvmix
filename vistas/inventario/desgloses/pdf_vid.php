<?php
include '../../../modelo/conexionv1.php';
session_start();
	  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
       
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Lista de Accesorios</title>
		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../assets/font-awesome/4.5.0/css/font-awesome.min.css" />
		<link rel="shortcut icon" type="image/png" href="../assets/images/warehouse.png"/>
                 <style> 
              body {
                font-size: 90%;
              }
          </style>
	</head>
        

        <body style="background: white;" > 
<?php
$resultc = mysqli_query($con2,"select * from cotizacion where id_cot='".$_GET["cot"]."' ");
                     $rc = mysqli_fetch_array($resultc);
                     
?>
			<div class="main-content">
				<div class="main-content-inner">
				 <div class="container" style="margin-top: 3;font-size: 14px;">
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A</b><br>
				 		<b>800112904-6</b><br>
				 		CL 72 65-228<br>
				 		TEL:  3530128-3600173<br>
				 		<b>BARRANQUILLA</b><br>
				 		
				 	</div>
				 	<div style="width: 60%;float: right;">
                                            <b>LISTA DE ACCESORIOS</b><br><hr>
				 		<b>Fecha: <?php echo date("Y-m-d");?></b><br>
				 		
                                                <b>Cotizacion No. <?php echo $rc['numero_cotizacion'].'.'.$rc['version'];?></b><br>
				 		<b>Obra <?php echo $rc['obra'];?></b><br>
				 		
				 		
				 	</div>
				 	<div style="width: 100%;font-size: 11px">
				 		<hr style="width: 100%;">
				 		<table id="dynamic-table" style="width: 100%;font-size: 11px">
							<thead>
								 <tr>
                            
                                  <td>Referencia</td>
                                  <td>Descripcion</td>
                                  <td>Espesor</td>
                                  <td>Cantidad</td>
                                  <td>Peso</td>
                 
                                  
                              </tr>
							</thead>
							<tbody>
	<?php
	                       $cot = $_GET['cot'];
            $query = mysqli_query($con2,"select *, sum(area) as a, sum(peso) as p from desgloses_vidrios where id_cot='$cot' group by referencia  ");
            $c = 0;
            while($fila = mysqli_fetch_array($query)){
                $c++;
                echo '<tr>'
                . '<td>'.$c.'</td>'
                . '<td>'.$fila['referencia'].'</td>'
                . '<td>'.$fila['espesor'].'MM</td>'
                . '<td>'.ceil($fila['a']).' mt<sup>2</sup></td>'
                . '<td>'.number_format($fila['p'],2).' Kg</td>';
            }
		?>
	</tbody>
	</table>
		<hr style="width: 100%;">
		<hr style="width: 100%;">

				 	</div>
				</div>
			</div>
		</div>
<script type="text/javascript">
 			window.print();
 		</script>
  </body>
</html>
