<?php
                if(isset($ref_rej)){
                    $cod = $ref_rej;
                }else{
                    $cod = $_GET['cod'];
                }
                
                $ancho = $_GET['ancho'];
                $alto  =  $_GET['alto'];
                $rej  =  $_GET['rej'];
                $ancfd  =  $_GET['ancfd'];
                $ancfi  =  $_GET['ancfi'];
                $alcfs  =  $_GET['alcfs'];
                $alcfi  =  $_GET['alcfi'];
             
                $anchovc = $ancho - $ancfd -$ancfi;
                $altovc =  $alto - $alcfs- $alcfi - $rej;
                $altomrej = $alto - $rej;


                $result = mysqli_query($con, "select * from producto_rejillas where id_pr='$cod' ");
                $f = mysqli_fetch_array($result);
                    $rejilla = $f[2];
                    $vref1 = $f[4];
                    $vope1 = $f[5];
                    $vvar1 = $f[6];
                    $vope2 = $f[7];
                    $vvar2 = $f[8];

                    $vref2 = $f[9];
                    $vope3 = $f[10];
                    $vvar3 = $f[11];
                    $vope4 = $f[12];
                    $vvar4 = $f[13];

                    //$cantidad = $f[13];

                    include 'formula_rejillas.php';
                    $formula1 = number_format($variablev,2).$f[5].$f[6].$f[7].$f[8];
                    $formula2 = number_format($variablev2,2).$f[10].$f[11].$f[12].$f[13];

                    $perfiles = ($resultadov * $resultadov2)/ 6000;
                    if(isset($ref_rej)){
                        $resultadov;
                    }else{
                        if($cod==0){
                             echo 1;
                        }else{
                             echo $resultadov;
                        }
                    }

