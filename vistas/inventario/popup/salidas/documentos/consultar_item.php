<?php
 $sql21 = ("SELECT * FROM producto a, cotizaciones c where c.id_referencia=a.id_p and c.id_cotizacion=".$_GET['item']."");
            $fila21 =mysqli_fetch_array(mysqli_query($con2,$sql21));
            $linea_cot= $fila21["linea_cot"];
            $id_referencia= $fila21["id_p"];
            $id_cotizacion= $fila21["id_cotizacion"];
            $id_cot= $fila21["id_cot"];
            $producto= $fila21["producto"];
            $codigo= $fila21["codigo"];
            $id_vidrio= $fila21["id_vidrio"];
            $id_vidrio2= $fila21["id_vidrio2"];
            $id_vidrio3= $fila21["id_vidrio3"];
            $id_vidrio4= $fila21["id_vidrio4"];
            $id_vidrio5= $fila21["id_vidrio5"];
            $id_vidrio6= $fila21["id_vidrio6"];
            $pelicula= $fila21["pelicula"];
            
            $id2_vidrio= $fila21["id2_vidrio"];
            $id2_vidrio2= $fila21["id2_vidrio2"];
            $id2_vidrio3= $fila21["id2_vidrio3"];
            $id2_vidrio4= $fila21["id2_vidrio4"];
            $id2_vidrio5= $fila21["id2_vidrio5"];

            $id3_vidrio= $fila21["id3_vidrio"];
            $id3_vidrio2= $fila21["id3_vidrio2"];
            $id3_vidrio3= $fila21["id3_vidrio3"];
            $id3_vidrio4= $fila21["id3_vidrio4"];
            $id3_vidrio5= $fila21["id3_vidrio5"];

            $id4_vidrio= $fila21["id4_vidrio"];
            $id4_vidrio2= $fila21["id4_vidrio2"];
            $id4_vidrio3= $fila21["id4_vidrio3"];
            $id4_vidrio4= $fila21["id4_vidrio4"];
            $id4_vidrio5= $fila21["id4_vidrio5"];
            $lado= $fila21["imagen"];
            
            $laminas= $fila21["laminas"];
            $laminas2= $fila21["laminas2"];
            $laminas3= $fila21["laminas3"];
            $laminas4= $fila21["laminas4"];
            
            $traz_vid= $fila21["traz_vid"];
            $traz_vid2= $fila21["traz_vid2"];
            $traz_vid3= $fila21["traz_vid3"];
            $traz_vid4= $fila21["traz_vid4"];
            
            $termo1= $fila21["termovid1"];
            $termo2= $fila21["termovid2"];
            $termo3= $fila21["termovid3"];
            $termo4= $fila21["termovid4"];
            
            
            $cierre_cot = $fila21["cierre"];
            $ancho= $fila21["ancho_c"];
            $aa= $fila21["ancho_abajo"];
            $alto= $fila21["alto_c"];
            $ancho_temp= $fila21["ancho_temp"];
            $alto_temp= $fila21["alto_temp"];
            $cant_item= $fila21["cantidad_c"];
            $por= $fila21["porcentaje"];
            $por_mp= $fila21["porcentaje_mp"];
            $ruta= $fila21["ruta"];
            $ruta2= $fila21["ruta2"];
            $color= $fila21["color_ta"];
            $altura= $fila21["cuerpo"];
            $altura_v_c =  $alto - $altura;
            $anchura = $fila21["lado"];
            $anchura_v_c = $ancho - $anchura;
            $tip= $fila21["tip"];
            $hoja= $fila21["hojas"];
            $pel= $fila21["rollo"];
            $rollo= $fila21["rollo"];
            $desc= $fila21["desc"];
            $per= $fila21["per"];
            $boq= $fila21["boq"];
            $install= $fila21["install"];
            $obs= $fila21["observaciones"];
            $obs2= $fila21["observaciones2"];
            $modulo= $fila21["modulo"];
            $huacal= $fila21["huacal"];
            $verticales= $fila21["verticales"];
            $ubica= $fila21["ubicacion_c"];
            $adicional= $fila21["imagen_mas"];
            $horizontales= $fila21["horizontales"]; 
            $d1= $fila21["d1"];
            $duracion= $fila21["duracion"];
            $ancho_maximo= $fila21["ancho_maximo"];
            $alto_maximo= $fila21["alto_maximo"];
            $msg= $fila21["msg"];
            $msg2= $fila21["msg2"];
            $cantlam= $fila21["cantlam"];
            $poli= $fila21["poli"];
            $dolar= $fila21["id_dolar"];
            $poli_v= $fila21["poli_v"];
            $poli_h= $fila21["poli_h"];
            
            $rieles = $fila21["rieles"];
            $alfajia = $fila21["alfajia"];
            $cierres = $fila21["cierres"];
            $rodajas = $fila21["rodajas"];
            $brazos = $fila21["brazos"];
            $idespaciador = $fila21["idespaciador"];
            
            $cancierres = $fila21["can_cierres"];
            $canrodajas = $fila21["can_rodajas"];
            $canespaciador = $fila21["cantespaciador"];
            $canbrazos = $fila21["can_brazos"]; 

            
            $result_rieles = mysqli_query($con2,"SELECT descripcion FROM referencias   where id_referencia='$rieles' ");
            $rie = mysqli_fetch_array($result_rieles);
            $desrieles = $rie[0];
            
            $result_alfa = mysqli_query($con2,"SELECT descripcion FROM referencias   where id_referencia='$alfajia' ");
            $alf = mysqli_fetch_array($result_alfa);
            $desalfajias = $alf[0]; 
            
            $result_cie = mysqli_query($con2,"SELECT descripcion FROM referencias   where id_referencia='$cierres' ");
            $cie = mysqli_fetch_array($result_cie);
            $descierres = $cie[0];
            
            $result_rod = mysqli_query($con2,"SELECT descripcion FROM referencias   where id_referencia='$rodajas' ");
            $rod = mysqli_fetch_array($result_rod);
            $desrodajas = $rod[0];
            
            $poralu = $fila21["poralu"];
            $porvid = $fila21["porvid"];
            $poracc = $fila21["poracc"];
            $porace = $fila21["porace"];
            $dolar_actual = $fila21["id_dolar_actual"];
            
