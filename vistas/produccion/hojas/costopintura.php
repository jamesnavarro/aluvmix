<?php
         $alum_porr = "SELECT costo_a,rendimiento,variable FROM tipo_aluminio where color_a='".$color."'";
          $fia4 =mysqli_fetch_array(mysqli_query($conexion,$alum_porr));
          $vc= $fia4["costo_a"]*$fia4["variable"];  //se le agrego la variable que multiplica la pintura
          $rendimiento= $fia4["rendimiento"];
          $tipopintura= $fia4["variable"];
          
           if($perimetro=='0'){
               $perimetro = 1;
           }
           if($rendimiento==0){
               $rendimiento = 1;
           }else{
               $rendimiento = $rendimiento;
           }
          $valor_acabado = $vc * $perimetro * ($medida/1000) * ($cantidad / $rendimiento);
               
           
 
