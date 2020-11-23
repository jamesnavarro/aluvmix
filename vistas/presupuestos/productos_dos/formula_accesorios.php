<?php
          
$ancho = $_GET['ancho'];
$alto  =  $_GET['alto'];
               
$mt2 = ($ancho/1000) * ($alto/1000)*$can; 
$mt = (($ancho/1000) + ($alto/1000))*$can*2;

if($lad=='Vertical'){
    $medida = $alto;
}else{
    $medida = $ancho;
}

if($calcular=='mt'){
      $variablem = $mt;
}elseif ($calcular=='m2') { 
      $variablem = $mt2;
}else{
      $variablem = $can;
}


if($distancia=='Si'){
     $cant_calculada = $medida / $cada;
 }else{
     $cant_calculada = 1;
 }
 
 if($ref_rej==0){
     $can_rejilla = 1;
 }else{
     include 'cantidad_rejillas.php';
     $can_rejilla = $resultadov;
 }
 
 $total = $variablem * $can_rejilla * $cant_calculada;
 //$total = $medida;

