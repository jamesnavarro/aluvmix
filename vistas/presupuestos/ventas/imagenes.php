<!DOCTYPE html>
<?php
include '../../../modelo/conexioni.php';

if(isset($_GET['cot'])){ 

  ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>DETALLES DE LA COTIZACIÓN No. <?php echo $num ?></title>
        <style type="text/css">
            
            footer {
            position: relative;
            /* Altura total del footer en px con valor negativo */
            margin-top: 1px;
            /* Altura del footer en px. Se han restado los 5px del margen
               superior mas los 5px del margen inferior
            */
            height: 1px; 
            padding:5px 0px;
            clear: both;
            background: #fff;
            text-align: center;
            
            font-family: Arial;
font-size: 7px; 
color: #000000; 
        }
        
        /* Esta clase define la anchura del contenido y la posicion centrada 
           El contenido queda centrado y limitado, pero la cabecera y el pie
           llegan hasta los limites del navegador.
        */
        .define {
            width:960px;
            margin:0 auto;
        }
		@media all {
			div.saltopagina{
				display: none;
			}
		}
			
		@media print{
			div.saltopagina{ 
				display:block; 
				page-break-before:always;
			}
		}
                .estilo1 { 
font-family: Arial;
font-size: 7px; 
color: #000000; 
} 
td.estilo1 {
border:hidden;
}
table.estilo1 {
border: 1px solid #000000;
}
table.estilo2 {
     border: 0.4px solid #000000;
   border-top: 1px solid transparent;
  border-collapse: collapse;
}
td.estilo2{
   
}
.estilo2 { 
font-family: Arial; 
font-size: 14px; 
color: #000000; 
} 

th.estilo2 {
font-size: 10px; 
}
#piedepagina{
width:800px; 
position: absolute;
bottom: 0 !important;
bottom: -1px;
}
	</style>
        <script>
            function cambiar_img(id)
{
window.open('../vistas/imagen.php?id='+id+' ', 'contacto', 'width=400,height=400');
}
        </script>
    </head>
    <body>
  
        
      
     
        
        <?php
	//Por cada resultado pintamos una linea
     
     
              $table3 = '<table border="1"  class="estilo2">';
             $table3 = $table3.'<thead >';
              $table3 = $table3.'<tr BGCOLOR="#3C4484">';
                  $table3 = $table3.'<th width="10%" style="font-size:8px; color:white">'.'MEDIDA POR % ancho x alto'.'</h6></th>';  
               $table3 = $table3.'<th  width="5%" style="font-size:8px; color:white">'.'ITEM'.'</th>';
               $table3 = $table3.'<th  width="5%" style="font-size:8px; color:white">'.'TIPO'.'</th>';
               $table3 = $table3.'<th  width="5%" style="font-size:8px; color:white">'.'DIMENSION'.'</th>';
               $table3 = $table3.'<th  width="23%" style="font-size:8px; color:white">'.'DISEÑO'.'</th>';
            
             
              $table3 = $table3.'</tr>';
              $table3 = $table3.'</thead>'; 
              ?>
        
         <form  action="<?php echo '../vistas/imagenes.php?cot='.$_GET['cot'].'&cli='.$_GET['cli'].'&cambiar ';?>" method="post" id="form_validate_html" enctype="multipart/form-data">
             <input type="submit" value="cambiar"> <input type="text" name="general" placeholder="Ancho"> X <input type="text" name="general2" placeholder="Alto">
        <?php
         $request=mysqli_query($con,"SELECT * FROM cotizacion_item  where id_cot=".$_GET["cot"]." and id_cot_principal=0");

           $total2=0;
        $tad =0;
      $ancho = 0;
	  $alto = 0;
    $cont =0;$es2=0;
   $pag = 0;
   
	while($row=mysqli_fetch_array($request))
	{    

            $cont = $cont + 1;
//
//                if($row["ruta"]!=''){
//                    $fi = '../../../archivos/'.$row["ruta"];
//                    list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
//                    
//                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
//                     if($row["al"]==0){$pi2= $alto;}else{$pi2= $row["al"];}
//                    $img = '<img src="../adicionales/'.$row["ruta"].'" width="'.$pi1.'px" height="'.$pi2.'px">';
//                }else{
//                    
//               IF($row["imagen"]=='Derecho'){
//                   IF($row["ruta"]==''){ 
//                $img = '<img src="../producto/no.jpg" width="35px" height="35px">';
//            }else{
//                $fi = '../producto/'.$row["ruta"];
//                list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
//                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
//                     if($row["al"]==0){$pi2= $alto;}else{$pi2= $row["al"];}
//                $img = '<img src="../../../archivos/'.$row["ruta"].'"  width="'.$pi1.'px"  height="'.$pi2.'px">';
//            }
//            }else{
//                IF($row["ruta"]==''){
//                $img = '<img src="../producto/no.jpg" width="35px" heigth="30px">';
//                $ancho = '100';$alto='100';
//            }else{
//                $fi = '../producto/'.$row["ruta2"];
//                list($ancho, $alto, $tipo, $atributos) = @getimagesize($fi);
//                    if($row["an"]==0){$pi1= $ancho;}else{$pi1= $row["an"];}
//                     if($row["al"]==0){$pi2= $alto;}else{$pi2= $row["al"];}
//                $img = '<img src="../../../archivos/'.$row["ruta"].'"  width="'.$pi1.'px"  height="'.$pi2.'px">';
//            }
//                }}
    if($row['ancho_total']!=0 && $row['alto_total']!=0){
        $med = $row['ancho_total']. ' x '.$row['alto_total'];
    }else{
        $med = ''.$row["ancho"].' x '.$row["alto"].'';
    }
    

    $table3 = $table3.'<tr>'
            . '<td  width="10%"><input type="hidden" name="id'.$cont.'" style="width:60px"  value="'.$row['id_cotizacion'].'">'
            . '<input type="text" name="an'.$cont.'" style="width:60px"  value="'.$row['an'].'"> x '
            . '<input type="text" name="al'.$cont.'" style="width:60px"  value="'.$row['al'].'"></td>'
            . '<td  width="5%">'.$row["item"].'</td><td  width="5%">'.$row["tip"].'</td><td  width="5%">'.$med.'</td>'
            . '<td  width="23%"><p align="center">  Ancho: '.$ancho.'px,  Alto: '.$alto.'px  '.$img.' </p>'
            . '<img src="../imagenes/cambiar.png" onclick="cambiar_img('.$row['id_cotizacion'].')" style="cursor:pointer;" title="Cambiar Imagen"></td></tr>';   

	} 
        $table3 = $table3.'</table>';
         echo $table3;
        ?> 
     <input type="hidden" name="cant" readonly  style="width:20px;height:20px;"  value="<?php echo $cont; ?>"> 
     <input type="submit" value="cambiar">
    </form>
        
        <?php

        
       
        echo '<br>Peso Total: '.number_format($es2).' kg';
//        echo '<hr><h5><p align="right">TOTAL COT: $<strong>'.number_format($tad).'</strong></h5></p>'; 
        
                //-----------------------------------------servicios-----------------------------------------------
}
                                           ?>
  
       
    </body>
</html>
<?php
                    if(isset($_GET['cambiar'])){

                         include "../modelo/conexion.php";
  
        $n = $_POST["cant"];  
        if($_POST['general']!=''){
             $sqlr = "UPDATE `cotizaciones` SET `an`=".$_POST['general'].", `al`=".$_POST['general2']."  WHERE `id_cot`=".$_GET['cot'].";";
                mysqli_query($con,$sqlr); 
        }else{
        for($x=1; $x<=$n; $x=$x+1){
                include "../modelo/conexion.php";
               
                $sqlr = "UPDATE `cotizaciones` SET `an`=".$_POST["an$x"].", `al`=".$_POST["al$x"]."  WHERE `id_cotizacion`=".$_POST["id$x"].";";
                mysqli_query($con,$sqlr);  
                

        } }
           

echo "<script language='javascript' type='text/javascript'>";
echo "location.href='../vistas/imagenes.php?cot=".$_GET['cot']."&cli=".$_GET['cli']."'";
echo "</script>";
                    }