<?php
//calculo para el ancho del vidrio
                if($vref1=='ancho'){
                    $variablev = $ancho;
                }elseif($vref1=='alto'){
                    $variablev = $alto;
                }elseif($vref1=='Anchocfd'){
                    $variablev = $ancfd;
                }elseif($vref1=='Anchocfi'){
                    $variablev = $ancfi;
                }elseif($vref1=='Anchovc'){
                    $variablev = $anchovc;
                }elseif($vref1=='Altocfs'){
                    $variablev = $alcfs;
                }elseif($vref1=='Altocfi'){
                    $variablev = $alcfi;
                }elseif($vref1=='Altorej'){
                    $variablev = $rej;
                }elseif($vref1=='Altovc'){
                    $variablev = $altovc;
                }elseif($vref1=='Altomrej'){
                    $variablev = $altomrej;
                }else{
                    $result2 = mysqli_query($con, "select * from producto_perfiles where id_p='$vref1' ");
                    $fi = mysqli_fetch_array($result2);
                        $formula = $fi[4];
                        $lado_per = $fi[6];
                        $ope1 = $fi[7];
                        $var1 = $fi[8];
                        $ope2 = $fi[9];
                        $var2 = $fi[10];
                        $lado = $fi[5];
                        $piezas = $fi[13];
                        $cantidad = $fi[11];
                        include 'formula_perfil.php';

                    $variablev = $medida;  
                }
                if($vope1=='/'){
                    $resultadov = $variablev / $vvar1;
                }elseif ($vope1=='*') {
                    $resultadov = $variablev * $vvar1;
                }elseif ($vope1=='-') {
                    $resultadov = $variablev - $vvar1;
                }else{
                    $resultadov = $variablev + $vvar1;
                }
                
                if($vope2=='/'){
                    $resultadov = $resultadov / $vvar2;
                }elseif ($vope2=='*') {
                    $resultadov = $resultadov * $vvar2;
                }elseif ($vope2=='-') {
                    $resultadov = $resultadov - $vvar2;
                }else{
                    $resultadov = $resultadov + $vvar2;
                }
//calculo para el alto del vidrio
                if($vref2=='ancho'){
                    $variablev2 = $ancho;
                }elseif($vref2=='alto'){
                    $variablev2 = $alto;
                }elseif($vref2=='Anchocfd'){
                    $variablev2 = $ancfd;
                }elseif($vref2=='Anchocfi'){
                    $variablev2 = $ancfi;
                }elseif($vref2=='Anchovc'){
                    $variablev2 = $anchovc;
                }elseif($vref2=='Altocfs'){
                    $variablev2 = $alcfs;
                }elseif($vref2=='Altocfi'){
                    $variablev2 = $alcfi;
                }elseif($vref2=='Altorej'){
                    $variablev2 = $rej;
                }elseif($vref2=='Altovc'){
                    $variablev2 = $altovc;
                }else{
                    $result2 = mysqli_query($con, "select * from producto_perfiles where id_p='$vref2' ");
                    $fi = mysqli_fetch_array($result2);
                        $formula = $fi[4];
                        $lado_per = $fi[6];
                        $ope1 = $fi[7];
                        $var1 = $fi[8];
                        $ope2 = $fi[9];
                        $var2 = $fi[10];
                        $lado = $fi[5];
                        $piezas = $fi[13];
                        $cantidad = $fi[11];
                        include 'formula_perfil.php';

                    $variablev2 = $medida;  
                }
                if($vope3=='/'){
                    $resultadov2 = $variablev2 / $vvar3;
                }elseif ($vope3=='*') {
                    $resultadov2 = $variablev2 * $vvar3;
                }elseif ($vope3=='-') {
                    $resultadov2 = $variablev2 - $vvar3;
                }else{
                    $resultadov2 = $variablev2 + $vvar3;
                }
                
                if($vope4=='/'){
                    $resultadov2 = $resultadov2 / $vvar4;
                }elseif ($vope4=='*') {
                    $resultadov2 = $resultadov2 * $vvar4;
                }elseif ($vope4=='-') {
                    $resultadov2 = $resultadov2 - $vvar4;
                }else{
                    $resultadov2 = $resultadov2 + $vvar4;
                }
