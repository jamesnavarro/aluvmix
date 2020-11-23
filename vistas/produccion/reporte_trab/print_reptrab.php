<?php
 include '../../../modelo/conexionv1.php';
session_start();
	  if(!isset($_SESSION['k_username'])){ 
       echo '<script>alert("Su sesion caduco");location.href="../index.php";</script>';
        }
$consulta2= "SELECT * FROM `subproceso` where id_subpro='".$_GET['area']."'";                     
                                                 $re=  mysqli_query($con2,$consulta2);
                                                  $fila=  mysqli_fetch_array($re);
                                                      $nomarea=$fila['nombre_subpro'];
                                                      
$consulta3=  "SELECT * FROM `grupo` where id_g='".$_GET['grupo']."'";                     
                                                 $gru=  mysqli_query($con2,$consulta3);
                                                  $fila=  mysqli_fetch_array($gru);
                                                      $nomgrup=$fila['name'];
    $query2=mysqli_query($con2,"SELECT * FROM grupo_det a, usuarios b where a.id_user=b.id_user and a.id_g='".$_GET['grupo']."'  ");
         $user = '<ul>';
           while ($row = mysqli_fetch_array($query2)) {
               if($row['est']=='0'){
                   $esta = 'Act';
               }else{
                   $esta = '<b>X</b>';
               }
               $user =  $user.''
               . '<ul>'.$row['nombre'].' '.$row['apellido'].'</ul>';
           }                                                  
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>.</title>
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

        <body onload="window.print()" style="background: white;"  > 
		
			<div class="main-content">
				<div class="main-content-inner">
                                    <div class="container" style="margin-top: 3;font-size: 14px;"><br><br>
				 	<div style="width: 40%;float: left;">
				 		<b>TEMPLADO S.A</b><br>
				 		<b>800112904-6</b><br>
				 		CL 72 65-228<br>
				 		TEL:  3530128-3600173<br>
				 		<b>BARRANQUILLA</b><br>
                                             
				 	<b>REPORTE DE TRABAJO</b><br>
				 	<b style="margin-right: 15%;">Area:   <?php echo $nomarea;?>   </b>
				 	</div>
				 	
                                        
				 	<b style="margin-right: 5%;">Grupo:   <?php echo $nomgrup;?>   </b>
                                        <b> <?php echo $user;?></b><br>
				 		
				 	</div>
				 	<div style="width: 100%;font-size: 11px">
				 		<hr style="width: 100%;">
	<table id="dynamic-table" style="width: 100%;font-size: 11px">
            <TR></TR>
			<thead>
                            <tr><h2 style="text-align:center">INFORME DETALLADO DE REPORTE</h2></tr><BR>
                            <TR>
                                 <TH style="text-align:left">OPF</TH>
                                 <TH style="text-align:left">UND</TH>
                                 <TH style="text-align:left">MT2</TH>
                                 <th style="text-align:left">ML</th>
                                 <TH style="text-align:left">PER</TH>
                                 <TH style="text-align:left">BOQ</TH>
                                 <TH style="text-align:right">PESO KG</TH>
                                 <TH style="text-align:center">F.REG</TH>
                            </TR><tr></tr><tr></tr>
                                
		</thead>
		<tbody>
                                                        
	<?php                                                               
               $area = $_GET['area'];
               $grupo = $_GET['grupo'];
               $inicio= $_GET['inicio'].' 00:00:00';
               $fin = $_GET['fin'].' 23:59:00';
               $opf = $_GET['opf'];
               if($opf==''){
                   $op = " ";
               }else{
                    $op = " and opf in ($opf) ";
               }
           $query=mysqli_query($con2,"SELECT  count(id_registro) as can, sum(mt2) as cuadrados, sum(mtl) as lienales, sum(per_ing) as per, sum(boq_ing) as boq, sum(peso) as peso, opf,fecha_reg FROM registro_trabajo where id_area='$area' and usuario='$grupo' and fecha_reg between '$inicio' and '$fin' $op group by opf order by fecha_reg asc ");
           $total = 0;
           $peso=0;
           $und=0;
           $c = 0;
           while ($row = mysqli_fetch_array($query)) {
               $total ++;
               $peso +=$row[5];
               $und +=$row[0];
               $c = 0;
               echo '<tr>'
               . '<td>'.$row[6].'</td>'
               . '<td>'.number_format($row[0]).'</td>'
               . '<td>'.number_format($row[1],2).'</td>'
               . '<td>'.number_format($row[2],2).'</td>'
               . '<td>'.number_format($row[3],2).'</td>'
               . '<td>'.number_format($row[4],2).'</td>'
               . '<td style="text-align:right">'.number_format($row[5],2).'</td>'
               . '<td><center>'.$row[7].'</center></td>'
               . '<td></td>';
                echo '<tr><td id="'.$total.'" colspan="9"></td>';
           }
           echo '<tr>'
           . '<td>'.$total.'</td>'
           . '<td>'.$und.'</td>'
           . '<td>-</td>'
           . '<td>-</td>'
           . '<td>-</td>'
           . '<td>-</td>'
           . '<td style="text-align:right">'.number_format($peso).'</td>'
                   . '<td style="text-align:right">-</td>';
		?>
	</tbody>
	 </table>
           <hr style="width: 100%;">
		<div style="width: 100%;font-size: 11px;margin-bottom: 4%;">
                                                    <b> </b><br>
						</div>
						<hr style="width: 100%;">
						<div style="width: 50%;font-size: 12px;float: right;">
						</div>
				 	</div>
				</div>
			</div>
		
<script type="text/javascript">
 			//window.print();
 		</script>
  </body>
</html>
