<?php
include "../modelo/conexion.php";
session_start();
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <link rel="shortcut icon" href="../traz.ico">
    <title>Templado S.A</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, user-scalable=0, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap-responsive.min.css">
    <link rel="stylesheet" href="../css/style.css"> 
    <link rel="stylesheet" href="../css/custom.css">
    <link rel="stylesheet" id="base-color" href="../css/color/serene.css"><!-- Base Theme Color -->
    <link rel="stylesheet" id="base-bg" href="../css/background/bg1.css"><!-- Boxed Background -->
    <link rel="stylesheet" href="../assets/jui/css/jquery-ui-1.10.3.min.css">
    <link rel="stylesheet" href="../assets/snippet/css/jquery.snippet.min.css">
    <link rel="stylesheet" href="../assets/scrollbar/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="../assets/icheck/css/jquery.icheck.min.css">
    <link rel="stylesheet" href="../assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="../assets/minicolor/css/jquery.minicolors.min.css">
    <link rel="stylesheet" href="../assets/wysiwyg/CLEditor/css/jquery.cleditor.min.css">
    <link rel="stylesheet" href="../assets/formvalidation/validationengine/css/jquery.validationEngine.min.css">
    <link rel="stylesheet" href="../assets/tagit/css/jquery.tagit.min.css">
    <link rel="stylesheet" href="../assets/fullcalendar/css/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/prettyphoto/css/prettyphoto.min.css">
    <link rel="stylesheet" href="../assets/datatable/css/dataTables-bootstrap.min.css">
    <link rel="stylesheet" href="../assets/switch/css/bootstrapSwitch.min.css">
    <link rel="stylesheet" href="../assets/daterangepicker/css/daterangepicker.min.css">
    <link rel="stylesheet" href="../assets/bootstrap-fileupload/css/bootstrap-fileupload.min.css">
    <link rel="stylesheet" href="../assets/gritter/css/jquery.gritter.min.css">
    <link rel="stylesheet" href="../assets/themer/css/jquery.themer.min.css">
    <script src="../assets/modernizr/js/modernizr-2.6.2.min.js"></script>
<!-- indispensable para cargar municipios-->
    <script type="text/javascript" src="../js/jquery.equalHeight.js"></script>
    <script src="../js/jquery.tablesorter.min.js" type="text/javascript"></script>
    <script src="../js/jquery-1.5.2.min.js" type="text/javascript"></script>
    <script src="../js/buscadores.js" type="text/javascript"></script>
    <script src="../js/ajax.js" type="text/javascript"></script>
    <script>
$(document).ready(function(){
    $('#tabla').dataTable();
});

function pasar_puc(){
    window.opener.cliente_info(document.getElementById('id').value,
    document.getElementById('nomx').value,
    document.getElementById('dir').value,
    document.getElementById('con').value,
    document.getElementById('tel').value,
    document.getElementById('cel').value,
    document.getElementById('ema').value,
    document.getElementById('doc').value,
    document.getElementById('dep').value,
    document.getElementById('mun').value,
    document.getElementById('ven').value,
    document.getElementById('ubi').value,
    document.getElementById('ciud').value,
    document.getElementById('muni').value,
    document.getElementById('pvi').value);
    window.close();

}
function cambiar(id){
    var desvi = $("#tervid"+id).val();
    var desal = $("#teral"+id).val();
    var desac = $("#terac"+id).val();
      $.ajax({
                    type:'GET',
                    data:'id='+id+'&vid='+desvi+'&alu='+desal+'&ace='+desac+'&sw=14',
                    url:'../vistas/ventas/acciones.php',
                    success : function(t){
                         $("#aut"+id).html(t);
                        
                    }
                });
}
$(document).keyup(function(event){
    if(event.keyCode == 13){
        $("#buscadorc").click();
    }
});
        </script>    
</head>
<body onload="pasar_puc();">
    
<div class="row-fluid">
                        <!-- START Form Wizard -->
                      <!-- START Widget Collapse -->
                           <section class="body">
                                <div class="body-inner">
                        <div class="span12 widget dark stacked">
                            <header>
                                <h4 class="title">Listado De Clientes</h4>
                                <!-- START Toolbar -->

                                <!--/ END Toolbar -->
                            </header>
                            <section id="collapse2" class="body collapse in">
                                <div class="body-inner">
       <table class="table table-bordered table-striped table-hover" id="">

          
             <tr BGCOLOR="#C3D9FF">
          
               <th width="20%"><input type="text" id="cot" autofocus autocomplete="off" class="span12" placeholder="documento" value=""></th> 
              
                <th width="20%"><input type="text"  autocomplete="off" class="span12" id="nom" placeholder="Nombre del cliente" value=""></th>
        <th>
                  
   

                    <img src="../images/buscar.png" Style="cursor: pointer" id="buscadorc">
                           </th>
              </tr>

</table>
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

<form name="buscarA" action="../vistas/terceros.php?cot=<?php echo $_GET['cot'] ?>&add" method="post" enctype="multipart/form-data">                                    
<?php
     if(isset($_GET['codigo'])){
                     
     $request2=mysqli_query($con,'select * from cont_terceros WHERE id_ter='.$_GET['codigo'].'');
     
     while($row2=mysqli_fetch_array($request2))
	{     
          
              $id = $row2["id_ter"];
              $doc = $row2["cod_ter"];
              $dir = $row2["dir_ter"];
              $tel = $row2["telfijo_ter"];
              $cel = $row2["telmovil_ter"];
              $correo = $row2["correo_ter"];
              $contacto = $row2["cont_ter"];
               $nombre = $row2["nom_ter"];
                $ciudad = $row2["ciudad_ter"];
                 $municipio = $row2["municipio_ter"];
                  $vende = $row2["vendedor"];
              $ubi = $row2["dir_ter"];
                $ciudad1 = $row2["ciudad_ter"];
                 $municipio1 = $row2["municipio_ter"];
                 $pvi = $row2["pvi"];

           ?>
    

    <input type="text" name="cost1" id="id" readonly value="<?php echo $id ?>" />
    <input type="text" name="cost2" id="doc" readonly value="<?php echo $doc ?>" />
    <input type="text" name="cost3" id="dir" readonly value="<?php echo $dir ?>" />
    <input type="text" name="cost4" id="tel" readonly value="<?php echo $tel ?>" />
    <input type="text" name="cost5" id="ema" readonly value="<?php echo $correo ?>" />
    <input type="text" name="cost6" id="con" readonly value="<?php echo $contacto ?>" />
    <input type="text" name="cost7" id="cel" readonly value="<?php echo $cel ?>" />
    <input type="text" name="cost8" id="nomx" readonly value="<?php echo $nombre ?>" />
    <input type="text" name="cost9" id="dep" readonly value="<?php echo $ciudad ?>" />
    <input type="text" name="cost10" id="mun" readonly value="<?php echo $municipio ?>" />
    <input type="text" name="cost11" id="ven" readonly value="<?php echo $vende ?>" />
    <input type="text" name="cost12" id="ubi" readonly value="<?php echo $ubi ?>" />
    <input type="text" name="cost13" id="ciud" readonly value="<?php echo $ciudad1 ?>" />
    <input type="text" name="cost14" id="muni" readonly value="<?php echo $municipio1 ?>" />
    <input type="text" name="cost15" id="pvi" readonly value="<?php echo $pvi ?>" />

<a href="" title="pasar valor" onload="javascript:pasar_puc();"><input type="button" name="cerrar" value="Cargar"  onclick="window.close();"></a>  
      
     <?php }
        }else{
                     $request=mysqli_query($con,'select count(*) from cont_terceros');
if($request){
	$request = mysqli_fetch_row($request);
	$num_items = $request[0];
}else{
	$num_items = 0;
}
$rows_by_page = 20;

$last_page = ceil($num_items/$rows_by_page);

if(isset($_GET['page'])){
	$page = $_GET['page'];
}else{
	$page = 1;
}
            if($page>1){?>
	<a href="../vistas/terceros.php?page=1"><img src="../images/a1.png"></a>
	<a href="../vistas/terceros.php?page=<?php echo $page - 1;?>"><img src="../images/a11.png"></a>
<?php
}else{
	?><img src="../images/ant.png"><?php
}
?>
(Pagina <?php echo $page;?> de <?php echo $last_page;?>)
<?php
if($page<$last_page){?>
	<a href="../vistas/terceros.php?page=<?php echo $page + 1;?>"><img src="../images/p1.png"></a>
	<a href="../vistas/terceros.php?page=<?php echo $last_page;?>"><img src="../images/p11.png"></a>
<?php
}else{
	?><img src="../images/nex.png">  <?php
}

$limit = 'LIMIT ' .($page - 1) * $rows_by_page .',' .$rows_by_page;
         include '../modelo/conexioni.php';
    $request=mysqli_query($con,"SELECT * FROM cont_terceros order by nom_ter asc ".$limit);

if($request){
  ?> 
 <div id="clientes">
 <table class="table table-bordered table-striped table-hover" id="">
            <thead >
            <tr BGCOLOR="#C3D9FF">
                
              <th width="10%">No Documento</th>
              <th width="30%">Nombre del Cliente</th>
              <th width="20%">Telefono</th>
              <th width="10%">Desc. Vid</th>
              <th width="10%">Desc. Alum</th>
              <th width="10%">Desc. Acero</th>
              <th width="10%">Desc. Autorizado</th>
              </tr>
              </thead>
	
    
   <?php
	while($rowk=mysqli_fetch_array($request))
	{    
            
           ?> 
           <tr>
                <td width="5%"><?php echo $rowk['cod_ter'];?></font></td>
                  <td width="30%"><a href="../vistas/terceros.php?codigo=<?php echo $rowk["id_ter"]?>"><?php echo $rowk['nom_ter'];?></a></td>
                  <td width="5%"><?php echo $rowk['telfijo_ter'];?></font></td>
                  <td><?php if($_SESSION['admin']=='Si'){ ?> 
                      <input type="number" id="tervid<?php echo $rowk['id_ter'];?>" onchange="cambiar(<?php echo $rowk['id_ter'];?>)" value="<?php echo $rowk['pvi'];?>" style="width:50px;">
                  <?php }else{  echo $rowk['pvi'];  } ?></td>
                  <td><?php if($_SESSION['admin']=='Si'){ ?> 
                      <input type="number" id="teral<?php echo $rowk['id_ter'];?>" onchange="cambiar(<?php echo $rowk['id_ter'];?>)" value="<?php echo $rowk['pal'];?>" style="width:50px;">
                  <?php }else{  echo $rowk['pal'];  } ?></td>
                  <td><?php if($_SESSION['admin']=='Si'){ ?> 
                      <input type="number" id="terac<?php echo $rowk['id_ter'];?>" onchange="cambiar(<?php echo $rowk['id_ter'];?>)" value="<?php echo $rowk['pac'];?>" style="width:50px;">
                  <?php }else{  echo $rowk['pac'];  } ?></td>
                  <td id="aut<?php echo $rowk['id_ter'];?>"><?php echo $rowk['autorizacion'];?></td>
                      
            </tr>
           	
        <?php          
	} 	
        ?> 
 </table>
     </div>   

  <?php
}
        }
  
?>
  </form>
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
        <?php require '../vistas/script.php';  ?>

         

                              
                                
