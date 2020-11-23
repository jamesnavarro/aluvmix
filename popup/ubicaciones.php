<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Buscar Ubicacion</title>
    <meta name="description" content="">
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<script src="../js/jquery.js"></script>
<script src="../js/myjava.js"></script>
<link href="../css/estilo.css" rel="stylesheet">
<script src="../popup/terceros/funciones.js"></script>
        <script language="javascript" type="text/javascript">
function pasaru(id,c){
    var cod = $("#ubi"+id).val();
    window.opener.ubica(cod,c);
    window.close();
}
</script>

         
</head>
<body>
         
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Listado De Referencias</h4>
                                <!-- START Toolbar -->
                 
                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse2" class="body collapse in">
                                <div class="body-inner">
                                   
                                            <!-- Normal Tabs -->
                            
                            <div class="tabbable" style="margin-bottom: 25px;">
            
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">
                                         <!-- START Row -->
                    <div class="row-fluid">
                        <!-- START Datatable 2 -->
                        <div class="span12 widget lime">
                            
                            <section class="body">
                                <div class="body-inner no-padding">                           
     <?php 
include '../modelo/conexioni.php';
  $request_ac=mysqli_query($con,"SELECT * from ubicaciones_aluminio where fecha_bor='0000-00-00 00:00:00' group by estante, columna order by id_ua asc  " );
if($request_ac){
//    echo'<hr>';
       $table = '<table class="table table-bordered table-striped table-hover" id="">';
             $table = $table.'<thead >';
              $table = $table.'<tr BGCOLOR="#C3D9FF">';  
              $table = $table.'<th width="5%">'.'Estante'.'</th>'; 
              $table = $table.'<th width="5%">'.'Columna'.'</th>';
              $table = $table.'<th width="75%">'.'Ubicacion'.'</th>';
              $table = $table.'<th width="5%">'.'Para'.'</th>';
              $table = $table.'<th width="5%">'.'Sede'.'</th>';
              $table = $table.'</tr>';
              $table = $table.'</thead>';
	
        
	//Por cada resultado pintamos una linea
        $t=0; $es=0;
	while($row=mysqli_fetch_array($request_ac))
	{       
 $t=$t+1;
 $result = mysqli_query($con,"select fila, nombre,id_ua from ubicaciones_aluminio where estante='".$row['estante']."' and columna='".$row['columna']."' ");
 $nombre = '| ';
 while($f = mysqli_fetch_array($result)){
     $nombre .= ' <button onclick="pasaru('.$f[2].','.$_GET['casilla'].')" title="Estas seleccionando '.$f[1].'">'.$f[0].'</button> <input type="hidden" id="ubi'.$f[2].'" value="'.$f[1].'"> ';
 }
  
            $table = $table.'<tr>
            <td width="5%" style="text-align:center">'.$row['estante'].'</a></td>
            <td width="5%" style="text-align:center">'.$row['columna'].'</td>
            <td width="75%">'.$nombre.'</td><td width="5%" style="text-align:center">'.$row['tipo'].'</td><td width="5%" style="text-align:center">'.$row['ubicacion'].'</td>';
            if($row['estante']==$es){
                $table = $table.'<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>';
            }
            $es=$row['estante'];
	} 
	$table = $table.'</table>';
        
	echo $table;
  
}

 ?>
  
 
        
                                </div>
                            </section>
                        </div>
                        <!--/ END Datatable 2 -->
                    </div>
                    <!--/ END Row -->
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="row-fluid">
                  
                        <!--/ END Form Wizard -->
                    </div>
                                    </div>
                                </div>
                            </div><!--/ Normal Tabs -->
                                </div>
                            </section>
                        </div>
                    </div>
 </section></div>
</body>
</html>

         

                              
                                
