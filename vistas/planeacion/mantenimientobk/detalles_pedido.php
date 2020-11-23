<?php
include '../../../modelo/conexionv1.php';
session_start();



   $query =mysqli_query($con2,"SELECT * FROM cotizacion_pedidos WHERE id_cot = " . $_GET["cot"] . " order by medida asc ");



  $table = "";
if($query){
	//Por cada resultado pintamos una linea
        $c = 0;
        $ca = 0;
        $gt= 0;
        $gtiva= 0;
        $ct= 0;
        $di = '';
	while($row=mysqli_fetch_array($query))
	{    
        $c +=1;
        $cont++;
       $gt +=($row["valor_und"]*$row['cantidad']);
       $descripcion = preg_replace('/( ){2,}/u',' ',$row['descripcion']);
       $contador =  strlen($descripcion);
                $table = $table.'<tr><td></td><td width="7%">'
                        .''
                        .'<input type="text" id="cod'.$cont.'" value="'.$row['referencia'].'" onchange="buscarpt('.$cont.');updateitemped('.$cont.')" title="'.$row['referencia'].'" style="width:100%">
                        <input type="hidden"  id="codtem'.$cont.'" value="'.$row['referencia'].'">
                        <input type="hidden"  id="gru'.$cont.'" value="'.$row['grupo'].'">
                        <input type="hidden"  id="cla'.$cont.'" value="'.$row['clase'].'">
                        <input type="hidden"  id="ref'.$cont.'" value=""></td>
                        <td width="25%"><textarea id="des'.$cont.'"  onchange="updateitemped('.$cont.')" rows="3" style="width:100%" onkeyup="contar('.$cont.')">'.$descripcion.'</textarea></td>                     
                        <td width="9%"><input type="text"  id="und'.$cont.'" value="Und" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="med'.$cont.'" onchange="updateitemped('.$cont.')"  value="'.$row["medida"].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text"  id="col'.$cont.'" onclick="buscarcolor('.$cont.')"  value="'.$row["color"].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="can'.$cont.'" onchange="updateitemped('.$cont.')"  value="'.$row['cantidad'].'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="vlr'.$cont.'" onchange="updateitemped('.$cont.')"  value="'.($row["valor_und"]).'" style="width:100%"></td>
                        <td class="hidden-phone"><input type="text" id="tot'.$cont.'"  value="'.number_format(($row["valor_und"]*$row['cantidad'])).'" style="width:100%" disabled>
                        <input type="hidden" id="obs'.$cont.'" value="'.$row['observaciones'].'" style="width:100%">'
                        . '<input type="hidden" id="item'.$cont.'" value="'.$row['id_items'].'" style="width:100%">'
                        . '<td><input type="checkbox" id="'.$cont.'" name="item" checked disabled><span id="con'.$cont.'">'.$contador.'</span></td></tr>';   
       
	} 
        $table = $table.'<tr><td></td><td><input type="text" disabled id="ct" value="'.$c.'" style="width:100%"></td>'
                . '<td>Actualizados: <input type="text" disabled id="cv" value="'.$ca.'" style="width:40px"></td>'
                . '<td colspan="4"></td><td>Valor Total:</td>'
                . '<td><input type="text" id="gran_total" disabled value="'.number_format($gt,0,',','.').'" style="width:100%"></td>';

       }
	echo $table;

    

