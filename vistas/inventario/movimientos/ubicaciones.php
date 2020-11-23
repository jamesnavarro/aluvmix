<?php
   include '../../../modelo/conexioni.php';
   session_start();
   date_default_timezone_set("America/Bogota" ) ; 
	$hora = date('H:i:s',time() - 3600*date('I'));
	$fecha_hoy = date("Y-m-d").' '.$hora;
	$date = date("Y-m-d");  
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <title>Ubicaciones Galapa</title>
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
    <link href="../../../css/estilo.css" rel="stylesheet">
    <script src="funciones.js"></script>
 </head>
 <body style="margin: 5%;background-color: #438EB9;">
   <div style="background-color: white;padding: 1%;">
    	<h5><b>Referencia de producto:</b> </h5><input type="text" id="cod" readonly>
    	<h5><b>Cantidades a entrar:</b></h5><input type="text" id="cant" value="15" readonly>
    	<h5><b>Cantidades Por Ubicacion:</b></h5><input type="text" id="ubi" readonly><input type="hidden" value="0" id="temp" readonly>
   </div>
    	<h4><b style="color: white; font-size: 20px;">Ubicaciones Galapa</b></h4>
<table class="table table-hover" style="background-color: orange;color: black;">
               <tr class="bg-info">
                   <th>Alfabeto/Numeros</th> 
                   <th class="center">1</th>
                   <th class="center">2</th>
                   <th class="center">3</th>
                   <th class="center">4</th>
                   <th class="center">5</th>
                   <th class="center">6</th>
                   <th class="center">7</th>
                   <th class="center">8</th>
                   <th class="center">9</th>
                   <th class="center">10</th>
                   <th class="center">11</th>
                   <th class="center">12</th>
                   <th class="center">13</th>
                   <th class="center">14</th>
                   <th class="center">15</th>
                   <th class="center">16</th>
                   <th class="center">17</th>
                   <th class="center">18</th>
                   <th class="center">19</th>
                   <th class="center">20</th>
                </tr>
   <tbody id="mostrar_dados">
          <?php
          $sql=mysqli_query($con, "SELECT columna, COUNT(columna) FROM `ubicaciones` WHERE codigo_cp='GALAPA' GROUP BY columna");
           while ( $row=mysqli_fetch_assoc($sql)) {
            echo '<tr>';
            echo '<td>'.$row['columna'].'</td>';
            for ($i=1; $i <= $row['COUNT(columna)']; $i++) { 
            echo '<td><input type="text" placeholder="'.$row['columna'].$i.'" style="width: 35px;"  id="'.$row['columna'].$i.'" onfocus="procedimiento(this.value)" onchange="operati(this.value,this.id);"></td>';
            }
            echo '</tr>';
            }
            ?>
   </tbody>
  </table><br><br>
<script type="text/javascript">
    
function procedimiento(val){
	if(val == null || val == undefined || val == ""){
	document.getElementById('temp').value=0;
	}else{
	document.getElementById('temp').value=val;
	}
}
function prue() {
   alert('entra');
}
function operati (valor,ref) {
    var totalr = 0;	
    var total = 0;	
    var valor_focal=document.getElementById('temp').value;
    var inicial=document.getElementById('cant').value;
    if(valor_focal>0){
	valor1 = parseInt(valor_focal); 
	totalr = document.getElementById('ubi').value;
	totalr = (totalr == null || totalr == undefined || totalr == "") ? 0 : totalr;
	totalr = (parseInt(totalr) - parseInt(valor1));
	document.getElementById('temp').value= 0;
	valor2 = parseInt(valor); 
	total = totalr;
	total = (total == null || total == undefined || total == "") ? 0 : total;
	total = (parseInt(total) + parseInt(valor2));
	   
	if(total<=inicial){
	   document.getElementById('ubi').value = total;
	   }else{
	    	alert('Supero el valor de cantidades se ah eliminado ultima Inserción');
	    	document.getElementById(ref).value = '';
	   }
           }else{
    	    valor = parseInt(valor); 
	    total = document.getElementById('ubi').value;
	    total = (total == null || total == undefined || total == "") ? 0 : total;
	    total = (parseInt(total) + parseInt(valor));
	    if(total<=inicial){
	    	document.getElementById('ubi').value = total;
	    }else{
	    	alert('Supero el valor de cantidades se ah eliminado ultima Inserción');
	    	document.getElementById(ref).value = '';
	    }
    }
}
</script>