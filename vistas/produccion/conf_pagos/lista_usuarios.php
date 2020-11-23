<?php
 include "../../../modelo/conexion.php";
$request_ac=mysqli_query($con,"SELECT * FROM puestos_trabajos a, grupo b, grupo_det c, usuarios d where d.id_user=c.id_user and b.id_g=c.id_g and a.id_puesto=b.id_area and b.id_g=".$_GET['id']." ");
     
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';

              $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="5%">'.'Items'.'</th>'; 
              $table = $table.'<th width="25%">'.'Nombre'.'</th>';             
              $table = $table.'<th width="20%">'.'Usuario'.'</th>';
              $table = $table.'<th nowrap width="10%">'.'Fecha de registro'.'</th>';
              $table = $table.'<th nowrap width="15%">'.'Fecha de Modificacion'.'</th>';
              $table = $table.'<th width="10%">'.'Cargo'.'</th>';
              $table = $table.'<th nowrap width="10%">'.'Registrado por'.'</th>';
              $table = $table.'<th width="5%">'.'Estado'.'</th>';
              $table = $table.'<th width="5%">'.'Activos'.'</th>';
              $table = $table.'<th width="5%">'.'Eliminar'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
                $t = $t +1;
                if($row['est']==0){$im = '<img src="../imagenes/ok.png">';$e = 'yes';}else{$im = '<img src="../imagenes/cancelar.png">';$e = 'no';}
                
                    $work = '<a href="../vistas/?id=trabajos_realizados&user='.$row['id_user'].'&cod='.$_GET['id'].'"><img src="../images/empresas.png"></a>';
               
                $table = $table.'<tr><td width="5%">'.$t.'</a></td>'
                    . '<td width="25%">'.$row['nombre'].' '.$row['apellido'].'</a></td>'
                    . '<td width="20%">'.$row['usuario'].'</font></td>'
                    . '<td width="10%">'.$row['fecha_ingreso'].'</font></td>'
                    . '<td width="15%">'.$row['fecha_mod'].'</font><td width="15%">'.$row['cargo'].'</font></td><td width="15%">'.$row['ingresado_por'].'</font></td><td width="5%">'.$im.'</font></td>'
                    . '<td width="5%"><a href="#"  onclick="editar_u('.$row['id_gd'].','.$_GET['id'].','.$row['est'].')"><img src="../imagenes/modificar.png"></a> </td>'
                    . '<td><button onclick="borrar_u('.$row['id_gd'].','.$_GET['id'].')" class="glyphicon glyphicon-remove"> </button></td>'
                    . '</tr>';   
           
		
               
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}
 ?>