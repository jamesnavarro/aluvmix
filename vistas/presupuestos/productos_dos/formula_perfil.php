
<?php
                if($lado_per=='ancho'){
                    $variable = $ancho;
                }elseif($lado_per=='alto'){
                    $variable = $alto;
                }elseif($lado_per=='Anchocfd'){
                    $variable = $ancfd;
                }elseif($lado_per=='Anchocfi'){
                    $variable = $ancfi;
                }elseif($lado_per=='Anchovc'){
                    $variable = $anchovc;
                }elseif($lado_per=='Altocfs'){
                    $variable = $alcfs;
                }elseif($lado_per=='Altocfi'){
                    $variable = $alcfi;
                }elseif($lado_per=='Altorej'){
                    $variable = $rej;
                }elseif($lado_per=='Altomrej'){
                    $variable = $altomrej;
                }else{
                    $variable = $altovc;  
                }
                
                if($ope1=='/'){
                    $resultado = $variable / $var1;
                }elseif ($ope1=='*') {
                    $resultado = $variable * $var1;
                }elseif ($ope1=='-') {
                    $resultado = $variable - $var1;
                }else{
                    $resultado = $variable + $var1;
                }
                
                if($ope2=='/'){
                    $resultado = $resultado / $var2;
                }elseif ($ope2=='*') {
                    $resultado = $resultado * $var2;
                }elseif ($ope2=='-') {
                    $resultado = $resultado - $var2;
                }else{
                    $resultado = $resultado + $var2;
                }
   
if($formula=='Si'){
    $medida = $resultado;
}else{
    $medida = $medida;
}
 if(isset($cadah)){
     if($cadah==0){
          $cadah = 1;
     }else{
          $cadah = $cadah;
     }
 }else{
     $cadah = 1;
 }
 if(isset($cadav)){
     if($cadav==0){
          $cadav = 1;
     }else{
          $cadav = $cadav;
     }
 }else{
    $cadav = 1; 
 }
 $ct1 = ceil($ancho / $cadah);
 $ct2 = ceil($alto / $cadav);

     $tt1 = $ct1 * $ct2;
     $tt =  $tt1 * $cantidad;
     
if($piezas=='Si'){
    $cantidad = $tt;
}else{
    $cantidad = $cantidad;
}