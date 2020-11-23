<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Historial de Modificaciones</title>
    </head>
    <body>
        <?php
        include "../modelo/conexioni.php";
        $request=mysqli_query($con,"SELECT * FROM modificaciones where id_cotizacion='".$_GET['cod']."' and modulo='Productos'  order by id_m ");

       $table = '<table class="table table-bordered table-striped table-hover" id="tabla">';

              $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';
              $table = $table.'<th width="10%">'.'Id '.'</th>';
              $table = $table.'<th width="50%">'.'Descripcion de Modificacion'.'</th>';             
              $table = $table.'<th width="20%">'.'Fecha de registro'.'</th>';
              $table = $table.'<th  class="hidden-phone">'.'Por'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $total2=0;
	while($row=mysqli_fetch_array($request))
	{  
            
             $table = $table.'<tr><td  width="10%">'.$row['id_m'].'</td><td width="50%">'.$row['descripcion'].'</td><td width="10%">'.$row['registro'].'</font></td><td  class="hidden-phone">'.$row["por"].'<font></a></td></tr>';   
     
	}
        
        
	$table = $table.'</table>';
        
	echo $table;

        ?>
    </body>
</html>
