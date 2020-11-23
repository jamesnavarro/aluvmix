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
		<title>LISTA DE ALUMINIOS</title>
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
        <body style="background: white;"  onload="window.print();"> 
<?php
	$info=mysqli_query($con, "SELECT * FROM orden_compra WHERE codigo='".$_GET['id']."'");
	$inf=mysqli_fetch_assoc($info);
	$prove=$inf['nom_ter'];
	$idter=$inf['cod_ter'];
	$fecha_hoy=$inf['fecha'];
	$sede=$inf['sede_dir'];
	$precio=$inf['total'];
        $fom=$inf['ordenfom'];
        $cobserv=$inf['observaciones_compra'];
        $user=$inf['usuario'];
        $cuenta=$inf['cod_cuenta'];
        $piva=$inf['PORIVA'];
        $noretefuente=$inf['PORRET'];
        $fecha = date('Y-m-j');
        $nuevafecha = strtotime ( '+2 day' , strtotime ( $fecha_hoy ) ) ;
        $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
        $usuarios =mysqli_query($con, "SELECT concat(nombre,' ',apellido) as ali,celular  FROM usuarios WHERE usuario='".$user."'");
        $u = mysqli_fetch_array($usuarios);
        $nombreuser= $u[0];
        $cel = $u[1];
        $usuarios2 =mysqli_query($con, "SELECT porfte,base,porica  FROM intercxp WHERE codigo='".$cuenta."'");
        $tp = mysqli_fetch_array($usuarios2);
            if($noretefuente==1){
               $porret = 0;
               }else{
                 $porret = $tp[0];
                    }            
                  $base = $tp[1];
                  $ica = $tp[2];
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
				 <b>ALUMINIOS</b><br>
				 <b>Fecha: <?php echo $fecha_hoy;?></b><br>
				 <hr>    
				 <b><?php echo $_GET['obs'];?></b><br>
				 <hr> 
			</div>
                        <div style="width: 100%;font-size: 11px">
                            <hr style="width: 100%;">
                            <table id="dynamic-table" style="width: 100%;font-size: 11px">
                                <thead>
                                    <TR>
                                        <TH>CODIGO</TH>
                                        <TH>REFERENCIA</TH>
                                        <TH>DESCRIPCION</TH>
                                        <TH>MEDIDA</TH>
                                        <TH>COLOR</TH>
                                        <TH>UND</TH>
                                        <TH>CANT</TH>
                                        <TH>PESO</TH>
                                        <TH>PINT</TH>
                          
                                    </TR>
                                </thead>
                                <tbody>
                                   
       <?php
		$reques=mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can,a.observaciones FROM desgloses_material a, referencias b where  a.linea='Perfileria' and  a.codigo_pro=b.codigo and a.id_cot=".$_GET["cot"]." and cantidad!=0 group by a.referencia, a.perfil order by b.sistema, id_desglose asc  ");
                $contador=0;
                $ref = '';
                $sw=0;
                $sistema = '';
                $pesoalu=0;$pesopin=0;$canp=0;
                 while($rowp=mysqli_fetch_array($reques)){
                     $contador++;
                     $contador++;
                     if($rowp['dado']=='0' || $rowp['dado']==''){
                         $dado = $rowp['referencia'];
                     }else{
                         $dado = $rowp['dado'];
                     }
                     
                 $medres = mysqli_query($con2,"select sum(medida*cantidad) as med from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' and perfil='".$rowp['perfil']."' ");
                 $md = mysqli_fetch_array($medres);
                 
                     $medtotal = $md['med'];
                     $canper = $md['med']/($rowp['perfil']-100);
                   
                     $pst = (($rowp['peso'] * $rowp['perfil']) / 1000)* ceil($canper);
                     $resultc = mysqli_query($con2,"select color_ta from cotizaciones where id_cotizacion='".$rowp['id_cot_item']."' ");
                     $rc = mysqli_fetch_array($resultc);
                     
                     if($rowp['color']=='02'){
                         $area=$rowp['area']/1000;
                     }else{
                          $area=$rowp['area']/1000;
                     }
                     if($rowp['color']=='01'){
                         $crudo = $rc[0];
                         $codcolor = '01';
                     }else{
                         $crudo = 'CRUDO';
                         $codcolor = '00';
                     }
                     $areat = $area*($rowp['perfil']/1000);
                     // sacar color del items
                    
                    $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$rc[0]."'";
                    $fia4 =mysqli_fetch_array(mysqli_query($con2,$alum_porr));
                    $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
                    $rendimiento= $fia4["rendimiento"];
                    $tipopintura= $fia4["variable"];
                    
                    $canpin = ( $areat * ceil($canper) ) / $rendimiento;
                    $costo_total_pintura = $canpin * $vc;
                    $valor_aluminio = $pst * $rowp['costo_fom'];
                    $queryma = mysqli_query($con2,"select tipo from desgloses_material where id_cot='".$_GET["cot"]."' and referencia='".$rowp['referencia']."' group by tipo ");
                    $ventana = '';
                    while ($row1 = mysqli_fetch_array($queryma)) {
                        $ventana = $ventana.$row1[0].' ,';
                    }
                    $mystring = $rowp['descripcion'];
                    $findme   = 'MM';
                    $pos = strpos($mystring, $findme);
                    if ($pos === false) {
                        $descripcion = $rowp['descripcion'];
                    } else {
                        $descripcion = substr($rowp['descripcion'],0,-6);
                    }
                    if($contador==1){
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                          
                        }
                    if($sistema!=$rowp['sistema']){
                            echo '<tr><td colspan="19"> - '.$rowp['sistema'].'-</td>';
                     }
                    
                     $ref = $rowp['referencia'];
                     $sistema = $rowp['sistema'];
                     $codigo = $ref.'-'.$codcolor.substr($rowp['perfil'],0,2);
                     if($rowp['existefom']=='1'){ 
                         $bcolor='#F4CACA';
                         if($rowp['crear']=='1'){ 
                             $ch2 = 'Solicitado';
                         }else{
                            $ch2 = '<button onclick="pedir('.$contador.')">Solicitar</button>';
                         }
                     }else{ 
                         $bcolor='#C5E9C0';
                         $ch2='<input type="checkbox" id="'.$contador.'" name="item2" checked>';
                     }
                     $pesoalu +=$pst;
                     $pesopin +=$canpin;
                     $canp += ceil($canper);
                    echo '<tr id="td'.$contador.'">'
                            . '<td>'.$codigo.'</td>'
                            . '<td>'.$dado.' </td>'
                            . '<td>'.$descripcion.' </td>'
                            . '<td>'.$rowp['perfil'].'</td>'
                            . '<td>'.$rowp['color'].' </td>'
                            . '<td>Und</td>'
                            . '<td>'.ceil($canper).' </td>'
                            . '<td>'.number_format($pst,2).' Kg</td>'
                             . '<td>'.number_format($canpin,2).' Kg</td>';

                 }
                 
                  echo '<tr>'
                            . '<td>'.$contador.'</td>'
                            . '<td>- </td>'
                            . '<td>-</td>'
                            . '<td>-</td>'
                            . '<td>-</td>'
                            . '<td>-</td>'
                            . '<td>'.number_format($canp).' </td>'
                             
                   . '<td>'.number_format($pesoalu,2).' Kg</td>'
                             . '<td>'.number_format($pesopin,2).' Kg</td>';
		?>
                 </tbody>
                                
 </table>
                            
  </div>
      
                    </div>
                </div>
            </div>
        </body>
</html>
