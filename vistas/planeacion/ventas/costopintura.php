<?php
         $alum_porr = "SELECT costo_a,rendimiento FROM tipo_aluminio where color_a='".$color."'";
          $fia4 =mysqli_fetch_array(mysqli_query($con, $alum_porr));
          $vc= $fia4["costo_a"];
          $rendimiento= $fia4["rendimiento"];
          
          if($perimetro=='0'){
               $valor_acabado = $vc;
           }else{
               if($rendimiento==0){
                   $rendimiento = 1;
               }else{
                   $rendimiento = $rendimiento;
               }
               $valor_acabado = $vc * $perimetro * ($medida/1000) * ($cantidad / $rendimiento);
               
           }
