<?php
//$nw_medida = $row['medida_r_a'];
//$nw_lado = $row['lado'];
//$nw_var1 = $row['descuento'];
//$nw_ope = $row['signo'];
//$nw_var2 = $row['variable'];
//$nw_cant = $row['cantidad'];
//$nw_div = $row['division'];
//$altura_v_c = $altura_v_c; // altura ventana corrediza
//$altura = $altura;// altura cuerpo fijo
//$anchura = $anchura; //ancho cuerpo fijo
//$anchura_v_c = $anchura_v_c; // ancho ventana corrediza;
//$ancho = $ancho;
//$alto = $alto;

if($nw_medida=='0'){
             
             if($nw_lado=='Vertical'){
                $medida = $alto;
             }else{
                $medida = $ancho;
             }
         }else{
             if($nw_medida=='1'){
                  $medida = $altura_v_c;
             }else if($nw_medida=='2'){
                  $medida = $altura;
             }else if($nw_medida=='3'){
                  $medida = $anchura;
             }else if($nw_medida=='4'){
                  $medida = $anchura_v_c;
             }else if($nw_medida=='976'){
                  $medida = $ancho; // resolver
             }else{
                  $medida = $ancho; // resolver
             }
         }
         if($nw_ope=='+'){
             $med_perfil = $medida + $nw_var1 + $nw_var2;
         }else if($nw_ope=='-'){
              $med_perfil = $medida + $nw_var1 - $nw_var2;
         }else if($nw_ope=='*'){
              $med_perfil = ($medida + $nw_var1) * $nw_var2;
         }else{
              $med_perfil = ($medida + $nw_var1) / $nw_var2;
         }